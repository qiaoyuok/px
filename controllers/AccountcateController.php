<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/03/10
 * Time: 11:32
 */

namespace app\controllers;

use app\models\Accountcate;
use Yii;
use app\controllers\BaseController;
use app\models\Accountconfig;

class AccountcateController extends BaseController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGetCate()
    {
        $this->response();
        return Accountcate::getCates();
    }

    public function actionEditCate($field = '', $value = '', $id = '')
    {
        $this->response();

        if ($field == 'sort') {

            //获取到该分类的上一个分类，并以该分类的sort为基准进行增减处理
            $accountcateinfo = Accountcate::findOne(['id' => $id]);
            $accountcates = Accountcate::getCates();
            //处理顶级分类的排序
            if ($accountcateinfo['parent_id'] == 0) {

                foreach ($accountcates as $k => $v) {

                    if ($value < 0) {  //向下移动
                        if ($v['id'] == $id && $k == count($accountcates) - 1) {
                            return ['code' => 0, 'msg' => '已经是最最底部了'];
                        }
                        if ($v['id'] == $id) {
                            $value = $accountcates[$k + 1]['sort'] + $value;
                            break;
                        }
                    } else { //向上移动
                        if ($v['id'] == $id && $k == 0) {
                            return ['code' => 0, 'msg' => '已经是最最顶级了'];
                        }
                        if ($v['id'] == $id) {
                            $value = $accountcates[$k - 1]['sort'] + $value;
                            break;
                        }
                    }
                }
            } else {
                //处理子分类的排序
                foreach ($accountcates as $k => $v) {
                    if ($v['id'] == $accountcateinfo['parent_id']) {
                        foreach ($v['children'] as $k1 => $v1) {
                            if ($value < 0) {  //向下移动
                                if ($v1['id'] == $id && $k1 == count($v['children']) - 1) {
                                    return ['code' => 0, 'msg' => '已经是最最底部了'];
                                }
                                if ($v1['id'] == $id) {
                                    $value = $v['children'][$k1 + 1]['sort'] + $value;
                                    break;
                                }
                            } else { //向上移动
                                if ($v1['id'] == $id && $k1 == 0) {
                                    return ['code' => 0, 'msg' => '已经是最最顶级了'];
                                }
                                if ($v1['id'] == $id) {
                                    $value = $v['children'][$k1 - 1]['sort'] + $value;
                                    break;
                                }
                            }
                        }
                        break;
                    }
                }
            }
        }

        if (Accountcate::updateAll(["$field" => $value], ['id' => $id])) {
            return ['code' => 1, "msg" => '编辑分类成功'];
        } else {
            return ['code' => 0, 'msg' => '编辑分类失败'];
        }
    }

    /**
     * actionAddCate            添加分类
     * 2019/05/18 18:20
     * 15899
     * @return array
     */
    public function actionAddCate()
    {

        $accountcate = new Accountcate();

        $this->response();
        if ($accountcate->load(Yii::$app->request->post()) && $accountcate->validate()) {
            if ($accountcate->save()) {

                //如果添加的是子分类，及平台的话，则添加默认配置
                if ($accountcate->parent_id != 0) {
                    //添加默认的平台账号配置
                    $accountconfig = new Accountconfig();
                    $accountconfig->cateId = $accountcate->id;
                    $accountconfig->accountType = '[]';
                    $accountconfig->vipType = '[]';
                    $accountconfig->fenqi = '[]';
                    if ($accountconfig->save()) {
                        return ['code' => 1, "msg" => "添加分类成功"];
                    } else {
                        Accountcate::deleteAll(['id' => $accountcate->id]);
                        return ['code' => 0, 'msg' => '添加分类失败'];
                    }
                } else {
                    return ['code' => 1, "msg" => "添加分类成功"];
                }
            } else {
                return ['code' => 0, 'msg' => '添加分类失败'];
            }
        } else {
            return ['code' => 0, 'msg' => '数据校验失败'];
        }
    }

    public function actionDelCate($id = '')
    {
        $this->response();

        //处理子分类删除
        $cateinfo = Accountcate::findOne(['id' => $id]);
        if ($cateinfo['parent_id'] == 0) {
            $ids = Accountcate::findAll(['parent_id' => $id]);
            $id = array_merge([$id], $ids);
        }
        if (Accountcate::deleteAll(['id' => $id])) {
            //删除平台账号配置
            Accountconfig::deleteAll(['cate_id' => $id]);
            return ['code' => 1, 'msg' => '删除分类成功'];
        } else {
            return ['code' => 0, 'msg' => '删除分类失败'];
        }
    }

}