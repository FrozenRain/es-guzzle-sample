<?php
/**
 * Created by PhpStorm.
 * User: Demon
 * Date: 10/13/2015
 * Time: 10:51 PM
 */

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

require __DIR__ . '/vendor/autoload.php';

define('INDEX', "index-search-pk");

$es_client = new Client([
    'base_uri' => "http://localhost:9200/" . INDEX
]);

// Getting indexes info
echo $es_client->get("/_cat/indices")->getBody()->getContents();

// Making search query
$req_body = json_encode([
    'query' => [
        'match_all' => []
    ]
]);
// ...or simply $req_body = '{"query": { "match_all": {} }}';
/* @var $response Response */
$response = $es_client->post("/_search", ['body' => $req_body]);
// Print it "as is"
print $response->getBody();
// ...or decode (if it is JSON actually) to array (or object) and print
//print_r(json_decode($response->getBody(), true));