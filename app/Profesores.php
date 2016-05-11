<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesores extends Model
{
    protected $fillable = array('nombre', 'apellidos', 'email', 'password');
}
