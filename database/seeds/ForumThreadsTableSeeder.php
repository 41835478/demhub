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
      $threads = [
        [
          'parent_category' => 1,
          'author_id' => 1,
          'title' => 'Should we still be on alert for Ebola?',
          'pinned' => 0,
          'locked' => 0,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'parent_category' => 1,
          'author_id' => 1,
          'title' => 'Are hospital’s daily procedures incorporating preventative measures?',
          'pinned' => 0,
          'locked' => 0,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'parent_category' => 2,
          'author_id' => 1,
          'title' => 'Is climate change a bigger issue for costal communities?',
          'pinned' => 0,
          'locked' => 0,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'parent_category' => 2,
          'author_id' => 1,
          'title' => 'New “Snow Plow Theory” explains Tsunami behaviour',
          'pinned' => 0,
          'locked' => 0,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'parent_category' => 3,
          'author_id' => 1,
          'title' => 'Evaluating EM Technology Solutions',
          'pinned' => 0,
          'locked' => 0,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'parent_category' => 3,
          'author_id' => 1,
          'title' => "Last year's devastating West Texas explosion",
          'pinned' => 0,
          'locked' => 0,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'parent_category' => 4,
          'author_id' => 1,
          'title' => "Preparing your network's security",
          'pinned' => 0,
          'locked' => 0,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'parent_category' => 4,
          'author_id' => 1,
          'title' => 'Comparing civil security systems',
          'pinned' => 0,
          'locked' => 0,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'parent_category' => 4,
          'author_id' => 1,
          'title' => 'Is LSE-led research a paradigm shift?',
          'pinned' => 0,
          'locked' => 0,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'parent_category' => 5,
          'author_id' => 1,
          'title' => 'Pre-disaster Business continuity planning',
          'pinned' => 0,
          'locked' => 0,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'parent_category' => 5,
          'author_id' => 1,
          'title' => 'Climate change a risk to business?',
          'pinned' => 0,
          'locked' => 0,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'parent_category' => 6,
          'author_id' => 1,
          'title' => 'Reshaping how humanitarian Efforts',
          'pinned' => 0,
          'locked' => 0,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'parent_category' => 6,
          'author_id' => 1,
          'title' => 'NGO and humanitarian relief efforts',
          'pinned' => 0,
          'locked' => 0,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'parent_category' => 6,
          'author_id' => 1,
          'title' => 'The role of information sharing',
          'pinned' => 0,
          'locked' => 0,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
      ];

      DB::table('forum_threads')->insert($threads);
    }
}
