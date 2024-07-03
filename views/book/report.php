<?php

use app\models\Book;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var yii\data\ArrayDataProvider $dataProvider */

$this->title = 'Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <ul>
            <?php foreach (Book::getYearsList() as $year): ?>
            <li><?= Html::a($year, Url::to(['book/report', 'year' => $year])) ?></li>
            <?php endforeach; ?>
        </ul>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'author_name',
            'book_count',
        ],
    ]); ?>

</div>
