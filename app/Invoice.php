<?php

namespace App;

use App\Traits\UuidPrimaryKey;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use UuidPrimaryKey;

    protected $fillable = [
        'user_id', 'client_id', 'invoice_number', 'line_items', 'message', 'tax', 'discount', 'total', 'due_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function client()
    {
        return $this->hasOne('App\Client');
    }

    public function payments() 
    {
        return $this->hasMany('App\Payment');
    }

}
