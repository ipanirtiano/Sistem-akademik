<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasSiswaModel extends Model
{
    protected $table = 'kelas_siswa';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_kelas', 'slug', 'kode_siswa', 'created_at', 'updated_at'];

    public function findbyKodeKelas($kode_kelas)
    {
        $data_siswa = $this->db->table('kelas_siswa')
            ->join('siswa', 'siswa.kode_siswa = kelas_siswa.kode_siswa')
            ->like('kode_kelas', $kode_kelas)
            ->get()->getResultArray();
        return $data_siswa;
    }

    public function delete_siswa_manual($kode_siswa)
    {
        $this->db->table('kelas_siswa')
            ->where('kode_siswa', $kode_siswa)
            ->delete();
    }

    public function cariDataSiswa_kelas($keyword)
    {
        $data_siswa = $this->db->table('kelas_siswa')
            ->join('siswa', 'siswa.kode_siswa = kelas_siswa.kode_siswa')
            ->like('nis', $keyword)
            ->orLike('nama_lengkap', $keyword)
            ->get()->getResultArray();
        return $data_siswa;
    }
}
