<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php $kode_siswa = base64_encode($data_siswa['kode_siswa']) ?>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/admin/data-siswa">Data Siswa</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/admin/detail-siswa/<?= $kode_siswa; ?>">Detail Siswa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View All</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <i class="fa fas fa-user mr-3" aria-hidden="true"></i> Data Siswa
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2 justify-content-center">
                                <div class="col-lg-6">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <p style="color: black" class="card-text">NIS : <?= $data_siswa['nis']; ?></p>
                                            <p style="color: black" class="card-text">Nama Lengkap : <?= $data_siswa['nama_lengkap']; ?></p>
                                            <p style="color: black" class="card-text">Tempat Lahir : <?= $data_siswa['tempat_lahir']; ?></p>
                                            <p style="color: black" class="card-text">Tanggal Lahir : <?= $data_siswa['tanggal_lahir']; ?></p>
                                            <p style="color: black" class="card-text">Jenis Kelamin : <?= $data_siswa['jenis_kelamin']; ?></p>
                                            <p style="color: black" class="card-text">Agama : <?= $data_siswa['agama']; ?></p>
                                            <p style="color: black" class="card-text">Alamat : <?= $data_siswa['alamat']; ?></p>
                                            <p style="color: black" class="card-text">Email : <?= $data_siswa['email']; ?></p>
                                            <p style="color: black" class="card-text">No Telpon : <?= $data_siswa['no_telpon']; ?></p>
                                            <p style="color: black" class="card-text">Asal Sekolah : <?= $data_siswa['nama_asal_sekolah']; ?></p>
                                            <p style="color: black" class="card-text">Alamat Asal Sekolah : <?= $data_siswa['alamat_asal_sekolah']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <p style="color: black" class="card-text">Nomor Ijazah : <?= $data_siswa['nomor_ijazah']; ?></p>
                                            <p style="color: black" class="card-text">Tahun Ijazah : <?= $data_siswa['tahun_ijazah']; ?></p>
                                            <p style="color: black" class="card-text">Nomor SKHUN : <?= $data_siswa['nomor_skhun']; ?></p>
                                            <p style="color: black" class="card-text">Tahun SKHUN : <?= $data_siswa['tahun_skhun']; ?></p>
                                            <p style="color: black" class="card-text">Nama Ayah : <?= $data_siswa['nama_ayah']; ?></p>
                                            <p style="color: black" class="card-text">Nama Ibu : <?= $data_siswa['nama_ibu']; ?></p>
                                            <p style="color: black" class="card-text">Nama Ibu : <?= $data_siswa['nama_ibu']; ?></p>
                                            <p style="color: black" class="card-text">Alamat Orang Tua : <?= $data_siswa['alamat_orangtua']; ?></p>
                                            <p style="color: black" class="card-text">Telpon Orang Tua : <?= $data_siswa['telpon_orangtua']; ?></p>
                                            <p style="color: black" class="card-text">Pekerjaan Ayah : <?= $data_siswa['pekerjaan_ayah']; ?></p>
                                            <p style="color: black" class="card-text">Pekerjaan Ibu : <?= $data_siswa['pekerjaan_ibu']; ?></p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">

                                <a href="<?= base_url(); ?>/admin/detail-siswa/<?= $kode_siswa; ?>" class="btn btn-info btn-sm mr-2"><i class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>