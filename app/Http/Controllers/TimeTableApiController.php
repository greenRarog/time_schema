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
        $name = User::find($data['userId'])->name;

        $date = Carbon::parse($data['date'])->format('Y-m-d');
        $time = $data['time'] . ':00';    

        $event = new EventModel;
        $event->admin_id = $data['adminId'];
        $event->user_id = $data['userId'];
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
        $admin = User::find($_GET['adminId']);
        if ($_GET['date'] == 'today') {
            $date = Carbon::now()->format('Y-m-d');
        } else {
            $date = $_GET['date'];
        }
        switch ($_GET['typeTable']) {
            case 'week':
                $table = (new TimeTableViewController)->createWeekTable($admin, $date, $_GET['userId']);
                break;
            case 'day':
                $table = (new TimeTableViewController)->createDayTable($admin, $date, $_GET['userId']);
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
