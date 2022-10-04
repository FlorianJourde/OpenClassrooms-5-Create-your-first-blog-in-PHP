<?php

namespace Application\Model;

class Comment
{
    public int $identifier;
    public int $userId;
    public int $postId;
    public string $comment;
    public string $creationDate;
    public string $username;
    public bool $status;
}
