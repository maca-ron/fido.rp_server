<?php
namespace Controller;

use Controller;
use Util\Request;
use Model\Dao;

/**
 * 認証開始コントローラークラス
 *
 * @package   Controller
 * @author    takae-miyazaki
 * @since     2017-10-06
 * @copyright (c) 2017 DMM.com Labo Co.,Ltd All Rights Reserved.
 */
class AuthenticationInitiate extends AbstractController
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

        $transactionId = $headers['X-FACETAP-TxnId'];
        $transactionInfo = Dao\Transactions::findTransaction($transactionId);
        if (is_null($transactionInfo)) {
            return $this->response(array(
            'error' => 'FIDO-030',
            'error_description' => 'TransactionId is invalid.',
            'status' => 'ERR',
            ));
        }

        // 有効期限チェック
        $createdAt = $transactionInfo->getCreatedAt();
        if (date("Y-m-d H:i:s",strtotime($createdAt . "+3 minute")) < date('Y-m-d H:i:s')) {
            return $this->response(array(
                'error' => 'FIDO-030',
                'error_description' => 'TransactionId is invalid.',
                'status' => 'ERR',
            ));
        }

        $response = Request\Magatama::connect(
            '/fidoap/authentication/initiate',
            $headers,
            $params,
            true
        );

        // データ削除
        Dao\Transactions::deleteTransaction($transactionId);

        foreach ($response->headers as $headerKey => $headerValue) {
            $this->response->set_header($headerKey, $headerValue);
        }
        return $response->body();
    }
}
