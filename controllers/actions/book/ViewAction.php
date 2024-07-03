<?php

declare(strict_types=1);

namespace app\controllers\actions\book;

use app\repository\BookRepositoryInterface;
use yii\base\Action;

final class ViewAction extends Action
{
    public function __construct(
        $id,
        $controller,
        private readonly BookRepositoryInterface $bookRepository,
        $config = []
    )
    {
        parent::__construct($id, $controller, $config);
    }

    public function run(int $id): string
    {
        return $this->controller->render(
            view: 'view',
            params: [
                'model' => $this->bookRepository->find(id: $id),
            ],
        );
    }
}
