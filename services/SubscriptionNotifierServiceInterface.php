<?php

declare(strict_types=1);

namespace app\services;

use app\models\Author;
use app\models\Book;

interface SubscriptionNotifierServiceInterface
{
    public function notify(Author $author, Book $book): void;
}
