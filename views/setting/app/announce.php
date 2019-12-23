<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/04/01
 * Time: 21:51
 */

?>
<el-dialog title="删除提示" :visible.sync="deleteDialog" :show-close="false" width="300px" id="delete_dialog">
    <delitem :controller="controller" :url="url" v-on:dialogstatus="dialogstatus"></delitem>
</el-dialog>
<div class="row">
    <div class="annunce-list col-lg-3">
        <el-card class="box-card">
            <div slot="header" class="clearfix">
                <h4>公告列表</h4>
            </div>
            <div v-for="(item,index) in announcelist" :key="index" class="announce-item">
                <span>{{item.title}}</span>
                <p>
                    <span @click="editAnnounceStatus(item.id,0)" v-if="item.status == 1"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
                    <span @click="editAnnounceStatus(item.id,1)" v-else><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                    <i @click="editAnnounce(item.id)" class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    <i @click="delAnnounce(item.id)" class="fa fa-trash" aria-hidden="true"></i>
                </p>
            </div>
        </el-card>
    </div>
    <div class="announce-editor col-lg-9">
        <el-card class="box-card">
            <div slot="header" class="clearfix">
                <h4>编辑公告</h4>

                <el-button style="float: right; padding: 5px 8px" type="primary"
                           @click="saveAnnounce()">保存
                </el-button>
            </div>
            <div class="text item">
                <div style="margin-bottom: 10px" prop="title">
                    <el-input placeholder="请输入内容" v-model="announce.title">
                        <template slot="prepend">公告标题：</template>
                    </el-input>
                </div>
                <script id="edit-container" v-model="announce.content" type="text/plain">{{announce.content}}</script>
            </div>
        </el-card>
    </div>
</div>
