<?php

declare(strict_types=1);

namespace app\controllers\actions\book;

use app\repository\BookRepositoryInterface;
use yii\base\Action;
use yii\db\Exception;
use yii\web\Response;
use yii\web\UploadedFile;

final class UpdateAction extends Action
{
    public function __construct(
        $id,
        $controller,
        private readonly BookRepositoryInterface $bookRepository,
        $config = []
    ) {
        parent::__construct($id, $controller, $config);
    }

    /**
     * @throws Exception
     */
    public function run(int $id): Response|string
    {
        $model = $this->bookRepository->find(id: $id);

        if (
            $this->controller->request->isPost
            && $model->load(data: $this->controller->request->post())
        ) {
            $image = UploadedFile::getInstanceByName('main_page_image');

            if ($image !== null) {
                $model->upload(file: $image);
            }

            $this->bookRepository->flush(model: $model);
            $model->saveAuthors();

            return $this->controller->redirect(url: ['view', 'id' => $model->id]);
        }

        return $this->controller->render(
            view: 'update',
            params: [
                'model' => $model,
            ],
        );
    }
}
