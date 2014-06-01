<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\site\searchs;

use app\modules\site\models\PageModel;
use app\modules\site\Site;

/**
 * Description of PageSerch
 *
 * @author melengo
 */
class PageSerch extends PageModel
{

    private static $_items = array();
    private static $_list = array(NULL => 'None');
    private $year_filtr1;
    private $year_filtr2;
    private $year_filtr3;
    private $year_filtr4;
    private $year_opsi;
    private $year_opsi1;
    public $keyword;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'content', 'slug', 'status', 'other_content', 'comment_status', 'create_et', 'update_et'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function getPage($params)
    {
        $model = self::find();
        $query = $model->onCondition([
                    'status' => Site::POST_STATUS_PUBLISH,
                    'type' => Site::POST_POST_TYPE_PAGE,
                    'slug' => $params['tax']
                ])->one();


        return $query;
    }

}
