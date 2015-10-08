<?php

use Illuminate\Database\Seeder;

class SectorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sectors')->insert([
          ['name' => 'Health', 'slug' => 'health'],
          ['name' => 'Science, Research & Academia', 'slug' => 'academia'],
          ['name' => 'EM Practitioner & Response', 'slug' => 'response'],
          ['name' => 'Civil & Cyber Security', 'slug' => 'security'],
          ['name' => 'Business Continuity & Risk Management', 'slug' => 'continuity'],
          ['name' => 'NGO & Humanitarian', 'slug' => 'humanitarian'],
        ]);
    }
}
