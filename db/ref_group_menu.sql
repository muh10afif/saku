/*
 Navicat Premium Data Transfer

 Source Server         : skdigital.id
 Source Server Type    : PostgreSQL
 Source Server Version : 100013
 Source Host           : localhost:5432
 Source Catalog        : lbs
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 100013
 File Encoding         : 65001

 Date: 19/05/2021 18:20:04
*/


-- ----------------------------
-- Table structure for ref_group_menu
-- ----------------------------
DROP TABLE IF EXISTS "public"."ref_group_menu";
CREATE TABLE "public"."ref_group_menu" (
  "id" int8 NOT NULL DEFAULT nextval('"group_menu_ID_sequence"'::regclass),
  "id_jabatan" int8,
  "id_menu" int8,
  "role" varchar(10) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of ref_group_menu
-- ----------------------------
INSERT INTO "public"."ref_group_menu" VALUES (63, 1, 138, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (62, 1, 171, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (61, 1, 170, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (60, 1, 169, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (59, 1, 168, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (58, 1, 167, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (57, 1, 166, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (56, 1, 165, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (55, 1, 164, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (54, 1, 163, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (53, 1, 162, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (52, 1, 161, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (51, 1, 137, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (50, 1, 186, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (49, 1, 185, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (48, 1, 184, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (47, 1, 183, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (46, 1, 182, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (45, 1, 160, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (44, 1, 181, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (43, 1, 180, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (42, 1, 159, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (41, 1, 179, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (40, 1, 178, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (39, 1, 177, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (38, 1, 176, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (37, 1, 190, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (36, 1, 158, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (35, 1, 140, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (34, 1, 174, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (33, 1, 173, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (32, 1, 172, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (31, 1, 155, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (30, 1, 196, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (29, 1, 157, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (28, 1, 156, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (27, 1, 192, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (26, 1, 147, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (25, 1, 150, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (24, 1, 199, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (23, 1, 149, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (22, 1, 198, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (21, 1, 148, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (20, 1, 154, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (19, 1, 153, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (18, 1, 152, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (17, 1, 151, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (16, 1, 146, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (15, 1, 189, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (14, 1, 188, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (13, 1, 145, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (12, 1, 136, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (11, 1, 187, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (10, 1, 197, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (9, 1, 195, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (8, 1, 193, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (7, 1, 175, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (6, 1, 144, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (5, 1, 143, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (4, 1, 139, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (3, 1, 135, 'CRUD');
INSERT INTO "public"."ref_group_menu" VALUES (2, 1, 139, '');
INSERT INTO "public"."ref_group_menu" VALUES (1, 1, 135, '');

-- ----------------------------
-- Primary Key structure for table ref_group_menu
-- ----------------------------
ALTER TABLE "public"."ref_group_menu" ADD CONSTRAINT "ref_group_menu_pk" PRIMARY KEY ("id");
