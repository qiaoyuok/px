/*
Navicat MySQL Data Transfer

Source Server         : 线上Linux
Source Server Version : 50643
Source Host           : 47.98.198.79:3306
Source Database       : mini

Target Server Type    : MYSQL
Target Server Version : 50643
File Encoding         : 65001

Date: 2019-04-14 22:27:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mini_freeaccounts
-- ----------------------------
DROP TABLE IF EXISTS `mini_freeaccounts`;
CREATE TABLE `mini_freeaccounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `free_main_id` int(11) NOT NULL DEFAULT '0' COMMENT '免费会员配置的ID号，对应的是当前会员类型的配置',
  `account` varchar(255) NOT NULL DEFAULT '' COMMENT '存放具体的账号密码或者激活码',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '会员密码',
  `account_times` tinyint(1) NOT NULL DEFAULT '1' COMMENT '剩余提取次数',
  `code_num` tinyint(1) NOT NULL DEFAULT '1' COMMENT '该账号允许收取验证码或乐视验证次数',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '当前账号的状态；1：正常；0：已经发出',
  `create_at` varchar(11) NOT NULL DEFAULT '' COMMENT '账号添加时间',
  `update_at` varchar(11) NOT NULL DEFAULT '' COMMENT '上次更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;
