<?php

namespace App\Services;

use App\Models\CabinetSchedule;
use App\Models\Employee;
use App\Models\EmployeeSchedule;
use Carbon\Carbon;


class EmployeeScheduleService
{

    public static function getDates($method, $year, $month, $employee = null)
    {
        $date = Carbon::parse("$year-$month-01");
        return EmployeeSchedule::whereHas('cabinentSchedule', function ($query) use ($date) {
            $query->where('date', 'like', $date->format("Y-m-%"))
            ->select('date');
        }) ->whereHas('cabinentSchedule.cabinet.method', function ($query) use ($method) {
            $query->where('mskt_research_method.method_id', '=', $method);
        })->with('cabinentSchedule')
        ->select('date')->get();


    }
}