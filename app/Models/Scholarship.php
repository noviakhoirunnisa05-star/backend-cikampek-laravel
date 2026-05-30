<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_scholarship';

    protected $fillable = [
        'id_admin',
        'id_level',
        'nama_beasiswa',
        'penyelenggara',
        'deskripsi',
        'persyaratan',
        'semester_min',
        'semester_max',
        'deadline',
        'link_pendaftaran',
        'status',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id_user');
    }

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class, 'id_level', 'id_level');
    }

    public function majors()
    {
        return $this->belongsToMany(
            Major::class,
            'scholarship_major',
            'id_scholarship',
            'id_major'
        );
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'id_scholarship', 'id_scholarship');
    }
}