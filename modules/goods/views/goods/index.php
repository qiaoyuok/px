<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/05/11
 * Time: 10:54
 */

use app\assets\GoodsAppAsset;
use yii\helpers\Url;
GoodsAppAsset::register($this);
$this->title = "商品管理";
?>
<style>
    .el-table .common-type-row{
        background: #f0f9eb;
    }
    .el-table .cell{
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<div class="row" id="goods-index-app">
    <div class="row" style="margin-bottom: 20px">
        <a type="button" class="btn btn-primary" href="<?= Url::to('/goods/goods/add') ?>">添加商品</a>
    </div>

    <div class="modal fade" id="mainModal" tabindex="-1" role="dialog" style="z-index:2001">
        <div class="modal-dialog" role="document" style="z-index: 9999">
            <div class="modal-content" style="max-width:900px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">添加账号库存 <span style="color: #13e2ff">{{row.parent_cate_id|cateFilter(parentCates,1)}}{{row.cateId|cateFilter(parentCates,0)}}{{row.accountType|accountFilter(baseConfig.accountType)}}{{row.vipType|accountFilter(baseConfig.vipType)}}{{row.goodsName}}</span></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea name="" v-model="accounts" id="" cols="80" rows="30"></textarea>
                        <p style="color: red">支持添加多个账号密码/CDK激活码/手机号<br>以行为单位 <br>账号密码请使用分隔符 '----'</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="addStockSubmit">确定</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="cancelAdd">取消</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="stockMainModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="z-index: 9999;width: 1000px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">{{row.parent_cate_id|cateFilter(parentCates,1)}}{{row.cateId|cateFilter(parentCates,0)}}{{row.accountType|accountFilter(baseConfig.accountType)}}{{row.vipType|accountFilter(baseConfig.vipType)}}{{row.goodsName}}</h4>
                </div>
                <div class="modal-body" style="display: flex;flex-direction: column">
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
                            <template  slot-scope="scope">
                                <span>{{scope.row.created_at|timeTran}}</span>
                            </template>
                        </el-table-column>
                        <el-table-column
                                prop="updated_at"
                                width="150"
                                label="更新时间">
                            <template  slot-scope="scope">
                                <span>{{scope.row.updated_at|timeTran}}</span>
                            </template>
                        </el-table-column>
                    </el-table>
                    <div class="pagination">
                        <el-pagination
                                background
                                layout="total, prev, pager, next, jumper"
                                :current-page="stockPage"
                                @current-change="stockPageChange"
                                :total="stockTotal">
                        </el-pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <el-tabs @tab-click="changeTab" type="border-card">
        <el-tab-pane label="账号商品">
            <template>
                <el-table
                        :data="goodsList"
                        border
                        :row-class-name="tableRowClassName"
                        style="width: 100%">
                    <el-table-column
                            prop="goodsName"
                            label="商品名称"
                            align="center"
                            width="130">
                    </el-table-column>
                    <el-table-column
                            prop="parent_cate_id"
                            label="顶级分类"
                            align="center"
                            width="100">
                <span slot-scope="scope">
                    {{scope.row.parent_cate_id|cateFilter(parentCates,1)}}
                </span>
                    </el-table-column>
                    <el-table-column
                            prop="cateId"
                            label="分类"
                            align="center"
                            width="100">
                <span slot-scope="scope">
                    {{scope.row.cateId|cateFilter(parentCates,0)}}
                </span>
                    </el-table-column>
                    <el-table-column
                            prop="accountType"
                            label="账号类型"
                            align="center"
                            width="100">
                <span slot-scope="scope">
                    {{scope.row.accountType|accountFilter(baseConfig.accountType)}}
                </span>
                    </el-table-column>
                    <el-table-column
                            prop="vipType"
                            label="会员类型"
                            align="center"
                            width="130">
                <span slot-scope="scope">
                    {{scope.row.vipType|accountFilter(baseConfig.vipType)}}
                </span>
                    </el-table-column>
                    <el-table-column
                            prop="status"
                            label="商品状态"
                            align="center"
                            width="80">
                        <template slot-scope="scope">
                        <span @click="edititemclick('status',scope.row.id,0)" v-if="scope.row.status == 1"><i
                                    class="fa fa-check-circle" aria-hidden="true"></i></span>
                            <span @click="edititemclick('status',scope.row.id,1)" v-else><i
                                        class="fa fa-times-circle" aria-hidden="true"></i></span>
                        </template>
                    </el-table-column>
                    <el-table-column
                            prop="stock"
                            label="商品库存"
                            align="center"
                            width="80">
                    </el-table-column>
                    <el-table-column
                            prop="endTime"
                            label="到期时间"
                            align="center"
                            width="170">
                        <template slot-scope="scope">
                            <span>{{scope.row.endTime|timeTran}}</span>
                        </template>
                    </el-table-column>
                    <el-table-column
                            prop="created_at"
                            label="添加时间"
                            align="center"
                            width="170">
                        <template slot-scope="scope">
                            <span>{{scope.row.created_at|timeTran}}</span>
                        </template>
                    </el-table-column>
                    <el-table-column
                            fixed="right"
                            align="center"
                            label="操作">
                        <template slot-scope="scope">
                            <div style="width:100%;display: flex;justify-content: space-around">
                                <button type="button" class="btn btn-primary" v-if="scope.row.goodsType == 1" type="text" @click="copyGoods(scope.row.id)">复制</button>
                                <button type="button" @click="addstock(scope.row)"  data-target="#mainModal" data-toggle="modal" class="btn btn-primary">
                                    添加库存
                                </button>
                                <button type="button" @click="showStock(scope.row)"  data-target="#stockMainModal" data-toggle="modal" class="btn btn-primary">
                                    查看库存
                                </button>
                                <a :href="'<?= Url::to('/goods/goods/edit?id=') ?>'+scope.row.id" type="button" class="btn btn-primary" aria-hidden="true">编辑</a>
                                <button type="button" class="btn btn-danger"  @click="edititemclick('status',scope.row.id,3)">删除</button>
                            </div>
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
        </el-tab-pane>
        <el-tab-pane label="普通商品">
            <template>
                <el-table
                        :data="goodsList"
                        border
                        :row-class-name="tableRowClassName"
                        style="width: 100%">
                    <el-table-column
                            prop="id"
                            label="序号"
                            align="center"
                            width="80">
                    </el-table-column>
                    <el-table-column
                            prop="goodsName"
                            label="商品名称"
                            align="center"
                            width="130">
                    </el-table-column>
                    <el-table-column
                            prop="parent_cate_id"
                            label="顶级分类"
                            align="center"
                            width="130">
                <span slot-scope="scope">
                    {{scope.row.parent_cate_id|cateFilter(parentCates,1)}}
                </span>
                    </el-table-column>
                    <el-table-column
                            prop="cateId"
                            label="分类"
                            align="center"
                            width="130">
                <span slot-scope="scope">
                    {{scope.row.cateId|cateFilter(parentCates,0)}}
                </span>
                    </el-table-column>
                    <el-table-column
                            prop="status"
                            label="商品状态"
                            align="center"
                            width="80">
                        <template slot-scope="scope">
                        <span @click="edititemclick('status',scope.row.id,0)" v-if="scope.row.status == 1"><i
                                    class="fa fa-check-circle" aria-hidden="true"></i></span>
                            <span @click="edititemclick('status',scope.row.id,1)" v-else><i
                                        class="fa fa-times-circle" aria-hidden="true"></i></span>
                        </template>
                    </el-table-column>
                    <el-table-column
                            prop="stock"
                            label="商品库存"
                            align="center"
                            width="80">
                    </el-table-column>
                    <el-table-column
                            prop="created_at"
                            label="添加时间"
                            align="center"
                            width="170">
                        <template slot-scope="scope">
                            <span>{{scope.row.created_at|timeTran}}</span>
                        </template>
                    </el-table-column>
                    <el-table-column
                            prop="updated_at"
                            label="修改时间"
                            align="center"
                            width="170">
                        <template slot-scope="scope">
                            <span>{{scope.row.updated_at|timeTran}}</span>
                        </template>
                    </el-table-column>
                    <el-table-column
                            fixed="right"
                            align="center"
                            label="操作">
                        <template slot-scope="scope">
                            <div style="max-width: 150px;width:90%;display: flex;justify-content: space-around">
                                <a :href="'<?= Url::to('/goods/goods/edit?id=') ?>'+scope.row.id" type="button" class="btn btn-primary" aria-hidden="true">编辑</a>
                                <button type="button" class="btn btn-danger"  @click="edititemclick('status',scope.row.id,3)">删除</button>
                            </div>
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
        </el-tab-pane>
    </el-tabs>
</div>
