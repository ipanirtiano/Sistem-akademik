<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php $kode_guru = base64_encode($data_guru['kode_guru']) ?>
                        <?php $nik = base64_encode(session('nomor_induk')); ?>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/views/data-diri/<?= $nik ?>">Data Diri</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Data</li>
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
                    <i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i> Upadate Data
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2 justify-content-center">
                                <div class="col-lg-6">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <form action="<?= base_url(); ?>/guru/proses_update_data_diri/<?= $kode_guru; ?>" method="post">
                                                <?php csrf_field() ?>
                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">NIK</label>
                                                    <div class="col-md-8 mb-2">
                                                        <input type="hidden" class="form-control form-control-sm" id="colFormLabelSm" placeholder="NIP" name="kode_guru" value="<?= $data_guru['kode_guru']; ?>">
                                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('nik') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="NIP" name="nik" value="<?= $data_guru['nik']; ?>" readonly>
                                                        <div class="invalid-feedback" style="font-size: small">
                                                            <?= $validation->getError('nik'); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">NIP</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('nip') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="NIP" name="nip" value="<?= $data_guru['nip']; ?>" readonly>
                                                        <div class="invalid-feedback" style="font-size: small">
                                                            <?= $validation->getError('nip'); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nama Lengkap</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('namaLengkap') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Nama Lengkap" name="namaLengkap" value="<?= $data_guru['nama_lengkap'] ?>" readonly>
                                                        <div class="invalid-feedback" style="font-size: small">
                                                            <?= $validation->getError('namaLengkap'); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Tempat Lahir</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('tempat') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Tempat" name="tempat" value="<?= $data_guru['tempat_lahir'] ?>" readonly>
                                                        <div class="invalid-feedback" style="font-size: small">
                                                            <?= $validation->getError('tempat'); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Tanggal Lahir</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('tanggal') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Tanggal Lahir" name="tanggal" value="<?= $data_guru['tanggal_lahir'] ?>" readonly>
                                                        <div class="invalid-feedback" style="font-size: small">
                                                            <?= $validation->getError('tanggal'); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Jenis Kelamin</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-check form-check-inline mt-1">
                                                            <input class="form-check-input <?= ($validation->hasError('jenis_kelamin') ? 'is-invalid' : ''); ?>" type="radio" name="jenis_kelamin" id="inlineRadio1" value="Laki-Laki" <?= $data_guru['jenis_kelamin'] == 'Laki-Laki' ? 'checked' : '' ?>>
                                                            <label class="form-check-label" for="inlineRadio1" style="font-size:14px;">Laki-Laki</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input <?= ($validation->hasError('jenis_kelamin') ? 'is-invalid' : ''); ?>" type="radio" name="jenis_kelamin" id="inlineRadio2" value="Perempuan" <?= $data_guru['jenis_kelamin'] == 'Perempuan' ? 'checked' : '' ?>>
                                                            <label class="form-check-label" for="inlineRadio2" style="font-size:14px;">Perempuan</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Pendidikan Terakhir</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('pendidikan_terakhir') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Pendidikan Terakhir" name="pendidikan_terakhir" value="<?= (old('pendidikan_terakhir') ? old('pendidikan_terakhir') : $data_guru['pendidikan_akhir']); ?>">
                                                        <div class="invalid-feedback" style="font-size: small">
                                                            <?= $validation->getError('pendidikan_terakhir'); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Agama</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control form-control-sm mb-2 <?= ($validation->hasError('agama') ? 'is-invalid' : ''); ?>" name="agama">
                                                            <option selected="selected" value=" ">Agama</option>
                                                            <option value="Islam" <?= $data_guru['agama'] == 'Islam' ? 'selected' : '' ?>>Islam</option>
                                                            <option value="Protestan" <?= $data_guru['agama'] == 'Protestan' ? 'selected' : '' ?>>Protestan</option>
                                                            <option value="Katolik" <?= $data_guru['agama'] == 'Katolik' ? 'selected' : '' ?>>Katolik</option>
                                                            <option value="Hindu" <?= $data_guru['agama'] == 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                                                            <option value="Buddha" <?= $data_guru['agama'] == 'Buddha' ? 'selected' : '' ?>>Buddha</option>
                                                            <option value="Khonghucu" <?= $data_guru['agama'] == 'Khonghucu' ? 'selected' : '' ?>>Khonghucu</option>
                                                            <option value="Lainnya" <?= $data_guru['agama'] == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                                        </select>
                                                        <div class="invalid-feedback" style="font-size: small">
                                                            <?= $validation->getError('agama'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Email</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm <?= ($validation->hasError('email') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Email" name="email" value="<?= (old('email') ? old('email') : $data_guru['email']); ?>">
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('email'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">No Telpon</label>
                                                <div class="col-md-8">
                                                    <input type="hidden" class="form-control form-control-sm" id="colFormLabelSm" name="foto" value="<?= $data_guru['foto'] ?>">
                                                    <input type="number" class="form-control form-control-sm <?= ($validation->hasError('no_telpon') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="No Telpon" name="no_telpon" value="<?= (old('no_telpon') ? old('no_telpon') : $data_guru['no_telpon']); ?>">
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('no_telpon'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Alamat</label>
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <textarea class="form-control <?= ($validation->hasError('alamat') ? 'is-invalid' : ''); ?>" id="exampleFormControlTextarea1" rows="3" name="alamat" value="<?= $data_guru['alamat']; ?>"><?= (old('alamat') ? old('alamat') : $data_guru['alamat']); ?></textarea>
                                                        <?= $validation->getError('alamat'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row px-3 justify-content-end">
                                <button type="submit" class="btn btn-info float-right mr-2 btn-sm"><i class="fa fa-check-square-o mr-2" aria-hidden="true"></i>Update</button>
                                <a href="<?= base_url(); ?>/views/data-diri/<?= $nik ?>"><button type="button" class="btn btn-danger float-right btn-sm"><i class="fa fa-times mr-2" aria-hidden="true"></i>Kembali</button></a>
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