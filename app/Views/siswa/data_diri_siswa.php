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
                        <li class="breadcrumb-item active" aria-current="page">Data Diri</li>
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
                    <i class="fa fas fa-user mr-3" aria-hidden="true"></i> Data Diri
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2 justify-content-center">
                                <div class="col-lg-7">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <p style="color: black" class="card-text">NIs : <?= $data_siswa['nis']; ?></p>
                                            <p style="color: black" class="card-text">Nama Lengkap : <?= $data_siswa['nama_lengkap']; ?></p>
                                            <p style="color: black" class="card-text">Tempat Lahir : <?= $data_siswa['tempat_lahir']; ?></p>
                                            <p style="color: black" class="card-text">Tanggal Lahir : <?= $data_siswa['tanggal_lahir']; ?></p>
                                            <p style="color: black" class="card-text">Alamat : <?= $data_siswa['alamat']; ?></p>
                                            <p style="color: black" class="card-text">Email : <?= $data_siswa['email']; ?></p>
                                            <p style="color: black" class="card-text">No Telpon : <?= $data_siswa['no_telpon']; ?></p>
                                        </div>
                                    </div>
                                    <?php $kode_siswa = base64_encode($data_siswa['kode_siswa']) ?>
                                    <a href="<?= base_url(); ?>/view/all/<?= $kode_siswa; ?>" class="btn btn-info btn-sm mr-2 float-right"><i class="fa fas fa-folder-open-o mr-2" aria-hidden="true"></i>View all</a>
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