<?php

namespace App;

use App\Traits\UuidPrimaryKey;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use UuidPrimaryKey;
}
