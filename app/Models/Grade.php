<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'assignation_id',
        'value',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function assignation()
    {
        return $this->belongsTo(Assignation::class, 'assignation_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
