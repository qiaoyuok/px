<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/05/11
 * Time: 10:54
 */

use app\assets\FeedbackAppAsset;

FeedbackAppAsset::register($this);
$this->title = "用户反馈中心";
?>

<div class="row" id="feedback-app" v-cloak>

    <!--    账号信息-->
    <!--    账号类型；0：直接显示账号密码或CDK；1：需要获取手机验证码；2：需要获取乐视免验证登录卡密-->
    <div class="modal fade" id="accountModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="z-index: 9999;width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">账号详细信息</h4>
                </div>
                <div class="modal-body" style="display: block">
                    <div class="form-group" style="display: flex;justify-content: space-between">
                        <label class="control-label">平台名称:</label>
                        <p>{{accountInfo.vip_name}}</p>
                    </div>
                    <div class="form-group" style="display: flex;justify-content: space-between">
                        <label class="control-label">使用方式:</label>
                        <p>{{accountInfo.accountType}}</p>
                    </div>
                    <div class="form-group" style="display: flex;justify-content: space-between">
                        <label class="control-label">账号类型:</label>
                        <p>{{accountInfo.vipType}}</p>
                    </div>
                    <div class="form-group" style="display: flex;justify-content: space-between">
                        <label class="control-label">会员天数:</label>
                        <p>{{accountInfo.viptime}}</p>
                    </div>
                    <div class="form-group" style="display: flex;justify-content: space-between">
                        <label class="control-label">账号:</label>
                        <p>{{accountInfo.account}}</p>
                    </div>
                    <div class="form-group" style="display: flex;justify-content: space-between">
                        <label class="control-label">密码:</label>
                        <p>{{accountInfo.password}}</p>
                    </div>
                    <div class="form-group" style="display: flex;justify-content: space-between">
                        <label class="control-label">领取时间:</label>
                        <p>{{accountInfo.fgrcreated_at|getLocalTime}}</p>
                    </div>
                    <div class="form-group" v-if="accountInfo.login_help == 2" style="display: flex;justify-content: space-between">
                        <label class="control-label">剩余接码次数:</label>
                        <div style="display: flex;padding: 0 10px;align-items: center"><p style="margin: 0;">{{accountInfo.code_num}}</p>
                            <el-tag style="margin: 0 10px;">{{accountInfo.code}}</el-tag>
                            <el-button type="text" @click="getloginCode(accountInfo.fgrid)">获取登录码</el-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--    反馈回复-->
    <div class="modal fade" id="mainModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="z-index: 9999">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">用户反馈详情</h4>
                </div>
                <div class="modal-body">
                    <div class="feedbacklist">
                        <div class="item" v-for="(item,index) in feedbackInfo">
                            <div class="line">
                                <i class="fa fa-circle ing" aria-hidden="true"></i>
                                <p class="feedback-line" style="margin: 0"></p>
                            </div>
                            <div class="des">
                                <div class="time">
                                    <span>反馈时间：{{item.created_at|getLocalTime}}</span>
                                    <p>
                                        <i v-if="currentIndex === index" class="fa fa-circle" style="font-size: 14px;color: green" aria-hidden="true"></i>
                                        <el-button v-if="item.status == 0" @click="getFeedback(item.id,index)" type="text" style="color: red">
                                            回复
                                        </el-button>
                                        <el-button v-else @click="getFeedback(item.id,index)" type="text" style="color: green">
                                            补充回复
                                        </el-button>
                                    </p>
                                </div>
                                <div class="main-content">
                                    {{item.content}}
                                </div>
                                <div class="replylist" v-if="item.children.length>0">
                                    <div class="item" style="padding: 8px;display: flex;flex-direction: column" v-for="(v,i) in item.children">
                                        <div class="time" style="background: #fff;">
                                            <span>回复时间：{{v.created_at|getLocalTime}}</span>
                                            <p style="padding: 5px 0;margin: 0;">
                                                <i v-if="currentIndex === index && currentCIndex === i" class="fa fa-circle" style="font-size: 14px;color: green" aria-hidden="true"></i>
                                                <i @click="delFeedbackReply(v.id)" class="delfa fa fa-trash" aria-hidden="true"></i>
                                                <i @click="getFeedbackReply(v.id,index,i)" class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </p>
                                        </div>
                                        <div style="color: #fff;" class="main-content replyContent" v-html="v.content">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <script id="feedback-reply-container" v-model="feedbackInfo.content" type="text/plain">

                        </script>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary" @click="submitConfirm">提交回复</button>
                </div>
            </div>
        </div>
    </div>
    <template>
        <?php require_once Yii::getAlias('@app') . "/views/filter/user.php" ?>
        <el-table
                :data="feedbackList"
                border
                style="width: 100%">
            <el-table-column
                    prop="id"
                    label="序号"
                    align="center"
                    width="80">
            </el-table-column>
            <el-table-column
                    prop="avatar"
                    align="center"
                    label="用户头像"
                    width="90">
                <template slot-scope="scope">
                    <img :style="avatarstyle" :src="scope.row.avatar" alt="">
                </template>
            </el-table-column>
            <el-table-column
                    prop="nickname"
                    align="center"
                    label="昵称"
                    width="150">
            </el-table-column>
            <el-table-column
                    prop="tel"
                    align="center"
                    label="手机号"
                    width="140">
            </el-table-column>
            <el-table-column
                    prop="type"
                    align="center"
                    label="反馈类型"
                    width="140">
                <template slot-scope="scope">
                    <el-button v-if="scope.row.type == 1" @click="viewAccountInfo(scope.row.account_id)" data-toggle="modal" data-target="#accountModal" type="text">
                        查看账号信息
                    </el-button>
                    <span v-else-if="scope.row.type == 2">应用反馈</span>
                </template>
            </el-table-column>
            <el-table-column
                    prop="content"
                    align="center"
                    label="反馈内容"
                    width="440">
            </el-table-column>
            <el-table-column
                    prop="status"
                    align="center"
                    label="状态"
                    width="50">
                <template slot-scope="scope">
                    <span v-if="scope.row.status == 1"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
                    <span v-else><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                </template>
            </el-table-column>
            <el-table-column
                    prop="created_at"
                    align="center"
                    label="反馈时间"
                    width="160">
                <template slot-scope="scope">
                    <span>{{scope.row.created_at|getLocalTime}}</span>
                </template>
            </el-table-column>
            <el-table-column
                    prop="updated_at"
                    align="center"
                    label="回复时间"
                    width="160">
                <template slot-scope="scope">
                    <span v-if="scope.row.status == 1">{{scope.row.updated_at|getLocalTime}}</span>
                    <span v-else style="color: red">等待回复</span>
                </template>
            </el-table-column>
            <el-table-column
                    align="center"
                    label="操作">
                <template slot-scope="scope">
                    <i @click="delFeedback(scope.row.id)" class="delfa fa fa-trash" aria-hidden="true"></i>
                    <i @click="getFeedbackInfo(scope.row.account_id,scope.row.uuid)" data-toggle="modal" data-target="#mainModal" class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </template>
            </el-table-column>
        </el-table>
    </template>
    <div class="pagination">
        <el-pagination
                background
                layout="total, prev, pager, next, jumper"
                :page-size="limit"
                @current-change="pageChange"
                :total="total">
        </el-pagination>
    </div>
</div>
</div>
