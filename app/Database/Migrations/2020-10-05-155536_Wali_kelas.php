<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WaliKelas extends Migration
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
		$this->forge->createTable('wali_kelas');
	}

	public function down()
	{
		$this->forge->dropTable('wali_kelas');
	}
}
