<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    public function sumBooking()
    {
        return $this->hasMany(Booking::class, 'event_id', 'id');
    }
}
