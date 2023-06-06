<?php

namespace App\Controllers;

use App\Models\GuruModel;
use App\Models\JadwalKelasGuruModel;
use App\Models\JadwalModel;
use App\Models\KelasModel;
use App\Models\KelasSiswaModel;
use App\Models\MapelModel;
use App\Models\NilaiModel;
use App\Models\SiswaModel;

class Nilai extends BaseController
{
    public function __construct()
    {
        $this->jadwalKelasGuruModel = new JadwalKelasGuruModel();
        $this->kelasModel = new KelasModel();
        $this->kelasSiswaModel = new KelasSiswaModel();
        $this->siswaModel = new SiswaModel();
        $this->mapelModel = new MapelModel();
        $this->guruModel = new GuruModel();
        $this->jadwalModel = new JadwalModel();
        $this->nilaiModel = new NilaiModel();
    }

    public function kelas()
    {
        // ambil kode guru
        $kode_guru = session('kode_guru');

        // ambil jadwal kelas
        $jadwal = $this->jadwalKelasGuruModel->where('kode_guru', $kode_guru)->findAll();


        $data = [
            'tittle' => 'Data Kelas',
            'jadwal' => $jadwal
        ];

        return view('nilai/kelas', $data);
    }

    public function siswa($kode_kelas, $kode_guru)
    {
        // ambil kode kelas dari parameter lalu di enkripsi
        $kodeKelas = base64_decode($kode_kelas);
        $kodeGuru = base64_decode($kode_guru);
        $pager = \Config\Services::pager();

        //kelas siswa
        $kelas_siswa = $this->kelasModel->findKelasByKode($kodeKelas);

        //find data kelas
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $data_siswa = $this->kelasSiswaModel->cariDataSiswa_kelas($keyword);
        } else {
            $data_siswa = $this->kelasSiswaModel->findbyKodeKelas($kodeKelas);
        }

        $data = [
            'tittle' => 'Data Kelas Siswa',
            'siswa' => $data_siswa,
            'kelas_siswa' => $kelas_siswa,
            'kode_kelas' => $kode_kelas,
            'kode_guru' => $kodeGuru
        ];

