<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/03/06
 * Time: 20:47
 */
use app\assets\DashboardAsset;
DashboardAsset::register($this);
$this->title = "统计";
?>

<div id="app">
    <div class="filter ">
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
    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-6" style="margin-bottom: 30px;">
            <div id="ad-channel-echarts" style="width: 100%;height: 400px;"></div>
        </div>
        <div class="col-md-6" style="margin-bottom: 30px;">
            <div id="ad-status-echarts" style="width: 100%;height: 400px;"></div>
        </div>
    </div>
</div>
