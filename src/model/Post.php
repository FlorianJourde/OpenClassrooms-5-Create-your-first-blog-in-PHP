<?php

namespace Application\Model;

class Post
{
    public int $identifier;
    public int $user_id;
    public string $title;
    public string $creationDate;
    public string $content;
    public string $username;
}
