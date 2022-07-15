<?php

namespace App\Domain\Messenger {
    class Message
    {}
}

namespace {
    use App\Domain\Messenger\Message;

    $messengerMessage = new Message;
    var_dump($messengerMessage::class);
}
