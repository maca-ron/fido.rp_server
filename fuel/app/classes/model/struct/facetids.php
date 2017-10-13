<?php
namespace Model\Struct;

/**
 * FacetID情報オブジェクト
 *
 * @package   Model\Struct
 * @author    takae-miyazaki
 * @since     2017-10-10
 * @copyright (c) 2017 DMM.com Labo Co.,Ltd All Rights Reserved.
 */
class FacetIds
{
    /**
     * FacetIDリスト
     *
     * @var array
     */
    private $facetIds = array();

    /**
     * AppID
     *
     * @var string
     */
    private $appId;

    /**
     * マジックメソッド:__construct
     *
     * @param  string $appId AppID
     * @return void
     */
    public function __construct($appId = null)
    {
        $this->setAppId($appId);
    }

    /**
     * AppID設定メソッド
     *
     * @param  string $appId AppID
     * @return void
     */
    private function setAppId($appId)
    {
        $this->appId = $appId;
    }

    /**
     * FacetID設定メソッド
     *
     * @param  string $facetId FacetId
     * @return void
     */
    public function setFacetId($facetId)
    {
        $this->facetIds[] = $facetId;
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
     * FacetIDリスト取得メソッド
     *
     * @return array FacetIDリスト
     */
    public function getFacetIds()
    {
        return $this->facetIds;
    }
}
