<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;


class CreateTableClients extends Migration
{
    public function up()
    {
        $this->forge->addField([
             'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'fk_company' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'name' => [
                'type'=> 'VARCHAR',
                'constraint' => 255
            ],
            "document" => [
                'type' => 'VARCHAR',
                'constraint' => 14
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint'=> 255,
                'null' => true
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
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
            $this->forge->addForeignKey('fk_company', 'companies','id', 'CASCADE', 'RESTRICT');
            $this->forge->createTable('clients', true, ['engine' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('clients');
    }
}
