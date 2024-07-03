<?php

declare(strict_types=1);

namespace app\controllers\actions\book;

use app\models\BookSearch;
use yii\base\Action;

final class IndexAction extends Action
{
    public function run(): string
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search($this->controller->request->queryParams);

        return $this->controller->render(
            view: 'index',
            params: [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ],
        );
    }
}
