/*
Navicat MySQL Data Transfer

Source Server         : 本地Linux
Source Server Version : 50642
Source Host           : 192.168.1.103:3306
Source Database       : mini

Target Server Type    : MYSQL
Target Server Version : 50642
File Encoding         : 65001

Date: 2019-05-12 20:46:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mini_feedback
-- ----------------------------
DROP TABLE IF EXISTS `mini_feedback`;
CREATE TABLE `mini_feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '反馈的类型；默认1：免费账号问题；2：应用反馈',
  `uuid` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '用户UUID',
  `account_id` int(11) NOT NULL DEFAULT '0' COMMENT '免费账号ID',
  `content` varchar(500) NOT NULL DEFAULT '' COMMENT '详细内容',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '反馈问题状态；0：未处理；1：已处理',
  `created_at` int(4) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(4) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;
