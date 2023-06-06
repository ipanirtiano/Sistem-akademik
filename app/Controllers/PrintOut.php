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
use App\Models\KelasSiswaModel;
use App\Models\KelasModel;
use App\Models\MapelModel;
use App\Models\JadwalModel;
use App\Models\NilaiModel;

class PrintOut extends BaseController
{
    public function __construct()
    {
        $this->authModel = new AuthModel();
        $this->adminModel = new AdminModel();
        $this->guruModel = new GuruModel();
        $this->siswaModel = new SiswaModel();
        $this->siswaBaru = new SiswaBaruModel();
        $this->kelasSiswaModel = new KelasSiswaModel();
        $this->kelasModel = new KelasModel();
        $this->mapelModel = new MapelModel();
        $this->jadwalModel = new JadwalModel();
        $this->nilaiModel = new NilaiModel();
    }

    // Function print out
    public function print_siswa_baru()
    {
        $data_siswaBaru = $this->siswaBaru->findAll();

        $data = [
            'siswa_baru' => $data_siswaBaru
        ];

        $html = view('print/print_siswa_baru', $data);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPageOrientation('L');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        $pdf->writeHTML($html, true, false, true, false, '');

        $this->response->setContentType('application/pdf');

        $pdf->Output('Data_Siswa_Baru.pdf', 'I');
    }

    public function print_kelas_siswa($kode_kelas)
    {
        // deskripsion tahun
        $kodeKelas = base64_decode($kode_kelas);

        // Ambil kelas
        $kelas = $this->kelasModel->where('kode_kelas', $kodeKelas)->first();
        // ambil ruang kelas
        $ruang_kelas = $kelas['tingkat'] . " " . $kelas['ruang_kelas'];

        $data_kelas_siswa = $this->kelasSiswaModel->findbyKodeKelas($kodeKelas);

        $data = [
            'kelas_siswa' => $data_kelas_siswa,
            'kelas' => $ruang_kelas
        ];

        $html =  view('print/print_kelas_siswa', $data);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        $pdf->writeHTML($html);

        $this->response->setContentType('application/pdf');

        $pdf->Output('Data Siswa Kelas.pdf', 'I');
    }

    public function print_mata_pelajaran()
    {
        // ambil data mata pelajaran
        $mapel = $this->mapelModel->getGuruPengajar();

        $data = [
            'mapel' => $mapel
        ];

        $html = view('print/print_mata_pelajaran', $data);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        $pdf->writeHTML($html);

        $this->response->setContentType('application/pdf');

        $pdf->Output('Data Mata Pelajaran.pdf', 'I');
    }

    public function print_jadwal($kode_kelas)
    {
        // deskripsion kode kelas
        $kodeKelas = base64_decode($kode_kelas);
        // ambil jadwal kelas
        $jadwal = $this->jadwalModel->findJadwalBykodeKelas($kodeKelas);

        // ambil data ruang kelas
        $ruang_kelas = $this->kelasModel->where('kode_kelas', $kodeKelas)->first();

        $data = [
            'jadwal' => $jadwal,
            'ruang_kelas' => $ruang_kelas
        ];

        $html = view('print/print_jadwal', $data);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPageOrientation('L');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        $pdf->writeHTML($html);

        $this->response->setContentType('application/pdf');

        $pdf->Output('Data Jadwal Pelajaran.pdf', 'I');
    }


    public function print_guru()
    {
        // ambil data guru
        $data_guru = $this->guruModel->findAll();

        $data = [
            'data_guru' => $data_guru
        ];

        $html = view('print/print_data_guru', $data);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPageOrientation('L');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        $pdf->writeHTML($html);

        $this->response->setContentType('application/pdf');

        $pdf->Output('Data Guru.pdf', 'I');
    }


    public function print_form_absen($kode_kelas)
    {
        // deskripsi data kelas
        $kodeKelas = base64_decode($kode_kelas);

        // ambil data kelas siswa
        $data_siswa = $this->kelasSiswaModel->findbyKodeKelas($kodeKelas);

        // ambil ruang kelas
        $kelas = $this->kelasModel->where('kode_kelas', $kodeKelas)->first();
        $ruang_kelas = $kelas['tingkat'] . " " . $kelas['ruang_kelas'];

        // ambil guru pengajar
        $jadwal = $this->jadwalModel->where('kode_kelas', $kodeKelas)->first();
        $guru = $jadwal['guru_pengajar'];

        // relasi kedalam table guru
        $data_guru = $this->guruModel->where('kode_guru', $guru)->first();
        $guru_pengajar = $data_guru['nama_lengkap'];

        $data = [
            'data_siswa' => $data_siswa,
            'ruang_kelas' => $ruang_kelas,
            'guru_pengajar' => $guru_pengajar
        ];

        $html = view('print/print_absensi_siswa', $data);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPageOrientation('L');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        $pdf->writeHTML($html);

        $this->response->setContentType('application/pdf');

        $pdf->Output('Form Absen.pdf', 'I');
    }


    public function print_jadwal_guru($kode_guru)
    {
        // deskripsi kode guru
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

        $html = view('print/print_jadwal_guru', $data);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPageOrientation('L');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        $pdf->writeHTML($html);

        $this->response->setContentType('application/pdf');

        $pdf->Output('Data_jadwal_guru.pdf', 'I');
    }


