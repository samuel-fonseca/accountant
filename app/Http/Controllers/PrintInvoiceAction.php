<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

class PrintInvoiceAction extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $invoice = Invoice::where('id', $id)->with(['user', 'client', 'payments'])->firstOrFail();

        return view('mail.invoices.template', ['invoice' => $invoice]);
    }
}
