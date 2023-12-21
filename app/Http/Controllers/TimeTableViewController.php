<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\EventModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeTableViewController extends Controller
{

    protected $MONTH_DAYS = [
        '01' => '31',
        '02' => '28',
        '03' => '31',
        '04' => '30',
        '05' => '31',
        '06' => '30',
        '07' => '31',
        '08' => '31',
        '09' => '30',
        '10' => '31',
        '11' => '30',
        '12' => '31',
    ];
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

    public function timetable($id)    
    {
        $routeId = $id;
        if (Auth::check()) {
            $id =  Auth::id();
        } else {
            $id = '';
        }  
        $admin = User::find($routeId);
        $worktime = $admin->worktimes->first();
        $events = (new EventModel)
            ->where('admin_id', '=', $routeId)
            ->get();
        $date = '2024-01-03';   
        $table = $this->createTable($worktime, $this->createHead($date));
        $table = $this->addEvents($table, $events);
        //dd($events->first()->hourMinutes());
        //dd($this->addEvents($table, $events));
        return view('timeschema.timetable', [
            'id'             => $id,
            'events'         => $events,
            'worktime'       => $worktime,            
            'table'          => $table,
        ]);
    } 

    private function addEvents($table, $events)
    {
            return $table['head'] . $table['body'];
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
        $result .= '</tr>';
        return [ 'head' => $result, 'days' => $dataArray];
    }

    private function createTable($worktime, $head)
    {
        $table['head'] = $head['head'];
        $table['head'] .= "<tr><td><span class='border'>Время</span></td><td><span class='border'>Понедельник</span></td><td><span class='border'>Вторник</span></td><td><span class='border'>Среда</span></td><td><span class='border'>Четверг</span></td><td><span class='border'>Пятница</span></td><td><span class='border'>Суббота</span></td><td><span class='border'>Воскресенье</span></td></tr></thead><tbody>";
        $table['body'] = '';
        $tableHours = $this->hoursToArray($worktime->start, $worktime->end);
        foreach ($tableHours as $hour) {
            $table['body'] .= "<tr data-time='" . $hour . "'><td><span class='border'>" . $hour . "</span></td>";
            for ($i = 0; $i < 7; $i++) {
                $table['body'] .= "<td data-date='" . $head['days'][$i] . "'></td>";
            }
            $table['body'] .= '</tr>';
        }
        $table['body'] .= '</tbody></table>';
        return $table;
    }

    private function hoursToArray($start, $end)
    {
        $start_hour = substr($start, 0, 2);
        $end_hour = substr($end, 0, 2);
        $result = [];    
        for ($i = $start_hour; $i <= $end_hour; $i++) {
            if (strlen($i) === 1) {
                $time = '0' . $i . ':00';
            } else {
                $time = $i . ':00';
            }
            $result[] = $time;
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

    private function isLeap($year) {
        if ( ($year % 4 == 0) && ($year % 100 != 0) ) {
            return true;
        }
        return false;
    }
}
