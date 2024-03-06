<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CreateFieldsTypesPayments extends Seeder
{
    public function run()
    {
        $this->db->table('types_payments')->insertBatch([
            [
                "description" => "Money"
            ],
              [
                "description" => "Credit Card"
              ],
                [
                "description" => "Debit Card"
                ],
                [
                "description" => "On credit"
            ]
        ]);
        
    }
}
