<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTableProductsDelivery extends Migration
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
            "fk_product" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "fk_delivery" => [
                "type" => "INT",
                "constraint" => 36
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
        $this->forge->addForeignKey('fk_product', 'products', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('fk_delivery', 'delivery', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('products_delivery', true, ['engine' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('products_delivery');
    }
}
