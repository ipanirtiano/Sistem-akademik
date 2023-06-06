<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php $kodeSiswa = base64_encode($kode_siswa) ?>
                        <?php $kodeKelas = base64_encode($data_kelas['kode_kelas']) ?>
                        <?php $kodeGuru = base64_encode($data_guru['kode_guru']) ?>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/views/siswa/<?= $kodeKelas ?>/<?= $kodeGuru; ?>"> Data Siswa</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/views/data-nilai/<?= $kodeSiswa ?>/<?= $kodeGuru; ?>/<?= $kodeKelas; ?>">Data Nilai</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Nilai</li>
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
                            <div class="row mb-2 justify-content-center">
                                <div class="col-lg-8 mb-2">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <?php $kodeNilai = base64_encode($data_nilai['kode_nilai']) ?>
                                            <form action="<?= base_url(); ?>/nilai/proses_edit_nilai/<?= $kodeNilai; ?>/<?= $kodeSiswa ?>/<?= $kodeGuru; ?>/<?= $kodeKelas; ?>" method="post">
                                                <?php csrf_field() ?>
                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">NIS</label>
                                                    <div class="col-md-8 mb-2">
                                                        <input type="hidden" class="form-control form-control-sm" name="kode_nilai" value="<?= $data_nilai['kode_nilai'] ?>">

                                                        <input type="hidden" class="form-control form-control-sm" id="colFormLabelSm" name="kode_siswa" value="<?= $kode_siswa; ?>">

                                                        <input type="hidden" class="form-control form-control-sm" id="colFormLabelSm" name="kode_guru" value="<?= $kode_guru; ?>">

                                                        <input type="hidden" class="form-control form-control-sm" id="colFormLabelSm" name="kode_kelas" value="<?= $kode_kelas; ?>">

                                                        <input type="hidden" class="form-control form-control-sm" id="colFormLabelSm" name="semester" value="<?= $data_nilai['semester']; ?>">

                                                        <input type="text" class="form-control form-control-sm" id="colFormLabelSm" placeholder="NIS" name="nis" value="<?= $data_siswa['nis']; ?>" readonly>
                                                        <div class="invalid-feedback" style="font-size: small">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nama Siswa</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Nama Siswa" name="nama_siswa" value="<?= $data_siswa['nama_lengkap']; ?>" readonly>
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
                                                        <input type="text" class="form-control form-control-sm" id="colFormLabelSm" value="<?= $data_nilai['mapel'] ?>" name="mapel" readonly>
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
                                                    <input type="number" class="form-control form-control-sm <?= ($validation->hasError('nilai_hadir') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Nilai Hadir" name="nilai_hadir" value="<?= $data_nilai['nilai_hadir']; ?>">
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('nilai_hadir'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nilai Tugas</label>
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control form-control-sm <?= ($validation->hasError('nilai_tugas') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Nilai Tugas" name="nilai_tugas" value="<?= $data_nilai['nilai_tugas']; ?>">
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('nilai_tugas'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nilai UTS</label>
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control form-control-sm <?= ($validation->hasError('nilai_uts') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Nilai UTS" name="nilai_uts" value="<?= $data_nilai['nilai_uts']; ?>">
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('nilai_uts'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nilai UAS</label>
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control form-control-sm <?= ($validation->hasError('nilai_uas') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Nilai UAS" name="nilai_uas" value="<?= $data_nilai['nilai_uas']; ?>">
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('nilai_uas'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row px-3 justify-content-end">
                                <button type="submit" class="btn btn-info float-right mr-2 btn-sm"><i class="fa fa-check-square-o mr-2" aria-hidden="true"></i>Update</button>
                                <a href="<?= base_url(); ?>/views/data-nilai/<?= $kodeSiswa ?>/<?= $kodeGuru; ?>/<?= $kodeKelas; ?>"><button type="button" class="btn btn-danger float-right btn-sm"><i class="fa fa-times mr-2" aria-hidden="true"></i>Kembali</button></a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>