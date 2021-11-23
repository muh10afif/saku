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

 Date: 15/06/2021 09:29:52
*/


-- ----------------------------
-- Table structure for dokumen_mop
-- ----------------------------
DROP TABLE IF EXISTS "public"."dokumen_mop";
create sequence dokumen_mop_id_sequence;
CREATE TABLE "public"."dokumen_mop" (
  "id_dokumen_mop" int8 NOT NULL DEFAULT nextval('"dokumen_mop_id_sequence"'::regclass),
  "filename" varchar(255) COLLATE "pg_catalog"."default",
  "description" varchar(255) COLLATE "pg_catalog"."default",
  "size" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8,
  "id_mop" int8
)
;

-- ----------------------------
-- Primary Key structure for table dokumen_mop
-- ----------------------------
ALTER TABLE "public"."dokumen_mop" ADD CONSTRAINT "dokumen_sppa_copy1_pkey" PRIMARY KEY ("id_dokumen_mop");
