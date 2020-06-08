<?php

namespace App;

use App\Traits\UuidPrimaryKey;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use UuidPrimaryKey;
}
