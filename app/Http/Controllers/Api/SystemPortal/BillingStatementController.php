<?php

namespace App\Http\Controllers\Api\SystemPortal;

use App\Http\Controllers\Controller;
use App\Models\BillingStatement;
use Illuminate\Http\Request;

class BillingStatementController extends Controller
{
    public function index (Request $request)
    {
        return BillingStatement::with('client')->orderBy('date', 'DESC')->get();
    }

    public function store (Request $request)
    {
        $request->validate([
            'bs_no' => 'required|unique:billing_statements,bs_no|numeric',
            'client_id' => 'required|exists:clients,id',
            'date' => 'required|date',
            'items' => 'required|array',
            'vatable_amount' => 'required|numeric',
            'vat_amount' => 'required|numeric',
            'total_amount' => 'required|numeric'
        ]);

        $request->request->add([
            'items' => json_encode($request->items)
        ]);

        BillingStatement::create($request->all());
        return 1;
    }


}
