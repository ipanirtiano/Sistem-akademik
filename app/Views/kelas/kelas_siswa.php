<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <!-- enskripsi tahun -->
                        <?php $tahun = base64_encode($now = date('Y')) ?>
                        <li class="breadcrumb-item"> <a href="<?= base_url(); ?>/admin/ruang-kelas/<?= $tahun; ?>">Ruang Kelas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ruang Kelas</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="card mb-2 shadow">
                <div class="card-header bg-info text-white">
                    <i class="fa fa-id-badge mr-3" aria-hidden="true"></i>Kelas <?= $kelas_siswa['tingkat'] . " " . $kelas_siswa['ruang_kelas']; ?>
                </div>
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('pesan_gagal')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_gagal'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <div class="row d-flex">
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-7 col-form-label"><a href="#" class="" data-toggle="modal" data-target="#siswa_baru" aria-hidden="true">Siswa Baru</a></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="inputPassword" value="<?= $jumlah_siswa; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <h6 class="card-title">Wali Kelas : <b><?= $wali_kelas['nama_lengkap']; ?></b> </h6>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="row justify-content-end">
                                <div class="col-md-5 mb-2">
                                    <?php $ruang_kelas = base64_encode($kelas_siswa['kode_kelas'])  ?>
                                    <form action="<?= base_url(); ?>/kelas/input_siswa_baru/<?= $ruang_kelas; ?>" method="post">
                                        <select class="form-control form-control-sm <?= ($validation->hasError('jumlah_siswa') ? 'is-invalid' : ''); ?>" name="jumlah_siswa">
                                            <option value=" ">Jumlah Siswa</option>
                                            <option value="10" <?= old('jumlah_siswa') == '10' ? 'selected' : '' ?>>10</option>
                                            <option value="20" <?= old('jumlah_siswa') == '20' ? 'selected' : '' ?>>20</option>
                                            <option value="25" <?= old('jumlah_siswa') == '25' ? 'selected' : '' ?>>25</option>
                                            <option value="30" <?= old('jumlah_siswa') == '30' ? 'selected' : '' ?>>30</option>
                                            <option value="35" <?= old('jumlah_siswa') == '35' ? 'selected' : '' ?>>35</option>
                                            <option value="40" <?= old('jumlah_siswa') == '40' ? 'selected' : '' ?>>40</option>
                                        </select>
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('jumlah_siswa'); ?>
                                        </div>
                                </div>
                                <div class="col-md-4 float-right mb-2">
                                    <button class="btn-info btn-sm"><i class="fa fa-check-square-o mr-2" aria-hidden="true"></i>input</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-2">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <i class="fa fa-cog mr-3" aria-hidden="true"></i>Side Menu
                </div>
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <a href="#" class="side-menu" data-toggle="modal" data-target="#staticBackdrop" aria-hidden="true">
                            <li class="list-group-item"><i class="fa fa-plus mr-3"></i>Tambah Siswa</li>
                        </a>
                        <a href="" class="side-menu">
                            <li class="list-group-item"> <i class="fa fa-trash-o mr-3" aria-hidden="true"></i>Hapus Kelas</li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="tambah_siswa" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h6 class="modal-title" id="tambah_siswa"><i class="fa fa-user-circle-o mr-3" aria-hidden="true"></i>Tambah Siswa</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php $ruang_kelas = base64_encode($kelas_siswa['kode_kelas'])  ?>
                    <form action="<?= base_url(); ?>/kelas/input_siswa_baru_manual/<?= $ruang_kelas; ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">NIS</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail3" name="nis" required autofocus>
                                <small id="emailHelp" class="form-text text-muted">Masukan NIS siswa yang akan dimasukan kedalam kelas.</small>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times mr-2" aria-hidden="true"></i>Batal</button>
                    <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end Modal -->

    <!-- Modal -->
    <div class="modal fade" id="siswa_baru" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fas fa-graduation-cap mr-2" aria-hidden="true"></i> Data Siswa Baru Tahun <?= $now = date('Y');; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow">
                                    <div class="card-header bg-info text-white">
                                        <i class="fa fas fa-graduation-cap mr-2" aria-hidden="true"></i> Data Siswa Baru Tahun <?= $now = date('Y');; ?>
                                    </div>

                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col">
                                                <div class="card">
                                                    <div class="card-body table-responsive">
                                                        <table class="table table-bordered table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">No</th>
                                                                    <th scope="col">NIS</th>
                                                                    <th scope="col">Nama Lengkap</th>
                                                                    <th scope="col">Tempat Tanggal Lahir</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <?php
                                                                $i = 1;
                                                                foreach ($siswa_baru as $data) :
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $i; ?></td>
                                                                        <!-- data kode siswa yang di encrypt -->
                                                                        <?php $kode_siswa = base64_encode($data['kode_siswa']) ?>
                                                                        <td><?= $data['nis']; ?></td>
                                                                        <td><?= $data['nama_lengkap']; ?></td>
                                                                        <td><?= $data['tempat_lahir'] . ", " . $data['tanggal_lahir'] ?></td>
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
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end modal -->

    <div class="row mb-2">
        <div class="col">
            <div class="card">

                <div class="card-body table-responsive">

                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">NIS</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Ruang Kelas</th>
                                <th scope="col">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($siswa as $data) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $data['nis']; ?></td>
                                    <td><?= $data['nama_lengkap']; ?></td>
                                    <td><?= $data['jenis_kelamin']; ?></td>
                                    <td><?= $kelas_siswa['tingkat'] . " " . $kelas_siswa['ruang_kelas']; ?></td>
                                    <?php $kode_siswa = base64_encode($data['kode_siswa'])  ?>
                                    <td><a href="<?= base_url(); ?>/Kelas/hapus_siswa/<?= $kode_siswa; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection(); ?>