<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

class DashboardsController extends Controller
{
    public function print_invoice($id)
    {
        $invoice = Invoice::where('id', $id)->with(['user', 'client', 'payments'])->firstOrFail();

        $invoice['line_items'] = json_decode($invoice['line_items'], true);

        return view('mail.invoices.template', ['invoice' => $invoice]);
    }
}
