<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php $kode_guru = base64_encode($data_guru['kode_guru']) ?>
                        <?php $nik = base64_encode(session('nomor_induk')); ?>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/views/data-diri/<?= $nik ?>">Data Diri</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Data Diri</li>
                    </ol>
                </nav>
            </div>
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
                                <div class="col-lg-6">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <p style="color: black" class="card-text">NIK : <?= $data_guru['nik']; ?></p>
                                            <p style="color: black" class="card-text">NIP : <?= $data_guru['nip']; ?></p>
                                            <p style="color: black" class="card-text">Nama Lengkap : <?= $data_guru['nama_lengkap']; ?></p>
                                            <p style="color: black" class="card-text">Tempat Lahir : <?= $data_guru['tempat_lahir']; ?></p>
                                            <p style="color: black" class="card-text">Tanggal Lahir : <?= $data_guru['tanggal_lahir']; ?></p>
                                            <p style="color: black" class="card-text">Jenis Kelamin : <?= $data_guru['jenis_kelamin']; ?></p>
                                            <p style="color: black" class="card-text">Pendidikan Terakhir : <?= $data_guru['pendidikan_akhir']; ?></p>
                                            <p style="color: black" class="card-text">Agama : <?= $data_guru['agama']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <p style="color: black" class="card-text">Alamat : <?= $data_guru['alamat']; ?></p>
                                            <p style="color: black" class="card-text">Email : <?= $data_guru['email']; ?></p>
                                            <p style="color: black" class="card-text">No Telpon : <?= $data_guru['no_telpon']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <a href="<?= base_url(); ?>/views/update/<?= $kode_guru; ?>" class="btn btn-warning btn-sm mr-2"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Update Data</a>
                                <a href="<?= base_url(); ?>/views/data-diri/<?= $nik ?>" class="btn btn-info btn-sm mr-2"><i class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>