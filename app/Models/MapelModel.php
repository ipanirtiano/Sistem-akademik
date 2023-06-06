<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{
    protected $table = 'mata_pelajaran';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_mapel', 'nama_mapel', 'guru_pengajar', 'created_at', 'updated_at'];


    public function getGuruPengajar()
    {
        $data_mapel = $this->db->table('mata_pelajaran')
            ->join('guru', 'guru.kode_guru = mata_pelajaran.guru_pengajar')
            ->get()->getResultArray();
        return $data_mapel;
    }

    public function getDataByKodeMapel($kode_mapel)
    {
        $data_mapel = $this->db->table('mata_pelajaran')
            ->join('guru', 'guru.kode_guru = mata_pelajaran.guru_pengajar')
            ->where('kode_mapel', $kode_mapel)->get()->getResultArray();
        return $data_mapel;
    }
}
