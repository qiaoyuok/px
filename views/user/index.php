<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/03/06
 * Time: 20:47
 */

use app\assets\UserAsset;

UserAsset::register($this);
$this->title = "用户管理";
?>

<div id="user-index" class="row" v-cloak>

    <div v-if="userInfo!=''" class="modal fade" id="mainModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="z-index: 9999;width: 700px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">
                        用户详细信息</h4>
                </div>
                <div class="modal-body" style="display: block">
                    <div class="form-group" style="display: flex;justify-content: space-between;padding:0 30px;box-sizing:border-box">
                        <label class="control-label">uid号:</label>
                        <p>{{userInfo.uid}}</p>
                    </div>
                    <div class="form-group" style="display: flex;justify-content: space-between;padding:0 30px;box-sizing:border-box">
                        <label class="control-label">用户uuid号:</label>
                        <p>{{userInfo.uuid}}</p>
                    </div>
                    <div class="form-group" style="display: flex;justify-content: space-between;padding:0 30px;box-sizing:border-box">
                        <label class="control-label">微信联合ID号:</label>
                        <p>{{userInfo.unionid}}</p>
                    </div>
                    <div class="form-group" style="display: flex;justify-content: space-between;padding:0 30px;box-sizing:border-box">
                        <label class="control-label">用户昵称:</label>
                        <p>{{userInfo.nickname}}</p>
                    </div>
                    <div class="form-group" style="display: flex;justify-content: space-between;padding:0 30px;box-sizing:border-box">
                        <label class="control-label">手机号:</label>
                        <p>{{userInfo.tel}}</p>
                    </div>
                    <div class="form-group" style="display: flex;justify-content: space-between;padding:0 30px;box-sizing:border-box">
                        <label class="control-label">国家:</label>
                        <p>{{userInfo.country}}</p>
                    </div>
                    <div class="form-group" style="display: flex;justify-content: space-between;padding:0 30px;box-sizing:border-box">
                        <label class="control-label">省份:</label>
                        <p>{{userInfo.province}}</p>
                    </div>
                    <div class="form-group" style="display: flex;justify-content: space-between;padding:0 30px;box-sizing:border-box">
                        <label class="control-label">城市:</label>
                        <p>{{userInfo.city}}</p>
                    </div>
                    <div class="form-group" style="display: flex;justify-content: space-between;padding:0 30px;box-sizing:border-box">
                        <label class="control-label">性别:</label>
                        <p><i v-if="userInfo.sex==0" class="fa fa-venus" aria-hidden="true"></i>
                            <i v-else-if="userInfo.sex==1" class="fa fa-mars" aria-hidden="true"></i>
                            <i v-else class="fa fa-venus-mars" aria-hidden="true"></i></p>
                    </div>
                    <div class="form-group" style="display: flex;justify-content: space-between;padding:0 30px;box-sizing:border-box">
                        <label class="control-label">状态:</label>
                        <p><span v-if="userInfo.status == 1">
                                <i class="fa fa-check-circle" aria-hidden="true"></i></span>
                            <span v-else>
                                <i class="fa fa-times-circle" aria-hidden="true"></i></span></p>
                    </div>
                    <div class="form-group" style="display: flex;justify-content: space-between;padding:0 30px;box-sizing:border-box">
                        <label class="control-label">注册时间:</label>
                        <p>{{userInfo.created_at|timeTran}}</p>
                    </div>
                    <div class="form-group" style="display: flex;justify-content: space-between;padding:0 30px;box-sizing:border-box">
                        <label class="control-label">上册更新时间:</label>
                        <p>{{userInfo.updated_at|timeTran}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <template>
        <?php require_once Yii::getAlias('@app') . "/views/filter/user.php" ?>
        <el-table
                :data="users"
                border
                style="width: 100%">
            <el-table-column
                    prop="uid"
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
                    prop="uuid"
                    align="center"
                    label="用户唯一标志uuid"
                    width="320">
            </el-table-column>
            <el-table-column
                    prop="nickname"
                    align="center"
                    label="昵称"
                    width="150">
                <template slot-scope="scope">
                    <div @dblclick="edititemdbclick('nickname',scope.row)" :id="'nickname'+scope.row.id">
                        {{scope.row.nickname}}
                    </div>
                </template>
            </el-table-column>
            <el-table-column
                    prop="tel"
                    align="center"
                    label="手机号"
                    width="140">
                <template slot-scope="scope">
                    <div @dblclick="edititemdbclick('tel',scope.row)" :id="'tel'+scope.row.id">
                        {{scope.row.tel}}
                    </div>
                </template>
            </el-table-column>
            <el-table-column
                    prop="sex"
                    align="center"
                    label="性别"
                    width="50">
                <template slot-scope="scope">
                    <i v-if="scope.row.sex==0" class="fa fa-venus" aria-hidden="true"></i>
                    <i v-else-if="scope.row.sex==1" class="fa fa-mars" aria-hidden="true"></i>
                    <i v-else class="fa fa-venus-mars" aria-hidden="true"></i>
                </template>
            </el-table-column>
            <el-table-column
                    prop="city"
                    label="城市"
                    align="center"
                    width="130">
            </el-table-column>
            <el-table-column
                    prop="status"
                    label="用户状态"
                    align="center"
                    width="80">
                <template slot-scope="scope">
                        <span @click="edititemclick('status',scope.row.uid,0)" v-if="scope.row.status == 1"><i
                                    class="fa fa-check-circle" aria-hidden="true"></i></span>
                    <span @click="edititemclick('status',scope.row.uid,1)" v-else><i
                                class="fa fa-times-circle" aria-hidden="true"></i></span>
                </template>
            </el-table-column>
            <el-table-column
                    prop="created_at"
                    label="注册时间"
                    align="center"
                    width="170">
                <template slot-scope="scope">
                    <span>{{scope.row.createed|timeTran}}</span>
                </template>
            </el-table-column>
            <el-table-column
                    fixed="right"
                    align="center"
                    label="操作">
                <template slot-scope="scope">
                    <button data-toggle="modal" data-target="#mainModal" @click="getUserInfo(scope.$index)" type="button" class="btn btn-primary">
                        详情
                    </button>
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
