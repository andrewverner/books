<?php

declare(strict_types=1);

namespace app\controllers;

use app\controllers\actions\book\CreateAction;
use app\controllers\actions\book\DeleteAction;
use app\controllers\actions\book\IndexAction;
use app\controllers\actions\book\ReportAction;
use app\controllers\actions\book\UpdateAction;
use app\controllers\actions\book\ViewAction;
use app\models\Book;
use app\models\BookSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * BookController implements the CRUD actions for Book model.
 */
final class BookController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors(): array
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['create', 'update', 'delete'],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['create', 'update', 'delete'],
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    public function actions(): array
    {
        return [
            'index' => IndexAction::class,
            'view' => ViewAction::class,
            'create' => CreateAction::class,
            'update' => UpdateAction::class,
            'delete' => DeleteAction::class,
            'report' => ReportAction::class,
        ];
    }

    public function actionReport(): string
    {
        return $this->render(view: 'report', params: [
            ''
        ]);
    }
}
