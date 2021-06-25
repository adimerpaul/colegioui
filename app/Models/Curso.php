<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombre',
        'gestion',
        'teacher_id',
    ];
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
