<?php

namespace App;

use App\Traits\UuidPrimaryKey;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use UuidPrimaryKey;
}
