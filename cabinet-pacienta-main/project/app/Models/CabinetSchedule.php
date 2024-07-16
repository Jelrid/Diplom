<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabinetSchedule extends Model
{
    use HasFactory;

    protected $table = 'mskt_cabinet_schedule';

    protected $fillable = [
        'id',
        'cabinet_id',
        'date',
        'time_start',
        'time_end'
    ];

    protected $primaryKey = 'id';

    public function cabinet (){
        return $this->belongsTo(Cabinets::class,'cabinet_id','cabinet_id');
    }

    public function employeeSchedule (){
        return $this->hasMany(EmployeeSchedule::class,'cabinet_schedule_id','cabinet_id');
    }

    public static function getActiveScheduled (){
        return self::orderBy('id','DESC')->limit(1000);
    }

}
