<?php

// comment out the following two lines when deployed to production
use app\events\BookEventListener;
use app\repository\AuthorSubscriptionRepository;
use app\repository\AuthorSubscriptionRepositoryInterface;
use app\repository\BookRepository;
use app\repository\BookRepositoryInterface;
use app\services\SmsPilot\SMSPilotClient;

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

Yii::$container->set(class: BookRepositoryInterface::class, definition: BookRepository::class);
Yii::$container->set(
    class: AuthorSubscriptionRepositoryInterface::class,
    definition: AuthorSubscriptionRepository::class,
);

(new yii\web\Application($config))->run();
