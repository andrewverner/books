<?php

declare(strict_types=1);

namespace app\services;

use app\models\Author;
use app\models\Book;
use app\services\SmsPilot\SMSClientInterface;

readonly class SubscriptionNotifierService implements SubscriptionNotifierServiceInterface
{
    public function __construct(
        private SMSClientInterface $SMSClient,
    ) {
    }

    public function notify(Author $author, Book $book): void
    {
        foreach ($author->subscriptions as $subscription) {
            $this->SMSClient->send(
                phone: $subscription->phone,
                message: sprintf(
                    'A new book %s by %s has been published',
                    $book->title,
                    $author->name,
                ),
            );
        }
    }
}
