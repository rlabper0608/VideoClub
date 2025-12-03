<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peliculas extends Model {
    
    protected $table = 'pelicula';

    protected $fillable = ['titulo', 'director', 'genero', 'actores', 'year', 'duracion', 'clasificacion', 'portada'];
}
