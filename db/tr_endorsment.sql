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

 Date: 20/05/2021 14:48:11
*/


-- ----------------------------
-- Table structure for tr_endorsment
-- ----------------------------
CREATE SEQUENCE tr_endorsment_id_sequence;
DROP TABLE IF EXISTS "public"."tr_endorsment";
CREATE TABLE "public"."tr_endorsment" (
  "id_tr_endorsment" int8 NOT NULL DEFAULT nextval('tr_endorsment_id_sequence'::regclass),
  "id_sppa_quotation" int8,
  "id_endorsment" int8,
  "add_by" int8,
  "add_time" timestamp(0) DEFAULT CURRENT_TIMESTAMP
)
;
