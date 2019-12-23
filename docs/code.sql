/*
Navicat MySQL Data Transfer

Source Server         : 本地Linux
Source Server Version : 50642
Source Host           : 192.168.1.103:3306
Source Database       : code

Target Server Type    : MYSQL
Target Server Version : 50642
File Encoding         : 65001

Date: 2019-05-14 22:29:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for port_info
-- ----------------------------
DROP TABLE IF EXISTS `port_info`;
CREATE TABLE `port_info` (
  `Id` int(11) NOT NULL,
  `PortNum` int(10) unsigned DEFAULT NULL COMMENT '端口号',
  `IMSI` varchar(255) DEFAULT NULL COMMENT '用户识别码',
  `ICCID` varchar(255) DEFAULT NULL COMMENT '卡识别码',
  `PhoNum` varchar(12) DEFAULT NULL COMMENT '手机号',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for sms_recv
-- ----------------------------
DROP TABLE IF EXISTS `sms_recv`;
CREATE TABLE `sms_recv` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `PortNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '接受短信的端口号',
  `PhoNum` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '手机号',
  `IMSI` varchar(255) NOT NULL DEFAULT '' COMMENT '用户识别码',
  `ICCID` varchar(255) NOT NULL DEFAULT '' COMMENT '卡识别码',
  `smsDate` varchar(255) NOT NULL DEFAULT '' COMMENT '短信日期',
  `smsNumber` varchar(255) NOT NULL DEFAULT '' COMMENT '短信号码',
  `smsContent` varchar(255) NOT NULL DEFAULT '' COMMENT '短信内容',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1：未使用；0：已使用',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for sms_send
-- ----------------------------
DROP TABLE IF EXISTS `sms_send`;
CREATE TABLE `sms_send` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `PortNum` int(11) NOT NULL DEFAULT '0' COMMENT '大于0表示指定端口号发送',
  `smsNumber` varchar(255) NOT NULL DEFAULT '' COMMENT '接受号码',
  `smsSubject` varchar(255) NOT NULL DEFAULT '' COMMENT '彩信标题',
  `smsContent` varchar(255) DEFAULT '' COMMENT '发送内容',
  `smsType` int(10) unsigned DEFAULT '0' COMMENT '0:短信；1：彩信',
  `PhoNum` int(5) DEFAULT '0' COMMENT '手机号',
  `smsState` int(10) unsigned DEFAULT '0' COMMENT '0：未发送；1：已在发送队列；2：发送成功；3：发送失败',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
