<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;

    protected $table = 'mskt_research_method';
    protected $fillable = [
        'method_id',
        'short_name',
        'name'
    ];

    protected $primaryKey = 'method_id';

    public static function getActiveMethods()
    {
        return self::orderBy('order', 'ASC');
    }

    public function methodologies()
    {
        return $this->hasMany(Methodology::class);
    }
    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function research_schedules(){
        return $this->hasMany(ResearchSchedule::class);
    }

}
