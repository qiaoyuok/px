<!--    条件-->
<template>
    <div class="header-input-search">
        <div class="row">
            <div class="col-lg-2 col-sm-8 col-md-6 col-xs-12">
                <div class="input-group">
                        <span class="input-group-btn">
                            <button style="width: 70px;" class="btn btn-default" type="button">昵称</button>
                        </span> <input type="text" v-model="search_nickname" class="form-control" placeholder="请输入昵称">
                </div>
            </div>
            <div class="col-lg-2 col-sm-8 col-md-6 col-xs-12">
                <div class="input-group">
                        <span class="input-group-btn">
                            <button style="width: 90px;" class="btn btn-default" type="button">手机号</button>
                        </span> <input type="text" v-model="search_tel" class="form-control" placeholder="请输入手机号">
                </div>
            </div>
            <div class="col-lg-2 col-sm-8 col-md-6 col-xs-12">
                <div class="input-group">
                        <span class="input-group-btn">
                            <button style="width: 90px;" class="btn btn-default" type="button">账号</button>
                        </span> <input type="text" v-model="search_account" class="form-control" placeholder="请输入账号">
                </div>
            </div>
            <div class="col-lg-2 col-sm-8 col-md-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button style="width: 90px;" class="btn btn-default" type="button">账号平台</button>
                    </span>
                    <el-select v-model="search_vip_name" placeholder="请选择">
                        <el-option
                                v-for="item in search_vipNameList"
                                :key="item.vip_name"
                                :label="item.vip_name"
                                :value="item.vip_name">
                        </el-option>
                    </el-select>
                </div>
            </div>
            <div class="col-lg-2 col-sm-8 col-md-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button style="width: 90px;" class="btn btn-default" type="button">账号类型</button>
                    </span>
                    <el-select v-model="search_accountType" placeholder="请选择">
                        <el-option
                                v-for="item in search_accountTypeList"
                                :key="item.accountType"
                                :label="item.accountType"
                                :value="item.accountType">
                        </el-option>
                    </el-select>
                </div>
            </div>
            <div class="col-lg-4 col-sm-8 col-md-6 col-xs-12" style="margin: 10px 0;">
                <div class="input-group">
                        <span class="input-group-btn">
                            <button style="width: 90px;" class="btn btn-default" type="button">注册时间</button>
                        </span>
                    <el-date-picker
                            v-model="search_datetime"
                            type="daterange"
                            :picker-options="pickerOptions"
                            value-format="timestamp"
                            range-separator="至"
                            start-placeholder="开始日期"
                            end-placeholder="结束日期">
                    </el-date-picker>
                </div>
            </div>
            <div class="col-lg-2" style="margin: 10px 0">
                <button type="button" @click="search" class="btn btn-primary">查询</button>
                <button type="button" @click="refresh" class="btn btn-primary">刷新</button>
            </div>
        </div>
    </div>
</template>