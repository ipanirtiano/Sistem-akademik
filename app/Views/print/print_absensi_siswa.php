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
                <h4>Form Absensi Kelas <?= $ruang_kelas; ?></h4>
                <br>
            </td>
        </tr>
    </table>



    <table class="table-data" cellpadding="3">
        <tr>
            <th width="25px" rowspan="2" style="text-align: center">No</th>
            <th width="100" rowspan="2" style="text-align: center">NIS</th>
            <th width="200" rowspan="2" style="text-align: center">Nama / Tanggal</th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
            <th width="20"></th>
        </tr>
        <tr style="background-color:#c9c7c1; font-weight:bold;">
            <th style=" text-align: center">1</th>
            <th style="text-align: center">2</th>
            <th style="text-align: center">3</th>
            <th style="text-align: center">4</th>
            <th style="text-align: center">5</th>
            <th style="text-align: center">6</th>
            <th style="text-align: center">7</th>
            <th style="text-align: center">8</th>
            <th style="text-align: center">9</th>
            <th style="text-align: center">10</th>
            <th style="text-align: center">11</th>
            <th style="text-align: center">12</th>
            <th style="text-align: center">13</th>
            <th style="text-align: center">14</th>
            <th style="text-align: center">15</th>
            <th style="text-align: center">16</th>
            <th style="text-align: center">17</th>
            <th style="text-align: center">18</th>
            <th style="text-align: center">19</th>
            <th style="text-align: center">20</th>
            <th style="text-align: center">21</th>
            <th style="text-align: center">22</th>
            <th style="text-align: center">23</th>
        </tr>
        <?php
        $i = 1;
        foreach ($data_siswa as $data) :
        ?>

            <tr>
                <td><?= $i; ?></td>
                <td><?= $data['nis']; ?></td>
                <td><?= $data['nama_lengkap']; ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>

        <?php
            $i++;
        endforeach;
        ?>
    </table>
    <div class="div"></div>
    <br>
    <h5 class="tanggal">Tangerang, <?= date('d - M - Y'); ?></h5>
    <h5>Guru Pengajar</h5>
    <div class="div"></div>
    <div class="div"></div>
    <div>
        <h5 class="ketua_yayasan"><?= $guru_pengajar; ?></h5>
    </div>



</body>

</html>