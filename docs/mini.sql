/*
 Navicat Premium Data Transfer

 Source Server         : 本地Linux
 Source Server Type    : MySQL
 Source Server Version : 50642
 Source Host           : 192.168.1.103:3306
 Source Schema         : mini

 Target Server Type    : MySQL
 Target Server Version : 50642
 File Encoding         : 65001

 Date: 30/06/2019 18:42:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for mini_account_base_config
-- ----------------------------
DROP TABLE IF EXISTS `mini_account_base_config`;
CREATE TABLE `mini_account_base_config`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '基础配置类型；1：账号类型；2：vip类型；3：分期',
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '当前值',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_account_base_config
-- ----------------------------
INSERT INTO `mini_account_base_config` VALUES (19, 1, '账号密码');
INSERT INTO `mini_account_base_config` VALUES (20, 1, '激活码');
INSERT INTO `mini_account_base_config` VALUES (21, 2, '黄金会员');
INSERT INTO `mini_account_base_config` VALUES (22, 2, '白金会员');
INSERT INTO `mini_account_base_config` VALUES (23, 2, '酷狗音乐包');
INSERT INTO `mini_account_base_config` VALUES (24, 2, '网易音乐包');
INSERT INTO `mini_account_base_config` VALUES (25, 3, '分一期');
INSERT INTO `mini_account_base_config` VALUES (27, 3, '分三期');

-- ----------------------------
-- Table structure for mini_accountcate
-- ----------------------------
DROP TABLE IF EXISTS `mini_accountcate`;
CREATE TABLE `mini_accountcate`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '分类名称',
  `parent_id` int(11) NOT NULL DEFAULT 0 COMMENT '父级分类id；0：顶级分类',
  `sort` float(6, 2) NOT NULL DEFAULT 1.00 COMMENT '排序权重',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '当前分类状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 55 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_accountcate
-- ----------------------------
INSERT INTO `mini_accountcate` VALUES (46, '视频', 0, 1.00, 1);
INSERT INTO `mini_accountcate` VALUES (47, '音乐', 0, 1.00, 1);
INSERT INTO `mini_accountcate` VALUES (48, '爱奇艺', 46, 1.00, 1);
INSERT INTO `mini_accountcate` VALUES (49, '优酷', 46, 1.00, 1);
INSERT INTO `mini_accountcate` VALUES (50, '网易云音乐', 47, 1.00, 1);
INSERT INTO `mini_accountcate` VALUES (51, '酷狗音乐', 47, 1.00, 1);
INSERT INTO `mini_accountcate` VALUES (52, '鞋子', 0, 1.00, 1);
INSERT INTO `mini_accountcate` VALUES (53, '阿迪达斯', 52, 1.00, 1);
INSERT INTO `mini_accountcate` VALUES (54, '乐视', 46, 1.00, 1);

-- ----------------------------
-- Table structure for mini_accountconfig
-- ----------------------------
DROP TABLE IF EXISTS `mini_accountconfig`;
CREATE TABLE `mini_accountconfig`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '序号',
  `cateId` int(11) NOT NULL DEFAULT 0 COMMENT '分类的ID号',
  `accountType` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '账号的类型；激活码；账号密码；接码登录',
  `vipType` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'vip类型;黄建；白金；钻石等',
  `fenqi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '允许的分期配置',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '富文本',
  `logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `swiper` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  PRIMARY KEY (`id`, `cateId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_accountconfig
-- ----------------------------
INSERT INTO `mini_accountconfig` VALUES (14, 48, '[19,20]', '[21,22]', '[25,27,26]', '<p style=\"text-align: center;\"><span style=\"font-size: 20px;\"><strong>奋斗的规划</strong></span></p><p><span style=\"font-size: 20px;\"></span></p><p><img src=\"https://image.mysvip.cn//20190503/155688159611483947.jpg\"/></p><p><img src=\"https://image.mysvip.cn//20190503/1556881613207622945.jpg\"/></p><p><img src=\"https://image.mysvip.cn//20190512/155766514714249195.png\"/></p><p><img src=\"http://img.baidu.com/hi/jx2/j_0004.gif\"/></p><p><span style=\"font-size: 20px;\"><strong><br/></strong></span><br/></p>', 'logo__1558202456605.png', 'logo_setSwiperKey__1561885800206.png');
INSERT INTO `mini_accountconfig` VALUES (15, 49, '[19]', '[21]', '[25]', '', 'logo__1558202469582.png', '');
INSERT INTO `mini_accountconfig` VALUES (16, 50, '[19,20]', '[24]', '[]', '', 'logo__1558263321105.png', '');
INSERT INTO `mini_accountconfig` VALUES (17, 51, '[19,20]', '[23]', '[]', '', 'logo__1558202551189.png', '');
INSERT INTO `mini_accountconfig` VALUES (18, 53, '[19]', '[]', '[27]', '<p><img src=\"http://img.baidu.com/hi/jx2/j_0003.gif\"/>的闪光点</p>', NULL, 'logo_setSwiperKey__1561888459999.png');
INSERT INTO `mini_accountconfig` VALUES (19, 54, '[]', '[]', '[]', '', 'logo__1561808210671.png', '');

-- ----------------------------
-- Table structure for mini_administrator
-- ----------------------------
DROP TABLE IF EXISTS `mini_administrator`;
CREATE TABLE `mini_administrator`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `access_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`, `uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_administrator
-- ----------------------------
INSERT INTO `mini_administrator` VALUES (1, 1002, 'admin', 'admin', '$2y$13$PDGxiXacyRqOw1XjfGuSveJW2BS4nWaEAwWb227V/SuLXf7WWrLKy');

-- ----------------------------
-- Table structure for mini_announce
-- ----------------------------
DROP TABLE IF EXISTS `mini_announce`;
CREATE TABLE `mini_announce`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '公告标题',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '公告内容',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '公告状态：默认1：正常；0：关闭；',
  `created_at` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '公告创建时间',
  `updated_at` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '公告上次更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_announce
-- ----------------------------
INSERT INTO `mini_announce` VALUES (8, '电饭锅和大家客观111', '<p><video class=\"edui-upload-video  vjs-default-skin  video-js\" controls=\"\" preload=\"none\" width=\"420\" height=\"280\" src data-setup=\"{}\"></video></p>', 1, '1554216955', '1556847795');
INSERT INTO `mini_announce` VALUES (11, '娃哈哈', '<header><a class=\"jsx-2344307676 tochannel \" style=\"box-sizing: content-box;display: block;padding: 0px 50px;height: 44px;line-height: 44px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis\"><br/></a><a href=\"https://xw.qq.com/m/s/sort\" class=\"jsx-2344307676  gochannels \" style=\"box-sizing: inherit;utf8,&lt;svg width=\\&#39;22\\&#39; height=\\&#39;22\\&#39; xmlns=\\&#39;http://www.w3.org/2000/svg\\&#39;&gt;&lt;g fill=\\&#39;%233F4146\\&#39; fill-rule=\\&#39;evenodd\\&#39;&gt;&lt;rect x=\\&#39;2\\&#39; y=\\&#39;3\\&#39; width=\\&#39;18\\&#39; height=\\&#39;2\\&#39; rx=\\&#39;1\\&#39;/&gt;&lt;rect x=\\&#39;2\\&#39; y=\\&#39;10\\&#39; width=\\&#39;18\\&#39; height=\\&#39;2\\&#39; rx=\\&#39;1\\&#39;/&gt;&lt;rect x=\\&#39;2\\&#39; y=\\&#39;17\\&#39; width=\\&#39;18\\&#39; height=\\&#39;2\\&#39; rx=\\&#39;1\\&#39;/&gt;&lt;/g&gt;&lt;/svg&gt;&#39;) 0px 0px / 22px no-repeat;margin: 11px 11px 0px 0px;position: absolute;right: 0px;top: 0px;width: 22px;height: 22px;z-index: 1;transition: all 0.5s ease 0s\"></a></header><p><img src=\"https://inews.gtimg.com/newsapp_bt/0/8434772222/641\" alt=\"\"/></p><p style=\"box-sizing: inherit;margin-top: 0px;margin-bottom: 20px;padding: 0px;line-height: 1.6875rem;overflow-wrap: break-word;text-align: justify;color: rgb(34, 34, 34);letter-spacing: 0.3px\">腾讯体育讯 第53届超级碗，洛杉矶公羊3-13不敌新英格兰爱国者，他们输给了爱国者极具针对性的防守，输给了自己糟糕的进攻，从某方面来说，也输给了托德-格尔利的膝盖。格尔利的膝盖究竟怎么样了？或许日前记者拍下的一段视频能够给你答案。</p><p><img src=\"https://inews.gtimg.com/newsapp_bt/0/8434774219/641\" alt=\"\"/></p><p style=\"box-sizing: inherit;margin-top: 0px;margin-bottom: 20px;padding: 0px;line-height: 1.6875rem;overflow-wrap: break-word;text-align: justify;color: rgb(34, 34, 34);letter-spacing: 0.3px\">北京时间4月4日，TMZ记者拍到格尔利在洛杉矶一家餐厅用完餐后一跛一跛的离开，这个动作看起来并不像是一位一个赛季能够完成250次持球的明星跑卫。通过视频，我们看到格尔利走出餐厅时还需要身边朋友的搀扶，在他走向汽车的路上，身体摇摇晃晃，腿似乎出了问题。</p><p style=\"box-sizing: inherit;margin-top: 0px;margin-bottom: 20px;padding: 0px;line-height: 1.6875rem;overflow-wrap: break-word;text-align: justify;color: rgb(34, 34, 34);letter-spacing: 0.3px\">格尔利似乎在国联决赛和超级碗受到了一些不为人知的影响，没有延续常规赛出色的状态，表现平平，这让公羊队的许多进攻战术都无从施展，最终输掉超级碗。进入季后赛之前，格尔利膝盖受伤，为此公羊队不得不签下前野马跑卫C.J.安德森暂代格尔利的位置，可谁知安德森在几场比赛里表现神勇，说是暂代，实际上几乎抢过了主力跑卫。虽然进入季后赛格尔利的膝盖也已恢复的差不多，但上场时间寥寥无几，效率也极低，最终在超级碗泯然众人。</p><p><img src=\"https://inews.gtimg.com/newsapp_bt/0/8434777721/641\" alt=\"\"/></p><p style=\"box-sizing: inherit;margin-top: 0px;margin-bottom: 20px;padding: 0px;line-height: 1.6875rem;overflow-wrap: break-word;text-align: justify;color: rgb(34, 34, 34);letter-spacing: 0.3px\">自打格尔利在超级碗“一蹶不振”以来，这个休赛期似乎球迷对他的健康十分感兴趣，有人认为公羊队没有利用好格尔利，所以超级碗才输了，也有一部分认为格尔利还在处理伤病，双方各执一词。格尔利本人和公羊主帅肖恩-麦克维都在接受采访时称格尔利的腿已经恢复好了，工作人员也表示格尔利这几周一直在训练，看起来一切都很好。</p><p style=\"box-sizing: inherit;margin-top: 0px;margin-bottom: 20px;padding: 0px;line-height: 1.6875rem;overflow-wrap: break-word;text-align: justify;color: rgb(34, 34, 34);letter-spacing: 0.3px\">休赛期还很漫长，关于格尔利的膝盖问题还会一直讨论下去。这段视频能够证明什么吗，我们不确定，不管如何，公羊都要决定是继续让格尔利担任主要冲球任务还是适量限制其上场时间。最后说一下，格尔利谈到了关于队友恩达姆孔-苏的问题，他希望能够看到这位防守巨星下赛季回到公羊。</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 20px; padding: 0px; line-height: 1.6875rem; overflow-wrap: break-word; text-align: justify; color: rgb(34, 34, 34); letter-spacing: 0.3px;\">（大白）</p>', 1, '1554217827', '1554458628');
INSERT INTO `mini_announce` VALUES (12, '发放的', '<p>请输入公告内容....发的</p>', 1, '1557653029', '1557653029');

-- ----------------------------
-- Table structure for mini_feedback
-- ----------------------------
DROP TABLE IF EXISTS `mini_feedback`;
CREATE TABLE `mini_feedback`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '反馈的类型；默认1：免费账号问题；2：应用反馈',
  `uuid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户UUID',
  `account_id` int(11) NOT NULL DEFAULT 0 COMMENT '免费账号ID',
  `content` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '详细内容',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '反馈问题状态；0：未处理；1：已处理',
  `created_at` int(4) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `updated_at` int(4) NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_feedback
-- ----------------------------
INSERT INTO `mini_feedback` VALUES (34, 1, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 3, '规范刚刚恢复供货价格和客户机', 1, 1558244245, 1558244568);
INSERT INTO `mini_feedback` VALUES (35, 2, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 0, '反倒是改革的回复结果会尽快交功课', 1, 1558244870, 1558244890);
INSERT INTO `mini_feedback` VALUES (36, 1, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 4, '发送的规范的规定合法的风景', 1, 1558247471, 1558361411);
INSERT INTO `mini_feedback` VALUES (37, 1, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 21, '过分的话焚膏继晷很快就回来喝酒', 1, 1558449226, 1558449250);
INSERT INTO `mini_feedback` VALUES (38, 1, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 21, '<script>alert(10)</script>', 1, 1558449290, 1558528267);
INSERT INTO `mini_feedback` VALUES (39, 1, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 21, 'fsdgddhfhfhjghj', 1, 1558450192, 1558528236);
INSERT INTO `mini_feedback` VALUES (40, 1, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 23, '来咯额几个邻居们退哈佛最好咯最GPS', 1, 1558772110, 1560082748);

-- ----------------------------
-- Table structure for mini_feedback_reply
-- ----------------------------
DROP TABLE IF EXISTS `mini_feedback_reply`;
CREATE TABLE `mini_feedback_reply`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `feedback_id` int(11) NOT NULL DEFAULT 0 COMMENT '用户反馈索引',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '解答反馈的内容',
  `created_at` int(4) NOT NULL DEFAULT 0 COMMENT '回复时间',
  `updated_at` int(4) NOT NULL DEFAULT 0 COMMENT '更新回复时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 60 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_feedback_reply
-- ----------------------------
INSERT INTO `mini_feedback_reply` VALUES (35, 26, '<p>很好性收到您的反馈，我们会更加努力地；终于等到你，还好我没放弃<img src=\"http://img.baidu.com/hi/jx2/j_0039.gif\"/></p>', 1557655535, 1557655535);
INSERT INTO `mini_feedback_reply` VALUES (36, 27, '<p>别的地方都是</p>', 1557657445, 1557657445);
INSERT INTO `mini_feedback_reply` VALUES (38, 28, '<p>如果非得<br/></p>', 1557657493, 1557657493);
INSERT INTO `mini_feedback_reply` VALUES (39, 29, '<p>规范的股份丰东股份</p>', 1557657581, 1557658691);
INSERT INTO `mini_feedback_reply` VALUES (41, 29, '<p>出发的规范</p>', 1557658699, 1557658699);
INSERT INTO `mini_feedback_reply` VALUES (42, 27, '<p>出发的规范</p>', 1557659145, 1557659145);
INSERT INTO `mini_feedback_reply` VALUES (44, 30, '<p>辅导辅导费<img src=\"http://img.baidu.com/hi/jx2/j_0013.gif\"/><img src=\"https://image.mysvip.cn//20190512/155766514714249195.png\" title=\"/20190512/155766514714249195.png\" alt=\"sss.png\"/></p>', 1557664203, 1557665150);
INSERT INTO `mini_feedback_reply` VALUES (45, 30, '<p>发打个电话</p>', 1557664448, 1557664448);
INSERT INTO `mini_feedback_reply` VALUES (46, 31, '<p>丰东股份</p>', 1557664545, 1557664545);
INSERT INTO `mini_feedback_reply` VALUES (47, 32, '<p style=\"text-align: center;\"><img src=\"http://img.baidu.com/hi/jx2/j_0037.gif\"/></p><p><img src=\"https://image.mysvip.cn//20190503/1556881585202343375.jpg\" alt=\"1556881585202343375.jpg\"/></p>', 1557752385, 1557752642);
INSERT INTO `mini_feedback_reply` VALUES (48, 32, '<p><span style=\"font-family: Helvetica, Arial, sans-serif; text-indent: 32px; color: rgb(84, 141, 212);\">有识之士指出，斯巴达抵御外敌波斯入侵的功绩非比寻常，没有他们，世界上第一个民主制度就会被扼杀在摇篮里</span></p>', 1557752760, 1557752817);
INSERT INTO `mini_feedback_reply` VALUES (49, 33, '<p style=\"font-family: &quot;Microsoft YaHei&quot;; font-size: 14px; white-space: normal; text-align: left;\"><span style=\"color: rgb(84, 141, 212);\">我从小就不</span><a href=\"http://www.duwenzhang.com/huati/xihuan/index1.html\" style=\"text-decoration: underline; color: rgb(84, 141, 212);\"><span style=\"color: rgb(84, 141, 212);\">喜欢她</span></a><span style=\"color: rgb(84, 141, 212);\">，因为她总是打我。我从外面玩饿了跑回家，总是</span><a href=\"http://www.duwenzhang.com/huati/xiguan/index1.html\" style=\"text-decoration: underline; color: rgb(84, 141, 212);\"><span style=\"color: rgb(84, 141, 212);\">习惯</span></a><span style=\"color: rgb(84, 141, 212);\">的大喊一声</span><a href=\"http://www.duwenzhang.com/huati/nainai/index1.html\" style=\"text-decoration: underline; color: rgb(84, 141, 212);\"><span style=\"color: rgb(84, 141, 212);\">奶奶</span></a><span style=\"color: rgb(84, 141, 212);\">，一边到处找吃的。她就会踮着脚走到我后面来，抬起手，在我的屁股上猛拍一巴掌，大吼：我让你叫奶奶！火烧火燎的疼。我捂着屁股，</span><a href=\"http://www.duwenzhang.com/huati/yanlei/index1.html\" style=\"text-decoration: underline; color: rgb(84, 141, 212);\"><span style=\"color: rgb(84, 141, 212);\">眼泪</span></a><span style=\"color: rgb(84, 141, 212);\">打着转转。</span></p><p style=\"font-family: &quot;Microsoft YaHei&quot;; font-size: 14px; white-space: normal; text-align: left;\"><span style=\"color: rgb(84, 141, 212);\">　　我一直想走，回到奶奶家去。好几次趁她不注意逃离了小院子，结果没跑到村口就被她捉回来，免不了一顿打，她好像随时都有一股无名的火气。</span></p><p style=\"font-family: &quot;Microsoft YaHei&quot;; font-size: 14px; white-space: normal; text-align: left;\"><span style=\"color: rgb(84, 141, 212);\">　　她的钱藏在裤子口袋里，包了两层手绢。那手绢白白的，上面绣了一朵牡丹花。我一直觊觎这手绢，可她藏的严严的。她每样东西似乎都很好看，茶杯是成套的，炕上铺了大红的绒毯，鞋垫里总绣着花，头发油光光的。可是她不爱我。</span></p><p style=\"font-family: &quot;Microsoft YaHei&quot;; font-size: 14px; white-space: normal; text-align: left;\"><span style=\"color: rgb(84, 141, 212);\">　　我就常常想起奶奶，一个人在被窝里哭。奶奶对我多好啊，夏天带我上山采野果子吃，冬天将我揣在被窝里讲孙悟空。记忆中她从没喜欢过我。前几年，她到奶奶家去，穿着崭新的紫色旗袍，头发拢在脑后，一丝不苟，我看着新鲜，吃饭的时候，一边叫着</span><a href=\"http://www.duwenzhang.com/huati/laolao/index1.html\" style=\"text-decoration: underline; color: rgb(84, 141, 212);\"><span style=\"color: rgb(84, 141, 212);\">姥姥</span></a><span style=\"color: rgb(84, 141, 212);\">，一边凑到她跟前去讨吃的，她一抬眼睛，呵斥：</span><a href=\"http://www.duwenzhang.com/huati/haizi/index1.html\" style=\"text-decoration: underline; color: rgb(84, 141, 212);\"><span style=\"color: rgb(84, 141, 212);\">小孩子</span></a><span style=\"color: rgb(84, 141, 212);\">，真没规矩。那神情，我一直记在心里。奶奶见她呵斥我，立刻变了脸色，拉着我的手走开了，</span><a href=\"http://www.duwenzhang.com/huati/fuqin/index1.html\" style=\"text-decoration: underline; color: rgb(84, 141, 212);\"><span style=\"color: rgb(84, 141, 212);\">爸爸</span></a><a href=\"http://www.duwenzhang.com/huati/muqin/index1.html\" style=\"text-decoration: underline; color: rgb(84, 141, 212);\"><span style=\"color: rgb(84, 141, 212);\">妈妈</span></a><span style=\"color: rgb(84, 141, 212);\">也很尴尬，默默低头吃饭。</span></p><p style=\"font-family: &quot;Microsoft YaHei&quot;; font-size: 14px; white-space: normal; text-align: left;\"><span style=\"color: rgb(84, 141, 212);\">　　只不过是两年</span><a href=\"http://www.duwenzhang.com/huati/shijian/index1.html\" style=\"text-decoration: underline; color: rgb(84, 141, 212);\"><span style=\"color: rgb(84, 141, 212);\">时间</span></a><span style=\"color: rgb(84, 141, 212);\">，我就来到了她的身边，每天吃她做的饭，住她的房子，挨她的打。</span></p>', 1557752918, 1557752982);
INSERT INTO `mini_feedback_reply` VALUES (50, 34, '<p>dsgdhgfhgfhgj</p>', 1558244568, 1558244568);
INSERT INTO `mini_feedback_reply` VALUES (51, 35, '<p>gdfhfdjfghshshhgdgsg</p>', 1558244880, 1558244884);
INSERT INTO `mini_feedback_reply` VALUES (52, 35, '<p>fsagdgddhgf</p>', 1558244890, 1558244890);
INSERT INTO `mini_feedback_reply` VALUES (53, 36, '<p>个地方海沸江翻fff</p>', 1558247485, 1558361407);
INSERT INTO `mini_feedback_reply` VALUES (54, 36, '<p>fdgdfgdh</p>', 1558361411, 1558361411);
INSERT INTO `mini_feedback_reply` VALUES (55, 37, '<p>gvsdhdfh<img src=\"https://image.mysvip.cn//20190503/1556881585202343375.jpg\" alt=\"1556881585202343375.jpg\"/></p>', 1558449250, 1558449250);
INSERT INTO `mini_feedback_reply` VALUES (56, 38, '<p>fdsgdf</p>', 1558449307, 1558449307);
INSERT INTO `mini_feedback_reply` VALUES (57, 39, '<p>广东省电话费赶紧回家更好看客户咖妃</p>', 1558528217, 1558528217);
INSERT INTO `mini_feedback_reply` VALUES (58, 39, '<p>发多少的官方回复结果喝咖啡时光<img width=\"530\" height=\"340\" src=\"http://api.map.baidu.com/staticimage?center=116.404,39.915&zoom=10&width=530&height=340&markers=116.404,39.915\"/></p>', 1558528236, 1558528236);
INSERT INTO `mini_feedback_reply` VALUES (59, 38, '<p>富商大贾电饭锅</p>', 1558528267, 1558528267);

-- ----------------------------
-- Table structure for mini_following
-- ----------------------------
DROP TABLE IF EXISTS `mini_following`;
CREATE TABLE `mini_following`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '关注ID号',
  `uid` int(11) NOT NULL DEFAULT 0 COMMENT '被关注用户uid',
  `f_uid` int(11) NOT NULL DEFAULT 0 COMMENT '关注着uid号',
  `created_at` int(4) NOT NULL DEFAULT 0 COMMENT '关注时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for mini_form_id
-- ----------------------------
DROP TABLE IF EXISTS `mini_form_id`;
CREATE TABLE `mini_form_id`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `formId` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'formId号，消息通知用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_form_id
-- ----------------------------
INSERT INTO `mini_form_id` VALUES (1, 'the formId is a mock one');
INSERT INTO `mini_form_id` VALUES (2, '9b814d8e59cb47469324cc56c661fb41');
INSERT INTO `mini_form_id` VALUES (3, 'the formId is a mock one');
INSERT INTO `mini_form_id` VALUES (4, 'the formId is a mock one');
INSERT INTO `mini_form_id` VALUES (5, 'the formId is a mock one');
INSERT INTO `mini_form_id` VALUES (6, 'd65b5f17e7cb4d65bc3af1e5a0e741b4');

-- ----------------------------
-- Table structure for mini_free_log
-- ----------------------------
DROP TABLE IF EXISTS `mini_free_log`;
CREATE TABLE `mini_free_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '日期',
  `small_total` int(11) NOT NULL DEFAULT 0 COMMENT '当天小计',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for mini_free_time
-- ----------------------------
DROP TABLE IF EXISTS `mini_free_time`;
CREATE TABLE `mini_free_time`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `space_time` int(1) NOT NULL DEFAULT 2 COMMENT '时间间隔；默认：间隔2小时',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态；默认：0；不适用；1：正常使用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_free_time
-- ----------------------------
INSERT INTO `mini_free_time` VALUES (5, 1, 0);
INSERT INTO `mini_free_time` VALUES (6, 2, 0);
INSERT INTO `mini_free_time` VALUES (7, 2, 0);

-- ----------------------------
-- Table structure for mini_freeaccounts
-- ----------------------------
DROP TABLE IF EXISTS `mini_freeaccounts`;
CREATE TABLE `mini_freeaccounts`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `free_main_id` int(11) NOT NULL DEFAULT 0 COMMENT '免费会员配置的ID号，对应的是当前会员类型的配置',
  `account` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '存放具体的账号密码或者激活码',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '会员密码',
  `account_times` tinyint(1) NOT NULL DEFAULT 1 COMMENT '剩余提取次数',
  `code_num` tinyint(1) NOT NULL DEFAULT 1 COMMENT '该账号允许收取验证码或乐视验证次数',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '当前账号的状态；1：正常；0：下架',
  `created_at` int(4) NOT NULL DEFAULT 0 COMMENT '账号添加时间',
  `updated_at` int(4) NOT NULL DEFAULT 0 COMMENT '上次更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FREE_MAIN_ID`(`free_main_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 606 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_freeaccounts
-- ----------------------------
INSERT INTO `mini_freeaccounts` VALUES (339, 85, '18620045912', '1987912', 1, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (340, 85, '18292125090', 'wde575823715', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (341, 85, '18601773537', '8619362ltt', 3, 1, 1, 1558363247, 1558363430);
INSERT INTO `mini_freeaccounts` VALUES (342, 85, '13928737665', '8403812', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (343, 85, '13799917952', 'jfa753', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (344, 85, '15210569039', 'wode19910819', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (345, 85, '18629051114', 'feizi923', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (346, 85, '13927271551', 'zte27271551', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (347, 85, '18664986128', '205495717', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (348, 85, '18600659321', 'CYL3646633', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (349, 85, '13501315112', 'qq841690094', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (350, 85, '13736006560', '800327', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (351, 85, '15931607387', 'hongbo', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (352, 85, '18692253778', 'xtipje520', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (353, 85, '18918199044', '383359844', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (354, 85, '18607914151', 'w19881017y', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (355, 85, '13561478501', '780102', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (356, 85, '13681364590', '011378', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (357, 85, '13880517012', 't19861016', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (358, 85, '13661103965', 'lijing1992', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (359, 85, '18686448654', 'hyh485912', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (360, 85, '18500050108', 'fenhua890407', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (361, 85, '13851991396', '199279', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (362, 85, '15705966676', 'zjh19940627', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (363, 85, '18628371707', 'hby037120', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (364, 85, '18611944881', '882829', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (365, 85, '18218019917', 'dadongge12', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (366, 85, '18752159576', '90yanzhilei', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (367, 85, '13281594382', 'mgq091003668', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (368, 85, '15168227747', '19900227yyy', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (369, 85, '15568483377', '721212a', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (370, 85, '13418563108', '861212', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (371, 85, '15051156556', 'why002381', 2, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (372, 85, '18701028263', 'ss7788250', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (373, 85, '15023716833', '510045909', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (374, 85, '13918205253', '03031976', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (375, 85, '13777855337', '114455', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (376, 85, '18670056992', '19910603cx', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (377, 85, '15840225209', 'hs890203', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (378, 85, '18751823776', 'mj1b1b', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (379, 85, '18552402578', 'majun880829', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (380, 85, '15618110975', 'zx363606', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (381, 85, '13538158445', 'HLQ911001', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (382, 85, '18663723862', 'number0105', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (383, 85, '18310657950', '19881222', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (384, 85, '18210007696', 'zhanglina', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (385, 85, '13917166160', '66269412', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (386, 85, '13101833938', 'dx9094', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (387, 85, '13383821199', 'wyg757036', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (388, 85, '13880517012', 't19861016', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (389, 85, '13810312060', 'a123451234', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (390, 85, '18019430635', 'hqywoaini1314', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (391, 85, '18694067230', 'joanna5580', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (392, 85, '15574351948', 'xbj8932665', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (393, 85, '18675519495', 'zhangkai1', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (394, 85, '18621910270', 'ych830125', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (395, 85, '15910570037', 'xiaoyong79', 2, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (396, 85, '18664358064', 'f29676589', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (397, 85, '13233656731', 'liyi891126', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (398, 85, '18892063831', '88316006', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (399, 85, '13735847827', 'wenjie', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (400, 85, '18064766330', 'inter1908520', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (401, 85, '13185666696', 'w7781520', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (402, 85, '18049708009', 'a64030352', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (403, 85, '13161996969', 'xianwen010', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (404, 85, '15577202185', '135891zy', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (405, 85, '18602867831', '1123581321', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (406, 85, '18858580718', '48694869', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (407, 85, '13959978190', '124036750', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (408, 85, '15858273192', 'czq54338885', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (409, 85, '13811152351', 'siboliu1', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (410, 85, '18602533237', 'z313673887', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (411, 85, '13914066727', '001225', 2, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (412, 85, '13689335772', '6626070', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (413, 85, '13772765641', 'wq198844', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (414, 85, '13022908283', 'yhlove515', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (415, 85, '15257390896', 'wqm660277', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (416, 85, '15073460730', 'qwe7520699', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (417, 85, '13641415675', '01992137', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (418, 85, '15564786797', 'qq1149586991', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (419, 85, '13028671566', 'chen1117', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (420, 85, '18985120514', 'jiangli1989', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (421, 85, '15528375267', 'zl890525', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (422, 85, '13524260947', 'a5224094', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (423, 85, '15060643200', 'wsm0302', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (424, 85, '15261619761', 'iqGNAW43', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (425, 85, '13978698146', 'asd101840', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (426, 85, '18363965351', 'guoyi19931020', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (427, 85, '15904093779', '6985168', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (428, 85, '15093151313', 'caowei73', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (429, 85, '13840484605', 'yhl13390156322', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (430, 85, '13482800420', '198504040116', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (431, 85, '13475483287', '369852a', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (432, 85, '18036804010', 'zhaofei520', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (433, 85, '18630999800', '920215qq', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (434, 85, '18511698798', 'jian5623198', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (435, 85, '15123346221', '47858643', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (436, 85, '15118158319', 'yzn8918561', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (437, 85, '18463373330', '6698ln92', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (438, 85, '13808025061', 'yf5941989', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (439, 85, '13918025806', '871208', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (440, 85, '13530114909', 'abc88888', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (441, 85, '15019250055', 'linyishu001', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (442, 85, '13926861063', 'shuijing08A', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (443, 85, '18523995990', 'zl760829', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (444, 85, '18716690275', '66867553', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (445, 85, '18602256602', 'zhanglei123', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (446, 85, '15623009943', 'cxks2020', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (447, 85, '18601632570', 'dt19891028', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (448, 85, '15957168328', '3W4E5R6T', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (449, 85, '18647049320', 'lili886699', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (450, 85, '13916535472', 'SkyLove080892', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (451, 85, '15844072452', 'wushirenfei1314', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (452, 85, '15562167898', 'apple12031981', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (453, 85, '13468792357', 'chenwen612618', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (454, 85, '18569050931', 'wz6180572', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (455, 85, '18682260451', 'chenchen1989', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (456, 85, '15926411015', 'woow76860722', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (457, 85, '18121150353', '911027', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (458, 85, '13482877770', '19880430', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (459, 85, '18015047291', 'yinjun1992', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (460, 85, '15757327153', 'kuangdi', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (461, 85, '18068256888', '1988715', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (462, 85, '13116213610', 'ntcino0394', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (463, 85, '15985771111', 'chen422113', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (464, 85, '18686688412', '19841223', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (465, 85, '18612617014', 'a7115820', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (466, 85, '13985115817', '890415zsz', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (467, 85, '18170218260', 'hq8222056', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (468, 85, '18630970424', 'fengyun', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (469, 85, '13667714224', 'buzhidao1', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (470, 85, '18080948577', 'ckx520', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (471, 85, '13617642843', 'mi198935', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (472, 85, '13791312785', '1346790', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (473, 85, '18307212727', 'jian257758', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (474, 85, '13809038698', '131452077', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (475, 85, '18647130807', '19910807kun', 2, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (476, 85, '13581605529', 'jdn881102', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (477, 85, '18672199368', '5740197qian', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (478, 85, '15257570920', 'heying321', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (479, 85, '13601864583', 'wanggy1984', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (480, 85, '15026986252', '65441681lj', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (481, 85, '18672780532', 'aixin0810', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (482, 85, '18686448654', 'hyh485912', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (483, 85, '18611944881', '882829', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (484, 85, '15902844015', '1gejujube', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (485, 85, '18652880103', 'ywh00000000123', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (486, 85, '18608525936', 'lxxlh547792', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (487, 85, '13600270300', '2300070', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (488, 85, '18666629031', '334952lizhi', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (489, 85, '13617497384', 'haodianguo8', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (490, 85, '13910561576', 'simonliu6789', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (491, 85, '18099161108', 'zhaojing520', 2, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (492, 85, '13660338882', 'huan8219', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (493, 85, '13810385469', 'richie425633', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (494, 85, '18658428032', 'phy19890717', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (495, 85, '13944107767', '518chuntian', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (496, 85, '18049888582', 'rei1983', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (497, 85, '13220176011', '2965503', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (498, 85, '18225979030', 'pan5950883', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (499, 85, '15546692187', '003141', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (500, 85, '18985612938', 'dubin920817.', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (501, 85, '15911675995', 'cc6610195', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (502, 85, '13482599465', 'ly408310764', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (503, 85, '18329135051', 'FZNGAME', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (504, 85, '15930741359', '135781012', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (505, 85, '18989481110', 'qq112626', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (506, 85, '15317008592', 'wuliao123', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (507, 85, '15821355422', 'le6han232', 2, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (508, 85, '18804605703', 'linLOVEyu1314', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (509, 85, '18986556777', 'dandan520', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (510, 85, '13371280672', 'wosile', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (511, 85, '18261565810', 'cd225225', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (512, 85, '15210049212', '640706', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (513, 85, '15840225209', 'hs890203', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (514, 85, '18576081155', 'fdd866558', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (515, 85, '18751823776', 'mj1b1b', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (516, 85, '18552402578', 'majun880829', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (517, 85, '15237400037', 'li7603685', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (518, 85, '18660414210', 'wangshuai11', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (519, 85, '18611287955', 'az19x88ty', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (520, 85, '18616671952', 'goodfella11', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (521, 85, '15567833555', '64864815', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (522, 85, '13959281534', '890520', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (523, 85, '15953181855', 'top19950518', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (524, 85, '15350010596', 'zhu3465500', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (525, 85, '13915039117', 'mjj5326032', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (526, 85, '13761074791', 'tsy915.', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (527, 85, '15838259104', 'a3298227', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (528, 85, '15618519870', '123a654b', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (529, 85, '15680271111', '19921128', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (530, 85, '15618496902', '5201314z', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (531, 85, '18621778363', '5557894', 2, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (532, 85, '15360504741', 'dd1314520', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (533, 85, '15067666295', 'momo59420', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (534, 85, '13466633445', 'aptx_4869', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (535, 85, '18505812923', 'z123123', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (536, 85, '13840888838', 'sundeyu6300', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (537, 85, '18610772595', 'tang841122', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (538, 85, '15950332227', '198435', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (539, 85, '18093599933', '123457', 2, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (540, 85, '18699463988', '364528', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (541, 85, '13952616363', 'hjf587434', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (542, 85, '13401868813', 'dd881020', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (543, 85, '15868688251', 'q2506499', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (544, 85, '13054915444', 'hh789789', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (545, 85, '13877591215', '8882253', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (546, 85, '18663609652', 'z7252725', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (547, 85, '13951007265', 'jinsha', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (548, 85, '18503006015', 'jianrong', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (549, 85, '13951856262', '4879115a', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (550, 85, '18566761946', '123654ab', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (551, 85, '13457656714', 'ccxx123456', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (552, 85, '18516005404', 'dhs19910212', 3, 1, 1, 1558363247, 1558363247);
INSERT INTO `mini_freeaccounts` VALUES (553, 86, '15997350766', 'a5257525', 0, 1, 1, 1558445455, 1558445455);
INSERT INTO `mini_freeaccounts` VALUES (554, 86, '15827257776', 'shinichi', 0, 1, 1, 1558445455, 1558445455);
INSERT INTO `mini_freeaccounts` VALUES (555, 86, '18233286820', 'dell1992', 0, 1, 1, 1558445455, 1558445455);
INSERT INTO `mini_freeaccounts` VALUES (556, 86, '13930887603', 'wanji1989', 1, 1, 1, 1558445455, 1558445455);
INSERT INTO `mini_freeaccounts` VALUES (557, 86, '18500226013', 'dingchao', 1, 1, 1, 1558445455, 1558445455);
INSERT INTO `mini_freeaccounts` VALUES (558, 86, '18678895991', '195611', 1, 1, 1, 1558445455, 1558445455);
INSERT INTO `mini_freeaccounts` VALUES (559, 86, '13817382090', '19810803a', 1, 1, 1, 1558445455, 1558445455);
INSERT INTO `mini_freeaccounts` VALUES (560, 86, '13770846961', '2005516', 1, 1, 1, 1558445455, 1558445455);
INSERT INTO `mini_freeaccounts` VALUES (561, 86, '18805112688', '65749046', 0, 1, 1, 1558445455, 1558445455);
INSERT INTO `mini_freeaccounts` VALUES (562, 86, '18628283863', '981887', 0, 1, 1, 1558445455, 1558445455);
INSERT INTO `mini_freeaccounts` VALUES (563, 86, '18610886280', '123asd', 0, 1, 1, 1558445455, 1558445455);
INSERT INTO `mini_freeaccounts` VALUES (564, 86, '13761105661', '652927yang', 1, 1, 1, 1558445455, 1558445455);
INSERT INTO `mini_freeaccounts` VALUES (565, 86, '13687332978', '1989218', 0, 1, 1, 1558445455, 1558445455);
INSERT INTO `mini_freeaccounts` VALUES (566, 86, '13301004523', 'hxn5211314', 1, 1, 1, 1558445455, 1558445455);
INSERT INTO `mini_freeaccounts` VALUES (567, 86, '13821256894', 'Jolin1019', 1, 1, 1, 1558445455, 1558445455);
INSERT INTO `mini_freeaccounts` VALUES (568, 86, '13685292283', '071504120', 1, 1, 1, 1558445455, 1558445455);
INSERT INTO `mini_freeaccounts` VALUES (569, 86, '13621759895', '140bing', 0, 1, 1, 1558445455, 1558445455);
INSERT INTO `mini_freeaccounts` VALUES (570, 87, '13770846961', '2005516', 0, 1, 1, 1558535397, 1558535397);
INSERT INTO `mini_freeaccounts` VALUES (571, 87, '18805112688', '65749046', 0, 1, 1, 1558535397, 1558535397);
INSERT INTO `mini_freeaccounts` VALUES (572, 87, '18628283863', '981887', 0, 1, 1, 1558535397, 1558535397);
INSERT INTO `mini_freeaccounts` VALUES (573, 87, '18610886280', '123asd', 1, 1, 1, 1558535397, 1558782657);
INSERT INTO `mini_freeaccounts` VALUES (574, 87, '13761105661', '652927yang', 0, 1, 1, 1558535397, 1558535397);
INSERT INTO `mini_freeaccounts` VALUES (575, 87, '13687332978', '1989218', 1, 1, 1, 1558535397, 1558535397);
INSERT INTO `mini_freeaccounts` VALUES (576, 87, '13301004523', 'hxn5211314', 0, 1, 1, 1558535397, 1558535397);
INSERT INTO `mini_freeaccounts` VALUES (577, 87, '13821256894', 'Jolin1019', 1, 1, 1, 1558535397, 1558535397);
INSERT INTO `mini_freeaccounts` VALUES (578, 87, '13685292283', '071504120', 0, 1, 1, 1558535397, 1558536688);
INSERT INTO `mini_freeaccounts` VALUES (579, 87, '13621759895', '140bing', 0, 1, 1, 1558535397, 1558535397);
INSERT INTO `mini_freeaccounts` VALUES (580, 87, '13804982671', '89118192', 0, 1, 1, 1558535397, 1558535397);
INSERT INTO `mini_freeaccounts` VALUES (581, 87, '17721867520', 'gogo1314!', 0, 1, 1, 1558535397, 1558535397);
INSERT INTO `mini_freeaccounts` VALUES (582, 87, '18615776645', 'kobe860831', 1, 1, 1, 1558535397, 1558535397);
INSERT INTO `mini_freeaccounts` VALUES (583, 87, '13698983949', '5234012y', 1, 1, 1, 1558535397, 1558535397);
INSERT INTO `mini_freeaccounts` VALUES (584, 87, '13539183669', 'lb683669', 1, 1, 1, 1558535397, 1558535397);
INSERT INTO `mini_freeaccounts` VALUES (585, 88, '13770846961', '2005516', 0, 1, 1, 1558535473, 1558535473);
INSERT INTO `mini_freeaccounts` VALUES (586, 88, '18805112688', '65749046', 0, 1, 1, 1558535473, 1558535473);
INSERT INTO `mini_freeaccounts` VALUES (587, 88, '18628283863', '981887', 1, 1, 1, 1558535473, 1558535473);
INSERT INTO `mini_freeaccounts` VALUES (588, 88, '18610886280', '123asd', 1, 1, 1, 1558535473, 1558535473);
INSERT INTO `mini_freeaccounts` VALUES (589, 88, '13761105661', '652927yang', 1, 1, 1, 1558535473, 1558535473);
INSERT INTO `mini_freeaccounts` VALUES (590, 88, '13687332978', '1989218', 1, 1, 1, 1558535473, 1558535473);
INSERT INTO `mini_freeaccounts` VALUES (591, 88, '13301004523', 'hxn5211314', 1, 1, 1, 1558535473, 1558535473);
INSERT INTO `mini_freeaccounts` VALUES (592, 88, '13821256894', 'Jolin1019', 0, 1, 1, 1558535473, 1558535473);
INSERT INTO `mini_freeaccounts` VALUES (593, 88, '13685292283', '071504120', 1, 1, 1, 1558535473, 1558535473);
INSERT INTO `mini_freeaccounts` VALUES (594, 88, '13621759895', '140bing', 0, 1, 1, 1558535473, 1558535473);
INSERT INTO `mini_freeaccounts` VALUES (595, 88, '13804982671', '89118192', 0, 1, 1, 1558535473, 1558535473);
INSERT INTO `mini_freeaccounts` VALUES (596, 88, '17721867520', 'gogo1314!', 0, 1, 1, 1558535473, 1558535473);
INSERT INTO `mini_freeaccounts` VALUES (597, 88, '18615776645', 'kobe860831', 0, 1, 1, 1558535473, 1558535473);
INSERT INTO `mini_freeaccounts` VALUES (598, 88, '13698983949', '5234012y', 1, 1, 1, 1558535473, 1558535473);
INSERT INTO `mini_freeaccounts` VALUES (599, 88, '13539183669', 'lb683669', 0, 1, 1, 1558535473, 1558535473);
INSERT INTO `mini_freeaccounts` VALUES (600, 87, 'dsfdsgdfgdfh', '', 1, 1, 1, 1561779656, 1561779656);
INSERT INTO `mini_freeaccounts` VALUES (601, 87, 'dsgdfgfdh', '', 1, 1, 1, 1561779679, 1561779679);
INSERT INTO `mini_freeaccounts` VALUES (602, 87, '斯蒂芬規劃局v', '', 1, 1, 1, 1561781250, 1561781250);
INSERT INTO `mini_freeaccounts` VALUES (603, 87, '的風格', '', 1, 1, 1, 1561781295, 1561781295);
INSERT INTO `mini_freeaccounts` VALUES (604, 87, '發士大夫嘎嘎', '', 1, 1, 1, 1561781351, 1561781351);
INSERT INTO `mini_freeaccounts` VALUES (605, 90, '水水水水', '', 0, 1, 1, 1561782437, 1561782437);

-- ----------------------------
-- Table structure for mini_freeconfig_main
-- ----------------------------
DROP TABLE IF EXISTS `mini_freeconfig_main`;
CREATE TABLE `mini_freeconfig_main`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'logo',
  `parent_cate_id` int(11) NOT NULL DEFAULT 0 COMMENT '大分类ID号（视频，阅读）',
  `parent_cate_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '顶级分类名',
  `cateId` int(11) NOT NULL DEFAULT 0 COMMENT '平台分类（乐视，爱奇艺。。。）',
  `vip_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '会员种类，平台名（爱奇艺）',
  `vipType` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '会员类型，黄金，白银',
  `accountType` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '账号类型；激活码，账号密码',
  `account_times` tinyint(1) NOT NULL DEFAULT 1 COMMENT '每个账号提取次数',
  `item_count` tinyint(1) NOT NULL DEFAULT 0 COMMENT '每个时间段发放的数量',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态；1：正常；0：下架；2：删除',
  `code_num` tinyint(1) NOT NULL DEFAULT 1 COMMENT '每个账号理论上运需登录次数；接码次数或乐视登录次数',
  `login_help` tinyint(1) NOT NULL DEFAULT 0 COMMENT '账号类型；0：直接显示账号密码或CDK；1：需要获取手机验证码；2：需要获取乐视免验证登录卡密',
  `viptime` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '会员时长、会员名',
  `endTime` int(4) NOT NULL DEFAULT 0 COMMENT '会员到期时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 93 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_freeconfig_main
-- ----------------------------
INSERT INTO `mini_freeconfig_main` VALUES (85, 'logo__1558202456605.png', 46, '视频', 48, '爱奇艺', '21', '19', 3, 3, 2, 1, 2, '11天卡', 0);
INSERT INTO `mini_freeconfig_main` VALUES (86, 'logo__1558202456605.png', 46, '视频', 48, '爱奇艺', '22', '19', 1, 3, 1, 1, 0, '9天卡', 0);
INSERT INTO `mini_freeconfig_main` VALUES (87, 'logo__1558202469582.png', 46, '视频', 49, '优酷', '21', '19', 1, 5, 2, 1, 0, '1天卡', 1561781349);
INSERT INTO `mini_freeconfig_main` VALUES (88, 'logo__1558202456605.png', 46, '视频', 48, '爱奇艺', '21', '20', 1, 3, 1, 1, 0, '周卡', 0);
INSERT INTO `mini_freeconfig_main` VALUES (90, 'logo__1558202469582.png', 46, '视频', 49, '优酷', '21', '19', 1, 2, 1, 1, 0, '2天卡', 1561824000);
INSERT INTO `mini_freeconfig_main` VALUES (91, 'logo__1558202469582.png', 46, '视频', 49, '优酷', '21', '19', 1, 0, 1, 1, 0, '5天卡', 1561781349);
INSERT INTO `mini_freeconfig_main` VALUES (92, 'logo__1558202469582.png', 46, '视频', 49, '优酷', '21', '19', 1, 0, 1, 1, 0, '10天卡', 1561781349);

-- ----------------------------
-- Table structure for mini_freevip_cate
-- ----------------------------
DROP TABLE IF EXISTS `mini_freevip_cate`;
CREATE TABLE `mini_freevip_cate`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cateId` int(11) NOT NULL DEFAULT 0 COMMENT '会员种类ID号',
  `cate_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '会员种类名称',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '当前会员种类状态；1：默认正常；0：下架',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_freevip_cate
-- ----------------------------
INSERT INTO `mini_freevip_cate` VALUES (17, 46, '视频', 1);
INSERT INTO `mini_freevip_cate` VALUES (18, 47, '音乐', 1);

-- ----------------------------
-- Table structure for mini_freevip_get_record
-- ----------------------------
DROP TABLE IF EXISTS `mini_freevip_get_record`;
CREATE TABLE `mini_freevip_get_record`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户唯一标志',
  `free_main_id` int(11) NOT NULL DEFAULT 0 COMMENT '账号配置ID号',
  `account_id` int(11) NOT NULL DEFAULT 0 COMMENT '领取的会员ID号',
  `code_num` tinyint(1) NOT NULL DEFAULT 1 COMMENT '剩余获取验证码次数或乐视免费登录次数；默认：1',
  `login_help` tinyint(1) NULL DEFAULT 0 COMMENT '账号类型；0：直接显示账号密码或CDK；1：需要获取手机验证码；2：需要获取乐视免验证登录卡密',
  `accountType` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '账号类型',
  `vip_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '会员名；爱奇艺',
  `vipType` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '会员类型；黄金',
  `viptime` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '会员时长',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '账号状态；默认1：正常；0：禁用',
  `created_at` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '领取时间',
  `updated_at` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `account_id`(`account_id`) USING BTREE,
  INDEX `uuid`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 54 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_freevip_get_record
-- ----------------------------
INSERT INTO `mini_freevip_get_record` VALUES (20, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 86, 561, 4, 3, '账号密码', '爱奇艺', '白金会员', '9天卡', 1, '1558445483', '1558445483');
INSERT INTO `mini_freevip_get_record` VALUES (21, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 85, 539, 80, 2, '账号密码', '爱奇艺', '黄金会员', '11天卡', 1, '1558445487', '1558445487');
INSERT INTO `mini_freevip_get_record` VALUES (22, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 87, 578, 1, 0, '账号密码', '优酷', '黄金会员', '周卡', 1, '1558535429', '1558535429');
INSERT INTO `mini_freevip_get_record` VALUES (23, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 88, 592, 1, 0, '激活码', '爱奇艺', '黄金会员', '周卡', 1, '1558535489', '1558535489');
INSERT INTO `mini_freevip_get_record` VALUES (24, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 87, 576, 1, 0, '账号密码', '优酷', '黄金会员', '周卡', 1, '1558795477', '1558795477');
INSERT INTO `mini_freevip_get_record` VALUES (25, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 88, 594, 1, 0, '激活码', '爱奇艺', '黄金会员', '周卡', 1, '1558797907', '1558797907');
INSERT INTO `mini_freevip_get_record` VALUES (26, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 86, 569, 1, 0, '账号密码', '爱奇艺', '白金会员', '9天卡', 1, '1558797932', '1558797932');
INSERT INTO `mini_freevip_get_record` VALUES (27, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 85, 507, 1, 2, '账号密码', '爱奇艺', '黄金会员', '11天卡', 1, '1558797937', '1558797937');
INSERT INTO `mini_freevip_get_record` VALUES (28, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 87, 580, 1, 0, '账号密码', '优酷', '黄金会员', '周卡', 1, '1558797958', '1558797958');
INSERT INTO `mini_freevip_get_record` VALUES (29, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 88, 585, 1, 0, '激活码', '爱奇艺', '黄金会员', '周卡', 1, '1558797962', '1558797962');
INSERT INTO `mini_freevip_get_record` VALUES (30, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 86, 553, 1, 0, '账号密码', '爱奇艺', '白金会员', '9天卡', 1, '1558797967', '1558797967');
INSERT INTO `mini_freevip_get_record` VALUES (31, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 85, 395, 1, 2, '账号密码', '爱奇艺', '黄金会员', '11天卡', 1, '1558797971', '1558797971');
INSERT INTO `mini_freevip_get_record` VALUES (32, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 87, 581, 1, 0, '账号密码', '优酷', '黄金会员', '周卡', 1, '1558797997', '1558797997');
INSERT INTO `mini_freevip_get_record` VALUES (33, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 88, 595, 1, 0, '激活码', '爱奇艺', '黄金会员', '周卡', 1, '1558798002', '1558798002');
INSERT INTO `mini_freevip_get_record` VALUES (34, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 86, 563, 1, 0, '账号密码', '爱奇艺', '白金会员', '9天卡', 1, '1558798007', '1558798007');
INSERT INTO `mini_freevip_get_record` VALUES (35, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 85, 411, 1, 2, '账号密码', '爱奇艺', '黄金会员', '11天卡', 1, '1558798011', '1558798011');
INSERT INTO `mini_freevip_get_record` VALUES (36, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 87, 579, 1, 0, '账号密码', '优酷', '黄金会员', '周卡', 1, '1558800586', '1558800586');
INSERT INTO `mini_freevip_get_record` VALUES (37, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 88, 596, 1, 0, '激活码', '爱奇艺', '黄金会员', '周卡', 1, '1558800589', '1558800589');
INSERT INTO `mini_freevip_get_record` VALUES (38, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 86, 562, 1, 0, '账号密码', '爱奇艺', '白金会员', '9天卡', 1, '1558800595', '1558800595');
INSERT INTO `mini_freevip_get_record` VALUES (39, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 85, 531, 1, 2, '账号密码', '爱奇艺', '黄金会员', '11天卡', 1, '1558800603', '1558800603');
INSERT INTO `mini_freevip_get_record` VALUES (40, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 87, 570, 1, 0, '账号密码', '优酷', '黄金会员', '周卡', 1, '1558800618', '1558800618');
INSERT INTO `mini_freevip_get_record` VALUES (41, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 88, 586, 1, 0, '激活码', '爱奇艺', '黄金会员', '周卡', 1, '1558800621', '1558800621');
INSERT INTO `mini_freevip_get_record` VALUES (42, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 86, 565, 1, 0, '账号密码', '爱奇艺', '白金会员', '9天卡', 1, '1558800626', '1558800626');
INSERT INTO `mini_freevip_get_record` VALUES (43, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 85, 475, 1, 2, '账号密码', '爱奇艺', '黄金会员', '11天卡', 1, '1558800633', '1558800633');
INSERT INTO `mini_freevip_get_record` VALUES (44, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 87, 571, 1, 0, '账号密码', '优酷', '黄金会员', '周卡', 1, '1558800648', '1558800648');
INSERT INTO `mini_freevip_get_record` VALUES (45, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 88, 597, 1, 0, '激活码', '爱奇艺', '黄金会员', '周卡', 1, '1558800653', '1558800653');
INSERT INTO `mini_freevip_get_record` VALUES (46, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 86, 554, 1, 0, '账号密码', '爱奇艺', '白金会员', '9天卡', 1, '1558800660', '1558800660');
INSERT INTO `mini_freevip_get_record` VALUES (47, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 85, 491, 1, 2, '账号密码', '爱奇艺', '黄金会员', '11天卡', 1, '1558800665', '1558800665');
INSERT INTO `mini_freevip_get_record` VALUES (48, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 87, 572, 1, 0, '账号密码', '优酷', '黄金会员', '周卡', 1, '1558802159', '1558802159');
INSERT INTO `mini_freevip_get_record` VALUES (49, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 86, 555, 1, 0, '账号密码', '爱奇艺', '白金会员', '9天卡', 1, '1558802174', '1558802174');
INSERT INTO `mini_freevip_get_record` VALUES (50, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 85, 371, 0, 2, '账号密码', '爱奇艺', '黄金会员', '11天卡', 1, '1558802197', '1558802197');
INSERT INTO `mini_freevip_get_record` VALUES (51, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 88, 599, 1, 0, '激活码', '爱奇艺', '黄金会员', '周卡', 1, '1558802233', '1558802233');
INSERT INTO `mini_freevip_get_record` VALUES (52, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 87, 574, 1, 0, '账号密码', '优酷', '黄金会员', '10天卡', 1, '1561782197', '1561782197');
INSERT INTO `mini_freevip_get_record` VALUES (53, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 90, 605, 1, 0, '账号密码', '优酷', '黄金会员', '2天卡', 1, '1561782447', '1561782447');

-- ----------------------------
-- Table structure for mini_get_vip_announce_log
-- ----------------------------
DROP TABLE IF EXISTS `mini_get_vip_announce_log`;
CREATE TABLE `mini_get_vip_announce_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `total` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '当天该时段发送通知的人数',
  `time` int(4) UNSIGNED NOT NULL DEFAULT 0 COMMENT '通知的时间段',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for mini_goods
-- ----------------------------
DROP TABLE IF EXISTS `mini_goods`;
CREATE TABLE `mini_goods`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '商品自增ID号',
  `uid` int(11) NOT NULL DEFAULT 1 COMMENT '商家ID号',
  `isOfficial` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是不是官方自营；0：不是；1：是',
  `goodsType` tinyint(1) NOT NULL DEFAULT 1 COMMENT '商品类型；默认：1：会员账号；2：普通商品',
  `goodsName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品名称',
  `parent_cate_id` tinyint(1) NOT NULL DEFAULT 0 COMMENT '顶级分类ID号',
  `cateId` tinyint(1) NOT NULL DEFAULT 0 COMMENT '分类ID号',
  `accountType` tinyint(1) NULL DEFAULT 0 COMMENT '账号类型对应的ID号',
  `vipType` tinyint(1) NULL DEFAULT 0 COMMENT '账号会员类型对应的ID号',
  `fenqi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '支持的分期列表json',
  `attributes` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品属性价格序列',
  `images` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品轮播图',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品描述；会员账号类',
  `everyTimes` tinyint(1) NULL DEFAULT 1 COMMENT '每个账号允许提取次数；轮询方式',
  `loginHelp` tinyint(1) NULL DEFAULT 0 COMMENT '登录方式；默认：0：账号密码直接登录；1：需要获取手机验证码；2：需要获取乐视免验证登录卡密',
  `loginTimes` tinyint(1) NULL DEFAULT 1 COMMENT '允许登录次数；默认1次；针对接码登录和乐视',
  `stock` int(11) NULL DEFAULT 0 COMMENT '商品库存量',
  `salesNum` int(11) NULL DEFAULT 0 COMMENT '销售数量',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '商品状态；1：正常；2：下架；3：删除',
  `endTime` int(4) NULL DEFAULT 0 COMMENT '会员到期时间',
  `created_at` int(4) NOT NULL DEFAULT 0 COMMENT '添加时间',
  `updated_at` int(4) NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_goods
-- ----------------------------
INSERT INTO `mini_goods` VALUES (34, 1, 1, 1, '1天、3天', 46, 48, 19, 21, '[]', '[{\"attribute\":\"6\\u5929\",\"originAttribute\":\"29\",\"originOldAttribute\":\"29\",\"price\":\"1111\",\"originPrice\":\"1234\"},{\"attribute\":\"15\\u5929\",\"price\":\"7.50\",\"originPrice\":\"\",\"originAttribute\":\"38\",\"originOldAttribute\":\"38\"}]', '[{\"url\":\"goods_swiper__1561886424672.png\"}]', '<p>宣传宣传VB男女宝宝V型</p><p><img src=\"http://img.baidu.com/hi/jx2/j_0028.gif\"/><img width=\"530\" height=\"340\" src=\"http://api.map.baidu.com/staticimage?center=116.404,39.915&zoom=10&width=530&height=340&markers=116.404,39.915\"/></p><pre class=\"brush:php;toolbar:false\">//根路径define([&#39;APP&#39;],function(APP){&nbsp;&nbsp;&nbsp;&nbsp;&#39;use&nbsp;strict&#39;;\n&nbsp;&nbsp;&nbsp;&nbsp;APP.controller(&#39;SlideController&#39;,&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&quot;title&quot;,&#39;$scope&#39;,&#39;$state&#39;,function(&nbsp;title&nbsp;,&nbsp;$scope&nbsp;,&nbsp;$state)&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//声明\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$scope.Load&nbsp;=&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bussiness:&nbsp;function()&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//执行函数&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;swiper1&nbsp;=&nbsp;new&nbsp;Swiper(&#39;.Slide1&#39;,&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pagination:&nbsp;&#39;.pagination1&#39;,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;paginationClickable:&nbsp;true,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;autoplay:&nbsp;3600,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;spaceBetween:&nbsp;30\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;});&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;swiper2&nbsp;=&nbsp;new&nbsp;Swiper(&#39;.Slide2&#39;,&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pagination:&nbsp;&#39;.pagination2&#39;,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;paginationClickable:&nbsp;true,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;direction:&nbsp;&#39;vertical&#39;\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;});&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;swiper3&nbsp;=&nbsp;new&nbsp;Swiper(&#39;.Slide3&#39;,&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pagination:&nbsp;&#39;.pagination3&#39;,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;slidesPerView:&nbsp;3,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;paginationClickable:&nbsp;true,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;spaceBetween:&nbsp;10\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;});&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;swiper4&nbsp;=&nbsp;new&nbsp;Swiper(&#39;.Slide4&#39;,&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pagination:&nbsp;&#39;.pagination4&#39;,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;slidesPerView:&nbsp;&#39;auto&#39;,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;centeredSlides:&nbsp;true,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;paginationClickable:&nbsp;true,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;spaceBetween:&nbsp;10\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;});&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;swiper5&nbsp;=&nbsp;new&nbsp;Swiper(&#39;.Slide5&#39;,&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;slidesPerView:&nbsp;3,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;paginationClickable:&nbsp;true,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;spaceBetween:&nbsp;30,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;freeMode:&nbsp;true\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;});&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;swiper6&nbsp;=&nbsp;new&nbsp;Swiper(&#39;.Slide6&#39;,&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pagination:&nbsp;&#39;.pagination6&#39;,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;paginationClickable:&nbsp;&#39;.swiper-pagination&#39;,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;nextButton:&nbsp;&#39;.swiper-button-next&#39;,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;prevButton:&nbsp;&#39;.swiper-button-prev&#39;,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;spaceBetween:&nbsp;30\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;});&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;swiper7&nbsp;=&nbsp;new&nbsp;Swiper(&#39;.Slide7&#39;,&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pagination:&nbsp;&#39;.pagination7&#39;,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;effect:&nbsp;&#39;cube&#39;,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;grabCursor:&nbsp;true,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;cube:&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;shadow:&nbsp;true,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;slideShadows:&nbsp;true,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;shadowOffset:&nbsp;20,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;shadowScale:&nbsp;0.94\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;});&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;swiper8&nbsp;=&nbsp;new&nbsp;Swiper(&#39;.Slide8&#39;,&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pagination:&nbsp;&#39;.pagination8&#39;,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;effect:&nbsp;&#39;coverflow&#39;,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;grabCursor:&nbsp;true,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;centeredSlides:&nbsp;true,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;slidesPerView:&nbsp;&#39;auto&#39;,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;coverflow:&nbsp;{&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;rotate:&nbsp;50,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;stretch:&nbsp;0,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;depth:&nbsp;100,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;modifier:&nbsp;1,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;slideShadows&nbsp;:&nbsp;true\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;});\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;init&nbsp;:&nbsp;function(){&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//更改页面标题\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;document.title&nbsp;=&nbsp;$scope.$$prevSibling.HeaderTitle&nbsp;=&nbsp;title;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//执行方法\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$scope.Load.bussiness()\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;};&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//运行\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$scope.Load.init();\n&nbsp;&nbsp;&nbsp;&nbsp;}]);&nbsp;&nbsp;&nbsp;&nbsp;\n});</pre><p><br/></p>', 2, 0, 3, 111111, 0, 1, 1563897600, 1561282936, 1561887635);
INSERT INTO `mini_goods` VALUES (35, 1, 1, 2, '夏季男鞋', 52, 53, NULL, NULL, '[]', '[{\"attribute\":\"43\\u7801\",\"originAttribute\":\"0\",\"originOldAttribute\":\"\",\"price\":\"253\",\"originPrice\":\"355\"},{\"attribute\":\"41\\u7801\",\"price\":\"365\",\"originPrice\":\"452\"}]', '[{\"url\":\"goods_swiper__1561888020440.png\"}]', '<p>第三方法国红酒<img src=\"http://img.baidu.com/hi/jx2/j_0027.gif\"/></p>', NULL, NULL, NULL, 1, 0, 1, 0, 1561283010, 1561888903);
INSERT INTO `mini_goods` VALUES (36, 1, 1, 1, '10天', 46, 49, 19, 21, '[\"25\"]', '[{\"attribute\":\"10\\u5929\",\"originAttribute\":\"33\",\"originOldAttribute\":\"33\",\"price\":\"3.5\",\"originPrice\":\"5.6\"}]', '[]', '', 3, 1, 3, 0, 0, 1, 1562256000, 1561377402, 1561377402);

-- ----------------------------
-- Table structure for mini_goods_accounts
-- ----------------------------
DROP TABLE IF EXISTS `mini_goods_accounts`;
CREATE TABLE `mini_goods_accounts`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '索引主键',
  `goodsId` int(11) NOT NULL DEFAULT 0 COMMENT '商品ID号',
  `account` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '账号',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '密码',
  `account_times` tinyint(1) NOT NULL DEFAULT 1 COMMENT '剩余提取次数',
  `code_num` tinyint(1) NOT NULL DEFAULT 1 COMMENT '该账号允许收取验证码或乐视验证次数',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '当前账号的状态；1：正常；0：下架',
  `created_at` int(4) NOT NULL DEFAULT 0 COMMENT '账号添加时间',
  `updated_at` int(4) NOT NULL DEFAULT 0 COMMENT '上次更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 180 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_goods_accounts
-- ----------------------------
INSERT INTO `mini_goods_accounts` VALUES (120, 34, '18621051188', '345395zero', 2, 3, 1, 1561300866, 1561301584);
INSERT INTO `mini_goods_accounts` VALUES (121, 34, '18621051188', '345395zero', 2, 3, 1, 1561300866, 1561301583);
INSERT INTO `mini_goods_accounts` VALUES (122, 34, '13311190370', 'xiongbiao2510', 2, 3, 1, 1561300866, 1561301582);
INSERT INTO `mini_goods_accounts` VALUES (123, 34, '13311190370', 'xiongbiao2510', 2, 3, 1, 1561300866, 1561301583);
INSERT INTO `mini_goods_accounts` VALUES (124, 34, '15988126699', '102865788898', 2, 3, 1, 1561300866, 1561300866);
INSERT INTO `mini_goods_accounts` VALUES (125, 34, '15988126699', '102865788898', 2, 3, 1, 1561300866, 1561300866);
INSERT INTO `mini_goods_accounts` VALUES (126, 34, '18621051188', '345395zero', 2, 3, 1, 1561300866, 1561300866);
INSERT INTO `mini_goods_accounts` VALUES (127, 34, '18621051188', '345395zero', 2, 3, 1, 1561300866, 1561300866);
INSERT INTO `mini_goods_accounts` VALUES (128, 34, '13546567102', 'a040404', 2, 3, 1, 1561300866, 1561300866);
INSERT INTO `mini_goods_accounts` VALUES (129, 34, '13546567102', 'a040404', 2, 3, 1, 1561300866, 1561300866);
INSERT INTO `mini_goods_accounts` VALUES (130, 34, '18118849080', 'wjs001', 4, 3, 1, 1561300866, 1561301174);
INSERT INTO `mini_goods_accounts` VALUES (131, 34, '18118849080', 'wjs001', 2, 3, 1, 1561300866, 1561300866);
INSERT INTO `mini_goods_accounts` VALUES (132, 34, '15108458373', '4238752zzy', 2, 3, 1, 1561300866, 1561300866);
INSERT INTO `mini_goods_accounts` VALUES (133, 34, '15108458373', '4238752zzy', 2, 3, 1, 1561300866, 1561300866);
INSERT INTO `mini_goods_accounts` VALUES (134, 34, '18001819256', 'aini1314', 2, 7, 1, 1561300866, 1561301180);
INSERT INTO `mini_goods_accounts` VALUES (135, 34, '18001819256', 'aini1314', 2, 3, 1, 1561300866, 1561300866);
INSERT INTO `mini_goods_accounts` VALUES (136, 34, '18627068429', 'lh860429', 2, 3, 1, 1561300866, 1561300866);
INSERT INTO `mini_goods_accounts` VALUES (137, 34, '18627068429', 'lh860429', 2, 3, 1, 1561300866, 1561773036);
INSERT INTO `mini_goods_accounts` VALUES (138, 34, '15982155863', '0000000q', 2, 3, 1, 1561300866, 1561300866);
INSERT INTO `mini_goods_accounts` VALUES (139, 34, '15982155863', '0000000q', 2, 3, 1, 1561300866, 1561300866);
INSERT INTO `mini_goods_accounts` VALUES (140, 34, '15858617728', '520123a', 2, 3, 1, 1561300866, 1561300866);
INSERT INTO `mini_goods_accounts` VALUES (141, 34, '15858617728', '520123a', 2, 3, 1, 1561300866, 1561300866);
INSERT INTO `mini_goods_accounts` VALUES (142, 34, '18875902929', '19831228', 2, 3, 1, 1561300866, 1561300866);
INSERT INTO `mini_goods_accounts` VALUES (143, 34, '18875902929', '19831228', 2, 3, 1, 1561300866, 1561300866);
INSERT INTO `mini_goods_accounts` VALUES (144, 34, '13810332283', 'baofeideAE86', 2, 3, 1, 1561300866, 1561300866);
INSERT INTO `mini_goods_accounts` VALUES (145, 34, '18621051188', '345395zero', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (146, 34, '18621051188', '345395zero', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (147, 34, '13311190370', 'xiongbiao2510', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (148, 34, '13311190370', 'xiongbiao2510', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (149, 34, '15988126699', '102865788898', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (150, 34, '15988126699', '102865788898', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (151, 34, '18621051188', '345395zero', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (152, 34, '18621051188', '345395zero', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (153, 34, '13546567102', 'a040404', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (154, 34, '13546567102', 'a040404', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (155, 34, '18118849080', 'wjs001', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (156, 34, '18118849080', 'wjs001', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (157, 34, '15108458373', '4238752zzy', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (158, 34, '15108458373', '4238752zzy', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (159, 34, '18001819256', 'aini1314', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (160, 34, '18001819256', 'aini1314', 2, 3, 1, 1561301251, 1561301279);
INSERT INTO `mini_goods_accounts` VALUES (161, 34, '18627068429', 'lh860429', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (162, 34, '18627068429', 'lh860429', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (163, 34, '15982155863', '0000000q', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (164, 34, '15982155863', '0000000q', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (165, 34, '15858617728', '520123a', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (166, 34, '15858617728', '520123a', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (167, 34, '18875902929', '19831228', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (168, 34, '18875902929', '19831228', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (169, 34, '13810332283', 'baofeideAE86', 2, 3, 1, 1561301251, 1561301251);
INSERT INTO `mini_goods_accounts` VALUES (170, 36, '18621051188', '345395zero', 3, 3, 1, 1561377418, 1561377418);
INSERT INTO `mini_goods_accounts` VALUES (171, 36, '18621051188', '345395zero', 3, 3, 1, 1561377418, 1561377418);
INSERT INTO `mini_goods_accounts` VALUES (172, 36, '13311190370', 'xiongbiao2510', 3, 3, 1, 1561377418, 1561377418);
INSERT INTO `mini_goods_accounts` VALUES (173, 36, '13311190370', 'xiongbiao2510', 3, 3, 1, 1561377418, 1561377418);
INSERT INTO `mini_goods_accounts` VALUES (174, 36, '15988126699', '102865788898', 3, 3, 1, 1561377418, 1561377418);
INSERT INTO `mini_goods_accounts` VALUES (175, 36, '15988126699', '102865788898', 3, 3, 1, 1561377418, 1561377418);
INSERT INTO `mini_goods_accounts` VALUES (176, 36, '18621051188', '345395zero', 3, 3, 1, 1561377418, 1561377418);
INSERT INTO `mini_goods_accounts` VALUES (177, 36, '18621051188', '345395zero', 3, 3, 1, 1561377418, 1561377418);
INSERT INTO `mini_goods_accounts` VALUES (178, 36, '13546567102', 'a040404', 3, 3, 1, 1561377418, 1561377418);
INSERT INTO `mini_goods_accounts` VALUES (179, 36, '13546567102', 'a040404', 3, 3, 1, 1561377418, 1561377418);

-- ----------------------------
-- Table structure for mini_login_code
-- ----------------------------
DROP TABLE IF EXISTS `mini_login_code`;
CREATE TABLE `mini_login_code`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '获取到的验证码',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '验证码状态',
  `created_at` int(4) NOT NULL DEFAULT 0 COMMENT '获取验证码的时间戳',
  `updated_at` int(4) NOT NULL DEFAULT 0 COMMENT '验证码更新时间',
  `fgr_id` int(11) NOT NULL DEFAULT 0 COMMENT '获取到的账号记录ID号',
  `num` tinyint(1) NOT NULL DEFAULT 1 COMMENT '获取验证码次数',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fgr_id`(`fgr_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_login_code
-- ----------------------------
INSERT INTO `mini_login_code` VALUES (14, 'IVsD', 0, 1556205445, 1556354655, 52, 5);
INSERT INTO `mini_login_code` VALUES (15, 'IT1x', 1, 1556205494, 1556205494, 53, 1);
INSERT INTO `mini_login_code` VALUES (16, 'psKL', 1, 1556205603, 1556205603, 54, 1);
INSERT INTO `mini_login_code` VALUES (17, 'K74r', 0, 1556355084, 1556355084, 56, 1);
INSERT INTO `mini_login_code` VALUES (18, 'hEOi', 0, 1556355428, 1556355428, 57, 1);
INSERT INTO `mini_login_code` VALUES (19, 'ZSoH', 0, 1556375444, 1556375444, 58, 1);
INSERT INTO `mini_login_code` VALUES (20, 'NLwH', 1, 1556462631, 1556462631, 59, 1);
INSERT INTO `mini_login_code` VALUES (22, 'cZpz', 0, 1556678048, 1556678048, 60, 1);
INSERT INTO `mini_login_code` VALUES (23, 'tQD0', 1, 1557411840, 1557412727, 62, 9);
INSERT INTO `mini_login_code` VALUES (24, 'EUdF', 1, 1557662244, 1557753136, 61, 10);
INSERT INTO `mini_login_code` VALUES (25, 'lWEd', 1, 1557753117, 1557753117, 64, 1);
INSERT INTO `mini_login_code` VALUES (26, 'EIAq', 1, 1558014069, 1558014069, 66, 1);
INSERT INTO `mini_login_code` VALUES (27, 'rLKv', 1, 1558247459, 1558247459, 4, 1);
INSERT INTO `mini_login_code` VALUES (28, 'FZ1V', 1, 1558447554, 1558447576, 20, 24);
INSERT INTO `mini_login_code` VALUES (29, '4vky', 1, 1558447579, 1558782880, 21, 55);
INSERT INTO `mini_login_code` VALUES (30, 'vc38', 1, 1558802347, 1558802347, 50, 1);

-- ----------------------------
-- Table structure for mini_menu
-- ----------------------------
DROP TABLE IF EXISTS `mini_menu`;
CREATE TABLE `mini_menu`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '菜单序列号',
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '菜单名',
  `router` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '路由',
  `sort` int(4) NOT NULL DEFAULT 1 COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态；默认：1，正常；0：关闭',
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '图标',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_menu
-- ----------------------------
INSERT INTO `mini_menu` VALUES (18, 0, '菜单管理', 'menu/index', 0, 1, 'fa-bars');
INSERT INTO `mini_menu` VALUES (19, 0, '用户管理', 'user/index', 1, 1, 'fa-user-circle');
INSERT INTO `mini_menu` VALUES (25, 0, '平台管理', 'account/index', 1, 1, 'fa-qq');
INSERT INTO `mini_menu` VALUES (26, 25, '分类管理', 'accountcate/index', 1, 1, '0');
INSERT INTO `mini_menu` VALUES (27, 25, '平台配置', 'accountconfig/index', 1, 1, 'fa-cog');
INSERT INTO `mini_menu` VALUES (28, 0, '免费会员管理', 'freevip/index', 1, 1, 'fa-vimeo-square');
INSERT INTO `mini_menu` VALUES (29, 28, '免费会员配置', 'freevip/index', 1, 1, 'fa-cog');
INSERT INTO `mini_menu` VALUES (30, 0, '设置', 'settting/index', 1, 1, 'fa-cog');
INSERT INTO `mini_menu` VALUES (31, 30, 'App设置', 'setting/app-index', 1, 1, 'fa-android');
INSERT INTO `mini_menu` VALUES (32, 0, '用户反馈中心', 'feedback/feedback/index', 1, 1, 'fa-info-circle');
INSERT INTO `mini_menu` VALUES (33, 28, '账号提取记录', 'freevipgetrecord/index', 1, 1, 'fa-list-ol');
INSERT INTO `mini_menu` VALUES (34, 0, '商品管理', 'goods/goods/index', 1, 1, 'fa-shopping-cart');
INSERT INTO `mini_menu` VALUES (35, 34, '商品列表', 'goods/goods/index', 1, 1, ' fa-th-large');

-- ----------------------------
-- Table structure for mini_sign
-- ----------------------------
DROP TABLE IF EXISTS `mini_sign`;
CREATE TABLE `mini_sign`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户唯一标志',
  `count` int(1) NOT NULL DEFAULT 0 COMMENT '本周累计签到次数',
  `all_count` int(4) NOT NULL DEFAULT 0 COMMENT '总累计签到次数',
  `all_integral` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '累计获赠积分',
  `created_at` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '首次签到时间',
  `updated_at` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '上次签到时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_sign
-- ----------------------------
INSERT INTO `mini_sign` VALUES (23, 'c3e7de28-c5e4-4dd7-a5db-2932f125ddc3', 2, 12, 15, '1555857607', '1558013654');
INSERT INTO `mini_sign` VALUES (24, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', 3, 5, 6, '1558013920', '1558802291');

-- ----------------------------
-- Table structure for mini_sign_record
-- ----------------------------
DROP TABLE IF EXISTS `mini_sign_record`;
CREATE TABLE `mini_sign_record`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '签到日志，序号',
  `sign_id` int(11) NOT NULL DEFAULT 0 COMMENT '关联的用户签到信息',
  `integral` tinyint(1) NOT NULL DEFAULT 0 COMMENT '本次签到奖励的积分',
  `created_at` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '签到时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `签到ID`(`sign_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 346 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_sign_record
-- ----------------------------
INSERT INTO `mini_sign_record` VALUES (329, 23, 1, '1555857607');
INSERT INTO `mini_sign_record` VALUES (330, 23, 1, '1555862420');
INSERT INTO `mini_sign_record` VALUES (331, 23, 1, '1555940635');
INSERT INTO `mini_sign_record` VALUES (332, 23, 1, '1555943429');
INSERT INTO `mini_sign_record` VALUES (333, 23, 2, '1556456901');
INSERT INTO `mini_sign_record` VALUES (334, 23, 1, '1556753134');
INSERT INTO `mini_sign_record` VALUES (335, 23, 2, '1556842435');
INSERT INTO `mini_sign_record` VALUES (336, 23, 1, '1557318863');
INSERT INTO `mini_sign_record` VALUES (337, 23, 1, '1557411646');
INSERT INTO `mini_sign_record` VALUES (338, 23, 1, '1557496431');
INSERT INTO `mini_sign_record` VALUES (339, 23, 1, '1558013458');
INSERT INTO `mini_sign_record` VALUES (340, 23, 2, '1558013654');
INSERT INTO `mini_sign_record` VALUES (341, 24, 1, '1558013920');
INSERT INTO `mini_sign_record` VALUES (342, 24, 2, '1558233959');
INSERT INTO `mini_sign_record` VALUES (343, 24, 1, '1558707730');
INSERT INTO `mini_sign_record` VALUES (344, 24, 1, '1558768984');
INSERT INTO `mini_sign_record` VALUES (345, 24, 1, '1558802291');

-- ----------------------------
-- Table structure for mini_swiper
-- ----------------------------
DROP TABLE IF EXISTS `mini_swiper`;
CREATE TABLE `mini_swiper`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '轮播图状态',
  `sort` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '排序权重',
  `imgUrl` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图片地址',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '对应的内容',
  `created_at` int(4) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `updated_at` int(4) NOT NULL DEFAULT 0 COMMENT '上次更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_swiper
-- ----------------------------
INSERT INTO `mini_swiper` VALUES (3, 1, 3, 'swiper__1556854681861.png', '', '', 1556805893, 1556871122);
INSERT INTO `mini_swiper` VALUES (4, 1, 2, 'swiper__1556805895373.png', '', '', 1556805896, 1556871137);
INSERT INTO `mini_swiper` VALUES (5, 1, 1, 'swiper__1556805899592.png', '', '', 1556805901, 1556805901);
INSERT INTO `mini_swiper` VALUES (6, 1, 1, 'swiper__1556845597473.png', '反倒是', '<p>富商大贾</p>', 1556805905, 1556870889);
INSERT INTO `mini_swiper` VALUES (11, 1, 1, 'swiper__1556845585176.png', '马尔快跑', '<p>佛挡杀佛防守打法</p>', 1556845587, 1556870988);

-- ----------------------------
-- Table structure for mini_user
-- ----------------------------
DROP TABLE IF EXISTS `mini_user`;
CREATE TABLE `mini_user`  (
  `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id序号',
  `uuid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户位置标志；后台生成',
  `nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户昵称',
  `tel` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '手机号',
  `openid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '微信生成的openID',
  `sex` tinyint(1) NOT NULL DEFAULT 0 COMMENT '用户性别；0：女；1：男；2未知',
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '城市',
  `province` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '省份',
  `country` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '国家',
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户头像链接',
  `unionid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户联合ID',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '用户状态；默认：1普通正常状态；0：拉黑',
  `created_at` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '注册时间',
  `updated_at` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '上次更新时间',
  PRIMARY KEY (`uid`, `uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_user
-- ----------------------------
INSERT INTO `mini_user` VALUES (1, 'd54c842f-71a6-41b8-a3d4-e7068649bb69', '雨后桥前', '17678328512', 'oYysC0V_MxgR3ftQJfqn6eLSQTOI', 1, 'Bozhou', 'Anhui', 'China', 'https://wx.qlogo.cn/mmopen/vi_32/pnNTuaCyYuIwmocUKMSUJkSibsC7J2hANiaib10pALmGCBG9Cgic0cpCzV2SAWg39CRFRs8icO46UbcgP2QI3EzPkaA/132', 'oYysC0V_MxgR3ftQJfqn6eLSQTOI', 1, '1558013908', '1558013908');

-- ----------------------------
-- Table structure for mini_user_token
-- ----------------------------
DROP TABLE IF EXISTS `mini_user_token`;
CREATE TABLE `mini_user_token`  (
  `uuid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '微信联合id',
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'app校验码',
  `timeout` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '校验码过期时间',
  PRIMARY KEY (`uuid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mini_user_token
-- ----------------------------
INSERT INTO `mini_user_token` VALUES ('97892ea6-3c6c-47cd-8641-3cb47ad4f8a2', 'ff3f5c809bf80e3cdd1cf4a16cfc6a69', '1558012234');
INSERT INTO `mini_user_token` VALUES ('c3e7de28-c5e4-4dd7-a5db-2932f125ddc3', '034dd728c0450d19e2996233e8243084', '1558615218');
INSERT INTO `mini_user_token` VALUES ('d54c842f-71a6-41b8-a3d4-e7068649bb69', '47369b21e6fac8d8905fbccf14d9c176', '1562496035');

-- ----------------------------
-- Table structure for mini_userinfo
-- ----------------------------
DROP TABLE IF EXISTS `mini_userinfo`;
CREATE TABLE `mini_userinfo`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用戶信息Id号',
  `uid` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户ID号',
  `role` tinyint(1) NOT NULL DEFAULT 1 COMMENT '用户角色；1：普通用户；2：商家用户；3：vip用户；4：平台自身',
  `star` int(4) NOT NULL DEFAULT 0 COMMENT '评分，星星数',
  `followerNum` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '关注着数量，粉丝数量',
  `integral` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户积分，签到等获得',
  `vConin` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'V币数量',
  `money` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '账户现金余额',
  `created_at` int(4) NOT NULL DEFAULT 0 COMMENT '添加时间',
  `updated_at` int(4) NOT NULL DEFAULT 0 COMMENT '上次更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
