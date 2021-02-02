/*
Navicat MySQL Data Transfer

Source Server         : Docker_SchoolsSys
Source Server Version : 50724
Source Host           : localhost:13306
Source Database       : selfassess_test

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2019-12-05 13:04:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `city`
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ref` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of city
-- ----------------------------
INSERT INTO `city` VALUES ('3', 'إدارة التعليم بمحافظة الافلاج', ' الافلاج', null, null);
INSERT INTO `city` VALUES ('4', 'إدارة التعليم بمحافظة البكيرية', ' البكيرية', null, null);
INSERT INTO `city` VALUES ('5', 'إدارة التعليم بمحافظة الخرج', ' الخرج', null, null);
INSERT INTO `city` VALUES ('6', 'إدارة التعليم بمحافظة الدوادمي', ' الدوادمي', null, null);
INSERT INTO `city` VALUES ('7', 'إدارة التعليم بمحافظة الرس', ' الرس', null, null);
INSERT INTO `city` VALUES ('8', 'إدارة التعليم بمحافظة الزلفي', ' الزلفي', null, null);
INSERT INTO `city` VALUES ('9', 'إدارة التعليم بمحافظة العلا', ' العلا', null, null);
INSERT INTO `city` VALUES ('10', 'إدارة التعليم بمحافظة الـغاط', ' الـغاط', null, null);
INSERT INTO `city` VALUES ('11', 'إدارة التعليم بمحافظة القريات', ' القريات', null, null);
INSERT INTO `city` VALUES ('12', 'إدارة التعليم بمحافظة القنفذة', ' القنفذة', null, null);
INSERT INTO `city` VALUES ('13', 'إدارة التعليم بمحافظة القويعية', ' القويعية', null, null);
INSERT INTO `city` VALUES ('14', 'إدارة التعليم بمحافظة الليث', ' الليث', null, null);
INSERT INTO `city` VALUES ('15', 'إدارة التعليم بمحافظة المجمعة', ' المجمعة', null, null);
INSERT INTO `city` VALUES ('16', 'إدارة التعليم بمحافظة المخواة', ' المخواة', null, null);
INSERT INTO `city` VALUES ('17', 'إدارة التعليم بمحافظة المذنب', ' المذنب', null, null);
INSERT INTO `city` VALUES ('18', 'إدارة التعليم بمحافظة بيشة', ' بيشة', null, null);
INSERT INTO `city` VALUES ('19', 'إدارة التعليم بمحافظة حفر الباطن', ' حفر الباطن', null, null);
INSERT INTO `city` VALUES ('20', 'إدارة التعليم بمحافظة شقراء', ' شقراء', null, null);
INSERT INTO `city` VALUES ('21', 'إدارة التعليم بمحافظة صبيا', ' صبيا', null, null);
INSERT INTO `city` VALUES ('22', 'إدارة التعليم بمحافظة عفيف', ' عفيف', null, null);
INSERT INTO `city` VALUES ('23', 'إدارة التعليم بمحافظة عنيزة', ' عنيزة', null, null);
INSERT INTO `city` VALUES ('24', 'إدارة التعليم بمحافظة وادي الدواسر', ' وادي الدواسر', null, null);
INSERT INTO `city` VALUES ('25', 'إدارة التعليم بمحافظة ينبع', ' ينبع', null, null);
INSERT INTO `city` VALUES ('26', 'إدارة التعليم بمحافظتي حوطة بني تميم والحريق', ' حوطة بني تميم والحريق', null, null);
INSERT INTO `city` VALUES ('27', 'الإدارة العامة للتعليم بالمنطقة الشرقية', ' المنطقة الشرقية', null, null);
INSERT INTO `city` VALUES ('28', 'الإدارة العامة للتعليم بمحافظة الاحساء', ' الاحساء', null, null);
INSERT INTO `city` VALUES ('29', 'الإدارة العامة للتعليم بمحافظة الطائف', ' الطائف', null, null);
INSERT INTO `city` VALUES ('30', 'الإدارة العامة للتعليم بمحافظة جدة', ' جدة', null, null);
INSERT INTO `city` VALUES ('31', 'الإدارة العامة للتعليم بمحافظة محايل عسير', ' محايل عسير', null, null);
INSERT INTO `city` VALUES ('32', 'الإدارة العامة للتعليم بمنطقة الباحة', ' الباحة', null, null);
INSERT INTO `city` VALUES ('33', 'الإدارة العامة للتعليم بمنطقة الجوف', ' الجوف', null, null);
INSERT INTO `city` VALUES ('34', 'الإدارة العامة للتعليم بمنطقة الحدود الشمالية', ' الحدود الشمالية', null, null);
INSERT INTO `city` VALUES ('35', 'الإدارة العامة للتعليم بمنطقة الرياض', ' الرياض', null, '1');
INSERT INTO `city` VALUES ('36', 'الإدارة العامة للتعليم بمنطقة القصيم', ' القصيم', null, null);
INSERT INTO `city` VALUES ('37', 'الإدارة العامة للتعليم بمنطقة المدينة المنورة', ' المدينة المنورة', null, null);
INSERT INTO `city` VALUES ('38', 'الإدارة العامة للتعليم بمنطقة تبوك', ' تبوك', null, null);
INSERT INTO `city` VALUES ('39', 'الإدارة العامة للتعليم بمنطقة جازان', ' جازان', null, null);
INSERT INTO `city` VALUES ('40', 'الإدارة العامة للتعليم بمنطقة حائل', ' حائل', null, null);
INSERT INTO `city` VALUES ('41', 'الإدارة العامة للتعليم بمنطقة عسير', ' عسير', null, null);
INSERT INTO `city` VALUES ('42', 'الإدارة العامة للتعليم بمنطقة مكة المكرمة', ' مكة المكرمة', null, null);
INSERT INTO `city` VALUES ('43', 'الإدارة العامة للتعليم بمنطقة نجران', ' نجران', null, null);

-- ----------------------------
-- Table structure for `corrective_action_report`
-- ----------------------------
DROP TABLE IF EXISTS `corrective_action_report`;
CREATE TABLE `corrective_action_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `survey_id` int(10) unsigned DEFAULT NULL,
  `question_id` int(10) unsigned DEFAULT NULL,
  `answer_id` bigint(20) unsigned DEFAULT NULL,
  `corrective_action` varchar(255) DEFAULT NULL,
  `corrective_action_date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `comment` text,
  PRIMARY KEY (`id`),
  KEY `fk_org_id_idx` (`org_id`),
  KEY `fk_user_idx` (`user_id`),
  KEY `ffsurvey_id_idx` (`survey_id`),
  KEY `fk_question_idx` (`question_id`),
  KEY `fk_answer_idx` (`answer_id`),
  CONSTRAINT `corrective_action_report_ibfk_1` FOREIGN KEY (`answer_id`) REFERENCES `survey_answer` (`survey_answer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `corrective_action_report_ibfk_2` FOREIGN KEY (`org_id`) REFERENCES `organization` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `corrective_action_report_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `survey_question` (`survey_question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `corrective_action_report_ibfk_4` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `corrective_action_report_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of corrective_action_report
-- ----------------------------

-- ----------------------------
-- Table structure for `district`
-- ----------------------------
DROP TABLE IF EXISTS `district`;
CREATE TABLE `district` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  CONSTRAINT `district_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of district
-- ----------------------------
INSERT INTO `district` VALUES ('6', '35', 'اسكان البحرية', null);
INSERT INTO `district` VALUES ('7', '35', 'اسكان طريق الخرج', null);
INSERT INTO `district` VALUES ('8', '35', 'اشبيليا', null);
INSERT INTO `district` VALUES ('9', '35', 'الأندلس', null);
INSERT INTO `district` VALUES ('10', '35', 'الازدهار', null);
INSERT INTO `district` VALUES ('11', '35', 'الامانة', null);
INSERT INTO `district` VALUES ('12', '35', 'البديعة', null);
INSERT INTO `district` VALUES ('13', '35', 'التخصصي', null);
INSERT INTO `district` VALUES ('14', '35', 'التعاون', null);
INSERT INTO `district` VALUES ('15', '35', 'الحزم', null);
INSERT INTO `district` VALUES ('16', '35', 'الحمراء', null);
INSERT INTO `district` VALUES ('17', '35', 'الخالدية', null);
INSERT INTO `district` VALUES ('18', '35', 'الخزامى', null);
INSERT INTO `district` VALUES ('19', '35', 'الخليج', null);
INSERT INTO `district` VALUES ('20', '35', 'الدائد', null);
INSERT INTO `district` VALUES ('21', '35', 'الدار البيضاء', null);
INSERT INTO `district` VALUES ('22', '35', 'الرائد', null);
INSERT INTO `district` VALUES ('23', '35', 'الربوة', null);
INSERT INTO `district` VALUES ('24', '35', 'الربيع', null);
INSERT INTO `district` VALUES ('25', '35', 'الرحاب', null);
INSERT INTO `district` VALUES ('26', '35', 'الرحمانية', null);
INSERT INTO `district` VALUES ('27', '35', 'الرفيعة', null);
INSERT INTO `district` VALUES ('28', '35', 'الرمال', null);
INSERT INTO `district` VALUES ('29', '35', 'الروابي', null);
INSERT INTO `district` VALUES ('30', '35', 'الروضة', null);
INSERT INTO `district` VALUES ('31', '35', 'الريان', null);
INSERT INTO `district` VALUES ('32', '35', 'الزهراء', null);
INSERT INTO `district` VALUES ('33', '35', 'الزهرة', null);
INSERT INTO `district` VALUES ('34', '35', 'السعادة', null);
INSERT INTO `district` VALUES ('35', '35', 'السفارات', null);
INSERT INTO `district` VALUES ('36', '35', 'السلام', null);
INSERT INTO `district` VALUES ('37', '35', 'السلي', null);
INSERT INTO `district` VALUES ('38', '35', 'السليمانية', null);
INSERT INTO `district` VALUES ('39', '35', 'السويدي', null);
INSERT INTO `district` VALUES ('40', '35', 'السويدي الغربي', null);
INSERT INTO `district` VALUES ('41', '35', 'الشرفية', null);
INSERT INTO `district` VALUES ('42', '35', 'الشفا', null);
INSERT INTO `district` VALUES ('43', '35', 'الشهداء', null);
INSERT INTO `district` VALUES ('44', '35', 'الصحافة', null);
INSERT INTO `district` VALUES ('45', '35', 'الصقورية', null);
INSERT INTO `district` VALUES ('46', '35', 'الضباط', null);
INSERT INTO `district` VALUES ('47', '35', 'العارض', null);
INSERT INTO `district` VALUES ('48', '35', 'العريجا', null);
INSERT INTO `district` VALUES ('49', '35', 'العريجاء', null);
INSERT INTO `district` VALUES ('50', '35', 'العريجاء الغربي', null);
INSERT INTO `district` VALUES ('51', '35', 'العريجاء الوسطى', null);
INSERT INTO `district` VALUES ('52', '35', 'العزيزية', null);
INSERT INTO `district` VALUES ('53', '35', 'العقيق', null);
INSERT INTO `district` VALUES ('54', '35', 'العليا', null);
INSERT INTO `district` VALUES ('55', '35', 'الغدير', null);
INSERT INTO `district` VALUES ('56', '35', 'الفاخرية', null);
INSERT INTO `district` VALUES ('57', '35', 'الفلاح', null);
INSERT INTO `district` VALUES ('58', '35', 'الفوطة', null);
INSERT INTO `district` VALUES ('59', '35', 'الفيحاء', null);
INSERT INTO `district` VALUES ('60', '35', 'الفيصلية', null);
INSERT INTO `district` VALUES ('61', '35', 'القادسية', null);
INSERT INTO `district` VALUES ('62', '35', 'القدس', null);
INSERT INTO `district` VALUES ('63', '35', 'القيروان', null);
INSERT INTO `district` VALUES ('64', '35', 'المؤتمرات', null);
INSERT INTO `district` VALUES ('65', '35', 'المحمدية', null);
INSERT INTO `district` VALUES ('66', '35', 'المربع', null);
INSERT INTO `district` VALUES ('67', '35', 'المرسلات', null);
INSERT INTO `district` VALUES ('68', '35', 'المروة', null);
INSERT INTO `district` VALUES ('69', '35', 'المروج', null);
INSERT INTO `district` VALUES ('70', '35', 'المصيف', null);
INSERT INTO `district` VALUES ('71', '35', 'المعذر', null);
INSERT INTO `district` VALUES ('72', '35', 'المعذر الشمالي', null);
INSERT INTO `district` VALUES ('73', '35', 'المعذر الغربي', null);
INSERT INTO `district` VALUES ('74', '35', 'المعيزلية', null);
INSERT INTO `district` VALUES ('75', '35', 'المعيزيلة', null);
INSERT INTO `district` VALUES ('76', '35', 'المغرزات', null);
INSERT INTO `district` VALUES ('77', '35', 'الملز', null);
INSERT INTO `district` VALUES ('78', '35', 'الملقا', null);
INSERT INTO `district` VALUES ('79', '35', 'الملك عبدالله', null);
INSERT INTO `district` VALUES ('80', '35', 'الملك فهد', null);
INSERT INTO `district` VALUES ('81', '35', 'الملك فيصل', null);
INSERT INTO `district` VALUES ('82', '35', 'المنار', null);
INSERT INTO `district` VALUES ('83', '35', 'المنصورة', null);
INSERT INTO `district` VALUES ('84', '35', 'الموسى', null);
INSERT INTO `district` VALUES ('85', '35', 'المونسية', null);
INSERT INTO `district` VALUES ('86', '35', 'الناصرية', null);
INSERT INTO `district` VALUES ('87', '35', 'النخيل', null);
INSERT INTO `district` VALUES ('88', '35', 'النخيل الشرقي', null);
INSERT INTO `district` VALUES ('89', '35', 'النخيل الغربي', null);
INSERT INTO `district` VALUES ('90', '35', 'الندوة', null);
INSERT INTO `district` VALUES ('91', '35', 'الندى', null);
INSERT INTO `district` VALUES ('92', '35', 'النرجس', null);
INSERT INTO `district` VALUES ('93', '35', 'النزهة', null);
INSERT INTO `district` VALUES ('94', '35', 'النسيج', null);
INSERT INTO `district` VALUES ('95', '35', 'النسيم', null);
INSERT INTO `district` VALUES ('96', '35', 'النسيم الشرقي', null);
INSERT INTO `district` VALUES ('97', '35', 'النسيم الغربي', null);
INSERT INTO `district` VALUES ('98', '35', 'النظيم', null);
INSERT INTO `district` VALUES ('99', '35', 'النفل', null);
INSERT INTO `district` VALUES ('100', '35', 'النموذجية', null);
INSERT INTO `district` VALUES ('101', '35', 'النهضة', null);
INSERT INTO `district` VALUES ('102', '35', 'الهدا', null);
INSERT INTO `district` VALUES ('103', '35', 'الواحة', null);
INSERT INTO `district` VALUES ('104', '35', 'الوادي', null);
INSERT INTO `district` VALUES ('105', '35', 'الورود', null);
INSERT INTO `district` VALUES ('106', '35', 'الوشام', null);
INSERT INTO `district` VALUES ('107', '35', 'الياسمين', null);
INSERT INTO `district` VALUES ('108', '35', 'اليرموك', null);
INSERT INTO `district` VALUES ('109', '35', 'اليمامة', null);
INSERT INTO `district` VALUES ('110', '35', 'ام الحمام', null);
INSERT INTO `district` VALUES ('111', '35', 'ام الحمام الشرقي', null);
INSERT INTO `district` VALUES ('112', '35', 'ام الحمام الغربي', null);
INSERT INTO `district` VALUES ('113', '35', 'بدر', null);
INSERT INTO `district` VALUES ('114', '35', 'بني عامر', null);
INSERT INTO `district` VALUES ('115', '35', 'تلال الوصيل', null);
INSERT INTO `district` VALUES ('116', '35', 'جبرة', null);
INSERT INTO `district` VALUES ('117', '35', 'جرير', null);
INSERT INTO `district` VALUES ('118', '35', 'حضار', null);
INSERT INTO `district` VALUES ('119', '35', 'حطين', null);
INSERT INTO `district` VALUES ('120', '35', 'حي الربيع', null);
INSERT INTO `district` VALUES ('121', '35', 'حي شبر1', null);
INSERT INTO `district` VALUES ('122', '35', 'حي لبن', null);
INSERT INTO `district` VALUES ('123', '35', 'زهرة البديعة', null);
INSERT INTO `district` VALUES ('124', '35', 'سلطانة', null);
INSERT INTO `district` VALUES ('125', '35', 'شبرا', null);
INSERT INTO `district` VALUES ('126', '35', 'شرق اشبيلية', null);
INSERT INTO `district` VALUES ('127', '35', 'صلاح الدين', null);
INSERT INTO `district` VALUES ('128', '35', 'طويق', null);
INSERT INTO `district` VALUES ('129', '35', 'ظهرة البديعة', null);
INSERT INTO `district` VALUES ('130', '35', 'ظهرة لبن', null);
INSERT INTO `district` VALUES ('131', '35', 'عتيقة', null);
INSERT INTO `district` VALUES ('132', '35', 'عرقة', null);
INSERT INTO `district` VALUES ('133', '35', 'عليشة', null);
INSERT INTO `district` VALUES ('134', '35', 'غرناطة', null);
INSERT INTO `district` VALUES ('135', '35', 'قرطبة', null);
INSERT INTO `district` VALUES ('136', '35', 'كلية العلوم والدراسات الانسانية برماح', null);
INSERT INTO `district` VALUES ('137', '35', 'لبن', null);
INSERT INTO `district` VALUES ('138', '35', 'مجمع تلال الوصيل', null);
INSERT INTO `district` VALUES ('139', '35', 'مخطط 46', null);
INSERT INTO `district` VALUES ('140', '35', 'مخطط 51', null);
INSERT INTO `district` VALUES ('141', '35', 'منفوحة', null);
INSERT INTO `district` VALUES ('142', '35', 'نمار', null);

-- ----------------------------
-- Table structure for `file_storage_item`
-- ----------------------------
DROP TABLE IF EXISTS `file_storage_item`;
CREATE TABLE `file_storage_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component` varchar(255) NOT NULL,
  `base_url` varchar(1024) NOT NULL,
  `path` varchar(1024) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `upload_ip` varchar(15) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of file_storage_item
-- ----------------------------
INSERT INTO `file_storage_item` VALUES ('2', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/Uo-ViSf0UXc2rMlbKOpm9FKjkmsUjm4k.png', 'image/png', '197201', 'Uo-ViSf0UXc2rMlbKOpm9FKjkmsUjm4k', '172.25.0.1', '1570727628');
INSERT INTO `file_storage_item` VALUES ('4', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/QvS7ncVYIMTJFWW5eBxSpINftlplMK23.png', 'image/png', '197201', 'QvS7ncVYIMTJFWW5eBxSpINftlplMK23', '172.25.0.1', '1570729951');
INSERT INTO `file_storage_item` VALUES ('5', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/MCBn0myn0pYY40HhQHwbrgXjMhqK3QEW.png', 'image/png', '197201', 'MCBn0myn0pYY40HhQHwbrgXjMhqK3QEW', '172.25.0.1', '1570730377');
INSERT INTO `file_storage_item` VALUES ('6', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/ViSWc06zXmYlwrjjgUcfH3GyCVlUs_VF.png', 'image/png', '197201', 'ViSWc06zXmYlwrjjgUcfH3GyCVlUs_VF', '172.25.0.1', '1570730954');
INSERT INTO `file_storage_item` VALUES ('7', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/ARnU7Hsf47iEdecqXRwlr-7tKJadj-56.jpg', 'image/jpeg', '55503', 'ARnU7Hsf47iEdecqXRwlr-7tKJadj-56', '172.25.0.1', '1570983281');
INSERT INTO `file_storage_item` VALUES ('8', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/hMx6LMbzl_p4mgjVcYRvTkqJJtRMJHeS.png', 'image/png', '184816', 'hMx6LMbzl_p4mgjVcYRvTkqJJtRMJHeS', '172.25.0.1', '1570983307');
INSERT INTO `file_storage_item` VALUES ('9', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/b4XpAe1FETYoLggRI3GM08xk3oZOZ5u8.jpg', 'image/jpeg', '33571', 'b4XpAe1FETYoLggRI3GM08xk3oZOZ5u8', '172.25.0.1', '1570983310');
INSERT INTO `file_storage_item` VALUES ('10', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/H2V0EBAub2hKE-LfW7gn2aLdnig8u6yN.png', 'image/png', '1678172', 'H2V0EBAub2hKE-LfW7gn2aLdnig8u6yN', '172.25.0.1', '1571058809');
INSERT INTO `file_storage_item` VALUES ('11', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/x5RvWbXwuMz7kNoF-5ytLGwLhY105ZOC.png', 'image/png', '284092', 'x5RvWbXwuMz7kNoF-5ytLGwLhY105ZOC', '172.25.0.1', '1571214559');
INSERT INTO `file_storage_item` VALUES ('12', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/jSM5S2fba-qSBsrBL_7U3gJdJeX5GyIw.png', 'image/png', '870676', 'jSM5S2fba-qSBsrBL_7U3gJdJeX5GyIw', '172.25.0.1', '1571214563');
INSERT INTO `file_storage_item` VALUES ('13', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/GJaDVhfjHNv8DplYguSjvm7LtBMbsTBL.png', 'image/png', '197201', 'GJaDVhfjHNv8DplYguSjvm7LtBMbsTBL', '172.25.0.1', '1571214567');
INSERT INTO `file_storage_item` VALUES ('14', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/9IaKZFZWHoeQz-sv_FB7hMDYsIotT337.png', 'image/png', '1678172', '9IaKZFZWHoeQz-sv_FB7hMDYsIotT337', '172.25.0.1', '1571214573');
INSERT INTO `file_storage_item` VALUES ('15', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/g0kKgFXXYHlMs-eaIJBZpW2sjzEB5E_-.jpg', 'image/jpeg', '27082', 'g0kKgFXXYHlMs-eaIJBZpW2sjzEB5E_-', '172.25.0.1', '1571214872');
INSERT INTO `file_storage_item` VALUES ('16', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/gEpbIDzIEo1U8l3QHmva_xwA0GG4UWpY.jpg', 'image/jpeg', '27082', 'gEpbIDzIEo1U8l3QHmva_xwA0GG4UWpY', '172.25.0.1', '1571222424');
INSERT INTO `file_storage_item` VALUES ('17', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/UmrMkzyKFnpketspR3ldl7utX8UsSiEZ.jpg', 'image/jpeg', '27082', 'UmrMkzyKFnpketspR3ldl7utX8UsSiEZ', '172.25.0.1', '1571222954');
INSERT INTO `file_storage_item` VALUES ('18', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/K5DgUwI_nx-X4TqAmHGr13k-jmeqcw7C.jpg', 'image/jpeg', '27082', 'K5DgUwI_nx-X4TqAmHGr13k-jmeqcw7C', '172.25.0.1', '1571223468');
INSERT INTO `file_storage_item` VALUES ('19', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/QtfxDNvY28vQiYVQIVKLhGbt01FxUYGA.jpg', 'image/jpeg', '27082', 'QtfxDNvY28vQiYVQIVKLhGbt01FxUYGA', '172.25.0.1', '1571224033');
INSERT INTO `file_storage_item` VALUES ('20', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/dotYnQrZoa3Gi6xSU88jwH-FYMtOc0Uw.jpg', 'image/jpeg', '27082', 'dotYnQrZoa3Gi6xSU88jwH-FYMtOc0Uw', '172.25.0.1', '1571227059');
INSERT INTO `file_storage_item` VALUES ('21', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/Pi5_m9urqMoGQMcXEhd0Br4EGqpBMMGW.jpg', 'image/jpeg', '27082', 'Pi5_m9urqMoGQMcXEhd0Br4EGqpBMMGW', '172.25.0.1', '1571227071');
INSERT INTO `file_storage_item` VALUES ('22', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/msjrDzSTeyqtsMG50y2swoIniR7srFpL.jpg', 'image/jpeg', '27082', 'msjrDzSTeyqtsMG50y2swoIniR7srFpL', '172.25.0.1', '1571305749');
INSERT INTO `file_storage_item` VALUES ('23', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/1yMd-Uu5l-k4D_V-yvtrJsgqE4Pvo7nG.jpg', 'image/jpeg', '55503', '1yMd-Uu5l-k4D_V-yvtrJsgqE4Pvo7nG', '172.25.0.1', '1571305755');
INSERT INTO `file_storage_item` VALUES ('25', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/flk-VCQVbGlqMjrnz85xejSh29DeQxyY.jpg', 'image/jpeg', '55503', 'flk-VCQVbGlqMjrnz85xejSh29DeQxyY', '172.25.0.1', '1571309657');
INSERT INTO `file_storage_item` VALUES ('27', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/lIMxj8kd-o13u0-e2dgiUco7jip7NR81.png', 'image/png', '184816', 'lIMxj8kd-o13u0-e2dgiUco7jip7NR81', '172.25.0.1', '1571325700');
INSERT INTO `file_storage_item` VALUES ('28', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/qditCRmEkg9N8cQyUdzUiWEmxR9Ey93v.jpg', 'image/jpeg', '33571', 'qditCRmEkg9N8cQyUdzUiWEmxR9Ey93v', '172.25.0.1', '1571325763');
INSERT INTO `file_storage_item` VALUES ('29', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/a8jeurpcFJRrqQPZHyvF55AjiLnDuQHl.jpg', 'image/jpeg', '27082', 'a8jeurpcFJRrqQPZHyvF55AjiLnDuQHl', '172.25.0.1', '1571333593');
INSERT INTO `file_storage_item` VALUES ('31', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/z2rDnZXvINB8surT6shgQVZVoiudfniS.jpg', 'image/jpeg', '27082', 'z2rDnZXvINB8surT6shgQVZVoiudfniS', '172.25.0.1', '1571760037');
INSERT INTO `file_storage_item` VALUES ('32', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/C_G_3NV8BdgHMAkr-853zE0J9zmQcw8P.png', 'image/png', '95582', 'C_G_3NV8BdgHMAkr-853zE0J9zmQcw8P', '172.25.0.1', '1571760042');
INSERT INTO `file_storage_item` VALUES ('33', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/45_833o0Twtq7yYYXuH-Ce2qZV18PE-c.jpg', 'image/jpeg', '27082', '45_833o0Twtq7yYYXuH-Ce2qZV18PE-c', '172.25.0.1', '1571843760');
INSERT INTO `file_storage_item` VALUES ('34', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/AXyzMP4er4Hr7o6clC_BmHpiwcSjCzGH.jpg', 'image/jpeg', '27082', 'AXyzMP4er4Hr7o6clC_BmHpiwcSjCzGH', '172.25.0.1', '1571843764');
INSERT INTO `file_storage_item` VALUES ('35', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/grrM5ScP0RlsApKV4XOMiQOHKXmPWVio.jpg', 'image/jpeg', '27082', 'grrM5ScP0RlsApKV4XOMiQOHKXmPWVio', '172.25.0.1', '1571844566');
INSERT INTO `file_storage_item` VALUES ('36', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/rs4gATvVfdK69jYzvU7W9b7v0P6gioFy.jpg', 'image/jpeg', '27082', 'rs4gATvVfdK69jYzvU7W9b7v0P6gioFy', '172.25.0.1', '1571913523');
INSERT INTO `file_storage_item` VALUES ('38', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/HOMGU0lXvb00Cn60wweUYT9DkCWiO4du.png', 'image/png', '184816', 'HOMGU0lXvb00Cn60wweUYT9DkCWiO4du', '172.25.0.1', '1571913558');
INSERT INTO `file_storage_item` VALUES ('39', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/D82wG5xBUZzOH325ErcnhLlHXtkSpmkD.png', 'image/png', '184816', 'D82wG5xBUZzOH325ErcnhLlHXtkSpmkD', '172.25.0.1', '1571913562');
INSERT INTO `file_storage_item` VALUES ('44', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/0Apzq89XGA8ojkDg-TiIC_HmYvcUOjDG.jpg', 'image/jpeg', '105668', '0Apzq89XGA8ojkDg-TiIC_HmYvcUOjDG', '172.25.0.1', '1573127579');
INSERT INTO `file_storage_item` VALUES ('45', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/txQcon_CUbBJYWgYlZ_Ho16hhEeWXrjT.jpg', 'image/jpeg', '151725', 'txQcon_CUbBJYWgYlZ_Ho16hhEeWXrjT', '172.25.0.1', '1573127586');
INSERT INTO `file_storage_item` VALUES ('46', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/-YOQ2jtLXbsvkLcnwg9VjLCJi6q_AaCg.jpg', 'image/jpeg', '55503', '-YOQ2jtLXbsvkLcnwg9VjLCJi6q_AaCg', '172.25.0.1', '1574323903');
INSERT INTO `file_storage_item` VALUES ('47', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/6yH8ZTllJTTGpMYxHgHAxDZcwauwlvh5.jpg', 'image/jpeg', '27082', '6yH8ZTllJTTGpMYxHgHAxDZcwauwlvh5', '172.25.0.1', '1574323954');
INSERT INTO `file_storage_item` VALUES ('48', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/dFqKeG3RrWazG32JgCZgr6f_43M6YJSv.png', 'image/png', '95582', 'dFqKeG3RrWazG32JgCZgr6f_43M6YJSv', '172.25.0.1', '1574323967');
INSERT INTO `file_storage_item` VALUES ('49', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/6RqnD9MjnfZ1lT1Ze6xNBbsdXqxQHsDb.png', 'image/png', '2538', '6RqnD9MjnfZ1lT1Ze6xNBbsdXqxQHsDb', '172.25.0.1', '1574324007');
INSERT INTO `file_storage_item` VALUES ('50', 'fileStorage', 'http://storage.selfassest.localhost/source', '/1/VMeYqR03wgXa9PzphPu7-1t0B89qGZDZ.png', 'image/png', '2538', 'VMeYqR03wgXa9PzphPu7-1t0B89qGZDZ', '172.25.0.1', '1574324058');

-- ----------------------------
-- Table structure for `footer_links`
-- ----------------------------
DROP TABLE IF EXISTS `footer_links`;
CREATE TABLE `footer_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) DEFAULT NULL,
  `name_link1` varchar(150) DEFAULT NULL,
  `link1` varchar(150) DEFAULT NULL,
  `name_link2` varchar(150) DEFAULT NULL,
  `link2` varchar(150) DEFAULT NULL,
  `name_link3` varchar(150) DEFAULT NULL,
  `link3` varchar(150) DEFAULT NULL,
  `name_link4` varchar(150) DEFAULT NULL,
  `link4` varchar(150) DEFAULT NULL,
  `name_link5` varchar(150) DEFAULT NULL,
  `link5` varchar(150) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of footer_links
-- ----------------------------
INSERT INTO `footer_links` VALUES ('1', '6', '', '', '', '', '', '', '', '', '', '', '1020193', '1020193');
INSERT INTO `footer_links` VALUES ('2', '7', 'about', 'http://google.com', '', '', '', '', '', '', '', '', '1020194', '1020194');
INSERT INTO `footer_links` VALUES ('3', '8', 'test1 ', 'http://google.com', '', '', '', '', '', '', '', '', '1020194', '1020194');

-- ----------------------------
-- Table structure for `key_storage_item`
-- ----------------------------
DROP TABLE IF EXISTS `key_storage_item`;
CREATE TABLE `key_storage_item` (
  `key` varchar(128) NOT NULL,
  `value` text NOT NULL,
  `comment` text,
  `updated_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `visible` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`key`),
  UNIQUE KEY `idx_key_storage_item_key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of key_storage_item
-- ----------------------------
INSERT INTO `key_storage_item` VALUES ('backend.layout-boxed', '0', null, null, null, '0');
INSERT INTO `key_storage_item` VALUES ('backend.layout-collapsed-sidebar', '0', null, null, null, '0');
INSERT INTO `key_storage_item` VALUES ('backend.layout-fixed', '0', null, null, null, '0');
INSERT INTO `key_storage_item` VALUES ('backend.theme-skin', 'skin-blue', 'skin-blue, skin-black, skin-purple, skin-green, skin-red, skin-yellow', null, null, '0');
INSERT INTO `key_storage_item` VALUES ('frontend.maintenance', 'disabled', 'Set it to \"enabled\" to turn on maintenance mode', null, null, '0');

-- ----------------------------
-- Table structure for `media`
-- ----------------------------
DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL,
  `base_url` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `meta` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of media
-- ----------------------------

-- ----------------------------
-- Table structure for `organization`
-- ----------------------------
DROP TABLE IF EXISTS `organization`;
CREATE TABLE `organization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `slug` varchar(150) NOT NULL,
  `business_sector` varchar(100) DEFAULT NULL,
  `about` text,
  `address` varchar(255) DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  `district_id` int(10) unsigned DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `conatct_name` varchar(100) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `contact_position` varchar(100) DEFAULT NULL,
  `limit_account` int(11) DEFAULT NULL,
  `first_image_base_url` varchar(1024) DEFAULT NULL,
  `first_image_path` varchar(1024) DEFAULT NULL,
  `second_image_base_url` varchar(1024) DEFAULT NULL,
  `second_image_path` varchar(1024) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of organization
-- ----------------------------

-- ----------------------------
-- Table structure for `organization_theme`
-- ----------------------------
DROP TABLE IF EXISTS `organization_theme`;
CREATE TABLE `organization_theme` (
  `organization_id` int(11) NOT NULL,
  `brandPrimColor` varchar(255) DEFAULT '',
  `brandSecColor` varchar(255) DEFAULT NULL,
  `brandHTextColor` varchar(255) DEFAULT NULL,
  `brandPTextColor` varchar(255) DEFAULT NULL,
  `brandBlackColor` varchar(255) DEFAULT NULL,
  `brandGrayColor` varchar(255) DEFAULT NULL,
  `arfont` varchar(255) DEFAULT NULL,
  `enfont` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `locale` varchar(255) NOT NULL DEFAULT 'ar_AR',
  `updated_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`organization_id`),
  CONSTRAINT `organization_theme_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of organization_theme
-- ----------------------------

-- ----------------------------
-- Table structure for `page`
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(2048) NOT NULL,
  `title` varchar(512) NOT NULL,
  `body` text NOT NULL,
  `view` varchar(255) DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of page
-- ----------------------------
INSERT INTO `page` VALUES ('1', 'about', 'About', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', null, '1', '1552385276', '1552385276');
INSERT INTO `page` VALUES ('2', 'pnrvpnvpfn', 'fmvpfvmp', '<p>tit/timeline-evemeline-event/indexv fkbfk b</p>', 'tit/timeline-evemeline-event/indexf bfl b', '1', '1570639576', '1570720794');

-- ----------------------------
-- Table structure for `pages`
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `link` varchar(150) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pages
-- ----------------------------

-- ----------------------------
-- Table structure for `post`
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of post
-- ----------------------------

-- ----------------------------
-- Table structure for `rbac_auth_assignment`
-- ----------------------------
DROP TABLE IF EXISTS `rbac_auth_assignment`;
CREATE TABLE `rbac_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `rbac_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of rbac_auth_assignment
-- ----------------------------

-- ----------------------------
-- Table structure for `rbac_auth_item`
-- ----------------------------
DROP TABLE IF EXISTS `rbac_auth_item`;
CREATE TABLE `rbac_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `rbac_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `rbac_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of rbac_auth_item
-- ----------------------------
INSERT INTO `rbac_auth_item` VALUES ('administrator', '1', 'مدير عام', null, null, '1552385505', '1552385505');
INSERT INTO `rbac_auth_item` VALUES ('editOwnModel', '2', null, 'ownModelRule', null, '1552385505', '1552385505');
INSERT INTO `rbac_auth_item` VALUES ('governmentAdmin', '1', null, null, null, null, null);
INSERT INTO `rbac_auth_item` VALUES ('governmentRep', '1', null, null, null, null, null);
INSERT INTO `rbac_auth_item` VALUES ('loginToBackend', '2', null, null, null, '1552385505', '1552385505');
INSERT INTO `rbac_auth_item` VALUES ('loginToOrganization', '2', null, null, null, null, null);
INSERT INTO `rbac_auth_item` VALUES ('manager', '1', 'مدير ', null, null, '1552385505', '1552385505');
INSERT INTO `rbac_auth_item` VALUES ('user', '1', null, null, null, '1552385505', '1552385505');

-- ----------------------------
-- Table structure for `rbac_auth_item_child`
-- ----------------------------
DROP TABLE IF EXISTS `rbac_auth_item_child`;
CREATE TABLE `rbac_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `rbac_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rbac_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of rbac_auth_item_child
-- ----------------------------
INSERT INTO `rbac_auth_item_child` VALUES ('user', 'editOwnModel');
INSERT INTO `rbac_auth_item_child` VALUES ('administrator', 'loginToBackend');
INSERT INTO `rbac_auth_item_child` VALUES ('manager', 'loginToBackend');
INSERT INTO `rbac_auth_item_child` VALUES ('governmentAdmin', 'loginToOrganization');
INSERT INTO `rbac_auth_item_child` VALUES ('governmentRep', 'loginToOrganization');
INSERT INTO `rbac_auth_item_child` VALUES ('administrator', 'manager');
INSERT INTO `rbac_auth_item_child` VALUES ('administrator', 'user');
INSERT INTO `rbac_auth_item_child` VALUES ('manager', 'user');

-- ----------------------------
-- Table structure for `rbac_auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `rbac_auth_rule`;
CREATE TABLE `rbac_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of rbac_auth_rule
-- ----------------------------
INSERT INTO `rbac_auth_rule` VALUES ('ownModelRule', 0x4F3A32393A22636F6D6D6F6E5C726261635C72756C655C4F776E4D6F64656C52756C65223A333A7B733A343A226E616D65223B733A31323A226F776E4D6F64656C52756C65223B733A393A22637265617465644174223B693A313535323338353530353B733A393A22757064617465644174223B693A313535323338353530353B7D, '1552385505', '1552385505');

-- ----------------------------
-- Table structure for `survey`
-- ----------------------------
DROP TABLE IF EXISTS `survey`;
CREATE TABLE `survey` (
  `survey_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `survey_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `survey_updated_at` timestamp NULL DEFAULT NULL,
  `survey_expired_at` timestamp NULL DEFAULT NULL,
  `survey_is_pinned` tinyint(1) DEFAULT '0',
  `survey_is_closed` tinyint(1) DEFAULT '0',
  `survey_tags` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_created_by` int(11) DEFAULT NULL,
  `survey_wallet` int(11) unsigned DEFAULT NULL,
  `survey_status` int(11) unsigned DEFAULT NULL,
  `survey_descr` text COLLATE utf8_unicode_ci,
  `survey_time_to_pass` smallint(6) unsigned DEFAULT NULL,
  `survey_badge_id` int(11) unsigned DEFAULT NULL,
  `survey_is_private` tinyint(1) NOT NULL DEFAULT '0',
  `survey_is_visible` tinyint(1) NOT NULL DEFAULT '0',
  `org_id` int(10) unsigned DEFAULT NULL,
  `start_info` text COLLATE utf8_unicode_ci,
  `survey_point` int(11) DEFAULT NULL,
  PRIMARY KEY (`survey_id`),
  KEY `fk_survey_created_by_idx` (`survey_created_by`),
  CONSTRAINT `survey_ibfk_1` FOREIGN KEY (`survey_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey
-- ----------------------------
INSERT INTO `survey` VALUES ('40', 'Hr Department', '2019-11-21 07:59:15', null, '2019-11-30 09:55:00', '0', '0', '', null, null, null, null, 'Description of the survey', '120', null, '0', '1', '8', 'Please try to fill all the questions', '500');
INSERT INTO `survey` VALUES ('41', 'قسم اداره الموظفين', '2019-11-21 08:42:17', null, '2019-12-27 10:10:00', '0', '1', null, null, null, null, null, null, '60', null, '0', '0', '8', null, '120');
INSERT INTO `survey` VALUES ('42', 'New Survey', '2019-11-26 15:07:54', null, '2019-12-23 14:45:00', '0', '1', 'go,test,a1', null, null, null, null, '\r\nلوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ...\r\n\r\nوعند موافقه العميل المبدئيه على التصميم يتم ازالة هذا النص من التصميم ويتم وضع النصوص النهائية المطلوبة للتصميم ويقول البعض ان وضع النصوص التجريبية بالتصميم قد تشغل المشاهد عن وضع الكثير من الملاحظات او الانتقادات للتصميم الاساسي.\r\n\r\nوخلافاَ للاعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً، بل إن له جذور في الأدب اللاتيني الكلاسيكي منذ العام 45 قبل الميلاد. من كتاب \"حول أقاصي الخير والشر\"', '120', null, '0', '0', '8', '\r\nلوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ...\r\n\r\nوعند موافقه العميل المبدئيه على التصميم يتم ازالة هذا النص من التصميم ويتم وضع النصوص النهائية المطلوبة للتصميم ويقول البعض ان وضع النصوص التجريبية بالتصميم قد تشغل المشاهد عن وضع الكثير من الملاحظات او الانتقادات للتصميم الاساسي.\r\n\r\nوخلافاَ للاعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً، بل إن له جذور في الأدب اللاتيني الكلاسيكي منذ العام 45 قبل الميلاد. من كتاب \"حول أقاصي الخير والشر\"', '250');

-- ----------------------------
-- Table structure for `survey_answer`
-- ----------------------------
DROP TABLE IF EXISTS `survey_answer`;
CREATE TABLE `survey_answer` (
  `survey_answer_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `survey_answer_question_id` int(11) unsigned DEFAULT NULL,
  `survey_answer_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_answer_descr` text COLLATE utf8_unicode_ci,
  `survey_answer_class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_answer_comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_answer_sort` int(11) DEFAULT NULL,
  `survey_answer_points` int(11) DEFAULT '0',
  `survey_answer_show_descr` tinyint(1) DEFAULT '0',
  `survey_answer_show_corrective_action` tinyint(1) DEFAULT '0',
  `survey_answer_corrective_action` text COLLATE utf8_unicode_ci,
  `correct` tinyint(1) DEFAULT '0',
  `corrective_action_date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`survey_answer_id`),
  KEY `fk_survey_answer_to_question_idx` (`survey_answer_question_id`),
  CONSTRAINT `survey_answer_ibfk_1` FOREIGN KEY (`survey_answer_question_id`) REFERENCES `survey_question` (`survey_question_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey_answer
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_degree_level`
-- ----------------------------
DROP TABLE IF EXISTS `survey_degree_level`;
CREATE TABLE `survey_degree_level` (
  `survey_degree_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `survey_degree_level_survey_id` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `from` int(11) DEFAULT NULL,
  `to` int(11) DEFAULT NULL,
  PRIMARY KEY (`survey_degree_level_id`),
  KEY `fk_survey_degree_level_survey_idx` (`survey_degree_level_survey_id`),
  CONSTRAINT `survey_degree_level_ibfk_1` FOREIGN KEY (`survey_degree_level_survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_degree_level
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_question`
-- ----------------------------
DROP TABLE IF EXISTS `survey_question`;
CREATE TABLE `survey_question` (
  `survey_question_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `survey_question_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_question_descr` text COLLATE utf8_unicode_ci,
  `survey_question_type` tinyint(3) unsigned DEFAULT NULL,
  `survey_question_survey_id` int(11) unsigned DEFAULT NULL,
  `survey_question_can_skip` tinyint(1) DEFAULT '0',
  `survey_question_show_descr` tinyint(1) DEFAULT '0',
  `survey_question_is_scorable` tinyint(1) DEFAULT '0',
  `steps` int(11) DEFAULT NULL,
  `survey_question_attachment_file` tinyint(1) DEFAULT '0',
  `survey_question_point` int(11) DEFAULT NULL,
  PRIMARY KEY (`survey_question_id`),
  KEY `fk_survey_question_to_survey_idx` (`survey_question_survey_id`),
  KEY `fk_survey_question_to_type_idx` (`survey_question_type`),
  CONSTRAINT `survey_question_ibfk_1` FOREIGN KEY (`survey_question_survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `survey_question_ibfk_2` FOREIGN KEY (`survey_question_type`) REFERENCES `survey_type` (`survey_type_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey_question
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_restricted_user`
-- ----------------------------
DROP TABLE IF EXISTS `survey_restricted_user`;
CREATE TABLE `survey_restricted_user` (
  `survey_restricted_user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `survey_restricted_user_survey_id` int(11) unsigned NOT NULL,
  `survey_restricted_user_user_id` int(11) NOT NULL,
  PRIMARY KEY (`survey_restricted_user_id`),
  KEY `fk_survey_restricted_user_to_survey` (`survey_restricted_user_survey_id`),
  KEY `fk_survey_restricted_user_to_user` (`survey_restricted_user_user_id`),
  CONSTRAINT `survey_restricted_user_ibfk_1` FOREIGN KEY (`survey_restricted_user_survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `survey_restricted_user_ibfk_2` FOREIGN KEY (`survey_restricted_user_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_restricted_user
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_stat`
-- ----------------------------
DROP TABLE IF EXISTS `survey_stat`;
CREATE TABLE `survey_stat` (
  `survey_stat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `survey_stat_survey_id` int(11) unsigned DEFAULT NULL,
  `survey_stat_user_id` int(11) DEFAULT NULL,
  `survey_stat_assigned_at` timestamp NULL DEFAULT NULL,
  `survey_stat_started_at` timestamp NULL DEFAULT NULL,
  `survey_stat_updated_at` timestamp NULL DEFAULT NULL,
  `survey_stat_ended_at` timestamp NULL DEFAULT NULL,
  `survey_stat_session_start` timestamp NULL DEFAULT NULL,
  `survey_stat_actual_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_stat_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_stat_is_done` tinyint(1) DEFAULT '0',
  `survey_stat_hash` char(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pageNo` int(11) DEFAULT NULL,
  PRIMARY KEY (`survey_stat_id`),
  UNIQUE KEY `survey_stat_hash_UNIQUE` (`survey_stat_hash`),
  KEY `fk_sas_user_idx` (`survey_stat_user_id`),
  KEY `fk_stat_to_survey_idx` (`survey_stat_survey_id`),
  CONSTRAINT `survey_stat_ibfk_1` FOREIGN KEY (`survey_stat_survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `survey_stat_ibfk_2` FOREIGN KEY (`survey_stat_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey_stat
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_type`
-- ----------------------------
DROP TABLE IF EXISTS `survey_type`;
CREATE TABLE `survey_type` (
  `survey_type_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `survey_type_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_type_name_ar` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_type_descr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_type_descr_ar` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`survey_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey_type
-- ----------------------------
INSERT INTO `survey_type` VALUES ('1', 'Multiple choice', 'خيارات من متعدد', 'Ask your respondent to choose multiple answers from your list of answer choices.', 'امكانيه اختيار اكتر من اجابه', '1', '4');
INSERT INTO `survey_type` VALUES ('2', 'One choise of list', 'خيار واحد من متعدد', 'Ask your respondent to choose one answer from your list of answer choices.', 'اختيار اجابة واحده من مجموعه اجابات', '1', '5');
INSERT INTO `survey_type` VALUES ('3', 'Dropdown', 'خيار واحد من قائمة', 'Provide a dropdown list of answer choices for respondents to choose from.', 'قائمه منسدله لاختيار اجابه واحده', '1', '3');
INSERT INTO `survey_type` VALUES ('4', 'Ranking', 'تصنيف', 'Ask respondents to rank a list of options in the order they prefer using numeric dropdown menus.', 'تقييم مجموعه من الاجابات حسب الافضل', '1', '9');
INSERT INTO `survey_type` VALUES ('5', 'Rating', 'تقييم', 'Ask respondents to rate an item or question by dragging an interactive slider.', 'تقييم من خلال اختيا رنسبه من سليدر', '1', '7');
INSERT INTO `survey_type` VALUES ('6', 'Single textbox', 'سؤال نصي', 'Add a single textbox to your survey when you want respondents to write in a short text or numerical answer to your question.', 'اظهار مكان لادخال اجابه نصيه ', '1', '1');
INSERT INTO `survey_type` VALUES ('7', 'Multiple textboxes', 'مربعات النص متعددة', 'Add multiple textboxes to your survey when you want respondents to write in more than one short text or numerical answer to your question.', 'امكانيه ادخال اكتر من اجابه نصية', null, null);
INSERT INTO `survey_type` VALUES ('8', 'Comment box', 'صندوق التعليقات', 'Use the comment or essay box to collect open-ended, written feedback from respondents.', 'امكانيه كتابة تعليق على الاجابة', '1', '2');
INSERT INTO `survey_type` VALUES ('9', 'Date/Time', 'تاريخ / وقت', 'Ask respondents to enter a specific date and/or time.', 'اختيار تاريخ معين', '1', '6');
INSERT INTO `survey_type` VALUES ('10', 'Calendar', 'التقويم', 'Ask respondents to choose better date/time for a meeting.', 'اختيار تاريخ', null, null);
INSERT INTO `survey_type` VALUES ('11', 'File', 'ملف', 'Ask your respondent to attach file answers.', 'اطلب من المستفتى إرفاق الاجابة علي هيئة ملف', '1', '8');

-- ----------------------------
-- Table structure for `survey_user_answer`
-- ----------------------------
DROP TABLE IF EXISTS `survey_user_answer`;
CREATE TABLE `survey_user_answer` (
  `survey_user_answer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `survey_user_answer_user_id` int(11) DEFAULT NULL,
  `survey_user_answer_survey_id` int(11) unsigned DEFAULT NULL,
  `survey_user_answer_question_id` int(11) unsigned DEFAULT NULL,
  `survey_user_answer_answer_id` bigint(20) unsigned DEFAULT NULL,
  `survey_user_answer_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_user_answer_text` text COLLATE utf8_unicode_ci,
  `survey_user_answer_file_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_user_answer_point` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  PRIMARY KEY (`survey_user_answer_id`),
  KEY `fk_survey_user_answer_answer_idx` (`survey_user_answer_answer_id`),
  KEY `fk_survey_user_answer_user_idx` (`survey_user_answer_user_id`),
  KEY `idx_answer_value` (`survey_user_answer_answer_id`,`survey_user_answer_value`),
  KEY `idx_question_value` (`survey_user_answer_question_id`,`survey_user_answer_value`),
  KEY `ff_idx` (`survey_user_answer_survey_id`),
  KEY `fk_survey_user_answer_question_idx` (`survey_user_answer_question_id`),
  KEY `idx_survey_user_answer_value` (`survey_user_answer_value`),
  CONSTRAINT `survey_user_answer_ibfk_1` FOREIGN KEY (`survey_user_answer_answer_id`) REFERENCES `survey_answer` (`survey_answer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `survey_user_answer_ibfk_2` FOREIGN KEY (`survey_user_answer_question_id`) REFERENCES `survey_question` (`survey_question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `survey_user_answer_ibfk_3` FOREIGN KEY (`survey_user_answer_survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `survey_user_answer_ibfk_4` FOREIGN KEY (`survey_user_answer_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey_user_answer
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_user_answer_attachments`
-- ----------------------------
DROP TABLE IF EXISTS `survey_user_answer_attachments`;
CREATE TABLE `survey_user_answer_attachments` (
  `survey_user_answer_attachments_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `survey_user_answer_attachments_user_id` int(11) DEFAULT NULL,
  `survey_user_answer_attachments_survey_id` int(11) unsigned DEFAULT NULL,
  `survey_user_answer_attachments_question_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `base_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  PRIMARY KEY (`survey_user_answer_attachments_id`),
  KEY `fk_survey_user_answer_attachments_user_idx` (`survey_user_answer_attachments_user_id`),
  KEY `idx_question_value` (`survey_user_answer_attachments_question_id`),
  KEY `ff_idx` (`survey_user_answer_attachments_survey_id`),
  KEY `fk_survey_user_answer_attachments_question_idx` (`survey_user_answer_attachments_question_id`),
  CONSTRAINT `survey_user_answer_attachments_ibfk_1` FOREIGN KEY (`survey_user_answer_attachments_question_id`) REFERENCES `survey_question` (`survey_question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `survey_user_answer_attachments_ibfk_2` FOREIGN KEY (`survey_user_answer_attachments_survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `survey_user_answer_attachments_ibfk_3` FOREIGN KEY (`survey_user_answer_attachments_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey_user_answer_attachments
-- ----------------------------

-- ----------------------------
-- Table structure for `system_db_migration`
-- ----------------------------
DROP TABLE IF EXISTS `system_db_migration`;
CREATE TABLE `system_db_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_db_migration
-- ----------------------------
INSERT INTO `system_db_migration` VALUES ('m000000_000000_base', '1570528066');
INSERT INTO `system_db_migration` VALUES ('m150725_192740_seed_data', '1570528643');
INSERT INTO `system_db_migration` VALUES ('m181018_070730_create_table_survey', '1571567191');
INSERT INTO `system_db_migration` VALUES ('m181018_070730_create_table_survey_answer', '1571567192');
INSERT INTO `system_db_migration` VALUES ('m181018_070730_create_table_survey_question', '1571567192');
INSERT INTO `system_db_migration` VALUES ('m181018_070730_create_table_survey_stat', '1571567320');
INSERT INTO `system_db_migration` VALUES ('m181018_070730_create_table_survey_type', '1571567321');
INSERT INTO `system_db_migration` VALUES ('m181018_070730_create_table_survey_user_answer', '1571567321');
INSERT INTO `system_db_migration` VALUES ('m181018_070730_foreign_keys', '1571567321');
INSERT INTO `system_db_migration` VALUES ('m190918_224430_private_survey', '1571567321');
INSERT INTO `system_db_migration` VALUES ('m191010_141946_EditRoles', '1570717350');
INSERT INTO `system_db_migration` VALUES ('m191010_145650_organization', '1570964429');
INSERT INTO `system_db_migration` VALUES ('m191013_132851_EditRoles', '1570973349');
INSERT INTO `system_db_migration` VALUES ('m191014_105422_add_bio_user_profile', '1571212612');
INSERT INTO `system_db_migration` VALUES ('m191014_151848_organization_active', '1571212612');
INSERT INTO `system_db_migration` VALUES ('m191016_074704_drop_name_en_organization', '1571212612');
INSERT INTO `system_db_migration` VALUES ('m191016_134353_organization_slug', '1571235707');
INSERT INTO `system_db_migration` VALUES ('m191017_071630_ThemeTBL', '1571745543');
INSERT INTO `system_db_migration` VALUES ('m191017_093417_translateTBL', '1571745543');
INSERT INTO `system_db_migration` VALUES ('m191021_101937_pages_table', '1571745544');
INSERT INTO `system_db_migration` VALUES ('m191022_084012_footer_links', '1571745544');
INSERT INTO `system_db_migration` VALUES ('m191024_091857_SurvyTBLS', '1571908840');
INSERT INTO `system_db_migration` VALUES ('m191029_140751_question_type_trans', '1572421317');
INSERT INTO `system_db_migration` VALUES ('m191029_141127_question_type_trans_ar_value', '1572421317');
INSERT INTO `system_db_migration` VALUES ('m191029_141136_question_type_trans_ar_value', '1572446713');
INSERT INTO `system_db_migration` VALUES ('m191030_092737_survey_info', '1572446713');
INSERT INTO `system_db_migration` VALUES ('m191031_100123_survey_stat_add_pageNo', '1572521193');
INSERT INTO `system_db_migration` VALUES ('m191031_120212_survey_answer_add_corrective_action', '1572527251');
INSERT INTO `system_db_migration` VALUES ('m191103_135248_SyrvyTypes', '1572789230');
INSERT INTO `system_db_migration` VALUES ('m191104_122637_survey_type_add_file', '1572946329');
INSERT INTO `system_db_migration` VALUES ('m191105_094511_editSurvyTypes', '1572947150');
INSERT INTO `system_db_migration` VALUES ('m191105_094513_editSurvyTypes', '1573543797');
INSERT INTO `system_db_migration` VALUES ('m191110_075927_survey_answer_attachments', '1573543797');
INSERT INTO `system_db_migration` VALUES ('m191110_140829_media', '1573543797');
INSERT INTO `system_db_migration` VALUES ('m191111_074819_survey_quest_step_type_slider', '1573543797');
INSERT INTO `system_db_migration` VALUES ('m191111_095653_survey_question_attachment_file', '1573543797');
INSERT INTO `system_db_migration` VALUES ('m191111_134954_survey_stat_session_start_actual_time', '1573543797');
INSERT INTO `system_db_migration` VALUES ('m191113_084216_survey_user_answer_file_type', '1573724087');
INSERT INTO `system_db_migration` VALUES ('m191114_075212_survey_poinst', '1573724087');
INSERT INTO `system_db_migration` VALUES ('m191114_081524_survey_questions_points', '1573724088');
INSERT INTO `system_db_migration` VALUES ('m191117_085033_survey_user_answer_point', '1574169094');
INSERT INTO `system_db_migration` VALUES ('m191117_124931_survey_answer_correct', '1574169095');
INSERT INTO `system_db_migration` VALUES ('m191120_074939_change_type_survey_user_answer', '1574241958');
INSERT INTO `system_db_migration` VALUES ('m191124_150808_survey_degree_level', '1574780425');
INSERT INTO `system_db_migration` VALUES ('m191126_074048_survey_corrective_action_date', '1574780425');
INSERT INTO `system_db_migration` VALUES ('m191126_095713_corrective_action_report', '1574780425');
INSERT INTO `system_db_migration` VALUES ('m191203_073233_organization_about', '1575365417');
INSERT INTO `system_db_migration` VALUES ('m191203_153352_media_user_id', '1575493698');
INSERT INTO `system_db_migration` VALUES ('m191204_210614_postTBL', '1575493698');

-- ----------------------------
-- Table structure for `system_log`
-- ----------------------------
DROP TABLE IF EXISTS `system_log`;
CREATE TABLE `system_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `level` int(11) DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_time` double DEFAULT NULL,
  `prefix` text COLLATE utf8_unicode_ci,
  `message` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `idx_log_level` (`level`),
  KEY `idx_log_category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=4881 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of system_log
-- ----------------------------

-- ----------------------------
-- Table structure for `timeline_event`
-- ----------------------------
DROP TABLE IF EXISTS `timeline_event`;
CREATE TABLE `timeline_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application` varchar(64) NOT NULL,
  `category` varchar(64) NOT NULL,
  `event` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of timeline_event
-- ----------------------------

-- ----------------------------
-- Table structure for `translations_with_string`
-- ----------------------------
DROP TABLE IF EXISTS `translations_with_string`;
CREATE TABLE `translations_with_string` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(100) NOT NULL,
  `model_id` int(11) NOT NULL,
  `attribute` varchar(100) NOT NULL,
  `lang` varchar(6) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute` (`attribute`),
  KEY `table_name` (`table_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of translations_with_string
-- ----------------------------

-- ----------------------------
-- Table structure for `translations_with_text`
-- ----------------------------
DROP TABLE IF EXISTS `translations_with_text`;
CREATE TABLE `translations_with_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(100) NOT NULL,
  `model_id` int(11) NOT NULL,
  `attribute` varchar(100) NOT NULL,
  `lang` varchar(6) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute` (`attribute`),
  KEY `table_name` (`table_name`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of translations_with_text
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `auth_key` varchar(32) NOT NULL,
  `access_token` text,
  `password_hash` varchar(255) NOT NULL,
  `oauth_client` varchar(255) DEFAULT NULL,
  `oauth_client_user_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '2',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `logged_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------

-- ----------------------------
-- Table structure for `user_attachment`
-- ----------------------------
DROP TABLE IF EXISTS `user_attachment`;
CREATE TABLE `user_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `base_url` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `meta` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_attachment` (`user_id`),
  CONSTRAINT `user_attachment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_attachment
-- ----------------------------

-- ----------------------------
-- Table structure for `user_profile`
-- ----------------------------
DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE `user_profile` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `avatar_path` varchar(255) DEFAULT NULL,
  `avatar_base_url` varchar(255) DEFAULT NULL,
  `locale` varchar(32) NOT NULL,
  `activity` varchar(100) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `specialization_id` int(11) unsigned NOT NULL DEFAULT '0',
  `nationality_id` int(11) unsigned NOT NULL DEFAULT '0',
  `draft` tinyint(1) NOT NULL DEFAULT '0',
  `gender` smallint(1) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `device_token` varchar(200) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '0',
  `organization_id` int(11) unsigned DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  `district_id` int(10) unsigned DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `bio` text,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_profile
-- ----------------------------

-- ----------------------------
-- Table structure for `user_token`
-- ----------------------------
DROP TABLE IF EXISTS `user_token`;
CREATE TABLE `user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `token` varchar(40) NOT NULL,
  `expire_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_token
-- ----------------------------
