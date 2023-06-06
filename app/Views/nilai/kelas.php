<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kelas</li>
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

                        <div class="row mb-2">
                            <div class="col">
                                <h5><i class="fa fa-clipboard mr-3" aria-hidden="true"></i> Input Nilai Siswa</h5>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="card bg-light mb-3">
                                    <div class="card-header bg-info text-white"><i class="fa fa-tasks mr-3" aria-hidden="true"></i>Kelas X (Sepuluh)</div>
                                    <div class="card-body">
                                        <?php foreach ($jadwal as $kls) :
                                            $kode_kelas = base64_encode($kls['kode_kelas']);
                                            $kode_guru = base64_encode($kls['kode_guru']);
                                            $kodeKelas = $kls['kode_kelas'];

                                            // query manual
                                            $conn = mysqli_connect('localhost', 'root', '', 'sistem_akademik_v3');
                                            $query = mysqli_query($conn, "SELECT * FROM kelas WHERE kode_kelas = '" . $kodeKelas . "' ORDER BY kode_kelas ASC");
                                            $data = mysqli_fetch_assoc($query);


                                            if ($data['tingkat'] == '10') : ?>
                                                <ul class="list-group list-group-flush">
                                                    <a href="<?= base_url() ?>/views/siswa/<?= $kode_kelas ?>/<?= $kode_guru; ?>">
                                                        <li class="list-group-item">Kelas <?= $data['tingkat'] . " " . $data['ruang_kelas']; ?></li>
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
                                        <?php foreach ($jadwal as $kls) :
                                            $kode_kelas = base64_encode($kls['kode_kelas']);
                                            $kodeKelas = $kls['kode_kelas'];

                                            // query manual
                                            $conn = mysqli_connect('localhost', 'root', '', 'sistem_akademik_v3');
                                            $query = mysqli_query($conn, "SELECT * FROM kelas WHERE kode_kelas = '" . $kodeKelas . "' ORDER BY ruang_kelas ASC");
                                            $data = mysqli_fetch_assoc($query) ?>

                                            <?php if ($data['tingkat'] == '11') : ?>
                                                <ul class="list-group list-group-flush">
                                                    <a href="<?= base_url() ?>/views/siswa/<?= $kode_kelas ?>/<?= $kode_guru; ?>">
                                                        <li class="list-group-item">Kelas <?= $data['tingkat'] . " " . $data['ruang_kelas']; ?></li>
                                                    </a>
                                                </ul>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card bg-light mb-3">
                                    <div class="card-header bg-info text-white"><i class="fa fa-tasks mr-3" aria-hidden="true"></i>Kelas XII (Dua Belas)</div>
                                    <div class="card-body">
                                        <?php foreach ($jadwal as $kls) :
                                            $kode_kelas = base64_encode($kls['kode_kelas']);
                                            $kodeKelas = $kls['kode_kelas'];

                                            // query manual
                                            $conn = mysqli_connect('localhost', 'root', '', 'sistem_akademik_v3');
                                            $query = mysqli_query($conn, "SELECT * FROM kelas WHERE kode_kelas = '" . $kodeKelas . "' ORDER BY ruang_kelas ASC");
                                            $data = mysqli_fetch_assoc($query) ?>

                                            <?php if ($data['tingkat'] == '12') : ?>
                                                <ul class="list-group list-group-flush">
                                                    <a href="<?= base_url() ?>/views/siswa/<?= $kode_kelas ?>/<?= $kode_guru; ?>">
                                                        <li class="list-group-item">Kelas <?= $data['tingkat'] . " " . $data['ruang_kelas']; ?></li>
                                                    </a>
                                                </ul>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
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