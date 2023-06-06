<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php $tahun = base64_encode($now = date('Y')) ?>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/admin/jadwal/<?= $kode_kelas; ?>">Jadwal Kelas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Jadwal Kelas</li>
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
                                    <i class="fa fa-calendar-check-o mr-3" aria-hidden="true"></i> Edit Data Jadwal
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">

                                <!-- enkripsi kode_mapel -->
                                <?php $kode_jadwal = base64_encode($data['kode_jadwal']) ?>
                                <?php $kode_kelas = base64_encode($data['kode_kelas']) ?>
                                <!-- Form input -->
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <form method="post" action="<?= base_url(); ?>/jadwal/proses_edit_jadwal/<?= $kode_jadwal ?>/<?= $kode_kelas ?>">
                                            <?= csrf_field() ?>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Kode Jadwal</label>
                                                <div class="col-md-5 mb-2">
                                                    <input type="text" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Kode Mapel" name="kode_jadwal" value="<?= $data['kode_jadwal']; ?>" readonly>
                                                    <div class="invalid-feedback" style="font-size: small">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Mata Pelajaran</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Nama Mapel" name="mapel" value="<?= $data['mata_pelajaran']; ?>" readonly>
                                                    <div class="invalid-feedback" style="font-size: small">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Guru Pengajar</label>
                                                <div class="col-md-5">
                                                    <select class="form-control form-control-sm  mb-2 <?= ($validation->hasError('guru_pengajar') ? 'is-invalid' : ''); ?>" name="guru_pengajar">
                                                        <option value=" ">Guru Pengajar</option>
                                                        <?php foreach ($guru as $data_guru) : ?>
                                                            <option value="<?= $data_guru['kode_guru']; ?>" <?= ($data_guru['kode_guru'] == $data['guru_pengajar'] ? 'selected' : ''); ?>><?= $data_guru['nama_lengkap']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('guru_pengajar'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Hari</label>
                                                <div class="col-md-5">
                                                    <select class="form-control form-control-sm  mb-2  <?= ($validation->hasError('hari') ? 'is-invalid' : ''); ?>" name="hari">
                                                        <option value=" ">Hari</option>
                                                        <option value="Senin" <?= ($data['hari'] == 'Senin' ? 'selected' : ''); ?>>Senin</option>
                                                        <option value="Selasa" <?= ($data['hari'] == 'Selasa' ? 'selected' : ''); ?>>Selasa</option>
                                                        <option value="Rabu" <?= ($data['hari'] == 'Rabu' ? 'selected' : ''); ?>>Rabu</option>
                                                        <option value="Kamis" <?= ($data['hari'] == 'Kamis' ? 'selected' : ''); ?>>Kamis</option>
                                                        <option value="Jumat" <?= ($data['hari'] == 'Jumat' ? 'selected' : ''); ?>>Jumat</option>
                                                    </select>
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('hari'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Jam Pelajaran</label>
                                                <div class="col-md-5">
                                                    <select class="form-control form-control-sm  mb-2 <?= ($validation->hasError('jam') ? 'is-invalid' : ''); ?>" name="jam">
                                                        <option value=" ">Jam Pelajaran</option>
                                                        <option value="07:30 - 08:15" <?= ($data['jam_pelajaran'] == '07:30 - 08:15' ? 'selected' : ''); ?>>07:30 s/d 08:15</option>
                                                        <option value="08:15 - 09:00" <?= ($data['jam_pelajaran'] == '08:15 - 09:00' ? 'selected' : ''); ?>>08:15 s/d 09:00</option>
                                                        <option value="09:00 - 09:45" <?= ($data['jam_pelajaran'] == '09:00 - 09:45' ? 'selected' : ''); ?>>09:00 s/d 09:45</option>
                                                        <option value="10:00 - 10:45" <?= ($data['jam_pelajaran'] == '10:00 - 10:45' ? 'selected' : ''); ?>>10:00 s/d 10:45</option>
                                                        <option value="10:45 - 11:30" <?= ($data['jam_pelajaran'] == '10:45 - 11:30' ? 'selected' : ''); ?>>10:45 s/d 11:30</option>
                                                        <option value="11:45 - 12:30" <?= ($data['jam_pelajaran'] == '11:45 - 12:30' ? 'selected' : ''); ?>>11:45 s/d 12:30</option>
                                                        <option value="12:30 - 13:15" <?= ($data['jam_pelajaran'] == '12:30 - 13:15' ? 'selected' : ''); ?>>12:30 s/d 13:15</option>
                                                        <option value="13:15 - 14:00" <?= ($data['jam_pelajaran'] == '13:15 - 14:00' ? 'selected' : ''); ?>>13:15 s/d 14:00</option>
                                                    </select>
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('jam'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Semester</label>
                                                <div class="col-md-5">
                                                    <select class="form-control form-control-sm  mb-2 <?= ($validation->hasError('semester') ? 'is-invalid' : ''); ?>" name="semester">
                                                        <option value=" ">Semester</option>
                                                        <option value="ganjil" <?= ($data['smester'] == 'ganjil' ? 'selected' : ''); ?>>Ganjil</option>
                                                        <option value="genap" <?= ($data['smester'] == 'genap' ? 'selected' : ''); ?>>Genap</option>
                                                    </select>
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('semester'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row px-3 justify-content-end">
                                                <button type="submit" class="btn btn-info float-right mr-2 btn-sm"><i class="fa fa-check-square-o mr-2" aria-hidden="true"></i>Update</button>
                                                <a href="<?= base_url(); ?>/admin/jadwal/<?= $kode_kelas; ?>"> <button type="button" class="btn btn-danger float-right btn-sm"><i class="fa fa-times mr-2" aria-hidden="true"></i>Batal</button></a>
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