<?php

namespace App\Controllers;

use App\Database\Migrations\JadwalKelasGuru;
use App\Models\GuruModel;
use App\Models\JadwalKelasGuruModel;
use App\Models\JadwalModel;
use App\Models\KelasModel;
use App\Models\KelasSiswaModel;
use App\Models\MapelModel;
use App\Models\NilaiModel;
use CodeIgniter\HTTP\Request;

class Jadwal extends BaseController
{

    public function __construct()
    {
        $this->guruModel = new GuruModel();
        $this->mapelModel = new MapelModel();
        $this->kelasModel = new KelasModel();
        $this->jadwalModel = new JadwalModel();
        $this->jadwalKelasGuruModel = new JadwalKelasGuruModel();
        $this->kelasSiswaModel = new KelasSiswaModel();
        $this->nilaiModel = new NilaiModel();
    }

    public function tahun_ajaran_jadwal()
    {
        $tahun_ajaran = $this->request->getVar('tahun_ajaran');

        $tahun = base64_encode($tahun_ajaran);

        return redirect()->to(base_url('/admin/input-jadwal/' . $tahun));
    }


    public function buat_jadwal_pelajaran($tahun)
    {
        // ambil mata pelajaran
        $data_mapel = $this->mapelModel->findAll();

        // dd($this->mapelModel->getGuruPengajar());

        // deskripsion tahun
        $thn = base64_decode($tahun);

        $data = [
            'tittle' => 'Buat Jadwal Pelajaran',
            'validation' => \Config\Services::validation(),
            'kelas' => $this->kelasModel->getDataByYears($thn)
        ];

        return view('jadwal/buat_jadwal_pelajaran', $data);
    }

    public function jadwal_kelas($kode_kelas)
    {

        //generet kode kelas random 3 digit pertama
        $angka_kode1 = range(0, 9);
        shuffle($angka_kode1);
        $ambilKode1 = array_rand($angka_kode1, 3);
        $generetKode1 = implode('', $ambilKode1);

        // generate kode kelas random 3 digit kedua
        $angka_kode2 = range(0, 9);
        shuffle($angka_kode2);
        $ambilKode2 = array_rand($angka_kode2, 3);
        $generetKode2 = implode('', $ambilKode2);
        // kode kelas yang sudah di random
        $kode_jadwal = 'JDL-' . $generetKode1 . $generetKode2;

        // deskripsion kode kelas
        $kodeKelas = base64_decode($kode_kelas);

        // ambil data ruang kelas
        $ruang_kelas = $this->kelasModel->where('kode_kelas', $kodeKelas)->first();

        $data = [
            'tittle' => 'Buat Jadwal Pelajaran',
            'kode_jadwal' => $kode_jadwal,
            'mata_pelajaran' => $this->mapelModel->getGuruPengajar(),
            'validation' => \Config\Services::validation(),
            'kode_kelas' => $kodeKelas,
            'ruang_kelas' => $ruang_kelas,
            'jadwal' => $this->jadwalModel->findJadwalBykodeKelas($kodeKelas)
        ];

        return view('jadwal/jadwal_kelas', $data);
    }



