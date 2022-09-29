<?php

namespace Application\Model;

class Comment
{
    public int $identifier;
    public int $user_id;
    public string $creationDate;
    public string $comment;
    public string $post;
    public string $username;
}
