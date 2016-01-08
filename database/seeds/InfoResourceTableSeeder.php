<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;

class InfoResourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $resourcesData = database_path().'/data/info_resources.csv';
      $csv = Reader::createFromPath($resourcesData);
      // $csv->setOffset(1) // start from the 2nd row, since the 1st is the CSV header

      $nb_iterations = $csv->setOffset(1)->fetchAll(function ($row) {
        DB::table('info_resources')->insert([
          // 'id' => ..., // id is assigned automatically, so we don't need it
          'name' => $row[0],
          'url' => $row[1],
          'country' => $row[2],
          'region' => $row[3],
          'divisions' => $row[4],
          'keywords' => $row[5]
        ]);
      });
    }
}
