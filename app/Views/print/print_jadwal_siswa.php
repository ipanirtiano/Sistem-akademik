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
                <div style="font-size: 12px;"><b> <?= " "; ?> Jadwal Pelajaran</b><br>
                    Nama : <?= $nama_siswa; ?>
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
            <th width="250">Guru Pengajar</th>
            <th width="50">Hari</th>
            <th width="150">Jam</th>
            <th width="100">Ruang Kelas</th>
        </tr>
        <?php
        $i = 1;
        foreach ($jadwal as $data) :
        ?>
            <?php
            $kodeGuru = $data['guru_pengajar'];
            $kodeKelas = $data['kode_kelas'];
            // query manual
            $conn = mysqli_connect('localhost', 'root', '', 'sistem_akademik_v3');
            $query = mysqli_query($conn, "SELECT * FROM guru WHERE kode_guru = '" . $kodeGuru . "'");
            $data_guru = mysqli_fetch_assoc($query);

            $query2 = mysqli_query($conn, "SELECT * FROM kelas WHERE kode_kelas = '" . $kodeKelas . "'");
            $data_kelas = mysqli_fetch_assoc($query2);
            ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $data['mata_pelajaran']; ?></td>
                <td><?= $data_guru['nama_lengkap'] ?></td>
                <td><?= $data['hari']; ?></td>
                <td><?= $data['jam_pelajaran']; ?></td>
                <td><?= $data_kelas['tingkat'] . " " . $data_kelas['ruang_kelas']; ?></td>
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