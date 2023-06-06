<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');

$routes->group('dashboard', ['filter' => 'login'], function ($routes) {
	$routes->add('/', 'Dashboard::index');
});

$routes->group('admin', ['filter' => 'admin'], function ($routes) {
	$routes->add('registration-guru', 'Guru::registrasi_guru');
	$routes->add('registration-siswa', 'Siswa::registrasi_siswa');

	$routes->add('data-guru', 'Guru::data_guru');
	$routes->add('data-siswa', 'Siswa::data_siswa');
	$routes->add('siswa-baru', 'Siswa::siswa_baru');

	$routes->add('detail/(:any)', 'Guru::detail_guru/$1');
	$routes->add('detail-siswa/(:any)', 'Siswa::detail_siswa/$1');
	$routes->add('detail-siswa-baru/(:any)', 'Siswa::detail_siswa_baru/$1');

	$routes->add('upload/(:any)', 'Guru::upload/$1');
	$routes->add('upload-siswa/(:any)', 'Siswa::upload_siswa/$1');

	$routes->add('view/(:any)', 'Guru::guru_all/$1');
	$routes->add('view-all/(:any)', 'Siswa::siswa_all/$1');

	$routes->add('edit/(:any)', 'Guru::edit_guru/$1');
	$routes->add('edit-siswa/(:any)', 'Siswa::edit_siswa/$1');
	$routes->add('edit-siswa-baru/(:any)', 'Siswa::edit_siswa_baru/$1');

	$routes->add('delete/(:any)', 'Guru::delete/$1');
	$routes->add('delete_siswa/(:any)', 'Siswa::delete_siswa/$1');
	$routes->add('delete_siswa_baru/(:any)', 'Siswa::delete_siswa_baru/$1');

	$routes->add('ruang-kelas/(:any)', 'Kelas::ruang_kelas/$1');
	$routes->add('data-kelas/(:any)', 'Kelas::data_kelas/$1');
	$routes->add('tahun-ajaran', 'Kelas::tahun_ajaran');
	$routes->add('kelas/(:any)', 'Kelas::kelas_siswa/$1');
	$routes->add('kelas-siswa/(:any)', 'Kelas::data_kelas_siswa/$1');
	$routes->add('detail-kelas-siswa/(:any)/(:any)', 'Kelas::detail_kelas_siswa/$1/$2');

	$routes->add('hapus-mapel/(:any)', 'MataPelajaran::hapus_mapel/$1');
	$routes->add('edit-mapel/(:any)', 'MataPelajaran::edit_mapel/$1');
	$routes->add('input-mapel', 'MataPelajaran::input_mata_pelajaran');

	$routes->add('input-jadwal/(:any)', 'Jadwal::buat_jadwal_pelajaran/$1');
	$routes->add('tahun-ajaran-jadwal', 'Jadwal::tahun_ajaran_jadwal/$1');
	$routes->add('jadwal/(:any)', 'Jadwal::jadwal_kelas/$1');
	$routes->add('edit-jadwal/(:any)/(:any)', 'Jadwal::edit_jadwal/$1/$2');
	$routes->add('hapus-jadwal/(:any)/(:any)', 'Jadwal::hapus_jadwal/$1/$2');
});


//routes group guru
$routes->group('views', ['filter' => 'guru'], function ($routes) {
	$routes->add('data-diri/(:any)', 'Guru::data_diri_guru/$1');
	$routes->add('all/(:any)', 'Guru::data_diri_guru_all/$1');
	$routes->add('update/(:any)', 'Guru::update_data_diri_guru/$1');

	$routes->add('kelas', 'Kelas::kelas_guru');
	$routes->add('kelas-siswa/(:any)', 'Kelas::data_kelas_guru/$1');

	$routes->add('jadwal-guru/(:any)', 'Jadwal::jadwal_guru/$1');

	$routes->add('nilai', 'Nilai::kelas');
	$routes->add('siswa/(:any)/(:any)', 'Nilai::siswa/$1/$2');
	$routes->add('input-nilai/(:any)/(:any)/(:any)', 'Nilai::input_nilai_siswa/$1/$2/$3');
	$routes->add('data-siswa/(:any)/(:any)', 'Nilai::data_siswa/$1/$2');
	$routes->add('data-nilai/(:any)/(:any)/(:any)', 'Nilai::data_nilai_siswa/$1/$2/$3');
	$routes->add('kelas-siswa', 'Nilai::kelas2');

	$routes->add('edit-nilai/(:any)', 'Nilai::edit_nilai/$1');
});


// routes siswa 
$routes->group('view', ['filter' => 'siswa'], function ($routes) {
	$routes->add('data-diri/(:any)', 'Siswa::data_diri_siswa/$1');
	$routes->add('all/(:any)', 'Siswa::data_diri_siswa_all/$1');
	$routes->add('update/(:any)', 'Siswa::update_data_diri/$1');
	$routes->add('krs/(:any)', 'Jadwal::krs_siswa/$1');
	$routes->add('khs/(:any)', 'Nilai::khs_siswa/$1');
	$routes->add('jadwal/(:any)', 'Jadwal::jadwal_siswa/$1');
});

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
