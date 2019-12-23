<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/03/17
 * Time: 16:10
 */

namespace app\models;

use yii\db\ActiveRecord;

class Freevip extends ActiveRecord
{

    public static $table = "{{%freeconfig_main}}";

    public static function tableName()
    {
        return self::$table;
    }

    /**
     * vipTime                  处理会员到期时间语义化
     * 2019/05/19 11:10
     * @param int $outTime
     * 15899
     */
    public static function vipTime($outTime = 0)
    {

        //获取剩余天数，向上取整
        $day = ceil(($outTime - time()) / 86400);


        if ($day >= 7) {
            switch ($day) {
                case $day % 7 < 2:
                    $day = '周卡';
                    break;
                case $day>7 && $day % 30 < 3:
                    $day = '月卡';
                    break;
                case $day>30 && $day % 120 < 10:
                    $day = '季卡';
                    break;
                case $day>120 &&  $day % 180 < 20:
                    $day = '半年卡';
                    break;
                case $day>180 &&  $day % 360 < 30:
                    $day = '年卡';
                    break;
                default:
                    $day = $day."天卡";
                    break;
            }
        } else {
            $day = $day."天卡";
        }

        return $day;

    }

}