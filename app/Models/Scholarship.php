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

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class, 'id_level', 'id_level');
    }
}