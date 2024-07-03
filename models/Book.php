<?php

declare(strict_types=1);

namespace app\models;

use app\events\BookEventListener;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\web\UploadedFile;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $title
 * @property int $year
 * @property string $description
 * @property string $isbn
 * @property string $main_page_image
 *
 * @property BookAuthor[] $bookAuthors
 * @property Author[] $authorsRelations
 */
class Book extends ActiveRecord
{
    public array $authors = [];

    public function init(): void
    {
        parent::init();
        $this->on(name: self::EVENT_AFTER_INSERT, handler: [BookEventListener::class, 'notify']);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%book}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['title', 'year', 'description', 'isbn'], 'required'],
            [['authors'], 'safe'],
            [['year'], 'integer'],
            [['description'], 'string'],
            [['title', 'isbn', 'main_page_image'], 'string', 'max' => 255],
            [['title', 'isbn', 'main_page_image'], 'string', 'max' => 255],
            [['authors'], 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'year' => 'Year',
            'description' => 'Description',
            'isbn' => 'Isbn',
            'authors' => 'Authors',
            'main_page_image' => 'Main Page Image',
        ];
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return ActiveQuery
     */
    public function getBookAuthors(): ActiveQuery
    {
        return $this->hasMany(BookAuthor::class, ['book_id' => 'id']);
    }

    /**
     * @throws InvalidConfigException
     */
    public function getAuthorsRelations(): ActiveQuery
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable(BookAuthor::tableName(), ['book_id' => 'id']);
    }



    public function upload(UploadedFile $file): bool
    {
        if ($this->validate()) {
            $path = 'uploads/' . md5($file->baseName) . '.' . $file->extension;

            $file->saveAs($path, false);
            $this->main_page_image = $path;

            return true;
        }

        return false;
    }

    /**
     * @throws Exception
     */
    public function saveAuthors(): void
    {
        foreach ($this->authors as $authorId) {
            $model = new BookAuthor();
            $model->author_id = $authorId;
            $model->book_id = $this->id;
            $model->save();
        }
    }

    public static function getYearsList(): array
    {
        return Book::find()->select(['year'])->orderBy(['year' => SORT_ASC])->distinct()->column();
    }
}
