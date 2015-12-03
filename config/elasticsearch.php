<?php use Monolog\Logger;

return array(
    'hosts' => array(
                    'localhost:9200' // default
                    ),
    'logPath' => storage_path() . '/logs/elasticsearch.log', // default
    'logLevel' => Logger::INFO // default
);
