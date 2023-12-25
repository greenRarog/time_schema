<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\EventModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeTableViewController extends Controller
{
    protected $MONTH_NAMES = [
        '01' => 'Январь',
        '02' => 'Февраль',
        '03' => 'Март',
        '04' => 'Апрель',
        '05' => 'Май',
        '06' => 'Июнь',
        '07' => 'Июль',
        '08' => 'Август',
        '09' => 'Сентябрь',
        '10' => 'Октябрь',
        '11' => 'Ноябрь',
        '12' => 'Декабрь',
    ];

    public function timetable(Request $request, $id)    
    {
        $routeId = $id;
        $admin = User::find($routeId);
        if (isset($admin)) {
            if (Auth::check()) {
                $id =  Auth::id();
            } else {
                $id = '';
            }  
            $worktime = $admin->worktimes->first();        
            if ($request->has('year') && $request->has('month') && $request->has("day")) {
                $date = $request->year . '-' . $request->month . '-' . $request->day;
            } else {
                $date = Carbon::now()->format('Y-m-d');
            }
            if ($id != '') {
                $fillEmptyTd = "<button class='add-user'><span class='border'> + </span></button>";
            } else {
                $fillEmptyTd = " ";
            }


            $monday = Carbon::parse($date)->startOfWeek()->format('Y-m-d');
            $sunday = Carbon::parse($monday)->next('Sunday')->format('Y-m-d');
            $events = EventModel::where('admin_id', '=', $routeId)
                ->where('date', '>=', $monday)
                ->where('date', '<=', $sunday)
                ->get();        
            return view('timeschema.timetable', [
                'id'             => $id,
                'table'          => $this->createTable($worktime, $date, $events, $fillEmptyTd),
            ]);            
        }
        return redirect(route('main-page'));
    } 

    private function createTable($worktime, $date, $events, $fillEmptyTd)
    {        
        $head = $this->createHead($date);
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

    private function createHead($date)
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
        $result = '<table><thead><tr><td></td>';
        foreach ($dataArray as $weekDay) {
            $result .= "<td><span class='border'>" . $weekDay . '</span></td>';
        }
        $result .= "</tr><tr><td><span class='border'>Время</span></td><td><span class='border'>Понедельник</span></td><td><span class='border'>Вторник</span></td><td><span class='border'>Среда</span></td><td><span class='border'>Четверг</span></td><td><span class='border'>Пятница</span></td><td><span class='border'>Суббота</span></td><td><span class='border'>Воскресенье</span></td></tr></thead><tbody>";
        return [ 'head' => $result, 'days' => $dataArray];
    }

    private function addEvent($event, $body, $fillEmptyTd)
    {
        $search = "<td data-date='" . $event->dayMonth() . "' data-time='" . $event->hourMinutes() 
            . "'>" . $fillEmptyTd 
            . "</td>";

        $change = "<td data-date='" . $event->dayMonth() . "' data-time='" . $event->hourMinutes() 
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
