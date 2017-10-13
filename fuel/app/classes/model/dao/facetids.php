<?php
namespace Model\Dao;

use Model\Struct;

/**
 * DAO FacetID情報Mysqlモデル
 *
 * @package   Model\Dao
 * @author    takae-miyazaki
 * @since     2017-10-10
 * @copyright (c) 2017 DMM.com Labo Co.,Ltd All Rights Reserved.
 */
class FacetIds
{
    /**
     * FacetID情報検索メソッド
     *
     * @param  string $appId         AppID
     * @return Model\Struct\FacetIds FacetID情報オブジェクト
     */
    public static function findFacetIds($appId)
    {
        $colums = array(
            'facet_id'
        );
        $query = \DB::select_array($colums)->from('facet_ids')
                                           ->where('app_id', $appId)
                                           ->execute();

        $result = $query->as_array();
        if (is_null($result) === true) {
            return $result;
        }

        $structFacetIds = new Struct\FacetIds($appId);

        foreach ($result as $row) {
            foreach ($row as $colum => $facetId) {
                $structFacetIds->setFacetId($facetId);
            }
        }

        return $structFacetIds;
    }

    /**
     * FacetID情報登録メソッド
     *
     * @param  Model\Struct\FacetIds FacetID情報オブジェクト
     * @return boolean
     */
    public static function writeFacetIds(Struct\FacetIds $structFacetIds)
    {
        $sql = 'INSERT INTO '
             .     'facet_ids '
             . '('
             .     'app_id, '
             .     'facet_id '
             . ')'
             . 'VALUES '
             . '('
             .     ':appId, '
             .     ':facetId '
             . ')';

        foreach ($structFacetIds->getFacetIds() as $facetId) {
            $query = \DB::query($sql)
            ->param(':appId', $structFacetIds->getAppId())
            ->param(':facetId', $facetId)
            ->execute();
        }

        return true;
    }
}