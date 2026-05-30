<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationLevel extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_level';

    protected $fillable = [
        'nama_level',
    ];

    public function scholarships()
    {
        return $this->hasMany(Scholarship::class, 'id_level', 'id_level');
    }
}