<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\SubServices;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function showProvider($id)
    {
        $service = Service::find($id);
        $providers = $service->subservice()
            ->whereHas('provider')
            ->with('provider.address')
            ->get();
        return response()->json(["all provider for {$service->name} main service"  => $providers],200);
    }
}
