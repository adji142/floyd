/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50552
Source Host           : localhost:3306
Source Database       : floyd_budi

Target Server Type    : MYSQL
Target Server Version : 50552
File Encoding         : 65001

Date: 2019-10-16 15:02:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tempat
-- ----------------------------
DROP TABLE IF EXISTS `tempat`;
CREATE TABLE `tempat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_node` int(11) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `telp` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tempat
-- ----------------------------
INSERT INTO `tempat` VALUES ('1', '40', 'Puhgogor, Kec. Bendosari, Kabupaten Sukoharjo, Jawa Tengah 57528', 'Puhgogor, Kec. Bendosari, Kabupaten Sukoharjo, Jawa Tengah 57528', null, '');
INSERT INTO `tempat` VALUES ('2', '2', 'Jl. KH Agus Salim, Sawah, Joho, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57513', 'Jl. KH Agus Salim, Sawah, Joho, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57513', null, '');
INSERT INTO `tempat` VALUES ('3', '21', 'Jl. Wandyo Pranoto, Sawah, Mandan, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57516', 'Jl. Wandyo Pranoto, Sawah, Mandan, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57516', null, '');
INSERT INTO `tempat` VALUES ('4', '17', 'Balesari, Gayam, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57513\r\n', 'Balesari, Gayam, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57513\r\n', null, '');
INSERT INTO `tempat` VALUES ('5', '29', 'Jl. Veteran No.35 Madyorejo, Kutorejo, Jetis, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57511', 'Jl. Veteran No.35 Madyorejo, Kutorejo, Jetis, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57511', null, '');
INSERT INTO `tempat` VALUES ('6', '38', 'Kutorejo, Sukoharjo, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57512', 'Kutorejo, Sukoharjo, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57512', null, '');
INSERT INTO `tempat` VALUES ('7', '42', 'Jl. Pemuda No.36, Kutorejo, Jetis, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57511', 'Jl. Pemuda No.36, Kutorejo, Jetis, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57511', null, '');
INSERT INTO `tempat` VALUES ('8', '46', 'Jl. Mayor Sunaryo, Gawanan, Sukoharjo, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57512\r\n', 'Jl. Mayor Sunaryo, Gawanan, Sukoharjo, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57512\r\n', null, '');
INSERT INTO `tempat` VALUES ('9', '49', 'Gawanan, Sukoharjo, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57511\r\n', 'Gawanan, Sukoharjo, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57511\r\n', null, '');
INSERT INTO `tempat` VALUES ('10', '50', 'Jl. Jend. Sudirman, Sukoharjo, Larangan Kulon, Sukoharjo, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57512\r\n', 'Jl. Jend. Sudirman, Sukoharjo, Larangan Kulon, Sukoharjo, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57512\r\n', null, '');
INSERT INTO `tempat` VALUES ('11', '55', 'Jl. Jaksa Agung R. Suprapto No.33, Tanjungsari, Sukoharjo, Kec. Sukoharjo,     Kabupaten Sukoharjo, Jawa Tengah 57512\r\n', 'Jl. Jaksa Agung R. Suprapto No.33, Tanjungsari, Sukoharjo, Kec. Sukoharjo,     Kabupaten Sukoharjo, Jawa Tengah 57512\r\n', null, '');
INSERT INTO `tempat` VALUES ('12', '65', 'JL. Jaksa Agung R.Soeprapto, Tanjungsari, Sukoharjo, Kec. Sukoharjo, Kabupaten    Sukoharjo, Jawa Tengah 57512\r\n', 'JL. Jaksa Agung R.Soeprapto, Tanjungsari, Sukoharjo, Kec. Sukoharjo, Kabupaten    Sukoharjo, Jawa Tengah 57512\r\n', null, '');
INSERT INTO `tempat` VALUES ('13', '60', 'Jl. Jaksa Agung R. Suprapto No.17, Tanjungsari, Sukoharjo, Kec.  Sukoharjo, Kabupaten   Sukoharjo, Jawa Tengah 57512\r\n', 'Jl. Jaksa Agung R. Suprapto No.17, Tanjungsari, Sukoharjo, Kec.  Sukoharjo, Kabupaten   Sukoharjo, Jawa Tengah 57512\r\n', null, '');
INSERT INTO `tempat` VALUES ('14', '66', 'Jl. Jaksa Agung Raya Suprapto No.5, Gawanan, Sukoharjo, Kec. Sukoharjo, Kabupaten    Sukoharjo, Jawa Tengah 57512\r\n', 'Jl. Jaksa Agung Raya Suprapto No.5, Gawanan, Sukoharjo, Kec. Sukoharjo, Kabupaten    Sukoharjo, Jawa Tengah 57512\r\n', null, '');
INSERT INTO `tempat` VALUES ('15', '86', 'Satu, Lorog, Kec. Tawangsari, Kabupaten Sukoharjo, Jawa Tengah 57561', 'Satu, Lorog, Kec. Tawangsari, Kabupaten Sukoharjo, Jawa Tengah 57561', null, '');
INSERT INTO `tempat` VALUES ('16', '68', 'Jl. Patimura No.76, Satu, Kateguhan, Kec. Tawangsari, Kabupaten Sukoharjo, Jawa Tengah 57561', 'Jl. Patimura No.76, Satu, Kateguhan, Kec. Tawangsari, Kabupaten Sukoharjo, Jawa Tengah 57561', null, '');
INSERT INTO `tempat` VALUES ('17', '87', 'Jl. Patimura No.76, Satu, Kateguhan, Kec. Tawangsari, Kabupaten Sukoharjo, Jawa Tengah 57561', 'Jl. Patimura No.76, Satu, Kateguhan, Kec. Tawangsari, Kabupaten Sukoharjo, Jawa Tengah 57561', null, '');
INSERT INTO `tempat` VALUES ('18', '90', 'Jl. Tawangsari-Bulu, Satu, Pundungrejo, Kec. Tawangsari, Kabupaten Sukoharjo, Jawa Tengah 57561', 'Jl. Tawangsari-Bulu, Satu, Pundungrejo, Kec. Tawangsari, Kabupaten Sukoharjo, Jawa Tengah 57561', null, '');
INSERT INTO `tempat` VALUES ('19', '89', 'JL. Patimura, No. 105, Tawangsari, Satu, Lorog, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57561', 'JL. Patimura, No. 105, Tawangsari, Satu, Lorog, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57561', null, '');
INSERT INTO `tempat` VALUES ('20', '91', 'JL. Patimura, No. 105, Tawangsari, Satu, Lorog, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57561', 'JL. Patimura, No. 105, Tawangsari, Satu, Lorog, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57561', null, '');
INSERT INTO `tempat` VALUES ('21', '112', 'Unnamed Road, Pojok, Mulur, Kec. Bendosari, Kabupaten Sukoharjo, Jawa Tengah 57528\r\n', 'Unnamed Road, Pojok, Mulur, Kec. Bendosari, Kabupaten Sukoharjo, Jawa Tengah 57528\r\n', null, '');
INSERT INTO `tempat` VALUES ('22', '113', 'Pojok, Mulur, Kec. Bendosari, Kabupaten Sukoharjo, Jawa Tengah 57528\r\n', 'Pojok, Mulur, Kec. Bendosari, Kabupaten Sukoharjo, Jawa Tengah 57528\r\n', null, '');
INSERT INTO `tempat` VALUES ('23', '114', 'Jl. Bendosari, Dondong, Mulur, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57521\r\n', 'Jl. Bendosari, Dondong, Mulur, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57521\r\n', null, '');
INSERT INTO `tempat` VALUES ('24', '104', 'Jl. Dr. Muwardi No.1, RT.1/RW.4, Pojok, Mulur, Kec. Bendosari, Kabupaten Sukoharjo, Jawa Tengah 57572\r\n', 'Jl. Dr. Muwardi No.1, RT.1/RW.4, Pojok, Mulur, Kec. Bendosari, Kabupaten Sukoharjo, Jawa Tengah 57572\r\n', null, '');
