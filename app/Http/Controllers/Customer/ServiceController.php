<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VetServiceListResource;
use App\Models\Admin\VetService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{

    public function index(Request $request)
    {
        $services =  VetService::all();
    
        // Loop through each service and update the 'photo' property
        foreach ($services as $service) {
            $service['photo'] = json_decode($service['photo']);
        }
    
        return Inertia::render('Customer/Services', ['services' => $services]);
    }
}
