<?php
namespace Controller;

use Controller;
use Util\Request;

/**
 * 認証コントローラークラス
 *
 * @package   Controller
 * @author    takae-miyazaki
 * @since     2017-10-06
 * @copyright (c) 2017 DMM.com Labo Co.,Ltd All Rights Reserved.
 */
class Authentication extends AbstractController
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
            '/fidoap/authentication/response',
            $headers,
            $params,
            false
        );

        foreach ($response->headers as $headerKey => $headerValue) {
            $this->response->set_header($headerKey, $headerValue);
        }
        return $response->body();
    }
}
