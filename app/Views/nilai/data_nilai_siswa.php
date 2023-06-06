<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php
                        $kodeKelas = base64_encode($kode_kelas);
                        $kodeGuru = base64_encode($kode_guru);
                        ?>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/views/kelas-siswa">Kelas</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/views/data-siswa/<?= $kodeKelas ?>/<?= $kodeGuru; ?>">Data Siswa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Nilai</li>
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
                                <h4>Data Nilai</h4>
                            </div>
                            <div class="col-md-2 mb-2">
                                <?php $kodeKelas = base64_encode($kode_kelas) ?>
                                <?php $kodeSiswa = base64_encode($data_siswa['kode_siswa']) ?>
                                <form action="<?= base_url(); ?>/printout/print_nilai/<?= $kodeSiswa; ?>" method="post">
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
                                    <th scope="col">Guru Pengajar</th>
                                    <th scope="col">Nilai Hadir</th>
                                    <th scope="col">Nilai Tugas</th>
                                    <th scope="col">Nilai UTS</th>
                                    <th scope="col">Nilai UAS</th>
                                    <th scope="col">Nilai Akhir</th>
                                    <th scope="col">Grade</th>
                                    <th scope="col">Ket</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($data_nilai as $data) : ?>
                                    <?php
                                    $ket = "";
                                    if ($data['grade'] == 'A') {
                                        $ket = "Lulus";
                                    }
                                    if ($data['grade'] == 'B') {
                                        $ket = "Lulus";
                                    }
                                    if ($data['grade'] == 'C') {
                                        $ket = "Cukup";
                                    }
                                    if ($data['grade'] == 'D') {
                                        $ket = "Tidak Lulus";
                                    }
                                    if ($data['grade'] == 'E') {
                                        $ket = "Tidak Lulus";
                                    }
                                    ?>

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
                                        <td><?= $guru_pengajar['nama_lengkap'] ?></td>
                                        <td><?= $data['nilai_hadir']; ?></td>
                                        <td><?= $data['nilai_tugas'] ?></td>
                                        <td><?= $data['nilai_uts'] ?></td>
                                        <td><?= $data['nilai_uas'] ?></td>
                                        <td><?= $data['nilai_akhir'] ?></td>
                                        <td><?= $data['grade'] ?></td>
                                        <td><?= $ket ?></td>


                                        <td><a href="<?= base_url(); ?>/views/edit-nilai/<?= $kode_nilai; ?>" class="btn btn-warning btn-sm mb-2"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>

                                            <form action="<?= base_url(); ?>/nilai/hapus_nilai/<?= $kode_nilai; ?>/<?= $kodeSiswa ?>/<?= $kodeGuru; ?>/<?= $kodeKelas; ?>" method="post" class="d-inline tombol-hapus">
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
<?= $this->endSection(); ?>