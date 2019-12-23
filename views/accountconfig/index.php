<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/03/06
 * Time: 20:47
 */

use app\assets\AccountconfigAsset;
use yii\helpers\Url;

AccountconfigAsset::register($this);
$this->title = "账号配置";
?>
<script>
    var token = "<?= $token ?>";
</script>
<div id="accountconfig-index" class="row" v-cloak>
    <el-dialog title="添加账号允许类型" :visible.sync="dialogAdd" width="30%" :show-close="false">
        <add v-on:dialogaddstatus="dialogaddstatus" :cateId="cateId" :field="field" :des="des"></add>
    </el-dialog>
    <el-dialog title="删除提示" :visible.sync="dialogDel" :show-close="false" width="300px" id="delete_dialog">
        <delitem :controller="controller" :url="url" v-on:dialogstatus="dialogstatus"></delitem>
    </el-dialog>
    <el-tabs type="border-card">
        <el-tab-pane v-for="(item,index) in accountCates" :label="item.cate_name">
            <el-tabs>
                <el-tab-pane v-for="(v,i) in item.children" :label="v.cate_name">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <el-card class="box-card" style="margin-bottom: 10px;">
                                    <div slot="header" class="clearfix">
                                        <span class="card-title">账号分期付款</span>
                                        <div class="el-card__header_option">
                                            <i @click="addConfig(v.id,'fenqi','账号分几期付款')" class="fa fa-plus-circle"
                                               aria-hidden="true"></i>
                                            <i @click="delConfig(index,i,v.id,'fenqi')" class="fa fa-trash"
                                               aria-hidden="true"></i>
                                            <el-button style="float: right; padding: 3px 0" type="text"
                                                       @click="saveConfig(index,i,v.id,'fenqi')">配置
                                            </el-button>
                                        </div>
                                    </div>
                                    <el-checkbox-group  class="fenqi" v-model="v.config.fenqi">
                                        <el-checkbox v-for="(citem,cindex) in accountBaseConfig.fenqi"
                                                     :label="citem.index" border>{{citem.value}}
                                        </el-checkbox>
                                    </el-checkbox-group>
                                </el-card>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <el-card class="box-card" style="margin-bottom: 10px;">
                                    <div slot="header" class="clearfix">
                                        <span class="card-title">VIP类型</span>
                                        <div class="el-card__header_option">
                                            <i @click="addConfig(v.id,'vipType','VIP类型')" class="fa fa-plus-circle"
                                               aria-hidden="true"></i>
                                            <i @click="delConfig(index,i,v.id,'vipType')" class="fa fa-trash"
                                               aria-hidden="true"></i>
                                            <el-button style="float: right; padding: 3px 0" type="text"
                                                       @click="saveConfig(index,i,v.id,'vipType')">配置
                                            </el-button>
                                        </div>
                                    </div>
                                    <el-checkbox-group  class="fenqi" v-model="v.config.vipType">
                                        <el-checkbox v-for="(citem,cindex) in accountBaseConfig.vipType"
                                                     :label="citem.index" border>{{citem.value}}
                                        </el-checkbox>
                                    </el-checkbox-group>
                                </el-card>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <el-card class="box-card" style="margin-bottom: 10px;">
                                    <div slot="header" class="clearfix">
                                        <span class="card-title">Logo图片</span>
                                    </div>
                                    <el-upload class="upload-demo"
                                               ref="upload"
                                               :data="extraData"
                                               :on-success="updateSuccess"
                                               :show-file-list="false"
                                               action="https://upload.qiniup.com?">
                                        <img @click="setKey(v.cate_name,v.id)" class="logo-img" type="primary" :src="qiniu+v.config.logo" onerror="this.src='/images/viplogo/account_logo.png'" alt="">
                                    </el-upload>
                                </el-card>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <el-card class="box-card" style="margin-bottom: 10px;">
                                    <div slot="header" class="clearfix">
                                        <span class="card-title">平台横图</span>
                                    </div>
                                    <el-upload class="upload-demo"
                                               ref="upload"
                                               :data="extraData"
                                               :on-success="swiperUpdateSuccess"
                                               :show-file-list="false"
                                               action="https://upload.qiniup.com?">
                                        <img @click="setSwiperKey(v.cate_name,v.id)" class="swiper-img" type="primary" :src="qiniu+v.config.swiper" onerror="this.src='/images/swiper.jpg'" alt="">
                                    </el-upload>
                                </el-card>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <el-card class="box-card" style="margin-bottom: 10px;">
                                    <div slot="header" class="clearfix">
                                        <span class="card-title">账号允许类型</span>
                                        <div class="el-card__header_option">
                                            <i @click="addConfig(v.id,'accountType','账号允许类型')"
                                               class="fa fa-plus-circle" aria-hidden="true"></i>
                                            <i @click="delConfig(index,i,v.id,'accountType')" class="fa fa-trash"
                                               aria-hidden="true"></i>
                                            <el-button style="float: right; padding: 3px 0" type="text"
                                                       @click="saveConfig(index,i,v.id,'accountType')">配置
                                            </el-button>
                                        </div>
                                    </div>
                                    <el-checkbox-group  class="fenqi" v-model="v.config.accountType">
                                        <el-checkbox v-for="(citem,cindex) in accountBaseConfig.accountType"
                                                     :label="citem.index" border>{{citem.value}}
                                        </el-checkbox>
                                    </el-checkbox-group>
                                </el-card>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <el-card class="box-card" style="margin-bottom: 10px;">
                                <div slot="header" class="clearfix">
                                    <span class="card-title">当前会员使用介绍</span>
                                    <div class="el-card__header_option">
                                        <el-button style="float: right; padding: 3px 0" type="text"
                                                   @click="saveConfig(index,i,v.id,'content')">配置
                                        </el-button>
                                    </div>
                                </div>
                                <script :id="'container'+item.id+''+v.id" v-model="v.config.content" type="text/plain">
                                    {{v.config.content}}
                                </script>
                            </el-card>
                        </div>
                    </div>
                </el-tab-pane>
            </el-tabs>
        </el-tab-pane>
    </el-tabs>
</div>