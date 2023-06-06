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

                                <div class="col-lg-5">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="row justify-content-center">
                                                <img src="<?= base_url(); ?>/img/users/<?= $data_siswa['foto']; ?>" alt="" width="200px" class="mb-2 img-preview img-responsive thumbnail mb-3">
                                            </div>

                                            <div class="row justify-content-center px-3">
                                                <form action="<?= base_url(); ?>/admin/upload-siswa/<?= $kode_siswa; ?>" method="post" enctype="multipart/form-data">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" value="<?= $data_siswa['foto']; ?>" name="foto_lama">
                                                    <div class="custom-file mb-3">

                                                        <input type="file" class="custom-file-input <?= ($validation->hasError('foto') ? 'is-invalid' : ''); ?>" id="fotoProfile" required name="foto" onchange="previewImg()">
                                                        <div id=" validationServer03Feedback" class="invalid-feedback">
                                                            <?= $validation->getError('foto'); ?>
                                                        </div>
                                                        <label class="custom-file-label" for="validatedCustomFile">Pilih foto...</label>
                                                    </div>
                                                    <div class="row justify-content-end px-3">
                                                        <button type="submit" class="btn btn-info btn-sm btn-block"><i class="fa fa-upload mr-3" aria-hidden="true"></i>upload foto</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $kode_siswa = base64_encode($data_siswa['kode_siswa']) ?>
                            <a href="<?= base_url(); ?>/admin/view-all/<?= $kode_siswa; ?>" class="btn btn-info btn-sm mr-2"><i class="fa fas fa-folder-open-o mr-2" aria-hidden="true"></i>View all</a>
                            <a href="<?= base_url(); ?>/admin/edit-siswa/<?= $kode_siswa; ?>" class="btn btn-warning btn-sm mr-2"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit Data</a>
                            <form action="<?= base_url(); ?>/admin/delete_siswa/<?= $kode_siswa; ?>" method="post" class="d-inline tombol-hapus">
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