<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Siswa extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'kode_siswa'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'nis'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 20,
			],
			'nama_lengkap' => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'tempat_lahir' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'tanggal_lahir' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'jenis_kelamin' => [
				'type'           => 'VARCHAR',
				'constraint'     => 10
			],
			'agama' => [
				'type'           => 'VARCHAR',
				'constraint'     => 10
			],
			'alamat' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'email' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'no_telpon' => [
				'type'           => 'VARCHAR',
				'constraint'     => 15
			],
			'nama_asal_sekolah' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'alamat_asal_sekolah' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'nomor_ijazah' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'tahun_ijazah' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'nomor_skhun' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'tahun_skhun' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'nama_ayah' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'nama_ibu' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'alamat_orangtua' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'telpon_orangtua' => [
				'type'           => 'VARCHAR',
				'constraint'     => 20
			],
			'pekerjaan_ayah' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'pekerjaan_ibu' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'foto' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'created_at' => [
				'type'           => 'DATETIME',
				'null'     => true
			],
			'updated_at' => [
				'type'           => 'DATETIME',
				'null'     => true
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('siswa');
	}

	public function down()
	{
		$this->forge->dropTable('siswa');
	}
}
