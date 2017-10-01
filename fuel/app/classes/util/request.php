<?php 
/**
 * fuel/app/classes/util/request.php
 *
 * \Util\Requestクラスの定義
 *
 * @since 2017-09-21
 * @copyright  (c) 2017 DMM.com Labo Co.,Ltd All Rights Reserved.
 */
namespace Util;

use Fuel\Core\Request;

/**
 * リクエスト送信用ユーティリティクラス
 * 
 * @package Util
 * @author takae-miyazaki
 * @since 2017-09-21
 * @copyright (c) 2017 DMM.com Labo Co.,Ltd All Rights Reserved.
 */
class Request
{
    /**
     * APIの呼び出しを行います。
     *
     * @param string $url 送信ＵＲＬ
     * @param array $headers リクエストヘッダー
     * @param array $params リクエストパラメータ
     * @param string $method リクエストHTTPメソッド (default='post')
     * @param bool $sslVerify SSL証明書検証有無 (default=false)
     * @param integer $timeout リクエストタイムアウト値 (default=30)
     * @return object リクエストオブジェクト
     **/
    public function call($url, array $headers, array $params = array(), $method = 'post', $sslVerify = false, $timeout = 30)
    {
        $curl = Request::forge($url, 'curl');

        // リクエストヘッダー
        foreach ($headers as $key => $value) {
            $curl->set_header($key, $value);
        }

        // パラメータ
        $curl->set_params($params);

        // メソッド
        $curl->set_method($method);

        // オプション
        $curl->set_options(array(
            'TIMEOUT'         => $timeout,
            'SSL_VERIFYPEER'  => $sslVerify,
        ));

        $curl->set_mime_type('json');
        $curl->set_auto_format(false);

        $request = $curl->execute();

        return $request;
    }
}
