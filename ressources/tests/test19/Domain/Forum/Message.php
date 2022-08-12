<?php

declare(strict_types=1);

namespace Domain\Forum;

use Domain\User\User;

class Message
{
    private $content;
    private $author;

    public function __construct(User $author, string $content)
    {
        $this->author = $author;
        $this->content = $content;
    }
}
