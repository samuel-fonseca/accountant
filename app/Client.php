<?php

namespace App;

use App\Traits\UuidPrimaryKey;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use UuidPrimaryKey;

    protected $fillable = [
        'user_id', 'firstname', 'lastname', 'phone', 'email', 'address', 'address2', 'city', 'state', 'zip'
    ];
}
