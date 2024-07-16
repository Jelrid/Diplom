<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabinets extends Model
{
    use HasFactory;

    protected $table = 'mskt_cabinets';

    protected $fillable = [
        'cabinet_id',
        'filial_id',
        'number',
        'name',
        'name_short',
        'floor',
    ];
    protected $primaryKey = 'cabinet_id';

    public function method(){
        return $this->belongsToMany(Method::class, 'mskt_cabinet_method','cabinet_id','method_id');
    }
    public function cabinetSchedules(){
        return $this->hasMany(CabinetSchedule::class);
    }
        


}
