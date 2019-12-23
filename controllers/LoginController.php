<?php
/**
 ************************************
 *           Author: sunqiaoyu      *
 *         Date: 2019/03/05 18:29   *
 * **********************************
 **/

namespace app\controllers;
use yii\web\Controller;
use Yii;
use app\models\LoginForm;

class LoginController extends Controller
{

    /**
     * actionLogin          用户登录操作
     * Date: 2019/03/05
     * Author: sunqiaoyu
     * @return string|Response
     */
    public function actionIn()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->renderPartial('login', [
            'model' => $model,
        ]);
    }

    /**
     * actionLogout         用户退出操作
     * Date: 2019/03/05
     * Author: sunqiaoyu
     * @return Response
     */
    public function actionOut()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
