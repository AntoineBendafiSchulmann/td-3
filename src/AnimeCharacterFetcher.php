<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class AnimeCharacterFetcher
{
    private $client;
    private $crawler;

    public function __construct()
    {
        $this->client = new Client();
        $this->crawler = new Crawler();
    }

    public function fetchCharacterNamesAndLinks()
    {
        $response = $this->client->get("https://www.nautiljon.com/animes/naruto+shippuden/personnages.html");
        $this->crawler->addHtmlContent($response->getBody()->getContents());

        $characterNamesAndLinks = $this->crawler->filter('a.tooltip')->each(function (Crawler $node) {
            return [
                'name' => $node->attr('title'),
                'link' => "https://www.nautiljon.com" . $node->attr('href'),
            ];
        });

        return $characterNamesAndLinks;
    }
}
