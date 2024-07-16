<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Pacient extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use  Authenticatable;

    protected $table = 'mskt_pacients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'login',
        'password',
        'last_name',
        'first_name',
        'father_name',
        'sex',
        'birthday',
        'phone',
        'email'
    ];

    protected $primaryKey = 'pacient_id';
}
