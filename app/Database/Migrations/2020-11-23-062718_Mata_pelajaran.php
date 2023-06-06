<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MataPelajaran extends Migration
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
			'kode_mapel'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'nama_mapel'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 50,
			],
			'guru_pengajar' => [
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
		$this->forge->createTable('mata_pelajaran');
	}

	public function down()
	{
		$this->forge->dropTable('mata_pelajaran');
	}
}
