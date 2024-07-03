<?php

declare(strict_types=1);

namespace app\repository;

use app\models\AuthorSubscription;
use yii\db\ActiveRecord;

interface AuthorSubscriptionRepositoryInterface
{
    public function find(int $authorId, string $phone): AuthorSubscription|ActiveRecord|null;

    public function subscribe(int $authorId, string $phone): bool;
}