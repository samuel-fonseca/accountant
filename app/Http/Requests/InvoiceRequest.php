<?php

namespace App\Http\Requests;

use App\Models\Invoice;
use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client_id' => 'required|uuid',
            'invoiced_at' => 'required',
            'due_at' => 'required',
            'line_items' => 'required',
            'total' => 'required'
        ];
    }

    public function save(): Invoice
    {
        $input = $this->all();
        $input['user_id'] = auth()->id();

        $invoice = Invoice::create($input);

        return $invoice;
    }
}
