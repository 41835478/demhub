<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;

class ForumThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //   $threads = [
    //     [
    //       'parent_category' => 1,
    //       'author_id' => 1,
    //       'title' => 'Should we still be on alert for Ebola?',
    //       'pinned' => 0,
    //       'locked' => 0,
    //       'created_at' => Carbon::now(),
    //       'updated_at' => Carbon::now()
    //     ],
    //     [
    //       'parent_category' => 1,
    //       'author_id' => 1,
    //       'title' => 'Are hospital’s daily procedures incorporating preventative measures?',
    //       'pinned' => 0,
    //       'locked' => 0,
    //       'created_at' => Carbon::now(),
    //       'updated_at' => Carbon::now()
    //     ],
    //     [
    //       'parent_category' => 2,
    //       'author_id' => 1,
    //       'title' => 'Is climate change a bigger issue for costal communities?',
    //       'pinned' => 0,
    //       'locked' => 0,
    //       'created_at' => Carbon::now(),
    //       'updated_at' => Carbon::now()
    //     ],
    //     [
    //       'parent_category' => 2,
    //       'author_id' => 1,
    //       'title' => 'New “Snow Plow Theory” explains Tsunami behaviour',
    //       'pinned' => 0,
    //       'locked' => 0,
    //       'created_at' => Carbon::now(),
    //       'updated_at' => Carbon::now()
    //     ],
    //     [
    //       'parent_category' => 3,
    //       'author_id' => 1,
    //       'title' => 'Evaluating EM Technology Solutions',
    //       'pinned' => 0,
    //       'locked' => 0,
    //       'created_at' => Carbon::now(),
    //       'updated_at' => Carbon::now()
    //     ],
    //     [
    //       'parent_category' => 3,
    //       'author_id' => 1,
    //       'title' => "Last year's devastating West Texas explosion",
    //       'pinned' => 0,
    //       'locked' => 0,
    //       'created_at' => Carbon::now(),
    //       'updated_at' => Carbon::now()
    //     ],
    //     [
    //       'parent_category' => 4,
    //       'author_id' => 1,
    //       'title' => "Preparing your network's security",
    //       'pinned' => 0,
    //       'locked' => 0,
    //       'created_at' => Carbon::now(),
    //       'updated_at' => Carbon::now()
    //     ],
    //     [
    //       'parent_category' => 4,
    //       'author_id' => 1,
    //       'title' => 'Comparing civil security systems',
    //       'pinned' => 0,
    //       'locked' => 0,
    //       'created_at' => Carbon::now(),
    //       'updated_at' => Carbon::now()
    //     ],
    //     [
    //       'parent_category' => 4,
    //       'author_id' => 1,
    //       'title' => 'Is LSE-led research a paradigm shift?',
    //       'pinned' => 0,
    //       'locked' => 0,
    //       'created_at' => Carbon::now(),
    //       'updated_at' => Carbon::now()
    //     ],
    //     [
    //       'parent_category' => 5,
    //       'author_id' => 1,
    //       'title' => 'Pre-disaster Business continuity planning',
    //       'pinned' => 0,
    //       'locked' => 0,
    //       'created_at' => Carbon::now(),
    //       'updated_at' => Carbon::now()
    //     ],
    //     [
    //       'parent_category' => 5,
    //       'author_id' => 1,
    //       'title' => 'Climate change a risk to business?',
    //       'pinned' => 0,
    //       'locked' => 0,
    //       'created_at' => Carbon::now(),
    //       'updated_at' => Carbon::now()
    //     ],
    //     [
    //       'parent_category' => 6,
    //       'author_id' => 1,
    //       'title' => 'Reshaping how humanitarian Efforts',
    //       'pinned' => 0,
    //       'locked' => 0,
    //       'created_at' => Carbon::now(),
    //       'updated_at' => Carbon::now()
    //     ],
    //     [
    //       'parent_category' => 6,
    //       'author_id' => 1,
    //       'title' => 'NGO and humanitarian relief efforts',
    //       'pinned' => 0,
    //       'locked' => 0,
    //       'created_at' => Carbon::now(),
    //       'updated_at' => Carbon::now()
    //     ],
    //     [
    //       'parent_category' => 6,
    //       'author_id' => 1,
    //       'title' => 'The role of information sharing',
    //       'pinned' => 0,
    //       'locked' => 0,
    //       'created_at' => Carbon::now(),
    //       'updated_at' => Carbon::now()
    //     ],
    //   ];

      $threads = [
        [
            'subclass' => 'thread',
            'name' => 'Should we still be on alert for Ebola?',
            'data' => json_encode([1]), // view_count
            'divisions' => '|1|',
            'visibility' => 1,
            'status_flag' => 0,
            'owner_id' => 1,
            'deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'subclass' => 'thread',
            'name' => 'Are hospital’s daily procedures incorporating preventative measures?',
            'data' => json_encode([1]), // view_count
            'divisions' => '|1|',
            'visibility' => 1,
            'status_flag' => 0,
            'owner_id' => 1,
            'deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'subclass' => 'thread',
            'name' => 'Is climate change a bigger issue for costal communities?',
            'data' => json_encode([1]), // view_count
            'divisions' => '|2|',
            'visibility' => 1,
            'status_flag' => 0,
            'owner_id' => 1,
            'deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'subclass' => 'thread',
            'name' => 'New "Snow Plow Theory" explains Tsunami behaviour',
            'data' => json_encode([1]), // view_count
            'divisions' => '|2|',
            'visibility' => 1,
            'status_flag' => 0,
            'owner_id' => 1,
            'deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'subclass' => 'thread',
            'name' => 'Evaluating EM Technology Solutions',
            'data' => json_encode([1]), // view_count
            'divisions' => '|3|',
            'visibility' => 1,
            'status_flag' => 0,
            'owner_id' => 1,
            'deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'subclass' => 'thread',
            'name' => 'Last year\'s devastating West Texas explosion',
            'data' => json_encode([1]), // view_count
            'divisions' => '|3|',
            'visibility' => 1,
            'status_flag' => 0,
            'owner_id' => 1,
            'deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'subclass' => 'thread',
            'name' => 'Preparing your network\'s security',
            'data' => json_encode([1]), // view_count
            'divisions' => '|4|',
            'visibility' => 1,
            'status_flag' => 0,
            'owner_id' => 1,
            'deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'subclass' => 'thread',
            'name' => 'Comparing civil security systems',
            'data' => json_encode([1]), // view_count
            'divisions' => '|4|',
            'visibility' => 1,
            'status_flag' => 0,
            'owner_id' => 1,
            'deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'subclass' => 'thread',
            'name' => 'Is LSE-led research a paradigm shift?',
            'data' => json_encode([1]), // view_count
            'divisions' => '|4|',
            'visibility' => 1,
            'status_flag' => 0,
            'owner_id' => 1,
            'deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'subclass' => 'thread',
            'name' => 'Pre-disaster Business continuity planning',
            'data' => json_encode([1]), // view_count
            'divisions' => '|5|',
            'visibility' => 1,
            'status_flag' => 0,
            'owner_id' => 1,
            'deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'subclass' => 'thread',
            'name' => 'Climate change a risk to business?',
            'data' => json_encode([1]), // view_count
            'divisions' => '|5|',
            'visibility' => 1,
            'status_flag' => 0,
            'owner_id' => 1,
            'deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'subclass' => 'thread',
            'name' => 'Reshaping how humanitarian Efforts',
            'data' => json_encode([1]), // view_count
            'divisions' => '|6|',
            'visibility' => 1,
            'status_flag' => 0,
            'owner_id' => 1,
            'deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'subclass' => 'thread',
            'name' => 'NGO and humanitarian relief efforts',
            'data' => json_encode([1]), // view_count
            'divisions' => '|6|',
            'visibility' => 1,
            'status_flag' => 0,
            'owner_id' => 1,
            'deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'subclass' => 'thread',
            'name' => 'The role of information sharing',
            'data' => json_encode([1]), // view_count
            'divisions' => '|6|',
            'visibility' => 1,
            'status_flag' => 0,
            'owner_id' => 1,
            'deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
      ];

      DB::table('contents')->insert($threads);
    }
}
