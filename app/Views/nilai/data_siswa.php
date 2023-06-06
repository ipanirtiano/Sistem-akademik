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
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/views/kelas-siswa">Kelas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>


    <div class="row mb-2">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <i class="fa fas fa-user mr-3" aria-hidden="true"></i> Data Siswa <b>Kelas <?= $kelas_siswa['tingkat'] . " " . $kelas_siswa['ruang_kelas']; ?></b>
                </div>


                <div class="card-body table-responsive">
                    <div class="row justify-content-end">
                        <div class="col-md-6 mb-2">
                            <h5 class="card-title mb-4">Data Siswa <b>Kelas <?= $kelas_siswa['tingkat'] . " " . $kelas_siswa['ruang_kelas']; ?></b></h5>
                        </div>
                        <div class="col-md-6 mb-2">
                            <form action="" method="post">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Cari data.." name="cari">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search mr-2" aria-hidden="true"></i>Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">NIS</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Ruang Kelas</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($siswa as $data) : ?>
                                <?php
                                $kode_siswa = $data['kode_siswa'];
                                // query manual
                                $conn = mysqli_connect('localhost', 'root', '', 'sistem_akademik_v3');
                                $query = mysqli_query($conn, "SELECT * FROM nilai WHERE kode_siswa = '" . $kode_siswa . "'");
                                $data_nilai_siswa = mysqli_fetch_assoc($query);
                                ?>
                                <tr>
                                    <!-- data kode guru yang di encrypt -->
                                    <?php $kode_siswa = base64_encode($data['kode_siswa']) ?>
                                    <?php $kodeGuru = base64_encode($kode_guru) ?>
                                    <!-- enksripsi kode kelas -->
                                    <?php $kode_kelas = base64_encode($data['kode_kelas']); ?>
                                    <td><?= $i; ?></td>
                                    <td><?= $data['nis']; ?></td>
                                    <td><?= $data['nama_lengkap']; ?></td>
                                    <td><?= $data['jenis_kelamin']; ?></td>
                                    <td><?= $kelas_siswa['tingkat'] . " " . $kelas_siswa['ruang_kelas']; ?></td>
                                    <td>
                                        <form action="<?= base_url(); ?>/views/data-nilai/<?= $kode_siswa ?>/<?= $kodeGuru; ?>/<?= $kode_kelas; ?>" method="post">
                                            <?php csrf_field() ?>
                                            <button class="btn btn-sm btn-info"><i class="fa fa-line-chart mr-2" aria-hidden="true"></i>Lihat Data Nilai</button>
                                        </form>
                                    </td>
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