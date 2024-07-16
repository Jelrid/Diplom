<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerPost extends Model
{
    use HasFactory;

    protected $table = 'mskt_employee_post';
    protected $fillable = [
        'employee_id',
        'post_id',
        'first_price',
        'second_price',
        'time',

    ];
    protected $primaryKey = 'employee_id';

    public function schedules(){
        return $this->hasMany(ResearchSchedule::class);
    }

    public function employee(){
        return $this->hasMany(Employee::class);
    }

    public function post(){
        return $this->belongsTo(Post::class, 'post_id', 'post_id');
    }

    public static function getActiveTime(){
        return self::orderBy('employee_id','DESC');

    }

}
