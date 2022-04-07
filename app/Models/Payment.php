<?php

namespace App\Models;

use App\Traits\UuidPrimaryKey;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use UuidPrimaryKey;

    protected $fillable = [
        'invoice_id', 'amount', 'confirmation_number', 'paid_at'
    ];

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
