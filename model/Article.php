<?php

declare(strict_types=1);

class Article
{
    public int $id;
    public string $title;
    public ?string $description;
    public ?string $publishDate;
    public ?string $author;
    public ?string $imageLink;

    public function __construct(int $id, string $title, ?string $description, ?string $publishDate, ?string $author, ?string $imageLink)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->publishDate = $publishDate;
        $this->author = $author;
        $this->imageLink = $imageLink;
    }

    public function formatPublishDate($format = 'DD-MM-YYYY')
    {
        // Return the date in the required format
        $newDate = date("d-m-Y", strtotime($this->publishDate)); 
        return $newDate;
    }
}

