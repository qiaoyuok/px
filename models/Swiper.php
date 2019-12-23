<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/05/02
 * Time: 21:28
 */

namespace app\models;
use yii\db\ActiveRecord;

class Swiper extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%swiper}}";
    }

}