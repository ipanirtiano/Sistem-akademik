<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Jadwal</li>
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
                    <i class="fa fa-calendar-check-o mr-3" aria-hidden="true"></i>Data Jadwal
                </div>

                <div class="card-body">
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
                                                <?php $kodeGuru = base64_encode($kode_guru) ?>
                                                <form action="<?= base_url(); ?>/printout/print_jadwal_guru/<?= $kodeGuru; ?>" method="post">
                                                    <?php csrf_field() ?>
                                                    <button class="btn btn-outline-dark"> <i class="fa fa-print mr-2" aria-hidden="true"></i> Print PDF</button>
                                                </form>
                                            </div>
                                        </div>
                                        <table class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Mata Pelajaran</th>
                                                    <th scope="col">Guru Pengajar</th>
                                                    <th scope="col">Hari</th>
                                                    <th scope="col">Jam Pelajaran</th>
                                                    <th scope="col">Ruang Kelas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($jadwal as $data) : ?>
                                                    <?php
                                                    $kodeKelas = $data['kode_kelas'];

                                                    // query manual
                                                    $conn = mysqli_connect('localhost', 'root', '', 'sistem_akademik_v3');
                                                    $query = mysqli_query($conn, "SELECT * FROM kelas WHERE kode_kelas = '" . $kodeKelas . "' ORDER BY ruang_kelas ASC");
                                                    $data_kelas = mysqli_fetch_assoc($query) ?>

                                                    <tr>
                                                        <!-- enkripsi kode_mapel -->
                                                        <?php $kode_jadwal = base64_encode($data['kode_jadwal']) ?>
                                                        <?php $kode_kelas = base64_encode($data['kode_kelas']) ?>
                                                        <td><?= $i; ?></td>
                                                        <td><?= $data['mata_pelajaran']; ?></td>
                                                        <td><?= $guru_pengajar ?></td>
                                                        <td><?= $data['hari'] ?></td>
                                                        <td><?= $data['jam_pelajaran'] ?></td>
                                                        <td>Kelas <b><?= " " . $data_kelas['tingkat'] . " " . $data_kelas['ruang_kelas']; ?></b></td>
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