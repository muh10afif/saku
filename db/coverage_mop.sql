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

 Date: 21/05/2021 13:32:12
*/


-- ----------------------------
-- Table structure for coverage_mop
-- ----------------------------
CREATE SEQUENCE coverage_mop_id_sequence;
DROP TABLE IF EXISTS "public"."coverage_mop";
CREATE TABLE "public"."coverage_mop" (
  "id_coverage_mop" int8 NOT NULL DEFAULT nextval('"coverage_mop_id_sequence"'::regclass),
  "label" varchar(255) COLLATE "pg_catalog"."default",
  "rate" varchar(255) COLLATE "pg_catalog"."default",
  "status" varchar(255) COLLATE "pg_catalog"."default",
  "add_by" int8,
  "add_time" timestamp(6) DEFAULT CURRENT_TIMESTAMP,
  "id_lob" int8,
  "id_mop" int8
)
;
