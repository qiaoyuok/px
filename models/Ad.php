<?php


namespace app\models;

use yii\db\ActiveRecord;

class Ad extends ActiveRecord
{

    public function rules()
    {
        return [
            [['userId','status','wxgamecid','created_at'],'required'],
            ['status','integer']
        ];
    }

    public static function tableName()
    {
        return '{{%ad}}';
    }

}