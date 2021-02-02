

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `user`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS nuser;
CREATE SEQUENCE user_seq;

CREATE TABLE nuser (
  id int NOT NULL DEFAULT NEXTVAL ('user_seq'),
  username varchar(32) DEFAULT NULL,
  auth_key varchar(32) NOT NULL,
  access_token text,
  password_hash varchar(255) NOT NULL,
  oauth_client varchar(255) DEFAULT NULL,
  oauth_client_user_id varchar(255) DEFAULT NULL,
  email varchar(255) NOT NULL,
  status smallint NOT NULL DEFAULT '2',
  created_at int DEFAULT NULL,
  updated_at int DEFAULT NULL,
  logged_at int DEFAULT NULL,
  PRIMARY KEY (id)
)  ;

ALTER SEQUENCE user_seq RESTART WITH 5;

-- SQLINES DEMO *** -----------
-- Records of user
-- SQLINES DEMO *** -----------
INSERT INTO nuser VALUES ('1', 'superadmin', 'Chl2wTf1lcFvgHzjy_d7o3T79cBGBTGj', 'foGDvBiPRrk8MkemGZyZCAudcdxTUtY-HjFW_PlR', '$2y$13$Ij0Bjtsnv/9D7uoHZ7p4leQl7JJHezG0Ugr9woqz68y8y0XE2Zn3a', null, null, 'webmaster@example.com', '2', '1552385275', '1552385275', '1569225691');
INSERT INTO nuser VALUES ('2', 'manager', 'm64KHrNPyf7q1slLz0x9Rlqx6fbmfY4M', 'bkVRGck5Lf1dC2xF9jequ5qPg67o0lpZAGyVAAJE', '$2y$13$RoksEVwYtitm.xjsQw0zp.iSI/T051q2aNW4/gAffylbPq4LqlpCS', null, null, 'manager@takeen.com', '2', '1552385276', '1580894283', '1580894383');
INSERT INTO nuser VALUES ('3', 'user', 'IgC3yV60pa5oIbrtahAEEUgQAbJDfzz9', '__yC5eEfXr6yYM8EuTweBqjxU92ZD6vdrLCc-GdC', '$2y$13$9V/G9ZtHZl5NWM5NwZGRmeogHQDBrfpavhbMYlRl1kBb7J0wXN2Jm', null, null, 'user@example.com', '2', '1552385276', '1552385276', null);
INSERT INTO nuser VALUES ('4', 'tamkeen-superadmin', 'Chl2wTf1lcFvgHzjy_d7o3T79cBGBTGj', 'foGDvBiPRrk8MkemGZyZCAudcdxTUtY-HjFW_PlR', '$2y$13$Ij0Bjtsnv/9D7uoHZ7p4leQl7JJHezG0Ugr9woqz68y8y0XE2Zn3a', null, null, 'tamkeen-superadmin@takeen.com', '2', '1552385275', '1552385275', '1569225691');


-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `city`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS city;
CREATE SEQUENCE city_seq;

CREATE TABLE city (
  id int check (id > 0) NOT NULL DEFAULT NEXTVAL ('city_seq'),
  ref varchar(255) DEFAULT NULL,
  title varchar(255) NOT NULL,
  slug varchar(255) DEFAULT NULL,
  sort int DEFAULT NULL,
  PRIMARY KEY (id)
)  ;

ALTER SEQUENCE city_seq RESTART WITH 44;

-- SQLINES DEMO *** -----------
-- Records of city
-- SQLINES DEMO *** -----------
INSERT INTO city VALUES ('3', 'إدارة التعليم بمحافظة الافلاج', ' الافلاج', null, null);
INSERT INTO city VALUES ('4', 'إدارة التعليم بمحافظة البكيرية', ' البكيرية', null, null);
INSERT INTO city VALUES ('5', 'إدارة التعليم بمحافظة الخرج', ' الخرج', null, null);
INSERT INTO city VALUES ('6', 'إدارة التعليم بمحافظة الدوادمي', ' الدوادمي', null, null);
INSERT INTO city VALUES ('7', 'إدارة التعليم بمحافظة الرس', ' الرس', null, null);
INSERT INTO city VALUES ('8', 'إدارة التعليم بمحافظة الزلفي', ' الزلفي', null, null);
INSERT INTO city VALUES ('9', 'إدارة التعليم بمحافظة العلا', ' العلا', null, null);
INSERT INTO city VALUES ('10', 'إدارة التعليم بمحافظة الـغاط', ' الـغاط', null, null);
INSERT INTO city VALUES ('11', 'إدارة التعليم بمحافظة القريات', ' القريات', null, null);
INSERT INTO city VALUES ('12', 'إدارة التعليم بمحافظة القنفذة', ' القنفذة', null, null);
INSERT INTO city VALUES ('13', 'إدارة التعليم بمحافظة القويعية', ' القويعية', null, null);
INSERT INTO city VALUES ('14', 'إدارة التعليم بمحافظة الليث', ' الليث', null, null);
INSERT INTO city VALUES ('15', 'إدارة التعليم بمحافظة المجمعة', ' المجمعة', null, null);
INSERT INTO city VALUES ('16', 'إدارة التعليم بمحافظة المخواة', ' المخواة', null, null);
INSERT INTO city VALUES ('17', 'إدارة التعليم بمحافظة المذنب', ' المذنب', null, null);
INSERT INTO city VALUES ('18', 'إدارة التعليم بمحافظة بيشة', ' بيشة', null, null);
INSERT INTO city VALUES ('19', 'إدارة التعليم بمحافظة حفر الباطن', ' حفر الباطن', null, null);
INSERT INTO city VALUES ('20', 'إدارة التعليم بمحافظة شقراء', ' شقراء', null, null);
INSERT INTO city VALUES ('21', 'إدارة التعليم بمحافظة صبيا', ' صبيا', null, null);
INSERT INTO city VALUES ('22', 'إدارة التعليم بمحافظة عفيف', ' عفيف', null, null);
INSERT INTO city VALUES ('23', 'إدارة التعليم بمحافظة عنيزة', ' عنيزة', null, null);
INSERT INTO city VALUES ('24', 'إدارة التعليم بمحافظة وادي الدواسر', ' وادي الدواسر', null, null);
INSERT INTO city VALUES ('25', 'إدارة التعليم بمحافظة ينبع', ' ينبع', null, null);
INSERT INTO city VALUES ('26', 'إدارة التعليم بمحافظتي حوطة بني تميم والحريق', ' حوطة بني تميم والحريق', null, null);
INSERT INTO city VALUES ('27', 'الإدارة العامة للتعليم بالمنطقة الشرقية', ' المنطقة الشرقية', null, null);
INSERT INTO city VALUES ('28', 'الإدارة العامة للتعليم بمحافظة الاحساء', ' الاحساء', null, null);
INSERT INTO city VALUES ('29', 'الإدارة العامة للتعليم بمحافظة الطائف', ' الطائف', null, null);
INSERT INTO city VALUES ('30', 'الإدارة العامة للتعليم بمحافظة جدة', ' جدة', null, null);
INSERT INTO city VALUES ('31', 'الإدارة العامة للتعليم بمحافظة محايل عسير', ' محايل عسير', null, null);
INSERT INTO city VALUES ('32', 'الإدارة العامة للتعليم بمنطقة الباحة', ' الباحة', null, null);
INSERT INTO city VALUES ('33', 'الإدارة العامة للتعليم بمنطقة الجوف', ' الجوف', null, null);
INSERT INTO city VALUES ('34', 'الإدارة العامة للتعليم بمنطقة الحدود الشمالية', ' الحدود الشمالية', null, null);
INSERT INTO city VALUES ('35', 'الإدارة العامة للتعليم بمنطقة الرياض', ' الرياض', null, '1');
INSERT INTO city VALUES ('36', 'الإدارة العامة للتعليم بمنطقة القصيم', ' القصيم', null, null);
INSERT INTO city VALUES ('37', 'الإدارة العامة للتعليم بمنطقة المدينة المنورة', ' المدينة المنورة', null, null);
INSERT INTO city VALUES ('38', 'الإدارة العامة للتعليم بمنطقة تبوك', ' تبوك', null, null);
INSERT INTO city VALUES ('39', 'الإدارة العامة للتعليم بمنطقة جازان', ' جازان', null, null);
INSERT INTO city VALUES ('40', 'الإدارة العامة للتعليم بمنطقة حائل', ' حائل', null, null);
INSERT INTO city VALUES ('41', 'الإدارة العامة للتعليم بمنطقة عسير', ' عسير', null, null);
INSERT INTO city VALUES ('42', 'الإدارة العامة للتعليم بمنطقة مكة المكرمة', ' مكة المكرمة', null, null);
INSERT INTO city VALUES ('43', 'الإدارة العامة للتعليم بمنطقة نجران', ' نجران', null, null);

