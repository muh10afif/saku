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

 Date: 24/05/2021 16:34:12
*/


-- ----------------------------
-- Table structure for m_jenis_bank
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_jenis_bank";
CREATE TABLE "public"."m_jenis_bank" (
  "id_jenis_bank" int8 NOT NULL DEFAULT nextval('jenis_bank_id_sequence'::regclass),
  "kode_jenis_bank" varchar(255) COLLATE "pg_catalog"."default",
  "jenis_bank" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;
