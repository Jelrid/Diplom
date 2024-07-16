<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'mskt_posts';
    protected $fillable = [
        'post_id',
        'method_id'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function employerPost(){
        return $this->hasMany(EmployerPost::class);
    }
    public function method(){
        return $this->belongsTo(Employee::class, 'method_id', 'method_id');
    }

    public static function getActiveMethods(){
        return self::orderBy('post_id','DESC');
    }

}
