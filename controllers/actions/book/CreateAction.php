<?php

declare(strict_types=1);

namespace app\controllers\actions\book;

use app\models\Book;
use app\models\CreateBookForm;
use app\repository\BookRepositoryInterface;
use yii\base\Action;
use yii\web\Response;
use yii\web\UploadedFile;

final class CreateAction extends Action
{
    public function __construct(
        $id,
        $controller,
        private readonly BookRepositoryInterface $bookRepository,
        $config = []
    ) {
        parent::__construct($id, $controller, $config);
    }

    public function run(): Response|string
    {
        $model = new Book();

        if (
            $this->controller->request->isPost
            && $model->load(data: $this->controller->request->post())
        ) {
            $image = UploadedFile::getInstanceByName('main_page_image');

            if (
                $model->upload(file: $image)
                && $this->bookRepository->flush(model: $model)
            ) {
                $model->saveAuthors();

                return $this->controller->redirect(url: ['view', 'id' => $model->id]);
            }
        }

        $model->loadDefaultValues();

        return $this->controller->render(
            view: 'create',
            params: [
                'model' => $model,
            ],
        );
    }
}
