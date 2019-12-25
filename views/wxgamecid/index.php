<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/03/06
 * Time: 20:47
 */
use app\assets\WxgamecidAsset;
WxgamecidAsset::register($this);
$this->title = "渠道管理";
?>

<div id="wxgamecid-index" class="row" style="padding: 0 15px;box-sizing: border-box" v-cloak>
    <el-dialog title="添加渠道" :visible.sync="dialogAddMenu" width="30%" :show-close="false">
        <addmenu v-on:dialogaddmenustatus="dialogaddmenustatus" :menuname="menuName" :parentid="parentId"></addmenu>
    </el-dialog>

    <el-dialog title="删除提示" :visible.sync="deleteDialog" :show-close="false" width="300px" id="delete_dialog">
        <delmenu :id="id" v-on:dialogdelmenustatus="dialogdelmenustatus"></delmenu>
    </el-dialog>
    <template>
        <button type="button" class="btn btn-primary" @click="addmenu">添加渠道</button>
        <el-table
            :data="menus"
            border
            style="width: 100%; margin-top: 20px">
            <el-table-column
                prop="id"
                label="ID"
                align="center"
                width="180">
            </el-table-column>
            <el-table-column
                prop="name"
                align="center"
                label="渠道名">
                <template slot-scope="scope">
                    <div @dblclick="edititemdbclick('alias',scope.row)" :id="'alias'+scope.row.id">{{scope.row.alias}}</div>
                </template>
            </el-table-column>
            <el-table-column
                prop="router"
                align="center"
                label="渠道值">
                <template slot-scope="scope">
                    <div @dblclick="edititemdbclick('wxgamecid',scope.row)" :id="'wxgamecid'+scope.row.id">{{scope.row.wxgamecid}}</div>
                </template>
            </el-table-column>
            <el-table-column
                prop="status"
                align="center"
                label="状态">
                <template slot-scope="scope">
                    <span @click="edititemclick('status',scope.row.id,0)" v-if="scope.row.status == 1"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
                    <span @click="edititemclick('status',scope.row.id,1)" v-else><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                </template>
            </el-table-column>
            <el-table-column
                prop="status"
                align="center"
                label="添加时间">
                <template slot-scope="scope">
                    <span>{{scope.row.created_at|transTime}}</span>
                </template>
            </el-table-column>
            <el-table-column
                prop="sort"
                align="center"
                label="操作">
                <template slot-scope="scope">
                    <div @click="delmenu(scope.row.id)"><i class="fa fa-trash" aria-hidden="true"></i></div>
                </template>
            </el-table-column>
        </el-table>
    </template>
</div>
