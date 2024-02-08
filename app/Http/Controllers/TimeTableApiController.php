<?php

namespace App\Http\Controllers;
use App\Http\Requests\AddReservationRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EventModel;
use Carbon\Carbon;
use App\Http\Controllers\TimeTableViewController;

class TimeTableApiController extends Controller
{
    public function addReservation(AddReservationRequest $request)
    {        
        $data = $request->validated();
        $name = User::find($data['user_id'])->name;

        $date = Carbon::parse($data['date'])->format('Y-m-d');
        $time = $data['time'] . ':00';    

        $event = new EventModel;
        $event->admin_id = $data['admin_id'];
        $event->user_id = $data['user_id'];
        $event->date = $date;
        $event->time_start = $time;
        $event->duration = 3600;
        //$event->save();

        return json_encode([
            'status' => 'ok', 
            'event'  => $event,
            'name'   => $name,
        ]);
    }

    public function getTable(Request $request)
    {        
        $admin = User::find($_GET['admin_id']);
        if ($_GET['date'] == 'today') {
            $date = Carbon::now()->format('Y-m-d');
        } else {
            $date = $_GET['date'];
        }
        switch ($_GET['typeTable']) {
            case 'week':
                $table = (new TimeTableViewController)->createWeekTable($admin, $date, $_GET['user_id']);
                break;
            case 'day':
                $table = (new TimeTableViewController)->createDayTable($admin, $date, $_GET['user_id']);
                break;
        }

        
        return json_encode([
            'status' => 'ok',
            'table'  => $table,
        ]);
    }

    public function test(AddReservationRequest $request) {
        return $request->validated();
    }
}
