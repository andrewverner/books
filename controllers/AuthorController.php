<?php

declare(strict_types=1);

namespace app\controllers;

use app\controllers\actions\author\SubscribeAction;
use yii\filters\VerbFilter;
use yii\web\Controller;

final class AuthorController extends Controller
{
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'subscribe' => ['POST', 'AJAX'],
                ],
            ],
        ];
    }

    public function actions(): array
    {
        return [
            'subscribe' => SubscribeAction::class,
        ];
    }
}
