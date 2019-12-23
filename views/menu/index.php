<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/03/06
 * Time: 20:47
 */
use app\assets\MenuAsset;
MenuAsset::register($this);
$this->title = "菜单管理";
?>

<div id="menu-index" class="row" v-cloak>
    <el-dialog title="添加菜单" :visible.sync="dialogAddMenu" width="30%" :show-close="false">
        <addmenu v-on:dialogaddmenustatus="dialogaddmenustatus" :menuname="menuName" :parentid="parentId"></addmenu>
    </el-dialog>

    <el-dialog title="删除提示" :visible.sync="deleteDialog" :show-close="false" width="300px" id="delete_dialog">
        <delmenu :id="id" v-on:dialogdelmenustatus="dialogdelmenustatus"></delmenu>
    </el-dialog>

    <template>
        <button type="button" class="btn btn-primary" @click="addmenu('顶级菜单','0')">添加主菜单</button>
        <el-table
                :data="menus"
                :span-method="objectSpanMethod"
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
                    label="菜单名">
                <template slot-scope="scope">
                    <div :class="scope.row.parent_id == 0?'is_parent':''" @dblclick="edititemdbclick('name',scope.row)" :id="'name'+scope.row.id">{{scope.row.name}}</div>
                </template>
            </el-table-column>
            <el-table-column
                    prop="router"
                    align="center"
                    label="路由地址">
                <template slot-scope="scope">
                    <div :class="scope.row.parent_id == 0?'is_parent':''" @dblclick="edititemdbclick('router',scope.row)" :id="'router'+scope.row.id">{{scope.row.router}}</div>
                </template>
            </el-table-column>
            <el-table-column
                    prop="router"
                    align="center"
                    label="菜单图标">
                <template slot-scope="scope">
                    <div :class="scope.row.parent_id == 0?'is_parent':''" @dblclick="edititemdbclick('icon',scope.row)" :id="'icon'+scope.row.id">{{scope.row.icon}}</div>
                </template>
            </el-table-column>
            <el-table-column
                    prop="sort"
                    align="center"
                    label="排序序号">
                <template slot-scope="scope">
                    <div :class="scope.row.parent_id == 0?'is_parent':''" @dblclick="edititemdbclick('sort',scope.row)" :id="'sort'+scope.row.id">{{scope.row.sort}}</div>
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
                    prop="sort"
                    align="center"
                    label="操作">
                <template slot-scope="scope">
                    <div @click="delmenu(scope.row.id)"><i class="fa fa-trash" aria-hidden="true"></i></div>
                </template>
            </el-table-column>
            <el-table-column
                    width="180"
                    align="center"
                    fixed="right"
                    label="分组名">
                <template slot-scope="scope">
                    <button @click="addmenu(scope.row.name,scope.row.id)" type="button" class="btn btn-primary">
                        {{scope.row.name}}
                        <i class="addmenu fa fa-plus" style="color: #ffffff;" aria-hidden="true"></i>
                    </button>
                </template>
            </el-table-column>
        </el-table>
    </template>
</div>
