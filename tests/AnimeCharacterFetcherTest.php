<?php

use Iim\td3\AnimeCharacterFetcher;
use PHPUnit\Framework\TestCase;

class AnimeCharacterFetcherTest extends TestCase
{
    private AnimeCharacterFetcher $fetcher;

    protected function setUp(): void
    {
        $this->fetcher = new AnimeCharacterFetcher();
    }

    public function testFetchCharacterNamesAndLinks()
    {
        $characterNamesAndLinks = $this->fetcher->fetchCharacterNamesAndLinks();

        // Assert that the returned value is an array
        $this->assertIsArray($characterNamesAndLinks);

        // Assert that the array is not empty
        $this->assertNotEmpty($characterNamesAndLinks);

        // Assert that each item in the array has the expected keys
        foreach ($characterNamesAndLinks as $character) {
            $this->assertArrayHasKey('name', $character);
            $this->assertArrayHasKey('link', $character);
        }
    }
}
