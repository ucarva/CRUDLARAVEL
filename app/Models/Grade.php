<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    //asignacion masivva
    protected $fillable = [
        'student_id',
        'subject_id',
        'grade',
        'observation',

    ];


   // Relación: una calificación pertenece a un estudiante
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relación: una calificación pertenece a una materia
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
