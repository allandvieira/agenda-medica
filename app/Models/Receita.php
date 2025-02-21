<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory;

    protected $fillable = ['consulta_id', 'descricao'];

    /**
     * Uma receita pertence a uma consulta.
     */
    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }
}

