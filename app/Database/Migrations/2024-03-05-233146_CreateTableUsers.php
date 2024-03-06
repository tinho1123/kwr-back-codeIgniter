<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;


class CreateTableUsers extends Migration
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
            'email' => [
                'type' => 'VARCHAR',
                'constraint'=> 255
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255
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
            $this->forge->addForeignKey('fk_company', 'companies','id','CASCADE','RESTRICT');
            $this->forge->createTable('users', true, ['engine' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
