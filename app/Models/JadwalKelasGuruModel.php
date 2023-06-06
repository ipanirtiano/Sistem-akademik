<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalKelasGuruModel extends Model
{
    protected $table = 'jadwal_kelas_guru';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_jadwal', 'kode_guru', 'kode_kelas', 'created_at', 'updated_at'];
}
