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

 Date: 19/05/2021 10:08:59
*/


-- ----------------------------
-- Table structure for mop
-- ----------------------------
DROP TABLE IF EXISTS "public"."mop";
CREATE TABLE "public"."mop" (
  "id_mop" int8 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
),
  "no_reff_mop" varchar(255) COLLATE "pg_catalog"."default",
  "no_mop" varchar(255) COLLATE "pg_catalog"."default",
  "id_insured" int8,
  "id_insurer" int8,
  "objek_tertanggung" text COLLATE "pg_catalog"."default",
  "id_lob" int8,
  "nilai_pertanggungan" float8,
  "kondisi_pertanggungan" text COLLATE "pg_catalog"."default",
  "pengecualian" text COLLATE "pg_catalog"."default",
  "keterangan_premi" text COLLATE "pg_catalog"."default",
  "resiko_sendiri" float8,
  "limit_minimal" float8,
  "berlaku_paling_lambat" varchar COLLATE "pg_catalog"."default",
  "batas_wilayah" varchar(255) COLLATE "pg_catalog"."default",
  "penyampaian_deklarasi" text COLLATE "pg_catalog"."default",
  "maksimal_pelaporan" varchar(100) COLLATE "pg_catalog"."default",
  "add_by" int8,
  "add_time" timestamp(0) DEFAULT CURRENT_TIMESTAMP,
  "id_cob" int8
)
;
