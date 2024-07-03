<?php

declare(strict_types=1);

namespace app\widgets;

use app\models\Book;
use yii\base\Widget;

class BookAuthorsWidget extends Widget
{
    public Book $book;

    public function run(): string
    {
        return $this->render(
            view: '@app/views/widgets/book_authors',
            params: ['authors' => $this->book->authorsRelations],
        );
    }
}
