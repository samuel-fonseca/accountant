<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facades\App\Invoice;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $invoice = auth()->user()->invoices;
        $invoice = Invoice::orderBy('invoice_number', 'asc')->where('user_id', auth()->id())->with(['client', 'payments'])->get();
        
        return response()->json($invoice, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|uuid',
            'invoiced_at' => 'required',
            'due_at' => 'required',
            'line_items' => 'required',
            'total' => 'required'
        ]);

        $invoice = Invoice::insert($request->all());

        return response($invoice, 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Invoice::where([
            ['id', $id],
            ['user_id', auth()->id()]
        ])->with(['client', 'payments'])->firstOrFail();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'client_id' => 'required|uuid',
            'invoiced_at' => 'required',
            'due_at' => 'required',
            'line_items' => 'required',
            'total' => 'required'
        ]);

        $invoice = Invoice::insert($request->all());

        return response($invoice, 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::find($id);

        // Check permissions
        if ($invoice->user_id !== auth()->id()) return abort(401, 'Authenticated.');

        $invoice->delete();

        return response()->json('Invoice has been deleted');
    }

    /**
     * Notify customer of their invoice
     * 
     * @param mixed $id
     * @return \Illuminate\Http\Response
     */
    public function notify($id)
    {
        // 
    }
}
