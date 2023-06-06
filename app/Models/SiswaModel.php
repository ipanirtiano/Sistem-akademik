<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'siswa';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_siswa', 'nis', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'alamat', 'email', 'no_telpon', 'nama_asal_sekolah', 'alamat_asal_sekolah', 'nomor_ijazah', 'tahun_ijazah', 'nomor_skhun', 'tahun_skhun', 'nama_ayah', 'nama_ibu', 'alamat_orangtua', 'telpon_orangtua', 'pekerjaan_ayah', 'pekerjaan_ibu', 'foto', 'created_at', 'updated_at'];

    public function getDataSiswaById($kode_siswa)
    {
        return $this->where('kode_siswa', $kode_siswa)->first();
    }

    public function cariDataSiswa($keyword)
    {
        return $this->table('siswa')->like('nis', $keyword)->orLike('nama_lengkap', $keyword);
    }

    public function delete_siswa_manual($kode_siswa)
    {
        $this->db->table('siswa')
            ->where('kode_siswa', $kode_siswa)
            ->delete();
    }
}
