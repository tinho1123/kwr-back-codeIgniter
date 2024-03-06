<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;


class CreateTableProducts extends Migration
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
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'description' => [
                   'type' => 'TEXT',
            ],
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => "10,2"
            ],
            'quantity' => [
                'type' => "INT",
                'constraint' => 11,
                'null' => true,
                'default' => 0
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
            'user_insert' => [
                  'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => new RawSql('NULL ON UPDATE CURRENT_TIMESTAMP')
            ],
            'user_update'=> [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ]
        ]);

        $this->forge->addPrimaryKey('id');
      $this->forge->addForeignKey('fk_company', 'companies','id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('products', true, ['engine' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
