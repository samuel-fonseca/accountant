<?php

namespace App;

use App\Traits\UuidPrimaryKey;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use UuidPrimaryKey;
}
