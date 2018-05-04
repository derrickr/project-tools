<?php

use Illuminate\Database\Seeder;

class ResourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	DB::table('resources')->insert([
		['id' => 1, 'resource' => 'Senior Project Manager', 'abbrv' => 'SPM', 'price' => '750.00', 'res_date' => date("Y-m-d H:i:s"), 'submitted_by' => 'Mark Smith', 'deleted_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		['id' => 2, 'resource' => 'Technical Architect', 'abbrv' => 'TA', 'price' => '650.00', 'res_date' => date("Y-m-d H:i:s"), 'submitted_by' => 'Mark Smith', 'deleted_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		['id' => 3, 'resource' => 'Systems Administrator', 'abbrv' => 'SA', 'price' => '600.00', 'res_date' => date("Y-m-d H:i:s"), 'submitted_by' => 'Mark Smith', 'deleted_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		['id' => 4, 'resource' => 'DevOps', 'abbrv' => 'DvO', 'price' => '550.00', 'res_date' => date("Y-m-d H:i:s"), 'submitted_by' => 'Mark Smith', 'deleted_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		['id' => 5, 'resource' => 'PHP Dev', 'abbrv' => 'PHP', 'price' => '500.00', 'res_date' => date("Y-m-d H:i:s"), 'submitted_by' => 'Mark Smith', 'deleted_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		['id' => 6, 'resource' => 'Database Admin', 'abbrv' => 'DBA', 'price' => '500.00', 'res_date' => date("Y-m-d H:i:s"), 'submitted_by' => 'Mark Smith', 'deleted_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
		['id' => 7, 'resource' => 'JavaScript Dev', 'abbrv' => 'JS', 'price' => '475.00', 'res_date' => date("Y-m-d H:i:s"), 'submitted_by' => 'Mark Smith', 'deleted_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
        ]);
    }
}
