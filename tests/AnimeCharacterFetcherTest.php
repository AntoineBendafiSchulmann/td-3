<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../build/AnimeCharacterFetcher.php';

class AnimeCharacterFetcherTest extends TestCase
{
    private $fetcher;

    protected function setUp(): void
    {
        $this->fetcher = new AnimeCharacterFetcher();
    }

    public function testFetchCharacterNamesAndLinks()
    {
        $namesAndLinks = $this->fetcher->fetchCharacterNamesAndLinks();

        // Make sure we got an array
        $this->assertIsArray($namesAndLinks);

        // Make sure the array isn't empty
        $this->assertNotEmpty($namesAndLinks);

        // Check a few items in the array to make sure they're formatted correctly
        foreach ($namesAndLinks as $item) {
            $this->assertIsArray($item);
            $this->assertArrayHasKey('name', $item);
            $this->assertArrayHasKey('link', $item);
        }
    }
}
