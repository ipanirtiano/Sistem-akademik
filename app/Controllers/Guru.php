<?php

namespace App\Controllers;

use CodeIgniter\Config\Config;
use App\Models\AdminModel;
use App\Models\AuthModel;
use App\Models\GuruModel;
use App\Models\WaliKelasModel;
use CodeIgniter\HTTP\Request;

class Guru extends BaseController
{
    public function __construct()
    {
        $this->authModel = new AuthModel();
        $this->adminModel = new AdminModel();
        $this->guruModel = new GuruModel();
        $this->waliKelas = new WaliKelasModel();
    }


    // Registrasi GURU
    public function registrasi_guru()
    {
        //generate NIK random guru
        $tgl = date('m');
        //genetate angka random 3 digit pertama setelah tahun dan bulan
        $angka_nik1 = range(0, 9);
        shuffle($angka_nik1);
        $ambilKode_nik1 = array_rand($angka_nik1, 4);
        $generetKode_nik1 = implode('', $ambilKode_nik1);

        // generate angka random 3 digit kedua setelah tahun dan bulan
        $angka_nik2 = range(0, 9);
        shuffle($angka_nik2);
        $ambilKode_nik2 = (array_rand($angka_nik2, 3));
        $generetKode_nik2 = implode('', $ambilKode_nik2);
        // NIK yang setelah di random
        $nik = "4" . $tgl . $generetKode_nik1 . $generetKode_nik2;

        //generet kode guru random 3 digit pertama
        $angka_kode1 = range(0, 9);
        shuffle($angka_kode1);
        $ambilKode1 = array_rand($angka_kode1, 3);
        $generetKode1 = implode('', $ambilKode1);
        // generate kode guru random 3 digit kedua
        $angka_kode2 = range(0, 9);
        shuffle($angka_kode2);
        $ambilKode2 = array_rand($angka_kode2, 3);
        $generetKode2 = implode('', $ambilKode2);
        // kode guru yang sudah di random
        $kode_guru = 'KDG-' . $generetKode1 . $generetKode2;

        //generet NIP random untuk sementara
        $angka_nip1 = range(0, 9);
        shuffle($angka_nip1);
        $ambilKodeNip1 = array_rand($angka_nip1, 5);
        $generetKodeNip1 = implode('', $ambilKodeNip1);

        $angka_nip2 = range(0, 9);
        shuffle($angka_nip2);
        $ambilKodeNip2 = array_rand($angka_nip2, 5);
        $generetKodeNip2 = implode('', $ambilKodeNip2);
        $kode_nip = '19850330' . $generetKodeNip1 . $generetKodeNip2;

        $data = [
            'tittle' => 'Registrasi Guru',
            'nik' => $nik,
            'kode_guru' => $kode_guru,
            'kode_nip' => $kode_nip,
            'validation' => \Config\Services::validation()
        ];
        return view('Guru/registration-guru', $data);
    }

