<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserLisResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

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

    public function show(Request $request, string $id){
        $user = User::where('id', $id)->first();

        
        return Inertia::render('Admin/UserCheckupHistory/Show', ['user' => $user]);
    }
}
