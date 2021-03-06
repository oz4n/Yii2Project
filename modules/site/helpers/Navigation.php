<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\site\helpers;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\modules\site\helpers\Dropdown;
use yii\bootstrap\Nav;
use app\modules\site\helpers\IMachTagHtml;
use app\modules\site\models\MenuModel;
use app\modules\site\Site;

/**
 * Description of Navigation
 *
 * @author melengo
 */
class Navigation extends Nav
{

    public $taxmenuid;

    public function init()
    {
        $model = MenuModel::find();
        $query = $model->onCondition([
                            'taxmenu' => $this->taxmenuid,
                            'status' => Site::MENU_STATUS_PUBLISH,
                        ])
                        ->orderBy([
                            'position' => SORT_ASC,
                            'parent_id' => SORT_ASC,
                            
                        ])->asArray()->all();
        $this->items = $this->treeMenu($query);
        parent::init();
    }

    public static function getMenuByHeaderTerm()
    {
        return MenuModel::findMenuByHeaderTerm();
    }

    public function run()
    {
        echo $this->renderItems();
        parent::init();
    }

    protected function countMenuItemByid($id)
    {
        $data = MenuModel::find()->onCondition(['parent_id' => $id])->all();
        return count($data);
    }

    protected function treeMenu($array, $parent = null)
    {
        $data = [];
        foreach ($array as $v) {
            if ($v['parent_id'] == $parent) {
                $data[] = [
                    'id' => $v['id'],
                    'label' => ucwords($v['name']),
                    'icon' => $parent == null ? '' : 'icon-angle-right',
                    'url' => $v['type'] == 'menuhelper' ? [$v['slug']] : (count(IMachTagHtml::getUrlMach($v['slug'])) == 0 ? ['/site/site/tax', 'tax' => $v['slug']] : $v['slug']),
                    'items' => $this->countMenuItemByid($v['id']) == null ? null : $this->treeMenu($array, $v['id']),
                ];
            }
        }
        return $data;
    }

    /**
     * Renders widget items.
     */
    public function renderItems()
    {
        $items = [];
        foreach ($this->items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                unset($items[$i]);
                continue;
            }
            $items[] = $this->renderItem($item);
        }

        return Html::tag('ul', implode("\n", $items), $this->options);
    }

    /**
     * Renders a widget's item.
     * @param string|array $item the item to render.
     * @return string the rendering result.
     * @throws InvalidConfigException
     */
    public function renderItem($item)
    {

        if (is_string($item)) {
            return $item;
        }
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }
        $label = $this->encodeLabels ? Html::encode($item['label']) : $item['label'];
        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', '#');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);

        if (isset($item['active'])) {
            $active = ArrayHelper::remove($item, 'active', false);
        } else {
            $active = $this->isItemActive($item);
        }

        if ($items !== null) {

            $linkOptions['data-toggle'] = 'dropdown';
            Html::addCssClass($options, 'dropdown');
            Html::addCssClass($linkOptions, 'dropdown-toggle');
            if (is_array($items)) {
                if ($this->activateItems) {
                    $items = $this->isChildActive($items, $active);
                }

                $items = Dropdown::widget([
                            'items' => $items,
                            'encodeLabels' => $this->encodeLabels,
                            'clientOptions' => false,
                            'view' => $this->getView(),
                ]);
            }
        }

        if ($this->activateItems && $active) {
            Html::addCssClass($options, 'active');
        }

        return Html::tag('li', Html::a($label, $url, $linkOptions) . $items, $options);
    }

}
