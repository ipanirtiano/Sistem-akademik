<?php

namespace App\Controllers;

use TCPDF;

use CodeIgniter\Config\Config;
use App\Models\AdminModel;
use App\Models\AuthModel;
use App\Models\GuruModel;
use App\Models\SiswaBaruModel;
use App\Models\SiswaModel;
use CodeIgniter\HTTP\Request;

class Siswa extends BaseController
{
    public function __construct()
    {
        $this->authModel = new AuthModel();
        $this->adminModel = new AdminModel();
        $this->guruModel = new GuruModel();
        $this->siswaModel = new SiswaModel();
        $this->siswaBaru = new SiswaBaruModel();
    }

    // Registrasi Siswa
    public function registrasi_siswa()
    {
        //generate NIS random siswa
        $tgl = date('ym');
        //genetate angka random 3 digit pertama setelah tahun dan bulan
        $angka_nis1 = range(0, 9);
        shuffle($angka_nis1);
        $ambilKode_nis1 = array_rand($angka_nis1, 3);
        $generetKode_nis1 = implode('', $ambilKode_nis1);

        // generate angka random 3 digit kedua setelah tahun dan bulan
        $angka_nis2 = range(0, 9);
        shuffle($angka_nis2);
        $ambilKode_nis2 = (array_rand($angka_nis2, 3));
        $generetKode_nis2 = implode('', $ambilKode_nis2);
        // NIK yang setelah di random
        $nis = $tgl . $generetKode_nis1 . $generetKode_nis2;

        //generet kode siswa random 3 digit pertama
        $angka_kode1 = range(0, 9);
        shuffle($angka_kode1);
        $ambilKode1 = array_rand($angka_kode1, 3);
        $generetKode1 = implode('', $ambilKode1);
        // generate kode siswa random 3 digit kedua
        $angka_kode2 = range(0, 9);
        shuffle($angka_kode2);
        $ambilKode2 = array_rand($angka_kode2, 3);
        $generetKode2 = implode('', $ambilKode2);
        // kode siswa yang sudah di random
        $kode_siswa = 'KDS-' . $generetKode1 . $generetKode2;

        $data = [
            'tittle' => 'Registrasi Siswa',
            'nis' => $nis,
            'kode_siswa' => $kode_siswa,
            'validation' => \Config\Services::validation()
        ];
        return view('siswa/registration_siswa', $data);
    }

