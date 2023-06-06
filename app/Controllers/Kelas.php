<?php

namespace App\Controllers;

use App\Models\GuruModel;
use App\Models\JadwalKelasGuruModel;
use App\Models\JadwalModel;
use App\Models\KelasModel;
use App\Models\KelasSiswaModel;
use App\Models\SiswaBaruModel;
use App\Models\SiswaModel;
use App\Models\WaliKelasModel;
use App\Models\kelasA_Model;
use App\Models\kelasB_Model;
use App\Models\kelasC_Model;
use CodeIgniter\HTTP\Request;

class Kelas extends BaseController
{
    public function __construct()
    {
        $this->guruModel = new GuruModel();
        $this->kelasModel = new KelasModel();
        $this->walikelasModel = new WaliKelasModel();
        $this->siswaBaruModel = new SiswaBaruModel();
        $this->siswaModel = new SiswaModel();
        $this->kelasSiswaModel = new KelasSiswaModel();
        $this->jadwalModel = new JadwalModel();
        $this->jadwalKelasGuruModel = new JadwalKelasGuruModel();
    }

    public function ruang_kelas($tahun)
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
        $kode_kelas = 'KLS-' . $generetKode1 . $generetKode2;
        // data tahun yang di decrypt

        // deskripsion tahun
        $thn = base64_decode($tahun);

        $data = [
            'tittle' => 'Registrasi Ruang Kelas',
            'data_guru' => $this->walikelasModel->getWaliKelas(),
            'validation' => \Config\Services::validation(),
            'kode_kelas' => $kode_kelas,
            'kelas' => $this->kelasModel->getDataByYears($thn),
            'ruang_kelas' => $this->kelasModel->findAll()
        ];

