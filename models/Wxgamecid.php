<?php


namespace app\models;

use yii\db\ActiveRecord;

class Wxgamecid extends ActiveRecord
{

    public function rules()
    {
        return [
            [['userId','wxgamecid','created_at'],'required']
        ];
    }

    public static function tableName()
    {
        return '{{%wxgamecid}}';
    }

}