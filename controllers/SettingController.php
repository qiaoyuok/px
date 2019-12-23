<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/04/01
 * Time: 21:34
 */

namespace app\controllers;

use app\controllers\BaseController;
use app\models\Setting;
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
use app\models\Swiper;

class SettingController extends BaseController
{

    /**
     * actionApp            应用设置
     * 2019/04/01 21:35
     * 15899
     */
    public function actionAppIndex()
    {
        $auth = new Auth(self::ACCESS_KEY, self::SECRET_KEY);
        $token = $auth->uploadToken(self::BUCKET_NAME);
        return $this->render('app/index', ['token' => $token]);

    }

    /**
     * actionSaveAnnounce       公告编辑 & 公告添加
     * 2019/04/02 21:11
     * 15899
     */
    public function actionSaveAnnounce()
    {

        $setting = new Setting();
        $this->response();
        $content = trim(\Yii::$app->request->post('content'));
        $title = trim(\Yii::$app->request->post('title'));
        $id = \Yii::$app->request->post('id');

        if (empty($content) || empty($title)) {
            return ['code' => 0, 'msg' => '标题或内容不能为空！'];
        }

        // 添加操作
        if ($id == 0) {
            $setting->content = $content;
            $setting->title = $title;
            $setting->updated_at = time();
            $setting->created_at = time();
            if ($setting->save()) {
                return ['code' => 1, 'msg' => '保存成功'];
            } else {
                return ['code' => 0, 'msg' => '保存失败'];
            }
        } else {

            $setting = Setting::findOne(['id' => $id]);
            $setting->content = $content;
            $setting->title = $title;
            $setting->updated_at = time();
            if ($setting->save()) {
                return ['code' => 1, 'msg' => '编辑成功'];
            } else {
                return ['code' => 0, 'msg' => '编辑失败'];
            }
        }
    }

    /**
     * actionGetAnnounceList            获取公告列表
     * 2019/04/02 21:43
     * 15899
     */
    public function actionGetAnnounceList()
    {

        $announcelist = Setting::find()->all();
        $this->response();
        return $announcelist;
    }

    /**
     * actionEditAnnounce           编辑公告状态
     * 2019/04/02 21:58
     * @param string $id
     * @param string $status
     * 15899
     */
    public function actionEditAnnounce($id = '', $status = '')
    {

        $this->response();
        if (empty($id) || empty($status) && $status != 0) {
            return ['code' => 0, 'msg' => '参数有误'];
        }

        if (Setting::updateAll(['status' => $status], ['id' => $id])) {
            return ['code' => 1, 'msg' => "修改状态成功"];
        } else {
            return ['code' => 0, 'msg' => "修改状态失败"];
        }
    }

    /**
     * actionDelAnnounce            删除公告
     * 2019/04/02 22:40
     * @param string $id
     * 15899
     * @return array
     */
    public function actionDelAnnounce($id = '')
    {

        $this->response();
        if (empty($id)) {
            return ['code' => 0, 'msg' => '缺少参数'];
        }

        if (Setting::deleteAll(['id' => $id])) {
            return ['code' => 1, 'msg' => '删除成功'];
        } else {
            return ['code' => 0, 'msg' => '删除失败'];
        }
    }

    /**
     * actionGetAnnounce            获取单条公告信息
     * 2019/04/02 22:54
     * @param string $id
     * 15899
     */
    public function actionGetAnnounce($id = '')
    {

        $this->response();
        if (empty($id)) {
            return ['code' => 0, 'msg' => '缺少参数'];
        }

        return Setting::findOne(['id' => $id]);
    }

    /**
     * actionAddSwiper          添加一个swiper
     * 2019/05/02 21:30
     * 15899
     */
    public function actionAddSwiper()
    {
        $this->response();
        $swiper = new Swiper();
        $post = \Yii::$app->request->post();

        if (!empty($post['id'])) {
            if ($swiper::updateAll(['imgUrl' => !empty($post['key']) ? $post['key'] : die('异常')], ['id' => $post['id']])) {
                return ['code' => 1, 'msg' => '更新成功'];
            } else {
                return ['code' => 0, 'msg' => '更新失败'];
            }
        } else {
            $swiper->created_at = time();
            $swiper->imgUrl = !empty($post['key']) ? $post['key'] : die('异常');
            $swiper->updated_at = time();
            if ($swiper->save()) {
                return ['code' => 1, 'msg' => '添加成功'];
            } else {
                return ['code' => 0, 'msg' => '添加失败'];
            }
        }
    }

    /**
     * actionSwiperList             获取swiper列表
     * 2019/05/02 21:43
     * 15899
     */
    public function actionSwiperList()
    {
        $swiperlist = Swiper::find()->orderBy('sort desc,created_at desc')->all();
        $this->response();
        return $swiperlist;
    }

    /**
     * actionSwiperDelete           删除一个swiper
     * 2019/05/02 22:00
     * @param int $id
     * 15899
     */
    public function actionSwiperDelete($id = 0)
    {
        $this->response();
        if (Swiper::deleteAll(['id' => $id])) {
            return ['code' => 1, 'msg' => "删除成功"];
        } else {
            return ['code' => 0, 'msg' => '删除失败'];
        }
    }

    /**
     * actionSwiperEditStatus          编辑swiper状态
     * 2019/05/03 8:49
     * @param int $id
     * @param string $value
     * 15899
     */
    public function actionSwiperEditStatus($id = 0, $value = '')
    {
        $this->response();
        if (Swiper::updateAll(['status' => $value], ['id' => $id])) {
            return ['code' => 1, 'msg' => '状态修改成功'];
        } else {
            return ['code' => 0, 'msg' => '状态修改失败'];
        }
    }

    /**
     * actionSaveSwiper             保存swiper修改，名称，状态，标题
     * 2019/05/03 10:19
     * 15899
     */
    public function actionSaveSwiper(){

        $post = \Yii::$app->request->post();
        $this->response();
        unset($post['_csrf']);
        $post['updated_at'] = time();
        if (Swiper::updateAll($post,['id'=>$post['id']])){
            return ['code' => 1, 'msg' => '编辑成功'];
        } else {
            return ['code' => 0, 'msg' => '编辑失败'];
        }

    }
}