<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignation extends Model
{
    use HasFactory;

    protected $fillable = [
        'classs_id',
        'evaluation_id',
        'name',
        'description'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'evaluation_id', 'id');
    }

    public function classs()
    {
        return $this->belongsTo(Classs::class, 'classs_id', 'id');
    }
}
