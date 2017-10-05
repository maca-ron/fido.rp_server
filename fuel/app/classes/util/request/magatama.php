<?php 
/**
 * fuel/app/classes/util/request/magatama.php
 *
 * \Util\Request\Magatamaクラスの定義
 *
 * @since 2017-09-21
 * @copyright  (c) 2017 DMM.com Labo Co.,Ltd All Rights Reserved.
 */
namespace Util\Request;

use Util;

/**
 * 勾玉サーバーリクエスト送信用ユーティリティクラス
 * 
 * @package Util\Request
 * @author takae-miyazaki
 * @since 2017-09-21
 * @copyright (c) 2017 DMM.com Labo Co.,Ltd All Rights Reserved.
 */
class Magatama
{
    /** @var const magatamaサーバーのFQDN */
    const MAGATAMA_SERVER_FQDN = 'https://dmm-dev.dds-dev.space:8443';

    /** @var const magatamaサーバー事業者コード */
    const MAGATAMA_OP_CODE = '****';

    /** @var const magatamaサーバー認証キー */
    const MAGATAMA_AUTH_KEY = '***************************************************************';

    /**
     * 勾玉サーバーにリクエストを行います。
     *
     * @param string $url 送信ＵＲＬ
     * @param array $headers リクエストヘッダー
     * @param array $params リクエストパラメータ
     * @param bool $additionalHeader 事業者コード・認証キーの付与有無 (default=false)
     * @return object レスポンスオブジェクト
     **/
    public static function connect($url, array $headers, array $params = array(), $additionalHeader = false)
    {
        if ($additionalHeader === true) {
            $headers['X_FIDOAP_OP_CODE'] = self::MAGATAMA_OP_CODE;
            $headers['X_FIDOAP_AUTH_KEY'] = self::MAGATAMA_AUTH_KEY;
        }

        $request = Util\Request::call(
            self::MAGATAMA_SERVER_FQDN . $url,
            $headers,
            $params,
            'post'
        );

        return $request->response();
    }

}