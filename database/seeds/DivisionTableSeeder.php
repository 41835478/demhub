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
        ['name' => 'Health & Epidemics', 'slug' => 'health', 'bg_color' => '0D8E56', 'welcome_message' => 'HEALTH<font style="visibility:hidden">*</font>&<font style="visibility:hidden">*</font>EPIDEMICS'],
        ['name' => 'Science & ENvironment', 'slug' => 'science', 'bg_color' => '1D73A3', 'welcome_message' => 'SCIENCE<font style="visibility:hidden">*</font>&<font style="visibility:hidden">*</font>ENVIRONMENT'],
        ['name' => 'EM Practitioner & Response', 'slug' => 'response', 'bg_color' => 'DB9421', 'welcome_message' => 'EM<font style="visibility:hidden">*</font>PRACITIONER<font style="visibility:hidden">*</font>&<font style="visibility:hidden">*</font>RESPONSE'],
        ['name' => 'Civil & Cyber Security', 'slug' => 'security', 'bg_color' => '848889', 'welcome_message' => 'CIVIL<font style="visibility:hidden">*</font>&<font style="visibility:hidden">*</font>CYBER<font style="visibility:hidden">*</font>SECURITY'],
        ['name' => 'Business Continuity', 'slug' => 'continuity', 'bg_color' => '933131', 'welcome_message' => 'BUSINESS<font style="visibility:hidden">*</font>CONTINUITY'],
        ['name' => 'NGO & Humanitarian', 'slug' => 'humanitarian', 'bg_color' => '754293', 'welcome_message' => 'NGO<font style="visibility:hidden">*</font>&<font style="visibility:hidden">*</font>HUMANITARIAN'],
      ]);
    }
}
