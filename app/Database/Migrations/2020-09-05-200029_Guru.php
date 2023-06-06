<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Guru extends Migration
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
			'kode_guru'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'nik'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 20,
			],
			'nip' => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
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
			'pendidikan_akhir' => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
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
		$this->forge->createTable('guru');
	}

	public function down()
	{
		$this->forge->dropTable('guru');
	}
}
