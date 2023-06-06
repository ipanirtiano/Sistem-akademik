<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KelasSiswa extends Migration
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
			'kode_kelas'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'kode_siswa' => [
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
		$this->forge->createTable('kelas_siswa');
	}

	public function down()
	{
		$this->forge->dropTable('kelas_siswa');
	}
}
