<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ruang Kelas</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card mb-2 shadow">
                <div class="card-header bg-info text-white">
                    <i class="fa fa-building-o mr-3" aria-hidden="true"></i>Ruang Kelas
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
                    <h5 class="card-title">Registrasi Ruang Kelas</h5>
                    <form action="<?= base_url(); ?>/kelas/proses_ruang_kelas" method="post">
                        <?php $now = date('Y'); ?>
                        <div class="row">
                            <?= csrf_field(); ?>

                            <div class="col-md-2">
                                <input type="hidden" value="<?= $now; ?>" name="tahun">
                                <input class="form-control form-control-sm <?= ($validation->hasError('kode_kelas') ? 'is-invalid' : ''); ?> mb-2" type="text" placeholder="Kode Kelas" value="<?= $kode_kelas; ?>" readonly name="kode_kelas">
                                <div class="invalid-feedback" style="font-size: small">
                                    <?= $validation->getError('kode_kelas'); ?>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control form-control-sm <?= ($validation->hasError('tingkat_kelas') ? 'is-invalid' : ''); ?> mb-2" name="tingkat_kelas">
                                    <option value="">Kelas</option>
                                    <option value="10" <?= old('tingkat_kelas') == '10' ? 'selected' : '' ?>>X (Sepuluh)</option>
                                    <option value="11" <?= old('tingkat_kelas') == '11' ? 'selected' : '' ?>>XI (Sebelas)</option>
                                    <option value="12" <?= old('tingkat_kelas') == '12' ? 'selected' : '' ?>>XII (Dua Belas)</option>
                                </select>
                                <div class="invalid-feedback" style="font-size: small">
                                    <?= $validation->getError('tingkat_kelas'); ?>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control form-control-sm <?= ($validation->hasError('ruang_kelas') ? 'is-invalid' : ''); ?> mb-2" name="ruang_kelas">
                                    <option value=" ">Ruang Kelas</option>
                                    <option value="A" <?= old('ruang_kelas') == 'A' ? 'selected' : '' ?>>A</option>
                                    <option value="B" <?= old('ruang_kelas') == 'B' ? 'selected' : '' ?>>B</option>
                                    <option value="C" <?= old('ruang_kelas') == 'C' ? 'selected' : '' ?>>C</option>
                                </select>
                                <div class="invalid-feedback" style="font-size: small">
                                    <?= $validation->getError('ruang_kelas'); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control form-control-sm <?= ($validation->hasError('wali_kelas') ? 'is-invalid' : ''); ?> mb-2" name="wali_kelas">
                                    <option value=" ">Wali Kelas</option>
                                    <?php foreach ($data_guru as $guru) : ?>
                                        <option value="<?= $guru['kode_guru']; ?>" <?= old('wali_kelas') == $guru['kode_guru'] ? 'selected' : '' ?>><?= $guru['nama_lengkap']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback" style="font-size: small">
                                    <?= $validation->getError('wali_kelas'); ?>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-info btn-sm">Add</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <form action="<?= base_url(); ?>/admin/tahun-ajaran" method="post">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="exampleFormControlSelect1">
                                <h6>Tahun Ajaran</h6>
                            </label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="tahun_ajaran">
                                <?php
                                $now = date('Y');
                                for ($now; $now >= 2017; $now -= 1) : ?>
                                    <option value=<?= $now; ?>> <?= $now; ?> </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-info btn-sm">Pilih</button>
                        </div>
                    </div>
                </form>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="card bg-light mb-3">
                            <div class="card-header bg-info text-white"><i class="fa fa-tasks mr-3" aria-hidden="true"></i>Kelas X (Sepuluh)</div>
                            <div class="card-body">
                                <?php foreach ($kelas as $kls) : ?>
                                    <?php $kode_kelas = base64_encode($kls['kode_kelas']) ?>
                                    <?php if ($kls['tingkat'] == '10') : ?>
                                        <ul class="list-group list-group-flush">
                                            <a href="<?= base_url() ?>/admin/kelas/<?= $kode_kelas ?>">
                                                <li class="list-group-item">Kelas <?= $kls['tingkat'] . " " . $kls['ruang_kelas']; ?></li>
                                            </a>
                                        </ul>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light mb-3">
                            <div class="card-header bg-info text-white"><i class="fa fa-tasks mr-3" aria-hidden="true"></i>Kelas XI (Sebelas)</div>
                            <div class="card-body">
                                <?php foreach ($kelas as $kls) : ?>
                                    <?php $kode_kelas = base64_encode($kls['kode_kelas']) ?>
                                    <?php if ($kls['tingkat'] == '11') : ?>
                                        <ul class="list-group list-group-flush">
                                            <a href="<?= base_url() ?>/admin/kelas/<?= $kode_kelas ?>">
                                                <li class="list-group-item">Kelas <?= $kls['tingkat'] . " " . $kls['ruang_kelas']; ?></li>
                                            </a>
                                        </ul>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <ul class="list-group list-group-flush">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light mb-3">
                            <div class="card-header bg-info text-white"><i class="fa fa-tasks mr-3" aria-hidden="true"></i>Kelas XII (Dua Belas)</div>
                            <div class="card-body">
                                <?php foreach ($kelas as $kls) : ?>
                                    <?php $kode_kelas = base64_encode($kls['kode_kelas']) ?>
                                    <?php if ($kls['tingkat'] == '12') : ?>
                                        <ul class="list-group list-group-flush">
                                            <a href="<?= base_url() ?>/admin/kelas/<?= $kode_kelas ?>">
                                                <li class="list-group-item">Kelas <?= $kls['tingkat'] . " " . $kls['ruang_kelas']; ?></li>
                                            </a>
                                        </ul>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <ul class="list-group list-group-flush">
                                </ul>
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