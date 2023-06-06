<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table = 'guru';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_guru', 'nik', 'nip', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'pendidikan_akhir', 'agama', 'alamat', 'email', 'no_telpon', 'foto', 'created_at', 'updated_at'];

    public function getDataGuruById($kode_guru)
    {
        return $this->where('kode_guru', $kode_guru)->first();
    }

    public function cariDataGuru($keyword)
    {
        return $this->table('guru')->like('nik', $keyword)->orLike('nama_lengkap', $keyword);
    }

    public function findGuruByKode($kode_guru)
    {
        return $this->table('guru')->where('kode_guru', $kode_guru)->first();
    }
}