-- SQLINES DEMO *** -----------
-- Records of session
-- SQLINES DEMO *** -----------

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `survey`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS survey;
CREATE SEQUENCE survey_seq;

CREATE TABLE survey (
  survey_id int check (survey_id > 0) NOT NULL DEFAULT NEXTVAL ('survey_seq'),
  survey_name varchar(255) DEFAULT NULL,
  survey_created_at timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  survey_updated_at timestamp(0) NULL DEFAULT NULL,
  survey_expired_at timestamp(0) NULL DEFAULT NULL,
  survey_is_pinned smallint DEFAULT '0',
  survey_is_closed smallint DEFAULT '0',
  survey_tags varchar(255) DEFAULT NULL,
  survey_image varchar(255) DEFAULT NULL,
  survey_created_by int DEFAULT NULL,
  survey_wallet int check (survey_wallet > 0) DEFAULT NULL,
  survey_status int check (survey_status > 0) DEFAULT NULL,
  survey_descr text,
  survey_time_to_pass smallint check (survey_time_to_pass > 0) DEFAULT NULL,
  survey_badge_id int check (survey_badge_id > 0) DEFAULT NULL,
  survey_is_private smallint NOT NULL DEFAULT '0',
  survey_is_visible smallint NOT NULL DEFAULT '0',
  org_id int check (org_id > 0) DEFAULT NULL,
  start_info text,
  survey_point int DEFAULT NULL,
  sector_id int DEFAULT NULL,
  admin_enabled smallint DEFAULT '0' ,
  PRIMARY KEY (survey_id)
 ,
  CONSTRAINT survey_ibfk_1 FOREIGN KEY (survey_created_by) REFERENCES nuser (id) ON DELETE SET NULL ON UPDATE CASCADE
)  ;

CREATE INDEX fk_survey_created_by_idx ON survey (survey_created_by);

-- SQLINES DEMO *** -----------
-- Records of survey
-- SQLINES DEMO *** -----------



-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `survey_type`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS survey_type;
CREATE SEQUENCE survey_type_seq;

CREATE TABLE survey_type (
  survey_type_id smallint check (survey_type_id > 0) NOT NULL DEFAULT NEXTVAL ('survey_type_seq'),
  survey_type_name varchar(255) DEFAULT NULL,
  survey_type_name_ar varchar(150) DEFAULT NULL,
  survey_type_descr varchar(255) DEFAULT NULL,
  survey_type_descr_ar varchar(150) DEFAULT NULL,
  status int DEFAULT NULL,
  sort int DEFAULT NULL,
  PRIMARY KEY (survey_type_id)
)   ;

ALTER SEQUENCE survey_type_seq RESTART WITH 12;

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** _type
-- SQLINES DEMO *** -----------
INSERT INTO survey_type VALUES ('1', 'Multiple choice', 'خيارات من متعدد', 'Ask your respondent to choose multiple answers from your list of answer choices.', 'امكانيه اختيار اكتر من اجابه', '1', '4');
INSERT INTO survey_type VALUES ('2', 'One choise of list', 'خيار واحد من متعدد', 'Ask your respondent to choose one answer from your list of answer choices.', 'اختيار اجابة واحده من مجموعه اجابات', '1', '5');
INSERT INTO survey_type VALUES ('3', 'Dropdown', 'خيار واحد من قائمة', 'Provide a dropdown list of answer choices for respondents to choose from.', 'قائمه منسدله لاختيار اجابه واحده', '1', '3');
INSERT INTO survey_type VALUES ('4', 'Ranking', 'تصنيف', 'Ask respondents to rank a list of options in the order they prefer using numeric dropdown menus.', 'تقييم مجموعه من الاجابات حسب الافضل', '1', '9');
INSERT INTO survey_type VALUES ('5', 'Rating', 'تقييم', 'Ask respondents to rate an item or question by dragging an interactive slider.', 'تقييم من خلال اختيا رنسبه من سليدر', '1', '7');
INSERT INTO survey_type VALUES ('6', 'Single textbox', 'سؤال نصي', 'Add a single textbox to your survey when you want respondents to write in a short text or numerical answer to your question.', 'اظهار مكان لادخال اجابه نصيه ', '1', '1');
INSERT INTO survey_type VALUES ('7', 'Multiple textboxes', 'مربعات النص متعددة', 'Add multiple textboxes to your survey when you want respondents to write in more than one short text or numerical answer to your question.', 'امكانيه ادخال اكتر من اجابه نصية', null, null);
INSERT INTO survey_type VALUES ('8', 'Comment box', 'نص كبير', 'Use the comment or essay box to collect open-ended, written feedback from respondents.', 'امكانيه كتابة تعليق على الاجابة', '1', '2');
INSERT INTO survey_type VALUES ('9', 'Date/Time', 'تاريخ / وقت', 'Ask respondents to enter a specific date and/or time.', 'اختيار تاريخ معين', '1', '6');
INSERT INTO survey_type VALUES ('10', 'Calendar', 'التقويم', 'Ask respondents to choose better date/time for a meeting.', 'اختيار تاريخ', null, null);
INSERT INTO survey_type VALUES ('11', 'File', 'ملف', 'Ask your respondent to attach file answers.', 'اطلب من المستفتى إرفاق الاجابة علي هيئة ملف', '1', '8');




-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `survey_question`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS survey_question;
CREATE SEQUENCE survey_question_seq;

