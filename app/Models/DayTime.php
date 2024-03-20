<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayTime extends Model
{
    use HasFactory;


    function chamber() {
        return $this->belongsTo(Chamber::class);
    }
}
