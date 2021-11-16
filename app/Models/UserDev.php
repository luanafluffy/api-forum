<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDev extends Model
{
    protected $table = 'usuario';
    public $timestamps = true;
    protected $fillable = ['nome', 'email', 'password'];
}
