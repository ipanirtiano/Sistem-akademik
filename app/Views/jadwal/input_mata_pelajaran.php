<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Input Mata Pelajaran</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-2 shadow">
                <div class="card-header bg-info text-white">
                    <i class="fa fa-book mr-3" aria-hidden="true"></i>Mata Pelajaran
                </div>

                <?php if (session()->getFlashdata('pesan_gagal')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_gagal'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title">Registrasi Mata Pelajaran</h5>
                    <form action="<?= base_url(); ?>/MataPelajaran/proses_input_mapel" method="post">
                        <div class="row">
                            <?= csrf_field(); ?>
                            <div class="col-md-2">
                                <input class="form-control form-control-sm mb-2" type="text" placeholder="Kode Mapel" value="<?= $kode_mapel; ?>" readonly name="kode_mapel">
                                <div class="invalid-feedback" style="font-size: small">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <input class="form-control form-control-sm mb-2 <?= ($validation->hasError('mapel') ? 'is-invalid' : ''); ?>" type="text" placeholder="Mata Pelajaran" value="" name="mapel">
                                <div class="invalid-feedback" style="font-size: small">
                                    <?= $validation->getError('mapel'); ?>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <select class="form-control form-control-sm  mb-2 <?= ($validation->hasError('guru_pengajar') ? 'is-invalid' : ''); ?>" name="guru_pengajar">
                                    <option value=" ">Guru Pengajar</option>
                                    <?php foreach ($guru as $data_guru) : ?>
                                        <option value="<?= $data_guru['kode_guru']; ?>"><?= $data_guru['nama_lengkap']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback" style="font-size: small">
                                    <?= $validation->getError('guru_pengajar'); ?>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <button class="btn btn-info btn-sm"><i class="fa fa-check-square-o mr-2" aria-hidden="true"></i>Input</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card mb-2 shadow">

                    <div class="card-body table-responsive">
                        <div class="row mb-5 d-flex">
                            <div class="col-md-10 mb-2">
                                <h4>Data Mata Pelajaran</h4>
                            </div>
                            <div class="col-md-2 mb-2" style="margin-right: -10px;">
                                <form action="<?= base_url(); ?>/printout/print_mata_pelajaran" method="post">
                                    <?php csrf_field() ?>
                                    <button class="btn btn-outline-dark"> <i class="fa fa-print mr-2" aria-hidden="true"></i> Print PDF</button>
                                </form>
                            </div>
                        </div>


                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Mapel</th>
                                    <th scope="col">Nama Mata Pelajaran</th>
                                    <th scope="col">Guru Pengajar</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($mata_pelajaran as $data) : ?>
                                    <tr>
                                        <!-- enkripsi kode_mapel -->
                                        <?php $kode_mapel = base64_encode($data['kode_mapel']) ?>
                                        <td><?= $i; ?></td>
                                        <td><?= $data['kode_mapel']; ?></td>
                                        <td><?= $data['nama_mapel']; ?></td>
                                        <td><?= $data['nama_lengkap'] ?></td>
                                        <td><a href="<?= base_url(); ?>/admin/edit-mapel/<?= $kode_mapel; ?>" class="btn btn-warning btn-sm mb-2"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>
                                            <form action="<?= base_url(); ?>/admin/hapus-mapel/<?= $kode_mapel; ?>" method="post" class="d-inline tombol-hapus">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <?= csrf_field(); ?>
                                                <button type="submit" class="btn btn-danger btn-sm mb-2"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                    $i++;
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
<?= $this->endSection(); ?>