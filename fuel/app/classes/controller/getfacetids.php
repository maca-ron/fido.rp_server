<?php
namespace Controller;

use Controller;
use Model\Dao;

/**
 * FacetID取得コントローラークラス
 *
 * @package   Controller
 * @author    takae-miyazaki
 * @since     2017-10-10
 * @copyright (c) 2017 DMM.com Labo Co.,Ltd All Rights Reserved.
 */
class GetFacetIds extends AbstractController
{
    /**
     * デフォルトアクションメソッド
     *
     * @param  string $version     バージョン
     * @return \Fuel\Core\Response レスポンスオブジェクト
     */
    public function action_index($version = null)
    {
        $headers = \Input::headers();
        $params  = \Input::param();

        $facetIds = Dao\FacetIds::findFacetIds(\Input::param('app_id'));

        return $this->response(array(
            'trustedFacets' => array(
                'version' => array('major' => 1, 'minor' => 0),
                'ids' => $facetIds->getFacetIds(),
            )
        ));
    }
}
