<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/04/02
 * Time: 21:12
 */

namespace app\models;

use yii\db\ActiveRecord;

class Setting extends ActiveRecord
{

    public static $table = "{{%announce}}";

    public static function tableName()
    {
        return self::$table;
    }

}