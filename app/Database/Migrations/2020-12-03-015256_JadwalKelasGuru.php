<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JadwalKelasGuru extends Migration
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
			'kode_jadwal'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'kode_guru'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'kode_kelas'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
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
		$this->forge->createTable('jadwal_kelas_guru');
	}

	public function down()
	{
		$this->forge->dropTable('jadwal_kelas_guru');
	}
}
