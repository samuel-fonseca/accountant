<?php

namespace App;

use App\Traits\UuidPrimaryKey;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, UuidPrimaryKey, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'city', 'state', 'zip', 'country', 'billing_address', 'billing_city', 'billing_state', 'billing_zip', 'billing_country',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function invoices()
    {
        return $this->hasMany(App\Invoice::class);
    }

    public function clients()
    {
        return $this->hasMany(App\Client::class);
    }

    public function expenses()
    {
        return $this->hasMany(App\Expense::class);
    }

    public function incomes()
    {
        return $this->hasMany(App\Income::class);
    }
}
