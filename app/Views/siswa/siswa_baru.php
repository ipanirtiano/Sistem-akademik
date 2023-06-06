<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Siswa Baru</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <i class="fa fas fa-graduation-cap mr-2" aria-hidden="true"></i> Data Siswa Baru Tahun <?= $now = date('Y');; ?>
                </div>

                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <form action="<?= base_url(); ?>/printout/print_siswa_baru" method="post">
                                <?php csrf_field() ?>
                                <button class="btn btn-outline-dark"> <i class="fa fa-print mr-2" aria-hidden="true"></i> Print PDF</button>
                            </form>
                        </div>
                        <div class="col-md-5 mb-2">
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
                                                <th scope="col">No Telpon</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $i = 1 + (7 * ($currentPage - 1));
                                            foreach ($siswa_baru as $data) :
                                            ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <!-- data kode siswa yang di encrypt -->
                                                    <?php $kode_siswa = base64_encode($data['kode_siswa']) ?>
                                                    <td>
                                                        <a href="<?= base_url(); ?>/admin/detail-siswa-baru/<?= $kode_siswa ?>"> <?= $data['nis']; ?><a>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url(); ?>/admin/detail-siswa-baru/<?= $kode_siswa ?>"><?= $data['nama_lengkap']; ?></a>
                                                    </td>
                                                    <td><?= $data['tempat_lahir'] . ", " . $data['tanggal_lahir'] ?></td>
                                                    <td><?= $data['no_telpon']; ?></td>
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
                    <?= $pager->links('siswa_baru', 'data_guruPager') ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>