<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentReminder extends Model
{
    protected $casts=['day_after_day','weekly','monthly'];

}