        return view('nilai/data_kelas_siswa', $data);
    }

    public function input_nilai_siswa($kode_siswa, $kode_guru, $kode_kelas)
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
        $kode_nilai = 'SCR-' . $generetKode1 . $generetKode2;

        // enksripsi data dari parameter
        $kodeSiswa = base64_decode($kode_siswa);
        $kodeGuru = base64_decode($kode_guru);
        $kodeKelas = base64_decode($kode_kelas);

        // ambil data siswa
        $data_siswa = $this->siswaModel->where('kode_siswa', $kodeSiswa)->first();

        // ambil guru pengajar
        $data_guru = $this->guruModel->where('kode_guru', $kodeGuru)->first();

        // ambil data mata pelajaran
        $data_mapel = $this->mapelModel->where('guru_pengajar', $kodeGuru)->findAll();

        //cek apakah matkul tersebut di ajar di kelas yang ingin di inputkan nilai?
        $data_jadwal = $this->jadwalModel->where('kode_kelas', $kodeKelas)->findAll();



        $data = [
            'tittle' => 'Input Nilai',
            'data_siswa' => $data_siswa,
            'data_guru' => $data_guru,
            'data_mapel' => $data_mapel,
            'kode_kelas' => $kodeKelas,
            'kode_guru' => $kodeGuru,
            'input_mapel' => $this->request->getVar('mapel'),
            'data_jadwal' => $data_jadwal,
            'kode_nilai' => $kode_nilai
        ];

        return view('nilai/input_nilai', $data);
    }

    public function proses_input_nilai($kode_siswa, $kode_guru, $kode_kelas)
    {
        // enksripsi data dari parameter
        $kodeSiswa = base64_decode($kode_siswa);
        $kodeGuru = base64_decode($kode_guru);
        $kodeKelas = base64_decode($kode_kelas);

        $hadir = $this->request->getVar('nilai_hadir') * 0.1;
        $tugas = $this->request->getVar('nilai_tugas') * 0.2;
        $uts = $this->request->getVar('nilai_uts') * 0.3;
        $uas = $this->request->getVar('nilai_uas') * 0.4;

        $nilai_akhir = $hadir + $tugas + $uts + $uas;

        // menentukan grade nilai
        $grade = '';
        if ($nilai_akhir >= 80 && $nilai_akhir <= 100) {
            $grade = 'A';
        }
        if ($nilai_akhir >= 70 && $nilai_akhir < 80) {
            $grade = 'B';
        }
        if ($nilai_akhir >= 50 && $nilai_akhir < 70) {
            $grade = 'C';
        }
        if ($nilai_akhir >= 40 && $nilai_akhir < 50) {
            $grade = 'D';
        }
        if ($nilai_akhir < 40) {
            $grade = 'E';
        }

        // insert data kedalam table nilai siswa
        $this->nilaiModel->save([
            'kode_nilai' => $this->request->getVar('kode_nilai'),
            'kode_siswa' => $this->request->getVar('kode_siswa'),
            'kode_guru' => $kodeGuru,
            'kode_kelas' => $kodeKelas,
            'mapel' => $this->request->getVar('mapel'),
            'nilai_hadir' => $this->request->getVar('nilai_hadir'),
            'nilai_tugas' => $this->request->getVar('nilai_tugas'),
            'nilai_uts' => $this->request->getVar('nilai_uts'),
            'nilai_uas' => $this->request->getVar('nilai_uas'),
            'nilai_akhir' => $nilai_akhir,
            'grade' => $grade,
            'semester' => $this->request->getVar('semester'),
        ]);

        session()->setFlashdata('pesan', 'Input Nilai Siswa Berhasil');
        return redirect()->to(base_url('/views/siswa/' . $kode_kelas . "/" . $kode_guru));
    }


    public function kelas2()
    {
        // ambil kode guru
        $kode_guru = session('kode_guru');

        // ambil jadwal kelas
        $jadwal = $this->jadwalKelasGuruModel->where('kode_guru', $kode_guru)->findAll();


        $data = [
            'tittle' => 'Data Kelas',
            'jadwal' => $jadwal
        ];

        return view('nilai/kelas2', $data);
    }


    public function data_siswa($kode_kelas, $kode_guru)
    {
        // ambil kode kelas dari parameter lalu di enkripsi
        $kodeKelas = base64_decode($kode_kelas);
        $kodeGuru = base64_decode($kode_guru);
        $pager = \Config\Services::pager();

        //kelas siswa
        $kelas_siswa = $this->kelasModel->findKelasByKode($kodeKelas);

        //find data kelas
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $data_siswa = $this->kelasSiswaModel->cariDataSiswa_kelas($keyword);
        } else {
            $data_siswa = $this->kelasSiswaModel->findbyKodeKelas($kodeKelas);
        }

        $data = [
            'tittle' => 'Data Kelas Siswa',
            'siswa' => $data_siswa,
            'kelas_siswa' => $kelas_siswa,
            'kode_kelas' => $kode_kelas,
            'kode_guru' => $kodeGuru
        ];

        return view('nilai/data_siswa', $data);
    }


    public function data_nilai_siswa($kode_siswa, $kode_guru, $kode_kelas)
    {
        // enksripsi data dari parameter
        $kodeSiswa = base64_decode($kode_siswa);
        $kodeGuru = base64_decode($kode_guru);
        $kodeKelas = base64_decode($kode_kelas);

        // ambil data siswa
        $data_siswa = $this->siswaModel->where('kode_siswa', $kodeSiswa)->first();

        // ambil data nilai
        $data_nilai = $this->nilaiModel->where('kode_siswa', $kodeSiswa)->findAll();

        // ambil data kelas
        $data_kelas = $this->kelasModel->where('kode_kelas', $kodeKelas)->first();
        $ruang_kelas = $data_kelas['tingkat'] . " " . $data_kelas['ruang_kelas'];

        $data = [
            'tittle' => 'Data Nilai Siswa',
            'data_siswa' => $data_siswa,
            'kode_kelas' => $kodeKelas,
            'kode_guru' => $kodeGuru,
            'data_nilai' => $data_nilai,
            'ruang_kelas' => $ruang_kelas
        ];

        return view('nilai/data_nilai_siswa', $data);
    }


    public function edit_nilai($kode_nilai)
    {
        // deskripsi kode nilai
        $kodeNilai = base64_decode($kode_nilai);
        // ambil data nilai
        $data_nilai = $this->nilaiModel->where('kode_nilai', $kodeNilai)->first();
        // ambil kode guru
        $kode_guru = $data_nilai['kode_guru'];
        // relasi ke dalam table guru
        $data_guru = $this->guruModel->where('kode_guru', $kode_guru)->first();
        // ambil kode kelas
        $kode_kelas = $data_nilai['kode_kelas'];
        // relasi kedalam table kelas
        $data_kelas = $this->kelasModel->where('kode_kelas', $kode_kelas)->first();
        // ambil kode siswa
        $kode_siswa = $data_nilai['kode_siswa'];
        $data_siswa = $this->siswaModel->where('kode_siswa', $kode_siswa)->first();

        $data = [
            'tittle' => 'Edit Data Nilai',
            'data_nilai' => $data_nilai,
            'data_guru' => $data_guru,
            'data_kelas' => $data_kelas,
            'kode_siswa' => $kode_siswa,
            'data_siswa' => $data_siswa,
            'kode_guru' => $kode_guru,
            'kode_kelas' => $kode_kelas,
            'validation' => \Config\Services::validation(),
        ];

        return view('nilai/edit_nilai', $data);
    }


    public function proses_edit_nilai($kode_nilai, $kode_siswa, $kode_guru, $kode_kelas)
    {
        // enksripsi data dari parameter
        $kodeNilai = base64_decode($kode_nilai);

        // mencari nilai akhir
        $hadir = $this->request->getVar('nilai_hadir') * 0.1;
        $tugas = $this->request->getVar('nilai_tugas') * 0.2;
        $uts = $this->request->getVar('nilai_uts') * 0.3;
        $uas = $this->request->getVar('nilai_uas') * 0.4;

        $nilai_akhir = $hadir + $tugas + $uts + $uas;

        // menentukan grade nilai
        $grade = '';
        if ($nilai_akhir >= 80 && $nilai_akhir <= 100) {
            $grade = 'A';
        }
        if ($nilai_akhir >= 70 && $nilai_akhir < 80) {
            $grade = 'B';
        }
        if ($nilai_akhir >= 50 && $nilai_akhir < 70) {
            $grade = 'C';
        }
        if ($nilai_akhir >= 40 && $nilai_akhir < 50) {
            $grade = 'D';
        }
        if ($nilai_akhir < 40) {
            $grade = 'E';
        }

        // ambil data jadwal
        $data_nilai = $this->nilaiModel->where('kode_nilai', $kodeNilai)->first();
        // ambil ID data nilai
        $id = $data_nilai['id'];

        // validasi form
        if (!$this->validate([
            'nilai_hadir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nilai Hadir Harus Dilengkapi!'
                ]
            ],
            'nilai_tugas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nilai Tugas Harus Dilengkapi!'
                ]
            ],
            'nilai_uts' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nilai UTS Harus Dilengkapi!'
                ]
            ],
            'nilai_uas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nilai UAS Harus Dilengkapi!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('views/edit-nilai/' . $kodeNilai));
        } else {
            // update data nilai ke dalam table nilai
            $this->nilaiModel->save([
                'id' => $id,
                'kode_nilai' => $kodeNilai,
                'kode_siswa' => $this->request->getVar('kode_siswa'),
                'kode_guru' => $this->request->getVar('kode_guru'),
                'kode_kelas' => $this->request->getVar('kode_kelas'),
                'mapel' => $this->request->getVar('mapel'),
                'nilai_hadir' => $this->request->getVar('nilai_hadir'),
                'nilai_tugas' => $this->request->getVar('nilai_tugas'),
                'nilai_uts' => $this->request->getVar('nilai_uts'),
                'nilai_uas' => $this->request->getVar('nilai_uas'),
                'nilai_akhir' => $nilai_akhir,
                'grade' => $grade
            ]);
        }
        session()->setFlashdata('pesan', 'Data Nilai berhasil di Edit!');
        return redirect()->to(base_url('/views/data-nilai/' . $kode_siswa . "/" . $kode_guru . "/" . $kode_kelas));
    }


    public function hapus_nilai($kode_nilai, $kode_siswa, $kode_guru, $kode_kelas)
    {
        // enksripsi data dari parameter
        $kodeNilai = base64_decode($kode_nilai);

        // hapus nilai dari table nilai
        $this->nilaiModel->where('kode_nilai', $kodeNilai)->delete();

        session()->setFlashdata('pesan', 'Data Nilai berhasil di Hapus!');
        return redirect()->to(base_url('/views/data-nilai/' . $kode_siswa . "/" . $kode_guru . "/" . $kode_kelas));
    }


    public function khs_siswa($kode_siswa)
    {
        // deskripsi 
        $kodeSiswa = base64_decode($kode_siswa);

        // ambil data nilai
        $data_nilai = $this->nilaiModel->where('kode_siswa', $kodeSiswa)->findAll();

        // ambil data siswa
        $data_siswa = $this->siswaModel->where('kode_siswa', $kodeSiswa)->first();

        // ambil data kelas
        $data_kelas = $this->kelasSiswaModel->where('kode_siswa', $kodeSiswa)->first();
        $kode_kelas = $data_kelas['kode_kelas'];
        $kelas = $this->kelasModel->where('kode_kelas', $kode_kelas)->first();
        $ruang_kelas = $kelas['tingkat'] . " " . $kelas['ruang_kelas'];

        $data = [
            'tittle' => 'KHS',
            'data_nilai' => $data_nilai,
            'data_siswa' => $data_siswa,
            'ruang_kelas' => $ruang_kelas
        ];

        return view('nilai/khs', $data);
    }
}
