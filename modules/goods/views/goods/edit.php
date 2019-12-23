<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/05/11
 * Time: 10:54
 */

use app\assets\GoodsaddAppAsset;

GoodsaddAppAsset::register($this);
$this->title = "商品管理";
?>
<script>
    var token = "<?= $token ?>";
    var goods = <?= json_encode($goods) ?>;
</script>
<div id="goods-add-app" class="row" v-cloak>
    <div class="row header-option-box">
        <button type="button" class="btn btn-primary" onclick="javascript:history.back(-1)">返回</button>
    </div>
    <div class="modal fade" id="mainModal" tabindex="-1" role="dialog" style="z-index:2001">
        <div class="modal-dialog" role="document" style="z-index: 9999">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">账号时长选择器</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group" style="display: flex;flex-direction: column">
                        <span class="demonstration">账号时长选择器: <b style="color: red">{{goods.attributes[nowAttrIndex].attribute}}</b></span>
                        <el-slider @change="slideChange" style="flex-grow: 1;" :format-tooltip="toolTip" v-model="goods.attributes[nowAttrIndex].originAttribute"></el-slider>
                        <div style="flex-grow1;display: flex">
                            <p style="width: 23%;background: #1ec9d0;display: flex;justify-content: space-between;color: #fff;"><span>0</span><span>小时</span><span></span></p>
                            <p style="width: 29%;background: #4a8dd0;display: flex;justify-content: space-between;color: #fff;"><span>1</span><span>天</span><span></span></p>
                            <p style="width: 11%;background: #486ad0;display: flex;justify-content: space-between;color: #fff;"><span>1</span><span>月</span><span></span></p>
                            <p style="flex-grow: 1;background: #2315d0;display: flex;justify-content: space-between;color: #fff;"><span>1</span><span>年</span><span></span></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">确定</button>
                </div>
            </div>
        </div>
    </div>
    <div class="add-box row">
        <el-form ref="goods" :model="goods" label-width="80px" inline="true" :rules="rules" class="col-md-9">
            <div class="col-md-6">
                <el-form-item label="商品类型" prop="goodsType">
                    <el-radio-group v-model="goods.goodsType">
                        <el-radio :label="1" v-if="goods.goodsType==1">会员账号类</el-radio>
                        <el-radio :label="2" v-if="goods.goodsType==2">普通商品</el-radio>
                    </el-radio-group>
                </el-form-item>
                <br>
                <el-form-item label="商品名称" prop="goodsName">
                    <el-input v-model="goods.goodsName"></el-input>
                    <input hidden v-model="goods.id"></input>
                </el-form-item>
                <br>
                <el-form-item label="商品分类" prop="cateId">
                    <el-select v-model="goods.parent_cate_id" placeholder="请选择顶级分类">
                        <el-option v-for="(item,index) in parentCates" :label="item.cate_name" :value="item.id"></el-option>
                    </el-select>
                    <el-select v-model="goods.cateId" placeholder="请选择子分类">
                        <el-option v-for="(item,index) in childCates" :label="item.cate_name" :value="item.id"></el-option>
                    </el-select>
                </el-form-item>
                <br v-if="goods.goodsType==1">
                <el-form-item label="账号类型" v-if="goods.goodsType==1" prop="accountType">
                    <el-radio-group v-model="goods.accountType">
                        <el-radio v-for="(item,index) in accountTypes" :label="item">{{item|accountFilter(baseConfig.accountType)}}</el-radio>
                    </el-radio-group>
                </el-form-item>
                <br v-if="goods.goodsType==1">
                <el-form-item label="会员类型" v-if="goods.goodsType==1" prop="vipType">
                    <el-radio-group v-model="goods.vipType">
                        <el-radio v-for="(item,index) in vipTypes" :label="item">{{item|accountFilter(baseConfig.vipType)}}</el-radio>
                    </el-radio-group>
                </el-form-item>
                <br>
                <el-form-item label="支持分期" prop="fenqi">
                    <el-checkbox-group v-model="goods.fenqi">
                        <el-checkbox  v-for="(item,index) in fenqis" :label="item" name="type">{{item|accountFilter(baseConfig.fenqi)}}</el-checkbox>
                    </el-checkbox-group>
                </el-form-item>
                <br>
                <el-form-item label="商品库存" prop="stock">
                    <el-input v-model="goods.stock"></el-input>
                </el-form-item>
                <br>
                <el-form-item label="提取次数" v-if="goods.goodsType==1" prop="everyTimes">
                    <el-select v-model="goods.everyTimes" placeholder="请选择提取次数">
                        <el-option v-for="index in 10" :label="index+'次'" :value="index"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="登录方式" v-if="goods.goodsType==1" prop="loginHelp">
                    <el-select v-model="goods.loginHelp" placeholder="请选择登录方式">
                        <el-option label="账号密码直接登录" value="0"></el-option>
                        <el-option label="手机接码" value="1"></el-option>
                        <el-option label="乐视预登陆码" value="2"></el-option>
                    </el-select>
                </el-form-item>
                <br v-if="goods.goodsType==1">
                <el-form-item label="登录次数" v-if="goods.goodsType==1">
                    <el-select v-model="goods.loginTimes" placeholder="请选择登录次数">
                        <el-option v-for="index in 10" :label="index+'次'" :value="index"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="是否上架">
                    <el-switch v-model="goods.status" active-value="1" inactive-value="0"></el-switch>
                </el-form-item>
                <br>
                <hr>
                <el-form-item v-if="goods.goodsType==1" label="到期时间">
                    <div class="block">
                        <el-date-picker
                                v-model="goods.endTime"
                                type="datetime"
                                format="yyyy-MM-dd HH:mm:ss"
                                value-format="yyyy-MM-dd HH:mm:ss"
                                placeholder="选择日期时间">
                        </el-date-picker>
                    </div>
                </el-form-item>
                <br v-if="goods.goodsType==1">
                <block v-for="(attribute, index) in goods.attributes">
                    <el-form-item
                            label="属性"
                            label-width="65px"
                            :prop="'attributes.'+index+'.attribute'"
                            :rules="{
                              required: true, message: '属性不能为空', trigger: 'blur'
                            }">
                        <el-input data-toggle="modal" v-if="goods.goodsType==1" data-target="#mainModal" @focus="setAttrIndex(index)" v-model="attribute.attribute" style="max-width: 80px"></el-input>
                        <el-input data-toggle="modal"v-if="goods.goodsType==2" v-model="attribute.attribute" style="max-width: 80px"></el-input>
                    </el-form-item>
                    <el-form-item
                            label="现价"
                            label-width="65px"
                            :rules="{
                              required: true, message: '价格不能为空', trigger: 'blur'
                            }"
                            :prop="'attributes.'+index+'.price'">
                        <el-input v-model="attribute.price" style="max-width: 80px"></el-input>
                    </el-form-item>
                    <el-form-item
                            label="原价"
                            label-width="65px"
                            :prop="'attributes.'+index+'.originPrice'">
                        <el-input v-model="attribute.originPrice" style="max-width: 80px"></el-input>
                        <button type="button" class="btn btn-danger" @click.prevent="removeDomain(attribute)">删除</button>
                    </el-form-item>
                </block>
                <el-form-item>
                    <button type="button" class="btn btn-primary" @click="addDomain">新增价格属性</button>
                </el-form-item>
                <hr>
                <br>
                <el-form-item label="轮播图">
                    <el-upload
                            action="https://upload.qiniup.com?"
                            list-type="picture-card"
                            :data="extraData"
                            :on-success="updateSuccess"
                            :file-list="goods.images"
                            :on-preview="handlePictureCardPreview"
                            :before-upload="setKey"
                            :on-remove="handleRemove">
                        <i class="el-icon-plus"></i>
                    </el-upload>
                    <el-dialog :visible.sync="dialogVisible">
                        <img width="100%" :src="dialogImageUrl" alt="">
                    </el-dialog>
                </el-form-item>
                <br>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit">提交修改</el-button>
                    <el-button type="button" onclick="javascript:history.back(-1)">取消</el-button>
                </el-form-item>
            </div>
            <div class="col-md-6">
                <el-form-item label="商品详情">
                    <script style="min-width: 800px;" v-model="goods.content" id="goods-edit" type="text/plain">{{goods.content}}</script>
                </el-form-item>
            </div>
        </el-form>
    </div>
</div>
