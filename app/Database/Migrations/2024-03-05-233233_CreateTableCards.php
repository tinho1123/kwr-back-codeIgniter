<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTableCards extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'fk_client' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            "document" => [
                'type' => 'VARCHAR',
                'constraint' => 14,
            ],
            "serial_number" => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'validate' => [
                'type' => 'DATE',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => new RawSql('NULL ON UPDATE CURRENT_TIMESTAMP')
            ]
            ]);

             $this->forge->addPrimaryKey('id');
            $this->forge->addForeignKey('fk_client', 'clients','id', 'CASCADE', 'RESTRICT');
            $this->forge->createTable('cards', true, ['engine' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('cards');
    }
}
