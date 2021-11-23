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

 Date: 19/05/2021 10:08:24
*/


-- ----------------------------
-- Table structure for tr_sppa_quotation
-- ----------------------------
CREATE SEQUENCE sppa_quotation_id_sequence;
DROP TABLE IF EXISTS "public"."tr_sppa_quotation";
CREATE TABLE "public"."tr_sppa_quotation" (
  "id_sppa_quotation" int8 NOT NULL DEFAULT nextval('"sppa_quotation_id_sequence"'::regclass),
  "id_sob" int8,
  "id_tipe_kontrak" int8,
  "name_of_information" varchar(255) COLLATE "pg_catalog"."default",
  "cabang" int8,
  "id_cob" int8,
  "id_lob" int8,
  "id_currency_code" int8,
  "id_tipe_cob" int8,
  "detail_cob_tertanggung" varchar(255) COLLATE "pg_catalog"."default",
  "total_sum_insured" float8,
  "total_premi_standar" float8,
  "total_premi_perluasan" float8,
  "diskon" float8,
  "total_akhir_premi" float8,
  "periode_premi" int8,
  "add_time" timestamp(6),
  "add_by" int8,
  "sppa_number" varchar(100) COLLATE "pg_catalog"."default",
  "nama" varchar(255) COLLATE "pg_catalog"."default",
  "telp" varchar(100) COLLATE "pg_catalog"."default",
  "id_relasi_cob_lob" int8,
  "biaya_admin" float8,
  "total_tagihan" float8,
  "payment_method" varchar(100) COLLATE "pg_catalog"."default",
  "tahun_cicilan" int8,
  "jumlah_cicilan" int8,
  "total_rate_akhir_premi" float8,
  "no_invoice_entry" varchar(255) COLLATE "pg_catalog"."default",
  "approval" bool DEFAULT false,
  "no_polis" varchar(100) COLLATE "pg_catalog"."default",
  "endorsment" bool DEFAULT false,
  "cancelation" bool DEFAULT false,
  "alamat" varchar COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Primary Key structure for table tr_sppa_quotation
-- ----------------------------
ALTER TABLE "public"."tr_sppa_quotation" ADD CONSTRAINT "tr_sppa_quotation_pkey" PRIMARY KEY ("id_sppa_quotation");
