<?php

namespace App;

use App\Traits\UuidPrimaryKey;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use UuidPrimaryKey;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function account()
    {
        return $this->belongsTo('App\Account');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
