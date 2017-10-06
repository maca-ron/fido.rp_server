<?php
namespace Controller;

use Controller;
use Util\Request;

/**
 * 解除開始コントローラークラス
 *
 * @package   Controller
 * @author    takae-miyazaki
 * @since     2017-10-06
 * @copyright (c) 2017 DMM.com Labo Co.,Ltd All Rights Reserved.
 */
class DeregistrationInitiate extends AbstractController
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

        $response = Request\Magatama::connect(
            '/fidoap/deregistration/initiate',
            $headers,
            $params,
            true
        );

        return $response;
    }
}
