<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Guru</li>
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
                    <i class="fa fas fa-clipboard mr-3" aria-hidden="true"></i> Data Guru
                </div>

                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <form action="<?= base_url(); ?>/printout/print_guru" method="post">
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
                                                <th scope="col">NO</th>
                                                <th scope="col">NIK</th>
                                                <th scope="col">Nama Lengkap</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">No Telpon</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1 + (7 * ($currentPage - 1));
                                            foreach ($data_guru as $data) :
                                            ?>
                                                <tr>
                                                    <!-- data kode guru yang di encrypt -->
                                                    <?php $kode_guru = base64_encode($data['kode_guru']) ?>
                                                    <td><?= $i; ?></td>
                                                    <td><a href="<?= base_url(); ?>/admin/detail/<?= $kode_guru ?>"><?= $data['nik']; ?></a></td>
                                                    <td><a href="<?= base_url(); ?>/admin/detail/<?= $kode_guru ?>"><?= $data['nama_lengkap']; ?></a></td>
                                                    <td><?= $data['email']; ?></td>
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

                    <?= $pager->links('guru', 'data_guruPager') ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>