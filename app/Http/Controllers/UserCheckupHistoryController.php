<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCheckupHistoryRequest;
use App\Http\Resources\Admin\DentalServiceListResource;
use App\Http\Resources\User\UserLisResource;
use App\Models\Admin\DentalService;
use App\Models\CheckupHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserCheckupHistoryController extends Controller
{
    public function index(Request $request)
    {

        $page = $request->input('page', 1); // default 1
        $perPage = $request->input('perPage', 50); // default 50
        $queryString = $request->input('query', null);
        $sort = explode('.', $request->input('sort', 'id'));
        $order = $request->input('order', 'asc');

        $data = User::query()
            ->with([])
            ->where(function ($query) use ($queryString) {
                if ($queryString && $queryString != '') {
                    $query->where('name', 'like', '%' . $queryString . '%')
                    ->orWhere('mobile_no', 'like', '%' . $queryString . '%')
                    ->orWhere('email', 'like', '%' . $queryString . '%');

                }
            })
            ->where('email', "!=", 'admin@admin.com')
            ->where('email', "!=", 'dentist@admin.com')
          
            ->when(count($sort) == 1, function ($query) use ($sort, $order) {
                $query->orderBy($sort[0], $order);
            })
            ->paginate($perPage)
            ->withQueryString();


       


        $props = [
            'data' => UserLisResource::collection($data),
            'params' => $request->all(),
        ];

        if ($request->wantsJson()) {
            return json_encode($props);
        }

        if (count($data) <= 0 && $page > 1) {
            return redirect()->route('dental_services.index', ['page' => 1]);
        }

        return Inertia::render('Admin/UserCheckupHistory/Index', $props);
    }

    public function store(StoreCheckupHistoryRequest $request)
    {
        $data = $request->all();



        // dd($data);

        $services = CheckupHistory::create([
            'user_id' => $data['user_id'],
            'description' => $data['description'],
            'date' => $data['date'],
            'service_id' => $data['service_id'],
            'xray' => json_encode($data['xray']),
            'title' => $data['title']
        ]);


        if ($request->has('xray')) {

            foreach ($request->xray as $xray) {
                Media::where('id', $xray['id'])
                    ->update([
                        'model_id' => $services->id
                    ]);
            }
        }

        return Redirect::back()->with('status', 'Services created successfully!');
    }

    
    public function show(Request $request, string $id)
    {
        $services = DentalService::all();
        $user = User::where('id', $id)->first();
        $history = CheckupHistory::where('user_id', $id)->get();
        $props = [
            'services' => $services,
             'user' => $user,  
             'history' => $history
        ];
       

        return Inertia::render('Admin/UserCheckupHistory/Show',$props);
    }

}
