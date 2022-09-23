<?php

namespace Application\Model;

require_once __ROOT__ . '/src/lib/database.php';

class Post
{
    public string $title;
    public string $frenchCreationDate;
    public string $content;
    public string $identifier;
}
