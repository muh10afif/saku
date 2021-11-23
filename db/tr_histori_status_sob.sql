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

 Date: 17/05/2021 11:30:08
*/


-- ----------------------------
-- Table structure for tr_histori_status_sob
-- ----------------------------
DROP TABLE IF EXISTS "public"."tr_histori_status_sob";
CREATE TABLE "public"."tr_histori_status_sob" (
  "id_histori_status_sob" int8 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
),
  "id_sob" int8,
  "tanggal_perubahan" date,
  "id_sppa_quotation" int8,
  "add_time" timestamp(0) DEFAULT CURRENT_TIMESTAMP,
  "add_by" int8,
  "nama_sob" varchar(255) COLLATE "pg_catalog"."default"
)
;
