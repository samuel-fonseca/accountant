<?php

namespace App;

use App\Traits\UuidPrimaryKey;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use UuidPrimaryKey;

    protected $fillable = [
        'user_id', 'firstname', 'lastname', 'company', 'phone', 'email', 'address', 'address2', 'city', 'state', 'zip', 'country'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }
}
