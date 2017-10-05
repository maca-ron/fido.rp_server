<?php
/**
 * fuel/app/classes/controller/abstractcontroller.php
 *
 * \Controller\AbstractControllerクラスの定義
 *
 * @since 2017-09-21
 * @copyright  (c) 2017 DMM.com Labo Co.,Ltd All Rights Reserved.
 */
namespace Controller;

/**
 * @package Controller
 * @author takae-miyazaki
 * @since 2017-09-21
 * @copyright (c) 2017 DMM.com Labo Co.,Ltd All Rights Reserved.
 */
class AbstractController extends \Controller_Rest
{

    public function before()
    {
        try {
            \Log::info('[begin] ' . \Request::main()->controller);
            parent::before();
        } catch (\Exception $e) {
            \Log::error('An exception occurred.', \Request::main()->controller . '::before()');
        }
    }

    public function after($response)
    {
        try {
            \Log::info('[end] ' . \Request::main()->controller);
            return parent::after($response);
        } catch (\Exception $e) {
            \Log::error('An exception occurred.', \Request::main()->controller . '::after()');
        }
    }
}