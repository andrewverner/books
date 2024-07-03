<?php

declare(strict_types=1);

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

final class SubscribeAsset extends AssetBundle
{
    public $js = [
        'js/subscribe.js',
    ];

    public $depends = [
        JQueryAsset::class,
    ];
}
