<?php

use Illuminate\Database\Seeder;

class DivisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('divisions')->insert([
        ['name' => 'Health', 'slug' => 'health'],
        ['name' => 'Science, Research & Academia', 'slug' => 'academia'],
        ['name' => 'EM Practitioner & Response', 'slug' => 'response'],
        ['name' => 'Civil & Cyber Security', 'slug' => 'security'],
        ['name' => 'Business Continuity', 'slug' => 'continuity'],
        ['name' => 'NGO & Humanitarian', 'slug' => 'humanitarian'],
      ]);
    }
}
