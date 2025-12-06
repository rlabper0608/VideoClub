<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alquiler extends Model{
    protected $table = 'alquiler';

    protected $fillable = ['idcopia', 'idcliente', 'fecha_dev', 'fecha_sal', 'precio'];

    function cliente(): BelongsTo {
        return $this->belongsTo('App\Models\Cliente', 'idcliente');
    }

    function copia(): BelongsTo {
        return $this->BelongsTo('App\Models\Alquiler', 'idcopia');
    }
}
