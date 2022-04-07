<?php

namespace App\Models;

use App\Traits\UuidPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use UuidPrimaryKey, HasFactory;

    protected $fillable = [
        'user_id', 'firstname', 'lastname', 'company', 'phone', 'email', 'address', 'address2', 'city', 'state', 'zip', 'country'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
