<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_admin', 'nik', 'nip', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'pendidikan_akhir', 'agama', 'alamat', 'email', 'no_telpon', 'foto', 'created_at', 'updated_at'];
}
