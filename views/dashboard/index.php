<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/03/06
 * Time: 20:47
 */
use app\assets\DashboardAsset;
DashboardAsset::register($this);
$this->title = "广告渠道分析";
?>

<div id="app">
    <div class="filter">
        <template>
            <div class="block">
                <el-date-picker
                        v-model="time"
                        type="daterange"
                        align="right"
                        unlink-panels
                        range-separator="至"
                        start-placeholder="开始日期"
                        end-placeholder="结束日期"
                        :picker-options="pickerOptions">
                </el-date-picker>
            </div>
        </template>
        <el-button style="margin-left: 15px;" icon="el-icon-search" circle></el-button>
    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-6">
            <div id="ad-status-echarts" style="width: 100%;height: 400px;"></div>
        </div>
        <div class="col-md-6">
            <div id="ad-channel-echarts" style="width: 100%;height: 400px;"></div>
        </div>
    </div>
</div>
