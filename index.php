<?php
require __DIR__ . '/vendor/autoload.php';

use Goutte\Client;

$client = new Client();

//Make request to a  website
$crawler = $client->request('GET', 'http://www.symfony.com/blog/');

$guzzleClient = new \GuzzleHttp\Client(array(
    'curl' => array(
        CURLOPT_TIMEOUT => 60,
    ),
));

$client->setClient($guzzleClient);

// Click on the "Security Advisories" link
$link = $crawler->selectLink('Security Advisories')->link();
$crawler = $client->click($link);


//// Get the latest post in this category and display the titles
$crawler->filter('h2 > a')->each(function ($node) {
    print $node->text()."\n";
});


//fill in form
//$crawler = $client->request('GET', 'http://github.com/');
//$crawler = $client->click($crawler->selectLink('Sign in')->link());
//$form = $crawler->selectButton('Sign in')->form();
//$crawler = $client->submit($form, array('login' => 'fabpot', 'password' => 'xxxxxx'));
//$crawler->filter('.flash-error')->each(function ($node) {
//    print $node->text()."\n";
//});
