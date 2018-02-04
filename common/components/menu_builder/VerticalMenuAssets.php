<?php
namespace common\components\menu_builder;

use Yii;
use yii\web\AssetBundle;

class VerticalMenuAssets extends AssetBundle {
    public $sourcePath = null;

    public $css = [
        'css/vertical-menu.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public function init()
    {
        $this->sourcePath = Yii::getAlias("@common") . DIRECTORY_SEPARATOR . "components" . DIRECTORY_SEPARATOR . "menu_builder";
        parent::init();
    }

}