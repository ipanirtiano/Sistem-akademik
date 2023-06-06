<?= $this->extend('layouts/template'); ?>


<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Home</li>
                    </ol>
            </div>
            </nav>


            <?php if (session('level') == 'admin') : ?>
                <!-- Dashboard Admin -->
                <section>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-2">
                                <div class="card-header">
                                    Quote
                                </div>
                                <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                        <p style="color: black; font-weight:500">Selamat Datang! <br> Sistem Informasi Akademik Sekolah SMK Era Informatika.</p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card bg-light mb-2 shadow">
                                        <div class="card-header bg-info text-white" style="font-weight: 500"><i class="fa fas fa-database mr-3 ml-3 icon-label" aria-hidden="true"></i>Kelola Data</div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <a href="<?= base_url(); ?>/admin/data-siswa">
                                                    <li class="list-group-item"><i class="fa fas fa-graduation-cap mr-2" aria-hidden="true"></i>Data Siswa
                                                </a></li>
                                                </a>
                                            </ul>
                                            <ul class="list-group list-group-flush">
                                                <a href="<?= base_url(); ?>/admin/data-guru">
                                                    <li class="list-group-item"><i class="fa fas fa-clipboard mr-3" aria-hidden="true"></i>Data Guru
                                                </a></li>
                                                </a>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card bg-light mb-2 shadow">
                                        <div class="card-header bg-info text-white" style="font-weight: 500"><i class="fa fa-file-text ml-3 mr-3" aria-hidden="true"></i>Siswa Baru</div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <a href="<?= base_url(); ?>/admin/siswa-baru">
                                                    <li class="list-group-item"><i class="fa fa-file-text mr-3" aria-hidden="true"></i>Data Siswa Baru
                                                </a></li>
                                                </a>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card bg-light mb-2 shadow">
                                        <div class="card-header bg-info text-white" style="font-weight: 500"><i class="fa fas fa-tasks icon-label mr-3 ml-3" aria-hidden="true"></i>Kelas</div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <!-- enskripsi tahun -->
                                                <?php $tahun = base64_encode($now = date('Y')) ?>
                                                <a href="<?= base_url(); ?>/admin/data-kelas/<?= $tahun; ?>">
                                                    <li class="list-group-item"><i class="fa fa-line-chart mr-3" aria-hidden="true"></i>Data Kelas Siswa
                                                </a></li>
                                                </a>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-light mb-2 shadow">
                                <div class="card-header bg-info text-white" style="font-weight: 500"><i class="fa fas fa-calendar mr-3 ml-3 icon-label" aria-hidden="true"></i>Kelola Jadwal</div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <a href="<?= base_url(); ?>/admin/input-mapel">
                                            <li class="list-group-item"><i class="fa fa-book mr-3" aria-hidden="true"></i>Input Mata Pelajran
                                        </a></li>
                                        </a>
                                    </ul>
                                    <ul class="list-group list-group-flush">
                                        <!-- enskripsi tahun -->
                                        <?php $tahun = base64_encode($now = date('Y')) ?>
                                        <a href="<?= base_url(); ?>/admin/input-jadwal/<?= $tahun; ?>">
                                            <li class="list-group-item"><i class="fa fa-calendar-check-o mr-3" aria-hidden="true"></i>Buat Jadwal Pelajran
                                        </a></li>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Akhir dashboard admin -->
            <?php endif; ?>


            <?php if (session('level') == 'guru') : ?>
                <!-- Dashboard Guru -->
                <section>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card bg-light mb-2 shadow">
                                        <div class="card-header bg-info text-white" style="font-weight: 500"><i class="fa fas fa-tasks icon-label mr-3 ml-3" aria-hidden="true"></i>Kelas</div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <a href="<?= base_url(); ?>/views/kelas">
                                                    <li class="list-group-item"><i class="fa fa-line-chart mr-3" aria-hidden="true"></i>Data Kelas Siswa
                                                </a></li>
                                                </a>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card bg-light mb-2 shadow">
                                        <div class="card-header bg-info text-white" style="font-weight: 500"><i class="fa fas fa-calendar icon-label mr-3 ml-3" aria-hidden="true"></i>Jadwal</div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <?php $kode_guru = base64_encode(session('kode_guru')) ?>
                                                <a href="<?= base_url(); ?>/views/jadwal-guru/<?= $kode_guru; ?>">
                                                    <li class="list-group-item"><i class="fa fas fa-calendar mr-3 icon-label" aria-hidden="true"></i>Data Jadwal Mengajar
                                                </a></li>
                                                </a>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card bg-light mb-2 shadow">
                                        <div class="card-header bg-info text-white" style="font-weight: 500"> <i class="fa fa-clipboard mr-3 ml-3" aria-hidden="true"></i>Nilai</div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <a href="<?= base_url(); ?>/views/kelas-siswa">
                                                    <li class="list-group-item"><i class="fa fas fa-clipboard mr-3" aria-hidden="true"></i>Data Nilai Siswa
                                                </a></li>
                                                </a>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Akhir dashboard guru -->
            <?php endif; ?>

        </div>
    </div>
</div>


<?= $this->endSection(); ?>