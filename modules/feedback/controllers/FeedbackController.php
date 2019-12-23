<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/05/11
 * Time: 10:43
 */

namespace app\modules\feedback\controllers;

use app\controllers\BaseController;
use app\modules\feedback\models\Feedback;
use app\modules\feedback\models\FeedbackReply;
use yii\db\Query;
use app\modules\feedback\models\LoginCode;

class FeedbackController extends BaseController
{

    public function actionIndex()
    {

        return $this->render('index');

    }


    /**
     * actionFeedbackList               获取反馈列表
     * 2019/05/12 1:00
     * @param int $page
     * @param int $limit
     * @param string $nickname
     * @param string $tel
     * @param string $datetime
     * 15899
     * @return array
     */
    public function actionFeedbackList($page = 1, $limit = 9, $nickname = '', $tel = '', $datetime = '')
    {
        $this->response();

        if (!empty($datetime) && $datetime != 'null') {
            $datetime = explode(",", $datetime);

            $start = floor($datetime[0] / 1000);
            $end = floor($datetime[1] / 1000);

            $total = Feedback::find()
                ->alias('fd')
                ->leftJoin("{{%user}} as u", 'u.uuid = fd.uuid')
                ->andFilterWhere(['like', 'u.nickname', $nickname])
                ->andFilterWhere(['like', 'u.tel', $tel])
                ->andFilterWhere(['>', 'fd.created_at', $start])
                ->andFilterWhere(['<', 'fd.created_at', $end])
                ->groupBy(["fd.account_id", "fd.uuid"])
                ->count();

            //创建子查询
            $subQuery = Feedback::find()
                ->orderBy("created_at desc")
                ->offset(($page - 1) * $limit)
                ->limit($limit);

            $query = new Query();
            $data = $query->select(['fd.*', 'u.nickname', 'u.tel', 'u.avatar'])
                ->from(['fd' => $subQuery])
                ->leftJoin(['u' => "{{%user}}"], 'fd.uuid = u.uuid')
                ->andFilterWhere(['like', 'u.nickname', $nickname])
                ->andFilterWhere(['like', 'u.tel', $tel])
                ->andFilterWhere(['>', 'fd.created_at', $start])
                ->andFilterWhere(['<', 'fd.created_at', $end])
                ->groupBy(["fd.account_id", "fd.uuid"])
                ->orderBy("fd.created_at desc")
                ->createCommand()
                ->queryAll();

            return ['total' => $total, 'data' => $data];
        } else {

            $total = Feedback::find()
                ->alias('fd')
                ->leftJoin("{{%user}} as u", 'u.uuid = fd.uuid')
                ->groupBy(["fd.account_id", "fd.uuid"])
                ->count();

            //创建子查询
            $subQuery = Feedback::find()
                ->orderBy("created_at desc")
                ->offset(($page - 1) * $limit)
                ->limit($limit);

            $query = new Query();
            $data = $query->select(['fd.*', 'u.nickname', 'u.tel', 'u.avatar'])
                ->from(['fd' => $subQuery])
                ->leftJoin(['u' => "{{%user}}"], 'fd.uuid = u.uuid')
                ->andFilterWhere(['like', 'u.nickname', $nickname])
                ->andFilterWhere(['like', 'u.tel', $tel])
                ->groupBy(["fd.account_id", "fd.uuid"])
                ->orderBy("fd.created_at desc")
                ->createCommand()
                ->queryAll();

            return ['total' => $total, 'data' => $data];
        }
    }

    /**
     * actionDelFeedback            删除反馈
     * 2019/05/12 2:13
     * @param int $id
     * 15899
     */
    public function actionDelFeedback($id = 0)
    {

        $this->response();
        if (Feedback::deleteAll(['id' => $id])) {
            return ['code' => 1, 'msg' => '删除成功'];
        } else {
            return ['code' => 0, 'msg' => '删除失败'];
        }
    }

    /**
     * actionFeedbackInfo           获取反馈信息，反馈时间轴列表
     * 2019/05/12 10:14
     * @param int $account_id
     * @param string $uuid
     * 15899
     */
    public function actionFeedbackInfo($account_id = 0, $uuid = '')
    {

        $this->response();

        // 1、先查用户的反馈
        $feedbackInfo = Feedback::find()
            ->where(['account_id' => $account_id, 'uuid' => $uuid])
            ->orderBy('created_at desc')
            ->asArray()
            ->all();

        //2、在查回复的内容
        foreach ($feedbackInfo as $k => $v) {
            $feedbackInfo[$k]['children'] = FeedbackReply::find()
                ->where(['feedback_id' => $v['id']])
                ->orderBy('created_at desc')
                ->asArray()
                ->all();
        }

        return $feedbackInfo;
    }

