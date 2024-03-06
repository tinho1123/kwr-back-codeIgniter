<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;


class CreateTableTypePayment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            "description" => [
                    'type' => 'VARCHAR',
                'constraint' => 255,
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
          

        $this->forge->createTable('types_payments', true, ['engine' => 'InnoDB']);
        
        $seeder = \Config\Database::seeder();

        $seeder->call("CreateFieldsTypesPayments");
    }

    public function down()
    {
        $this->forge->dropTable('types_payments');
    }
}
