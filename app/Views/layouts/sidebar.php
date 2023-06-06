   <!-- Sidebar  -->
   <nav id="sidebar">
       <div id="dismiss">
           <i class="fa fa-chevron-left" aria-hidden="true"></i>
       </div>

       <div class="sidebar-header text-center">
           <img src="<?= base_url(); ?>/img/users/<?= session('foto'); ?>" class="rounded-circle" style="width: 45%;">
       </div>

       <ul class="list-unstyled components">
           <div class="row mb-4">
               <div class="col text-center">
                   <span class="name"><?= session('nama'); ?></span>
                   <div class="name"><?= session('nomor_induk'); ?></div>
               </div>
           </div>
           <li class="active">
               <a href="<?= base_url(); ?>/dashboard">
                   <div class="row">
                       <div class="col-1 mr-3">
                           <i class="fas fa fa-home icon-label" aria-hidden="true"></i>
                       </div>
                       <div class="col">
                           Home
                           <div class="tittle-sidebar">Halaman Depan</div>
                       </div>
                   </div>
               </a>
           </li>

           <!-- Menu sidebar Admin -->
           <?php if (session('level') == 'admin') : ?>
               <li class="hover-tittle">
                   <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">
                       <div class="row ">
                           <div class="col-1 mr-3">
                               <i class="fas fa fa-archive icon-label" aria-hidden="true"></i>
                           </div>
                           <div class="col">
                               Registration
                               <div class="tittle-sidebar">Pendaftaran</div>
                           </div>
                       </div>
                   </a>
               </li>
               <li>
                   <ul class="collapse list-unstyled" id="pageSubmenu">
                       <li class="">
                           <a href="<?= base_url(); ?>/admin/registration-siswa"><i class="fa fas fa-graduation-cap mr-2" aria-hidden="true"></i>Registrasi Siswa</a>
                       </li>
                       <li class="">
                           <a href="<?= base_url(); ?>/admin/registration-guru"><i class="fa fas fa-clipboard mr-3" aria-hidden="true"></i>Registrasi Guru</a>
                       </li>
                   </ul>
               </li>

               <li class="hover-tittle">
                   <a href="#pagesiswaBaru" data-toggle="collapse" aria-expanded="false">
                       <div class="row ">
                           <div class="col-1 mr-3">
                               <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                           </div>
                           <div class="col">
                               New Students
                               <div class="tittle-sidebar">Siswa Baru</div>
                           </div>
                       </div>
                   </a>
               </li>
               <li>
                   <ul class="collapse list-unstyled" id="pagesiswaBaru">
                       <li class="">
                           <a href="<?= base_url(); ?>/admin/siswa-baru"><i class="fa fa-file-text mr-3" aria-hidden="true"></i>Data Siswa Baru</a>
                       </li>
                   </ul>
               </li>

               <li class="hover-tittle">
                   <a href="#pageRuangKelas" data-toggle="collapse" aria-expanded="false">
                       <div class="row ">
                           <div class="col-1 mr-3">
                               <i class="fa fas fa-tasks icon-label" aria-hidden="true"></i>
                           </div>
                           <div class="col">
                               Class Room
                               <div class="tittle-sidebar">Ruang Kelas</div>
                           </div>
                       </div>
                   </a>
               </li>
               <li>
                   <ul class="collapse list-unstyled" id="pageRuangKelas">
                       <li class="">
                           <!-- enskripsi tahun -->
                           <?php $tahun = base64_encode($now = date('Y')) ?>
                           <a href="<?= base_url(); ?>/admin/ruang-kelas/<?= $tahun; ?>"><i class="fa fa-building-o mr-3" aria-hidden="true"></i>Registrasi Ruang Kelas</a>
                       </li>
                       <li class="">
                           <!-- enskripsi tahun -->
                           <?php $tahun = base64_encode($now = date('Y')) ?>
                           <a href="<?= base_url(); ?>/admin/data-kelas/<?= $tahun; ?>"><i class="fa fa-line-chart mr-3" aria-hidden="true"></i>Data Kelas</a>
                       </li>
                   </ul>
               </li>

               <li class="hover-tittle">
                   <a href="#jadwal" data-toggle="collapse" aria-expanded="false">
                       <div class="row ">
                           <div class="col-1 mr-3">
                               <i class="fa fas fa-calendar icon-label" aria-hidden="true"></i>
                           </div>
                           <div class="col">
                               Schedule
                               <div class="tittle-sidebar">Jadwal Belajar Mengajar</div>
                           </div>
                       </div>
                   </a>
               </li>
               <li>
                   <ul class="collapse list-unstyled" id="jadwal">
                       <li class="">
                           <a href="<?= base_url(); ?>/admin/input-mapel"><i class="fa fa-book mr-3" aria-hidden="true"></i>Input Mata Pelajran</a>
                       </li>
                       <li class="">
                           <!-- enskripsi tahun -->
                           <?php $tahun = base64_encode($now = date('Y')) ?>
                           <a href="<?= base_url(); ?>/admin/input-jadwal/<?= $tahun; ?>"><i class="fa fa-calendar-check-o mr-3" aria-hidden="true"></i>Buat Jadwal Pelajran</a>
                       </li>
                   </ul>
               </li>



               <li class="hover-tittle">
                   <a href="#pageData" data-toggle="collapse" aria-expanded="false">
                       <div class="row ">
                           <div class="col-1 mr-3">
                               <i class="fa fas fa-database icon-label" aria-hidden="true"></i>
                           </div>
                           <div class="col">
                               Finding Data
                               <div class="tittle-sidebar">Pencarian Data</div>
                           </div>
                       </div>
                   </a>
               </li>
               <li>
                   <ul class="collapse list-unstyled" id="pageData">
                       <li class="">
                           <a href="<?= base_url(); ?>/admin/data-siswa"><i class="fa fas fa-graduation-cap mr-2" aria-hidden="true"></i>Data Siswa</a>
                       </li>
                       <li class="">
                           <a href="<?= base_url(); ?>/admin/data-guru"><i class="fa fas fa-clipboard mr-3" aria-hidden="true"></i>Data Guru</a>
                       </li>
                   </ul>
               </li>
           <?php endif; ?>
           <!-- Akhir menu sidebar Admin -->




           <!-- Menu Sidebar GURU -->
           <?php if (session('level') == 'guru') : ?>
               <li class="hover-tittle">
                   <?php $nik = base64_encode(session('nomor_induk')); ?>
                   <a href="<?= base_url(); ?>/views/data-diri/<?= $nik ?>">
                       <div class="row ">
                           <div class="col-1 mr-3">
                               <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                           </div>
                           <div class="col">
                               Biodata
                               <div class="tittle-sidebar">Data Diri</div>
                           </div>
                       </div>
                   </a>
               </li>

               <li class="hover-tittle">
                   <a href="<?= base_url(); ?>/views/kelas">
                       <div class="row ">
                           <div class="col-1 mr-3">
                               <i class="fa fa-building-o mr-3" aria-hidden="true"></i>
                           </div>
                           <div class="col">
                               Class Room
                               <div class="tittle-sidebar">Ruang Kelas</div>
                           </div>
                       </div>
                   </a>
               </li>

               <li class="hover-tittle">
                   <?php $kode_guru = base64_encode(session('kode_guru')) ?>
                   <a href="<?= base_url(); ?>/views/jadwal-guru/<?= $kode_guru; ?>">
                       <div class="row ">
                           <div class="col-1 mr-3">
                               <i class="fa fas fa-calendar icon-label" aria-hidden="true"></i>
                           </div>
                           <div class="col">
                               Schedule
                               <div class="tittle-sidebar">Jadwal Mengajar</div>
                           </div>
                       </div>
                   </a>
               </li>


               <li class="hover-tittle">
                   <?php $kode_guru = base64_encode(session('kode_guru')) ?>
                   <a href="#pageNilai" data-toggle="collapse" aria-expanded="false">
                       <div class="row ">
                           <div class="col-1 mr-3">
                               <i class="fa fa-clipboard" aria-hidden="true"></i>
                           </div>
                           <div class="col">
                               Score
                               <div class="tittle-sidebar">Nilai Siswa</div>
                           </div>
                       </div>
                   </a>
               </li>
               <li>
                   <ul class="collapse list-unstyled" id="pageNilai">
                       <li class="">
                           <a href="<?= base_url(); ?>/views/nilai"><i class="fa fa-pencil-square-o mr-3" aria-hidden="true"></i>Input Nilai</a>
                       </li>
                       <li class="">
                           <a href="<?= base_url(); ?>/views/kelas-siswa"><i class="fa fas fa-clipboard mr-3" aria-hidden="true"></i>Data Nilai Siswa</a>
                       </li>
                   </ul>
               </li>
           <?php endif; ?>
           <!-- Akhir Sidebar Guru -->


           <!-- Menu sidebar siswa -->
           <?php if (session('level') == 'siswa') : ?>
               <li class="hover-tittle">
                   <?php $nis = base64_encode(session('nomor_induk')); ?>
                   <a href="<?= base_url(); ?>/view/data-diri/<?= $nis ?>">
                       <div class="row ">
                           <div class="col-1 mr-3">
                               <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                           </div>
                           <div class="col">
                               Biodata
                               <div class="tittle-sidebar">Data Diri</div>
                           </div>
                       </div>
                   </a>
               </li>

               <li class="hover-tittle">
                   <?php $kode_siswa = base64_encode(session('kode_siswa')) ?>
                   <a href="<?= base_url(); ?>/view/jadwal/<?= $kode_siswa; ?>">
                       <div class="row ">
                           <div class="col-1 mr-3">
                               <i class="fa fas fa-calendar icon-label" aria-hidden="true"></i>
                           </div>
                           <div class="col">
                               Schedule
                               <div class="tittle-sidebar">Jadwal Mengajar</div>
                           </div>
                       </div>
                   </a>
               </li>

               <li class="hover-tittle">
                   <?php $kode_siswa = base64_encode(session('kode_siswa')); ?>
                   <a href="<?= base_url(); ?>/view/krs/<?= $kode_siswa ?>">
                       <div class="row ">
                           <div class="col-1 mr-3">
                               <i class="fa fa-suitcase" aria-hidden="true"></i>
                           </div>
                           <div class="col">
                               KRS
                               <div class="tittle-sidebar">Kartu Rencana Studi</div>
                           </div>
                       </div>
                   </a>
               </li>

               <li class="hover-tittle">
                   <?php $nis = base64_encode(session('nomor_induk')); ?>
                   <a href="<?= base_url(); ?>/view/khs/<?= $kode_siswa ?>">
                       <div class="row ">
                           <div class="col-1 mr-3">
                               <i class="fa fa-line-chart" aria-hidden="true"></i>
                           </div>
                           <div class="col">
                               Score
                               <div class="tittle-sidebar">Rangkuman Nilai</div>
                           </div>
                       </div>
                   </a>
               </li>
           <?php endif; ?>
           <!-- Akhir menu sidebar siswa -->

           <li class="list-unstyled CTAs hover-tittle">
               <a href="<?= base_url(); ?>/Auth/logout" class="tombol-logout">
                   <div class="row ">
                       <div class="col-1 mr-3">
                           <i class="fa fa-power-off icon-label" aria-hidden="true"></i>
                       </div>
                       <div class="col">
                           Logout
                           <div class="tittle-sidebar">Keluar</div>
                       </div>
                   </div>
               </a>
           </li>
   </nav>