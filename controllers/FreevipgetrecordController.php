<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/05/21
 * Time: 20:59
 */

namespace app\controllers;

use app\controllers\BaseController;
use app\models\FreevipGetRecord;

class FreevipgetrecordController extends BaseController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * actionGetRecordList          获取已领取会员记录
     * 2019/05/21 21:20
     * @param int $page
     * @param int $limit
     * 15899
     */
    public function actionGetRecordList($page = 1, $limit = 9, $nickname = '', $tel = '', $datetime = '',$account='',$vip_name ='',$accountType='')
    {

        $this->response();

        $vip_names = FreevipGetRecord::find()->select("vip_name")->groupBy('vip_name')->all();
        $accountTypes = FreevipGetRecord::find()->select("accountType")->groupBy('accountType')->all();

        if (!empty($datetime) && $datetime != 'null') {
            $datetime = explode(",", $datetime);

            $start = floor($datetime[0] / 1000);
            $end = floor($datetime[1] / 1000);

            $total = FreevipGetRecord::find()
                ->alias('fgr')
                ->leftJoin('{{%user}} as u', 'u.uuid = fgr.uuid')
                ->leftJoin('{{%freeaccounts}} as fc', 'fc.id = fgr.account_id')
                ->andFilterWhere(['like', 'u.nickname', $nickname])
                ->andFilterWhere(['like', 'u.tel', $tel])
                ->andFilterWhere(['>', 'fgr.created_at', $start])
                ->andFilterWhere(['<', 'fgr.created_at', $end])
                ->andFilterWhere(['like', 'fc.account', $account])
                ->andFilterWhere(['like', 'fgr.vip_name', $vip_name])
                ->andFilterWhere(['like', 'fgr.accountType', $accountType])
                ->count();
            return ['total' => (int)$total,'vip_names'=>$vip_names,'accountType'=>$accountTypes, 'freevipRecordList' => FreevipGetRecord::find()
                ->alias('fgr')
                ->select("fgr.*,u.avatar,u.nickname,fc.account,fc.password")
                ->leftJoin('{{%user}} as u', 'u.uuid = fgr.uuid')
                ->leftJoin('{{%freeaccounts}} as fc', 'fc.id = fgr.account_id')
                ->andFilterWhere(['like', 'u.nickname', $nickname])
                ->andFilterWhere(['like', 'u.tel', $tel])
                ->andFilterWhere(['>', 'fgr.created_at', $start])
                ->andFilterWhere(['<', 'fgr.created_at', $end])
                ->andFilterWhere(['like', 'fc.account', $account])
                ->andFilterWhere(['like', 'fgr.vip_name', $vip_name])
                ->andFilterWhere(['like', 'fgr.accountType', $accountType])
                ->orderBy('created_at desc')
                ->offset(($page - 1) * $limit)
                ->limit($limit)
                ->asArray()
                ->all()];
        } else {
            $total = FreevipGetRecord::find()
                ->alias('fgr')
                ->leftJoin('{{%user}} as u', 'u.uuid = fgr.uuid')
                ->leftJoin('{{%freeaccounts}} as fc', 'fc.id = fgr.account_id')
                ->andFilterWhere(['like', 'u.nickname', $nickname])
                ->andFilterWhere(['like', 'u.tel', $tel])
                ->andFilterWhere(['like', 'u.tel', $tel])
                ->andFilterWhere(['like', 'fc.account', $account])
                ->andFilterWhere(['like', 'fgr.vip_name', $vip_name])
                ->andFilterWhere(['like', 'fgr.accountType', $accountType])
                ->count();
            return ['total' => (int)$total,'vip_names'=>$vip_names,'accountType'=>$accountTypes, 'freevipRecordList' => FreevipGetRecord::find()
                ->alias('fgr')
                ->select("fgr.*,u.avatar,u.nickname,fc.account,fc.password")
                ->leftJoin('{{%user}} as u', 'u.uuid = fgr.uuid')
                ->leftJoin('{{%freeaccounts}} as fc', 'fc.id = fgr.account_id')
                ->andFilterWhere(['like', 'u.nickname', $nickname])
                ->andFilterWhere(['like', 'u.tel', $tel])
                ->andFilterWhere(['like', 'fc.account', $account])
                ->andFilterWhere(['like', 'fgr.vip_name', $vip_name])
                ->andFilterWhere(['like', 'fgr.accountType', $accountType])
                ->orderBy('created_at desc')
                ->offset(($page - 1) * $limit)
                ->limit($limit)
                ->asArray()
                ->all()];
        }
    }

    /**
     * actionEditFreevipRecord                  编辑账号提取记录
     * 2019/05/21 21:56
     * @param int $id
     * @param string $field
     * @param string $value
     * 15899
     */
    public function actionEditFreevipRecord($id = 0, $field = '', $value = '')
    {
        $this->response();
        if (FreevipGetRecord::updateAll(["$field" => $value], ['id' => $id])) {
            return ['code' => 1, 'msg' => '编辑成功'];
        } else {
            return ['code' => 0, 'msg' => '编辑失败'];
        }
    }

}