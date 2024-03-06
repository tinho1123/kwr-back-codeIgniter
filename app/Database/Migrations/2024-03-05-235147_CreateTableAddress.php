<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTableAddress extends Migration
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
            'street' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'number' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'neighborhood' => [
                   'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'city' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'uf' => [
                   'type' => 'CHAR',
                'constraint' => 2
            ],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => 45
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
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('fk_client', 'clients','id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('address', true, ['engine' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('address');
    }
}