    public function proses_input_jadwal($kode_kelas)
    {
        // deskripsion kode kelas
        $kodeKelas = base64_decode($kode_kelas);

        // validation form
        if (!$this->validate([
            'mapel' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Mata Pelajaran!'
                ]
            ],
            'semester' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Semester!'
                ]
            ],
            'hari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Hari!'
                ]
            ],
            'jam' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Jam Pelajaran!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/jadwal/' . $kode_kelas))->withInput();
        } else {

            // ambil data mata pelajaran
            $mapel = $this->mapelModel->where('kode_mapel', $this->request->getVar('mapel'))->first();
            $data_mapel = $mapel['nama_mapel'];
            // ambil kode_guru
            $kode_guru = $mapel['guru_pengajar'];

            // insert data kedalam table jadwal
            $this->jadwalModel->save([
                'kode_jadwal' => $this->request->getVar('kode_jadwal'),
                'kode_kelas' => $kodeKelas,
                'mata_pelajaran' => $data_mapel,
                'guru_pengajar' => $kode_guru,
                'hari' => $this->request->getVar('hari'),
                'jam_pelajaran' => $this->request->getVar('jam'),
                'smester' => $this->request->getVar('semester')
            ]);



            // insert data kedalam table kelas A
            $this->jadwalKelasGuruModel->save([
                'kode_jadwal' => $this->request->getVar('kode_jadwal'),
                'kode_guru' => $kode_guru,
                'kode_kelas' => $kodeKelas
            ]);

            session()->setFlashdata('pesan', 'Data Mata Jadwal berhasil di input!');
            return redirect()->to(base_url('/admin/jadwal/' . $kode_kelas));
        }
    }


    public function edit_jadwal($kode_jadwal, $kode_kelas)
    {
        // deskripsion kode jadwal
        $kodeJadwal = base64_decode($kode_jadwal);

        // deskripsion kode kelas
        $kodeKelas = base64_decode($kode_kelas);

        // ambil data guru dari table jadwal
        $data_jadwal = $this->jadwalModel->where('kode_jadwal', $kodeJadwal)->first();
        $data_guru = $data_jadwal['guru_pengajar'];


        $data = [
            'tittle' => 'Edit Data Jadwal',
            'data' => $this->jadwalModel->findJadwal($kodeJadwal),
            'kode_kelas' => $kode_kelas,
            'guru' => $this->guruModel->findAll(),
            'validation' => \Config\Services::validation(),
        ];

        return view('jadwal/edit_jadwal', $data);
    }


    public function proses_edit_jadwal($kode_jadwal, $kode_kelas)
    {
        // deskripsion kode jadwal
        $kodeJadwal = base64_decode($kode_jadwal);

        // deskripsion kode kelas
        $kodeKelas = base64_decode($kode_kelas);

        // ambil data guru dari table jadwal
        $data_jadwal = $this->jadwalModel->where('kode_jadwal', $kodeJadwal)->first();

        // ambil id data jadwal
        $id = $data_jadwal['id'];


        // validation form
        if (!$this->validate([
            'hari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Hari!'
                ]
            ],
            'jam' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Jam Pelajaran!'
                ]
            ],
            'semester' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Semester!'
                ]
            ]
        ])) {
            return redirect()->to(base_url('/admin/edit-jadwal/' . $kode_jadwal . '/' . $kode_kelas))->withInput();
        } else {
            // update data kedalam table jadwal
            $this->jadwalModel->save([
                'id' => $id,
                'kode_jadwal' => $this->request->getVar('kode_jadwal'),
                'kode_kelas' => $kodeKelas,
                'mata_pelajaran' => $this->request->getVar('mapel'),
                'guru_pengajar' => $this->request->getVar('guru_pengajar'),
                'hari' => $this->request->getVar('hari'),
                'jam_pelajaran' => $this->request->getVar('jam'),
                'smester' => $this->request->getVar('semester')
            ]);

            session()->setFlashdata('pesan', 'Data Mata Jadwal berhasil di Edit!');
            return redirect()->to(base_url('/admin/jadwal/' . $kode_kelas));
        }
    }


    public function hapus_jadwal($kode_jadwal, $kode_kelas)
    {
        // deskripsion kode jadwal
        $kodeJadwal = base64_decode($kode_jadwal);

        // hapus data jadwal berdasarkan kode jadwal
        $this->jadwalModel->where('kode_jadwal', $kodeJadwal)->delete();

        // hapus table jadwal kelas guru
        $this->jadwalKelasGuruModel->where('kode_jadwal', $kodeJadwal)->delete();

        session()->setFlashdata('pesan', 'Data Jadwal berhasil di Edit!');
        return redirect()->to(base_url('/admin/jadwal/' . $kode_kelas));
    }


    public function jadwal_guru($kode_guru)
    {
        // desdkripsi kode guru dari parameter
        $kodeGuru = base64_decode($kode_guru);

        // get data jadwal guru
        $jadwal = $this->jadwalModel->where('guru_pengajar', $kodeGuru)->findAll();

        // get data guru
        $data_guru = $this->guruModel->where('kode_guru', $kodeGuru)->first();
        $guru_pengajar = $data_guru['nama_lengkap'];

        $data = [
            'tittle' => 'Data Jadwal',
            'jadwal' => $jadwal,
            'guru_pengajar' => $guru_pengajar,
            'kode_guru' => $kodeGuru
        ];

        return view('jadwal/jadwal_guru', $data);
    }


    public function jadwal_siswa($kode_siswa)
    {
        // desdkripsi kode guru dari parameter
        $kodeSiswa = base64_decode($kode_siswa);

        // ambil kelas
        $data_kelas = $this->kelasSiswaModel->where('kode_siswa', $kodeSiswa)->first();
        $kode_kelas = $data_kelas['kode_kelas'];

        // get data jadwal guru
        $jadwal = $this->jadwalModel->where('kode_kelas', $kode_kelas)->findAll();

        $data = [
            'tittle' => 'Data Jadwal',
            'jadwal' => $jadwal,
            'kode_siswa' => $kodeSiswa
        ];

        return view('jadwal/jadwal_siswa', $data);
    }


    public function krs_siswa($kode_siswa)
    {
        // deskripsi
        $kodeSiswa = base64_decode($kode_siswa);

        // ambil data kelas
        $data_kelas = $this->kelasSiswaModel->where('kode_siswa', $kodeSiswa)->first();
        // ambil kode kelas
        $kode_kelas = $data_kelas['kode_kelas'];

        // ambil data jadwal
        $data_mapel = $this->jadwalModel->where('kode_kelas', $kode_kelas)->findAll();

        $data = [
            'tittle' => 'KRS',
            'data_mapel' => $data_mapel,
            'kode_kelas' => $kode_kelas,

        ];

        return view('siswa/krs', $data);
    }
}
