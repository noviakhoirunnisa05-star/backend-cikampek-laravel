use Illuminate\Support\Facades\DB;

public function run(): void
{
    DB::table('roles')->insert([
        ['nama_role' => 'admin'],
        ['nama_role' => 'user'],
    ]);

    DB::table('education_levels')->insert([
        ['nama_level' => 'SMA/SMK'],
        ['nama_level' => 'D3'],
        ['nama_level' => 'D4'],
        ['nama_level' => 'S1'],
        ['nama_level' => 'S2'],
        ['nama_level' => 'S3'],
    ]);

    DB::table('majors')->insert([
        ['nama_major' => 'Akuntansi'],
        ['nama_major' => 'Manajemen'],
        ['nama_major' => 'Teknik Informatika'],
        ['nama_major' => 'Sistem Informasi'],
        ['nama_major' => 'Pendidikan Guru Sekolah Dasar'],
        ['nama_major' => 'Hukum'],
    ]);
}