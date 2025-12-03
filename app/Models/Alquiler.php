<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alquiler extends Model{
    protected $table = 'alquiler';

    protected $fillable = ['idcopia', 'idcliente', 'fecha_dev', 'fecha_sal', 'precio'];
}
