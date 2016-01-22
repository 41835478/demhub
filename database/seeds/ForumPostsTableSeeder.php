<?php

use Illuminate\Database\Seeder;
use Riari\Forum\Models\Thread;
use Carbon\Carbon as Carbon;

class ForumPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $threads = Thread::all();
        $thread_ids = [];
        foreach ($threads as $index => $content) {
            $thread_ids[$index] = $content->id;
        }

        $posts = [
            [
              'parent_thread' => $thread_ids[0],
              'author_id' => 1,
              'content' => 'There have been only two reported cases of Ebola in September. http://apps.who.int/ebola/current-situation/ebola-situation-report-23-september-2015',
    		  'created_at' => Carbon::now(),
    		  'updated_at' => Carbon::now()
            ],
            [
              'parent_thread' => $thread_ids[1],
              'author_id' => 1,
              'content' => 'MERS-CoV still active outside of the Middle East. Primarily transmitted within healthcare settings.  Link to assessment and causes of transmission. http://www.who.int/csr/disease/coronavirus_infections/risk-assessment-19june2015/en/',
    		  'created_at' => Carbon::now(),
    		  'updated_at' => Carbon::now()
            ],
            [
              'parent_thread' => $thread_ids[2],
              'author_id' => 1,
              'content' => 'New research on climate change says that although we may not reach the predicted temperatures, the findings are still not good. http://www.theguardian.com/environment/2013/may/19/climate-change-meltdown-unlikely-research ',
    		  'created_at' => Carbon::now(),
    		  'updated_at' => Carbon::now()
            ],
            [
              'parent_thread' => $thread_ids[3],
              'author_id' => 1,
              'content' => 'New "Snow Plow Theory" explains Tsunami behaviour caused by Splay Faults and provides a very interesting read. What new information does this provide that you may want to consider in your planning? http://earthquake.usgs.gov/research/splays/index.php',
    		  'created_at' => Carbon::now(),
    		  'updated_at' => Carbon::now()
            ],
            [
              'parent_thread' => $thread_ids[4],
              'author_id' => 1,
              'content' => 'Technology solutions that can impact EM workflows in all phases. If you could have only one, which would you choose? http://www.emergencymgmt.com/disaster/3-Emerging-Technologies-Emergency-Management.html',
    		  'created_at' => Carbon::now(),
    		  'updated_at' => Carbon::now()
            ],
            [
              'parent_thread' => $thread_ids[5],
              'author_id' => 1,
              'content' => 'What we have learned from last years devastating West Texas explosion. A new interactive map and report from the Center for Effective Government ID’s 4,600 industrial facilities in 6 states. Are your first responders prepared? http://www.foreffectivegov.org/chemical-hazards-your-backyard',
    		  'created_at' => Carbon::now(),
    		  'updated_at' => Carbon::now()
            ],
            [
              'parent_thread' => $thread_ids[6],
              'author_id' => 1,
              'content' => 'Hackers are targeting Health, Education, and Government sectors. What do you consider when preparing your networks security? http://www.technewsworld.com/story/82495.html',
    		  'created_at' => Carbon::now(),
    		  'updated_at' => Carbon::now()
            ],
            [
              'parent_thread' => $thread_ids[7],
              'author_id' => 1,
              'content' => 'Can we benefit from analyzing the civil security systems of other regions? The Swedish Institute of International Affairs (UI) evaluates the variety of strategies employed in regions throughout Europe to determine the affects on civilian safety. http://www.ui.se/eng/pages/analysis-of-civil-security-systems-in-europe',
    		  'created_at' => Carbon::now(),
    		  'updated_at' => Carbon::now()
            ],
            [
              'parent_thread' => $thread_ids[8],
              'author_id' => 1,
              'content' => 'LSE-led research addresses global conflicts and emergencies, gives a new concept of human security. Could this lead to a new paradigm shift in response to disaster? http://www.lse.ac.uk/researchAndExpertise/researchImpact/caseStudies/kaldor-new-european-response-conflict-disaster.aspx',
    		  'created_at' => Carbon::now(),
    		  'updated_at' => Carbon::now()
            ],
            [
              'parent_thread' => $thread_ids[9],
              'author_id' => 1,
              'content' => 'UK survey reveals that only 27% of small businesses have a BCP in place, but larger organizations take it very seriously. How can we get the message across to SME’s without them having to lose everything first? http://www.continuitycentral.com/index.php/news/business-continuity-news/509-survey-gives-a-snapshot-of-business-continuity-and-disaster-recovery-uptake-and-practices-in-uk-organizations',
    		  'created_at' => Carbon::now(),
    		  'updated_at' => Carbon::now()
            ],
            [
              'parent_thread' => $thread_ids[10],
              'author_id' => 1,
              'content' => 'Is your business factoring climate change as a risk? Making your business climate ready - a guide for BC professionals http://www.continuityforum.org/content/news/177616/ making-your-business-climate-ready-guide-business-continuity-professionals',
    		  'created_at' => Carbon::now(),
    		  'updated_at' => Carbon::now()
            ],
            [
              'parent_thread' => $thread_ids[11],
              'author_id' => 1,
              'content' => 'Here is a report on reshaping humanitarian efforts http://reliefweb.int/report/world/cracking-code-enhancing-emergency-response- resilience-complex-crises',
    		  'created_at' => Carbon::now(),
    		  'updated_at' => Carbon::now()
            ],
            [
              'parent_thread' => $thread_ids[12],
              'author_id' => 1,
              'content' => 'First Ebola, now flooding in Sierra Leone’s capital Freetown. What have other areas with similar geography done to help mitigate the health and security risks? http://reliefweb.int/report/sierra-leone/iom-responds-flash-flooding-freetown-sierra-leone',
    		  'created_at' => Carbon::now(),
    		  'updated_at' => Carbon::now()
            ],
            [
              'parent_thread' => $thread_ids[13],
              'author_id' => 1,
              'content' => 'Disaster Relief 2.0: The Future of Information Sharing in Humanitarian Emergencies. UN releases new report that analyzes the humanitarian, emerging volunteer, and technical communities in the aftermath of earthquake in Haiti. http://www.unfoundation.org/news- and-media/publications-and-speeches/disaster-relief-2-report.html?referrer=https:// www.google.ca/?referrer=http://www.unfoundation.org/news-and-media/publications- and-speeches/disaster-relief-2-report.html',
    		  'created_at' => Carbon::now(),
    		  'updated_at' => Carbon::now()
            ],
        ];

        DB::table('forum_posts')->insert($posts);
    }
}
