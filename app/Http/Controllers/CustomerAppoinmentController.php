<?php

namespace App\Http\Controllers;

use App\Http\Requests\Apointment\StoreApointmentRequest;
use App\Http\Resources\Apointment\ApointmentListResource;
use App\Models\Apointment\Apointment;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use App\Http\Requests\Apointment\UpdateApointmentRequest;
use App\Models\Admin\DentalService;
use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\URL;

class CustomerAppoinmentController extends Controller
{

    public function pay(Request $request)
    {
       

        $service = DentalService::where('id', $request->query('service_id'))->first();
        // dd( $service );

        $hasAppointment = Apointment::where('user_id', auth()->user()->id)->first();
        if ($hasAppointment) {
            return redirect()->route('dashboard')->withErrors([
                'date' => 'You have an appointment'
            ]);
        }

        $successUrl = URL::route('store_apointment', [

            'id' => $request->query('id'),
            'user_id' => $request->query('user_id'),
            'date' =>  $request->query('date'),
            'time_start' => $request->query('time_start'),
            'time_end' => $request->query('time_end'),
            'status' => $request->query('status'),
            'type' => $request->query('type'),

        ]);

        $amount = intval($service->price); // Parses 'value1' to an integer

        $data = [
            'data' => [
                'attributes' => [
                    'line_items' => [
                        [
                            'currency' => 'PHP',
                            'amount' =>  intval($service->price . '00'),
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
                    'cancel_url' => 'http://castillet-dental.test/',
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


        $hasAppointment = Apointment::where('user_id', auth()->user()->id)->first();


        $validatedData = $request->query();

        // Calculate the end time of the new appointment
        $startTime = $validatedData['time_start'];
        $endTime = date('H:i', strtotime('+1 hour', strtotime($startTime)));





        $validatedData['time_end'] = $endTime;
        $validatedData['status'] = 'Pending';

        //    dd($validatedData);
        $newAppointment = Apointment::create($validatedData);
        sleep(1);

        if ($request->wantsJson()) {
            return new ApointmentListResource($newAppointment);
        }

        return redirect()->route('dashboard')->with('success', 'Appointment created successfully');
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
                    // filter result
                    // $query->where('column', 'like', '%' . $queryString . '%')
                    //     ->orWhere('column', 'like', '%' . $queryString . '%');
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
}
