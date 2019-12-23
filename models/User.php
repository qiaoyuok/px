<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{

    /**
     * tableName            表名
     * Date: 2019/03/06
     * Author: sunqiaoyu
     * @return string
     */
    public static function tableName()
    {
        return '{{%user}}';
    }
}
