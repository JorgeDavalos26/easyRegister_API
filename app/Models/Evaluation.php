<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'classs_id',
        'name',
        'value'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function classs()
    {
        return $this->belongsTo(Classs::class, 'classs_id', 'id');
    }

}
