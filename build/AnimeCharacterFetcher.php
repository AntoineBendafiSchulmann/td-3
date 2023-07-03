<?php

namespace Iim\td3;

require_once __DIR__ . '/../vendor/autoload.php';


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
        $response = $this->client->get("https://naruto.fandom.com/fr/wiki/Cat%C3%A9gorie:Personnages");
        $this->crawler->addHtmlContent($response->getBody()->getContents());

        $characterNamesAndLinks = $this->crawler->filter('a.category-page__member-link')->each(function (Crawler $node) {
            return [
                'name' => $node->attr('title'),
                'link' => "https://naruto.fandom.com" . $node->attr('href'),
            ];
        });

        return $characterNamesAndLinks;
    }
}

// Crée une instance de la classe AnimeCharacterFetcher
$fetcher = new AnimeCharacterFetcher();

// Récupère les noms et liens des personnages
$characterNamesAndLinks = $fetcher->fetchCharacterNamesAndLinks();

// Imprime les noms et liens des personnages
foreach ($characterNamesAndLinks as $character) {
    echo 'Name: ' . $character['name'] . PHP_EOL;
    echo 'Link: ' . $character['link'] . PHP_EOL;
    echo '---------------------' . PHP_EOL;
}
