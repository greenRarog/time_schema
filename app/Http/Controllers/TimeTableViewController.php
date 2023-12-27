<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\EventModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeTableViewController extends Controller
{
    public function timetable(Request $request, $id)    
    {
        $adminId = $id;
        $admin = User::find($adminId);
        if (isset($admin)) {
            if (Auth::check()) {
                $id =  Auth::id();                
            } else {
                $id = '';                
            }
            if ($request->has('date')) {
                $date = $request->date;
            } else {
                $date = Carbon::now()->format('Y-m-d');
            }
            return view('timeschema.timetable', [
                'id'        => $id,
                'weekTable' => $this->createWeekTable($admin, $date, $id),
                'dayTable'  => $this->createDayTable($admin, $date, $id),
            ]);            
        }
        return redirect(route('main-page'));
    } 

    public function createWeekTable($admin, $date, $id)
    {
        if ($id != '') {
            $fillEmptyTd = "<button class='week-add-user'><span class='border'> + </span></button>";
        } else {
            $fillEmptyTd = " ";
        }
        $worktime = $admin->worktimes->first();
        $monday = Carbon::parse($date)->startOfWeek()->format('Y-m-d');
        $sunday = Carbon::parse($monday)->next('Sunday')->format('Y-m-d');
        $events = EventModel::where('admin_id', '=', $admin->id)
            ->where('date', '>=', $monday)
            ->where('date', '<=', $sunday)
            ->get();
        $head = $this->createWeekTableHead($date, $admin->id, $id);
        $table['head'] = $head['head'];    
        $tableHours = $this->hoursToArray($worktime->start, $worktime->end);            
        $table['body'] = '';        
        foreach ($tableHours as $hour) {
            $table['body'] .= "<tr data-time='" . $hour . "'><td><span class='border'>" . $hour . "</span></td>";
            for ($i = 0; $i < 7; $i++) {
                $table['body'] .= "<td data-date='" . $head['days'][$i] . "' data-time='" . $hour . "'>" . $fillEmptyTd . "</td>";
            }
            $table['body'] .= '</tr>';
        }
        $table['body'] .= '</tbody></table>';
        foreach ($events as $event) {   
            $table['body'] = $this->addEvent($event, $table['body'], $fillEmptyTd);
        }
        return ($table['head'] . $table['body']);
    }     

    public function createDayTable($admin, $date, $id)
    {
        if ($id != '') {
            $fillEmptyTd = "<button class='day-add-user'><span class='border'> + </span></button>";
        } else {
            $fillEmptyTd = " ";
        }
        $worktime = $admin->worktimes->first();
        $tableHours = $this->hoursToArray($worktime->start, $worktime->end);        
        $events = EventModel::where('admin_id', '=', $admin->id)
            ->where('date', '=', $date)
            ->get();
        $head = $this->createDayTableHead($date, $admin->id, $id);
        $body = '<tbody>';
        $date = Carbon::parse($date)->format('d.m.Y');
        foreach ($tableHours as $hour) {
            $body .= "<tr data-time='" . $hour . "'><td><span class='border'>" . $hour . "</span></td><td data-date='" . $date . "' data-time='" . $hour . "'>" . $fillEmptyTd . "</td></tr>";
        }
        foreach ($events as $event) {            
            $body = $this->addEvent($event, $body, $fillEmptyTd);
        }               
        $body .= '</tbody></table>';
        return $head . $body;
    }

    private function createWeekTableHead($date, $adminId, $userId)
    {
        $monday = (Carbon::parse($date))->startOfWeek()->format('Y-m-d');
        $dateFromMonday = Carbon::parse($monday);
        $dataArray = [
          $dateFromMonday->format('d.m'),
          $dateFromMonday->next('Tuesday')->format('d.m'),
          $dateFromMonday->next('Wednesday')->format('d.m'),
          $dateFromMonday->next('Thursday')->format('d.m'),
          $dateFromMonday->next('Friday')->format('d.m'),
          $dateFromMonday->next('Saturday')->format('d.m'),
          $dateFromMonday->next('Sunday')->format('d.m'),
        ];

        $monday = (Carbon::parse($date))->startOfWeek()->format('Y-m-d');
        $dateFromMonday = Carbon::parse($monday);
        $dataArrayForBody = [
          $dateFromMonday->format('d.m.Y'),
          $dateFromMonday->next('Tuesday')->format('d.m.Y'),
          $dateFromMonday->next('Wednesday')->format('d.m.Y'),
          $dateFromMonday->next('Thursday')->format('d.m.Y'),
          $dateFromMonday->next('Friday')->format('d.m.Y'),
          $dateFromMonday->next('Saturday')->format('d.m.Y'),
          $dateFromMonday->next('Sunday')->format('d.m.Y'),
        ];
        $dateForTable = (Carbon::parse($date))->isToday() ? 'today' : $date;
        $result = "<table data-date='" . $dateForTable . "' data-admin-id='" . $adminId . "' data-user-id='" . $userId .  "' class='week-table'><thead><tr><td></td>";
        foreach ($dataArray as $weekDay) {
            $result .= "<td><span class='border'>" . $weekDay . '</span></td>';
        }
        $result .= "</tr><tr><td><span class='border'>Время</span></td><td><span class='border'>Понедельник</span></td><td><span class='border'>Вторник</span></td><td><span class='border'>Среда</span></td><td><span class='border'>Четверг</span></td><td><span class='border'>Пятница</span></td><td><span class='border'>Суббота</span></td><td><span class='border'>Воскресенье</span></td></tr></thead><tbody>";
        return [ 'head' => $result, 'days' => $dataArrayForBody];
    }

    private function createDayTableHead($date, $adminId, $userId)
    {
        $result = "<table data-date='" . $date . "' data-admin-id='" . $adminId . "' data-user-id='" . $userId .  "' class='day-table'><thead><tr><td><span class='border'>Время</span></td><td><span class='border'>Человек</span></td></tr></thead>";
        return $result;
    }

    private function addEvent($event, $body, $fillEmptyTd)
    {
        $search = "<td data-date='" . $event->dayMonthYear() . "' data-time='" . $event->hourMinutes() 
            . "'>" . $fillEmptyTd 
            . "</td>";        
        $change = "<td data-date='" . $event->dayMonthYear() . "' data-time='" . $event->hourMinutes() 
            . "' data-id-user='" . $event->user_id . "'><span class='border'>" . $event->user->name 
            . "</span></td>";
        return str_replace($search, $change, $body);
    }

    private function hoursToArray($start, $end)
    {
        $start_hour = substr($start, 0, 2);
        $end_hour = substr($end, 0, 2);
        $result = [];    
        for ($i = $start_hour; $i <= $end_hour; $i++) {
            $result[] = $this->addZiro($i) . ':00';
        }
        return $result;
    }

    private function addZiro($number)
    {
        if (strlen($number) == 1) {
            return '0' . $number;
        }
        return $number;
    }
}
