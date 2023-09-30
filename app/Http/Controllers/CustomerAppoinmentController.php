<?php

namespace App\Http\Controllers;

use App\Http\Requests\Apointment\StoreApointmentRequest;
use App\Http\Resources\Apointment\ApointmentListResource;
use App\Models\Apointment\Apointment;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use App\Http\Requests\Apointment\UpdateApointmentRequest;
use App\Models\Admin\VetService;
use App\Models\Payment\Payment;
use App\Models\Pet\Pet;
use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\URL;

class CustomerAppoinmentController extends Controller
{

    public function pay(Request $request)
    {

        
        $validatedData = $request->query();

        $startTime = $validatedData['time_start'];
        $endTime = date('H:i', strtotime('+1 hour', strtotime($startTime)));


        $service = VetService::where('id', $request->query('service_id'))->first();
        $overlappingAppointment = Apointment::where('date', $validatedData['date'])->whereTime('time_start', $startTime)
            ->first();

        if ($overlappingAppointment) {
            throw ValidationException::withMessages([
                'date' => 'The date and time already taken',
            ]);
        }

        $hasAppointment = Apointment::where('user_id', auth()->user()->id)->first();
        if ($hasAppointment) {
            return redirect()->route('dashboard')->withErrors([
                'date' => 'You already have an appointment'
            ]);
        }

        $successUrl = URL::route('store_apointment', [

            'id' => $request->query('id'),
            'pet_id' =>  $request->query('pet_id'),
            'date' =>  $request->query('date'),
            'time_start' => $request->query('time_start'),
            'time_end' => $request->query('time_end'),
            'status' => $request->query('status'),
            'type' => $request->query('type'),
            'service_id' => $request->query('service_id'),
            'payment_status' => $request->query('payment_status'),


        ]);

        $amount = intval($service->price); // Parses 'value1' to an integer

        $data = [
            'data' => [
                'attributes' => [
                    'line_items' => [
                        [
                            'currency' => 'PHP',
                            'amount' =>  intval($service->price . '00') / 2,
                            'description' => $service->description,
                            'name' => $service->name,
                            'quantity' => 1,
                        ]
                    ],
                    'payment_method_types' => [
                        'card',
                        'gcash',
                    ],
                    'success_url' => $successUrl,
                    'cancel_url' => 'http://vet.test/',
                    'description' => 'Dental Reservation',


                ]
            ]
        ];


        $response = Curl::to("https://api.paymongo.com/v1/checkout_sessions")
            ->withHeader('Content-type: application/json')
            ->withHeader('accept: application/json')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Authorization: Basic c2tfdGVzdF9ZRXBWVVF4S1VaSnZDdWFuejY0VFExeHg6')
            ->withData($data) // Pass the data here
            ->asJson()
            ->post();
        // dd($response);

        \Session::put('session_id', $response->data->id);

        return redirect()->to($response->data->attributes->checkout_url);
    }
    public function store_apointment(Request $request)
    {
        $sessionID = \Session::get('session_id');

        $response = Curl::to("https://api.paymongo.com/v1/checkout_sessions/$sessionID")
            ->withHeader('Content-type: application/json')
            ->withHeader('accept: application/json')
            ->withHeader('Authorization: Basic c2tfdGVzdF9ZRXBWVVF4S1VaSnZDdWFuejY0VFExeHg6')
            ->asJson()
            ->get();
        // dd($response->data->attributes->line_items[0]->amount);




        $validatedData = $request->query();
        $amountInCents = $response->data->attributes->line_items[0]->amount;
        $paymentAmount = number_format($amountInCents / 100, 2, '.', ''); // Convert cents to decimal format
        // dd($paymentAmount);

        $validatedData['payment_method'] = $response->data->attributes->payment_method_used;


        $validatedData['payment_amount'] = $paymentAmount;

        // Calculate the end time of the new appointment
        $startTime = $validatedData['time_start'];
        $endTime = date('H:i', strtotime('+1 hour', strtotime($startTime)));




        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['time_end'] = $endTime;
        $validatedData['status'] = 'Pending';



        $newAppointment = Apointment::create($validatedData);

        Payment::create([
            'user_id' => auth()->user()->id,
            'apointment_id' => $newAppointment->id,
            'amount' => $paymentAmount,
            'payment_method' => $validatedData['payment_method'],
            'payment_status' => 'Partial Payment',
        ]);



        if ($request->wantsJson()) {
            return new ApointmentListResource($newAppointment);
        }

        return redirect()->route('home')->with('success', 'Appointment created successfully');
    }
    public function index(Request $request)
    {

        $page = $request->input('page', 1); // default 1
        $perPage = $request->input('perPage', 50); // default 50
        $queryString = $request->input('query', null);
        $sort = explode('.', $request->input('sort', 'id'));
        $order = $request->input('order', 'asc');

        $data = Apointment::query()
            ->with([])
            ->where(function ($query) use ($queryString) {
                if ($queryString && $queryString != '') {
                }
            })
            ->when(count($sort) == 1, function ($query) use ($sort, $order) {
                $query->orderBy($sort[0], $order);
            })
            ->paginate($perPage)
            ->withQueryString();

        $props = [
            'data' => ApointmentListResource::collection($data),
            'params' => $request->all(),
        ];

        if ($request->wantsJson()) {
            return json_encode($props);
        }

        if (count($data) <= 0 && $page > 1) {
            return redirect()->route('apointments.index', ['page' => 1]);
        }

        return Inertia::render('Admin/Apointment/Index', $props);
    }
    public function store(StoreApointmentRequest $request)
    {
        $hasAppointment = Apointment::where('user_id', auth()->user()->id)->first();


        $validatedData = $request->validated();

        // Calculate the end time of the new appointment
        $startTime = $validatedData['time_start'];
        $endTime = date('H:i', strtotime('+1 hour', strtotime($startTime)));

        $overlappingAppointment = Apointment::where('date', $validatedData['date'])->whereTime('time_start', $startTime)

            ->first();

        if ($overlappingAppointment) {
            throw ValidationException::withMessages([
                'date' => 'An appointment already exists ',
            ]);
        }
        if ($hasAppointment) {
            throw ValidationException::withMessages([
                'date' => 'You already set an appointment',
            ]);
        }


        $validatedData['time_end'] = $endTime;
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['status'] = 'Pending';

        //    dd($validatedData);
        $newAppointment = Apointment::create($validatedData);
        sleep(1);

        if ($request->wantsJson()) {
            return new ApointmentListResource($newAppointment);
        }

        return redirect()->back();
    }
    public function update(UpdateApointmentRequest $request, string $id)
    {


        $data = Apointment::findOrFail($id);
        $validatedData = $request->validated();

        // Calculate the end time of the new appointment
        $startTime = $validatedData['time_start'];
        $endTime = date('H:i', strtotime('+1 hour', strtotime($startTime)));

        $overlappingAppointment = Apointment::where('date', $validatedData['date'])->whereTime('time_start', $startTime)

            ->where('id', '!=', $id)
            ->first();

        if ($overlappingAppointment) {
            throw ValidationException::withMessages([
                'date' => 'An appointment already exists ',
            ]);
        }

        $validatedData['time_end'] = $endTime;
        $validatedData['status'] = 'Pending';

        // dd($data);
        $data->update($validatedData);
        sleep(1);

        if ($request->wantsJson()) {
            return (new ApointmentListResource($data))
                ->response()
                ->setStatusCode(201);
        }

        return redirect()->back();
    }
    public function destroy(Request $request, string $id)
    {
        $data = Apointment::findOrFail($id);
        $data->delete();
        sleep(1);

        if ($request->wantsJson()) {
            return response(null, 204);
        }
        return redirect()->back();
    }

    public function getMyAppointment()
    {
        $pet = Pet::where('user_id', auth()->user()->id)->get();
        $service = VetService::get();
        $myAppointment = Apointment::with('service')->where('user_id', auth()->user()->id)->first();


        return Inertia::render('Customer/MyAppointment', [
            'appointment' => $myAppointment,
            'service' => $service,
            'pet' => $pet
        ]);
    }
}
