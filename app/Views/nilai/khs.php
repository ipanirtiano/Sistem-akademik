<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">KHS</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>


    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card mb-2 shadow">
                <div class="card">
                    <div class="card-body table-responsive">
                        <div class="row mb-3 d-flex">
                            <div class="col-md-10 mb-2">
                                <h5>Kartu Hasil Studi</h5>
                            </div>
                            <div class="col-md-2 mb-2">

                                <?php $kodeSiswa = base64_encode($data_siswa['kode_siswa']) ?>
                                <form action="<?= base_url(); ?>/printout/print_khs/<?= $kodeSiswa; ?>" method="post">
                                    <?php csrf_field() ?>
                                    <button class="btn btn-outline-dark"> <i class="fa fa-print mr-2" aria-hidden="true"></i> Print PDF</button>
                                </form>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <h5>Nama : <?= $data_siswa['nama_lengkap']; ?></h5>
                                <h5>kelas : <?= $ruang_kelas ?></h5>
                            </div>
                        </div>

                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Mata Pelajaran</th>
                                    <th scope="col">Nilai Hadir</th>
                                    <th scope="col">Nilai Tugas</th>
                                    <th scope="col">Nilai UTS</th>
                                    <th scope="col">Nilai UAS</th>
                                    <th scope="col">Nilai Akhir</th>
                                    <th scope="col">Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($data_nilai as $data) : ?>

                                    <?php
                                    $kodeGuru = $data['kode_guru'];
                                    // query manual
                                    $conn = mysqli_connect('localhost', 'root', '', 'sistem_akademik_v3');
                                    $query = mysqli_query($conn, "SELECT * FROM guru WHERE kode_guru = '" . $kodeGuru . "'");
                                    $guru_pengajar = mysqli_fetch_assoc($query);
                                    ?>
                                    <tr>
                                        <!-- enkripsi kode_mapel -->
                                        <?php $kode_nilai = base64_encode($data['kode_nilai']) ?>
                                        <td><?= $i; ?></td>
                                        <td><?= $data['mapel']; ?></td>
                                        <td><?= $data['nilai_hadir']; ?></td>
                                        <td><?= $data['nilai_tugas'] ?></td>
                                        <td><?= $data['nilai_uts'] ?></td>
                                        <td><?= $data['nilai_uas'] ?></td>
                                        <td><?= $data['nilai_akhir'] ?></td>
                                        <td><?= $data['grade'] ?></td>
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
<?= $this->endSection(); ?>