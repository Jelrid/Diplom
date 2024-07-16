<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrast extends Model
{
    use HasFactory;

    protected $table = 'mskt_research_contrast';

    protected $fillable = [
        'name'
    ];

    protected $primaryKey = 'contrast_id';

    public function schedules(){
        $this->hasMany(ResearchSchedule::class, 'contrast_id');
    }
}
