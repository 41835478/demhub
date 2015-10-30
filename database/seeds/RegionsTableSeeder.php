<?php

use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $regions = [
        [
          'country' => 'australia',
          'regions_array' => '"All-Regions","Victoria","Western-Australia","South-Australia","Queensland","New-South-Wales"'
        ],
        [
          'country' => 'canada',
          'regions_array' => '"All-Regions","Alberta","British-Columbia","Manitoba","New-Brunswick","Newfoundland-and-Labrabor","Nova-Scotia","Ontario","Prince-Edward-Island","Quebec","Saskatchewan","Northwest-Territories","Nunavut","Yukon"'
        ],
        [
          'country' => 'united_states',
          'regions_array' => '"All-Regions","Alabama","Alaska","Arizona ","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New-Hampshire","New-Jersey","New-Mexico","New-York","North-Carolina","North-Dakota","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode-Island","South-Carolina","South-Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West-Virginia","Wisconsin","Wyoming"'
        ],
        [
          'country' => 'new_zealand',
          'regions_array' => '"All-Regions"'
        ],
      ];

      DB::table('regions')->insert($regions);
    }
}
