<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php $kodeKelas = base64_encode($kode_kelas) ?>
                        <?php $kodeGuru = base64_encode($kode_guru) ?>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/views/nilai">Kelas</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/views/siswa/<?= $kodeKelas ?>/<?= $kodeGuru; ?>"> Data Siswa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Input Nilai</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>


    <div class="row justify-content-center">
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <i class="fa fa-clipboard mr-2" aria-hidden="true"></i> Form Input Nilai
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">

                            <form action="" method="post">
                                <div class="row">
                                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"></label>
                                    <div class="col-md-6 mb-2">
                                        <h5> Mata Pelajaran</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm"></label>
                                            <?= csrf_field() ?>
                                            <?php $mata_pelajaran = $_POST['mapel'] ?? '' ?>
                                            <div class="col-md-8">
                                                <select class="form-control form-control-sm mb-2" name="mapel" required>
                                                    <option selected="selected" value=" ">Mata Pelajaran</option>
                                                    <?php foreach ($data_mapel as $data) : ?>
                                                        <option value="<?= $data['nama_mapel']; ?>"><?= $data['nama_mapel']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <button class="btn btn-info btn-sm btn-block" type="submit">Input</button>
                                                <div class="invalid-feedback" style="font-size: small">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>


                            <?php
                            foreach ($data_jadwal as $data) :


                            ?>
                                <?php if ($data['mata_pelajaran'] == $mata_pelajaran) :  ?>

                                    <div class="row mb-2 justify-content-center">
                                        <div class="col-lg-8 mb-2">
                                            <div class="card mb-2">
                                                <div class="card-body">
                                                    <?php $kode_siswa = base64_encode($data_siswa['kode_siswa']) ?>
                                                    <?php $kodeGuru = base64_encode($kode_guru) ?>
                                                    <?php $kodeKelas = base64_encode($kode_kelas) ?>
                                                    <form action="<?= base_url(); ?>/nilai/proses_input_nilai/<?= $kode_siswa; ?>/<?= $kodeGuru; ?>/<?= $kodeKelas; ?>" method="post">
                                                        <?php csrf_field() ?>
                                                        <div class="form-group row">
                                                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">NIS</label>
                                                            <div class="col-md-8 mb-2">
                                                                <input type="hidden" class="form-control form-control-sm" name="kode_nilai" value="<?= $kode_nilai ?>">

                                                                <input type="hidden" class="form-control form-control-sm" name="mapel" value="<?= $mata_pelajaran ?>">

                                                                <input type="hidden" class="form-control form-control-sm" id="colFormLabelSm" name="kode_siswa" value="<?= $data_siswa['kode_siswa']; ?>">

                                                                <input type="hidden" class="form-control form-control-sm" id="colFormLabelSm" name="semester" value="<?= $data['smester']; ?>">

                                                                <input type="text" class="form-control form-control-sm" id="colFormLabelSm" placeholder="NIS" name="nis" value="<?= $data_siswa['nis']; ?>" readonly>
                                                                <div class="invalid-feedback" style="font-size: small">

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nama Siswa</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-sm" id="colFormLabelSm" placeholder="NIP" name="nama_siswa" value="<?= $data_siswa['nama_lengkap']; ?>" readonly>
                                                                <div class="invalid-feedback" style="font-size: small">

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Guru Pengajar</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Guru Pengajar" name="nama_guru" value="<?= $data_guru['nama_lengkap'] ?>" readonly>
                                                                <div class="invalid-feedback" style="font-size: small">

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Mata Pelajaran</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-sm" id="colFormLabelSm" value="<?= $mata_pelajaran ?>" readonly>
                                                                <div class="invalid-feedback" style="font-size: small">

                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-8">
                                            <div class="card mb-2">
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nilai Hadir</label>
                                                        <div class="col-md-3">
                                                            <input type="number" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Nilai Hadir" name="nilai_hadir" required>
                                                            <div class="invalid-feedback" style="font-size: small">

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nilai Tugas</label>
                                                        <div class="col-md-3">
                                                            <input type="number" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Nilai Tugas" name="nilai_tugas" required>
                                                            <div class="invalid-feedback" style="font-size: small">

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nilai UTS</label>
                                                        <div class="col-md-3">
                                                            <input type="number" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Nilai UTS" name="nilai_uts" required>
                                                            <div class="invalid-feedback" style="font-size: small">

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nilai UAS</label>
                                                        <div class="col-md-3">
                                                            <input type="number" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Nilai UAS" name="nilai_uas" required>
                                                            <div class="invalid-feedback" style="font-size: small">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row px-3 justify-content-end">
                                        <button type="submit" class="btn btn-info float-right mr-2 btn-sm"><i class="fa fa-check-square-o mr-2" aria-hidden="true"></i>Update</button>
                                        <a href="<?= base_url() ?>/views/siswa/<?= $kodeKelas ?>/<?= $kodeGuru; ?>"><button type="button" class="btn btn-danger float-right btn-sm"><i class="fa fa-times mr-2" aria-hidden="true"></i>Kembali</button></a>
                                    </div>
                                    <?php break; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>