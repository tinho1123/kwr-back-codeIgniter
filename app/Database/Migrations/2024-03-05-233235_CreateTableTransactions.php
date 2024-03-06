<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;


class CreateTableTransactions extends Migration
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
                "null" => true
            ],
            "fk_product" => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'fk_type_payment' => [
                  'type' => 'INT',
                'constraint' => 11,
            ],
             'fk_status_transaction' => [
                  'type' => 'INT',
                'constraint' => 11,
            ],
             "fk_card" => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            "total_amount" => [
                'type' => 'DECIMAL',
                'constraint' => "10,2",
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
              "amount" => [
                'type' => 'DECIMAL',
                'constraint' => "10,2",
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
            $this->forge->addForeignKey('fk_client', 'clients','id', 'CASCADE', 'RESTRICT');
            $this->forge->addForeignKey('fk_card', 'cards','id', 'CASCADE', 'RESTRICT');
            $this->forge->addForeignKey('fk_product', 'products','id', 'CASCADE', 'RESTRICT');
            $this->forge->addForeignKey('fk_type_payment', 'types_payments','id', 'CASCADE', 'RESTRICT');
            $this->forge->addForeignKey('fk_status_transaction', 'status_transaction','id', 'CASCADE', 'RESTRICT');


            $this->forge->createTable('transactions', true, ['engine' => 'InnoDB']);

    }

    public function down()
    {
        $this->forge->dropTable('transactions');
    }
}
