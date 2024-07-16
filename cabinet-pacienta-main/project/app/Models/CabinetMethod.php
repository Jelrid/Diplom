<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabinetMethod extends Model
{
    use HasFactory;

    protected $table = 'mskt_cabinet_method';

    protected $fillable = [
        'cabinet_id',
        'method_id',
    ];

    public function cabinet(){
        return $this->belongsTo(Cabinets::class, 'cabinet_id', 'cabinet_id');
    }
    public function method(){
        return $this->belongsTo(Method::class, 'method_id', 'method_id');
    }

}
