<?php

declare(strict_types=1);

namespace app\events;

use app\models\Book;
use app\services\SmsPilot\SMSPilotClient;
use app\services\SubscriptionNotifierService;
use yii\base\Event;
use yii\base\InvalidConfigException;

final readonly class BookEventListener
{
    /**
     * @throws InvalidConfigException
     */
    public static function notify(Event $event): void
    {
        $book = $event->sender;

        assert(assertion: $book instanceof Book);

        $service = new SubscriptionNotifierService(new SMSPilotClient());

        foreach ($book->getAuthors()->all() as $author) {
            $service->notify(author: $author, book: $book);
        }
    }
}
