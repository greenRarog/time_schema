<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class EventModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'events';    

    public function dayMonth()
    {
        $carbon = Carbon::parse($this->date);
        return $carbon->format('d.m');        
    }    
    public function hourMinutes()
    {        
        return substr($this->time_start, 0, 5);
    }    
}
