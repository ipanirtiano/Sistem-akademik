<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\AuthModel;
use App\Models\GuruModel;
use App\Models\SiswaModel;

class Auth extends BaseController
{

    public function __construct()
    {
        $this->authModel = new AuthModel();
        $this->adminModel = new AdminModel();
        $this->guruModel = new GuruModel();
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {


        if (session()->has('nama')) {
            session()->setFlashdata('pesan', 'Anda belum login!');
            return redirect()->to(base_url('/dashboard'));
        }


        return view('Auth/index');
    }



    public function proses_login()
    {
        // select data user dari table users
        $data_user = $this->authModel->findAll();
        // Ambil data inputan dari form login
        $data = $this->request->getVar();

        // cek apakah username yang di input sama dengan yang ada di dalam database
        $user = $this->authModel->where('username', $data['username'])->first();
        if ($user) {
            // cek apakah password nya sama dengan yang ada di dalam database
            if (password_verify($data['pass'], $user['password'])) {
                // get level yang sedang login 
                $level = $user['level'];

                // select ke table admin apakah yang login adalah admin
                $admin = $this->adminModel->where('kode_admin', $user['id_users'])->first();

                // Jika yang login adalah admin
                if ($admin) {
                    $data_session = [
                        'login' => true,
                        'nama' => $admin['nama_lengkap'],
                        'nomor_induk' => $admin['nik'],
                        'foto' => $admin['foto'],
                        'level' => $level
                    ];
                    session()->set($data_session);
                    return redirect()->to(base_url('/dashboard'));
                }

                // select ke table guru apakah yang login adalah guru
                $guru = $this->guruModel->where('kode_guru', $user['id_users'])->first();

                // Jika yang login adalah guru
                if ($guru) {
                    $data_session = [
                        'login' => true,
                        'nama' => $guru['nama_lengkap'],
                        'nomor_induk' => $guru['nik'],
                        'foto' => $guru['foto'],
                        'level' => $level,
                        'kode_guru' => $guru['kode_guru']
                    ];
                    session()->set($data_session);
                    return redirect()->to(base_url('/dashboard'));
                }


                // select ke table siswa apakah yang login adalah siswa
                $siswa = $this->siswaModel->where('kode_siswa', $user['id_users'])->first();

                // jika yang login adalah siswa
                if ($siswa) {
                    $data_session = [
                        'login' => true,
                        'nama' => $siswa['nama_lengkap'],
                        'nomor_induk' => $siswa['nis'],
                        'kode_siswa' => $siswa['kode_siswa'],
                        'foto' => $siswa['foto'],
                        'level' => $level
                    ];
                    session()->set($data_session);
                    return redirect()->to(base_url('/dashboard'));
                } else {
                    session()->setFlashdata('pesan', 'Username Belum Terdaftar!');
                    return redirect()->to(base_url('/'));
                }
            } else {
                session()->setFlashdata('pesan', 'Password yang anda masukan salah!');
                return redirect()->to(base_url('/'));
            }
        } else {
            session()->setFlashdata('pesan', 'Username tidak terdaftar!');
            return redirect()->to(base_url('/'));
        }
    }


    public function logout()
    {
        $data_session = ['login', 'nama', 'nomor_induk', 'level', 'kode_guru', 'kode_siswa'];
        session()->remove($data_session);
        session()->setFlashdata('pesan-success', 'Selamat datang kembali');
        return redirect()->to(base_url('/'));
    }
}
