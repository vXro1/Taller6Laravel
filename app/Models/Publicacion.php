<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    // Especificar el nombre correcto de la tabla
    protected $table = 'publicaciones';

    protected $fillable = ['titulo', 'contenido', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
