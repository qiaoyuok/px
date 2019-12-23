/*
Navicat MySQL Data Transfer

Source Server         : 本地Linux
Source Server Version : 50642
Source Host           : 192.168.1.103:3306
Source Database       : mini

Target Server Type    : MYSQL
Target Server Version : 50642
File Encoding         : 65001

Date: 2019-05-21 23:03:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mini_menu
-- ----------------------------
DROP TABLE IF EXISTS `mini_menu`;
CREATE TABLE `mini_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜单序列号',
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '菜单名',
  `router` varchar(255) NOT NULL DEFAULT '' COMMENT '路由',
  `sort` int(4) NOT NULL DEFAULT '1' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态；默认：1，正常；0：关闭',
  `icon` varchar(255) NOT NULL DEFAULT '0' COMMENT '图标',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mini_menu
-- ----------------------------
INSERT INTO `mini_menu` VALUES ('18', '0', '菜单管理', 'menu/index', '0', '1', 'fa-bars');
INSERT INTO `mini_menu` VALUES ('19', '0', '用户管理', 'user/index', '1', '1', 'fa-user-circle');
INSERT INTO `mini_menu` VALUES ('25', '0', '平台管理', 'account/index', '1', '1', 'fa-qq');
INSERT INTO `mini_menu` VALUES ('26', '25', '分类管理', 'accountcate/index', '1', '1', '0');
INSERT INTO `mini_menu` VALUES ('27', '25', '平台配置', 'accountconfig/index', '1', '1', '0');
INSERT INTO `mini_menu` VALUES ('28', '0', '免费会员管理', 'freevip/index', '1', '1', 'fa-vimeo-square');
INSERT INTO `mini_menu` VALUES ('29', '28', '免费会员配置', 'freevip/index', '1', '1', '0');
INSERT INTO `mini_menu` VALUES ('30', '0', '设置', 'settting/index', '1', '1', 'fa-cog');
INSERT INTO `mini_menu` VALUES ('31', '30', 'App设置', 'setting/app-index', '1', '1', '0');
INSERT INTO `mini_menu` VALUES ('32', '0', '用户反馈中心', 'feedback/feedback/index', '1', '1', 'fa-info-circle');
INSERT INTO `mini_menu` VALUES ('33', '28', '账号提取记录', 'freevipgetrecord/index', '1', '1', '0');
