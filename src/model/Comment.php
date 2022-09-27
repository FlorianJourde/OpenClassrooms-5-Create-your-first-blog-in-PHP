<?php

namespace Application\Model;

require_once __ROOT__ . '/src/lib/database.php';

class Comment
{
    public int $identifier;
    public string $author;
    public string $frenchCreationDate;
    public string $comment;
    public string $post;
}
