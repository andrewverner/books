<?php

declare(strict_types=1);

namespace app\controllers\actions\book;

use app\models\Author;
use app\models\Book;
use app\models\BookAuthor;
use yii\base\Action;
use yii\data\ArrayDataProvider;

class ReportAction extends Action
{
    public function run(int $year = null)
    {
        if ($year === null) {
            $year = date('Y');
        }

        $data = Book::find()
            ->alias(alias: 'b')
            ->select(['a.name AS author_name', 'COUNT(b.id) AS book_count'])
            ->innerJoin(BookAuthor::tableName() . ' AS ba', 'ba.book_id = b.id')
            ->innerJoin(Author::tableName() . ' AS a', 'a.id = ba.author_id')
            ->where(['b.year' => $year])
            ->groupBy(['ba.author_id'])
            ->orderBy(['book_count' => SORT_DESC])
            ->limit(10)
            ->asArray()
            ->all()
        ;

        return $this->controller->render(
            view: 'report',
            params: [
                'dataProvider' => new ArrayDataProvider([
                    'allModels' => $data,
                    'pagination' => [
                        'pageSize' => 10,
                    ],
                ]),
            ],
        );
    }
}
