<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/03/14
 * Time: 20:46
 */

use app\assets\FreevipgetrecordAsset;

FreevipgetrecordAsset::register($this);

$this->title = "账号提取记录";
?>

<div class="row" id="freevipgetrecord-app" v-cloak>

    <template>
        <?php  require_once Yii::getAlias('@app')."/views/filter/freeaccounts.php" ?>
        <el-table
            :data="freevipgetrecordlist"
            border
            style="width: 100%">
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
                width="100">
            </el-table-column>
            <el-table-column
                    prop="vip_name"
                    align="center"
                    label="平台"
                    width="100">
            </el-table-column>
            <el-table-column
                prop="accountType"
                align="center"
                label="账号类型"
                width="110">
            </el-table-column>
            <el-table-column
                prop="vipType"
                align="center"
                label="会员类型"
                width="120">
            </el-table-column>
            <el-table-column
                prop="viptime"
                align="center"
                label="会员时长"
                width="90">
            </el-table-column>
            <el-table-column
                prop="account"
                align="center"
                label="账号"
                width="140">
            </el-table-column>
            <el-table-column
                prop="password"
                align="center"
                label="密码"
                width="140">
            </el-table-column>
            <el-table-column
                prop="code_num"
                align="center"
                label="剩余接码次数"
                width="130">
                <template slot-scope="scope">
                    <div @dblclick="edititemdbclick('code_num',scope.row)" :id="'code_num'+scope.row.id">
                        {{scope.row.code_num}}
                    </div>
                </template>
            </el-table-column>
            <el-table-column
                prop="login_help"
                align="center"
                label="登录方式"
                width="90">
                <template slot-scope="scope">
                    <div @dblclick="edititemdbclick('login_help',scope.row)" :id="'login_help'+scope.row.id">
                        {{scope.row.login_help}}
                    </div>
                </template>
            </el-table-column>
            <el-table-column
                prop="created_at"
                align="center"
                label="领取时间"
                width="160">
                <template slot-scope="scope">
                    <span>{{scope.row.created_at|timeTran}}</span>
                </template>
            </el-table-column>
            <el-table-column
                prop="updated_at"
                align="center"
                label="登录时间"
                width="160">
                <template slot-scope="scope">
                    <span>{{scope.row.updated_at|timeTran}}</span>
                </template>
            </el-table-column>
            <el-table-column
                prop="status"
                align="center"
                label="状态">
                <template slot-scope="scope">
                    <span @click="edititemclick('status',scope.row.id,0)" v-if="scope.row.status == 1">
                        <i class="fa fa-check-circle" aria-hidden="true"></i></span>
                    <span @click="edititemclick('status',scope.row.id,1)" v-else><i
                            class="fa fa-times-circle" aria-hidden="true"></i></span>
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
