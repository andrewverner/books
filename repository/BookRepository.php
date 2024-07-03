<?php

declare(strict_types=1);

namespace app\repository;

use app\models\Book;
use Throwable;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\db\StaleObjectException;

class BookRepository implements BookRepositoryInterface
{
    public function find(int $id): Book|ActiveRecord|null
    {
        return Book::findOne($id);
    }

    /**
     * @throws Exception
     */
    public function flush(Book $model): bool
    {
        return $model->save();
    }

    /**
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function delete(int $id): bool
    {
        return (bool) $this->find(id: $id)->delete();
    }
}