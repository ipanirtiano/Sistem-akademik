<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="cord shadow rounded">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php $kode_siswa = base64_encode($data_siswa['kode_siswa']) ?>
                        <?php $nis = base64_encode(session('nomor_induk')); ?>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/view/data-diri/<?= $nis ?>">Data Diri</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/view/all/<?= $kode_siswa; ?>">All Data Diri</a></li>
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
                                            <form action="<?= base_url(); ?>/siswa/proses_update_data_diri/<?= $kode_siswa; ?>" method="post">
                                                <?php csrf_field() ?>
                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">NIK</label>
                                                    <div class="col-md-8 mb-2">
                                                        <input type="hidden" class="form-control form-control-sm" id="colFormLabelSm" name="kode_siswa" value="<?= $data_siswa['kode_siswa']; ?>">

                                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('nis') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="NIS" name="nis" value="<?= $data_siswa['nis']; ?>" readonly>
                                                        <div class="invalid-feedback" style="font-size: small">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nama Lengkap</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('namaLengkap') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Nama Lengkap" name="namaLengkap" value="<?= $data_siswa['nama_lengkap'] ?>" readonly>
                                                        <div class="invalid-feedback" style="font-size: small">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Tempat Lahir</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('tempat') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Tempat" name="tempat" value="<?= $data_siswa['tempat_lahir'] ?>" readonly>
                                                        <div class="invalid-feedback" style="font-size: small">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Tanggal Lahir</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('tanggal') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Tanggal Lahir" name="tanggal" value="<?= $data_siswa['tanggal_lahir'] ?>" readonly>
                                                        <div class="invalid-feedback" style="font-size: small">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Jenis Kelamin</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-check form-check-inline mt-1">
                                                            <input class="form-check-input <?= ($validation->hasError('jenis_kelamin') ? 'is-invalid' : ''); ?>" type="radio" name="jenis_kelamin" id="inlineRadio1" value="Laki-Laki" <?= $data_siswa['jenis_kelamin'] == 'Laki-Laki' ? 'checked' : '' ?>>
                                                            <label class="form-check-label" for="inlineRadio1" style="font-size:14px;">Laki-Laki</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input <?= ($validation->hasError('jenis_kelamin') ? 'is-invalid' : ''); ?>" type="radio" name="jenis_kelamin" id="inlineRadio2" value="Perempuan" <?= $data_siswa['jenis_kelamin'] == 'Perempuan' ? 'checked' : '' ?>>
                                                            <label class="form-check-label" for="inlineRadio2" style="font-size:14px;">Perempuan</label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Agama</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control form-control-sm mb-2 <?= ($validation->hasError('agama') ? 'is-invalid' : ''); ?>" name="agama">
                                                            <option selected="selected" value=" ">Agama</option>
                                                            <option value="Islam" <?= $data_siswa['agama'] == 'Islam' ? 'selected' : '' ?>>Islam</option>
                                                            <option value="Protestan" <?= $data_siswa['agama'] == 'Protestan' ? 'selected' : '' ?>>Protestan</option>
                                                            <option value="Katolik" <?= $data_siswa['agama'] == 'Katolik' ? 'selected' : '' ?>>Katolik</option>
                                                            <option value="Hindu" <?= $data_siswa['agama'] == 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                                                            <option value="Buddha" <?= $data_siswa['agama'] == 'Buddha' ? 'selected' : '' ?>>Buddha</option>
                                                            <option value="Khonghucu" <?= $data_siswa['agama'] == 'Khonghucu' ? 'selected' : '' ?>>Khonghucu</option>
                                                            <option value="Lainnya" <?= $data_siswa['agama'] == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                                        </select>
                                                        <div class="invalid-feedback" style="font-size: small">
                                                            <?= $validation->getError('agama'); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Email</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('email') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Email" name="email" value="<?= (old('email') ? old('email') : $data_siswa['email']); ?>">
                                                        <div class="invalid-feedback" style="font-size: small">
                                                            <?= $validation->getError('email'); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">No Telpon</label>
                                                    <div class="col-md-8">
                                                        <input type="hidden" class="form-control form-control-sm" id="colFormLabelSm" name="foto" value="<?= $data_siswa['foto'] ?>">

                                                        <input type="number" class="form-control form-control-sm <?= ($validation->hasError('no_telpon') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="No Telpon" name="no_telpon" value="<?= (old('no_telpon') ? old('no_telpon') : $data_siswa['no_telpon']); ?>">
                                                        <div class="invalid-feedback" style="font-size: small">
                                                            <?= $validation->getError('no_telpon'); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Alamat</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <textarea class="form-control <?= ($validation->hasError('alamat') ? 'is-invalid' : ''); ?>" id="exampleFormControlTextarea1" rows="3" name="alamat" value="<?= $data_siswa['alamat']; ?>"><?= (old('alamat') ? old('alamat') : $data_siswa['alamat']); ?></textarea>
                                                            <?= $validation->getError('alamat'); ?>
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
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Asal Sekolah</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm <?= ($validation->hasError('asal_sekolah') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Asal Sekolah" name="asal_sekolah" value="<?= (old('asal_sekolah') ? old('asal_sekolah') : $data_siswa['nama_asal_sekolah']); ?>">
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('asal_sekolah'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Alamat Asal Sekolah</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm <?= ($validation->hasError('alamat_asal_sekolah') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Alamat Asal Sekolah" name="alamat_asal_sekolah" value="<?= (old('alamat_asal_sekolah') ? old('alamat_asal_sekolah') : $data_siswa['alamat_asal_sekolah']); ?>">
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('alamat_asal_sekolah'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nomor Ijazah</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm <?= ($validation->hasError('no_ijazah') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Nomor Ijazah" name="no_ijazah" value="<?= (old('no_ijazah') ? old('no_ijazah') : $data_siswa['nomor_ijazah']); ?>">
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('no_ijazah'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Tahun Ijazah</label>
                                                <div class="col-md-8">
                                                    <select class="form-control form-control-sm mb-2 <?= ($validation->hasError('tahun_ijazah') ? 'is-invalid' : ''); ?>" name="tahun_ijazah">
                                                        <option selected="selected" value="">Tahun</option>
                                                        <?php
                                                        $now = date('Y');
                                                        for ($now; $now >= 1970; $now -= 1) : ?>
                                                            <option value=<?= $now;
                                                                            ($data_siswa['tahun_ijazah'] == $now ? 'selected' : ''); ?>> <?= $now; ?> </option>
                                                        <?php endfor; ?>
                                                    </select>
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('tahun_ijazah'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nomor SKHUN</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm <?= ($validation->hasError('no_skhun') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Nomor SKHUN" name="no_skhun" value="<?= (old('no_skhun') ? old('no_skhun') : $data_siswa['nomor_skhun']); ?>">
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('no_skhun'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Tahun SKHUN</label>
                                                <div class="col-md-8">
                                                    <select class="form-control form-control-sm mb-2 <?= ($validation->hasError('tahun_skhun') ? 'is-invalid' : ''); ?>" name="tahun_skhun">
                                                        <option selected="selected" value="">Tahun</option>
                                                        <?php
                                                        $now = date('Y');
                                                        for ($now; $now >= 1970; $now -= 1) : ?>
                                                            <option value=<?= $now;
                                                                            ($data_siswa['tahun_skhun'] == $now ? 'selected' : ''); ?>> <?= $now; ?> </option>
                                                        <?php endfor; ?>
                                                    </select>
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('tahun_skhun'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nama Ayah</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm <?= ($validation->hasError('nama_ayah') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Nama Ayah" name="nama_ayah" value="<?= (old('nama_ayah') ? old('nama_ayah') : $data_siswa['nama_ayah']); ?>">
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('nama_ayah'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nama Ibu</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm <?= ($validation->hasError('nama_ibu') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Nama Ibu" name="nama_ibu" value="<?= (old('nama_ibu') ? old('nama_ibu') : $data_siswa['nama_ibu']); ?>">
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('nama_ibu'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Alamat Orang Tua</label>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <textarea class="form-control <?= ($validation->hasError('alamat_orangtua') ? 'is-invalid' : ''); ?>" id="exampleFormControlTextarea1" rows="3" name="alamat_orangtua" value="<?= $data_siswa['alamat_orangtua']; ?>"><?= (old('alamat_orangtua') ? old('alamat_orangtua') : $data_siswa['alamat_orangtua']); ?></textarea>
                                                        <?= $validation->getError('alamat_orangtua'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Telpon Orang Tua</label>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input type="number" class="form-control form-control-sm <?= ($validation->hasError('telpon_orangtua') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Telpon Orang Tua" name="telpon_orangtua" value="<?= (old('telpon_orangtua') ? old('telpon_orangtua') : $data_siswa['telpon_orangtua']); ?>">
                                                        <div class="invalid-feedback" style="font-size: small">
                                                            <?= $validation->getError('telpon_orangtua'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Pekerjaan Ayah</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm <?= ($validation->hasError('pekerjaan_ayah') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Pekerjaan Ayah" name="pekerjaan_ayah" value="<?= (old('pekerjaan_ayah') ? old('pekerjaan_ayah') : $data_siswa['pekerjaan_ayah']); ?>">
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('pekerjaan_ayah'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Pekerjaan Ibu</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm <?= ($validation->hasError('pekerjaan_ibu') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" placeholder="Pekerjaan Ibu" name="pekerjaan_ibu" value="<?= (old('pekerjaan_ibu') ? old('pekerjaan_ibu') : $data_siswa['pekerjaan_ibu']); ?>">
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('pekerjaan_ibu'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row px-3 justify-content-end">
                                <button type="submit" class="btn btn-info float-right mr-2 btn-sm"><i class="fa fa-check-square-o mr-2" aria-hidden="true"></i>Update</button>
                                <a href="<?= base_url(); ?>/view/all/<?= $kode_siswa; ?>"><button type="button" class="btn btn-danger float-right btn-sm"><i class="fa fa-times mr-2" aria-hidden="true"></i>Kembali</button></a>
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