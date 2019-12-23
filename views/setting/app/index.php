<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/04/01
 * Time: 21:36
 */

use app\assets\SettingAppAsset;

SettingAppAsset::register($this);
$this->title = "应用配置";
?>
<script>
    var token = "<?= $token ?>";
</script>
<div id="app-index" class="row" v-cloak>
    <el-tabs type="border-card">
        <el-tab-pane label="公告管理">
            <?php require_once __DIR__ . '/announce.php' ?>
        </el-tab-pane>
        <el-tab-pane label="顶部轮播图">
            <?php require_once __DIR__ . '/swiper.php' ?>
        </el-tab-pane>
    </el-tabs>
</div>
