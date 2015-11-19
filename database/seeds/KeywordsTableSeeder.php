<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;

class KeywordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $keywords = [
        [
          'weight' => 1,
          'keyword' => 'terrorism',
          'slug' => 'terrorism',
          'divisions' => '|4|',
          'deleted' => 0,
				  'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'terrorist',
          'slug' => 'terrorist',
          'divisions' => '|4|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'breach',
          'slug' => 'breach',
          'divisions' => '|4|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'security',
          'slug' => 'security',
          'divisions' => '|4|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'cybersecurity',
          'slug' => 'cybersecurity',
          'divisions' => '|4|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'threat',
          'slug' => 'threat',
          'divisions' => '|4|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'cybercrime',
          'slug' => 'cybercrime',
          'divisions' => '|4|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'civil protection',
          'slug' => 'civil-protection',
          'divisions' => '|4|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'risk reduction',
          'slug' => 'risk-reduction',
          'divisions' => '|3|4|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'preparedness',
          'slug' => 'preparedness',
          'divisions' => '|3|4|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'mitigation',
          'slug' => 'mitigation',
          'divisions' => '|3|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'infrastructure',
          'slug' => 'infrastructure',
          'divisions' => '|3|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'recovery',
          'slug' => 'recovery',
          'divisions' => '|3|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'response',
          'slug' => 'response',
          'divisions' => '|3|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'humanitarian',
          'slug' => 'humanitarian',
          'divisions' => '|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'pandemic',
          'slug' => 'pandemic',
          'divisions' => '|1|3|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'epidemic',
          'slug' => 'epidemic',
          'divisions' => '|1|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'endemic',
          'slug' => 'endemic',
          'divisions' => '|1|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'outbreak',
          'slug' => 'outbreak',
          'divisions' => '|1|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'quarentine',
          'slug' => 'quarentine',
          'divisions' => '|1|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'virus',
          'slug' => 'virus',
          'divisions' => '|1|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'risk management',
          'slug' => 'risk-management',
          'divisions' => '|3|5|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'continuity',
          'slug' => 'continuity',
          'divisions' => '|3|5|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'resiliency',
          'slug' => 'resiliency',
          'divisions' => '|3|5|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'resilience',
          'slug' => 'resilience',
          'divisions' => '|3|5|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'communication',
          'slug' => 'communication',
          'divisions' => '|3|5|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'training',
          'slug' => 'training',
          'divisions' => '|3|5|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'exercise',
          'slug' => 'exercise',
          'divisions' => '|3|5|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'relief',
          'slug' => 'relief',
          'divisions' => '|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'aid',
          'slug' => 'aid',
          'divisions' => '|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'coordination',
          'slug' => 'coordination',
          'divisions' => '|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'earthquake',
          'slug' => 'earthquake',
          'divisions' => '|2|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'hurricane',
          'slug' => 'hurricane',
          'divisions' => '|2|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'cyclone',
          'slug' => 'cyclone',
          'divisions' => '|2|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'typhoon',
          'slug' => 'typhoon',
          'divisions' => '|2|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'tsunami',
          'slug' => 'tsunami',
          'divisions' => '|2|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'tornado',
          'slug' => 'tornado',
          'divisions' => '|2|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'tropical storm',
          'slug' => 'tropical-storm',
          'divisions' => '|2|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'landslide',
          'slug' => 'landslide',
          'divisions' => '|2|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'mudslide',
          'slug' => 'mudslide',
          'divisions' => '|2|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'flood',
          'slug' => 'flood',
          'divisions' => '|2|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'ice storm',
          'slug' => 'ice-storm',
          'divisions' => '|2|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'volcano',
          'slug' => 'volcano',
          'divisions' => '|2|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'storm surge',
          'slug' => 'storm-surge',
          'divisions' => '|2|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'severe weather',
          'slug' => 'severe-weather',
          'divisions' => '|2|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'oil spill',
          'slug' => 'oil-spill',
          'divisions' => '|1|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'nuclear',
          'slug' => 'nuclear',
          'divisions' => '|1|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'chemical spill',
          'slug' => 'chemical-spill',
          'divisions' => '|1|3|6|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'train derailment',
          'slug' => 'train-derailment',
          'divisions' => '|5|3|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'bridge collapse',
          'slug' => 'bridge-collapse',
          'divisions' => '|5|3|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'weight' => 1,
          'keyword' => 'active shooter',
          'slug' => 'active-shooter',
          'divisions' => '|3|4|',
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
      ];

      DB::table('keywords')->insert($keywords);
    }
}
