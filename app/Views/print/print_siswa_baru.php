<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .container {
            position: relative;
            width: 100%;
            height: 100%;
            padding: 10px;
        }

        .table-data {
            position: absolute;
            top: 180px;
            width: 100%;
            border-collapse: collapse;
        }

        .table-data th,
        td {
            border: 1px solid black;
            padding: 3px;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th width="120PX">
                <img src="<?= base_url(); ?>/img/print/logoSMK.png" alt="" style="width:80px">
            </th>
            <th width="600px">
                <div style="font-size: 18px;"><b>SMK ERA INFORMATIKA</b>
                    <div style="font-size: 10px;">Jl. Lengkong Gudang Timur Raya, Lengkong Gudang Timur,
                        <br>Kec. Serpong, Kota Tangerang Selatan, Banten 15310</div>
                </div>
                <hr>
            </th>
        </tr>
        <tr>
            <td colspan="3" style="border: none">
                <h4>Data Siswa Baru Tahun <?= $now = date('Y'); ?></h4>
                <br>
            </td>
        </tr>
    </table>



    <table class="table-data" cellpadding="3">
        <tr style="background-color:#c9c7c1; font-weight:bold;">
            <th width="25px">No</th>
            <th>NIS</th>
            <th width="150px">Nama Lengkap</th>
            <th width="100px">Jenis Kelamin</th>
            <th width="250px">Tempat Tanggal Lahir</th>
            <th>No Telpon</th>
        </tr>
        <?php
        $i = 1;
        foreach ($siswa_baru as $data) :
        ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $data['nis']; ?></td>
                <td><?= $data['nama_lengkap']; ?></td>
                <td><?= $data['jenis_kelamin']; ?></td>
                <td><?= $data['tempat_lahir'] . ", " . $data['tanggal_lahir'] ?></td>
                <td><?= $data['no_telpon']; ?></td>
            </tr>
        <?php
            $i++;
        endforeach;
        ?>
    </table>

    <div class="div"></div>

    <br>
    <br>
    <h5 class="tanggal">Tangerang, <?= date('d - M - Y'); ?></h5>
    <h5>Ketua Yayasan</h5>
    <div class="div"></div>
    <div class="div"></div>
    <div>
        <h5 class="ketua_yayasan"> Drs. Nana Sukarna, M.Pd</h5>
    </div>

</body>

</html>