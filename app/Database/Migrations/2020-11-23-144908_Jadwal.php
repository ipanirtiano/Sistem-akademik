<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jadwal extends Migration
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
			'kode_kelas'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'mata_pelajaran'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 30,
			],
			'guru_pengajar' => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'hari' => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'jam_pelajaran' => [
				'type'           => 'VARCHAR',
				'constraint'     => 13,
			],
			'smester' => [
				'type'           => 'VARCHAR',
				'constraint'     => 6,
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
		$this->forge->createTable('jadwal');
	}

	public function down()
	{
		$this->forge->dropTable('jadwal');
	}
}
