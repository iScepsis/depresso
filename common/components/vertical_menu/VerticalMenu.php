<?php

/**
 * Вертикальное меню.
 * @see https://codepen.io/pedronauck/pen/fcaDw
 */

namespace common\components\vertical_menu;

use common\models\Categories;
use common\components\vertical_menu\VerticalMenuAssets;
use common\models\Posts;
use Yii;
use yii\bootstrap\Html;
use yii\bootstrap\Widget;

class VerticalMenu extends Widget {

    public $data = null;
    public $activeCategory = null;

    private $items = [];


    public function init() {
        VerticalMenuAssets::register( $this->getView() );
        parent::init();
    }

    public function run():string
    {
        if (empty($this->data)) {
            $this->data = Categories::find()->where(['is_active' => 1])->orderBy('label')->asArray()->all();
        }

        if (empty($this->activeCategory)) {
            $this->getActiveCategoryId();
        }

        $this->sortMenuLevels($this->data);
        return  $this->buildHtml($this->items);
    }


    /**
     * Выстраиваем html-разметку меню
     * @param array $items - массив из которого будут построены блоки меню
     * @return string - html разметка
     */
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

        }
        $html .= '</ul>';
        $html .= "</div>";
        return $html;
    }

    /**
     * Строим элемент меню для категории, которая НЕ ИМЕЕТ подкатегории
     * @param array $e - элемент меню (данные модели common\models\Categories приведенные к массиву)
     * @return string - html разметка
     */
    protected function buildOneRangeHtml(array $e):string
    {
        if ($e['id'] == $this->activeCategory) {
            $html = '<li class="vm_dropdown vm-active">';
        } else {
            $html = '<li class="vm_dropdown">';
        }
        $html .= Html::a($e['label'], ['categories/index', 'id' => $e['id']], [
            'data-toggle' => 'vm_dropdown',
        ]);
        $html .= '</li>';
        return $html;
    }

    /**
     * Строим элемент меню для категории, которая ИМЕЕТ подкатегории
     * @param array $e - элемент меню (данные модели common\models\Categories приведенные к массиву)
     * @return string - html разметка
     */
    protected function buildTwoRangeHtml(array $e):string
    {
        $html = '<li class="vm_dropdown">';
        $html .= Html::a($e['label'] . '<i class="icon-arrow"></i>', '#', ['data-toggle' => 'vm_dropdown']);
            $html .= '<ul class="vm_dropdown-menu">';

            foreach ($e['children'] as $child) {
                if ($child['id'] == $this->activeCategory) {
                    $html .= '<li class="vm-active">';
                } else {
                    $html .= '<li>';
                }

                $html .= Html::a($child['label'], ['categories/index', 'id' => $child['id']], [
                    'data-toggle' => 'vm_dropdown',
                ]);
                $html .= '</li>';
            }
            $html .= '</ul>';
        $html .= '</li>';
        return $html;
    }

    /**
     * Помещаем подкатегории в категории и выдаем массив.
     * @param array $elements
     */
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

    /**
     * Получить текующую категорию для страницы
     */
    protected function getActiveCategoryId():void
    {
        $controllerName = Yii::$app->controller->id;
        switch ($controllerName) {
            case 'categories':
                $this->activeCategory = Yii::$app->request->get('id');
                break;
            case 'posts':
                $this->activeCategory = Posts::find()
                    ->select(['fid_category'])
                    ->where(['id' => Yii::$app->request->get('id')])
                    ->scalar();
                break;
        }
    }
}