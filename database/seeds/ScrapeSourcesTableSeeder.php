<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;

class ScrapeSourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $scrapeSources = [
        [ // 1
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://www.who.int/feeds/entity/csr/disease/ebola/rss/en/rss.xml',
          'division_id' => 1,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://www.who.int/feeds/entity/csr/don/en/rss.xml',
          'division_id' => 1,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://www.drdc-rddc.gc.ca/en/drdc-news-rss.page',
          'division_id' => 1,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://feeds.feedburner.com/unisdr?format=xml',
          'division_id' => 2,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [ // 5
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://www.preventionweb.net/english/rss/feed.php?id=8',
          'division_id' => 2,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://www.preventionweb.net/english/rss/feed.php?id=2',
          'division_id' => 2,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://www.preventionweb.net/english/rss/feed.php?id=10',
          'division_id' => 3,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://www2c.cdc.gov/podcasts/createrss.asp?t=r&c=525',
          'division_id' => 3,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://www2c.cdc.gov/podcasts/createrss.asp?t=r&c=233',
          'division_id' => 4,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [ // 10
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://www2c.cdc.gov/podcasts/createrss.asp?t=r&c=179',
          'division_id' => 5,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://www.who.int/feeds/entity/hac/en/rss.xml',
          'division_id' => 5,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://www.who.int/feeds/entity/csr/disease/avian_influenza/en/rss.xml',
          'division_id' => 5,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://www.drj.com/industry/industry-hot-news.html?format=feed',
          'division_id' => 6,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://www.drj.com/articles/online-exclusive.html?format=feed',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [ // 15
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://ptwc.weather.gov/feeds/ptwc_rss_pacific.xml',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://ptwc.weather.gov/feeds/ptwc_rss_hawaii.xml',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://ptwc.weather.gov/feeds/ptwc_rss_caribe.xml',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => 9,
          'title' => '',
          'url' => 'http://www.gdacs.org/rss.aspx',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://createfeed.fivefilters.org/mergefeeds.php?url=ec.europa.eu%2Fecho%2Fecho-rss%2Fpress-releases_en%0Aec.europa.eu%2Fecho%2Fecho-rss%2Fnews_en',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [ // 20
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://createfeed.fivefilters.org/mergefeeds.php?url=www.disasternews.net%2Fnews%2Frss.php',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://createfeed.fivefilters.org/extract.php?url=www.thebci.org%2Findex.php%2Fabout%2Fnews-room%23%2Flatest_news&in_id_or_class=newsroom-list-header&url_contains=hidden-small',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://createfeed.fivefilters.org/extract.php?url=earthquake.usgs.gov%2Ffeatured.php%3Fyear%3Dall&in_id_or_class=feature-title',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://createfeed.fivefilters.org/extract.php?url=www.pdc.org%2Fnews-n-media%2Fpdc-in-the-news%2F&in_id_or_class=news_list_thumb',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://createfeed.fivefilters.org/mergefeeds.php?url=www.gdacs.org%2Frss.aspx%3Falertlevel%3Dorange%26country%3D%26eventtype%3D',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [ // 25
          'type' => 'IRDR',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://www.irdrinternational.org/irdr-publications/',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'IRDR',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://www.irdrinternational.org/other-publications/',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'IRDR',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://www.irdrinternational.org/co-sponsors-publications/',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => NULL,
          'title' => NULL,
          'url' => 'http://feeds.sciencedaily.com/sciencedaily/earth_climate/natural_disasters',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'EC',
          'article_type' => 1,
          'title' => 'European Commission - Health News',
          'url' => 'http://ec.europa.eu/echo/news_en',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [ // 30
          'type' => 'EC-PR',
          'article_type' => 4,
          'title' => 'European Commission - Press releases',
          'url' => 'http://ec.europa.eu/echo/aggregator/sources/8_en',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => 1,
          'title' => 'Homeland security today',
          'url' => 'http://www.hstoday.us/index.php?id=537&type=100&tx_ttnews%5Bcat%5D=242&cHash=562b079ac7d6c5e988a2b7598e4c78bb',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => 1,
          'title' => 'South Asian Disaster Knowledge Network',
          'url' => 'http://www.saarc-sadkn.org/RSS_Feed.aspx',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'RSS',
          'article_type' => 1,
          'title' => 'Telegraph Terrorism - UK',
          'url' => 'http://www.telegraph.co.uk/news/uknews/terrorism-in-the-uk/rss',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [
          'type' => 'GIAC',
          'article_type' => 2,
          'title' => 'Global Information Assurance Certification',
          'url' => 'http://www.giac.org/certified-professionals/directory/latest-papers',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
        [ // 35
          'type' => 'RSS',
          'article_type' => 3,
          'title' => 'Industrial Control Systems Security',
          'url' => 'https://ics.sans.org/blog/feed/',
          'division_id' => 0,
          'last_checked_item' => Carbon::createFromDate(2010, 1, 28),
          'deleted' => 0,
          'created_at' => Carbon::now(),
				  'updated_at' => Carbon::now()
        ],
      ];



      DB::table('scrape_sources')->insert($scrapeSources);
    }
}
