<?php

use Illuminate\Database\Seeder;

class InfoResourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $resources = [
        [
          'name' => 'Emergency Management',
          'url' => 'http://www.ag.gov.au/emergencymanagement/Pages/default.aspx',
          'country' => 'australia',
          'region' => 'all_regions'
        ],
        [
          'name' => 'National Security',
          'url' => 'http://www.ag.gov.au/NationalSecurity/Pages/home.aspx',
          'country' => 'australia',
          'region' => 'all_regions'
        ],
        [
          'name' => 'Australian Emergency Managment Knowledge Hub',
          'url' => 'https://www.emknowledge.gov.au/',
          'country' => 'australia',
          'region' => 'all_regions'
        ],
        [
          'name' => 'Education and Courses',
          'url' => 'https://www.emknowledge.gov.au/education-and-courses/',
          'country' => 'australia',
          'region' => 'all_regions'
        ],
        [
          'name' => 'ABC Emergency',
          'url' => 'http://www.abc.net.au/news/emergency/',
          'country' => 'australia',
          'region' => 'all_regions'
        ],
        [
          'name' => "Australia's Aid Program",
          'url' => 'http://dfat.gov.au/aid/Pages/australias-aid-program.aspx',
          'country' => 'australia',
          'region' => 'all_regions'
        ],
        [
          'name' => 'Australian Council of State Emergency Services',
          'url' => 'http://ses.org.au/',
          'country' => 'australia',
          'region' => 'all_regions'
        ],
        [
          'name' => 'Australian Emergency Management Volunteer Forum',
          'url' => 'http://www.aemvf.org.au/',
          'country' => 'australia',
          'region' => 'all_regions'
        ],
        [
          'name' => 'Australian Federal Police',
          'url' => 'http://www.afp.gov.au/',
          'country' => 'australia',
          'region' => 'all_regions'
        ],
        [
          'name' => 'Australian Fire Authorities Council',
          'url' => 'http://www.afac.com.au/',
          'country' => 'australia',
          'region' => 'all_regions'
        ],
      ];

      DB::table('info_resources')->insert($resources);
    }
}
