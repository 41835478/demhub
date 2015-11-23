<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;
use League\Csv\Reader;

class ScrapeSourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $scrapeSourcesData = database_path().'/data/scrape_sources.csv';
      $csv = Reader::createFromPath($scrapeSourcesData);
      // $csv->setOffset(1) // start from the 2nd row, since the 1st is the CSV header

      $nb_iterations = $csv->setOffset(1)->fetchAll(function ($row) {
        $article_type = $row[2] == "NULL" ? NULL : $row[2];
        $title = $row[3] == "NULL" ? NULL : $row[3];
        $division_id = $row[5] == "NULL" ? NULL : $row[5];
        DB::table('scrape_sources')->insert([
          // 'id' => $row[0], // id is assigned automatically, so we don't need it
          'type' => $row[1],
          'article_type' => $article_type,
          'title' => $title,
          'url' => $row[4],
          'division_id' => $division_id,
          'last_checked_item' => Carbon::now(-10000),
          'deleted' => $row[7],
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ]);
      });
    }
}
