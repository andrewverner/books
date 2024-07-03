<?php

declare(strict_types=1);

namespace app\repository;

use app\models\Book;
use yii\db\ActiveRecord;

interface BookRepositoryInterface
{
    public function find(int $id): Book|ActiveRecord|null;

    public function flush(Book $model): bool;

    public function delete(int $id): bool;
}
