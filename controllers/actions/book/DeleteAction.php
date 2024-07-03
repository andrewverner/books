<?php

declare(strict_types=1);

namespace app\controllers\actions\book;

use app\repository\BookRepositoryInterface;
use yii\base\Action;
use yii\web\Response;

final class DeleteAction extends Action
{
    public function __construct(
        $id,
        $controller,
        private readonly BookRepositoryInterface $bookRepository,
        $config = []
    ) {
        parent::__construct($id, $controller, $config);
    }

    public function run(int $id): Response
    {
        $this->bookRepository->delete(id: $id);

        return $this->controller->redirect(['index']);
    }
}
