<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**用户登录类
 * Date: 2019/03/06 11:55
 * Author: sunqiaoyu
 * Class: LoginForm
 * @package app\models
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    private $_user = false;


    /**
     * rules                校验规则 可自定义校验方法
     * Date: 2019/03/06
     * Author: sunqiaoyu
     * @return array
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * validatePassword         校验密码
     * Date: 2019/03/06
     * Author: sunqiaoyu
     * @param $attribute
     * @param $params
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * login
     * Date: 2019/03/06         登录操作
     * Author: sunqiaoyu
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), 3600 * 6);
        }
        return false;
    }

    /**
     * getUser              获取全局用户信息
     * Date: 2019/03/06
     * Author: sunqiaoyu
     * @return User|bool|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Administrator::findByUsername($this->username);
        }
        return $this->_user;
    }
}
