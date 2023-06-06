<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php foreach ($mapel as $data_mapel) : ?>
                            <?php $kode_mapel = base64_encode($data_mapel['kode_mapel']) ?>
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/admin/input-mapel">Input Mata Pelajaran</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Mapel</li>
                    </ol>
                </nav>
            </div>

            <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

            <div class="row justify-content-center">
                <div class="col">
                    <!-- card -->
                    <div class="card shadow">
                        <div class="card-header bg-info text-white">
                            <div class="row">
                                <div class="col">
                                    <i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i> Edit Mata Pelajaran
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">

                                <!-- Form input -->
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <form method="post" action="<?= base_url(); ?>/MataPelajaran/proses_edit_mapel/<?= $kode_mapel; ?>">
                                            <?= csrf_field() ?>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Kode Mapel</label>
                                                <div class="col-md-5 mb-2">
                                                    <input type="text" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Kode Mapel" name="kode_mapel" value="<?= $data_mapel['kode_mapel']; ?>" readonly>
                                                    <div class="invalid-feedback" style="font-size: small">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nama Mapel</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control form-control-sm <?= ($validation->hasError('mapel') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Nama Mapel" name="mapel" value="<?= $data_mapel['nama_mapel']; ?>">
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('mapel'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Guru Pengajar</label>
                                                <div class="col-md-5">
                                                    <select class="form-control form-control-sm  mb-2 <?= ($validation->hasError('guru_pengajar') ? 'is-invalid' : ''); ?>" name="guru_pengajar">
                                                        <option value=" ">Guru Pengajar</option>
                                                        <?php foreach ($guru as $data_guru) : ?>
                                                            <option value="<?= $data_guru['kode_guru']; ?>" <?= ($data_guru['kode_guru'] == $data_mapel['kode_guru'] ? 'selected' : ''); ?>><?= $data_guru['nama_lengkap']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('guru_pengajar'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row px-3 justify-content-end">
                                                <button type="submit" class="btn btn-info float-right mr-2 btn-sm"><i class="fa fa-check-square-o mr-2" aria-hidden="true"></i>Update</button>
                                                <a href="<?= base_url(); ?>/admin/input-mapel"><button type="button" class="btn btn-danger float-right btn-sm"><i class="fa fa-times mr-2" aria-hidden="true"></i>Batal</button></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!-- Akhir form input -->

                            </blockquote>
                        </div>
                    </div>
                    <!-- akhir card -->
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>