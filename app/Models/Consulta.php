<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = ['paciente_id', 'medico_id', 'data', 'horario', 'observacoes'];

    /**
     * Uma consulta pertence a um paciente.
     */
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    /**
     * Uma consulta pertence a um médico.
     */
    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    /**
     * Uma consulta pode ter uma receita.
     */
    public function receita()
    {
        return $this->hasOne(Receita::class);
    }
}

