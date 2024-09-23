<?php

declare(strict_types=1);

namespace Phideo;

use SimpleXMLElement;

final class Processor
{
    private array $tags;
    private array $genres;
    private array $movieName;
    private SimpleXMLElement $file;
    private array $xmlAsArray;

    /**
     * @throws \Exception
     */
    public function __construct(private readonly string $fileName)
    {
        $this->openFile();

        $this->scrapeMovieName();

        $this->scrapeTags();

        $this->scrapeGenres();

        $sXml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8" standalone="yes"?><movie></movie>');

        $this->toXml($this->xmlAsArray, $sXml);
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function getTitle(): array
    {
        return $this->movieName;
    }

    public function getGenres(): array
    {
        return $this->genres;
    }

    public function echoDetails(): void
    {
        echo 'Movie Title(s): ' . PHP_EOL;
        foreach ($this->movieName as $title) {
            echo '  ' . $title . PHP_EOL;
        }

        echo 'Tag(s): ' . PHP_EOL;
        foreach ($this->tags as $tag) {
            echo '  ' . $tag . PHP_EOL;
        }

        echo PHP_EOL;
    }

    /**
     * @throws \Exception
     */
    private function openFile(): void
    {
        $this->file = new SimpleXMLElement($this->fileName, 0, true);
        $this->xmlAsArray = json_decode(json_encode($this->file), true);
    }

    private function scrapeMovieName(): void
    {
        $names = $this->file->xpath('/movie/title');
        foreach ($names as $name) {
            $this->movieName[] = (string) $name;
        }
    }

    private function scrapeTags(): void
    {
        $tags = $this->file->xpath('/movie/tag');
        foreach ($tags as $tag) {
            $this->tags[] = (string) $tag;
        }
    }

    private function scrapeGenres(): void
    {
        $genres = $this->file->xpath('/movie/genre');
        foreach ($genres as $genre) {
            $this->genres[] = (string) $genre;
        }
    }

    private function toXml(array $data, SimpleXMLElement &$xmlData): void
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if (is_numeric(array_key_first($value)) === true && is_array($value[array_key_first($value)]) === false) {
                    // If the key is numeric, repeat the element with the parent tag name
                    foreach ($value as $val) {
                        $xmlData->addChild($key, htmlspecialchars($val));
                    }
                } elseif (is_numeric(array_key_first($value)) === true) {
                    // Create a new child and recurse
                    foreach ($value as $val) {
                        $subnode = $xmlData->addChild($key);
                        $this->toXml($val, $subnode);
                    }
                } else {
                    // Create a new child and recurse
                    $subnode = $xmlData->addChild($key);
                    $this->toXml($value, $subnode);
                }
            } elseif (is_numeric($key)) {
                // Repeat the element with the parent tag name
                $xmlData->addChild($xmlData->getName(), htmlspecialchars($value));
            } else {
                // Add it as a child
                $xmlData->addChild($key, htmlspecialchars($value));
            }
        }
    }
}
