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

use Fuel\Core;

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
     * @param string $method リクエストHTTPメソッド (default='POST')
     * @param bool $sslVerify SSL証明書検証有無 (default=false)
     * @param integer $timeout リクエストタイムアウト値 (default=30)
     * @return object リクエストオブジェクト
     **/
    public static function call($url, array $headers, array $params = array(), $method = 'POST', $sslVerify = false, $timeout = 30)
    {
        try {
            $curl = Core\Request::forge($url, 'curl');

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

            $curl->set_auto_format(false);
    
            \Log::info($url . 'is requested.');
            \Log::info('Request begin ' . $url);
            \Log::debug('Request url: ' . $url);
            \Log::debug('Request headers: ' . print_r($headers,true));
            \Log::debug('Request params: ' . print_r($params,true));
            \Log::debug('Request method: ' . $method);

            $start = microtime(true);

            $request = $curl->execute();

            $end = microtime(true);
            $time = $end - $start;

            \Log::info('Request end ' . $url . ' , time:' . $time);

            return $request;
        } catch (\Exception $e) {
            \Log::debug('Exception $e: ' . print_r($e,true));
            \Log::error('An exception occurred.', 'Request::call()');
        }
        return $request;
    }
}
