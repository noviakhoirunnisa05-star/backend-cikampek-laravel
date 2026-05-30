<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_major';

    protected $fillable = [
        'nama_major',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_major', 'id_major');
    }

    public function scholarships()
    {
        return $this->belongsToMany(
            Scholarship::class,
            'scholarship_major',
            'id_major',
            'id_scholarship'
        );
    }
}