<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/03/06
 * Time: 20:45
 */

namespace app\controllers;

use app\controllers\BaseController;
use app\models\Menu;
use Yii;
use yii\helpers\ArrayHelper;

class MenuController extends BaseController
{
    /**                 菜单管理首页
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     *          添加菜单
     */
    public function actionAddMenu()
    {
        $menu = new Menu();
        $this->response();
        $menu->load(\Yii::$app->request->post());
        if ($menu->load(\Yii::$app->request->post()) && $menu->validate()) {
            if ($menu->save()) {
                return ['code' => 1, 'msg' => '添加成功'];
            } else {
                return ['code' => 0, 'msg' => '添加失败！'];
            }
        } else {
            return ['code' => 0, 'msg' => '数据不合法！'];
        }
    }

    public function actionGetMenus()
    {

        $menus = Menu::find()->all();
        $tmp_menus = [];
        $menus = ArrayHelper::toArray($menus);
        $this->response();
        //对数据进行分组处理
        foreach ($menus as $k => $v) {
            $rowspan = 1;
            if ($v['parent_id'] == 0) {
                $v['rowspan'] = $rowspan;
                $tmp_menus[$k] = $v;
                foreach ($menus as $key => $value) {
                    if ($value['parent_id'] == $v['id']) {
                        $tmp_menus[$k]['rowspan']++;
                        $tmp_menus[$k]['children'][] = $value;
                    }
                }
            }
        }

        //排序处理
        ArrayHelper::multisort($tmp_menus, ['sort'], [SORT_DESC]);
        foreach ($tmp_menus as $k => $v) {
            ArrayHelper::multisort($tmp_menus[$k]['children'], ['sort'], [SORT_DESC]);
        }
        $menus = [];
        foreach ($tmp_menus as $k => $v) {
            $menus[] = $v;
            if (isset($v['children'])) {
                foreach ($v['children'] as $key => $value) {
                    $menus[] = $value;
                }
            }
        }
        return $menus;
    }

    public function actionEditMenu($field = '', $id = '', $value = '')
    {
        $this->response();
        if (empty($value) && $value != "0") {
            return ['code' => 0, 'msg' => '内容不能为空'];
        }
        if (Menu::updateAll(["$field" => $value], ['id' => $id])) {
            return ['code' => 1, 'msg' => '编辑菜单成功'];
        } else {
            return ['code' => 0, 'msg' => '编辑菜单失败'];
        }
    }

    public function actionDelMenu($id = '')
    {
        $this->response();

        $menuinfo = Menu::findOne(['id' => $id]);
        if ($menuinfo['parent_id'] == 0) {
            $id = array_merge([$id], Menu::find()->select('id')->where(['parent_id' => $id])->all());
        }

        if (Menu::deleteAll(['id' => $id])) {
            return ['code' => 1, 'msg' => "删除成功"];
        } else {
            return ['code' => 0, "msg" => "删除失败"];
        }

    }
}
