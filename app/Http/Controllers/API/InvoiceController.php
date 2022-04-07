<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoice = auth()->user()
            ->invoices
            ->sortBy('invoice_number')
            ->load(['client', 'payments']);

        return InvoiceResource::collection($invoice);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {
        $invoice = $request->save();

        return new InvoiceResource($invoice);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $this->authorize('view', Invoice::class);

        return response()->json($invoice->load(['client', 'payments']));
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
            'invoiced_at' => 'required|date',
            'due_at' => 'required|date|after_or_equal:invoiced_at',
            'line_items' => 'required',
            'total' => 'required'
        ]);

        $data = [
            'client_id' => $request->client_id,
            'line_items' => $request->line_items,
            'message' => $request->message,
            'tax' => $request->tax,
            'discount' => $request->discount,
            'total' => $request->total,
            'invoiced_at' => $request->invoiced_at,
            'due_at' => $request->due_at,
        ];

        if ($invoice->update($data)) {
            return response()->json($invoice->load(['client', 'payments']));
        } else {
            return response()->json(['message' => 'Could not update the invoice at this time.'], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        // get client name
        $client_name = $invoice->load('client')->client->display_name;

        $invoice->delete();
        return response()->json(['message' => 'Invoice for '. $client_name .' has been deleted.']);
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