    public function proses_regis_siswa()
    {
        // menambahkan 0 pada tanggal dari form input
        $add_tanggal = '';
        // menambahkan 0 pada tanggal
        if ($this->request->getVar('tanggal') < 10) {
            $add_tanggal = '0';
        }

        // merubah string dari bulan menjadi angka
        $bulan = '';
        if ($this->request->getVar('bulan') == 'Januari') {
            $bulan = '01';
        }
        if ($this->request->getVar('bulan') == 'Februari') {
            $bulan = '02';
        }
        if ($this->request->getVar('bulan') == 'Maret') {
            $bulan = '03';
        }
        if ($this->request->getVar('bulan') == 'April') {
            $bulan = '04';
        }
        if ($this->request->getVar('bulan') == 'Mei') {
            $bulan = '05';
        }
        if ($this->request->getVar('bulan') == 'Juni') {
            $bulan = '06';
        }
        if ($this->request->getVar('bulan') == 'Juli') {
            $bulan = '07';
        }
        if ($this->request->getVar('bulan') == 'Agustus') {
            $bulan = '08';
        }
        if ($this->request->getVar('bulan') == 'September') {
            $bulan = '09';
        }
        if ($this->request->getVar('bulan') == 'Oktober') {
            $bulan = '10';
        }
        if ($this->request->getVar('bulan') == 'November') {
            $bulan = '11';
        }
        if ($this->request->getVar('bulan') == 'Desember') {
            $bulan = '12';
        }
        // mengurangi dua angka pertama pada tahun
        $tahun = substr($this->request->getVar('tahun'), -2);

        // validasi form input data guru
        if (!$this->validate([
            'nis' => [
                'rules' => 'is_unique[siswa.nis]|required|max_length[10]|min_length[10]|numeric',
                'errors' => [
                    'is_unique' => 'NIS sudah terdaftar!',
                    'required' => 'Kolom NIS harus dilengkapi!',
                    'max_length' => 'Nomor NIS harus 10 digit angka!',
                    'min_length' => 'Nomor NIS harus 10 digit angka!',
                    'numeric' => 'Kolom NIS harus berupa 10 digit angka!'
                ]
            ],
            'kode_siswa' => [
                'rules' => 'is_unique[siswa.kode_siswa]|required|max_length[10]|min_length[10]',
                'errors' => [
                    'is_unique' => 'Kode Siswa sudah terdaftar!',
                    'required' => 'Kolom Kode Siswa harus dilengkapi!',
                    'max_length' => 'Nomor Kode Siswa harus 10 digit angka!',
                    'min_length' => 'Nomor Kode Siswa harus 10 digit angka!',
                ]
            ],
            'namaLengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Nama Lengkap harus dilengkapi!'
                ]
            ],
            'tempat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tempat harus dilengkapi!'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus dilengkapi!'
                ]
            ],
            'bulan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bulan harus dilengkapi!'
                ]
            ],
            'tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun harus dilengkapi!'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin harus dilengkapi!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/registration-siswa'))->withInput();
        } else {
            // $tanggal = $add_tanggal . $this->request->getVar('tanggal');
            // echo $tanggal . $bulan . $tahun;

            // generet tanggal dari form input
            $ttl = $add_tanggal . $this->request->getVar('tanggal') . " " . $this->request->getVar('bulan') . " " . $this->request->getVar('tahun');


            // insert data kedalam table siswa baru
            $this->siswaBaru->save([
                'kode_siswa' => $this->request->getVar('kode_siswa'),
                'nis' => $this->request->getVar('nis'),
                'nama_lengkap' => $this->request->getVar('namaLengkap'),
                'tempat_lahir' => $this->request->getVar('tempat'),
                'tanggal_lahir' => $ttl,
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                'agama' => '',
                'alamat' => $this->request->getVar('alamat'),
                'email' => '',
                'no_telpon' => '',
            ]);

            // // Insert data kedalam table siswa
            // $this->siswaModel->save([
            //     'nis' => $this->request->getVar('nis'),
            //     'kode_siswa' => $this->request->getVar('kode_siswa'),
            //     'nama_lengkap' => $this->request->getVar('namaLengkap'),
            //     'tempat_lahir' => $this->request->getVar('tempat'),
            //     'tanggal_lahir' => $ttl,
            //     'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            //     'agama' => '',
            //     'alamat' => $this->request->getVar('alamat'),
            //     'email' => '',
            //     'no_telpon' => '',
            //     'nama_asal_sekolah' => '',
            //     'alamat_asal_sekolah' => '',
            //     'nomor_ijazah' => '',
            //     'tahun_ijazah' => '',
            //     'nomor_skhun' => '',
            //     'tahun_skhun' => '',
            //     'nama_ayah' => '',
            //     'nama_ibu' => '',
            //     'alamat_orangtua' => '',
            //     'telpon_orangtua' => '',
            //     'pekerjaan_ayah' => '',
            //     'pekerjaan_ibu' => '',
            //     'foto' => 'default.jpg'

            // ]);
        }

        // generate password
        $password = $add_tanggal . $this->request->getVar('tanggal') . $bulan . $tahun;
        // Hash password sebelum insert kedalam database
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // insert data siswa kedalam table user
        $this->authModel->save([
            'id_users' => $this->request->getVar('kode_siswa'),
            'username' => $this->request->getVar('nis'),
            'password' => $password_hash,
            'level' => 'siswa'
        ]);

        // // insert data siswa kedalam table siswa baru
        // $this->siswaBaru->save([
        //     'kode_siswa' => $this->request->getVar('kode_siswa')
        // ]);

        session()->setFlashdata('pesan', 'Data Siswa berhasil di input!');
        return redirect()->to(base_url('/admin/registration-siswa'));
    }
    // Akhir registrasi siswa


    public function siswa_baru()
    {
        $pager = \Config\Services::pager();

        // ambil halaman yang sedang kita akses
        $current_page = $this->request->getVar('page_siswa_baru') ? $this->request->getVar('page_siswa_baru') : 1;

        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $data_siswa = $this->siswaBaru->cariDatasiswa($keyword);
        } else {
            $data_siswa = $this->siswaBaru;
        }
        $data = [
            'tittle' => 'Data Siswa Baru',
            'siswa_baru' => $data_siswa->paginate(7, 'siswa_baru'),
            'pager' => $data_siswa->pager,
            'currentPage' => $current_page
        ];
        return view('siswa/siswa_baru', $data);
    }


    public function detail_siswa_baru($kode_siswa)
    {
        // data kode siswa yang di decrypt
        $kode_siswa = base64_decode($kode_siswa);

        $data = [
            'tittle' => 'Detail Siswa Baru',
            'validation' => \Config\Services::validation(),
            'data_siswa_baru' => $this->siswaBaru->getDataSiswaById($kode_siswa)
        ];

        return view('siswa/detail_siswa_baru', $data);
    }


    public function data_siswa()
    {
        $pager = \Config\Services::pager();

        // ambil halaman yang sedang kita akses
        $current_page = $this->request->getVar('page_siswa') ? $this->request->getVar('page_siswa') : 1;

        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $data_siswa = $this->siswaModel->cariDatasiswa($keyword);
        } else {
            $data_siswa = $this->siswaModel;
        }

        $data = [
            'tittle' => 'Data Siswa',
            'data_siswa' => $data_siswa->paginate(7, 'siswa'),
            'pager' => $data_siswa->pager,
            'currentPage' => $current_page
        ];

        return view('siswa/data_siswa', $data);
    }

    public function detail_siswa($id)
    {
        // data kode guru yang di decrypt
        $kode_siswa = base64_decode($id);

        $data = [
            'tittle' => 'Detail Siswa',
            'validation' => \Config\Services::validation(),
            'data_siswa' => $this->siswaModel->getDataSiswaById($kode_siswa)
        ];

        return view('siswa/detail_siswa', $data);
    }

    public function upload_siswa($id)
    {
        // data kode guru yang di decrypt
        $kode_siswa = base64_decode($id);
        $data_siswa = $this->siswaModel->getDataSiswaById($kode_siswa);

        //upload foto guru
        if (!$this->validate([
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpeg,image/jpg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar',
                    'is_image' => 'Yang anda upload bukan gambar',
                    'mime_in' => 'Yang anda upload bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(base_url('/admin/detail-siswa/' . $id))->withInput();
        }

        $fileFoto = $this->request->getFile('foto');

        // cek apakah ada foto yang di upload
        if ($fileFoto->getError() == 4) {
            $namaFile = $data_siswa['foto'];
        } else {
            // ambil nama file
            $namaFileSementara = $fileFoto->getRandomName();
            $namaFile = $data_siswa['nama_lengkap'] . "-" . $namaFileSementara;
            //pindahkan file foto ke folder img/users
            $fileFoto->move('img/users/', $namaFile);

            // cek apakah file lama adalah default?
            // jika file foto lama bukan default maka hapus file lama
            if ($this->request->getVar('foto_lama') != 'default.jpg') {
                unlink('img/users/' . $this->request->getVar('foto_lama'));
            }

            //update nama foto kedalam tabel guru
            $this->siswaModel->save([
                'id' => $data_siswa['id'],
                'foto' => $namaFile
            ]);

            session()->setFlashdata('pesan', 'Upload Foto Siswa berhasil!');
            return redirect()->to(base_url('/admin/detail-siswa/' . $id));
        }
    }

    public function siswa_all($id)
    {
        $kode_siswa = base64_decode($id);
        $data = [
            'tittle' => 'View All',
            'data_siswa' => $this->siswaModel->getDataSiswaById($kode_siswa)
        ];

        return view('siswa/view_all', $data);
    }


    public function edit_siswa($id)
    {
        $kode_siswa = base64_decode($id);
        $data = [
            'tittle' => 'Edit Data Siswa',
            'data_siswa' => $this->siswaModel->getDataSiswaById($kode_siswa),
            'validation' => \Config\Services::validation()
        ];

        return view('siswa/edit_siswa', $data);
    }

    public function proses_edit_siswa($id)
    {
        $kode_siswa = base64_decode($id);
        $data_siswa = $this->siswaModel->getDataSiswaById($kode_siswa);

        $data_user = $this->authModel->getDataUserByKode($kode_siswa);

        // menambahkan 0 pada tanggal dari form input
        $add_tanggal = '';
        // menambahkan 0 pada tanggal
        if ($this->request->getVar('tanggal') < 10) {
            $add_tanggal = '0';
        }

        // merubah string dari bulan menjadi angka
        $bulan = '';
        if ($this->request->getVar('bulan') == 'Januari') {
            $bulan = '01';
        }
        if ($this->request->getVar('bulan') == 'Februari') {
            $bulan = '02';
        }
        if ($this->request->getVar('bulan') == 'Maret') {
            $bulan = '03';
        }
        if ($this->request->getVar('bulan') == 'April') {
            $bulan = '04';
        }
        if ($this->request->getVar('bulan') == 'Mei') {
            $bulan = '05';
        }
        if ($this->request->getVar('bulan') == 'Juni') {
            $bulan = '06';
        }
        if ($this->request->getVar('bulan') == 'Juli') {
            $bulan = '07';
        }
        if ($this->request->getVar('bulan') == 'Agustus') {
            $bulan = '08';
        }
        if ($this->request->getVar('bulan') == 'September') {
            $bulan = '09';
        }
        if ($this->request->getVar('bulan') == 'Oktober') {
            $bulan = '10';
        }
        if ($this->request->getVar('bulan') == 'November') {
            $bulan = '11';
        }
        if ($this->request->getVar('bulan') == 'Desember') {
            $bulan = '12';
        }
        // mengurangi dua angka pertama pada tahun
        $tahun = substr($this->request->getVar('tahun'), -2);

        // validasi form input data guru
        if (!$this->validate([
            'nis' => [
                'rules' => 'required|max_length[10]|min_length[10]|numeric',
                'errors' => [
                    'required' => 'Kolom NIS harus dilengkapi!',
                    'max_length' => 'Nomor NIS harus 10 digit angka!',
                    'min_length' => 'Nomor NIS harus 10 digit angka!',
                    'numeric' => 'Kolom NIS harus berupa 10 digit angka!'
                ]
            ],
            'kode_siswa' => [
                'rules' => 'required|max_length[10]|min_length[10]',
                'errors' => [
                    'required' => 'Kolom Kode Guru harus dilengkapi!',
                    'max_length' => 'Nomor Kode Guru harus 10 digit angka!',
                    'min_length' => 'Nomor Kode Guru harus 10 digit angka!',
                ]
            ],
            'namaLengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Nama Lengkap harus dilengkapi!'
                ]
            ],
            'tempat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tempat harus dilengkapi!'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus dilengkapi!'
                ]
            ],
            'bulan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bulan harus dilengkapi!'
                ]
            ],
            'tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun harus dilengkapi!'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin harus dilengkapi!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/edit-siswa/' . $id))->withInput();
        } else {
            // $tanggal = $add_tanggal . $this->request->getVar('tanggal');
            // echo $tanggal . $bulan . $tahun;

            // generet tanggal dari form input
            $ttl = $add_tanggal . $this->request->getVar('tanggal') . " " . $this->request->getVar('bulan') . " " . $this->request->getVar('tahun');

            // Insert data kedalam table guru 
            $this->siswaModel->save([
                'id' => $data_siswa['id'],
                'nis' => $this->request->getVar('nis'),
                'kode_siswa' => $this->request->getVar('kode_siswa'),
                'nama_lengkap' => $this->request->getVar('namaLengkap'),
                'tempat_lahir' => $this->request->getVar('tempat'),
                'tanggal_lahir' => $ttl,
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                'alamat' => $this->request->getVar('alamat')
            ]);
        }


        // generate password
        $password = $add_tanggal . $this->request->getVar('tanggal') . $bulan . $tahun;
        // Hash password sebelum insert kedalam database
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // insert data guru kedalam table user
        $this->authModel->save([
            'id' => $data_user['id'],
            'id_users' => $this->request->getVar('kode_siswa'),
            'username' => $this->request->getVar('nis'),
            'password' => $password_hash,
        ]);

        session()->setFlashdata('pesan', 'Edit Data Siswa berhasil!');
        return redirect()->to(base_url('/admin/detail-siswa/' . $id));
    }




    public function edit_siswa_baru($kode_siswa)
    {
        $kode_siswa = base64_decode($kode_siswa);
        $data = [
            'tittle' => 'Edit Data Siswa Baru',
            'data_siswa' => $this->siswaBaru->getDataSiswaById($kode_siswa),
            'validation' => \Config\Services::validation()
        ];

        return view('siswa/edit_siswa_baru', $data);
    }


    public function proses_edit_siswa_baru($id)
    {
        $kode_siswa = base64_decode($id);
        $data_siswa = $this->siswaBaru->getDataSiswaById($kode_siswa);

        $data_user = $this->authModel->getDataUserByKode($kode_siswa);

        // menambahkan 0 pada tanggal dari form input
        $add_tanggal = '';
        // menambahkan 0 pada tanggal
        if ($this->request->getVar('tanggal') < 10) {
            $add_tanggal = '0';
        }

        // merubah string dari bulan menjadi angka
        $bulan = '';
        if ($this->request->getVar('bulan') == 'Januari') {
            $bulan = '01';
        }
        if ($this->request->getVar('bulan') == 'Februari') {
            $bulan = '02';
        }
        if ($this->request->getVar('bulan') == 'Maret') {
            $bulan = '03';
        }
        if ($this->request->getVar('bulan') == 'April') {
            $bulan = '04';
        }
        if ($this->request->getVar('bulan') == 'Mei') {
            $bulan = '05';
        }
        if ($this->request->getVar('bulan') == 'Juni') {
            $bulan = '06';
        }
        if ($this->request->getVar('bulan') == 'Juli') {
            $bulan = '07';
        }
        if ($this->request->getVar('bulan') == 'Agustus') {
            $bulan = '08';
        }
        if ($this->request->getVar('bulan') == 'September') {
            $bulan = '09';
        }
        if ($this->request->getVar('bulan') == 'Oktober') {
            $bulan = '10';
        }
        if ($this->request->getVar('bulan') == 'November') {
            $bulan = '11';
        }
        if ($this->request->getVar('bulan') == 'Desember') {
            $bulan = '12';
        }
        // mengurangi dua angka pertama pada tahun
        $tahun = substr($this->request->getVar('tahun'), -2);

        // validasi form input data guru
        if (!$this->validate([
            'nis' => [
                'rules' => 'required|max_length[10]|min_length[10]|numeric',
                'errors' => [
                    'required' => 'Kolom NIS harus dilengkapi!',
                    'max_length' => 'Nomor NIS harus 10 digit angka!',
                    'min_length' => 'Nomor NIS harus 10 digit angka!',
                    'numeric' => 'Kolom NIS harus berupa 10 digit angka!'
                ]
            ],
            'kode_siswa' => [
                'rules' => 'required|max_length[10]|min_length[10]',
                'errors' => [
                    'required' => 'Kolom Kode Guru harus dilengkapi!',
                    'max_length' => 'Nomor Kode Guru harus 10 digit angka!',
                    'min_length' => 'Nomor Kode Guru harus 10 digit angka!',
                ]
            ],
            'namaLengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Nama Lengkap harus dilengkapi!'
                ]
            ],
            'tempat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tempat harus dilengkapi!'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus dilengkapi!'
                ]
            ],
            'bulan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bulan harus dilengkapi!'
                ]
            ],
            'tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun harus dilengkapi!'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin harus dilengkapi!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/edit-siswa-baru/' . $id))->withInput();
        } else {
            // $tanggal = $add_tanggal . $this->request->getVar('tanggal');
            // echo $tanggal . $bulan . $tahun;

            // generet tanggal dari form input
            $ttl = $add_tanggal . $this->request->getVar('tanggal') . " " . $this->request->getVar('bulan') . " " . $this->request->getVar('tahun');

            // Insert data kedalam table guru 
            $this->siswaBaru->save([
                'id' => $data_siswa['id'],
                'nis' => $this->request->getVar('nis'),
                'kode_siswa' => $this->request->getVar('kode_siswa'),
                'nama_lengkap' => $this->request->getVar('namaLengkap'),
                'tempat_lahir' => $this->request->getVar('tempat'),
                'tanggal_lahir' => $ttl,
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                'alamat' => $this->request->getVar('alamat')
            ]);
        }


        // generate password
        $password = $add_tanggal . $this->request->getVar('tanggal') . $bulan . $tahun;
        // Hash password sebelum insert kedalam database
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // insert data guru kedalam table user
        $this->authModel->save([
            'id' => $data_user['id'],
            'id_users' => $this->request->getVar('kode_siswa'),
            'username' => $this->request->getVar('nis'),
            'password' => $password_hash,
        ]);

        session()->setFlashdata('pesan', 'Edit Data Siswa Baru berhasil!');
        return redirect()->to(base_url('/admin/detail-siswa-baru/' . $id));
    }


    public function delete_siswa($id)
    {
        $kode_siswa = base64_decode($id);
        $data_siswa = $this->siswaModel->getDataSiswaById($kode_siswa);

        $data_user = $this->authModel->getDataUserByKode($kode_siswa);

        // cari foto berdasarkan ID
        $foto = $data_siswa['foto'];

        // cek apakah foto adalah default?
        if ($foto != 'default.jpg') {
            // hapus foto yang sudah diupload
            unlink('img/users/' . $foto);
        }

        // ambil id data guru
        $id_guru = $data_siswa['id'];
        // hapus data guru dari table guru
        $this->siswaModel->delete($id_guru);

        // ambil id data_user
        $id_user = $data_user['id'];
        $this->authModel->delete($id_user);

        // Session flashdata
        session()->setFlashdata('pesan', 'Data Siswa Berhasil Di Hapus');
        return redirect()->to(base_url('/admin/data-siswa'));
    }

    public function delete_siswa_baru($id)
    {
        $kode_siswa = base64_decode($id);
        $data_siswa = $this->siswaBaru->getDataSiswaById($kode_siswa);

        $data_user = $this->authModel->getDataUserByKode($kode_siswa);

        // cari foto berdasarkan ID
        $foto = $data_siswa['foto'];

        // cek apakah foto adalah default?
        if ($foto != 'default.jpg') {
            // hapus foto yang sudah diupload
            unlink('img/users/' . $foto);
        }

        // ambil id data siswa
        $id_siswa = $data_siswa['id'];
        // hapus data guru dari table guru
        $this->siswaBaru->delete($id_siswa);

        // ambil id data_user
        $id_user = $data_user['id'];
        $this->authModel->delete($id_user);

        // Session flashdata
        session()->setFlashdata('pesan', 'Data Siswa Baru Berhasil Di Hapus');
        return redirect()->to(base_url('/admin/siswa-baru'));
    }


    public function data_diri_siswa($nis)
    {
        // deskripsi data nis dari parameter
        $nis =  base64_decode($nis);

        // ambil data siswa
        $data_siswa = $this->siswaModel->where('nis', $nis)->first();

        $data = [
            'tittle' => 'Data Diri',
            'data_siswa' => $data_siswa
        ];

        return view('siswa/data_diri_siswa', $data);
    }

    public function data_diri_siswa_all($kode_siswa)
    {
        // deskripsi data kode siswa
        $kodeSiswa = base64_decode($kode_siswa);

        // ambil data siswa 
        $data_siswa = $this->siswaModel->where('kode_siswa', $kodeSiswa)->first();

        $data = [
            'tittle' => 'Detail Data Diri',
            'data_siswa' => $data_siswa
        ];

        return view('siswa/detail_data_diri_siswa', $data);
    }


    public function update_data_diri($kode_siswa)
    {
        // deskripsi data siswa
        $kodeSiswa = base64_decode($kode_siswa);

        // get data siswa
        $data_siswa = $this->siswaModel->where('kode_siswa', $kodeSiswa)->first();

        $data = [
            'tittle' => 'Update Data Diri',
            'data_siswa' => $data_siswa,
            'validation' => \Config\Services::validation()
        ];

        return view('siswa/update_data_diri_siswa', $data);
    }


    public function proses_update_data_diri($kode_siswa)
    {
        // deskripsi data siswa
        $kodeSiswa = base64_decode($kode_siswa);

        // validasi form input data guru
        if (!$this->validate([
            'nis' => [
                'rules' => 'required|max_length[10]|min_length[10]|numeric',
                'errors' => [
                    'required' => 'Kolom NIS harus dilengkapi!',
                    'max_length' => 'Nomor NIS harus 10 digit angka!',
                    'min_length' => 'Nomor NIS harus 10 digit angka!',
                    'numeric' => 'Kolom NIS harus berupa 10 digit angka!'
                ]
            ],
            'namaLengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Nama Lengkap harus dilengkapi!'
                ]
            ],
            'tempat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tempat harus dilengkapi!'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus dilengkapi!'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin harus dilengkapi!'
                ]
            ],
            'agama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Agama!'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email Harus dilengkapi!',
                    'valid_email' => 'Data yang anda masukan bukan Email!'
                ]
            ],
            'no_telpon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No Telpon Harus dilengkapi!'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Harus dilengkapi!'
                ]
            ],
            'asal_sekolah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Asal Sekolah Harus dilengkapi!'
                ]
            ],
            'alamat_asal_sekolah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Asal Sekolah Harus dilengkapi!'
                ]
            ],
            'no_ijazah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No Ijazah Harus dilengkapi!'
                ]
            ],
            'tahun_ijazah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun Ijazah Harus dilengkapi!'
                ]
            ],
            'no_skhun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No SKHUN Harus dilengkapi!'
                ]
            ],
            'tahun_skhun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun SKHUN Harus dilengkapi!'
                ]
            ],
            'nama_ayah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Ayah Harus dilengkapi!'
                ]
            ],
            'nama_ibu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Ibu Harus dilengkapi!'
                ]
            ],
            'alamat_orangtua' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Orang Tua Harus dilengkapi!'
                ]
            ],
            'telpon_orangtua' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Telpon Orang Tua Harus dilengkapi!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/view/update/' . $kode_siswa))->withInput();
        } else {
            // ambil ID data guru
            $data_siswa = $this->siswaModel->where('kode_siswa', $kodeSiswa)->first();
            $id = $data_siswa['id'];


            $this->siswaModel->save([
                'id' => $id,
                'kode_siswa' => $this->request->getVar('kode_siswa'),
                'nis' => $this->request->getVar('nis'),
                'nama_lengkap' => $this->request->getVar('namaLengkap'),
                'tempat_lahir' => $this->request->getVar('tempat'),
                'tanggal_lahir' => $this->request->getVar('tanggal'),
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                'agama' => $this->request->getVar('agama'),
                'alamat' => $this->request->getVar('alamat'),
                'email' => $this->request->getVar('email'),
                'nama_asal_sekolah' => $this->request->getVar('asal_sekolah'),
                'alamat_asal_sekolah' => $this->request->getVar('alamat_asal_sekolah'),
                'nomor_ijazah' => $this->request->getVar('no_ijazah'),
                'tahun_ijazah' => $this->request->getVar('tahun_ijazah'),
                'nomor_skhun' => $this->request->getVar('nomor_skhun'),
                'tahun_skhun' => $this->request->getVar('tahun_skhun'),
                'nama_ayah' => $this->request->getVar('nama_ayah'),
                'nama_ibu' => $this->request->getVar('nama_ibu'),
                'alamat_orangtua' => $this->request->getVar('alamat_orangtua'),
                'telpon_orangtua' => $this->request->getVar('telpon_orangtua'),
                'pekerjaan_ayah' => $this->request->getVar('pekerjaan_ayah'),
                'pekerjaan_ibu' => $this->request->getVar('pekerjaan_ibu'),
                'foto' => $this->request->getVar('foto')
            ]);

            session()->setFlashdata('pesan', 'Edit Data Diri berhasil!');
            return redirect()->to(base_url('/view/update/' . $kode_siswa));
        }
    }
}
