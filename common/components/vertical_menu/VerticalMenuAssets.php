<?php
namespace common\components\vertical_menu;

use Yii;
use yii\web\AssetBundle;

class VerticalMenuAssets extends AssetBundle {
    public $sourcePath = null;

    public $css = [
        'css/vertical_menu.css',
    ];
    public $js = [
        'js/vertical_menu.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public function init()
    {
        $this->sourcePath = Yii::getAlias("@common") . DIRECTORY_SEPARATOR . "components" . DIRECTORY_SEPARATOR . "vertical_menu";
        parent::init();
    }

}