<?php

namespace App\Http\Controllers\Api\SystemPortal;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index (Request $request)
    {
        if ($request->active) {
            return Client::where('is_active', 1)->get();
        }

        return Client::all();
    }

    public function store (Request $request)
    {
        $request->validate([
            'company_name' => 'required|unique:clients,company_name',
            'contact_person' => 'required',
            'contact_no' => 'required',
            'account_type' => 'required|in:Regular,Corporate'
        ]);

        return Client::create($request->all());
    }

    public function update (Request $request, Client $client)
    {
        $request->validate([
            'company_name' => 'required|unique:clients,company_name,' . $client->id,
            'contact_person' => 'required',
            'contact_no' => 'required',
            'account_type' => 'required|in:Regular,Corporate'
        ]);

        return $client->update($request->all());
    }
}
