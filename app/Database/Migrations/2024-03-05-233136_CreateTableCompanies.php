<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTableCompanies extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            "uuid" => [
                'type' => 'VARCHAR',
                'constraint' => 36
            ],
            'legal_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'fantasy_name' => [
                'type' => 'VARCHAR',
                'constraint'=> 255
            ],
            'cnpj' => [
                'type'=> 'VARCHAR',
                'constraint' => 14
            ],
            'website'=> [
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
        $this->forge->createTable('companies', true, ['engine' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('companies');
    }
}
