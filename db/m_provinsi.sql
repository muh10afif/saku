/*
 Navicat Premium Data Transfer

 Source Server         : skd
 Source Server Type    : PostgreSQL
 Source Server Version : 110003
 Source Host           : localhost:5432
 Source Catalog        : lbs_upload
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 110003
 File Encoding         : 65001

 Date: 17/05/2021 18:13:33
*/


CREATE SEQUENCE provinsi_id_sequence;
-- ----------------------------
-- Table structure for m_provinsi
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_provinsi";
CREATE TABLE "public"."m_provinsi" (
  "id_provinsi" int8 NOT NULL DEFAULT nextval('"provinsi_id_sequence"'::regclass),
  "provinsi" varchar(255) COLLATE "pg_catalog"."default",
  "id_negara" int8,
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Records of m_provinsi
-- ----------------------------
INSERT INTO "public"."m_provinsi" VALUES (11, 'Aceh', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (12, 'Sumatera Utara', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (13, 'Sumatera Barat', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (14, 'Riau', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (15, 'Jambi', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (16, 'Sumatera Selatan', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (17, 'Bengkulu', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (18, 'Lampung', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (19, 'Kepulauan Bangka Belitung', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (21, 'Kepulauan Riau', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (31, 'Dki Jakarta', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (32, 'Jawa Barat', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (33, 'Jawa Tengah', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (34, 'Di Yogyakarta', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (35, 'Jawa Timur', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (36, 'Banten', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (51, 'Bali', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (52, 'Nusa Tenggara Barat', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (53, 'Nusa Tenggara Timur', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (61, 'Kalimantan Barat', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (62, 'Kalimantan Tengah', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (63, 'Kalimantan Selatan', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (64, 'Kalimantan Timur', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (65, 'Kalimantan Utara', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (71, 'Sulawesi Utara', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (72, 'Sulawesi Tengah', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (73, 'Sulawesi Selatan', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (74, 'Sulawesi Tenggara', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (75, 'Gorontalo', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (76, 'Sulawesi Barat', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (81, 'Maluku', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (82, 'Maluku Utara', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (91, 'Papua Barat', 2, '2021-05-17 17:31:42', NULL);
INSERT INTO "public"."m_provinsi" VALUES (94, 'Papua', 2, '2021-05-17 17:31:42', NULL);

-- ----------------------------
-- Primary Key structure for table m_provinsi
-- ----------------------------
ALTER TABLE "public"."m_provinsi" ADD CONSTRAINT "m_provinsi_pkey" PRIMARY KEY ("id_provinsi");
