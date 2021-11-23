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

 Date: 08/06/2021 19:28:47
*/


-- ----------------------------
-- Table structure for m_parent_parameter
-- ----------------------------
CREATE SEQUENCE parent_parameter_sequence;
DROP TABLE IF EXISTS "public"."m_parent_parameter";
CREATE TABLE "public"."m_parent_parameter" (
  "id_parent_parameter" int8 NOT NULL DEFAULT nextval('parent_parameter_sequence'::regclass),
  "parent_parameter" varchar(255) COLLATE "pg_catalog"."default",
  "bobot" float8,
  "add_by" int8,
  "add_time" timestamp(0) DEFAULT CURRENT_TIMESTAMP
)
;

-- ----------------------------
-- Primary Key structure for table m_parent_parameter
-- ----------------------------
ALTER TABLE "public"."m_parent_parameter" ADD CONSTRAINT "m_parent_parameter_pkey" PRIMARY KEY ("id_parent_parameter");
