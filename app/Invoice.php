<?php

namespace App;

use App\Traits\UuidPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use UuidPrimaryKey, HasFactory;

    protected $fillable = [
        'user_id',
        'client_id',
        'invoice_number',
        'line_items',
        'message',
        'tax',
        'discount',
        'total',
        'due_at',
        'invoiced_at',
    ];

    protected $casts = [
        'line_items' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function fetchWithRelationships($id = null, $orderBy = 'invoice_number')
    {
        $query = $this->orderBy($orderBy, 'asc')
                    ->where('user_id', auth()->id())
                    ->with(['client', 'payments']);

        if ($id) {
            return $query->where('id', $id)->firstOrFail();
        } else {
            return $query->get();
        }
    }

    public function insert($invoice)
    {
        $invoice['user_id'] = auth()->id();
        $invoice['line_items'] = json_encode($invoice['line_items']);

        if (is_null($invoice['invoice_number'])) {
            $previous_invoice = $this->where('user_id', auth()->id())->orderBy('invoice_number', 'desc')->first();
            $invoice['invoice_number'] = $previous_invoice ? $previous_invoice->invoice_number + 1 : 1000;
        }

        $invoice['invoiced_at'] = date('Y-m-d', strtotime($invoice['invoiced_at']));
        $invoice['due_at'] = date('Y-m-d', strtotime($invoice['due_at']));

        $new = $this->create($invoice);

        return $this->fetchWithRelationships($new->id);
    }
}
