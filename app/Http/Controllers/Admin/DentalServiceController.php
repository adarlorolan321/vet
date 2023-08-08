<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\DentalServiceListResource;
use App\Models\Admin\DentalService;
use App\Http\Requests\Admin\StoreDentalServiceRequest;
use App\Http\Requests\Admin\UpdateDentalServiceRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DentalServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $page = $request->input('page', 1); // default 1
        $perPage = $request->input('perPage', 50); // default 50
        $queryString = $request->input('query', null);
        $sort = explode('.', $request->input('sort', 'id'));
        $order = $request->input('order', 'asc');

        $data = DentalService::query()
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
            'data' => DentalServiceListResource::collection($data),
            'params' => $request->all(),
        ];

        if ($request->wantsJson()) {
            return json_encode($props);
        }

        if (count($data) <= 0 && $page > 1) {
            return redirect()->route('dental_services.index', ['page' => 1]);
        }

        return Inertia::render('Admin/DentalService/Index', $props);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/DentalService/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDentalServiceRequest $request)
    {
        $data = $request->all();





        $services = DentalService::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'duration' => $data['duration'],
            'photo' => json_encode($data['photo']),
            'price' => $data['price']
        ]);


        if ($request->has('photo')) {

            foreach ($request->photo as $photo) {
                Media::where('id', $photo['id'])
                    ->update([
                        'model_id' => $services->id
                    ]);
            }
        }

        return Redirect::route('dental-services.index')->with('status', 'Services created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $data = DentalService::findOrFail($id);
        if ($request->wantsJson()) {
            return new DentalServiceListResource($data);
        }
        return Inertia::render('Admin/DentalService/Show', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $data = DentalService::findOrFail($id);
        if ($request->wantsJson()) {
            return new DentalServiceListResource($data);
        }
        return Inertia::render('Admin/DentalService/Edit', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDentalServiceRequest $request, string $id)
    {
        $services = DentalService::findOrFail($id);
        if ($request->has('photo')) {

            Media::where('model_id', $id)->where('collection_name', 'services')
                ->where('model_type', 'App\Models\Admin\DentalService')
                ->update([
                    'model_id' =>  0
                ]);

            if ($request->has('photo')) {
                foreach ($request->photo as $photo) {
                    Media::where('id', $photo['id'])
                        ->update([
                            'model_id' => $services->id
                        ]);
                }
            }
            $services->update([
                'photo' => json_encode($request->photo)
            ]);
        } else {
            $services->clearMediaCollection('services');
        }

        sleep(1);

        $services->update($request->validated());
        if ($request->wantsJson()) {
            return (new DentalServiceListResource($services))
                ->response()
                ->setStatusCode(201);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $data = DentalService::findOrFail($id);
        $data->delete();
        sleep(1);

        if ($request->wantsJson()) {
            return response(null, 204);
        }
        return redirect()->back();
    }
}