    public function proses_regis_guru()
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
            'nik' => [
                'rules' => 'is_unique[guru.nik]|required|max_length[10]|min_length[10]|numeric',
                'errors' => [
                    'is_unique' => 'NIK sudah terdaftar!',
                    'required' => 'Kolom NIK harus dilengkapi!',
                    'max_length' => 'Nomor NIK harus 10 digit angka!',
                    'min_length' => 'Nomor NIK harus 10 digit angka!',
                    'numeric' => 'Kolom NIK harus berupa 10 digit angka!'
                ]
            ],
            'kode_guru' => [
                'rules' => 'is_unique[guru.kode_guru]|required|max_length[10]|min_length[10]',
                'errors' => [
                    'is_unique' => 'Kode Guru sudah terdaftar!',
                    'required' => 'Kolom Kode Guru harus dilengkapi!',
                    'max_length' => 'Nomor Kode Guru harus 10 digit angka!',
                    'min_length' => 'Nomor Kode Guru harus 10 digit angka!',
                ]
            ],
            'nip' => [
                'rules' => 'required|is_unique[guru.nip]|max_length[18]|min_length[18]|numeric',
                'errors' => [
                    'required' => 'Kolom NIP harus dilengkapi!',
                    'is_unique' => 'NIP sudah terdaftar!',
                    'max_length' => 'Nomor NIP harus 18 digit angka!',
                    'min_length' => 'Nomor NIP harus 18 digit angka!',
                    'numeric' => 'Kolom NIP harus berupa 18 digit angka!'
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
            return redirect()->to(base_url('/admin/registration-guru'))->withInput();
        } else {
            // $tanggal = $add_tanggal . $this->request->getVar('tanggal');
            // echo $tanggal . $bulan . $tahun;

            // generet tanggal dari form input
            $ttl = $add_tanggal . $this->request->getVar('tanggal') . " " . $this->request->getVar('bulan') . " " . $this->request->getVar('tahun');

            // Insert data kedalam table guru 
            $this->guruModel->save([
                'nik' => $this->request->getVar('nik'),
                'kode_guru' => $this->request->getVar('kode_guru'),
                'nip' => $this->request->getVar('nip'),
                'nama_lengkap' => $this->request->getVar('namaLengkap'),
                'tempat_lahir' => $this->request->getVar('tempat'),
                'tanggal_lahir' => $ttl,
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                'pendidikan_akhir' => '',
                'agama' => '',
                'alamat' => $this->request->getVar('alamat'),
                'email' => '',
                'no_telpon' => '',
                'foto' => 'default.jpg'

            ]);
        }

        // generate password
        $password = $add_tanggal . $this->request->getVar('tanggal') . $bulan . $tahun;
        // Hash password sebelum insert kedalam database
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // insert data guru kedalam table user
        $this->authModel->save([
            'id_users' => $this->request->getVar('kode_guru'),
            'username' => $this->request->getVar('nik'),
            'password' => $password_hash,
            'level' => 'guru'
        ]);

        // insert data guru kedalam table wali kelas
        $this->waliKelas->save([
            'kode_guru' => $this->request->getVar('kode_guru')
        ]);

        session()->setFlashdata('pesan', 'Data Guru berhasil di input!');
        return redirect()->to(base_url('/admin/registration-guru'));
    }
    // Akhir registrasi GURU


    public function data_guru()
    {
        $pager = \Config\Services::pager();

        // ambil halaman yang sedang kita akses
        $current_page = $this->request->getVar('page_guru') ? $this->request->getVar('page_guru') : 1;

        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $data_guru = $this->guruModel->cariDataGuru($keyword);
        } else {
            $data_guru = $this->guruModel;
        }

        $data = [
            'tittle' => 'Data Guru',
            'data_guru' => $data_guru->paginate(7, 'guru'),
            'pager' => $data_guru->pager,
            'currentPage' => $current_page
        ];

