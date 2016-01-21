<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use Carbon\Carbon;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articlesData = database_path().'/data/articles.csv';
        $csv = Reader::createFromPath($articlesData);
        // $csv->setOffset(1) // start from the 2nd row, since the 1st is the CSV header

        $nb_iterations = $csv->setOffset(1)->fetchAll(function ($row) {
            DB::table('contents')->insert([
                // 'id' => ..., // id is assigned automatically, so we don't need it
                'subclass'      => 'article', // $row[0]
                'name'          => $row[1] == "NULL" ? NULL : $row[1],
                'description'   => $row[2] == "NULL" ? NULL : $row[2],
                'data'          => $row[3] == "NULL" ? NULL : $row[3],
                'divisions'     => $row[4] == "NULL" ? NULL : $row[4],
                'keywords'      => $row[5] == "NULL" ? NULL : $row[5],
                'url'           => $row[7] == "NULL" ? NULL : $row[7],
                'country'       => $row[8] == "NULL" ? NULL : $row[8],
                'state'         => $row[9] == "NULL" ? NULL : $row[9],
                'city'          => $row[10] == "NULL" ? NULL : $row[10],
                'lat'           => $row[11] == "NULL" ? NULL : $row[11],
                'lng'           => $row[12] == "NULL" ? NULL : $row[12],
                'visibility'    => $row[15] == "NULL" ? NULL : $row[15],
                'status_flag'   => $row[16] == "NULL" ? NULL : $row[16],
                'owner_id'      => $row[17] == "NULL" ? NULL : $row[17],
                'deleted'       => $row[18] == "NULL" ? NULL : $row[18],
                'publish_date'  => $row[19] == "NULL" ? NULL : Carbon::parse($row[19]),
                'created_at'    => $row[20] == "NULL" ? NULL : Carbon::parse($row[20]),
                'updated_at'    => $row[21] == "NULL" ? NULL : Carbon::parse($row[21])
            ]);
        });
    }
}
