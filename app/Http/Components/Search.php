<?php namespace App\Http\Components;

use Illuminate\Http\Request;
use Config;
use Es;

/**
 * Global search helper used with ElasticSearch
 */
class Search
{
  /**
  * Perform elasticsearch query and return json
  * @param  array   $filter
  * @param  string  $query
  * @param  integer $size
  * @param  integer $page
  * @return JSON
  */
  public static function queryArticlesByDivision($divID, $page = 0, $size = 30, $query = ["match_all" => []]) {
    return self::queryArticles($page, $size, $query, $divID);
  }

  /**
  * Perform elasticsearch query on Articles
  * @param  array   $filter
  * @param  string  $query
  * @param  integer $size
  * @param  integer $page
  * @return JSON
  */
  public static function queryArticles($page = 0, $size = 30, $query = ["match_all" => []], $divID = NULL) {
      $filter = [
        'and' => [
            ['bool' => [
              'should' => [
                // the language fields should either be the current locale
                ['term' => [ 'language' => Config::get('app.locale') ]],
                // or it should be NULL, which by default is expected to be english
                ['missing' => [ 'field' => 'language' ]]
              ]
            ]],
            ['term' => ['deleted' => 0]],
        ]
      ];
      if ($divID != NULL) {
          // Add the division id as one of the "AND" filters
          array_push($filter['and'],
              ['term' => ['divisions' => $divID]]
          );
      }

      $sort = [
          'publish_date' => [
              'order' => 'desc',
              'missing' => PHP_INT_MAX -1, // fixes json_decode() error
          ]
      ];

    $params = [
        'index' => 'news',
        'type' => 'articles',
        'size' => $size,
        'from' => $size * $page,
        'body' => [
            'query' => [
                'filtered' => [
                    'filter' => $filter,
                    'query' => $query
                ]
            ],
            'sort' => $sort
        ]
    ];
    $results = Es::search($params);
    return $results['hits'];
  }

  /**
  * Perform elasticsearch query on Articles
  * @param  array   $filter
  * @param  string  $query
  * @param  integer $size
  * @param  integer $page
  * @return JSON
  */
  public static function queryUsers($page = 0, $size = 30, $query = ["match_all" => []], $divID = NULL) {
      $filter = array();
      if ($divID != NULL) {
          // Add the division id as one of the "AND" filters
          $filter['term'] = ['division' => $divID];
      }

      $params = [
        'index' => 'access',
        'type' => 'users',
        'size' => $size,
        'from' => $size * $page,
        'body' => [
            'query' => [
                'filtered' => [
                    'filter' => $filter,
                    'query' => $query
                ]
            ]
        ]
    ];
    $results = Es::search($params);
    return $results['hits'];
  }

  /**
  * Perform elasticsearch query on Articles
  * @param  array   $filter
  * @param  string  $query
  * @param  integer $size
  * @param  integer $page
  * @return JSON
  */
  public static function queryPublications($page = 0, $size = 30, $query = ["match_all" => []], $divID = NULL) {
      $filter = [
        'and' => [
            ['term' => ['deleted' => 0]],
            ['term' => ['visibility' => 1]],
        ]
      ];

      if ($divID != NULL) {
          // Add the division id as one of the "AND" filters
          array_push($filter['and'],
              ['term' => ['divisions' => $divID]]
          );
      }

      $sort = [
          'id' => [
              'order' => 'desc',
              'missing' => PHP_INT_MAX -1, // fixes json_decode() error
          ]
      ];
      $params = [
        'index' => 'info',
        'type' => 'publications',
        'size' => $size,
        'from' => $size * $page,
        'body' => [
            'query' => [
                'filtered' => [
                    'filter' => $filter,
                    'query' => $query
                ]
            ],
            'sort' => $sort
          ]
        ];

      $results = Es::search($params);
      return $results['hits'];
  }

  /**
  * Perform elasticsearch query on Articles
  * @param  array   $filter
  * @param  string  $query
  * @param  integer $size
  * @param  integer $page
  * @return JSON
  */
  public static function queryDiscussions($page = 0, $size = 30, $query = ["match_all" => []], $divID = NULL) {
      $filter = [
        // 'and' => [
        //     ['bool' => [
        //       'should' => [
        //         // the language fields should either be the current locale
        //         ['term' => [ 'language' => Config::get('app.locale') ]],
        //         // or it should be NULL, which by default is expected to be english
        //         ['missing' => [ 'field' => 'language' ]]
        //       ]
        //     ]],
        //     ['term' => ['deleted' => 0]],
        // ]
        ['term' => ['deleted' => 0]]
      ];
      if ($divID != NULL) {
          // Add the division id as one of the "AND" filters
          array_push($filter['and'],
              ['term' => ['divisions' => $divID]]
          );
      }

      $sort = [
          'updated_at' => [
              'order' => 'desc',
              'missing' => PHP_INT_MAX -1, // fixes json_decode() error
          ]
      ];

    $params = [
        'index' => 'discussions',
        'type' => 'threads',
        'size' => $size,
        'from' => $size * $page,
        'body' => [
            'query' => [
                'filtered' => [
                    'filter' => $filter,
                    'query' => $query
                ]
            ],
            'sort' => $sort
        ]
    ];
    $results = Es::search($params);

    return $results['hits'];
  }

  /**
  * Perform elasticsearch query on Articles
  * @param  array   $filter
  * @param  string  $query
  * @param  integer $size
  * @param  integer $page
  * @return JSON
  */
  public static function queryResources($page = 0, $size = 30, $query = ["match_all" => []], $divID = NULL) {
    $filter = [];
      if ($divID != NULL) {
          $filter['and'] = ['term' => ['divisions' => $divID]];
      }
      $params = [
        'index' => 'info',
        'type' => 'resources',
        'size' => $size,
        'from' => $size * $page,
        'body' => [
            'query' => [
                'filtered' => [
                    'filter' => $filter,
                    'query' => $query
                ]
            ]
        ]
    ];
    $results = Es::search($params);
    return $results['hits'];
  }

  /**
  * Perform elasticsearch query on Articles
  * @param  array   $filter
  * @param  string  $query
  * @param  integer $size
  * @param  integer $page
  * @return JSON
  */
  public static function formatElasticSearchToArray($results) {
        $formattedResults = [];
        foreach ($results as $item)
          array_push($formattedResults, $item['_source']);
        return $formattedResults;
    }
}
