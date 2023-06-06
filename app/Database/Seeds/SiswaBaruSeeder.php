<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class SiswaBaruSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 120; $i++) {
            //generet kode siswa random 3 digit pertama
            $angka_kode1 = range(0, 9);
            shuffle($angka_kode1);
            $ambilKode1 = array_rand($angka_kode1, 3);
            $generetKode1 = implode('', $ambilKode1);
            // generate kode siswa random 3 digit kedua
            $angka_kode2 = range(0, 9);
            shuffle($angka_kode2);
            $ambilKode2 = array_rand($angka_kode2, 3);
            $generetKode2 = implode('', $ambilKode2);
            // kode siswa yang sudah di random
            $kode_siswa = 'KDS-' . $generetKode1 . $generetKode2;

            //Generate random tanggal lahir
            $timestamp = mt_rand(1, time());
            //get tanggal lahir random.
            $randomDate = date("d M Y", $timestamp);
            //get password dari tanggal lahir
            $password = date("dmy", $timestamp);

            //generate NIS random siswa
            $tgl = date('ym');
            //genetate angka random 3 digit pertama setelah tahun dan bulan
            $angka_nis1 = range(0, 9);
            shuffle($angka_nis1);
            $ambilKode_nis1 = array_rand($angka_nis1, 3);
            $generetKode_nis1 = implode('', $ambilKode_nis1);

            // generate angka random 3 digit kedua setelah tahun dan bulan
            $angka_nis2 = range(0, 9);
            shuffle($angka_nis2);
            $ambilKode_nis2 = (array_rand($angka_nis2, 3));
            $generetKode_nis2 = implode('', $ambilKode_nis2);
            // NIK yang setelah di random
            $nis = $tgl . $generetKode_nis1 . $generetKode_nis2;


            // Insert data siswa
            $faker = \Faker\Factory::create('id_ID');
            // $data_siswa = [
            //     'kode_siswa' => $kode_siswa,
            //     'nis' => $nis,
            //     'nama_lengkap' => $faker->name,
            //     'tempat_lahir' => $faker->city,
            //     'tanggal_lahir' => $randomDate,
            //     'jenis_kelamin' => '',
            //     'agama' => '',
            //     'alamat' => $faker->address,
            //     'email' => $faker->email,
            //     'no_telpon' => $faker->phoneNumber,

            //     'nama_asal_sekolah' => '',
            //     'alamat_asal_sekolah' => '',
            //     'nomor_ijazah' => '',
            //     'tahun_ijazah' => '',
            //     'nomor_skhun' => '',
            //     'tahun_skhun' => '',
            //     'nama_ayah' => '',
            //     'nama_ibu' => '',
            //     'alamat_orangtua' => '',
            //     'telpon_orangtua' => '',
            //     'pekerjaan_ayah' => '',
            //     'pekerjaan_ibu' => '',
            //     'foto' => 'default.jpg',
            //     'created_at' => Time::now(),
            //     'updated_at' => Time::now()
            // ];

            $data_siswa = [
                'kode_siswa' => $kode_siswa,
                'nis' => $nis,
                'nama_lengkap' => $faker->name,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $randomDate,
                'jenis_kelamin' => '',
                'agama' => '',
                'alamat' => $faker->address,
                'email' => $faker->email,
                'no_telpon' => $faker->phoneNumber,
                'foto' => 'default.jpg',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ];
            // Insert data guru menggunakan query builder
            $this->db->table('siswa_baru')->insert($data_siswa);


            // hashing paswword sebelum insert database
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            // insert data user
            $data_users = [
                'id_users' => $kode_siswa,
                'username' => $nis,
                'password' => $password_hash,
                'level' => 'siswa',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ];
            $this->db->table('users')->insert($data_users);
        }
    }
}
