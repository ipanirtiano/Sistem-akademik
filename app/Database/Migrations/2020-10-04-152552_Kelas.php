<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kelas extends Migration
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
			'slug'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 50,
			],
			'tingkat' => [
				'type'           => 'INT',
				'constraint'     => 2,
			],
			'ruang_kelas' => [
				'type'           => 'VARCHAR',
				'constraint'     => 1
			],
			'wali_kelas' => [
				'type'           => 'VARCHAR',
				'constraint'     => 10
			],
			'tahun' => [
				'type'           => 'VARCHAR',
				'constraint'     => 10
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
		$this->forge->createTable('kelas');
	}

	public function down()
	{
		$this->forge->dropTable('kelas');
	}
}
