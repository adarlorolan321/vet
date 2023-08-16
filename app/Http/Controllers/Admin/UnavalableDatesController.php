<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apointment\StoreApointmentRequest;
use App\Http\Resources\Apointment\ApointmentListResource;
use App\Models\Apointment\Apointment;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\ValidationException;

class UnavalableDatesController extends Controller
{
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
            ->where('type','!=', 'New Appointment')
            ->where('type','!=', 'Reschedule')
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
        // dd($props);

        return Inertia::render('Admin/UnavailableDates/Index', $props);
    }
    public function store(StoreApointmentRequest $request)
    {
        $hasAppointment = Apointment::where('user_id', auth()->user()->id)->first();

       
        $validatedData = $request->validated();

        // Calculate the end time of the new appointment
        $startTime = $validatedData['time_start'];

        if($validatedData['type'] =='Half Day'){
            $endTime = date('H:i', strtotime('+4 hour', strtotime($startTime)));
        }
        else{
            $endTime = date('H:i', strtotime('+9 hour', strtotime($startTime)));
        }

        
       

       

        $validatedData['time_end'] = $endTime;
        $validatedData['payment_amount'] = '0.00';
        $validatedData['payment_method'] = 'N/A';
        $validatedData['service_id'] = 'N/A';
        $validatedData['payment_status'] = 'N/A';

        $validatedData['status'] = 'Pending';

        //    dd($validatedData);
        $newAppointment = Apointment::create($validatedData);
        sleep(1);

        if ($request->wantsJson()) {
            return new ApointmentListResource($newAppointment);
        }

        return redirect()->back();
    }
}
