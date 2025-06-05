<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //asignacion masivva
    protected $fillable = [
        'name',
        'email',
        
        
    ];

    //relacion de uno a muchos
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
