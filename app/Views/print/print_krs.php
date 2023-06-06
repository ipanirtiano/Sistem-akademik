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
            <th width="380px">
                <b style="font-size: 18px;">SMK ERA INFORMATIKA</b><br>
                <div style="font-size: 12px;"><b> <?= " "; ?>Kartu Rencana Studi</b><br>
                    Nama : <?= $data_siswa['nama_lengkap']; ?>
                    <br>
                    NIS : <?= $data_siswa['nis']; ?>
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
            <th width="120">Kode Mapel</th>
            <th width="170">Mata Pelajaran</th>
            <th width="210">Guru Pengajar</th>
        </tr>
        <?php
        $i = 1;
        foreach ($data_mapel as $data) :
        ?>
            <?php
            // ambil mapel
            $mapel = $data['mata_pelajaran'];
            // ambil guru pengajar
            $guru = $data['guru_pengajar'];

            // query manual
            $conn = mysqli_connect('localhost', 'root', '', 'sistem_akademik_v3');
            $query = mysqli_query($conn, "SELECT * FROM mata_pelajaran WHERE nama_mapel = '" . $mapel . "'");
            $data_mapel = mysqli_fetch_assoc($query);

            $query = mysqli_query($conn, "SELECT * FROM guru WHERE kode_guru = '" . $guru . "'");
            $data_guru = mysqli_fetch_assoc($query) ?>

            <tr>
                <td><?= $i; ?></td>
                <td><?= $data_mapel['kode_mapel']; ?></td>
                <td><?= $data['mata_pelajaran']; ?></td>
                <td><?= $data_guru['nama_lengkap'] ?></td>
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
    <h5>Guru Ketua Yayasan</h5>
    <div class="div"></div>
    <div class="div"></div>
    <div>
        <h5 class="ketua_yayasan"> Drs. Nana Sukarna, M.Pd</h5>
    </div>
</body>

</html>