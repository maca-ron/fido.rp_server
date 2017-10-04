<?php
namespace Controller;

use Controller;
use Util\Request;

/**
 * 登録開始コントローラークラス
 *
 * @package   Controller
 * @author    takae-miyazaki
 * @since     2017-09-21
 * @copyright (c) 2017 DMM.com Labo Co.,Ltd All Rights Reserved.
 */
class RegistrationInitiate extends AbstractController
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

        $response = Magatama::connect(
            '/fidoap/registration/initiate',
            $headers,
            $params,
            true
        );

        return $response;
    }
}