        return view('guru/data_guru', $data);
    }


    public function detail_guru($id)
    {
        // data kode guru yang di decrypt
        $kode_guru = base64_decode($id);

        $data = [
            'tittle' => 'Detail Guru',
            'validation' => \Config\Services::validation(),
            'data_guru' => $this->guruModel->getDataGuruById($kode_guru)
        ];

        return view('guru/detail_guru', $data);
    }


    public function upload($id)
    {
        // data kode guru yang di decrypt
        $kode_guru = base64_decode($id);
        $data_guru = $this->guruModel->getDataGuruById($kode_guru);

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
            return redirect()->to(base_url('/admin/detail/' . $id))->withInput();
        }

        $fileFoto = $this->request->getFile('foto');

        // cek apakah ada foto yang di upload
        if ($fileFoto->getError() == 4) {
            $namaFile = $data_guru['foto'];
        } else {
            // ambil nama file
            $namaFileSementara = $fileFoto->getRandomName();
            $namaFile = $data_guru['nama_lengkap'] . "-" . $namaFileSementara;
            //pindahkan file foto ke folder img/users
            $fileFoto->move('img/users/', $namaFile);

            // cek apakah file lama adalah default?
            // jika file foto lama bukan default maka hapus file lama
            if ($this->request->getVar('foto_lama') != 'default.jpg') {
                unlink('img/users/' . $this->request->getVar('foto_lama'));
            }

            //update nama foto kedalam tabel guru
            $this->guruModel->save([
                'id' => $data_guru['id'],
                'foto' => $namaFile
            ]);

            session()->setFlashdata('pesan', 'Upload Foto Guru berhasil!');
            return redirect()->to(base_url('/admin/detail/' . $id));
        }
    }


    public function guru_all($id)
    {
        $kode_guru = base64_decode($id);
        $data = [
            'tittle' => 'View All',
            'data_guru' => $this->guruModel->getDataGuruById($kode_guru)
        ];

        return view('guru/view_all', $data);
    }

    public function edit_guru($id)
    {
        $kode_guru = base64_decode($id);
        $data = [
            'tittle' => 'Edit Data Guru',
            'data_guru' => $this->guruModel->getDataGuruById($kode_guru),
            'validation' => \Config\Services::validation()
        ];

        return view('guru/edit_guru', $data);
    }



    public function proses_edit_guru($id)
    {
        $kode_guru = base64_decode($id);
        $data_guru = $this->guruModel->getDataGuruById($kode_guru);

        $data_user = $this->authModel->getDataUserByKode($kode_guru);

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
            'nik' => [
                'rules' => 'required|max_length[10]|min_length[10]|numeric',
                'errors' => [
                    'required' => 'Kolom NIK harus dilengkapi!',
                    'max_length' => 'Nomor NIK harus 10 digit angka!',
                    'min_length' => 'Nomor NIK harus 10 digit angka!',
                    'numeric' => 'Kolom NIK harus berupa 10 digit angka!'
                ]
            ],
            'kode_guru' => [
                'rules' => 'required|max_length[10]|min_length[10]',
                'errors' => [
                    'required' => 'Kolom Kode Guru harus dilengkapi!',
                    'max_length' => 'Nomor Kode Guru harus 10 digit angka!',
                    'min_length' => 'Nomor Kode Guru harus 10 digit angka!',
                ]
            ],
            'nip' => [
                'rules' => 'required|max_length[18]|min_length[18]|numeric',
                'errors' => [
                    'required' => 'Kolom NIP harus dilengkapi!',
                    'max_length' => 'Nomor NIP harus 18 digit angka!',
                    'min_length' => 'Nomor NIP harus 18 digit angka!',
                    'numeric' => 'Kolom NIP harus berupa 18 digit angka!'
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
            return redirect()->to(base_url('/admin/edit/' . $id))->withInput();
        } else {
            // $tanggal = $add_tanggal . $this->request->getVar('tanggal');
            // echo $tanggal . $bulan . $tahun;

            // generet tanggal dari form input
            $ttl = $add_tanggal . $this->request->getVar('tanggal') . " " . $this->request->getVar('bulan') . " " . $this->request->getVar('tahun');

            // Insert data kedalam table guru 
            $this->guruModel->save([
                'id' => $data_guru['id'],
                'nik' => $this->request->getVar('nik'),
                'kode_guru' => $this->request->getVar('kode_guru'),
                'nip' => $this->request->getVar('nip'),
                'nama_lengkap' => $this->request->getVar('namaLengkap'),
                'tempat_lahir' => $this->request->getVar('tempat'),
                'tanggal_lahir' => $ttl,
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                'pendidikan_akhir' => '',
                'agama' => '',
                'alamat' => $this->request->getVar('alamat'),
                'email' => '',
                'no_telpon' => '',
                'foto' => $data_guru['foto']
            ]);
        }


        // generate password
        $password = $add_tanggal . $this->request->getVar('tanggal') . $bulan . $tahun;
        // Hash password sebelum insert kedalam database
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // insert data guru kedalam table user
        $this->authModel->save([
            'id' => $data_user['id'],
            'id_users' => $this->request->getVar('kode_guru'),
            'username' => $this->request->getVar('nik'),
            'password' => $password_hash,
            'level' => 'guru'
        ]);

        session()->setFlashdata('pesan', 'Edit Data Guru berhasil!');
        return redirect()->to(base_url('/admin/detail/' . $id));
    }


    public function delete($id)
    {
        $kode_guru = base64_decode($id);
        $data_guru = $this->guruModel->getDataGuruById($kode_guru);

        $data_user = $this->authModel->getDataUserByKode($kode_guru);

        // cari foto berdasarkan ID
        $foto = $data_guru['foto'];

        // cek apakah foto adalah default?
        if ($foto != 'default.jpg') {
            // hapus foto yang sudah diupload
            unlink('img/users/' . $foto);
        }

        // ambil id data guru
        $id_guru = $data_guru['id'];
        // hapus data guru dari table guru
        $this->guruModel->delete($id_guru);

        // ambil id data_user
        $id_user = $data_user['id'];
        $this->authModel->delete($id_user);

        //hapus table wali_kelas
        $id_wali_kelas = $data_guru['kode_guru'];
        $this->waliKelas->delete($id_wali_kelas);

        // Session flashdata
        session()->setFlashdata('pesan', 'Data Guru Berhasil Di Hapus');
        return redirect()->to(base_url('/admin/data-guru'));
    }



    // aktor guru
    public function data_diri_guru($nik)
    {
        // deskripsi nik
        $dataNik = base64_decode($nik);

        // get data guru
        $data_guru = $this->guruModel->where('nik', $dataNik)->first();

        $data = [
            'tittle' => 'Data Diri',
            'data_guru' => $data_guru
        ];

        return view('guru/data_diri_guru', $data);
    }


    public function data_diri_guru_all($id)
    {
        $kode_guru = base64_decode($id);
        $data = [
            'tittle' => 'View All',
            'data_guru' => $this->guruModel->getDataGuruById($kode_guru)
        ];

        return view('guru/view_all_data_diri', $data);
    }

    public function update_data_diri_guru($kode_guru)
    {
        $kodeGuru = base64_decode($kode_guru);

        $data = [
            'tittle' => 'Update Data Diri',
            'data_guru' => $this->guruModel->getDataGuruById($kodeGuru),
            'validation' => \Config\Services::validation()
        ];

        return view('guru/update_data_diri_guru', $data);
    }


    public function proses_update_data_diri($kode_guru)
    {
        // deskripsi data guru
        $kodeGuru = base64_decode($kode_guru);

        // validasi form input data guru
        if (!$this->validate([
            'nik' => [
                'rules' => 'required|max_length[10]|min_length[10]|numeric',
                'errors' => [
                    'required' => 'Kolom NIK harus dilengkapi!',
                    'max_length' => 'Nomor NIK harus 10 digit angka!',
                    'min_length' => 'Nomor NIK harus 10 digit angka!',
                    'numeric' => 'Kolom NIK harus berupa 10 digit angka!'
                ]
            ],
            'nip' => [
                'rules' => 'required|max_length[18]|min_length[18]|numeric',
                'errors' => [
                    'required' => 'Kolom NIP harus dilengkapi!',
                    'max_length' => 'Nomor NIP harus 18 digit angka!',
                    'min_length' => 'Nomor NIP harus 18 digit angka!',
                    'numeric' => 'Kolom NIP harus berupa 18 digit angka!'
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
            'pendidikan_terakhir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pendidikan Terakhir harus dilengkapi!'
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
        ])) {
            return redirect()->to(base_url('/views/update/' . $kode_guru))->withInput();
        } else {
            // ambil ID data guru
            $data_guru = $this->guruModel->where('kode_guru', $kodeGuru)->first();
            $id = $data_guru['id'];


            $this->guruModel->save([
                'id' => $id,
                'kode_guru' => $this->request->getVar('kode_guru'),
                'nik' => $this->request->getVar('nik'),
                'nip' => $this->request->getVar('nip'),
                'nama_lengkap' => $this->request->getVar('namaLengkap'),
                'tempat_lahir' => $this->request->getVar('tempat'),
                'tanggal_lahir' => $this->request->getVar('tanggal'),
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                'pendidikan_akhir' => $this->request->getVar('pendidikan_terakhir'),
                'agama' => $this->request->getVar('agama'),
                'alamat' => $this->request->getVar('alamat'),
                'email' => $this->request->getVar('email'),
                'no_telpon' => $this->request->getVar('no_telpon'),
                'foto' => $this->request->getVar('foto')
            ]);

            session()->setFlashdata('pesan', 'Edit Data Diri berhasil!');
            return redirect()->to(base_url('/views/update/' . $kode_guru));
        }
    }
}
