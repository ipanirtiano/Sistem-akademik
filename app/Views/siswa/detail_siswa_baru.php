<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php $kode_siswa = base64_encode($data_siswa_baru['kode_siswa']) ?>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/admin/siswa-baru">Data Siswa Baru</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Siswa Baru</li>
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
                    <i class="fa fas fa-user mr-3" aria-hidden="true"></i> Detail Siswa Baru
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2 justify-content-center">
                                <div class="col">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <p style="color: black" class="card-text">NIS : <?= $data_siswa_baru['nis']; ?></p>
                                            <p style="color: black" class="card-text">Nama Lengkap : <?= $data_siswa_baru['nama_lengkap']; ?></p>
                                            <p style="color: black" class="card-text">Tempat Lahir : <?= $data_siswa_baru['tempat_lahir']; ?></p>
                                            <p style="color: black" class="card-text">Tanggal Lahir : <?= $data_siswa_baru['tanggal_lahir']; ?></p>
                                            <p style="color: black" class="card-text">Jenis Kelamin : <?= $data_siswa_baru['jenis_kelamin']; ?></p>
                                            <p style="color: black" class="card-text">Alamat : <?= $data_siswa_baru['agama']; ?></p>
                                            <p style="color: black" class="card-text">Email : <?= $data_siswa_baru['alamat']; ?></p>
                                            <p style="color: black" class="card-text">No Telpon : <?= $data_siswa_baru['no_telpon']; ?></p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php $kode_siswa = base64_encode($data_siswa_baru['kode_siswa']) ?>

                            <a href="<?= base_url(); ?>/admin/edit-siswa-baru/<?= $kode_siswa; ?>" class="btn btn-warning btn-sm mr-2"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit Data</a>
                            <form action="<?= base_url(); ?>/admin/delete_siswa_baru/<?= $kode_siswa; ?>" method="post" class="d-inline tombol-hapus">
                                <input type="hidden" name="_method" value="DELETE">
                                <?= csrf_field(); ?>
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Hapus Data</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>