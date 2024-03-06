<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CreateFieldsStatustransaction extends Seeder
{
    public function run()
    {
         $this->db->table('status_transaction')->insertBatch([
            [
                "description" => "Pending"
            ],
              [
                "description" => "Approved"
              ],
                [
                "description" => "Reproved"
                ]
        ]);
    }
}
