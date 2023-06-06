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
            <th width="400px">
                <b style="font-size: 18px;">SMK ERA INFORMATIKA</b><br>
                <div style="font-size: 12px;"><b> <?= " "; ?> Kartu Hasil Studi</b><br>
                    Nama : <?= $data_siswa; ?>
                    <br>
                    NIS : <?= $nis; ?>
                    <br>
                    Kelas : <?= $ruang_kelas; ?>
                    <br>
                    <hr>
                </div>
            </th>
        </tr>
    </table>



    <table class="table-data" cellpadding="3">
        <tr style="background-color:#c9c7c1; font-weight:bold;">
            <th width="25px">No</th>
            <th width="200">Mata Pelajaran</th>
            <th width="50">Nilai Hadir</th>
            <th width="50">Nilai Tugas</th>
            <th width="50">Nilai UTS</th>
            <th width="50">Nilai UAS</th>
            <th width="50">Nilai Akhir</th>
            <th width="50">Grade</th>
        </tr>
        <?php
        $i = 1;
        foreach ($data_nilai as $data) :
        ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $data['mapel']; ?></td>
                <td><?= $data['nilai_hadir']; ?></td>
                <td><?= $data['nilai_tugas']; ?></td>
                <td><?= $data['nilai_uts']; ?></td>
                <td><?= $data['nilai_uas']; ?></td>
                <td><?= $data['nilai_akhir']; ?></td>
                <td><?= $data['grade']; ?></td>
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