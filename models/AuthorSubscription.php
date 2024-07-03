<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "author_subscription".
 *
 * @property int $id
 * @property int $author_id
 * @property string $phone
 *
 * @property Author $author
 */
final class AuthorSubscription extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%author_subscription}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['author_id', 'phone'], 'required'],
            [['author_id'], 'integer'],
            [['phone'], 'string', 'max' => 11],
            [['phone'], 'match', 'pattern' => '/^[\d]{11}$/'],
            [['author_id', 'phone'], 'unique', 'targetAttribute' => ['author_id', 'phone']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'phone' => 'Phone',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return ActiveQuery
     */
    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

    public function beforeValidate(): bool
    {
        $this->phone = preg_replace(pattern: '[\D+]', replacement: '', subject:  $this->phone);

        return parent::beforeValidate();
    }
}
