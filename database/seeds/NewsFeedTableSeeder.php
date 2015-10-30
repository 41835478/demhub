<?php

use Illuminate\Database\Seeder;

class NewsFeedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $newsFeeds = [
        [
          'url' => 'http://www.who.int/feeds/entity/csr/disease/ebola/rss/en/rss.xml',
          'division_id' => 1
        ],
        [
          'url' => 'http://www.who.int/feeds/entity/csr/don/en/rss.xml',
          'division_id' => 1
        ],
        [
          'url' => 'http://www.preventionweb.net/english/rss/feed.php?id=8',
          'division_id' => 1
        ],
        [
          'url' => 'http://ptwc.weather.gov/feeds/ptwc_rss_pacific.xml',
          'division_id' => 2
        ],
        [
          'url' => 'http://ptwc.weather.gov/feeds/ptwc_rss_hawaii.xml',
          'division_id' => 2
        ],
        [
          'url' => 'http://ptwc.weather.gov/feeds/ptwc_rss_caribe.xml',
          'division_id' => 2
        ],
        [
          'url' => 'http://feeds.feedburner.com/unisdr?format=xml',
          'division_id' => 3
        ],
        [
          'url' => 'http://www.who.int/feeds/entity/hac/en/rss.xml',
          'division_id' => 3
        ],
        [
          'url' => 'http://www.who.int/feeds/entity/csr/don/en/rss.xml',
          'division_id' => 3
        ],
        [
          'url' => 'http://www.drdc-rddc.gc.ca/en/drdc-news-rss.page',
          'division_id' => 4
        ],
        [
          'url' => 'http://www.drj.com/industry/industry-hot-news.html?format=feed',
          'division_id' => 5
        ],
        [
          'url' => 'http://www.drj.com/articles/online-exclusive.html?format=feed',
          'division_id' => 5
        ],
        [
          'url' =>   'http://createfeed.fivefilters.org/extract.php?url=www.thebci.org%2Findex.php%2Fabout%2Fnews-room%23%2Fla test_news&in_id_or_class=newsroom-list-header&url_contains=hidden-small',
          'division_id' => 5
        ],
        [
          'url' => 'http://feeds.feedburner.com/unisdr?format=xml',
          'division_id' => 6
        ],
        [
          'url' => 'http://www.preventionweb.net/english/rss/feed.php?id=8',
          'division_id' => 6
        ],
        [
          'url' => 'http://www.preventionweb.net/english/rss/feed.php?id=2',
          'division_id' => 6
        ],
      ];

      DB::table('news_feeds')->insert($newsFeeds);
    }
}