    public function print_nilai($kode_siswa)
    {
        // deskripsi kode guru
        $kodeSiswa = base64_decode($kode_siswa);

        // ambil data nilai
        $data_nilai = $this->nilaiModel->where('kode_siswa', $kodeSiswa)->findAll();
        // ambil data siswa
        $data_siswa = $this->siswaModel->where('kode_siswa', $kodeSiswa)->first();
        $nama_siswa = $data_siswa['nama_lengkap'];
        // relasi data kelas
        $kelas_siswa = $this->kelasSiswaModel->where('kode_siswa', $kodeSiswa)->first();
        $kode_kelas = $kelas_siswa['kode_kelas'];
        // ambil data ruang kelas
        $data_kelas = $this->kelasModel->where('kode_kelas', $kode_kelas)->first();
        $ruang_kelas = $data_kelas['tingkat'] . " " . $data_kelas['ruang_kelas'];

        $data = [
            'tittle' => 'Nilai Siswa',
            'data_nilai' => $data_nilai,
            'data_siswa' => $nama_siswa,
            'ruang_kelas' => $ruang_kelas
        ];

        $html = view('print/print_nilai', $data);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPageOrientation('L');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        $pdf->writeHTML($html);

        $this->response->setContentType('application/pdf');

        $pdf->Output('Nilai Siswa.pdf', 'I');
    }


    public function print_krs($kode_siswa)
    {
        // deskripsi
        $kodeSiswa = base64_decode($kode_siswa);

        // ambil data kelas
        $data_kelas = $this->kelasSiswaModel->where('kode_siswa', $kodeSiswa)->first();
        // ambil kode kelas
        $kode_kelas = $data_kelas['kode_kelas'];

        // ambil data kelas
        $kelas = $this->kelasModel->where('kode_kelas', $kode_kelas)->first();
        $ruang_kelas = $kelas['tingkat'] . " " . $kelas['ruang_kelas'];

        // ambil data jadwal
        $data_mapel = $this->jadwalModel->where('kode_kelas', $kode_kelas)->findAll();

        // ambil data siswa
        $data_siswa = $this->siswaModel->where('kode_siswa', $kodeSiswa)->first();

        $data = [
            'tittle' => 'KRS',
            'data_mapel' => $data_mapel,
            'kode_kelas' => $kode_kelas,
            'data_siswa' => $data_siswa,
            'ruang_kelas' => $ruang_kelas
        ];

        $html = view('print/print_krs', $data);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        $pdf->writeHTML($html);

        $this->response->setContentType('application/pdf');

        $pdf->Output('Nilai Siswa.pdf', 'I');
    }


    public function print_khs($kode_siswa)
    {
        // deskripsi kode guru
        $kodeSiswa = base64_decode($kode_siswa);

        // ambil data nilai
        $data_nilai = $this->nilaiModel->where('kode_siswa', $kodeSiswa)->findAll();
        // ambil data siswa
        $data_siswa = $this->siswaModel->where('kode_siswa', $kodeSiswa)->first();
        $nama_siswa = $data_siswa['nama_lengkap'];
        $nis = $data_siswa['nis'];
        // relasi data kelas
        $kelas_siswa = $this->kelasSiswaModel->where('kode_siswa', $kodeSiswa)->first();
        $kode_kelas = $kelas_siswa['kode_kelas'];
        // ambil data ruang kelas
        $data_kelas = $this->kelasModel->where('kode_kelas', $kode_kelas)->first();
        $ruang_kelas = $data_kelas['tingkat'] . " " . $data_kelas['ruang_kelas'];

        $data = [
            'tittle' => 'Nilai Siswa',
            'data_nilai' => $data_nilai,
            'data_siswa' => $nama_siswa,
            'nis' => $nis,
            'ruang_kelas' => $ruang_kelas
        ];

        $html = view('print/print_khs', $data);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        $pdf->writeHTML($html);

        $this->response->setContentType('application/pdf');

        $pdf->Output('KHS.pdf', 'I');
    }


    public function print_jadwal_siswa($kode_siswa)
    {
        $kodeSiswa = base64_decode($kode_siswa);

        // ambil data siswa
        $siswa = $this->siswaModel->where('kode_siswa', $kodeSiswa)->first();
        $nama_siswa = $siswa['nama_lengkap'];
        $nis = $siswa['nis'];

        // ambil kelas nya
        $data_kelas = $this->kelasSiswaModel->where('kode_siswa', $kodeSiswa)->first();
        // ambil kode kelas
        $kode_kelas = $data_kelas['kode_kelas'];

        // ambil data kelas
        $kelas = $this->kelasModel->where('kode_kelas', $kode_kelas)->first();
        $ruang_kelas = $kelas['tingkat'] . " " . $kelas['ruang_kelas'];

        // get data jadwal guru
        $jadwal = $this->jadwalModel->where('kode_kelas', $kode_kelas)->findAll();

        $data = [
            'tittle' => 'Data Jadwal',
            'jadwal' => $jadwal,
            'nama_siswa' => $nama_siswa,
            'nis' => $nis,
            'ruang_kelas' => $ruang_kelas
        ];

        $html = view('print/print_jadwal_siswa', $data);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPageOrientation('L');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        $pdf->writeHTML($html);

        $this->response->setContentType('application/pdf');

        $pdf->Output('jadwal siswa.pdf', 'I');
    }
}
