<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeQualification extends Model
{
    use HasFactory;
    protected $table = 'mskt_employee_qualification';

    protected $fillable = [
        'employee_id',
        'methodology_id',
        'qualification_id',
        'type',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id','employee_id');
    }

    public function methodology(){
        return $this->belongsTo(Methodology::class, 'methodology_id','methodology_id');
    }



}
