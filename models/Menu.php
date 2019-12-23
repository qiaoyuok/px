<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/03/06
 * Time: 21:43
 */

namespace app\models;

use yii\db\ActiveRecord;

class Menu extends ActiveRecord
{
    /**                 表名
     * @return string
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**             验证规则
     * @return array
     */
    public function rules()
    {
        return [
            [['name', 'router','parent_id'], 'required'],
            ['router', 'validateRouter'],
            ['parent_id','integer']
        ];
    }

    /**
     * 校验路由是否填写正确
     */
    public function validateRouter($router = '')
    {
        if (!$this->hasErrors()) {
            if (count(explode("/", $this->router)) < 2) {
                $this->addError($router, "路由格式不对");
            }
            $this->router = strtolower($this->router);
        }
    }

}
