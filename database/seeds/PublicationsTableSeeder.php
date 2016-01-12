<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PublicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_one = json_encode([
            1,
            'Cool issue',
            280,
            'Bob Ross',
            'Evergreen',
            'Fluff that up, Vegas',
            'Aldo Ruiz Monsieur',
            '',
            1
        ]);

        $data_two = json_encode([
            $request->volume,
            $request->issues,
            $request->pages,
            $request->publisher,
            $request->institution,
            $request->conference,
            $request->publication_author,
            $request->favorites,
            $request->views
        ]);

        // $data_three = json_encode([
        //     $request->volume,
        //     $request->issues,
        //     $request->pages,
        //     $request->publisher,
        //     $request->institution,
        //     $request->conference,
        //     $request->publication_author,
        //     $request->favorites,
        //     $request->views
        // ]);
        //
        // $data_four = json_encode([
        //     $request->volume,
        //     $request->issues,
        //     $request->pages,
        //     $request->publisher,
        //     $request->institution,
        //     $request->conference,
        //     $request->publication_author,
        //     $request->favorites,
        //     $request->views
        // ]);
        //
        // $data_five = json_encode([
        //     $request->volume,
        //     $request->issues,
        //     $request->pages,
        //     $request->publisher,
        //     $request->institution,
        //     $request->conference,
        //     $request->publication_author,
        //     $request->favorites,
        //     $request->views
        // ]);
        //
        // $data_six = json_encode([
        //     $request->volume,
        //     $request->issues,
        //     $request->pages,
        //     $request->publisher,
        //     $request->institution,
        //     $request->conference,
        //     $request->publication_author,
        //     $request->favorites,
        //     $request->views
        // ]);

        DB::table('contents')->insert([
          [
              'name' => 'Trees grow in all kinds of ways',
              'description' => "They're not all perfectly straight. Not every limb is perfect. If these lines aren't straight, your water's going to run right out of your painting and get your floor wet. I thought today we would do a happy little picture.",
              'data' => $data_one,
              'divisions' => '|science|response|security|continuity|',
              'keywords' => 'trees, bob ross, stuff',
              'visibility' => 1,
              'owner_id' => 1,
              'deleted' => 0,
              'publish_date' => Carbon::createFromFormat('d/m/Y', '17/03/1990'),
          ],
        ]);

        DB::table('content_media')->insert([
          [
              'description' => NULL,
              'view_order' => 0,
              'deleted' => false,
              'resource' => NULL,
              'content_id' => 1
          ],
          [
              'description' => NULL,
              'view_order' => 0,
              'deleted' => false,
              'resource' => NULL,
              'content_id' => 2
          ],
          [
              'description' => NULL,
              'view_order' => 0,
              'deleted' => false,
              'resource' => NULL,
              'content_id' => 3
          ],
          [
              'description' => NULL,
              'view_order' => 0,
              'deleted' => false,
              'resource' => NULL,
              'content_id' => 4
          ],
          [
              'description' => NULL,
              'view_order' => 0,
              'deleted' => false,
              'resource' => NULL,
              'content_id' => 5
          ],
          [
              'description' => NULL,
              'view_order' => 0,
              'deleted' => false,
              'resource' => NULL,
              'content_id' => 6
          ],
        ]);

        DB::table('publications')->insert([
          [
              'user_id' => 1,
              'title' => 'Trees grow in all kinds of ways',
              'description' => "They're not all perfectly straight. Not every limb is perfect. If these lines aren't straight, your water's going to run right out of your painting and get your floor wet. I thought today we would do a happy little picture.",
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
              'deleted_at' => NULL,
              'document_content_type' => NULL,
              'document_file_size' => NULL,
              'document_content_type' => NULL,
              'document_updated_at' => NULL,
              'privacy' => 0,
              'divisions' => '|science|response|security|continuity|',
              'keywords' => 'trees, bob ross, stuff',
              'volume' => 1,
              'issues' => 'Cool issue',
              'pages' => 280,
              'publisher' => 'Bob Ross',
              'institution' => 'Evergreen',
              'conference' => 'Fluff that up, Vegas',
              'publication_author' => 'Aldo Ruiz Monsieur',
              'publication_date' => Carbon::createFromFormat('d/m/Y', '17/03/1990'),
              'deleted' => '',
              'favorites' => '',
              'views' => 1,
          ],
          [
              'user_id' => 1,
              'title' => 'Anything',
              'description' => "The secret to doing anything is believing that you can do it. Anything that you believe you can do strong enough, you can do",
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
              'deleted_at' => NULL,
              'document_content_type' => NULL,
              'document_file_size' => NULL,
              'document_content_type' => NULL,
              'document_updated_at' => NULL,
              'privacy' => 0,
              'divisions' => '|health|response|security|continuity|',
              'keywords' => 'trees, bob ross, stuff',
              'volume' => 1,
              'issues' => 'Cool issue',
              'pages' => 280,
              'publisher' => 'Bob Ross',
              'institution' => 'Evergreen',
              'conference' => 'Fluff that up, China',
              'publication_author' => 'Aldo Ruiz Luna',
              'publication_date' => Carbon::createFromFormat('d/m/Y', '17/03/1990'),
              'deleted' => '',
              'favorites' => '',
              'views' => 1,
          ],
          [
              'user_id' => 2,
              'title' => 'This is your creation',
              'description' => "This is your creation - and it's just as unique and special as you are. Almost everything is going to happen for you automatically - you don't have to spend any time working or worrying",
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
              'deleted_at' => NULL,
              'document_content_type' => NULL,
              'document_file_size' => NULL,
              'document_content_type' => NULL,
              'document_updated_at' => NULL,
              'privacy' => 0,
              'divisions' => '|health|science|security|continuity|',
              'keywords' => 'trees, bob ross, stuff',
              'volume' => 1,
              'issues' => 'Cool issue',
              'pages' => 280,
              'publisher' => 'Bob Ross',
              'institution' => 'Evergreen',
              'conference' => 'Fluff that up, Mexico',
              'publication_author' => 'DEMHUB',
              'publication_date' => Carbon::createFromFormat('d/m/Y', '17/03/1990'),
              'deleted' => '',
              'favorites' => '',
              'views' => 1,
          ],
          [
              'user_id' => 2,
              'title' => "I guess I'm a little weird",
              'description' => "I like to talk to trees and animals. That's okay though; I have more fun than most people.",
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
              'deleted_at' => NULL,
              'document_content_type' => NULL,
              'document_file_size' => NULL,
              'document_content_type' => NULL,
              'document_updated_at' => NULL,
              'privacy' => 0,
              'divisions' => '|health|science|response|continuity|',
              'keywords' => 'trees, bob ross, stuff',
              'volume' => 1,
              'issues' => 'Cool issue',
              'pages' => 280,
              'publisher' => 'Bob Ross',
              'institution' => 'Evergreen',
              'conference' => 'Fluff that up, Amsterdam',
              'publication_author' => 'Aldo Ruiz Chulo',
              'publication_date' => Carbon::createFromFormat('d/m/Y', '17/03/1990'),
              'deleted' => '',
              'favorites' => '',
              'views' => 1,
          ],
          [
              'user_id' => 3,
              'title' => "It's life",
              'description' => "It's life. It's interesting. It's fun. Let's have a nice tree right here. That's a crooked tree. We'll send him to Washington.",
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
              'deleted_at' => NULL,
              'document_content_type' => NULL,
              'document_file_size' => NULL,
              'document_content_type' => NULL,
              'document_updated_at' => NULL,
              'privacy' => 0,
              'divisions' => '|health|science|response|security|',
              'keywords' => 'trees, bob ross, stuff',
              'volume' => 1,
              'issues' => 'Cool issue',
              'pages' => 280,
              'publisher' => 'Bob Ross',
              'institution' => 'Evergreen',
              'conference' => 'Fluff that up, Toronto, Canada',
              'publication_author' => 'Aldo Ruiz El Capitan',
              'publication_date' => Carbon::createFromFormat('d/m/Y', '17/03/1990'),
              'deleted' => '',
              'favorites' => '',
              'views' => 1,
          ],
          [
              'user_id' => 3,
              'title' => 'A happy cloud',
              'description' => "Maybe there's a happy little bush that lives right there. This is the time to get out all your flustrations, much better than kicking the dog around the house or taking it out on your spouse.",
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
              'deleted_at' => NULL,
              'document_content_type' => NULL,
              'document_file_size' => NULL,
              'document_content_type' => NULL,
              'document_updated_at' => NULL,
              'privacy' => 0,
              'divisions' => '|health|science|response|security|continuity|humanitarian|',
              'keywords' => 'trees, bob ross, stuff',
              'volume' => 1,
              'issues' => 'Cool issue',
              'pages' => 280,
              'publisher' => 'Bob Ross',
              'institution' => 'Evergreen',
              'conference' => 'Fluff that up, Canada',
              'publication_author' => 'Aldo Luna',
              'publication_date' => Carbon::createFromFormat('d/m/Y', '17/03/1990'),
              'deleted' => '',
              'favorites' => '',
              'views' => 1,
          ]
        ]);
    }
}
