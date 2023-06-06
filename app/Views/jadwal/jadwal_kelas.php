<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <!-- enskripsi tahun -->
                        <?php $tahun = base64_encode($now = date('Y')) ?>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/admin/input-jadwal/<?= $tahun; ?>">Buat Jadwal Pelajaran</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jadwal Kelas</li>
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
                    <i class="fa fa-calendar-check-o mr-3" aria-hidden="true"></i>Input Jadwal Kelas <?= $ruang_kelas['tingkat'] . " " . $ruang_kelas['ruang_kelas']; ?>
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
                    <h5 class="card-title">Jadwal Pelajaran Kelas <?= $ruang_kelas['tingkat'] . " " . $ruang_kelas['ruang_kelas']; ?></h5>
                    <?php $kodeKelas = base64_encode($kode_kelas); ?>
                    <form action="<?= base_url(); ?>/jadwal/proses_input_jadwal/<?= $kodeKelas; ?>" method="post">
                        <div class="row">
                            <?= csrf_field(); ?>
                            <div class="col-md-2">
                                <input type="hidden" value="<?= $kode_kelas; ?>" name="kode_kelas">
                                <input type="hidden" value="<?= $kode_jadwal; ?>" name="kode_jadwal">
                                <select class="form-control form-control-sm  mb-2 <?= ($validation->hasError('semester') ? 'is-invalid' : ''); ?>" name="semester">
                                    <option value=" ">Semester</option>
                                    <option value="ganjil" <?= (old('semester') == 'ganjil' ? 'selected' : ''); ?>>Ganjil</option>
                                    <option value="genap" <?= (old('semester') == 'genap' ? 'selected' : ''); ?>>Genap</option>
                                </select>
                                <div class="invalid-feedback" style="font-size: small">
                                    <?= $validation->getError('semester'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <select class="form-control form-control-sm  mb-2 <?= ($validation->hasError('mapel') ? 'is-invalid' : ''); ?>" name="mapel">
                                    <option value=" ">Mata Pelajaran</option>
                                    <?php foreach ($mata_pelajaran as $data) : ?>
                                        <option value="<?= $data['kode_mapel']; ?>" <?= (old('mapel') == $data['kode_mapel'] ? 'selected' : ''); ?>><?= $data['nama_mapel']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback" style="font-size: small">
                                    <?= $validation->getError('mapel'); ?>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <select class="form-control form-control-sm  mb-2 <?= ($validation->hasError('hari') ? 'is-invalid' : ''); ?>" name="hari">
                                    <option value=" ">Hari</option>
                                    <option value="Senin" <?= (old('hari') == 'Senin' ? 'selected' : ''); ?>>Senin</option>
                                    <option value="Selasa" <?= (old('hari') == 'Selasa' ? 'selected' : ''); ?>>Selasa</option>
                                    <option value="Rabu" <?= (old('hari') == 'Rabu' ? 'selected' : ''); ?>>Rabu</option>
                                    <option value="Kamis" <?= (old('hari') == 'Kamis' ? 'selected' : ''); ?>>Kamis</option>
                                    <option value="Jumat" <?= (old('hari') == 'Jumat' ? 'selected' : ''); ?>>Jumat</option>
                                </select>
                                <div class="invalid-feedback" style="font-size: small">
                                    <?= $validation->getError('hari'); ?>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <select class="form-control form-control-sm  mb-2 <?= ($validation->hasError('jam') ? 'is-invalid' : ''); ?>" name="jam">
                                    <option value=" ">Jam Pelajaran</option>
                                    <option value="07:30 - 09:00" <?= (old('jam') == '07:30 - 09:00' ? 'selected' : ''); ?>>07:30 s/d 09:00</option>
                                    <option value="09:00 - 10:30" <?= (old('jam') == '09:00 - 10:30' ? 'selected' : ''); ?>>09:00 s/d 10:30</option>
                                    <option value="10:45 - 12:15" <?= (old('jam') == '10:45 - 12:15' ? 'selected' : ''); ?>>10:45 s/d 12:15</option>
                                    <option value="12:30 - 14:00" <?= (old('jam') == '12:30 - 14:00' ? 'selected' : ''); ?>>12:30 s/d 14:00</option>
                                </select>

                                <div class="invalid-feedback" style="font-size: small">
                                    <?= $validation->getError('jam'); ?>
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
                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="row mb-3 d-flex">
                                <div class="col-md-10 mb-2">
                                    <h4>Data Jadwal Pelajaran</h4>
                                </div>
                                <div class="col-md-2 mb-2" style="margin-right: -10px;">
                                    <?php $kodeKelas = base64_encode($kode_kelas) ?>
                                    <form action="<?= base_url(); ?>/printout/print_jadwal/<?= $kodeKelas; ?>" method="post">
                                        <?php csrf_field() ?>
                                        <button class="btn btn-outline-dark"> <i class="fa fa-print mr-2" aria-hidden="true"></i> Print PDF</button>
                                    </form>
                                </div>
                            </div>
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Jadwal</th>
                                        <th scope="col">Mata Pelajaran</th>
                                        <th scope="col">Guru Pengajar</th>
                                        <th scope="col">Hari</th>
                                        <th scope="col">Jam Pelajaran</th>
                                        <th scope="col">Ruang Kelas</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($jadwal as $data) : ?>
                                        <tr>
                                            <!-- enkripsi kode_mapel -->
                                            <?php $kode_jadwal = base64_encode($data['kode_jadwal']) ?>
                                            <?php $kode_kelas = base64_encode($data['kode_kelas']) ?>
                                            <td><?= $i; ?></td>
                                            <td><?= $data['kode_jadwal']; ?></td>
                                            <td><?= $data['mata_pelajaran']; ?></td>
                                            <td><?= $data['nama_lengkap'] ?></td>
                                            <td><?= $data['hari'] ?></td>
                                            <td><?= $data['jam_pelajaran'] ?></td>
                                            <td><?= $ruang_kelas['tingkat'] . " " . $ruang_kelas['ruang_kelas']; ?></td>
                                            <td><?= $data['smester'] ?></td>
                                            <td><a href="<?= base_url(); ?>/admin/edit-jadwal/<?= $kode_jadwal; ?>/<?= $kode_kelas; ?>" class="btn btn-warning btn-sm mb-2"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>
                                                <form action="<?= base_url(); ?>/admin/hapus-jadwal/<?= $kode_jadwal; ?>/<?= $kode_kelas; ?>" method="post" class="d-inline tombol-hapus">
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