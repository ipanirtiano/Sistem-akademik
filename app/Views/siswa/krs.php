<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">KRS</li>
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
                    <i class="fa fa-suitcase mr-3" aria-hidden="true"></i>Kartu Rencana Studi
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <div class="card mb-2 shadow">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <div class="row mb-3 d-flex">
                                            <div class="col-md-10 mb-2">
                                                <h4>Data KRS</h4>
                                            </div>
                                            <div class="col-md-2 mb-2" style="margin-right: -10px;">
                                                <?php $kode_siswa = base64_encode(session('kode_siswa')); ?>
                                                <form action="<?= base_url(); ?>/printout/print_krs/<?= $kode_siswa; ?>" method="post">
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
                                                    <th scope="col">Mata Pelajaran</th>
                                                    <th scope="col">Guru Pengajar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($data_mapel as $data) : ?>
                                                    <?php
                                                    // ambil mapel
                                                    $mapel = $data['mata_pelajaran'];
                                                    // ambil guru pengajar
                                                    $guru = $data['guru_pengajar'];

                                                    // query manual
                                                    $conn = mysqli_connect('localhost', 'root', '', 'sistem_akademik_v3');
                                                    $query = mysqli_query($conn, "SELECT * FROM mata_pelajaran WHERE nama_mapel = '" . $mapel . "'");
                                                    $data_mapel = mysqli_fetch_assoc($query);

                                                    $query = mysqli_query($conn, "SELECT * FROM guru WHERE kode_guru = '" . $guru . "'");
                                                    $data_guru = mysqli_fetch_assoc($query) ?>

                                                    <tr>
                                                        <td><?= $i; ?></td>
                                                        <td><?= $data_mapel['kode_mapel']; ?></td>
                                                        <td><?= $data['mata_pelajaran']; ?></td>
                                                        <td><?= $data_guru['nama_lengkap'] ?></td>
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
<?= $this->endSection(); ?>