CREATE TABLE survey_question (
  survey_question_id int check (survey_question_id > 0) NOT NULL DEFAULT NEXTVAL ('survey_question_seq'),
  survey_question_name varchar(255) DEFAULT NULL,
  survey_question_descr text,
  survey_question_type smallint check (survey_question_type > 0) DEFAULT NULL,
  survey_question_survey_id int check (survey_question_survey_id > 0) DEFAULT NULL,
  survey_question_can_skip smallint DEFAULT '0',
  survey_question_show_descr smallint DEFAULT '0',
  survey_question_is_scorable smallint DEFAULT '0',
  steps int DEFAULT NULL,
  survey_question_attachment_file smallint DEFAULT '0',
  survey_question_point int DEFAULT NULL,
  survey_question_can_ignore smallint DEFAULT '0',
  PRIMARY KEY (survey_question_id)
 ,
  CONSTRAINT survey_question_ibfk_1 FOREIGN KEY (survey_question_survey_id) REFERENCES survey (survey_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT survey_question_ibfk_2 FOREIGN KEY (survey_question_type) REFERENCES survey_type (survey_type_id) ON UPDATE CASCADE
)  ;

CREATE INDEX fk_survey_question_to_survey_idx ON survey_question (survey_question_survey_id);
CREATE INDEX fk_survey_question_to_type_idx ON survey_question (survey_question_type);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** _question
-- SQLINES DEMO *** -----------




-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `survey_answer`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS survey_answer;
CREATE SEQUENCE survey_answer_seq;

CREATE TABLE survey_answer (
  survey_answer_id bigint check (survey_answer_id > 0) NOT NULL DEFAULT NEXTVAL ('survey_answer_seq'),
  survey_answer_question_id int check (survey_answer_question_id > 0) DEFAULT NULL,
  survey_answer_name varchar(255) DEFAULT NULL,
  survey_answer_descr text,
  survey_answer_class varchar(255) DEFAULT NULL,
  survey_answer_comment varchar(255) DEFAULT NULL,
  survey_answer_sort int DEFAULT NULL,
  survey_answer_points int DEFAULT '0',
  survey_answer_show_descr smallint DEFAULT '0',
  survey_answer_show_corrective_action smallint DEFAULT '0',
  survey_answer_corrective_action text,
  correct smallint DEFAULT '0',
  corrective_action_date varchar(10) DEFAULT NULL,
  PRIMARY KEY (survey_answer_id)
 ,
  CONSTRAINT survey_answer_ibfk_1 FOREIGN KEY (survey_answer_question_id) REFERENCES survey_question (survey_question_id) ON DELETE CASCADE ON UPDATE CASCADE
)  ;

CREATE INDEX fk_survey_answer_to_question_idx ON survey_answer (survey_answer_question_id);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** _answer
-- SQLINES DEMO *** -----------




-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `survey_restricted_user`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS survey_restricted_user;
CREATE SEQUENCE survey_restricted_user_seq;

CREATE TABLE survey_restricted_user (
  survey_restricted_user_id int check (survey_restricted_user_id > 0) NOT NULL DEFAULT NEXTVAL ('survey_restricted_user_seq'),
  survey_restricted_user_survey_id int check (survey_restricted_user_survey_id > 0) NOT NULL,
  survey_restricted_user_user_id int NOT NULL,
  PRIMARY KEY (survey_restricted_user_id)
 ,
  CONSTRAINT survey_restricted_user_ibfk_1 FOREIGN KEY (survey_restricted_user_survey_id) REFERENCES survey (survey_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT survey_restricted_user_ibfk_2 FOREIGN KEY (survey_restricted_user_user_id) REFERENCES nuser (id) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE INDEX fk_survey_restricted_user_to_survey ON survey_restricted_user (survey_restricted_user_survey_id);
CREATE INDEX fk_survey_restricted_user_to_user ON survey_restricted_user (survey_restricted_user_user_id);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** _restricted_user
-- SQLINES DEMO *** -----------


-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `district`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS district;
CREATE SEQUENCE district_seq;

CREATE TABLE district (
  id int check (id > 0) NOT NULL DEFAULT NEXTVAL ('district_seq'),
  city_id int check (city_id > 0) NOT NULL,
  title varchar(255) NOT NULL,
  slug varchar(255) DEFAULT NULL,
  PRIMARY KEY (id)
 ,
  CONSTRAINT district_ibfk_1 FOREIGN KEY (city_id) REFERENCES city (id) ON DELETE CASCADE ON UPDATE CASCADE
)  ;

ALTER SEQUENCE district_seq RESTART WITH 143;

CREATE INDEX city_id ON district (city_id);

-- SQLINES DEMO *** -----------
-- Records of district
-- SQLINES DEMO *** -----------
INSERT INTO district VALUES ('6', '35', 'اسكان البحرية', null);
INSERT INTO district VALUES ('7', '35', 'اسكان طريق الخرج', null);
INSERT INTO district VALUES ('8', '35', 'اشبيليا', null);
INSERT INTO district VALUES ('9', '35', 'الأندلس', null);
INSERT INTO district VALUES ('10', '35', 'الازدهار', null);
INSERT INTO district VALUES ('11', '35', 'الامانة', null);
INSERT INTO district VALUES ('12', '35', 'البديعة', null);
INSERT INTO district VALUES ('13', '35', 'التخصصي', null);
INSERT INTO district VALUES ('14', '35', 'التعاون', null);
INSERT INTO district VALUES ('15', '35', 'الحزم', null);
INSERT INTO district VALUES ('16', '35', 'الحمراء', null);
INSERT INTO district VALUES ('17', '35', 'الخالدية', null);
INSERT INTO district VALUES ('18', '35', 'الخزامى', null);
INSERT INTO district VALUES ('19', '35', 'الخليج', null);
INSERT INTO district VALUES ('20', '35', 'الدائد', null);
INSERT INTO district VALUES ('21', '35', 'الدار البيضاء', null);
INSERT INTO district VALUES ('22', '35', 'الرائد', null);
INSERT INTO district VALUES ('23', '35', 'الربوة', null);
INSERT INTO district VALUES ('24', '35', 'الربيع', null);
INSERT INTO district VALUES ('25', '35', 'الرحاب', null);
INSERT INTO district VALUES ('26', '35', 'الرحمانية', null);
INSERT INTO district VALUES ('27', '35', 'الرفيعة', null);
INSERT INTO district VALUES ('28', '35', 'الرمال', null);
INSERT INTO district VALUES ('29', '35', 'الروابي', null);
INSERT INTO district VALUES ('30', '35', 'الروضة', null);
INSERT INTO district VALUES ('31', '35', 'الريان', null);
INSERT INTO district VALUES ('32', '35', 'الزهراء', null);
INSERT INTO district VALUES ('33', '35', 'الزهرة', null);
INSERT INTO district VALUES ('34', '35', 'السعادة', null);
INSERT INTO district VALUES ('35', '35', 'السفارات', null);
INSERT INTO district VALUES ('36', '35', 'السلام', null);
INSERT INTO district VALUES ('37', '35', 'السلي', null);
INSERT INTO district VALUES ('38', '35', 'السليمانية', null);
INSERT INTO district VALUES ('39', '35', 'السويدي', null);
INSERT INTO district VALUES ('40', '35', 'السويدي الغربي', null);
INSERT INTO district VALUES ('41', '35', 'الشرفية', null);
INSERT INTO district VALUES ('42', '35', 'الشفا', null);
INSERT INTO district VALUES ('43', '35', 'الشهداء', null);
INSERT INTO district VALUES ('44', '35', 'الصحافة', null);
INSERT INTO district VALUES ('45', '35', 'الصقورية', null);
INSERT INTO district VALUES ('46', '35', 'الضباط', null);
INSERT INTO district VALUES ('47', '35', 'العارض', null);
INSERT INTO district VALUES ('48', '35', 'العريجا', null);
INSERT INTO district VALUES ('49', '35', 'العريجاء', null);
INSERT INTO district VALUES ('50', '35', 'العريجاء الغربي', null);
INSERT INTO district VALUES ('51', '35', 'العريجاء الوسطى', null);
INSERT INTO district VALUES ('52', '35', 'العزيزية', null);
INSERT INTO district VALUES ('53', '35', 'العقيق', null);
INSERT INTO district VALUES ('54', '35', 'العليا', null);
INSERT INTO district VALUES ('55', '35', 'الغدير', null);
INSERT INTO district VALUES ('56', '35', 'الفاخرية', null);
INSERT INTO district VALUES ('57', '35', 'الفلاح', null);
INSERT INTO district VALUES ('58', '35', 'الفوطة', null);
INSERT INTO district VALUES ('59', '35', 'الفيحاء', null);
INSERT INTO district VALUES ('60', '35', 'الفيصلية', null);
INSERT INTO district VALUES ('61', '35', 'القادسية', null);
INSERT INTO district VALUES ('62', '35', 'القدس', null);
INSERT INTO district VALUES ('63', '35', 'القيروان', null);
INSERT INTO district VALUES ('64', '35', 'المؤتمرات', null);
INSERT INTO district VALUES ('65', '35', 'المحمدية', null);
INSERT INTO district VALUES ('66', '35', 'المربع', null);
INSERT INTO district VALUES ('67', '35', 'المرسلات', null);
INSERT INTO district VALUES ('68', '35', 'المروة', null);
INSERT INTO district VALUES ('69', '35', 'المروج', null);
INSERT INTO district VALUES ('70', '35', 'المصيف', null);
INSERT INTO district VALUES ('71', '35', 'المعذر', null);
INSERT INTO district VALUES ('72', '35', 'المعذر الشمالي', null);
INSERT INTO district VALUES ('73', '35', 'المعذر الغربي', null);
INSERT INTO district VALUES ('74', '35', 'المعيزلية', null);
INSERT INTO district VALUES ('75', '35', 'المعيزيلة', null);
INSERT INTO district VALUES ('76', '35', 'المغرزات', null);
INSERT INTO district VALUES ('77', '35', 'الملز', null);
INSERT INTO district VALUES ('78', '35', 'الملقا', null);
INSERT INTO district VALUES ('79', '35', 'الملك عبدالله', null);
INSERT INTO district VALUES ('80', '35', 'الملك فهد', null);
INSERT INTO district VALUES ('81', '35', 'الملك فيصل', null);
INSERT INTO district VALUES ('82', '35', 'المنار', null);
INSERT INTO district VALUES ('83', '35', 'المنصورة', null);
INSERT INTO district VALUES ('84', '35', 'الموسى', null);
INSERT INTO district VALUES ('85', '35', 'المونسية', null);
INSERT INTO district VALUES ('86', '35', 'الناصرية', null);
INSERT INTO district VALUES ('87', '35', 'النخيل', null);
INSERT INTO district VALUES ('88', '35', 'النخيل الشرقي', null);
INSERT INTO district VALUES ('89', '35', 'النخيل الغربي', null);
INSERT INTO district VALUES ('90', '35', 'الندوة', null);
INSERT INTO district VALUES ('91', '35', 'الندى', null);
INSERT INTO district VALUES ('92', '35', 'النرجس', null);
INSERT INTO district VALUES ('93', '35', 'النزهة', null);
INSERT INTO district VALUES ('94', '35', 'النسيج', null);
INSERT INTO district VALUES ('95', '35', 'النسيم', null);
INSERT INTO district VALUES ('96', '35', 'النسيم الشرقي', null);
INSERT INTO district VALUES ('97', '35', 'النسيم الغربي', null);
INSERT INTO district VALUES ('98', '35', 'النظيم', null);
INSERT INTO district VALUES ('99', '35', 'النفل', null);
INSERT INTO district VALUES ('100', '35', 'النموذجية', null);
INSERT INTO district VALUES ('101', '35', 'النهضة', null);
INSERT INTO district VALUES ('102', '35', 'الهدا', null);
INSERT INTO district VALUES ('103', '35', 'الواحة', null);
INSERT INTO district VALUES ('104', '35', 'الوادي', null);
INSERT INTO district VALUES ('105', '35', 'الورود', null);
INSERT INTO district VALUES ('106', '35', 'الوشام', null);
INSERT INTO district VALUES ('107', '35', 'الياسمين', null);
INSERT INTO district VALUES ('108', '35', 'اليرموك', null);
INSERT INTO district VALUES ('109', '35', 'اليمامة', null);
INSERT INTO district VALUES ('110', '35', 'ام الحمام', null);
INSERT INTO district VALUES ('111', '35', 'ام الحمام الشرقي', null);
INSERT INTO district VALUES ('112', '35', 'ام الحمام الغربي', null);
INSERT INTO district VALUES ('113', '35', 'بدر', null);
INSERT INTO district VALUES ('114', '35', 'بني عامر', null);
INSERT INTO district VALUES ('115', '35', 'تلال الوصيل', null);
INSERT INTO district VALUES ('116', '35', 'جبرة', null);
INSERT INTO district VALUES ('117', '35', 'جرير', null);
INSERT INTO district VALUES ('118', '35', 'حضار', null);
INSERT INTO district VALUES ('119', '35', 'حطين', null);
INSERT INTO district VALUES ('120', '35', 'حي الربيع', null);
INSERT INTO district VALUES ('121', '35', 'حي شبر1', null);
INSERT INTO district VALUES ('122', '35', 'حي لبن', null);
INSERT INTO district VALUES ('123', '35', 'زهرة البديعة', null);
INSERT INTO district VALUES ('124', '35', 'سلطانة', null);
INSERT INTO district VALUES ('125', '35', 'شبرا', null);
INSERT INTO district VALUES ('126', '35', 'شرق اشبيلية', null);
INSERT INTO district VALUES ('127', '35', 'صلاح الدين', null);
INSERT INTO district VALUES ('128', '35', 'طويق', null);
INSERT INTO district VALUES ('129', '35', 'ظهرة البديعة', null);
INSERT INTO district VALUES ('130', '35', 'ظهرة لبن', null);
INSERT INTO district VALUES ('131', '35', 'عتيقة', null);
INSERT INTO district VALUES ('132', '35', 'عرقة', null);
INSERT INTO district VALUES ('133', '35', 'عليشة', null);
INSERT INTO district VALUES ('134', '35', 'غرناطة', null);
INSERT INTO district VALUES ('135', '35', 'قرطبة', null);
INSERT INTO district VALUES ('136', '35', 'كلية العلوم والدراسات الانسانية برماح', null);
INSERT INTO district VALUES ('137', '35', 'لبن', null);
INSERT INTO district VALUES ('138', '35', 'مجمع تلال الوصيل', null);
INSERT INTO district VALUES ('139', '35', 'مخطط 46', null);
INSERT INTO district VALUES ('140', '35', 'مخطط 51', null);
INSERT INTO district VALUES ('141', '35', 'منفوحة', null);
INSERT INTO district VALUES ('142', '35', 'نمار', null);


-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `organization`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS organization;
CREATE SEQUENCE organization_seq;

CREATE TABLE organization (
  id int NOT NULL DEFAULT NEXTVAL ('organization_seq'),
  name varchar(150) DEFAULT NULL,
  slug varchar(150) NOT NULL,
  business_sector varchar(100) DEFAULT NULL,
  about text,
  address varchar(255) DEFAULT NULL,
  city_id int check (city_id > 0) DEFAULT NULL,
  district_id int check (district_id > 0) DEFAULT NULL,
  email varchar(100) DEFAULT NULL,
  phone varchar(20) DEFAULT NULL,
  mobile varchar(20) DEFAULT NULL,
  conatct_name varchar(100) DEFAULT NULL,
  contact_email varchar(100) DEFAULT NULL,
  contact_phone varchar(20) DEFAULT NULL,
  contact_position varchar(100) DEFAULT NULL,
  limit_account int DEFAULT NULL,
  first_image_base_url varchar(1024) DEFAULT NULL,
  first_image_path varchar(1024) DEFAULT NULL,
  second_image_base_url varchar(1024) DEFAULT NULL,
  second_image_path varchar(1024) DEFAULT NULL,
  created_at int DEFAULT NULL,
  updated_at int DEFAULT NULL,
  status smallint NOT NULL DEFAULT '1',
  allow_registration smallint DEFAULT '0',
  postalbox varchar(15) DEFAULT NULL,
  postalcode varchar(15) DEFAULT NULL,
  sso_login smallint DEFAULT '0' ,
  "authServerUrl" varchar(255) DEFAULT NULL,
  realm varchar(255) DEFAULT NULL,
  "clientId" varchar(255) DEFAULT NULL,
  "clientSecret" varchar(255) DEFAULT NULL,
  PRIMARY KEY (id)
 ,
  CONSTRAINT organization_ibfk_1 FOREIGN KEY (city_id) REFERENCES city (id) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT organization_ibfk_2 FOREIGN KEY (district_id) REFERENCES district (id) ON DELETE SET NULL ON UPDATE SET NULL
)  ;

ALTER SEQUENCE organization_seq RESTART WITH 2;

CREATE INDEX organization_city_id ON organization (city_id);
CREATE INDEX _organizationdistrict_id ON organization (district_id);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** zation
-- SQLINES DEMO *** -----------




-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `organization_structure`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS organization_structure;
CREATE SEQUENCE organization_structure_seq;

CREATE TABLE organization_structure (
  id int check (id > 0) NOT NULL DEFAULT NEXTVAL ('organization_structure_seq') ,
  root int DEFAULT NULL ,
  lft int NOT NULL ,
  rgt int NOT NULL ,
  lvl smallint NOT NULL ,
  name varchar(60) NOT NULL ,
  icon varchar(255) DEFAULT NULL ,
  icon_type smallint NOT NULL DEFAULT '1' ,
  active smallint NOT NULL DEFAULT '1' ,
  selected smallint NOT NULL DEFAULT '0' ,
  disabled smallint NOT NULL DEFAULT '0' ,
  readonly smallint NOT NULL DEFAULT '0' ,
  visible smallint NOT NULL DEFAULT '1' ,
  collapsed smallint NOT NULL DEFAULT '0' ,
  movable_u smallint NOT NULL DEFAULT '1' ,
  movable_d smallint NOT NULL DEFAULT '1' ,
  movable_l smallint NOT NULL DEFAULT '1' ,
  movable_r smallint NOT NULL DEFAULT '1' ,
  removable smallint NOT NULL DEFAULT '1' ,
  removable_all smallint NOT NULL DEFAULT '0' ,
  child_allowed smallint NOT NULL DEFAULT '1' ,
  organization_id int check (organization_id > 0) DEFAULT NULL,
  PRIMARY KEY (id)
)  ;

CREATE INDEX tbl_tree_NK1 ON organization_structure (root);
CREATE INDEX tbl_tree_NK2 ON organization_structure (lft);
CREATE INDEX tbl_tree_NK3 ON organization_structure (rgt);
CREATE INDEX tbl_tree_NK4 ON organization_structure (lvl);
CREATE INDEX tbl_tree_NK5 ON organization_structure (active);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** zation_structure
-- SQLINES DEMO *** -----------





-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `organization_theme`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS organization_theme;
CREATE TABLE organization_theme (
  organization_id int NOT NULL,
  "brandPrimColor" varchar(255) DEFAULT '',
  "brandSecColor" varchar(255) DEFAULT NULL,
  "brandHTextColor" varchar(255) DEFAULT NULL,
  "brandPTextColor" varchar(255) DEFAULT NULL,
  "brandBlackColor" varchar(255) DEFAULT NULL,
  "brandGrayColor" varchar(255) DEFAULT NULL,
  arfont varchar(255) DEFAULT NULL,
  enfont varchar(255) DEFAULT NULL,
  facebook varchar(255) DEFAULT NULL,
  twitter varchar(255) DEFAULT NULL,
  linkedin varchar(255) DEFAULT NULL,
  instagram varchar(255) DEFAULT NULL,
  locale varchar(255) NOT NULL DEFAULT 'ar_AR',
  updated_at varchar(255) DEFAULT NULL,
  PRIMARY KEY (organization_id),
  CONSTRAINT organization_theme_ibfk_1 FOREIGN KEY (organization_id) REFERENCES organization (id) ON DELETE CASCADE ON UPDATE CASCADE
) ;

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** zation_theme
-- SQLINES DEMO *** -----------






-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `pages`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS pages;
CREATE SEQUENCE pages_seq;

CREATE TABLE pages (
  id int NOT NULL DEFAULT NEXTVAL ('pages_seq'),
  organization_id int NOT NULL,
  name varchar(150) NOT NULL,
  link varchar(150) NOT NULL,
  created_at int DEFAULT NULL,
  updated_at int DEFAULT NULL,
  PRIMARY KEY (id)
 ,
  CONSTRAINT pages_ibfk_1 FOREIGN KEY (organization_id) REFERENCES organization (id) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE INDEX organization_id ON pages (organization_id);

-- SQLINES DEMO *** -----------
-- Records of pages
-- SQLINES DEMO *** -----------




-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `survey_selected_sectors`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS survey_selected_sectors;
CREATE SEQUENCE survey_selected_sectors_seq;

CREATE TABLE survey_selected_sectors (
  id int NOT NULL DEFAULT NEXTVAL ('survey_selected_sectors_seq'),
  survey_id int check (survey_id > 0) DEFAULT NULL,
  sector_id int check (sector_id > 0) DEFAULT NULL,
  PRIMARY KEY (id)
 ,
  CONSTRAINT fk_survey_selected_sectors_id FOREIGN KEY (sector_id) REFERENCES organization_structure (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_survey_selected_sectors_survey_id FOREIGN KEY (survey_id) REFERENCES survey (survey_id) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE INDEX fk_survey_selected_sectors_survey_id ON survey_selected_sectors (survey_id);
CREATE INDEX fk_survey_selected_sectors_sector_idx ON survey_selected_sectors (sector_id);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** _selected_sectors
-- SQLINES DEMO *** -----------






-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `survey_selected_users`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS survey_selected_users;
CREATE SEQUENCE survey_selected_users_seq;

CREATE TABLE survey_selected_users (
  id int NOT NULL DEFAULT NEXTVAL ('survey_selected_users_seq'),
  survey_id int check (survey_id > 0) DEFAULT NULL,
  user_id int DEFAULT NULL,
  PRIMARY KEY (id)
 ,
  CONSTRAINT fk_survey_selected_users_id FOREIGN KEY (user_id) REFERENCES nuser (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_survey_selected_users_survey_id FOREIGN KEY (survey_id) REFERENCES survey (survey_id) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE INDEX fk_survey_selected_users_survey_id ON survey_selected_users (survey_id);
CREATE INDEX fk_survey_selected_users_user_idx ON survey_selected_users (user_id);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** _selected_users
-- SQLINES DEMO *** -----------



-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `survey_stat`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS survey_stat;
CREATE SEQUENCE survey_stat_seq;

CREATE TABLE survey_stat (
  survey_stat_id int check (survey_stat_id > 0) NOT NULL DEFAULT NEXTVAL ('survey_stat_seq'),
  survey_stat_survey_id int check (survey_stat_survey_id > 0) DEFAULT NULL,
  survey_stat_user_id int DEFAULT NULL,
  survey_stat_assigned_at timestamp(0) NULL DEFAULT NULL,
  survey_stat_started_at timestamp(0) NULL DEFAULT NULL,
  survey_stat_updated_at timestamp(0) NULL DEFAULT NULL,
  survey_stat_ended_at timestamp(0) NULL DEFAULT NULL,
  survey_stat_session_start timestamp(0) NULL DEFAULT NULL,
  survey_stat_actual_time varchar(255) DEFAULT NULL,
  survey_stat_ip varchar(255) DEFAULT NULL,
  survey_stat_is_done smallint DEFAULT '0',
  survey_stat_hash char(32) DEFAULT NULL,
  "pageNo" int DEFAULT NULL,
  PRIMARY KEY (survey_stat_id),
  CONSTRAINT survey_stat_hash_UNIQUE UNIQUE  (survey_stat_hash)
 ,
  CONSTRAINT survey_stat_ibfk_1 FOREIGN KEY (survey_stat_survey_id) REFERENCES survey (survey_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT survey_stat_ibfk_2 FOREIGN KEY (survey_stat_user_id) REFERENCES nuser (id) ON DELETE CASCADE ON UPDATE CASCADE
)  ;

CREATE INDEX fk_sas_user_idx ON survey_stat (survey_stat_user_id);
CREATE INDEX fk_stat_to_survey_idx ON survey_stat (survey_stat_survey_id);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** _stat
-- SQLINES DEMO *** -----------


-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `tag`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS tag;
CREATE SEQUENCE tag_seq;

CREATE TABLE tag (
  id int NOT NULL DEFAULT NEXTVAL ('tag_seq'),
  name varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ;

-- SQLINES DEMO *** -----------
-- Records of tag
-- SQLINES DEMO *** -----------




-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `survey_tag`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS survey_tag;
CREATE SEQUENCE survey_tag_seq;

CREATE TABLE survey_tag (
  id int NOT NULL DEFAULT NEXTVAL ('survey_tag_seq'),
  survey_id int check (survey_id > 0) DEFAULT NULL,
  tag_id int DEFAULT NULL,
  ord int DEFAULT NULL,
  PRIMARY KEY (id)
 ,
  CONSTRAINT fk_survet_tag_survey FOREIGN KEY (survey_id) REFERENCES survey (survey_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_survey_tag_id FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE INDEX fk_survey_tag_survey_id ON survey_tag (survey_id);
CREATE INDEX fk_survey_tag_tag_idx ON survey_tag (tag_id);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** _tag
-- SQLINES DEMO *** -----------





-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `survey_user_answer`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS survey_user_answer;
CREATE SEQUENCE survey_user_answer_seq;

CREATE TABLE survey_user_answer (
  survey_user_answer_id int check (survey_user_answer_id > 0) NOT NULL DEFAULT NEXTVAL ('survey_user_answer_seq'),
  survey_user_answer_user_id int DEFAULT NULL,
  survey_user_answer_survey_id int check (survey_user_answer_survey_id > 0) DEFAULT NULL,
  survey_user_answer_question_id int check (survey_user_answer_question_id > 0) DEFAULT NULL,
  survey_user_answer_answer_id bigint check (survey_user_answer_answer_id > 0) DEFAULT NULL,
  survey_user_answer_value varchar(255) DEFAULT NULL,
  survey_user_answer_text text,
  survey_user_answer_file_type varchar(255) DEFAULT NULL,
  survey_user_answer_point varchar(255) DEFAULT '0',
  not_applicable smallint DEFAULT '0',
  PRIMARY KEY (survey_user_answer_id)
 ,
  CONSTRAINT survey_user_answer_ibfk_1 FOREIGN KEY (survey_user_answer_answer_id) REFERENCES survey_answer (survey_answer_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT survey_user_answer_ibfk_2 FOREIGN KEY (survey_user_answer_question_id) REFERENCES survey_question (survey_question_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT survey_user_answer_ibfk_3 FOREIGN KEY (survey_user_answer_survey_id) REFERENCES survey (survey_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT survey_user_answer_ibfk_4 FOREIGN KEY (survey_user_answer_user_id) REFERENCES nuser (id) ON DELETE SET NULL ON UPDATE SET NULL
)  ;

CREATE INDEX fk_survey_user_answer_answer_idx ON survey_user_answer (survey_user_answer_answer_id);
CREATE INDEX fk_survey_user_answer_user_idx ON survey_user_answer (survey_user_answer_user_id);
CREATE INDEX idx_answer_value ON survey_user_answer (survey_user_answer_answer_id,survey_user_answer_value);
CREATE INDEX idx_question_value ON survey_user_answer (survey_user_answer_question_id,survey_user_answer_value);
CREATE INDEX ff_idx ON survey_user_answer (survey_user_answer_survey_id);
CREATE INDEX fk_survey_user_answer_question_idx ON survey_user_answer (survey_user_answer_question_id);
CREATE INDEX idx_survey_user_answer_value ON survey_user_answer (survey_user_answer_value);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** _user_answer
-- SQLINES DEMO *** -----------





-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `survey_user_answer_attachments`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS survey_user_answer_attachments;
CREATE SEQUENCE survey_user_answer_attachments_seq;

CREATE TABLE survey_user_answer_attachments (
  survey_user_answer_attachments_id int check (survey_user_answer_attachments_id > 0) NOT NULL DEFAULT NEXTVAL ('survey_user_answer_attachments_seq'),
  survey_user_answer_attachments_user_id int DEFAULT NULL,
  survey_user_answer_attachments_survey_id int check (survey_user_answer_attachments_survey_id > 0) DEFAULT NULL,
  survey_user_answer_attachments_question_id int check (survey_user_answer_attachments_question_id > 0) DEFAULT NULL,
  name varchar(255) DEFAULT NULL,
  path varchar(255) NOT NULL,
  base_url varchar(255) DEFAULT NULL,
  type varchar(255) DEFAULT NULL,
  size int DEFAULT NULL,
  PRIMARY KEY (survey_user_answer_attachments_id)
 ,
  CONSTRAINT survey_user_answer_attachments_ibfk_1 FOREIGN KEY (survey_user_answer_attachments_question_id) REFERENCES survey_question (survey_question_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT survey_user_answer_attachments_ibfk_2 FOREIGN KEY (survey_user_answer_attachments_survey_id) REFERENCES survey (survey_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT survey_user_answer_attachments_ibfk_3 FOREIGN KEY (survey_user_answer_attachments_user_id) REFERENCES nuser (id) ON DELETE SET NULL ON UPDATE SET NULL
)  ;

CREATE INDEX fk_survey_user_answer_attachments_user_idx ON survey_user_answer_attachments (survey_user_answer_attachments_user_id);
CREATE INDEX answer_attachments_idx_question_value ON survey_user_answer_attachments (survey_user_answer_attachments_question_id);
CREATE INDEX answer_attachments_ff_idx ON survey_user_answer_attachments (survey_user_answer_attachments_survey_id);
CREATE INDEX fk_survey_user_answer_attachments_question_idx ON survey_user_answer_attachments (survey_user_answer_attachments_question_id);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** _user_answer_attachments
-- SQLINES DEMO *** -----------





-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `corrective_action_report`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS corrective_action_report;
CREATE SEQUENCE corrective_action_report_seq;

CREATE TABLE corrective_action_report (
  id int NOT NULL DEFAULT NEXTVAL ('corrective_action_report_seq'),
  org_id int DEFAULT NULL,
  user_id int DEFAULT NULL,
  survey_id int check (survey_id > 0) DEFAULT NULL,
  question_id int check (question_id > 0) DEFAULT NULL,
  answer_id bigint check (answer_id > 0) DEFAULT NULL,
  corrective_action varchar(255) DEFAULT NULL,
  corrective_action_date date DEFAULT NULL,
  status smallint DEFAULT '0',
  comment text,
  PRIMARY KEY (id)
 ,
  CONSTRAINT corrective_action_report_ibfk_1 FOREIGN KEY (answer_id) REFERENCES survey_answer (survey_answer_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT corrective_action_report_ibfk_2 FOREIGN KEY (org_id) REFERENCES organization (id) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT corrective_action_report_ibfk_3 FOREIGN KEY (question_id) REFERENCES survey_question (survey_question_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT corrective_action_report_ibfk_4 FOREIGN KEY (survey_id) REFERENCES survey (survey_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT corrective_action_report_ibfk_5 FOREIGN KEY (user_id) REFERENCES nuser (id) ON DELETE SET NULL ON UPDATE SET NULL
) ;

CREATE INDEX fk_org_id_idx ON corrective_action_report (org_id);
CREATE INDEX fk_user_idx ON corrective_action_report (user_id);
CREATE INDEX ffsurvey_id_idx ON corrective_action_report (survey_id);
CREATE INDEX fk_question_idx ON corrective_action_report (question_id);
CREATE INDEX fk_answer_idx ON corrective_action_report (answer_id);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** tive_action_report
-- SQLINES DEMO *** -----------





-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `file_storage_item`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS file_storage_item;
CREATE SEQUENCE file_storage_item_seq;

CREATE TABLE file_storage_item (
  id int NOT NULL DEFAULT NEXTVAL ('file_storage_item_seq'),
  component varchar(255) NOT NULL,
  base_url varchar(1024) NOT NULL,
  path varchar(1024) NOT NULL,
  type varchar(255) DEFAULT NULL,
  size int DEFAULT NULL,
  name varchar(255) DEFAULT NULL,
  upload_ip varchar(15) DEFAULT NULL,
  created_at int NOT NULL,
  PRIMARY KEY (id)
) ;

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** torage_item
-- SQLINES DEMO *** -----------





-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `footer_links`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS footer_links;
CREATE SEQUENCE footer_links_seq;

CREATE TABLE footer_links (
  id int NOT NULL DEFAULT NEXTVAL ('footer_links_seq'),
  organization_id int DEFAULT NULL,
  name_link1 varchar(150) DEFAULT NULL,
  link1 varchar(150) DEFAULT NULL,
  name_link2 varchar(150) DEFAULT NULL,
  link2 varchar(150) DEFAULT NULL,
  name_link3 varchar(150) DEFAULT NULL,
  link3 varchar(150) DEFAULT NULL,
  name_link4 varchar(150) DEFAULT NULL,
  link4 varchar(150) DEFAULT NULL,
  name_link5 varchar(150) DEFAULT NULL,
  link5 varchar(150) DEFAULT NULL,
  created_at int DEFAULT NULL,
  updated_at int DEFAULT NULL,
  PRIMARY KEY (id)
 ,
  CONSTRAINT footer_links_ibfk_1 FOREIGN KEY (organization_id) REFERENCES organization (id) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE INDEX footer_links_organization_id ON footer_links (organization_id);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** _links
-- SQLINES DEMO *** -----------




-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `key_storage_item`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS key_storage_item;
CREATE TABLE key_storage_item (
  key varchar(128) NOT NULL,
  value text NOT NULL,
  comment text,
  updated_at int DEFAULT NULL,
  created_at int DEFAULT NULL,
  PRIMARY KEY (key),
  CONSTRAINT idx_key_storage_item_key UNIQUE  (key)
) ;

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** orage_item
-- SQLINES DEMO *** -----------
INSERT INTO key_storage_item VALUES ('backend.layout-boxed', '0', null, null, null);
INSERT INTO key_storage_item VALUES ('backend.layout-collapsed-sidebar', '0', null, null, null);
INSERT INTO key_storage_item VALUES ('backend.layout-fixed', '0', null, null, null);
INSERT INTO key_storage_item VALUES ('backend.theme-skin', 'skin-blue', 'skin-blue, skin-black, skin-purple, skin-green, skin-red, skin-yellow', null, null);
INSERT INTO key_storage_item VALUES ('frontend.maintenance', 'disabled', 'Set it to "enabled" to turn on maintenance mode', null, null);


-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `rbac_auth_rule`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS rbac_auth_rule;
CREATE TABLE rbac_auth_rule (
  name varchar(64) NOT NULL,
  data bytea,
  created_at int DEFAULT NULL,
  updated_at int DEFAULT NULL,
  PRIMARY KEY (name)
)  ;

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** uth_rule
-- SQLINES DEMO *** -----------
INSERT INTO rbac_auth_rule VALUES ('ownModelRule', '0x4F3A32393A22636F6D6D6F6E5C726261635C72756C655C4F776E4D6F64656C52756C65223A333A7B733A343A226E616D65223B733A31323A226F776E4D6F64656C52756C65223B733A393A22637265617465644174223B693A313535323338353530353B733A393A22757064617465644174223B693A313535323338353530353B7D', '1552385505', '1552385505');




-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `session`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS session;
CREATE TABLE session (
  id char(40) NOT NULL,
  expire int DEFAULT NULL,
  data bytea,
  PRIMARY KEY (id)
) ;




-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `system_db_migration`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS system_db_migration;
CREATE TABLE system_db_migration (
  version varchar(180) NOT NULL,
  apply_time int DEFAULT NULL,
  PRIMARY KEY (version)
) ;

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** _db_migration
-- SQLINES DEMO *** -----------
INSERT INTO system_db_migration VALUES ('m150725_192740_seed_data', '1611733146');
INSERT INTO system_db_migration VALUES ('m200212_103537_editSurvey', '1611733146');
INSERT INTO system_db_migration VALUES ('m200302_090808_ssologin_add_columns_to_organization_table', '1611733146');
INSERT INTO system_db_migration VALUES ('m200303_072213_temporary_token_user_profile', '1611733146');
INSERT INTO system_db_migration VALUES ('m200428_103138_SessionTBL', '1611733146');


-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `system_log`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS system_log;
CREATE SEQUENCE system_log_seq;

CREATE TABLE system_log (
  id bigint NOT NULL DEFAULT NEXTVAL ('system_log_seq'),
  level int DEFAULT NULL,
  category varchar(255) DEFAULT NULL,
  log_time double precision DEFAULT NULL,
  prefix text,
  message text,
  PRIMARY KEY (id)
)   ;

ALTER SEQUENCE system_log_seq RESTART WITH 8;

CREATE INDEX idx_log_level ON system_log (level);
CREATE INDEX idx_log_category ON system_log (category);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** _log
-- SQLINES DEMO *** -----------


-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `system_rbac_migration`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS system_rbac_migration;
CREATE TABLE system_rbac_migration (
  version varchar(180) NOT NULL,
  apply_time int DEFAULT NULL,
  PRIMARY KEY (version)
) ;




-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `timeline_event`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS timeline_event;
CREATE SEQUENCE timeline_event_seq;

CREATE TABLE timeline_event (
  id int NOT NULL DEFAULT NEXTVAL ('timeline_event_seq'),
  application varchar(64) NOT NULL,
  category varchar(64) NOT NULL,
  event varchar(64) NOT NULL,
  data text,
  created_at int NOT NULL,
  PRIMARY KEY (id)
)  ;

ALTER SEQUENCE timeline_event_seq RESTART WITH 45;

CREATE INDEX idx_created_at ON timeline_event (created_at);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** ne_event
-- SQLINES DEMO *** -----------
INSERT INTO timeline_event VALUES ('41', 'backend', 'user', 'signup', '{"public_identity":"test@test.com","user_id":4,"created_at":1580303660}', '1580303660');
INSERT INTO timeline_event VALUES ('42', 'backend', 'user', 'signup', '{"public_identity":"mu.ahmed-c@tamkeentech.com","user_id":5,"created_at":1580306638}', '1580306638');
INSERT INTO timeline_event VALUES ('43', 'backend', 'user', 'signup', '{"public_identity":"mu.ahmed-c@tamkeentech.com","user_id":6,"created_at":1580369981}', '1580369981');
INSERT INTO timeline_event VALUES ('44', 'backend', 'user', 'signup', '{"public_identity":"mu.ahmed-c@tamkeentech.sa","user_id":7,"created_at":1580371690}', '1580371690');




-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `translations_with_string`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS translations_with_string;
CREATE SEQUENCE translations_with_string_seq;

CREATE TABLE translations_with_string (
  id int NOT NULL DEFAULT NEXTVAL ('translations_with_string_seq'),
  table_name varchar(100) NOT NULL,
  model_id int NOT NULL,
  attribute varchar(100) NOT NULL,
  lang varchar(6) NOT NULL,
  value varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ;

CREATE INDEX attribute ON translations_with_string (attribute);
CREATE INDEX table_name ON translations_with_string (table_name);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** ations_with_string
-- SQLINES DEMO *** -----------





-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `translations_with_text`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS translations_with_text;
CREATE SEQUENCE translations_with_text_seq;

CREATE TABLE translations_with_text (
  id int NOT NULL DEFAULT NEXTVAL ('translations_with_text_seq'),
  table_name varchar(100) NOT NULL,
  model_id int NOT NULL,
  attribute varchar(100) NOT NULL,
  lang varchar(6) NOT NULL,
  value text NOT NULL,
  PRIMARY KEY (id)
) ;

CREATE INDEX translations_with_text_attribute ON translations_with_text (attribute);
CREATE INDEX translations_with_text_table_name ON translations_with_text (table_name);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** ations_with_text
-- SQLINES DEMO *** -----------




-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `user_profile`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS user_profile;
CREATE SEQUENCE user_profile_seq;

CREATE TABLE user_profile (
  user_id int NOT NULL DEFAULT NEXTVAL ('user_profile_seq'),
  firstname varchar(255) DEFAULT NULL,
  middlename varchar(255) DEFAULT NULL,
  lastname varchar(255) DEFAULT NULL,
  avatar_path varchar(255) DEFAULT NULL,
  avatar_base_url varchar(255) DEFAULT NULL,
  locale varchar(32) NOT NULL,
  activity varchar(100) DEFAULT NULL,
  job varchar(100) DEFAULT NULL,
  specialization_id int  NOT NULL DEFAULT '0',
  nationality_id int  NOT NULL DEFAULT '0',
  draft smallint NOT NULL DEFAULT '0',
  gender smallint DEFAULT NULL,
  school_id int DEFAULT NULL,
  mobile varchar(15) DEFAULT NULL,
  device_token varchar(200) DEFAULT NULL,
  active smallint DEFAULT '0',
  organization_id int check (organization_id > 0) DEFAULT NULL,
  sector_id int NOT NULL,
  position varchar(100) DEFAULT NULL,
  city_id int check (city_id > 0) DEFAULT NULL,
  district_id int check (district_id > 0) DEFAULT NULL,
  address varchar(100) DEFAULT NULL,
  bio text,
  main_admin smallint DEFAULT '0',
  temporary_token_used smallint DEFAULT '0' ,
  temporary_token varchar(255) DEFAULT NULL,
  PRIMARY KEY (user_id),
  CONSTRAINT user_profile_ibfk_1 FOREIGN KEY (user_id) REFERENCES nuser (id) ON DELETE CASCADE ON UPDATE CASCADE
)  ;

ALTER SEQUENCE user_profile_seq RESTART WITH 5;

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** rofile
-- SQLINES DEMO *** -----------
INSERT INTO user_profile VALUES ('1', 'John', null, 'Doe', null, null, 'ar-AR', null, null, '0', '0', '0', null, null, null, null, '0', null, '0', null, null, null, null, null, '0', '0', null);
INSERT INTO user_profile VALUES ('2', 'المدير العام', '', '', null, null, 'ar-AR', null, null, '0', '0', '0', '1', null, '0594949779', null, '0', null, '0', null, null, null, null, null, '0', '0', null);
INSERT INTO user_profile VALUES ('4', 'Tamkeen', null, 'Superadmin', null, null, 'ar-AR', null, null, '0', '0', '0', null, null, null, null, '0', null, '0', null, null, null, null, null, '0', '0', null);




-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `user_tag`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS user_tag;
CREATE SEQUENCE user_tag_seq;

CREATE TABLE user_tag (
  id int NOT NULL DEFAULT NEXTVAL ('user_tag_seq'),
  user_id int DEFAULT NULL,
  tag_id int DEFAULT NULL,
  ord int DEFAULT NULL,
  PRIMARY KEY (id)
 ,
  CONSTRAINT fk_tag_id FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_tag_user FOREIGN KEY (user_id) REFERENCES nuser (id) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE INDEX user_tag_fk_user_idx ON user_tag (user_id);
CREATE INDEX user_tag_fk_tag_idx ON user_tag (tag_id);

-- SQLINES DEMO *** -----------
-- Records of user_tag
-- SQLINES DEMO *** -----------




-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `user_token`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS user_token;
CREATE SEQUENCE user_token_seq;

CREATE TABLE user_token (
  id int NOT NULL DEFAULT NEXTVAL ('user_token_seq'),
  user_id int DEFAULT NULL,
  type varchar(255) NOT NULL,
  token varchar(40) NOT NULL,
  expire_at int DEFAULT NULL,
  created_at int DEFAULT NULL,
  updated_at int DEFAULT NULL,
  PRIMARY KEY (id)
) ;

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** oken
-- SQLINES DEMO *** -----------





-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `rbac_auth_item`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS rbac_auth_item;
CREATE TABLE rbac_auth_item (
  name varchar(64) NOT NULL,
  type smallint NOT NULL,
  description text,
  rule_name varchar(64) DEFAULT NULL,
  data bytea,
  created_at int DEFAULT NULL,
  updated_at int DEFAULT NULL,
  PRIMARY KEY (name)
 ,
  CONSTRAINT rbac_auth_item_ibfk_1 FOREIGN KEY (rule_name) REFERENCES rbac_auth_rule (name) ON DELETE SET NULL ON UPDATE CASCADE
)  ;

CREATE INDEX rule_name ON rbac_auth_item (rule_name);
CREATE INDEX idx_auth_item_type ON rbac_auth_item (type);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** uth_item
-- SQLINES DEMO *** -----------
INSERT INTO rbac_auth_item VALUES ('administrator', '1', 'مدير عام', null, null, '1552385505', '1552385505');
INSERT INTO rbac_auth_item VALUES ('editOwnModel', '2', null, 'ownModelRule', null, '1552385505', '1552385505');
INSERT INTO rbac_auth_item VALUES ('governmentAdmin', '1', null, null, null, null, null);
INSERT INTO rbac_auth_item VALUES ('governmentRep', '1', null, null, null, null, null);
INSERT INTO rbac_auth_item VALUES ('loginToBackend', '2', null, null, null, '1552385505', '1552385505');
INSERT INTO rbac_auth_item VALUES ('loginToOrganization', '2', null, null, null, null, null);
INSERT INTO rbac_auth_item VALUES ('manager', '1', 'مدير ', null, null, '1552385505', '1552385505');
INSERT INTO rbac_auth_item VALUES ('user', '1', null, null, null, '1552385505', '1552385505');




-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `rbac_auth_assignment`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS rbac_auth_assignment;
CREATE TABLE rbac_auth_assignment (
  item_name varchar(64) NOT NULL,
  user_id varchar(64) NOT NULL,
  created_at int DEFAULT NULL,
  PRIMARY KEY (item_name,user_id),
  CONSTRAINT rbac_auth_assignment_ibfk_1 FOREIGN KEY (item_name) REFERENCES rbac_auth_item (name) ON DELETE CASCADE ON UPDATE CASCADE
)  ;

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** uth_assignment
-- SQLINES DEMO *** -----------
INSERT INTO rbac_auth_assignment VALUES ('administrator', '1', '1552385505');
INSERT INTO rbac_auth_assignment VALUES ('administrator', '4', '1552385505');
INSERT INTO rbac_auth_assignment VALUES ('manager', '2', '1580369390');
INSERT INTO rbac_auth_assignment VALUES ('user', '3', '1552385505');




-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `rbac_auth_item_child`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS rbac_auth_item_child;
CREATE TABLE rbac_auth_item_child (
  parent varchar(64) NOT NULL,
  child varchar(64) NOT NULL,
  PRIMARY KEY (parent,child)
 ,
  CONSTRAINT rbac_auth_item_child_ibfk_1 FOREIGN KEY (parent) REFERENCES rbac_auth_item (name) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT rbac_auth_item_child_ibfk_2 FOREIGN KEY (child) REFERENCES rbac_auth_item (name) ON DELETE CASCADE ON UPDATE CASCADE
)  ;

CREATE INDEX child ON rbac_auth_item_child (child);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** uth_item_child
-- SQLINES DEMO *** -----------
INSERT INTO rbac_auth_item_child VALUES ('user', 'editOwnModel');
INSERT INTO rbac_auth_item_child VALUES ('administrator', 'loginToBackend');
INSERT INTO rbac_auth_item_child VALUES ('manager', 'loginToBackend');
INSERT INTO rbac_auth_item_child VALUES ('governmentAdmin', 'loginToOrganization');
INSERT INTO rbac_auth_item_child VALUES ('governmentRep', 'loginToOrganization');
INSERT INTO rbac_auth_item_child VALUES ('administrator', 'manager');
INSERT INTO rbac_auth_item_child VALUES ('administrator', 'user');
INSERT INTO rbac_auth_item_child VALUES ('manager', 'user');




-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** _rbac_migration
-- SQLINES DEMO *** -----------
INSERT INTO system_rbac_migration VALUES ('m000000_000000_base', '1552385503');
INSERT INTO system_rbac_migration VALUES ('m150625_214101_roles', '1552385505');
INSERT INTO system_rbac_migration VALUES ('m150625_215624_init_permissions', '1552385505');
INSERT INTO system_rbac_migration VALUES ('m151223_074604_edit_own_model', '1552385505');





-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `user_attachment`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS user_attachment;
CREATE SEQUENCE user_attachment_seq;

CREATE TABLE user_attachment (
  id int NOT NULL DEFAULT NEXTVAL ('user_attachment_seq'),
  user_id int NOT NULL,
  path varchar(255) NOT NULL,
  base_url varchar(255) DEFAULT NULL,
  type varchar(255) DEFAULT NULL,
  size int DEFAULT NULL,
  name varchar(255) DEFAULT NULL,
  created_at int DEFAULT NULL,
  "order" int DEFAULT NULL,
  meta varchar(255) DEFAULT NULL,
  PRIMARY KEY (id)
 ,
  CONSTRAINT user_attachment_ibfk_1 FOREIGN KEY (user_id) REFERENCES nuser (id) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE INDEX fk_user_attachment ON user_attachment (user_id);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** ttachment
-- SQLINES DEMO *** -----------




-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `media`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS media;
CREATE SEQUENCE media_seq;

CREATE TABLE media (
  id int NOT NULL DEFAULT NEXTVAL ('media_seq'),
  path varchar(255) NOT NULL,
  base_url varchar(255) DEFAULT NULL,
  type varchar(255) DEFAULT NULL,
  size int DEFAULT NULL,
  name varchar(255) DEFAULT NULL,
  created_at int DEFAULT NULL,
  user_id int NOT NULL,
  "order" int DEFAULT NULL,
  meta varchar(255) DEFAULT NULL,
  deleted_by varchar(255) DEFAULT NULL,
  PRIMARY KEY (id)
) ;

-- SQLINES DEMO *** -----------
-- Records of media
-- SQLINES DEMO *** -----------




-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `survey_degree_level`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS survey_degree_level;
CREATE SEQUENCE survey_degree_level_seq;

CREATE TABLE survey_degree_level (
  survey_degree_level_id int NOT NULL DEFAULT NEXTVAL ('survey_degree_level_seq'),
  survey_degree_level_survey_id int check (survey_degree_level_survey_id > 0) DEFAULT NULL,
  title varchar(255) DEFAULT NULL,
  "from" int DEFAULT NULL,
  "to" int DEFAULT NULL,
  PRIMARY KEY (survey_degree_level_id)
 ,
  CONSTRAINT survey_degree_level_ibfk_1 FOREIGN KEY (survey_degree_level_survey_id) REFERENCES survey (survey_id) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE INDEX fk_survey_degree_level_survey_idx ON survey_degree_level (survey_degree_level_survey_id);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** _degree_level
-- SQLINES DEMO *** -----------





-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** or `notification`
-- SQLINES DEMO *** -----------
DROP TABLE IF EXISTS notification;
CREATE SEQUENCE notification_seq;

CREATE TABLE notification (
  id int NOT NULL DEFAULT NEXTVAL ('notification_seq'),
  "from" int DEFAULT NULL,
  user_id int NOT NULL,
  module varchar(255) DEFAULT NULL,
  module_id int DEFAULT NULL,
  message varchar(500) NOT NULL,
  title varchar(255) DEFAULT NULL,
  status smallint DEFAULT NULL,
  created_at timestamp(0) DEFAULT NULL,
  updated_at timestamp(0) DEFAULT NULL,
  PRIMARY KEY (id)
 ,
  CONSTRAINT notification_ibfk_1 FOREIGN KEY (user_id) REFERENCES nuser (id) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE INDEX fromField ON notification ("from");
CREATE INDEX UserField ON notification (user_id);

-- SQLINES DEMO *** -----------
-- SQLINES DEMO *** cation
-- SQLINES DEMO *** -----------
