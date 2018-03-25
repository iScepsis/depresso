<?php
namespace common\components\comments;

use Yii;
use yii\web\AssetBundle;

class CommentsAssets extends AssetBundle {
    public $sourcePath = null;

    public $css = [
        'css/comments.css',
    ];
    public $js = [
        'js/comments.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public function init()
    {
        $this->sourcePath = Yii::getAlias("@common") . DIRECTORY_SEPARATOR . "components" . DIRECTORY_SEPARATOR . "comments";
        parent::init();
    }

}