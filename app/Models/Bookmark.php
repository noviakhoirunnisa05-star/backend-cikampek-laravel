<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_bookmark';

    protected $fillable = [
        'id_user',
        'id_scholarship',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function scholarship()
    {
        return $this->belongsTo(Scholarship::class, 'id_scholarship', 'id_scholarship');
    }
}