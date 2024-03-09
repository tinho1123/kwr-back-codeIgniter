<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTableDelivery extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 11,
                "auto_increment" => true
            ],
            "uuid" => [
                "type" => "VARCHAR",
                "constraint" => 36
            ],
            "fk_client" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "fk_address" => [
                "type" => "INT",
                "constraint" => 36
            ],
            "fk_status_delivery" => [
                "type" => "INT",
                "constraint" => 11,
                "default" => 1
            ],
            "created_at" => [
                "type" => "TIMESTAMP",
                "null" => true,
                "default" => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'user_insert' => [
                "type" => "VARCHAR",
                "constraint" => 36,
            ],
            "updated_at" => [
                "type" => "TIMESTAMP",
                "null" => true,
                "default" => new RawSql('NULL ON UPDATE CURRENT_TIMESTAMP'),
            ],
            'user_update' => [
                "type" => "VARCHAR",
                "constraint" => 36,
                'null' => true
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('fk_client', 'clients', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('fk_address', 'address', 'id', 'CASCADE', 'RESTRICT');

        $this->forge->addForeignKey('fk_status_delivery', 'status_delivery', 'id', 'CASCADE', 'RESTRICT');

        $this->forge->createTable('delivery', true, ['engine' => 'InnoDB']);

    }

    public function down()
    {
        $this->forge->dropTable('delivery');
    }
}
