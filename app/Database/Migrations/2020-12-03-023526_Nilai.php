<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Nilai extends Migration
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
			'kode_nilai'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'kode_siswa'       => [
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
			'mapel'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 30,
			],
			'nilai_hadir'       => [
				'type'           => 'INT',
				'constraint'     => 3,
			],
			'nilai_tugas'       => [
				'type'           => 'INT',
				'constraint'     => 3,
			],
			'nilai_uts'       => [
				'type'           => 'INT',
				'constraint'     => 3,
			],
			'nilai_uas'       => [
				'type'           => 'INT',
				'constraint'     => 3,
			],
			'nilai_akhir'       => [
				'type'           => 'INT',
				'constraint'     => 3,
			],
			'grade'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 1,
			],
			'semester'       => [
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
		$this->forge->createTable('nilai');
	}

	public function down()
	{
		$this->forge->dropTable('nilai');
	}
}
