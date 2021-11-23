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

 Date: 28/06/2021 17:22:27
*/


-- ----------------------------
-- Table structure for pengguna_tertanggung
-- ----------------------------
create sequence pengguna_tertanggung_sequence;
DROP TABLE IF EXISTS "public"."pengguna_tertanggung";
CREATE TABLE "public"."pengguna_tertanggung" (
  "id_pengguna_tertanggung" int8 NOT NULL DEFAULT nextval('pengguna_tertanggung_sequence'::regclass),
  "add_by" int8,
  "add_time" timestamp(0) DEFAULT CURRENT_TIMESTAMP,
  "alamat" text COLLATE "pg_catalog"."default",
  "telp" varchar COLLATE "pg_catalog"."default",
  "nama" varchar COLLATE "pg_catalog"."default",
  "tanggal_lahir" date,
  "jenis_asuransi" varchar COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Primary Key structure for table pengguna_tertanggung
-- ----------------------------
ALTER TABLE "public"."pengguna_tertanggung" ADD CONSTRAINT "pengguna_tertanggung_pkey" PRIMARY KEY ("id_pengguna_tertanggung");
