<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SiswaBaru extends Migration
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
		$this->forge->createTable('siswa_baru');
	}

	public function down()
	{
		$this->forge->dropTable('siswa_baru');
	}
}
