<?php

declare(strict_types=1);

namespace app\controllers\actions\author;

use app\repository\AuthorSubscriptionRepositoryInterface;
use Exception;
use Yii;
use yii\base\Action;
use yii\web\Response;

final class SubscribeAction extends Action
{
    public function __construct(
        $id,
        $controller,
        private readonly AuthorSubscriptionRepositoryInterface $subscriptionRepository,
        $config = []
    ) {
        parent::__construct($id, $controller, $config);
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        $authorId = (int) Yii::$app->request->post(name: 'id');
        $phone = Yii::$app->request->post(name: 'phone');

        if ($this->subscriptionRepository->find(authorId: $authorId, phone: $phone)) {
            throw new Exception(message: 'Conflict', code: 409);
        }

        if (!$this->subscriptionRepository->subscribe(authorId: $authorId, phone: $phone)) {
            throw new Exception(message: 'Internal error', code: 500);
        }
    }
}
