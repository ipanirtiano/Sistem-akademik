<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class GuruSeeder extends Seeder
{
	public function run()
	{
		for ($i = 1; $i < 15; $i++) {

			//generet kode guru random 3 digit pertama
			$angka_kode1 = range(0, 9);
			shuffle($angka_kode1);
			$ambilKode1 = array_rand($angka_kode1, 3);
			$generetKode1 = implode('', $ambilKode1);
			// generate kode guru random 3 digit kedua
			$angka_kode2 = range(0, 9);
			shuffle($angka_kode2);
			$ambilKode2 = array_rand($angka_kode2, 3);
			$generetKode2 = implode('', $ambilKode2);
			// kode guru yang sudah di random
			$kode_guru = 'KDG-' . $generetKode1 . $generetKode2;

			//generet NIP random untuk sementara
			$angka_nip1 = range(0, 9);
			shuffle($angka_nip1);
			$ambilKodeNip1 = array_rand($angka_nip1, 5);
			$generetKodeNip1 = implode('', $ambilKodeNip1);

			$angka_nip2 = range(0, 9);
			shuffle($angka_nip2);
			$ambilKodeNip2 = array_rand($angka_nip2, 5);
			$generetKodeNip2 = implode('', $ambilKodeNip2);
			$kode_nip = '19850330' . $generetKodeNip1 . $generetKodeNip2;

			//Generate random tanggal lahir
			$timestamp = mt_rand(1, time());
			//get tanggal lahir random.
			$randomDate = date("d M Y", $timestamp);
			//get password dari tanggal lahir
			$password = date("dmy", $timestamp);

			//generate NIK random guru
			$tgl = date('m');
			//genetate angka random 3 digit pertama setelah tahun dan bulan
			$angka_nik1 = range(0, 9);
			shuffle($angka_nik1);
			$ambilKode_nik1 = array_rand($angka_nik1, 4);
			$generetKode_nik1 = implode('', $ambilKode_nik1);

			// generate angka random 3 digit kedua setelah tahun dan bulan
			$angka_nik2 = range(0, 9);
			shuffle($angka_nik2);
			$ambilKode_nik2 = (array_rand($angka_nik2, 3));
			$generetKode_nik2 = implode('', $ambilKode_nik2);
			// NIK yang setelah di random
			$nik = "4" . $tgl . $generetKode_nik1 . $generetKode_nik2;


			// Insert data guru
			$faker = \Faker\Factory::create('id_ID');
			$nama = $faker->name;
			$data_guru = [
				'kode_guru' => $kode_guru,
				'nik' => $nik,
				'nip'    => $kode_nip,
				'nama_lengkap' => $nama,
				'tempat_lahir' => $faker->city,
				'tanggal_lahir' => $randomDate,
				'jenis_kelamin' => '',
				'pendidikan_akhir' => '',
				'agama' => '',
				'alamat' => $faker->address,
				'email' => $faker->email,
				'no_telpon' => $faker->phoneNumber,
				'foto' => 'default.jpg',
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			];
			// Insert data guru menggunakan query builder
			$this->db->table('guru')->insert($data_guru);


			// hashing paswword sebelum insert database
			$password_hash = password_hash($password, PASSWORD_DEFAULT);
			// insert data user
			$data_users = [
				'id_users' => $kode_guru,
				'username' => $nik,
				'password' => $password_hash,
				'level' => 'guru',
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			];
			// insert data guru kedalam table users
			$this->db->table('users')->insert($data_users);

			// insert data guru kedalam table wali kelas
			$data_waliKelas = [
				'kode_guru' => $kode_guru,
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			];
			$this->db->table('wali_kelas')->insert($data_waliKelas);
		}
	}
}
