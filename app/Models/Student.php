<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //asignacion masivva
    protected $fillable = [
        'name',
        'email',
        'birth_date',
        
    ];

    //relacion de uno a muchos
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }


}
