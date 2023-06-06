<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <!-- enskripsi tahun -->
                        <?php $tahun = base64_encode($now = date('Y')) ?>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/admin/data-kelas/<?= $tahun; ?>">Data Kelas</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/admin/kelas-siswa/<?= $kode_kelas; ?>">Data Kelas Siswa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Siswa</li>

                    </ol>
                </nav>
            </div>

            <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <i class="fa fas fa-user mr-3" aria-hidden="true"></i> Detail Siswa
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2 justify-content-center">
                                <div class="col-lg-7">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <p style="color: black" class="card-text">NIS : <?= $data_siswa['nis']; ?></p>
                                            <p style="color: black" class="card-text">Nama Lengkap : <?= $data_siswa['nama_lengkap']; ?></p>
                                            <p style="color: black" class="card-text">Tempat Lahir : <?= $data_siswa['tempat_lahir']; ?></p>
                                            <p style="color: black" class="card-text">Tanggal Lahir : <?= $data_siswa['tanggal_lahir']; ?></p>
                                            <p style="color: black" class="card-text">Alamat : <?= $data_siswa['alamat']; ?></p>
                                            <p style="color: black" class="card-text">Email : <?= $data_siswa['email']; ?></p>
                                            <p style="color: black" class="card-text">No Telpon : <?= $data_siswa['no_telpon']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>