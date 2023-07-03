<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class AnimeCharacterFetcher
{
    private Client $client;
    private Crawler $crawler;

    public function __construct()
    {
        $this->client = new Client();
        $this->crawler = new Crawler();
    }

    /**
     * @return array<array<string>>
     */
    public function fetchCharacterNamesAndLinks(): array
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
