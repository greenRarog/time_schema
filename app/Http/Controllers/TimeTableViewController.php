<?php

namespace App\Http\Controllers;

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
        dd($this->createHead($this->getMondayDate($date)));
        return view('timeschema.timetable', [
            'id'             => $id,
            'events'         => $events,
            'worktime'       => $worktime,            
            'table'          => $this->createTable($worktime, $head),
        ]);
    }


    private function createHead($monday_date)
    {
        return $monday_date;
    }

    private function getMondayDate($date)
    {
        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);
        $day = substr($date, 8, 2);
        $weekDay = date('w', mktime(0, 0, 0, $month, $day, $year));

        
        if ($weekDay == 1) {
            return ['year' => $year, 'month' => $month, 'day' => $day];

        } elseif ($weekDay < 1 && $day >= 2) {
            return ['year' => $year, 'month' => $month, 'day' => $this->addZiro($day - 1)];

        } elseif ($weekDay < 1) {

            if ($month != '12') {
                $resultMonth = $this->addZiro($month - 1);
                $resultDay = $MONTH_DAYS[$resultMonth];
                if ( $month == '02' && $this->isLeap($year) ) {
                    $resultMonth = '02';
                    $resultDay = '29';
                } elseif ( $month == '02' && !$this->isLeap($year) ) {
                    $resultMonth = '02';
                    $resultDay = '28';
                }
                return ['year' => $year, 'month' => $resultMonth, 'day' => $resultDay];
            }

            return ['year' => $year - 1, 'month' => '12', 'day' => 'DADADA'];
        }

    }

    private function createTable($worktime, $head)
    {
        $table = "<table><thead><tr><td><span class='border'>Время</span></td><td><span class='border'>Понедельник</span></td><td><span class='border'>Вторник</span></td><td><span class='border'>Среда</span></td><td><span class='border'>Четверг</span></td><td><span class='border'>Пятница</span></td><td><span class='border'>Суббота</span></td><td><span class='border'>Воскресенье</span></td></tr></thead><tbody>";
        $tableHours = $this->hoursToArray($worktime->start, $worktime->end);
        foreach ($tableHours as $hour) {
            $table .= "<tr><td><span class='border'>" . $hour . "</span></td>";
            for ($i = 0; $i < 7; $i++) {
                $table .= '<td></td>';
            }
            $table .= '</tr>';
        }
        $table .= '</tbody></table>';
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
