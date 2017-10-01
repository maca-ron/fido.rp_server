<?php 
/**
 * fuel/app/classes/util/interface/magatama.php
 *
 * \Util\Interface\Magatamaクラスの定義
 *
 * @since 2017-09-21
 * @copyright  (c) 2017 DMM.com Labo Co.,Ltd All Rights Reserved.
 */
namespace Util\Interface;

use Util;

/**
 * 勾玉サーバーリクエスト送信用ユーティリティクラス
 * 
 * @package Util\Interface
 * @author takae-miyazaki
 * @since 2017-09-21
 * @copyright (c) 2017 DMM.com Labo Co.,Ltd All Rights Reserved.
 */
class Magatama
{
    /** @var const magatamaサーバーのFQDN */
    const MAGATAMA_SERVER_FQDN = 'https://dmm-dev.dds-dev.space:8443';

    /**
     * 勾玉サーバーにリクエストを行います。
     *
     * @param string $url 送信ＵＲＬ
     * @param array $headers リクエストヘッダー
     * @param array $params リクエストパラメータ
     * @param bool $sslVerify SSL証明書検証有無 (default=false)
     * @return object レスポンスオブジェクト
     **/
    public function connect($url, array $headers, array $params = array())
    {
        $request = Request::call(
            self::MAGATAMA_SERVER_FQDN . $url,
            $headers,
            $params,
            'post',
            $sslVerify
        );

        return $request->response();
    }

}