    /**
     * actionAddFeedbackReply           添加反馈回复
     * 2019/05/12 16:49
     * 15899
     */
    public function actionAddFeedbackReply()
    {

        $this->response();
        $feedbackReply = new FeedbackReply();
        $post = \Yii::$app->request->post();
        if (empty($post['content']) || (int)$post['feedback_id'] == 0) {
            return ['code' => 0, 'msg' => '内容不能为空，或没有选择要反馈的问题'];
        }
        $feedback_id = (int)$post['feedback_id'];
        $content = $post['content'];
        $feedbackReply->feedback_id = $feedback_id;
        $feedbackReply->content = $content;
        $feedbackReply->created_at = time();
        $feedbackReply->updated_at = time();
        if ($feedbackReply->save()) {

            Feedback::updateAll(['status' => 1, 'updated_at' => time()], ['id' => $feedback_id]);

            return ['code' => 1, 'msg' => '回复成功'];
        } else {
            return ['code' => 0, 'msg' => '回复失败'];
        }
    }

    /**
     * actionEditFeedbackReply           编辑反馈回复
     * 2019/05/12 16:49
     * 15899
     */
    public function actionEditFeedbackReply()
    {

        $this->response();
        $post = \Yii::$app->request->post();
        if (empty($post['content']) || (int)$post['reply_id'] == 0) {
            return ['code' => 0, 'msg' => '内容不能为空，或没有选择要反馈的问题'];
        }
        $reply_id = (int)$post['reply_id'];
        $content = $post['content'];
        if (FeedbackReply::updateAll(['content' => $content, 'updated_at' => time()], ['id' => $reply_id])) {

            return ['code' => 1, 'msg' => '编辑回复成功'];
        } else {
            return ['code' => 0, 'msg' => '编辑回复失败'];
        }
    }

    /**
     * actionDelFeedbackReply           删除回复
     * 2019/05/12 17:43
     * @param int $id
     * 15899
     */
    public function actionDelFeedbackReply($id = 0)
    {

        $this->response();

        if (FeedbackReply::deleteAll(['id' => $id])) {
            return ['code' => 1, 'msg' => '删除成功'];
        } else {
            return ['code' => 0, 'msg' => '删除失败'];
        }
    }

    /**
     * actionGetAccountInfo         获取账号详细信息
     * 2019/05/12 19:34
     * @param int $account_id
     * 15899
     */
    public function actionGetAccountInfo($account_id = 0)
    {

        $this->response();
        $accountInfo = Feedback::find()
            ->alias('fd')
            ->select("fd.*,fgr.vip_name,fgr.vipType,fgr.viptime,fgr.created_at as fgrcreated_at,fgr.code_num,fgr.login_help,fgr.accountType,fgr.id as fgrid,fs.account,fs.password,lc.code")
            ->leftJoin("{{%freevip_get_record}} as fgr", 'fd.account_id = fgr.id')
            ->leftJoin("{{%freeaccounts}} as fs", 'fgr.account_id = fs.id')
            ->leftJoin("{{%login_code}} as lc", 'lc.fgr_id = fgr.id')
            ->where(['fd.account_id' => $account_id])
            ->asArray()
            ->one();

        return $accountInfo;
    }

    /**
     * actionGetLoginCode       辅助获取登录码
     * 2019/05/12 20:10
     * @param int $account_id
     * 15899
     */
    public function actionGetLoginCode($account_id = 0)
    {
        //随机生成验证码
        $this->response();
        $str = "0123456798abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $code = substr(str_shuffle($str), 0, 4);

        $loginCode = LoginCode::findAll(['fgr_id'=>$account_id]);

        if (!empty($loginCode)){
            if (LoginCode::updateAll(['code'=>$code],['fgr_id'=>$account_id])){
                return ['code'=>1,'msg'=>'获取成功'];
            }else{
                return ['code'=>0,'msg'=>'获取失败'];
            }
        }else{
            $loginCode->code = $code;
            $loginCode->status = 1;
            $loginCode->created_at = time();
            $loginCode->updated_at = time();
            $loginCode->fgr_id = $account_id;
            if ($loginCode->save()){
                return ['code'=>1,'msg'=>'获取成功'];
            }else{
                return ['code'=>0,'msg'=>'获取失败'];
            }
        }

    }
}