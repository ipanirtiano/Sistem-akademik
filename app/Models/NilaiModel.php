<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiModel extends Model
{
    protected $table = 'nilai';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_nilai', 'kode_siswa', 'kode_guru', 'kode_kelas', 'mapel', 'nilai_hadir', 'nilai_tugas', 'nilai_uts', 'nilai_uas', 'nilai_akhir', 'grade', 'semester',  'created_at', 'updated_at'];
}
