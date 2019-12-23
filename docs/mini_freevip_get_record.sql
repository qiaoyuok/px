/*
Navicat MySQL Data Transfer

Source Server         : 线上Linux
Source Server Version : 50643
Source Host           : 47.98.198.79:3306
Source Database       : mini

Target Server Type    : MYSQL
Target Server Version : 50643
File Encoding         : 65001

Date: 2019-04-14 22:27:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mini_freevip_get_record
-- ----------------------------
DROP TABLE IF EXISTS `mini_freevip_get_record`;
CREATE TABLE `mini_freevip_get_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(50) NOT NULL DEFAULT '' COMMENT '用户唯一标志',
  `account_id` int(11) NOT NULL DEFAULT '0' COMMENT '领取的会员ID号',
  `code_num` tinyint(1) NOT NULL DEFAULT '1' COMMENT '剩余获取验证码次数或乐视免费登录次数；默认：1',
  `login_help` tinyint(1) DEFAULT '0' COMMENT '账号类型；0：直接显示账号密码或CDK；1：需要获取手机验证码；2：需要获取乐视免验证登录卡密',
  `account_type` varchar(50) NOT NULL DEFAULT '' COMMENT '账号类型',
  `vip_name` varchar(50) NOT NULL DEFAULT '' COMMENT '会员名；爱奇艺',
  `vip_type` varchar(255) NOT NULL DEFAULT '' COMMENT '会员类型；黄金',
  `viptime` varchar(50) NOT NULL DEFAULT '' COMMENT '会员时长',
  `created_at` varchar(11) NOT NULL DEFAULT '' COMMENT '领取时间',
  `updated_at` varchar(11) NOT NULL DEFAULT '' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
