<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CreateFieldsStatusDelivery extends Seeder
{
    public function run()
    {
        $this->db->table("status_delivery")->insertBatch([
            [
                "description" => "Pending",
            ],
            [
                "description" => "Production",
            ],
            [
                "description" => "In delivery",
            ],
            [
                "description" => "Finished",
            ]
        ]);
    }
}
