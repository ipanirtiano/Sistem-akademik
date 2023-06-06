<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Kelas</li>
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
                    <i class="fa fa-line-chart mr-3" aria-hidden="true"></i> Data Kelas
                </div>

                <?php if (session()->getFlashdata('pesan_gagal')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_gagal'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="card shadow">
                    <div class="card-body">

                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="card bg-light mb-3">
                                    <div class="card-header bg-info text-white"><i class="fa fa-tasks mr-3" aria-hidden="true"></i>Kelas X (Sepuluh)</div>
                                    <div class="card-body">
                                        <?php foreach ($kelas as $kls) : ?>
                                            <?php $kode_kelas = base64_encode($kls['kode_kelas']) ?>
                                            <?php if ($kls['tingkat'] == '10') : ?>
                                                <ul class="list-group list-group-flush">
                                                    <a href="<?= base_url() ?>/admin/kelas-siswa/<?= $kode_kelas ?>">
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
                                                    <a href="<?= base_url() ?>/admin/kelas-siswa/<?= $kode_kelas ?>">
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
                                                    <a href="<?= base_url() ?>/admin/kelas-siswa/<?= $kode_kelas ?>">
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
</div>
<?= $this->endSection(); ?>