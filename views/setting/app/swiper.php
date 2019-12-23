<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/05/02
 * Time: 17:27
 */
?>

<div class="row swiper">

<!--    <el-dialog title="编辑Swiper轮播图" :visible.sync="swiperDialog">-->
<!--        <el-form ref="swiperform" :model="swiperItem" label-width="80px">-->
<!--            <el-form-item label="标题">-->
<!--                <el-input v-model="swiperItem.title" placeholder="请输入轮播图标题"></el-input>-->
<!--            </el-form-item>-->
<!--            <el-form-item label="排序权重">-->
<!--                <el-input v-model="swiperItem.sort"  placeholder="请输入轮播图排序权重"></el-input>-->
<!--            </el-form-item>-->
<!--            <el-form-item style="width: 100%;height: 800px;">-->
<!--                <div id="swiper-edit-container" v-model="swiperItem.content" type="text/plain">{{swiperItem.content}}</div>-->
<!--            </el-form-item>-->
<!--            <el-form-item>-->
<!--                <el-button type="primary" @click="">立即创建</el-button>-->
<!--                <el-button>取消</el-button>-->
<!--            </el-form-item>-->
<!--        </el-form>-->
<!--    </el-dialog>-->

    <div class="modal fade" id="mainModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="z-index: 9999">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">编辑swiper轮播图</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">标题:</label>
                        <input type="text" class="form-control" v-model="swiperItem.title">
                    </div>
                    <div class="form-group">
                        <label class="control-label">排序权重:</label>
                        <input type="text" class="form-control"  v-model="swiperItem.sort" >
                    </div>
                    <div class="form-group">
                        <label class="control-label">内容:</label>
                        <script id="swiper-edit-container" v-model="swiperItem.content" type="text/plain">{{swiperItem.content}}</script>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary" @click="saveSwiper">提交修改</button>
                </div>
            </div>
        </div>
    </div>

    <el-card class="box-card" v-for="(item,index) in swiperList">

        <el-upload class="upload-demo"
                   ref="upload"
                   :data="extraData"
                   :on-success="updateSuccess"
                   :show-file-list="false"
                   action="https://upload.qiniup.com?">
            <img @click="setKey(item.id)" type="primary" :src="qiniu+item.imgUrl" onerror="this.src='/images/viplogo/account_logo.png'" alt="">
        </el-upload>
        <div class="swiper-bottom">
            <span>{{item.title}}</span>
            <div class="option">
                <span style="padding: 0 5px;">权重：{{item.sort}}</span>
                <span @click="editSwiperStatus(item.id,0)" v-if="item.status == 1"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
                <span @click="editSwiperStatus(item.id,1)" v-else><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                <i @click="editSwiperDialog(index)" data-toggle="modal" data-target="#mainModal" class="fa fa-pencil-square-o" aria-hidden="true"></i>
                <i @click="delSwiper(item.id)" class="fa fa-trash" aria-hidden="true"></i>
            </div>
        </div>
    </el-card>
    <div class="box-card" style="display: flex;align-items: center;justify-content: center;background: none">
        <el-upload class="upload-demo"
                   ref="upload"
                   style="display: flex;align-items: center;justify-content: center"
                   :data="extraData"
                   :on-success="updateSuccess"
                   :show-file-list="false"
                   action="https://upload.qiniup.com?">
            <img @click="setKey('')" class="logo-img addpic" type="primary" src="<?= \Yii::getAlias('@web') . '/images/addpic.png' ?>" onerror="this.src='/images/viplogo/account_logo.png'" alt="">
        </el-upload>
    </div>
</div>
