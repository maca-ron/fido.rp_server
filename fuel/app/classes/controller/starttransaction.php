<?php
namespace Controller;

use Controller;
use Model\Dao;
use Model\Struct;

/**
 * FIDO処理開始コントローラークラス
 *
 * @package   Controller
 * @author    takae-miyazaki
 * @since     2017-10-18
 * @copyright (c) 2017 DMM.com Labo Co.,Ltd All Rights Reserved.
 */
class StartTransaction extends AbstractController
{

    /**
     * 対象AppID一覧
     *
     * @var array
     */
    private $allowAppIds = array(
        'test',
    );

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

        $appId = $headers['X-FIDOAP-AppId'];
        if (in_array($appId, $this->allowAppIds) === false) {
            return $this->response(array(
                'error' => 'FIDO-020',
                'error_description' => 'AppID is not allowed.',
                'status' => 'ERR',
                )
            );
        }

        $transactionId = md5(uniqid(rand(), true));
        $structTransactionInfo = new Struct\TransactionInfo($transactionId);
        $structTransactionInfo->setAppId($appId);

        Dao\Transactions::writeTransaction($structTransactionInfo);

        $this->response->set_header('X-FACETAP-TxnId', $transactionId);
        return $this->response(
            array(
                'error' => 'FIDO-100',
                'error_description' => '',
                'status' => 'OK',
            ),
            200
        );
    }
}
