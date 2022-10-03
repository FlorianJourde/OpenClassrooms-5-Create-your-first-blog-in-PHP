<?php

namespace Application\Model;

class Comment
{
    public int $identifier;
    public int $user_id;
    public int $post_id;
    public string $comment;
    public string $creationDate;
    public string $username;
    public bool $status;
}
