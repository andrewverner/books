<?php

declare(strict_types=1);

namespace app\models;

use yii\data\ActiveDataProvider;

class BookSearch extends Book
{
    public $title;

    public $year;

    public $isbn;

    public function rules(): array
    {
        return [
            [['title', 'year', 'isbn'], 'safe'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = Book::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => ['title', 'year'],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $this->load(data: $params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(condition: ['like', 'title', $this->title])
            ->andFilterWhere(condition: ['year' => $this->year])
            ->andFilterWhere(condition: ['isbn' => $this->isbn]);

        return $dataProvider;
    }
}