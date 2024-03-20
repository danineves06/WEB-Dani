<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    public function turma() {
        return $this->belongsTo('\App\Models\Turma');
    }

    public function curso() {
        return $this->belongsTo('\App\Models\Curso');
    }
    public function user() {
        return $this->belongsTo('\App\Models\User');
    }
}
