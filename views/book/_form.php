<?php

use app\models\Author;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Book $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field(model: $model, attribute: 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field(model: $model, attribute: 'year')->textInput() ?>

    <?= $form->field(model: $model, attribute: 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field(model: $model, attribute: 'isbn')->textInput(['maxlength' => true]) ?>

    <?= Html::fileInput(name: 'main_page_image') ?>

    <?= $form->field(model: $model, attribute: 'authors')->checkboxList(items: Author::list()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>
