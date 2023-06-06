<?php

namespace App\Controllers;

use App\Models\GuruModel;
use App\Models\JadwalModel;
use App\Models\KelasModel;
use App\Models\MapelModel;
use CodeIgniter\HTTP\Request;

class MataPelajaran extends BaseController
{

    public function __construct()
    {
        $this->guruModel = new GuruModel();
        $this->mapelModel = new MapelModel();
        $this->kelasModel = new KelasModel();
        $this->jadwalModel = new JadwalModel();
    }

    public function input_mata_pelajaran()
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
        $kode_mapel = 'MPL-' . $generetKode1 . $generetKode2;


        // ambil data guru dari table guru
        $data_guru = $this->guruModel->findAll();

        // dd($this->mapelModel->getGuruPengajar());


        $data = [
            'tittle' => 'Input Mata Pelajaran',
            'kode_mapel' => $kode_mapel,
            'guru' => $data_guru,
            'mata_pelajaran' => $this->mapelModel->getGuruPengajar(),
            'validation' => \Config\Services::validation()
        ];

        return view('jadwal/input_mata_pelajaran', $data);
    }


    public function proses_input_mapel()
    {
        // validasi
        if (!$this->validate([
            'mapel' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Mata Pelajaran harus dilengkapi!',
                ]
            ],
            'guru_pengajar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Guru Pengajar',
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/input-mapel'))->withInput();
        } else {
            // insert data kedalam table mata pelajaran
            $this->mapelModel->save([
                'kode_mapel' => $this->request->getVar('kode_mapel'),
                'nama_mapel' => $this->request->getVar('mapel'),
                'guru_pengajar' => $this->request->getVar('guru_pengajar')
            ]);


            session()->setFlashdata('pesan', 'Data Mata Pelajaran berhasil di input!');
            return redirect()->to(base_url('/admin/input-mapel'));
        }
    }


    public function edit_mapel($kode_mapel)
    {
        // data kode mapel yang di decrypt
        $kode_mapel = base64_decode($kode_mapel);

        // ambil data guru dari table guru
        $data_guru = $this->guruModel->findAll();

        // dd($this->mapelModel->getDataByKodeMapel($kode_mapel));

        $data = [
            'tittle' => 'Edit Mata Pelajaran',
            'mapel' => $this->mapelModel->getDataByKodeMapel($kode_mapel),
            'validation' => \Config\Services::validation(),
            'guru' => $data_guru
        ];

        return view('jadwal/edit_mapel', $data);
    }


    public function proses_edit_mapel($kode_mapel)
    {
        // data kode mapel yang di decrypt
        $kodeMapel = base64_decode($kode_mapel);

        // ambil data mapel
        $data_mapel = $this->mapelModel->where('kode_mapel', $kodeMapel)->first();

        // validasi form
        if (!$this->validate([
            'mapel' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Mata Pelajaran Harus Dilengkapi!'
                ]
            ],
            'guru_pengajar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Guru Pengajar!'
                ]
            ]
        ])) {
            return redirect()->to(base_url('/admin/edit-mapel/' . $kode_mapel))->withInput();
        } else {
            // insert update kedalam table mata pelajaran
            $this->mapelModel->save([
                'id' => $data_mapel['id'],
                'kode_mapel' => $this->request->getVar('kode_mapel'),
                'nama_mapel' => $this->request->getVar('mapel'),
                'guru_pengajar' => $this->request->getVar('guru_pengajar')
            ]);


            session()->setFlashdata('pesan', 'Data Mata Pelajaran berhasil di Edit!');
            return redirect()->to(base_url('/admin/input-mapel'));
        }
    }


    public function hapus_mapel($kode_mapel)
    {
        // data kode mapel yang di decrypt
        $kodeMapel = base64_decode($kode_mapel);

        // hapus mata pelajaran
        $this->mapelModel->where('kode_mapel', $kodeMapel)->delete();

        session()->setFlashdata('pesan', 'Data Mata Pelajaran berhasil di Edit!');
        return redirect()->to(base_url('/admin/input-mapel'));
    }
}
