<?php

use app\models\Book;
use app\widgets\BookAuthorsWidget;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Book $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!Yii::$app->user->isGuest): ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'year',
            'description:ntext',
            'isbn',
            [
                'label' => 'Authors',
                'format' => 'raw',
                'value' => function(Book $model) {
                    return BookAuthorsWidget::widget(['book' => $model]);
                }
            ],
            [
                'label' => 'Main page image',
                'format' => 'raw',
                'value' => function(Book $model) {
                    return Html::img('/' . $model->main_page_image, ['width' => '200px']);
                }
            ],
        ],
    ]) ?>

</div>
