<?php

namespace app\models;

use yii\db\ActiveRecord;

class Administrator extends ActiveRecord implements \yii\web\IdentityInterface
{

    /**
     * tableName            表名
     * Date: 2019/03/06
     * Author: sunqiaoyu
     * @return string
     */
    public static function tableName()
    {
        return '{{%administrator}}';
    }

    /**
     * findIdentity         通过ID号获取用户信息
     * Date: 2019/03/06
     * Author: sunqiaoyu
     * @param int|string $id
     * @return User|\yii\web\IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * findIdentityByAccessToken        获取token校验码 restful使用到
     * Date: 2019/03/06
     * Author: sunqiaoyu
     * @param mixed $token
     * @param null $type
     * @return \yii\web\IdentityInterface|null
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * findByUsername           通过用户名获取用户信息
     * Date: 2019/03/06
     * Author: sunqiaoyu
     * @param $username
     * @return User|null
     */
    public static function findByUsername($username)
    {
        $userinfo = self::findOne(['username' => $username]);
        if ($userinfo) {
            return new static($userinfo);
        }
        return null;
    }

    /**
     * getId                获取用户id
     * Date: 2019/03/06
     * Author: sunqiaoyu
     * @return int|mixed|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * getAuthKey
     * Date: 2019/03/06
     * Author: sunqiaoyu
     * @return string|void
     */
    public function getAuthKey()
    {
        //return $this->authKey;
    }

    /**
     * validateAuthKey
     * Date: 2019/03/06
     * Author: sunqiaoyu
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * validatePassword         yii自带的密码校验
     * Date: 2019/03/06
     * Author: sunqiaoyu
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return \Yii::$app->getSecurity()->validatePassword($password, $this->access_token);
    }
}