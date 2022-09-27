<?php

namespace Application\Model;

require_once __ROOT__ . '/src/lib/database.php';

class Post
{
    public int $identifier;
    public string $title;
    public string $author;
    public string $frenchCreationDate;
    public string $content;
}
