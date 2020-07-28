/*
Navicat MySQL Data Transfer

Source Server         : sm
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : new_warehouse

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2018-05-13 11:28:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pass` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `privileges` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for compressor
-- ----------------------------
DROP TABLE IF EXISTS `compressor`;
CREATE TABLE `compressor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tip_kompresor` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `product_number` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `id_compressor` int(11) DEFAULT NULL,
  `delete_flag` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for warehouse
-- ----------------------------
DROP TABLE IF EXISTS `warehouse`;
CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for warehouse_input
-- ----------------------------
DROP TABLE IF EXISTS `warehouse_input`;
CREATE TABLE `warehouse_input` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_number_in` varchar(255) DEFAULT NULL,
  `in_list` varchar(650) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for warehouse_output
-- ----------------------------
DROP TABLE IF EXISTS `warehouse_output`;
CREATE TABLE `warehouse_output` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_number_out` varchar(255) DEFAULT NULL,
  `in_list` varchar(650) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
