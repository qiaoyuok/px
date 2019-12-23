<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/03/06
 * Time: 20:47
 */

use app\assets\AccountcateAsset;

AccountcateAsset::register($this);
$this->title = "分类管理";
?>

<div id="accountcate-index" class="row" v-cloak>
    <el-dialog title="添加分类" :visible.sync="dialogAddCate" width="30%" :show-close="false">
        <addcate v-on:dialogaddcatetatus="dialogaddcatetatus" :parentname="parentname" :parentid="parentid"></addcate>
    </el-dialog>

    <el-dialog title="删除提示" :visible.sync="deleteDialog" :show-close="false" width="300px" id="delete_dialog">
        <delmenu :id="id" v-on:dialogdelcatestatus="dialogdelcatestatus"></delmenu>
    </el-dialog>
    <template>
        <div class="header-input-search">
            <div class="row">
                <button type="button" @click="addcate('顶级分类',0)" class="btn btn-primary">添加分类</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                <el-tree :data="cates" :props="cates" accordion :default-expand-all="true" :expand-on-click-node="false">
                    <template slot-scope="{node,data}">
                        <div class="accountcate">
                            <span>{{data.cate_name}}</span>
                            <div>
                                <i class="fa fa-arrow-down" @click="editcateitem('sort',-0.01,data.id)" aria-hidden="true"></i>
                                <i class="fa fa-arrow-up" @click="editcateitem('sort',0.01,data.id)" aria-hidden="true"></i>
                                <i v-if="data.parent_id==0" @click="addcate(data.cate_name,data.id)" class="fa fa-plus-circle" aria-hidden="true"></i>
                                <i v-if="data.status==1" @click="editcateitem('status',0,data.id)" class="fa fa-check-circle" aria-hidden="true"></i>
                                <i v-else @click="editcateitem('status',1,data.id)" class="fa fa-times-circle" aria-hidden="true"></i>
                                <i @click="delcate(data.id)" class="fa fa-trash" aria-hidden="true"></i>
                            </div>
                        </div>
                    </template>
                </el-tree>
            </div>
        </div>
    </template>
</div>