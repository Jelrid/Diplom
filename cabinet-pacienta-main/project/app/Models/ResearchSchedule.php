<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchSchedule extends Model
{
    use HasFactory;

    protected $table = 'mskt_research_schedule';

    protected $fillable = [
        'employee_id',
        'method_id',
        'methodology_id',
        'pacient_id',
        'date',
        'time_start',
        'time_end',
        'cancel_time',
        'cancel_status',
        'cancel_note',

        'vip_research',
        'methodology_side',
        'diagnosis_id',
        'secondary',
        'place0',
        'place1',
        'vip_type',
        'privilege',
        'urgency_id',
        'price',
        'bonus_prepay',
        'pay',
        'prepay',
        'active',
        'monitor_text',
        'dlp',
        'radiation',
        'done_status',
        'done_note',
        'cancel_status',
        'cancel_note',
        'parent_id',
        'registrator_id',
        'register_time',
        'clear_time',
        'status',
        'move_apply',
        'note',
        'conflict',
        'anamnesis',
        'result_ready_time',
        'redo',
        'redo_research_id',
        'commit_status',
        'commit_percent',
        'filming_done',
        'conclusion_done',
        'med_worker',
        'email_conclusion',
        'email_conclusion_send',
        'mobile_move',


    ];

    protected $primaryKey = 'research_id';
    public $timestamps = false;

    public  function employeeSchedules(){
        return $this->belongsTo(EmployeeSchedule::class,'employee_id');
    }

    public function employees(){
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function methods(){
        return $this->belongsTo(Method::class, 'method_id');
    }

    public function methodologys(){
        return $this->belongsTo(Methodology::class, 'methodology_id');
    }

    public function contrast(){
        return $this->belongsTo(Contrast::class, 'contrast_id');
    }

    public function posts(){
        return $this->belongsTo(EmployerPost::class, 'employee_id');
    }

    public static function getActiveSchedule(){
        return self::select(
            'research_id','employee_id','method_id','methodology_id','pacient_id','date','time_start','time_end', 'status', 'cancel_time','cancel_status','cancel_note')
            ->orderBy('research_id','DESC')
            ->limit(1000);
    }
}
