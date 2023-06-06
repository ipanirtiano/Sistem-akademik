<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 'kelas';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_kelas', 'slug', 'ruang_kelas', 'tingkat', 'wali_kelas', 'tahun',  'created_at', 'updated_at'];

    public function getDataByYears($thn)
    {
        return $this->table('kelas')->like('tahun', $thn)->orderBy('ruang_kelas', 'ASC')->findAll();
    }
    public function getDataKelas($ruang_kelas)
    {
        return $this->table('kelas')->like('tingkat', $ruang_kelas)->orderBy('ruang_kelas', 'ASC')->findAll();
    }
    public function findKelasByKode($kode_kelas)
    {
        return $this->table('kelas')->where('kode_kelas', $kode_kelas)->first();
    }
}
