<?php


namespace app\models;

use yii\db\ActiveRecord;

class UserWxgamecid extends ActiveRecord
{

    public function rules()
    {
        return [
            [['userId','channelId','created_at'],'required']
        ];
    }

    public static function tableName()
    {
        return '{{%user_wxgamecid}}';
    }

}