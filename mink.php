<?php
require __DIR__.'/vendor/autoload.php';

use Behat\Mink\Driver\GoutteDriver;
use Behat\Mink\Driver\Selenium2Driver;
use Behat\Mink\Session;

//$driver = new GoutteDriver();
$driver = new Selenium2Driver();
$session = new Session($driver);
$session->start();

$session->visit('https://wikileaks.org/');
echo "Status code: ".$session->getStatusCode()." \n";
//Document Element
$page = $session->getPage();
$header = $page->find('css', '.text .title');
echo "The header of the featured article is: ". $header->getText()."\n";

echo "The link for the news it's ".$page->findLink('News')->getAttribute('href')."\n";