<?php
namespace Model\Struct;

/**
 * トランザクション情報オブジェクト
 *
 * @package   Model\Struct
 * @author    takae-miyazaki
 * @since     2017-10-18
 * @copyright (c) 2017 DMM.com Labo Co.,Ltd All Rights Reserved.
 */
class TransactionInfo
{
    /**
     * トランザクションID
     *
     * @var string
     */
    private $transactionId;

    /**
     * AppID
     *
     * @var string
     */
    private $appId;

    /**
     * トランザクション作成時間
     *
     * @var string
     */
    private $createdAt;

    /**
     * マジックメソッド:__construct
     *
     * @param  string $transactionId トランザクションID
     * @return void
     */
    public function __construct($transactionId = null)
    {
        $this->setTransactionId($transactionId);
    }

    /**
     * トランザクションID設定メソッド
     *
     * @param  string $transactionId トランザクションID
     * @return void
     */
    private function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * AppID設定メソッド
     *
     * @param  string $appId AppId
     * @return void
     */
    public function setAppId($appId)
    {
        $this->appId = $appId;
    }

    /**
     * AppID取得メソッド
     *
     * @return string AppID
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * トランザクションID取得メソッド
     *
     * @return string トランザクションID
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * トランザクション開始時間設定メソッド
     *
     * @param  string $createdAt トランザクション開始
     * @return void
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * トランザクション開始時間取得メソッド
     *
     * @return string トランザクション開始
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
