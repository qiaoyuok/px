<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/03/14
 * Time: 20:46
 */

use app\assets\FreevipAsset;

FreevipAsset::register($this);

$this->title = "免费会员配置";
?>
<div id="freevip-index" class="row" v-cloak>

    <el-dialog title="添加会员种类" :visible.sync="dialogAddType" width="30%" :show-close="false">
        <addtype v-on:dialogaddstatus="dialogaddstatus" :unaddedcates="unAddedCates"></addtype>
    </el-dialog>

    <el-dialog title="添加会员" :visible.sync="dialogAdd" width="30%" :show-close="false">
        <add v-on:dialogaddstatus="dialogaddstatus" :config="config"></add>
    </el-dialog>

    <el-dialog title="添加库存" :visible.sync="dialogAddStock" width="30%" :show-close="false">
        <addstock v-on:dialogaddstatus="dialogaddstatus" :vipdata="vipdata"></addstock>
    </el-dialog>

    <el-dialog title="删除提示" :visible.sync="dialogDel" :show-close="false" width="300px" id="delete_dialog">
        <delitem :controller="controller" :url="url" v-on:dialogstatus="dialogstatus"></delitem>
    </el-dialog>

    <div class="modal fade" id="mainModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="z-index: 9999;width: 1000px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">
                        {{currentAccountInfo.vip_name}}{{currentAccountInfo.vipType}}{{currentAccountInfo.accountType}}</h4>
                </div>
                <div class="modal-body">
                    <template>
                        <el-table
                                :data="stock"
                                style="width: 100%"
                        >
                            <el-table-column
                                    prop="id"
                                    label="序号"
                                    sortable
                                    width="90">
                            </el-table-column>
                            <el-table-column
                                    prop="account"
                                    label="账号"
                                    sortable
                                    width="120">
                                <template slot-scope="scope">
                                    <div @dblclick="editStockDbclick('account',scope.row)" :id="'account'+scope.row.id">
                                        {{scope.row.account}}
                                    </div>
                                </template>
                            </el-table-column>
                            <el-table-column
                                    prop="password"
                                    width="120"
                                    label="密码">
                                <template slot-scope="scope">
                                    <div @dblclick="editStockDbclick('password',scope.row)" :id="'password'+scope.row.id">
                                        {{scope.row.password}}
                                    </div>
                                </template>
                            </el-table-column>
                            <el-table-column
                                    prop="account_times"
                                    width="120"
                                    label="剩余提取次数">
                                <template slot-scope="scope">
                                    <div @dblclick="editStockDbclick('account_times',scope.row)" :id="'account_times'+scope.row.id">
                                        {{scope.row.account_times}}
                                    </div>
                                </template>
                            </el-table-column>
                            <el-table-column
                                    prop="code_num"
                                    width="100"
                                    label="提码次数">
                                <template slot-scope="scope">
                                    <div @dblclick="editStockDbclick('code_num',scope.row)" :id="'code_num'+scope.row.id">
                                        {{scope.row.code_num}}
                                    </div>
                                </template>
                            </el-table-column>
                            <el-table-column
                                    prop="status"
                                    label="状态">
                                <template slot-scope="scope">
                                        <span @click="editStock('status',scope.row.id,0)" v-if="scope.row.status == 1"><i
                                                    class="fa fa-check-circle" aria-hidden="true"></i></span>
                                    <span @click="editStock('status',scope.row.id,1)" v-else><i
                                                class="fa fa-times-circle" aria-hidden="true"></i></span>
                                </template>
                            </el-table-column>
                            <el-table-column
                                    prop="created_at"
                                    width="150"
                                    label="添加时间">
                                <template slot-scope="scope">
                                    <span>{{scope.row.created_at|timeTran}}</span>
                                </template>
                            </el-table-column>
                            <el-table-column
                                    prop="updated_at"
                                    width="150"
                                    label="更新时间">
                                <template slot-scope="scope">
                                    <span>{{scope.row.updated_at|timeTran}}</span>
                                </template>
                            </el-table-column>
                        </el-table>
                        <div class="pagination">
                            <el-pagination
                                    background
                                    layout="total, prev, pager, next, jumper"
                                    :current-page="page"
                                    @current-change="pageChange"
                                    :total="total">
                            </el-pagination>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <el-tabs type="border-card" style="max-width: 1550px;">
        <el-tab-pane label="会员种类">
            <div class="row" style="padding: 10px 30px;">
                <button type="button" @click="addtype" class="btn btn-primary">添加种类</button>
            </div>
            <el-tabs>
                <el-tab-pane v-for="(item,index) in addedCase" :label="item.cate_name">
                    <div class="row" style="padding: 10px 30px;">
                        <button type="button" @click="add(index)" class="btn btn-primary">添加会员</button>
                        <div style="padding: 10px 0 0 0;">
                            <p style="color: #535353;">
                                <b>登录方式</b>：<span>0：直接显示账号密码或CDK；1：需要获取手机验证码；2：需要获取乐视免验证登录卡密</span></p>
                            <p style="color: #535353;"><b>领取次数/时段</b>：<span>每时段该会员最多发放多少次卡</span></p>
                            <p style="color: #535353;"><b>登录次数</b>：<span>该账号允许获取验证码次数（乐视、手机接码登录）</span></p>
                            <p style="color: #535353;"><b>提取次数</b>：<span>该账号可以被发放多少次</span></p>
                            <p style="color: red"><b>注意</b>：<span>每次添加库存前确保当前配置适用</span></p>
                        </div>
                    </div>
                    <template>
                        <el-table
                                :data="alsoconfigs[index]"
                                :span-method="objectSpanMethod"
                                border
                                style="margin-top: 20px">
                            <el-table-column
                                    prop="id"
                                    fixed
                                    label="会员种类"
                                    align="center"
                                    width="90">
                                <template slot-scope="scope">
                                    <img type="primary" :style="logostyle" :src="qiniu+scope.row.logo+'?v='+<?= time() ?>" onerror="this.src='/images/viplogo/account_logo.png'" alt="" class="logo-img">
                                    <br> {{scope.row.vip_name}}
                                </template>
                            </el-table-column>
                            <el-table-column
                                    prop="viptime"
                                    align="center"
                                    width="80"
                                    label="时长">
                                <template slot-scope="scope">
                                    <div @dblclick="edititemdbclick('viptime',scope.row)" :id="'viptime'+scope.row.id">
                                        <span v-if="scope.row.viptime==''">会员时长</span>
                                        <span v-else>{{scope.row.viptime}}</span>
                                    </div>
                                </template>
                            </el-table-column>
                            <el-table-column
                                    prop="accountType"
                                    align="center"
                                    width="80"
                                    label="账号类型">
                            </el-table-column>
                            <el-table-column
                                    prop="vipType"
                                    width="80"
                                    align="center"
                                    label="会员类型">
                            </el-table-column>
                            <el-table-column
                                    prop="account_times"
                                    align="center"
                                    width="110"
                                    label="提取次数/账号">
                                <template slot-scope="scope">
                                    <div @dblclick="edititemdbclick('account_times',scope.row)" :id="'account_times'+scope.row.id">
                                        {{scope.row.account_times}}
                                    </div>
                                </template>
                            </el-table-column>
                            <el-table-column
                                    prop="code_num"
                                    align="center"
                                    width="90"
                                    label="登录次数">
                                <template slot-scope="scope">
                                    <div @dblclick="edititemdbclick('code_num',scope.row)" :id="'code_num'+scope.row.id">
                                        {{scope.row.code_num}}
                                    </div>
                                </template>
                            </el-table-column>
                            <el-table-column
                                    prop="login_help"
                                    align="center"
                                    width="90"
                                    label="登录方式">
                                <template slot-scope="scope">
                                    <div @dblclick="edititemdbclick('login_help',scope.row)" :id="'login_help'+scope.row.id">
                                        {{scope.row.login_help}}
                                    </div>
                                </template>
                            </el-table-column>
                            <el-table-column
                                    prop="item_count"
                                    align="center"
                                    width="110"
                                    label="领取次数/时段">
                                <template slot-scope="scope">
                                    <div @dblclick="edititemdbclick('item_count',scope.row)" :id="'item_count'+scope.row.id">
                                        {{scope.row.item_count}}
                                    </div>
                                </template>
                            </el-table-column>
                            <el-table-column
                                    prop="allAccountStock"
                                    align="center"
                                    width="110"
                                    label="累计添加账号">
                            </el-table-column>
                            <el-table-column
                                    prop="accountStock"
                                    align="center"
                                    width="80"
                                    label="账号库存">
                            </el-table-column>
                            <el-table-column
                                    prop="getVipStock"
                                    align="center"
                                    width="100"
                                    label="可领取次数">
                            </el-table-column>
                            <el-table-column
                                    prop="endTime"
                                    align="center"
                                    width="160"
                                    label="账号到期时间">
                                <template slot-scope="scope">
                                    <span>{{scope.row.endTime|timeTran}}</span>
                                </template>
                            </el-table-column>
                            <el-table-column
                                    prop="status"
                                    align="center"
                                    width="60"
                                    label="状态">
                                <template slot-scope="scope">
                                        <span @click="edititemclick('status',scope.row.id,0)" v-if="scope.row.status == 1"><i
                                                    class="fa fa-check-circle" aria-hidden="true"></i></span>
                                    <span @click="edititemclick('status',scope.row.id,1)" v-else><i
                                                class="fa fa-times-circle" aria-hidden="true"></i></span>
                                </template>
                            </el-table-column>
                            <el-table-column
                                    align="center"
                                    fixed="right"
                                    width="400"
                                    label="操作">
                                <template slot-scope="scope">
                                    <button type="button" @click="copyGoods(scope.row.id)" class="btn btn-primary">
                                        复制
                                    </button>
                                    <button type="button" data-toggle="modal" data-target="#mainModal" @click="showStock(scope.row)" class="btn btn-primary">
                                        查看库存
                                    </button>
                                    <button type="button" @click="addstock(scope.row)" class="btn btn-primary">
                                        添加库存
                                    </button>
                                    <button type="button" @click="delaccount(scope.row.id)" class="btn btn-danger">
                                        删除
                                    </button>
                                </template>
                            </el-table-column>
                        </el-table>
                    </template>
                </el-tab-pane>
            </el-tabs>
        </el-tab-pane>
        <el-tab-pane label="时间轴">
            <div class="row">
                <el-card class="box-card">
                    <div slot="header" class="clearfix">
                        <span>选择时间间隔</span>
                    </div>
                    <div>
                        <el-radio v-for="i in 4" @change="timeselect" v-model="selectedtimespace" :label="i" border>
                            时间间隔{{i}}小时
                        </el-radio>
                    </div>
                </el-card>
            </div>
            <div class="row time-box">
                <el-card class="box-card">
                    <div slot="header" class="clearfix">
                        <span>抢购时间线</span>
                    </div>
                    <div v-for="(item,index) in timeconfig" :class="'time_space '+ item.is_active">
                        <span class="time">{{item.time}}</span> <span class="des">{{item.status}}</span>
                    </div>
                </el-card>
            </div>
        </el-tab-pane>
    </el-tabs>
</div>
