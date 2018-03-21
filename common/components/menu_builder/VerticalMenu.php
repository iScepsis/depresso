<?php

namespace common\components\menu_builder;

use common\models\Categories;
use common\components\menu_builder\VerticalMenuAssets;
use yii\bootstrap\Html;
use yii\bootstrap\Widget;

class VerticalMenu extends Widget {

    public $data = null;
    //public $variant = 'success';

    private $items = [];

    public function init() {
       // $view = $this->getView();
        VerticalMenuAssets::register( $this->getView() );
        parent::init();
    }

    public function run():string
    {
        if (empty($this->data)) {
            $this->data = Categories::find()->where(['is_active' => 1])->orderBy('label')->asArray()->all();
        }

        $this->sortMenuLevels($this->data);
        return $this->buildHtml($this->items);
    }

    /**
     * Выстраиваем html-разметку меню
     * @param array $items - массив из которого будут построены блоки меню
     * @return string
     */
    /*protected function buildHtml(array $items){
        $html = "<div class='btn-group btn-group-vertical btn-group-vertical-full-width'>";
        foreach ($items as $item) {
            //TODO: make url
            $html .= Html::a($item['label'], ['categories/index', 'id' => $item['id']], [
                'role' => 'button',
                'class' => "btn btn-{$this->variant}"]);
        }
        $html .= "</div>";
        return $html;
    }*/

    protected function buildHtml(array $items):string
    {
        $html = '<div class="vertical-menu">';
        $html .= '<ul>';
        foreach ($items as $item) {
            if (empty($item['children'])) {
                $html .= $this->buildOneRangeHtml($item);
            } else {
                $html .= $this->buildTwoRangeHtml($item);
            }

            //TODO: make url
            /*$html .= '<li class="dropdown">';
            $html .= Html::a($item['label'], ['categories/index', 'id' => $item['id']], [
                'data-toggle' => 'dropdown',
            ]);
            $html .= '</li>';*/
        }
        $html .= '</ul>';
        $html .= "</div>";
        return $html;
    }

    protected function buildOneRangeHtml(array $e):string
    {
        $html = '<li class="dropdown">';
        $html .= Html::a($e['label'], ['categories/index', 'id' => $e['id']], [
            'data-toggle' => 'dropdown',
        ]);
        $html .= '</li>';
        return $html;
    }

    protected function buildTwoRangeHtml(array $e):string
    {
        $html = '<li class="dropdown">';
        $html .= Html::a($e['label'] . '<i class="icon-arrow"></i>', '#', ['data-toggle' => 'dropdown']);
            $html .= '<ul class="dropdown-menu">';

            foreach ($e['children'] as $child) {
                $html .= Html::a($child['label'], ['categories/index', 'id' => $child['id']], [
                    'data-toggle' => 'dropdown',
                ]);
            }
            $html .= '</ul>';
        $html .= '</li>';
        return $html;
    }

    protected function sortMenuLevels(array $elements):void
    {
        foreach ($elements as $e) {
            if (empty($e['parent_id'])) {
                if (empty($this->items[$e['id']])) {
                    $this->items[$e['id']] = $e;
                } else {
                    $this->items[$e['id']] = array_merge($this->items[$e['id']], $e);
                }
            } else {
                if (empty($this->items[$e['parent_id']])) $this->items[$e['parent_id']] = [];
                if (empty($this->items[$e['parent_id']]['children'])) $this->items[$e['parent_id']]['children'] = [];

                $this->items[$e['parent_id']]['children'][$e['id']] = $e;
            }
        }
    }
}