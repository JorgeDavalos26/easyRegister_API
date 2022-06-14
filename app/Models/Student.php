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
        'parent_whatsapp',
        'number_list'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function grades()
    {
        return $this->hasMany(Grade::class, 'student_id', 'id');
    }
}