        return view('kelas/ruang_kelas', $data);
    }


    public function proses_ruang_kelas()
    {
        // encripsi tahun untuk return redirect link
        $tahun = base64_encode($now = date('Y'));

        if (!$this->validate([
            'kode_kelas' => [
                'rules' => 'is_unique[kelas.kode_kelas]|required|max_length[10]|min_length[10]',
                'errors' => [
                    'is_unique' => 'Kode Kelas sudah terdaftar!',
                    'required' => 'Kolom Kode Kelas harus dilengkapi!',
                    'max_length' => 'Nomor Kode Kelas harus 10 digit angka!',
                    'min_length' => 'Nomor Kode Kelas harus 10 digit angka!',
                ]
            ],
            'tingkat_kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Kelas harus dilengkapi!',
                ]
            ],
            'ruang_kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Ruang Kelas harus dilengkapi!',
                ]
            ],
            'wali_kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Wali Kelas harus dilengkapi!',
                ]
            ],
        ])) {

            return redirect()->to(base_url('/admin/ruang-kelas/' . $tahun))->withInput();
        } else {
            // buat slug kelas yang akan di daftarkan.
            $slug = $this->request->getVar('tingkat_kelas') . $this->request->getVar('ruang_kelas') . $tahun;
            //cek kelas apakah kelas sudah terdaftar?
            $kelas = $this->kelasModel->where('slug', $slug)->first();
            if ($kelas) {
                session()->setFlashdata('pesan_gagal', 'Kelas yang anda masukan sudah terdaftar!');
                return redirect()->to(base_url('/admin/ruang-kelas/' . $tahun));
            } else {
                $kode_guru = $this->request->getVar('wali_kelas');
                $this->kelasModel->save([
                    'kode_kelas' => $this->request->getVar('kode_kelas'),
                    'slug' => $slug,
                    'ruang_kelas' => $this->request->getVar('ruang_kelas'),
                    'tingkat' => $this->request->getVar('tingkat_kelas'),
                    'wali_kelas' => $kode_guru,
                    'tahun' => $this->request->getVar('tahun')
                ]);

                $this->walikelasModel->where('kode_guru', $kode_guru)->delete();

                session()->setFlashdata('pesan', 'Data Kelas berhasil di input!');
                return redirect()->to(base_url('/admin/ruang-kelas/' . $tahun));
            }
        }
    }


    public function data_kelas($tahun)
    {

        // deskripsion tahun
        $thn = base64_decode($tahun);

        $data = [
            'tittle' => 'Data Kelas',
            'kelas' => $this->kelasModel->getDataByYears($thn),
        ];

        return view('kelas/data_kelas', $data);
    }


    public function data_kelas_siswa($kode_kelas)
    {
        $pager = \Config\Services::pager();

        // deskripsion tahun
        $kodeKelas = base64_decode($kode_kelas);

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
            'kode_kelas' => $kode_kelas
        ];

        return view('kelas/data_kelas_siswa', $data);
    }


    public function detail_kelas_siswa($kode_siswa, $kode_kelas)
    {
        // data kode guru yang di decrypt
        $kodeSiswa = base64_decode($kode_siswa);

        // data tahun enkripsi
        $tahun = base64_encode($now = date('Y'));

        // data tahun encode
        $thn = base64_decode($tahun);

        $data = [
            'tittle' => 'Detail Siswa',
            'data_siswa' => $this->siswaModel->getDataSiswaById($kodeSiswa),
            'kode_kelas' => $kode_kelas
        ];

        return view('kelas/detail_kelas_siswa', $data);
    }


    public function tahun_ajaran()
    {
        $tahun_ajaran = $this->request->getVar('tahun_ajaran');

        $tahun = base64_encode($tahun_ajaran);

        return redirect()->to(base_url('/admin/ruang-kelas/' . $tahun));
    }



    public function kelas_siswa($kode_kelas)
    {
        // data tahun yang di decrypt
        $kelas = base64_decode($kode_kelas);

        //kelas siswa
        $kelas_siswa = $this->kelasModel->findKelasByKode($kelas);

        // hitung jumlah siswa baru
        $jumlah_siswa = $this->siswaBaruModel->getJumlahData();

        $data = [
            'tittle' => 'Kelas Siswa',
            'validation' => \Config\Services::validation(),
            'siswa' => $this->kelasSiswaModel->findbyKodeKelas($kelas),
            'siswa_baru' => $this->siswaBaruModel->findAll(),
            'kelas_siswa' => $kelas_siswa,
            'wali_kelas' => $this->guruModel->findGuruByKode($kelas_siswa['wali_kelas']),
            'jumlah_siswa' => $jumlah_siswa
        ];

        return view('kelas/kelas_siswa', $data);
    }


    public function input_siswa_baru($kelas)
    {
        // form validation
        if (!$this->validate([
            'jumlah_siswa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Kelas harus dilengkapi!',
                ]
            ]
        ])) {
            // kembalikan ke halaman kelas
            return redirect()->to(base_url('/admin/kelas/' . $kelas))->withInput();
        } else {
            // ambil jumlah siswa dari inputan
            $jumlah = $this->request->getVar('jumlah_siswa');

            // ambil seluruh jumlah siswa baru dari database
            $jumlah_siswa = $this->siswaBaruModel->getJumlahData();

            // cek apakah siswa yg akan diinput melebihi jumlah siswa baru?
            if ($jumlah > $jumlah_siswa) {
                session()->setFlashdata('pesan_gagal', 'Jumlah siswa yang ingin anda masukan tidak mencukupi!');
                return redirect()->to(base_url('/admin/kelas/' . $kelas))->withInput();
            } else {
                // ambil random data dari table siswa baru
                $kelas_siswa = $this->siswaBaruModel->getRandomData($jumlah);

                // dekripsi kode kelas
                $kode_kelas = base64_decode($kelas);


                // looping data siswa random
                foreach ($kelas_siswa as $siswa) {
                    // insert data kedalam table kelas siswa
                    $this->kelasSiswaModel->save([
                        'kode_kelas' => $kode_kelas,
                        'kode_siswa' => $siswa['kode_siswa']
                    ]);

                    // insert data siswa baru kedalam table siswa setelah masuk kelas
                    $this->siswaModel->save([
                        'kode_siswa' => $siswa['kode_siswa'],
                        'nis' => $siswa['nis'],
                        'nama_lengkap' => $siswa['nama_lengkap'],
                        'tempat_lahir' => $siswa['tempat_lahir'],
                        'tanggal_lahir' => $siswa['tanggal_lahir'],
                        'jenis_kelamin' => $siswa['jenis_kelamin'],
                        'agama' => $siswa['agama'],
                        'alamat' => $siswa['alamat'],
                        'email' => $siswa['email'],
                        'no_telpon' => $siswa['no_telpon'],
                        'nama_asal_sekolah' => '',
                        'alamat_asal_sekolah' => '',
                        'nomor_ijazah' => '',
                        'tahun_ijazah' => '',
                        'nomor_skhun' => '',
                        'tahun_skhun' => '',
                        'nama_ayah' => '',
                        'nama_ibu' => '',
                        'alamat_orangtua' => '',
                        'telpon_orangtua' => '',
                        'pekerjaan_ayah' => '',
                        'pekerjaan_ibu' => '',
                        'foto' => 'default.jpg'
                    ]);

                    // ambil kode siswa untuk di hapus di dalam table siswa baru
                    $kode_siswa = $siswa['kode_siswa'];
                    // setelah input kedalam kelas siswa data nya hapus didalam table siswa baru
                    $this->siswaBaruModel->delete_multiple($kode_siswa);
                }
                session()->setFlashdata('pesan', 'Data siswa berhasil ditambahkan!');
                return redirect()->to(base_url('/admin/kelas/' . $kelas))->withInput();
            }
        }
    }


    public function input_siswa_baru_manual($kelas)
    {
        // ambil kode kelas dari parameter lalu di enkripsi
        $kode_kelas = base64_decode($kelas);
        // ambil NIS siswa dari inputan
        $nis = $this->request->getVar('nis');
        // query nis kedalam database siswa
        $data_siswa = $this->siswaBaruModel->where('nis', $nis)->first();

        // cek apakah NIS siswa tersedia di dalam database ?
        if ($data_siswa) {
            // ambil kode siswa
            $kode_siswa = $data_siswa['kode_siswa'];


            // insert data kode kelas kedalam table kelas siswa
            $this->kelasSiswaModel->save([
                'kode_kelas' => $kode_kelas,
                'kode_siswa' => $kode_siswa
            ]);

            // insert data siswa baru kedalam table siswa setelah masuk kelas
            $this->siswaModel->save([
                'kode_siswa' => $data_siswa['kode_siswa'],
                'nis' => $data_siswa['nis'],
                'nama_lengkap' => $data_siswa['nama_lengkap'],
                'tempat_lahir' => $data_siswa['tempat_lahir'],
                'tanggal_lahir' => $data_siswa['tanggal_lahir'],
                'jenis_kelamin' => $data_siswa['jenis_kelamin'],
                'agama' => $data_siswa['agama'],
                'alamat' => $data_siswa['alamat'],
                'email' => $data_siswa['email'],
                'no_telpon' => $data_siswa['no_telpon'],
                'nama_asal_sekolah' => '',
                'alamat_asal_sekolah' => '',
                'nomor_ijazah' => '',
                'tahun_ijazah' => '',
                'nomor_skhun' => '',
                'tahun_skhun' => '',
                'nama_ayah' => '',
                'nama_ibu' => '',
                'alamat_orangtua' => '',
                'telpon_orangtua' => '',
                'pekerjaan_ayah' => '',
                'pekerjaan_ibu' => '',
                'foto' => 'default.jpg'
            ]);

            // setelah insert kedalam table kelas siswa hapus data nya dari table siswa baru
            $this->siswaBaruModel->deleteSiswa($kode_siswa);

            session()->setFlashdata('pesan', 'Data siswa berhasil ditambahkan!');
            return redirect()->to(base_url('/admin/kelas/' . $kelas))->withInput();
        } else {
            // jika kode siswa tidak tersedia
            session()->setFlashdata('pesan_gagal', 'Siswa tidak terdaftar!');
            return redirect()->to(base_url('/admin/kelas/' . $kelas))->withInput();
        }
    }


    public function hapus_siswa($kode_siswa)
    {
        // ambil kode siswa dari parameter lalu di enkripsi
        $kodeSiswa = base64_decode($kode_siswa);

        // ambil kode kelas
        $kode_kelas = $this->kelasSiswaModel->where('kode_siswa', $kodeSiswa)->first();


        // cek apakah kode siswa tersedia didalam table kelas siswa?
        if ($kode_kelas) {
            $kodeKelas = $kode_kelas['kode_kelas'];

            // enkripsi kode kelas 
            $kelas = base64_encode($kodeKelas);

            // ambil data dari table kelas
            $data_siswa = $this->siswaModel->where('kode_siswa', $kodeSiswa)->first();

            // sebelum dihapus insert dulu datanya kedalam table siswa baru
            $this->siswaBaruModel->save([
                'kode_siswa' => $data_siswa['kode_siswa'],
                'nis' => $data_siswa['nis'],
                'nama_lengkap' => $data_siswa['nama_lengkap'],
                'tempat_lahir' => $data_siswa['tempat_lahir'],
                'tanggal_lahir' => $data_siswa['tanggal_lahir'],
                'jenis_kelamin' => $data_siswa['jenis_kelamin'],
                'agama' => $data_siswa['agama'],
                'alamat' => $data_siswa['alamat'],
                'email' => $data_siswa['email'],
                'no_telpon' => $data_siswa['no_telpon'],
                'foto' => $data_siswa['foto']
            ]);

            // hapus siswa dari table kelas siswa
            $this->kelasSiswaModel->delete_siswa_manual($kodeSiswa);

            // hapus dari table siswa
            $this->siswaModel->delete_siswa_manual($kodeSiswa);

            session()->setFlashdata('pesan', 'Data siswa berhasil dihapus!');
            return redirect()->to(base_url('/admin/kelas/' . $kelas))->withInput();
        } else {
            // jika kode siswa tidak tersedia
            session()->setFlashdata('pesan_gagal', 'Siswa tidak terdaftar!');
            return redirect()->to(base_url('/admin/kelas/' . $kelas))->withInput();
        }
    }


    // aktor guru
    public function kelas_guru()
    {
        // ambil kode guru
        $kode_guru = session('kode_guru');

        // ambil jadwal kelas
        $jadwal = $this->jadwalKelasGuruModel->where('kode_guru', $kode_guru)->findAll();

        $data = [
            'tittle' => 'Data Kelas',
            'jadwal' => $jadwal
        ];

        return view('kelas/kelas_guru', $data);
    }


    public function data_kelas_guru($kode_kelas)
    {
        // ambil kode kelas dari parameter lalu di enkripsi
        $kodeKelas = base64_decode($kode_kelas);
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
            'kode_kelas' => $kode_kelas
        ];

        return view('kelas/data_kelas_guru', $data);
    }
}
