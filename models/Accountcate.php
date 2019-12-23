<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/03/10
 * Time: 11:33
 */

namespace app\models;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Accountcate extends ActiveRecord
{

    public function rules()
    {
        return [
            [['cate_name','parent_id'],'required'],
            ['parent_id','integer']
        ];
    }

    /**
     * getCates             获取类目列表
     * Date: 2019/02/27
     * Author: sunqiaoyu
     * @param string $appId
     */
    public static function getCates()
    {
        $cate = ArrayHelper::toArray(self::find()->all());
        $cate = self::toTree($cate, 0);
        $cate = self::DASort($cate);
        return $cate;
    }

    /**
     * DASort           多维数组排序
     * Date: 2019/02/20
     * Author: sunqiaoyu
     * @param $data
     */
    public static function DASort($data)
    {
        //  对一级类目排序
        ArrayHelper::multisort($data, ['sort'], [SORT_DESC]);
        //  对二级类目排序
        foreach ($data as $k => $v) {
            ArrayHelper::multisort($data[$k]['children'], ['sort'], [SORT_DESC]);
        }
        return $data;
    }

    /**
     * toTree           对数据进行tree处理
     * Date: 2019/2/19
     * Author: sunqiaoyu
     * @param string $data
     * @param int $parent_id
     */
    public static function toTree($data = '', $parent_id = 0)
    {
        $tmp_arr = [];
        foreach ($data as $k => $v) {
            if ($v['parent_id'] == $parent_id) {
                $v['children'] = self::toTree($data, $v['id']);
                $tmp_arr[] = $v;
            }
        }
        return $tmp_arr;
    }

}