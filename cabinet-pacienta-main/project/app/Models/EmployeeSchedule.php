<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSchedule extends Model
{
    use HasFactory;

    protected $table = 'mskt_employee_schedule';

    protected $fillable = [
        'employee_id',
        'time_start',
        'time_end',
    ];
    protected $primaryKey = 'id';

    public function schedules(){
        return $this->hasMany(ResearchSchedule::class,'employee_id');
    }
    public function cabinentSchedule(){
        return $this->belongsTo(CabinetSchedule::class,'cabinet_schedule_id','id');
    }

    public static function getActiveSchedule(){
        return self::select('employee_id','time_start','time_end',)->orderBy('employee_id','DESC')->paginate(100);
    }

}
