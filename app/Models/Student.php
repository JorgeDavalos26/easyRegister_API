<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'firstname',
        'lastname',
        'email',
        'parent_whatsapp'
    ];

    public function grades()
    {
        return $this->hasMany(Grade::class, 'student_id', 'id');
    }
}
