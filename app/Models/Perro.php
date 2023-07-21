<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perro extends Model
{
    public function interacciones()
    {
        return $this->hasMany(Interaccion::class, 'perro_interesado_id', 'id');
    }

    public function candidatos()
    {
        return $this->hasMany(Interaccion::class, 'perro_candidato_id');
    }
}
