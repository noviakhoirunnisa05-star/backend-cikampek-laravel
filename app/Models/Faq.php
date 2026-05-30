<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_faq';

    protected $fillable = [
        'id_admin',
        'pertanyaan',
        'jawaban',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id_user');
    }
}