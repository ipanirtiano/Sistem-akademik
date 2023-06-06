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
                        <li class="breadcrumb-item active" aria-current="page">Edit Siswa</li>
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
                                    <i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i> Edit Data Siswa
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">

                                <!-- Form input -->
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <form method="post" action="<?= base_url(); ?>/siswa/proses_edit_siswa/<?= $kode_siswa; ?>">
                                            <?= csrf_field() ?>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">NIS</label>
                                                <div class="col-md-5 mb-2">
                                                    <input type="text" class="form-control form-control-sm <?= ($validation->hasError('nis') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="NIP" name="nis" value="<?= $data_siswa['nis']; ?>" readonly>
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('nis'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <input type="text" class="form-control form-control-sm <?= ($validation->hasError('kode_siswa') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="kode_siswa" value="<?= $data_siswa['kode_siswa']; ?>" readonly>
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('kode_siswa'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nama Lengkap</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control form-control-sm <?= ($validation->hasError('namaLengkap') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Nama Lengkap" name="namaLengkap" value="<?= $data_siswa['nama_lengkap'] ?>">
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('namaLengkap'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Lahir</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control form-control-sm mb-2 <?= ($validation->hasError('tempat') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Tempat" name="tempat" value="<?= $data_siswa['tempat_lahir'] ?>">
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('tempat'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <select class="form-control form-control-sm mb-2 <?= ($validation->hasError('tanggal') ? 'is-invalid' : ''); ?>" name="tanggal">
                                                        <option selected="selected" value="">Tanggal</option>

                                                        <?php $ttl = explode(' ', $data_siswa['tanggal_lahir']);

                                                        ?>
                                                        <?php for ($a = 01; $a <= 32; $a += 1) : ?>
                                                            <option value="<?= $a; ?>" <?= $ttl[0] == $a ? 'selected' : ''; ?>> <?= $a; ?> </option>
                                                        <?php endfor; ?>


                                                    </select>
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('tanggal'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <select class="form-control form-control-sm mb-2 <?= ($validation->hasError('bulan') ? 'is-invalid' : ''); ?>" name="bulan">
                                                        <option selected="selected" value="">Bulan</option>
                                                        <?php
                                                        $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                                        $jlh_bln = count($bulan);
                                                        for ($c = 0; $c < $jlh_bln; $c += 1) : ?>
                                                            <option value="<?= $bulan[$c]; ?>" <?= $ttl[1] == $bulan[$c] ? 'selected' : '' ?>> <?= $bulan[$c]; ?> </option>
                                                        <?php endfor; ?>

                                                    </select>
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('bulan'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <select class="form-control form-control-sm mb-2 <?= ($validation->hasError('tahun') ? 'is-invalid' : ''); ?>" name="tahun">
                                                        <option selected="selected" value="">Tahun</option>
                                                        <?php
                                                        $now = date('Y');
                                                        for ($now; $now >= 1970; $now -= 1) : ?>
                                                            <option value=<?= $now; ?> <?= $ttl[2] == $now ? 'selected' : '' ?>> <?= $now; ?> </option>
                                                        <?php endfor; ?>


                                                    </select>
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('tahun'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Jenis Kelamin</label>
                                                <div class="col-sm-10">
                                                    <div class="form-check form-check-inline mt-1">
                                                        <input class="form-check-input <?= ($validation->hasError('jenis_kelamin') ? 'is-invalid' : ''); ?>" type="radio" name="jenis_kelamin" id="inlineRadio1" value="Laki-Laki" <?= $data_siswa['jenis_kelamin'] == 'Laki-Laki' ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="inlineRadio1" style="font-size:14px;">Laki-Laki</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input <?= ($validation->hasError('jenis_kelamin') ? 'is-invalid' : ''); ?>" type="radio" name="jenis_kelamin" id="inlineRadio2" value="Perempuan" <?= $data_siswa['jenis_kelamin'] == 'Perempuan' ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="inlineRadio2" style="font-size:14px;">Perempuan</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Alamat</label>
                                                <div class="col-sm-10">
                                                    <div class="form-group">
                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat" value="<?= $data_siswa['alamat']; ?>"><?= $data_siswa['alamat']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row px-3 justify-content-end">
                                                <button type="submit" class="btn btn-info float-right mr-2 btn-sm"><i class="fa fa-check-square-o mr-2" aria-hidden="true"></i>Update</button>
                                                <a href="<?= base_url(); ?>/admin/detail-siswa/<?= $kode_siswa; ?>"><button type="button" class="btn btn-danger float-right btn-sm"><i class="fa fa-times mr-2" aria-hidden="true"></i>Batal</button></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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