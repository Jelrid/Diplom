<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Methodology extends Model
{
    use HasFactory;

    protected $table = 'mskt_research_methodology';
    protected $fillable = [
        'method_id',
        'zone_id',
        'name',
        'short',
        'check_name',
        'time',
        'price',
        'contras',
    ];
    protected $primaryKey = 'methodology_id';



    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'mskt_employee_qualification', 'methodology_id', 'employee_id')
            ->where('qualification_id', '>=', 4);
    }
    public function method()
    {
        return $this->belongsTo(Method::class, 'method_id', 'method_id');
    }

    public function research_schedules(){
        return $this->hasMany(ResearchSchedule::class);
    }

    public static function getActiveMethodologies()
    {
        return self::orderBy('name', 'ASC')->where('active',1);
    }

}
