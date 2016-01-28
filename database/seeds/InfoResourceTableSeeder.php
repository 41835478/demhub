<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use Carbon\Carbon as Carbon;

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
            DB::table('contents')->insert([
                // 'id' => ..., // id is assigned automatically, so we don't need it
                'subclass'      => 'infoResource', // $row[0]
                'name'          => $row[1] == "NULL" ? NULL : $row[1],
                'divisions'     => $row[4] == "NULL" ? NULL : $row[4],
                'keywords'      => $row[5] == "NULL" ? NULL : $row[5],
                'url'           => $row[7] == "NULL" ? NULL : $row[7],
                'country'       => $row[8] == "NULL" ? NULL : $row[8],
                'state'         => $row[9] == "NULL" ? NULL : $row[9],
                'visibility'    => $row[15] == "NULL" ? NULL : $row[15],
                'deleted'       => $row[18] == "NULL" ? NULL : $row[18],
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ]);
        });
    }
}
