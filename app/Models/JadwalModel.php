<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'jadwal';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_jadwal', 'kode_kelas', 'mata_pelajaran', 'guru_pengajar', 'hari', 'jam_pelajaran', 'smester', 'created_at', 'updated_at'];


    // public function getGuruPengajar()
    // {
    //     $data_mapel = $this->db->table('mata_pelajaran')
    //         ->join('guru', 'guru.kode_guru = mata_pelajaran.guru_pengajar')
    //         ->get()->getResultArray();
    //     return $data_mapel;
    // }

    // public function getDataByKodeMapel($kode_mapel)
    // {
    //     $data_mapel = $this->db->table('mata_pelajaran')
    //         ->join('guru', 'guru.kode_guru = mata_pelajaran.guru_pengajar')
    //         ->where('kode_mapel', $kode_mapel)->get()->getResultArray();
    //     return $data_mapel;
    // }

    public function findJadwalBykodeKelas($kode_kelas)
    {
        $data_jadwal = $this->db->table('jadwal')
            ->join('guru', 'guru.kode_guru = jadwal.guru_pengajar')
            ->where('kode_kelas', $kode_kelas)
            ->get()->getResultArray();
        return $data_jadwal;
    }

    public function findJadwal($kode_jadwal)
    {
        return $this->table('jadwal')->where('kode_jadwal', $kode_jadwal)->first();
    }
}
