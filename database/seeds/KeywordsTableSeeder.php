<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;
use League\Csv\Reader;

class KeywordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $keywordsData = database_path().'/data/keywords.csv';
      $csv = Reader::createFromPath($keywordsData);
      // $csv->setOffset(1) // start from the 2nd row, since the 1st is the CSV header

      $nb_iterations = $csv->setOffset(1)->fetchAll(function ($row) {
        DB::table('keywords')->insert([
          // 'id' => $row[0], // id is assigned automatically, so we don't need it
          'weight' => $row[1],
          'keyword' => $row[2],
          'slug' => $row[3],
          'divisions' => $row[4],
          'deleted' => $row[5],
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ]);
      });
    }
}
