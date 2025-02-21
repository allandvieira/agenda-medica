<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'crm', 'especialidade'];

    /**
     * Um médico pode ter várias consultas.
     */
    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }
}

