<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/06/15
 * Time: 17:16
 */

namespace app\modules\goods\models;

use yii\db\ActiveRecord;
use  yii\behaviors\TimestampBehavior;

class Goods extends ActiveRecord
{
    public static $post;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',// 自己根据数据库字段修改
                'updatedAtAttribute' => 'updated_at', // 自己根据数据库字段修改, // 自己根据数据库字段修改
                //'value'   => new Expression('NOW()'),
                'value' => function() {
                    return time();
                },
            ],
        ];
    }

    public function rules()
    {
        return [
            [['content','images','goodsName','fenqi','status'], 'filterRequired'],
            [['goodsType', 'parent_cate_id', 'cateId','stock','attributes'], 'required'],
            [['accountType', 'vipType', 'loginHelp', 'everyTimes', 'loginTimes', 'endTime'], 'filterRequired'],
            [['goodsType', 'parent_cate_id', 'cateId', 'isOfficial'], 'integer'],
        ];
    }

    /**
     * filterRequired       自定义校验方法
     * 2019/06/15 17:41
     * @param $attribute
     * 15899
     * @return bool
     */
    public function filterRequired($attribute)
    {
        $post = self::$post;
        if ($post['goodsType'] == 1) {
            if (empty($post['accountType']) ||empty($post['endTime']) || empty($post['vipType']) || (empty($post['loginHelp']) && $post['loginHelp'] != 0) || empty($post['everyTimes']) || empty($post['loginTimes'])) {
                $this->addError($attribute, $attribute . "的值不可以为空.");
            }
        } else {
            if (empty($post['goodsName'])) {
                $this->addError($attribute, $attribute . "的值不可以为空.");
            }
        }
    }
}