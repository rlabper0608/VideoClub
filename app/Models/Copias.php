<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Copias extends Model
{

    protected $table = 'copias';

    protected $fillable = ['idpelicula', 'codigo_barras', 'estado', 'formato'];
}
