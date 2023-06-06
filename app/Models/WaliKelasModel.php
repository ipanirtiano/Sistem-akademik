<?php

namespace App\Models;

use CodeIgniter\Model;

class WaliKelasModel extends Model
{
    protected $table = 'wali_kelas';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_guru', 'created_at', 'updated_at'];

    public function getWaliKelas()
    {
        return $this->db->table('wali_kelas')
            ->join('guru', 'guru.kode_guru = wali_kelas.kode_guru')
            ->get()->getResultArray();
    }
}
