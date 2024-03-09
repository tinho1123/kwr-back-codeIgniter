<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTableStatusDelivery extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 11,
                "auto_increment" => true
            ],
            "description" => [
                "type" => "VARCHAR",
                "constraint" => 36
            ],
            "created_at" => [
                "type" => "TIMESTAMP",
                "null" => true,
                "default" => new RawSql('CURRENT_TIMESTAMP'),
            ],

            "updated_at" => [
                "type" => "TIMESTAMP",
                "null" => true,
                "default" => new RawSql('NULL ON UPDATE CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('status_delivery', true, ['engine' => 'InnoDB']);

        $seeder = \Config\Database::seeder();
        $seeder->call('CreateFieldsStatusDelivery');
    }

    public function down()
    {
        $this->forge->dropTable('status_delivery');
    }
}
