<?php
namespace Model\Dao;

use Model\Struct;

/**
 * DAO トランザクション情報Mysqlモデル
 *
 * @package   Model\Dao
 * @author    takae-miyazaki
 * @since     2017-10-20
 * @copyright (c) 2017 DMM.com Labo Co.,Ltd All Rights Reserved.
 */
class Transactions
{
    /**
     * トランザクション情報検索メソッド
     *
     * @param  string $transactionId        トランザクションID
     * @return Model\Struct\TransactionInfo トランザクション情報オブジェクト
     */
    public static function findTransaction($transactionId)
    {
        $colums = array(
            'transaction_id',
            'app_id',
            'created_at',
        );
        $query = \DB::select_array($colums)->from('transactions')
                                     ->where('transaction_id', $transactionId)
                                     ->execute();

        $result = $query->as_array();
        if (is_null($result) === true) {
            return $result;
        }

        $structTransactionInfo = new Struct\TransactionInfo($result[0]['transaction_id']);
        $structTransactionInfo->setAppId($result[0]['app_id']);
        $structTransactionInfo->setCreatedAt($result[0]['created_at']);

        return $structTransactionInfo;
    }

    /**
     * トランザクション情報登録メソッド
     *
     * @param  Model\Struct\TransactionInfo トランザクション情報オブジェクト
     * @return boolean
     */
    public static function writeTransaction(Struct\TransactionInfo $structTransactionInfo)
    {
        $sql = 'INSERT INTO '
             .     'transactions '
             . '('
             .     'transaction_id, '
             .     'app_id '
             . ')'
             . 'VALUES '
             . '('
             .     ':transactionId, '
             .     ':appId '
             . ')';

        $query = \DB::query($sql)
            ->param(':transactionId', $structTransactionInfo->getTransactionId())
            ->param(':appId', $structTransactionInfo->getAppId())
            ->execute();

        return true;
    }

    /**
     * トランザクション情報削除メソッド
     *
     * @param  string $transactionId        トランザクションID
     * @return boolean
     */
    public static function deleteTransaction($transactionId)
    {
        $query = \DB::delete('transactions')
            ->where('transaction_id', $transactionId)
            ->execute();

        return true;
    }
}