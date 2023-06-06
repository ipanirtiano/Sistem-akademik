<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaBaruModel extends Model
{
    protected $table = 'siswa_baru';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'kode_siswa', 'nis', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama',
        'alamat', 'email', 'no_telpon', 'created_at', 'updated_at'
    ];

    public function getDataSiswaById($kode_siswa)
    {
        return $this->where('kode_siswa', $kode_siswa)->first();
    }

    public function cariDataSiswa($keyword)
    {
        return $this->table('siswa_baru')->like('nama_lengkap', $keyword)->orLike('nis', $keyword);
    }


    public function getJumlahData()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'sistem_akademik_v3');
        $query = mysqli_query($conn, "SELECT * FROM siswa_baru");

        $jumlah_siswa = mysqli_num_rows($query);

        if ($jumlah_siswa > 0) {
            return $jumlah_siswa;
        } else {
            return 0;
        }
    }

    public function getRandomData($jumlah)
    {
        return $this->db->table('siswa_baru')
            ->orderBy('kode_siswa', 'RANDOM')
            ->limit($jumlah)
            ->get()->getResultArray();
    }

    public function delete_multiple($siswa)
    {
        $this->db->table('siswa_baru')
            ->where('kode_siswa', $siswa)
            ->delete();
    }

    public function deleteSiswa($kode_siswa)
    {
        $this->db->table('siswa_baru')
            ->where('kode_siswa', $kode_siswa)
            ->delete();
    }
}
