<?php

declare(strict_types=1);

namespace app\repository;

use app\models\AuthorSubscription;
use Exception;
use yii\db\ActiveRecord;

class AuthorSubscriptionRepository implements AuthorSubscriptionRepositoryInterface
{
    public function find(int $authorId, string $phone): AuthorSubscription|ActiveRecord|null
    {
        return AuthorSubscription::findOne(['author_id' => $authorId, 'phone' => $phone]);
    }

    /**
     * @throws Exception
     */
    public function subscribe(int $authorId, string $phone): bool
    {
        $model = new AuthorSubscription();
        $model->author_id = $authorId;
        $model->phone = $phone;

        return $model->save();
    }
}