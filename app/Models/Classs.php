<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classs extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'name',
        'base',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'classs_id', 'id');
    }

}
