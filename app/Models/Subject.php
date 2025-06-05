<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
     //asignacion masivva
    protected $fillable = [
        'name',
        'description',
        'teacher_id',
        
    ];

     //relacion de uno a muchos
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
    //relacion de muchos a uno
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

}
