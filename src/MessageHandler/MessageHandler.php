<?php

namespace App\MessageHandler;

use App\Entity\Message;
use App\Repository\MessageRepository;

class MessageHandler 
{
    private $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function __invoke(Message $message)
    {
        dump(($message));
        exit;
    }
}