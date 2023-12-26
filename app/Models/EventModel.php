<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Models\User;

class EventModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'events';    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dayMonth()
    {
        $carbon = Carbon::parse($this->date);
        return $carbon->format('d.m');        
    }    
    public function dayMonthYear()
    {
        $carbon = Carbon::parse($this->date);
        return $carbon->format('d.m.Y');        
    }
    public function hourMinutes()
    {        
        return substr($this->time_start, 0, 5);
    }    
}
