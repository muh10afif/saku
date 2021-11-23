/*
 Navicat Premium Data Transfer

 Source Server         : skdigital.id
 Source Server Type    : PostgreSQL
 Source Server Version : 100013
 Source Host           : localhost:5432
 Source Catalog        : lbs
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 100013
 File Encoding         : 65001

 Date: 04/06/2021 08:58:12
*/


-- ----------------------------
-- Sequence structure for agent_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."agent_ID_sequence";
CREATE SEQUENCE "public"."agent_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for approve_sppa_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."approve_sppa_ID_sequence";
CREATE SEQUENCE "public"."approve_sppa_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for asuransi_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."asuransi_ID_sequence";
CREATE SEQUENCE "public"."asuransi_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for bagian_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."bagian_ID_sequence";
CREATE SEQUENCE "public"."bagian_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for bank_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."bank_ID_sequence";
CREATE SEQUENCE "public"."bank_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for business_pa_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."business_pa_ID_sequence";
CREATE SEQUENCE "public"."business_pa_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for cabang_bank_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."cabang_bank_ID_sequence";
CREATE SEQUENCE "public"."cabang_bank_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for cash_bank_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."cash_bank_ID_sequence";
CREATE SEQUENCE "public"."cash_bank_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for cob_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."cob_ID_sequence";
CREATE SEQUENCE "public"."cob_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for coverage_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."coverage_ID_sequence";
CREATE SEQUENCE "public"."coverage_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for coverage_mop_id_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."coverage_mop_id_sequence";
CREATE SEQUENCE "public"."coverage_mop_id_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for currency_forecast_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."currency_forecast_ID_sequence";
CREATE SEQUENCE "public"."currency_forecast_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for data_klaim_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."data_klaim_ID_sequence";
CREATE SEQUENCE "public"."data_klaim_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for desa_id_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."desa_id_sequence";
CREATE SEQUENCE "public"."desa_id_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for direct_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."direct_ID_sequence";
CREATE SEQUENCE "public"."direct_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for dok_persyaratan_ajk_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."dok_persyaratan_ajk_ID_sequence";
CREATE SEQUENCE "public"."dok_persyaratan_ajk_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for dokumen_klaim_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."dokumen_klaim_ID_sequence";
CREATE SEQUENCE "public"."dokumen_klaim_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for dokumen_sppa_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."dokumen_sppa_ID_sequence";
CREATE SEQUENCE "public"."dokumen_sppa_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for field_sppa_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."field_sppa_ID_sequence";
CREATE SEQUENCE "public"."field_sppa_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for field_sppa_cob_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."field_sppa_cob_ID_sequence";
CREATE SEQUENCE "public"."field_sppa_cob_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for group_menu_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."group_menu_ID_sequence";
CREATE SEQUENCE "public"."group_menu_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for indikator_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."indikator_ID_sequence";
CREATE SEQUENCE "public"."indikator_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for introduction_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."introduction_ID_sequence";
CREATE SEQUENCE "public"."introduction_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for jabatan_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."jabatan_ID_sequence";
CREATE SEQUENCE "public"."jabatan_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for jenis_bank_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."jenis_bank_ID_sequence";
CREATE SEQUENCE "public"."jenis_bank_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for jenis_kelamin_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."jenis_kelamin_ID_sequence";
CREATE SEQUENCE "public"."jenis_kelamin_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for jenis_klaim_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."jenis_klaim_ID_sequence";
CREATE SEQUENCE "public"."jenis_klaim_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for karyawan_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."karyawan_ID_sequence";
CREATE SEQUENCE "public"."karyawan_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for kategori_as_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."kategori_as_ID_sequence";
CREATE SEQUENCE "public"."kategori_as_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for kecamatan_id_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."kecamatan_id_sequence";
CREATE SEQUENCE "public"."kecamatan_id_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for klaim_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."klaim_ID_sequence";
CREATE SEQUENCE "public"."klaim_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for klasifikasi_klaim_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."klasifikasi_klaim_ID_sequence";
CREATE SEQUENCE "public"."klasifikasi_klaim_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for kota_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."kota_ID_sequence";
CREATE SEQUENCE "public"."kota_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for kota_id_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."kota_id_sequence";
CREATE SEQUENCE "public"."kota_id_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for level_otorisasi_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."level_otorisasi_ID_sequence";
CREATE SEQUENCE "public"."level_otorisasi_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for level_user_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."level_user_ID_sequence";
CREATE SEQUENCE "public"."level_user_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for lob_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."lob_ID_sequence";
CREATE SEQUENCE "public"."lob_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for loss_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."loss_ID_sequence";
CREATE SEQUENCE "public"."loss_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for m_field_sppa_prop_id_field_sppa_prop_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."m_field_sppa_prop_id_field_sppa_prop_seq";
CREATE SEQUENCE "public"."m_field_sppa_prop_id_field_sppa_prop_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for m_name_management_id_name_management_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."m_name_management_id_name_management_seq";
CREATE SEQUENCE "public"."m_name_management_id_name_management_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for m_sppa_field_spec_id_sppa_field_spec_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."m_sppa_field_spec_id_sppa_field_spec_seq";
CREATE SEQUENCE "public"."m_sppa_field_spec_id_sppa_field_spec_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for menu_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."menu_ID_sequence";
CREATE SEQUENCE "public"."menu_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for misi_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."misi_ID_sequence";
CREATE SEQUENCE "public"."misi_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for mop_id_mop_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."mop_id_mop_seq";
CREATE SEQUENCE "public"."mop_id_mop_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for nasabah_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."nasabah_ID_sequence";
CREATE SEQUENCE "public"."nasabah_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for negara_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."negara_ID_sequence";
CREATE SEQUENCE "public"."negara_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for parameter_scoring_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."parameter_scoring_ID_sequence";
CREATE SEQUENCE "public"."parameter_scoring_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for pembayaran_klaim_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."pembayaran_klaim_ID_sequence";
CREATE SEQUENCE "public"."pembayaran_klaim_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for polis_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."polis_ID_sequence";
CREATE SEQUENCE "public"."polis_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for privilage_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."privilage_ID_sequence";
CREATE SEQUENCE "public"."privilage_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for produk_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."produk_ID_sequence";
CREATE SEQUENCE "public"."produk_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for produk_title_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."produk_title_ID_sequence";
CREATE SEQUENCE "public"."produk_title_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for provinsi_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."provinsi_ID_sequence";
CREATE SEQUENCE "public"."provinsi_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for provinsi_id_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."provinsi_id_sequence";
CREATE SEQUENCE "public"."provinsi_id_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for relasi_cob_lob_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."relasi_cob_lob_ID_sequence";
CREATE SEQUENCE "public"."relasi_cob_lob_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for restitusi_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."restitusi_ID_sequence";
CREATE SEQUENCE "public"."restitusi_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for role_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."role_ID_sequence";
CREATE SEQUENCE "public"."role_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for scoring_asuransi_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."scoring_asuransi_ID_sequence";
CREATE SEQUENCE "public"."scoring_asuransi_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for sob_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."sob_ID_sequence";
CREATE SEQUENCE "public"."sob_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for sppa_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."sppa_ID_sequence";
CREATE SEQUENCE "public"."sppa_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for sppa_quotation_id_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."sppa_quotation_id_sequence";
CREATE SEQUENCE "public"."sppa_quotation_id_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for status_klaim_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."status_klaim_ID_sequence";
CREATE SEQUENCE "public"."status_klaim_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for subtitle_management_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."subtitle_management_ID_sequence";
CREATE SEQUENCE "public"."subtitle_management_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for termin_pembayaran_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."termin_pembayaran_ID_sequence";
CREATE SEQUENCE "public"."termin_pembayaran_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for tipe_as_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tipe_as_ID_sequence";
CREATE SEQUENCE "public"."tipe_as_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for tipe_cob_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tipe_cob_ID_sequence";
CREATE SEQUENCE "public"."tipe_cob_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for tipe_klaim_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tipe_klaim_ID_sequence";
CREATE SEQUENCE "public"."tipe_klaim_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for title_management_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."title_management_ID_sequence";
CREATE SEQUENCE "public"."title_management_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for tr_endorsment_id_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tr_endorsment_id_sequence";
CREATE SEQUENCE "public"."tr_endorsment_id_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for tr_histori_status_sob_id_histori_status_sob_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tr_histori_status_sob_id_histori_status_sob_seq";
CREATE SEQUENCE "public"."tr_histori_status_sob_id_histori_status_sob_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for tr_premi_adt_id_tr_premi_adt_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tr_premi_adt_id_tr_premi_adt_seq";
CREATE SEQUENCE "public"."tr_premi_adt_id_tr_premi_adt_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for tr_premi_id_tr_premi_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tr_premi_id_tr_premi_seq";
CREATE SEQUENCE "public"."tr_premi_id_tr_premi_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for user_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."user_ID_sequence";
CREATE SEQUENCE "public"."user_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for value_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."value_ID_sequence";
CREATE SEQUENCE "public"."value_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for visi_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."visi_ID_sequence";
CREATE SEQUENCE "public"."visi_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for wilayah_ID_sequence
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."wilayah_ID_sequence";
CREATE SEQUENCE "public"."wilayah_ID_sequence" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Table structure for coverage
-- ----------------------------
DROP TABLE IF EXISTS "public"."coverage";
CREATE TABLE "public"."coverage" (
  "id_coverage" int8 NOT NULL DEFAULT nextval('"coverage_ID_sequence"'::regclass),
  "label" varchar(255) COLLATE "pg_catalog"."default",
  "rate" varchar(255) COLLATE "pg_catalog"."default",
  "status" varchar(255) COLLATE "pg_catalog"."default",
  "add_by" int8,
  "add_time" timestamp(6) DEFAULT CURRENT_TIMESTAMP,
  "id_lob" int8
)
;

-- ----------------------------
-- Table structure for coverage_mop
-- ----------------------------
DROP TABLE IF EXISTS "public"."coverage_mop";
CREATE TABLE "public"."coverage_mop" (
  "id_coverage_mop" int8 NOT NULL DEFAULT nextval('coverage_mop_id_sequence'::regclass),
  "label" varchar(255) COLLATE "pg_catalog"."default",
  "rate" varchar(255) COLLATE "pg_catalog"."default",
  "status" varchar(255) COLLATE "pg_catalog"."default",
  "add_by" int8,
  "add_time" timestamp(6) DEFAULT CURRENT_TIMESTAMP,
  "id_lob" int8,
  "id_mop" int8
)
;

-- ----------------------------
-- Table structure for dok_persyaratan_ajk
-- ----------------------------
DROP TABLE IF EXISTS "public"."dok_persyaratan_ajk";
CREATE TABLE "public"."dok_persyaratan_ajk" (
  "id_dok_persyaratan_ajk" int8 NOT NULL DEFAULT nextval('"dok_persyaratan_ajk_ID_sequence"'::regclass),
  "kode_dok_persyaratan_ajk" varchar(255) COLLATE "pg_catalog"."default",
  "dokumen" varchar(255) COLLATE "pg_catalog"."default",
  "filename" varchar(255) COLLATE "pg_catalog"."default",
  "size" float8,
  "status" int8,
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for dokumen_klaim
-- ----------------------------
DROP TABLE IF EXISTS "public"."dokumen_klaim";
CREATE TABLE "public"."dokumen_klaim" (
  "id_dokumen_klaim" int8 NOT NULL DEFAULT nextval('"dokumen_klaim_ID_sequence"'::regclass),
  "id_data_klaim" int8,
  "nama_file" varchar(255) COLLATE "pg_catalog"."default",
  "size" float8,
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for dokumen_sppa
-- ----------------------------
DROP TABLE IF EXISTS "public"."dokumen_sppa";
CREATE TABLE "public"."dokumen_sppa" (
  "id_dokumen_sppa" int8 NOT NULL DEFAULT nextval('"dokumen_sppa_ID_sequence"'::regclass),
  "filename" varchar(255) COLLATE "pg_catalog"."default",
  "description" varchar(255) COLLATE "pg_catalog"."default",
  "size" varchar(255) COLLATE "pg_catalog"."default",
  "id_sppa_quotation" int8,
  "add_time" timestamp(6),
  "add_by" int8,
  "sppa_number" varchar COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for field_sppa_cob
-- ----------------------------
DROP TABLE IF EXISTS "public"."field_sppa_cob";
CREATE TABLE "public"."field_sppa_cob" (
  "id_field_sppa_cob" int8 NOT NULL DEFAULT nextval('"field_sppa_cob_ID_sequence"'::regclass),
  "id_cob" int8,
  "id_field_sppa" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for level_otorisasi
-- ----------------------------
DROP TABLE IF EXISTS "public"."level_otorisasi";
CREATE TABLE "public"."level_otorisasi" (
  "id_level_otorisasi" int8 NOT NULL DEFAULT nextval('"level_otorisasi_ID_sequence"'::regclass),
  "level_otorisasi" varchar(255) COLLATE "pg_catalog"."default",
  "add_by" int8,
  "add_time" timestamp(0) DEFAULT CURRENT_TIMESTAMP,
  "id_level_user" int8
)
;

-- ----------------------------
-- Table structure for level_user
-- ----------------------------
DROP TABLE IF EXISTS "public"."level_user";
CREATE TABLE "public"."level_user" (
  "id_level_user" int8 NOT NULL DEFAULT nextval('"level_user_ID_sequence"'::regclass),
  "level_user" varchar(255) COLLATE "pg_catalog"."default",
  "add_by" int8,
  "add_time" timestamp(0) DEFAULT CURRENT_TIMESTAMP
)
;

-- ----------------------------
-- Table structure for m_agent
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_agent";
CREATE TABLE "public"."m_agent" (
  "id_agent" int8 NOT NULL DEFAULT nextval('"agent_ID_sequence"'::regclass),
  "nama" varchar(255) COLLATE "pg_catalog"."default",
  "telp" varchar(100) COLLATE "pg_catalog"."default",
  "alamat" text COLLATE "pg_catalog"."default",
  "add_by" int8,
  "add_time" timestamp(0) DEFAULT CURRENT_TIMESTAMP
)
;

-- ----------------------------
-- Table structure for m_asuransi
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_asuransi";
CREATE TABLE "public"."m_asuransi" (
  "id_asuransi" int8 NOT NULL DEFAULT nextval('"asuransi_ID_sequence"'::regclass),
  "nama_asuransi" varchar(255) COLLATE "pg_catalog"."default",
  "kode_asuransi" varchar(255) COLLATE "pg_catalog"."default",
  "singkatan" varchar(255) COLLATE "pg_catalog"."default",
  "id_tipe_as" int8,
  "id_kategori_as" int8,
  "alamat" text COLLATE "pg_catalog"."default",
  "id_kota" int8,
  "kode_pos" varchar(100) COLLATE "pg_catalog"."default",
  "telp" varchar(255) COLLATE "pg_catalog"."default",
  "fax" varchar(255) COLLATE "pg_catalog"."default",
  "website" varchar(255) COLLATE "pg_catalog"."default",
  "email" varchar(255) COLLATE "pg_catalog"."default",
  "pic" varchar(255) COLLATE "pg_catalog"."default",
  "alamat_pic" text COLLATE "pg_catalog"."default",
  "telp_pic" varchar(255) COLLATE "pg_catalog"."default",
  "email_pic" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_bagian
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_bagian";
CREATE TABLE "public"."m_bagian" (
  "id_bagian" int8 NOT NULL DEFAULT nextval('"bagian_ID_sequence"'::regclass),
  "kode_bagian" varchar(255) COLLATE "pg_catalog"."default",
  "bagian" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_bank
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_bank";
CREATE TABLE "public"."m_bank" (
  "id_bank" int8 NOT NULL DEFAULT nextval('"bank_ID_sequence"'::regclass),
  "kode_bank" varchar(255) COLLATE "pg_catalog"."default",
  "nama_bank" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8,
  "id_jenis_bank" int8
)
;

-- ----------------------------
-- Table structure for m_business_partner
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_business_partner";
CREATE TABLE "public"."m_business_partner" (
  "id_business_partner" int8 NOT NULL DEFAULT nextval('"business_pa_ID_sequence"'::regclass),
  "nama" varchar(255) COLLATE "pg_catalog"."default",
  "telp" varchar(100) COLLATE "pg_catalog"."default",
  "alamat" text COLLATE "pg_catalog"."default",
  "add_by" int8,
  "add_time" timestamp(0) DEFAULT CURRENT_TIMESTAMP
)
;

-- ----------------------------
-- Table structure for m_cabang_bank
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_cabang_bank";
CREATE TABLE "public"."m_cabang_bank" (
  "id_cabang_bank" int8 NOT NULL DEFAULT nextval('"cabang_bank_ID_sequence"'::regclass),
  "kode_cabang_bank" varchar(255) COLLATE "pg_catalog"."default",
  "nama_cabang_bank" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8,
  "id_bank" int8
)
;

-- ----------------------------
-- Table structure for m_cashbank
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_cashbank";
CREATE TABLE "public"."m_cashbank" (
  "id_cashbank" int8 NOT NULL DEFAULT nextval('"cash_bank_ID_sequence"'::regclass),
  "kode_cashbank" varchar(255) COLLATE "pg_catalog"."default",
  "cashbank" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_cob
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_cob";
CREATE TABLE "public"."m_cob" (
  "id_cob" int8 NOT NULL DEFAULT nextval('"cob_ID_sequence"'::regclass),
  "kode_cob" varchar(255) COLLATE "pg_catalog"."default",
  "cob" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8,
  "id_tipe_cob" int8
)
;

-- ----------------------------
-- Table structure for m_currency_forecast
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_currency_forecast";
CREATE TABLE "public"."m_currency_forecast" (
  "id_currency_forecast" int8 NOT NULL DEFAULT nextval('"currency_forecast_ID_sequence"'::regclass),
  "tahun" varchar(255) COLLATE "pg_catalog"."default",
  "bulan" varchar(255) COLLATE "pg_catalog"."default",
  "kode_mata_uang" varchar(255) COLLATE "pg_catalog"."default",
  "rate" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_desa
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_desa";
CREATE TABLE "public"."m_desa" (
  "id_desa" int8 NOT NULL DEFAULT nextval('desa_id_sequence'::regclass),
  "desa" varchar(255) COLLATE "pg_catalog"."default",
  "id_kecamatan" int8,
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_direct
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_direct";
CREATE TABLE "public"."m_direct" (
  "id_direct" int8 NOT NULL DEFAULT nextval('"direct_ID_sequence"'::regclass),
  "nama" varchar(255) COLLATE "pg_catalog"."default",
  "telp" varchar(100) COLLATE "pg_catalog"."default",
  "alamat" text COLLATE "pg_catalog"."default",
  "add_by" int8,
  "add_time" timestamp(0) DEFAULT CURRENT_TIMESTAMP
)
;

-- ----------------------------
-- Table structure for m_field_sppa
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_field_sppa";
CREATE TABLE "public"."m_field_sppa" (
  "id_field_sppa" int8 NOT NULL DEFAULT nextval('"field_sppa_ID_sequence"'::regclass),
  "field_sppa" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8,
  "data_type" varchar(255) COLLATE "pg_catalog"."default",
  "cdb" bool
)
;

-- ----------------------------
-- Table structure for m_field_sppa_prop
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_field_sppa_prop";
CREATE TABLE "public"."m_field_sppa_prop" (
  "id_field_sppa_prop" int4 NOT NULL DEFAULT nextval('m_field_sppa_prop_id_field_sppa_prop_seq'::regclass),
  "id_sppa_field_spec" int8,
  "key_to_param" varchar(255) COLLATE "pg_catalog"."default",
  "input_type" varchar(5) COLLATE "pg_catalog"."default",
  "if_input_type_select" text COLLATE "pg_catalog"."default",
  "add_time" timestamp(0),
  "add_by" int8,
  "option_flag" int8,
  "input_length" text COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for m_indikator
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_indikator";
CREATE TABLE "public"."m_indikator" (
  "id_indikator" int8 NOT NULL DEFAULT nextval('"indikator_ID_sequence"'::regclass),
  "nama_indikator" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_introduction
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_introduction";
CREATE TABLE "public"."m_introduction" (
  "id_introduction" int8 NOT NULL DEFAULT nextval('"introduction_ID_sequence"'::regclass),
  "introduction" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_jabatan
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_jabatan";
CREATE TABLE "public"."m_jabatan" (
  "id_jabatan" int8 NOT NULL DEFAULT nextval('"jabatan_ID_sequence"'::regclass),
  "kode_jabatan" varchar(255) COLLATE "pg_catalog"."default",
  "jabatan" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8,
  "id_bagian" int8,
  "parent" int8
)
;

-- ----------------------------
-- Table structure for m_jenis_bank
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_jenis_bank";
CREATE TABLE "public"."m_jenis_bank" (
  "id_jenis_bank" int8 NOT NULL DEFAULT nextval('"jenis_bank_ID_sequence"'::regclass),
  "jenis_bank" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6) DEFAULT CURRENT_TIMESTAMP,
  "add_by" int8,
  "kode_jenis_bank" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for m_jenis_klaim
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_jenis_klaim";
CREATE TABLE "public"."m_jenis_klaim" (
  "id_jenis_klaim" int8 NOT NULL DEFAULT nextval('"jenis_klaim_ID_sequence"'::regclass),
  "jenis_klaim" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_karyawan
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_karyawan";
CREATE TABLE "public"."m_karyawan" (
  "id_karyawan" int8 NOT NULL DEFAULT nextval('"karyawan_ID_sequence"'::regclass),
  "nama_karyawan" varchar(255) COLLATE "pg_catalog"."default",
  "alamat_karyawan" text COLLATE "pg_catalog"."default",
  "email" varchar(255) COLLATE "pg_catalog"."default",
  "telp" varchar(255) COLLATE "pg_catalog"."default",
  "nik" varchar(255) COLLATE "pg_catalog"."default",
  "id_jabatan" int8,
  "add_time" timestamp(6),
  "add_by" int8,
  "id_provinsi" int8,
  "id_kota" int8,
  "id_kecamatan" int8,
  "id_desa" int8
)
;

-- ----------------------------
-- Table structure for m_kategori_as
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_kategori_as";
CREATE TABLE "public"."m_kategori_as" (
  "id_kategori_as" int8 NOT NULL DEFAULT nextval('"kategori_as_ID_sequence"'::regclass),
  "kategori_as" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_kecamatan
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_kecamatan";
CREATE TABLE "public"."m_kecamatan" (
  "id_kecamatan" int8 NOT NULL DEFAULT nextval('kecamatan_id_sequence'::regclass),
  "kecamatan" varchar(255) COLLATE "pg_catalog"."default",
  "id_kota" int8,
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_klasifikasi_klaim
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_klasifikasi_klaim";
CREATE TABLE "public"."m_klasifikasi_klaim" (
  "id_klasifikasi_klaim" int8 NOT NULL DEFAULT nextval('"klasifikasi_klaim_ID_sequence"'::regclass),
  "klasifikasi_klaim" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_kota
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_kota";
CREATE TABLE "public"."m_kota" (
  "id_kota" int8 NOT NULL DEFAULT nextval('kota_id_sequence'::regclass),
  "kota" varchar(255) COLLATE "pg_catalog"."default",
  "id_provinsi" int8,
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_lob
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_lob";
CREATE TABLE "public"."m_lob" (
  "id_lob" int8 NOT NULL DEFAULT nextval('"lob_ID_sequence"'::regclass),
  "lob" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8,
  "diskon" varchar(100) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for m_loss_adjuster
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_loss_adjuster";
CREATE TABLE "public"."m_loss_adjuster" (
  "id_loss_adjuster" int8 NOT NULL DEFAULT nextval('"loss_ID_sequence"'::regclass),
  "nama" varchar(255) COLLATE "pg_catalog"."default",
  "telp" varchar(100) COLLATE "pg_catalog"."default",
  "alamat" text COLLATE "pg_catalog"."default",
  "add_by" int8,
  "add_time" timestamp(0) DEFAULT CURRENT_TIMESTAMP
)
;

-- ----------------------------
-- Table structure for m_misi
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_misi";
CREATE TABLE "public"."m_misi" (
  "id_misi" int8 NOT NULL DEFAULT nextval('"misi_ID_sequence"'::regclass),
  "misi" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_name_management
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_name_management";
CREATE TABLE "public"."m_name_management" (
  "id_name_management" int4 NOT NULL DEFAULT nextval('m_name_management_id_name_management_seq'::regclass),
  "id_subtitle_management" int8,
  "name_management" varchar(255) COLLATE "pg_catalog"."default",
  "isactive" int4,
  "add_time" timestamp(0),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_nasabah
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_nasabah";
CREATE TABLE "public"."m_nasabah" (
  "id_nasabah" int8 NOT NULL DEFAULT nextval('"nasabah_ID_sequence"'::regclass),
  "kode_nasabah" varchar(255) COLLATE "pg_catalog"."default",
  "nama_nasabah" varchar(255) COLLATE "pg_catalog"."default",
  "tgl_lahir" date,
  "tempat_dinas" varchar(255) COLLATE "pg_catalog"."default",
  "alamat_rumah" text COLLATE "pg_catalog"."default",
  "telp" varchar(255) COLLATE "pg_catalog"."default",
  "nik" varchar(255) COLLATE "pg_catalog"."default",
  "jenis_kelamin" bool,
  "add_time" timestamp(6),
  "add_by" int8,
  "id_provinsi" int8,
  "id_kota" int8,
  "id_kecamatan" int8,
  "id_desa" int8
)
;

-- ----------------------------
-- Table structure for m_negara
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_negara";
CREATE TABLE "public"."m_negara" (
  "id_negara" int8 NOT NULL DEFAULT nextval('"negara_ID_sequence"'::regclass),
  "negara" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_parameter_scoring
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_parameter_scoring";
CREATE TABLE "public"."m_parameter_scoring" (
  "id_parameter_scoring" int8 NOT NULL DEFAULT nextval('"parameter_scoring_ID_sequence"'::regclass),
  "nama_parameter" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_provinsi
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_provinsi";
CREATE TABLE "public"."m_provinsi" (
  "id_provinsi" int8 NOT NULL DEFAULT nextval('provinsi_id_sequence'::regclass),
  "provinsi" varchar(255) COLLATE "pg_catalog"."default",
  "id_negara" int8,
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_sob
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_sob";
CREATE TABLE "public"."m_sob" (
  "id_sob" int8 NOT NULL DEFAULT nextval('"sob_ID_sequence"'::regclass),
  "kode_sob" varchar(255) COLLATE "pg_catalog"."default",
  "sob" varchar(255) COLLATE "pg_catalog"."default",
  "description" text COLLATE "pg_catalog"."default",
  "add_by" int8,
  "add_time" timestamp(0) DEFAULT CURRENT_TIMESTAMP
)
;

-- ----------------------------
-- Table structure for m_sppa_field_spec
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_sppa_field_spec";
CREATE TABLE "public"."m_sppa_field_spec" (
  "id_sppa_field_spec" int4 NOT NULL DEFAULT nextval('m_sppa_field_spec_id_sppa_field_spec_seq'::regclass),
  "type_field" int8,
  "add_time" timestamp(0),
  "add_by" int8,
  "id_relasi_cob_lob" int8
)
;

-- ----------------------------
-- Table structure for m_status_klaim
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_status_klaim";
CREATE TABLE "public"."m_status_klaim" (
  "id_status_klaim" int8 NOT NULL DEFAULT nextval('"status_klaim_ID_sequence"'::regclass),
  "status_klaim" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_subtitle_management
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_subtitle_management";
CREATE TABLE "public"."m_subtitle_management" (
  "id_subtitle_management" int8 NOT NULL DEFAULT nextval('"subtitle_management_ID_sequence"'::regclass),
  "subtitle_management" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8,
  "id_title_management" int8
)
;

-- ----------------------------
-- Table structure for m_tipe_as
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_tipe_as";
CREATE TABLE "public"."m_tipe_as" (
  "id_tipe_as" int8 NOT NULL DEFAULT nextval('"tipe_as_ID_sequence"'::regclass),
  "tipe_as" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_tipe_cob
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_tipe_cob";
CREATE TABLE "public"."m_tipe_cob" (
  "id_tipe_cob" int8 NOT NULL DEFAULT nextval('"tipe_cob_ID_sequence"'::regclass),
  "tipe_cob" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_tipe_klaim
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_tipe_klaim";
CREATE TABLE "public"."m_tipe_klaim" (
  "id_tipe_klaim" int8 NOT NULL DEFAULT nextval('"tipe_klaim_ID_sequence"'::regclass),
  "tipe_klaim" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_title_management
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_title_management";
CREATE TABLE "public"."m_title_management" (
  "id_title_management" int8 NOT NULL DEFAULT nextval('"title_management_ID_sequence"'::regclass),
  "title_management" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_user";
CREATE TABLE "public"."m_user" (
  "id_user" int8 NOT NULL DEFAULT nextval('"user_ID_sequence"'::regclass),
  "kode_user" varchar(255) COLLATE "pg_catalog"."default",
  "id_karyawan" int8,
  "username" varchar(255) COLLATE "pg_catalog"."default",
  "password" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8,
  "id_level_otorisasi" int8,
  "id_level_user" int8,
  "flag_table" int8
)
;

-- ----------------------------
-- Table structure for m_value
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_value";
CREATE TABLE "public"."m_value" (
  "id_value" int8 NOT NULL DEFAULT nextval('"value_ID_sequence"'::regclass),
  "value" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_visi
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_visi";
CREATE TABLE "public"."m_visi" (
  "id_visi" int8 NOT NULL DEFAULT nextval('"visi_ID_sequence"'::regclass),
  "visi" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for m_wilayah
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_wilayah";
CREATE TABLE "public"."m_wilayah" (
  "id_wilayah" int8 NOT NULL DEFAULT nextval('"wilayah_ID_sequence"'::regclass),
  "parent" varchar(255) COLLATE "pg_catalog"."default",
  "level" varchar(255) COLLATE "pg_catalog"."default",
  "kode" varchar(255) COLLATE "pg_catalog"."default",
  "nama" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

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

-- ----------------------------
-- Table structure for privilage
-- ----------------------------
DROP TABLE IF EXISTS "public"."privilage";
CREATE TABLE "public"."privilage" (
  "id_privillage" int8 NOT NULL DEFAULT nextval('"privilage_ID_sequence"'::regclass),
  "id_level_otorisasi" int8,
  "add_by" int8,
  "add_time" timestamp(0) DEFAULT CURRENT_TIMESTAMP,
  "id_menu" int8,
  "action" varchar(64) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for ref_group_menu
-- ----------------------------
DROP TABLE IF EXISTS "public"."ref_group_menu";
CREATE TABLE "public"."ref_group_menu" (
  "id" int8 NOT NULL DEFAULT nextval('"group_menu_ID_sequence"'::regclass),
  "id_jabatan" int8,
  "id_menu" int8,
  "role" varchar(10) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for ref_menu
-- ----------------------------
DROP TABLE IF EXISTS "public"."ref_menu";
CREATE TABLE "public"."ref_menu" (
  "id" int8 NOT NULL DEFAULT nextval('"menu_ID_sequence"'::regclass),
  "parrent" int8,
  "nama_menu" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "link" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "urutan" int4 NOT NULL,
  "class_active" int2 NOT NULL,
  "created_at" timestamp(0) DEFAULT CURRENT_TIMESTAMP,
  "sistem" varchar(100) COLLATE "pg_catalog"."default",
  "icon" varchar(100) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for relasi_cob_lob
-- ----------------------------
DROP TABLE IF EXISTS "public"."relasi_cob_lob";
CREATE TABLE "public"."relasi_cob_lob" (
  "id_relasi_cob_lob" int8 NOT NULL DEFAULT nextval('"relasi_cob_lob_ID_sequence"'::regclass),
  "id_cob" int8,
  "id_lob" int8,
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS "public"."role";
CREATE TABLE "public"."role" (
  "id_role" int8 NOT NULL DEFAULT nextval('"role_ID_sequence"'::regclass),
  "id_level_otorisasi" int8,
  "id_jabatan" int8,
  "add_by" int8,
  "add_time" timestamp(0) DEFAULT CURRENT_TIMESTAMP
)
;

-- ----------------------------
-- Table structure for scoring_asuransi
-- ----------------------------
DROP TABLE IF EXISTS "public"."scoring_asuransi";
CREATE TABLE "public"."scoring_asuransi" (
  "id_scoring_as" int8 NOT NULL DEFAULT nextval('"scoring_asuransi_ID_sequence"'::regclass),
  "id_asuransi" int8,
  "id_parameter_asuransi" int8,
  "nilai" float8,
  "penjelasan" text COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for tr_approve_sppa
-- ----------------------------
DROP TABLE IF EXISTS "public"."tr_approve_sppa";
CREATE TABLE "public"."tr_approve_sppa" (
  "id_approve_sppa" int8 NOT NULL DEFAULT nextval('"approve_sppa_ID_sequence"'::regclass),
  "id_sppa_quotation" int8,
  "brokerage" float8,
  "overriding_commission" float8,
  "additional_premium" float8,
  "tgl_approve" timestamp(6),
  "id_asuransi" int8,
  "no_otorisasi_polis" varchar(255) COLLATE "pg_catalog"."default",
  "tgl_otorisasi" timestamp(6),
  "id_pegawai" int8,
  "keterangan_tambahan" text COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for tr_data_klaim
-- ----------------------------
DROP TABLE IF EXISTS "public"."tr_data_klaim";
CREATE TABLE "public"."tr_data_klaim" (
  "id_data_klaim" varchar(255) COLLATE "pg_catalog"."default" NOT NULL DEFAULT nextval('"data_klaim_ID_sequence"'::regclass),
  "id_sppa" int8,
  "tgl_klaim" timestamp(6),
  "tipe_klaim" int8,
  "nilai_klaim" float8,
  "status_klaim" int8,
  "keterangan_klaim" text COLLATE "pg_catalog"."default",
  "kejadian" text COLLATE "pg_catalog"."default",
  "lokasi_kejadian" text COLLATE "pg_catalog"."default",
  "penyebab" text COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8,
  "id_insured" int8,
  "klaim_nomor_dok" varchar(255) COLLATE "pg_catalog"."default",
  "id_tipe_klaim" int8,
  "id_status_klaim" int8,
  "pic" int8
)
;

-- ----------------------------
-- Table structure for tr_endorsment
-- ----------------------------
DROP TABLE IF EXISTS "public"."tr_endorsment";
CREATE TABLE "public"."tr_endorsment" (
  "id_tr_endorsment" int8 NOT NULL DEFAULT nextval('tr_endorsment_id_sequence'::regclass),
  "id_sppa_quotation" int8,
  "id_endorsment" int8,
  "add_by" int8,
  "add_time" timestamp(0) DEFAULT CURRENT_TIMESTAMP,
  "status" varchar(100) COLLATE "pg_catalog"."default"
)
;

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

-- ----------------------------
-- Table structure for tr_klaim
-- ----------------------------
DROP TABLE IF EXISTS "public"."tr_klaim";
CREATE TABLE "public"."tr_klaim" (
  "id_klaim" int8 NOT NULL DEFAULT nextval('"klaim_ID_sequence"'::regclass),
  "id_polis" int8,
  "id_tipe_klaim" int8,
  "keterangan" text COLLATE "pg_catalog"."default",
  "tgl_lapor" timestamp(6),
  "tgl_kejadian" timestamp(6),
  "no_rek_debitur" varchar(255) COLLATE "pg_catalog"."default",
  "nilai_klaim" float8,
  "id_klasifikasi_klaim" int8,
  "id_indikator" int8,
  "user_input" int8,
  "id_verifikator" int8,
  "tgl_verifikasi" timestamp(6),
  "id_user_cetak" int8,
  "tgl_kirim_dok" timestamp(6),
  "id_user_kirim_dok" int8,
  "tgl_pembyaran" timestamp(6),
  "nilai_pembayaran" float8,
  "id_user_pembayaran" int8,
  "tgl_closing" timestamp(6),
  "tgl_posting" timestamp(6),
  "no_klaim" varchar(255) COLLATE "pg_catalog"."default",
  "add_time" timestamp(6),
  "add_by" int8,
  "no_sertifikat_klaim" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for tr_pembayaran_klaim
-- ----------------------------
DROP TABLE IF EXISTS "public"."tr_pembayaran_klaim";
CREATE TABLE "public"."tr_pembayaran_klaim" (
  "id_pembayaran_klaim" int8 NOT NULL DEFAULT nextval('"pembayaran_klaim_ID_sequence"'::regclass),
  "id_klaim" int8,
  "proses" int8,
  "tgl_bayar" timestamp(6),
  "nilai_bayar" float8,
  "status_bayar" int8,
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for tr_polis
-- ----------------------------
DROP TABLE IF EXISTS "public"."tr_polis";
CREATE TABLE "public"."tr_polis" (
  "id_polis" int8 NOT NULL DEFAULT nextval('"polis_ID_sequence"'::regclass),
  "id_cabang_bank" int8,
  "id_nasabah" int8,
  "tgl_mulai" date,
  "lama_bulan" int8,
  "produk" int8,
  "rate_premi" float8,
  "nilai_pembiayaan" float8,
  "premi" float8,
  "premi_fax" float8,
  "premi_rek_koran" float8,
  "status_premi" int8,
  "account_period" date,
  "user_input" int8,
  "id_verifikator" int8,
  "tgl_verifikasi" timestamp(6),
  "id_user" int8,
  "tgl_cetak" timestamp(6),
  "endorsement" float8,
  "tgl_posting_coas" timestamp(6),
  "no_polis" varchar(255) COLLATE "pg_catalog"."default",
  "no_sertifikat" varchar(255) COLLATE "pg_catalog"."default",
  "id_asuransi" int8,
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for tr_premi
-- ----------------------------
DROP TABLE IF EXISTS "public"."tr_premi";
CREATE TABLE "public"."tr_premi" (
  "id_coverage" int8,
  "rate" float8,
  "nominal" float8,
  "add_by" int8,
  "add_time" timestamp(0) DEFAULT CURRENT_TIMESTAMP,
  "id_tr_premi" int8 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
),
  "id_sppa_quotation" int8
)
;

-- ----------------------------
-- Table structure for tr_premi_adt
-- ----------------------------
DROP TABLE IF EXISTS "public"."tr_premi_adt";
CREATE TABLE "public"."tr_premi_adt" (
  "id_lob" int8,
  "pengali_tsi" float8,
  "kalkulasi_tsi" float8,
  "rate" float8,
  "nominal" float8,
  "add_by" int8,
  "add_time" timestamp(0) DEFAULT CURRENT_TIMESTAMP,
  "id_sppa_quotation" int8,
  "id_tr_premi_adt" int8 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
)
)
;

-- ----------------------------
-- Table structure for tr_restitusi
-- ----------------------------
DROP TABLE IF EXISTS "public"."tr_restitusi";
CREATE TABLE "public"."tr_restitusi" (
  "id_restitusi" varchar(255) COLLATE "pg_catalog"."default" NOT NULL DEFAULT nextval('"restitusi_ID_sequence"'::regclass),
  "id_polis" varchar(255) COLLATE "pg_catalog"."default",
  "keterangan" text COLLATE "pg_catalog"."default",
  "tgl_lapor" timestamp(6),
  "no_rek_debitur" varchar(255) COLLATE "pg_catalog"."default",
  "nilai_restitusi" float8,
  "user_input" int8,
  "id_verifikator" int8,
  "tgl_verifikasi" timestamp(6),
  "id_user_cetak" int8,
  "tgl_kirim_dok" timestamp(6),
  "id_user_kirim_dok" int8,
  "id_user_pembayaran" int8,
  "tgl_closing" timestamp(6),
  "tgl_posting" timestamp(6),
  "no_restitusi" varchar(255) COLLATE "pg_catalog"."default",
  "no_sertifikat_restitusi" varchar(255) COLLATE "pg_catalog"."default",
  "id_indikator" int8,
  "add_time" timestamp(6),
  "add_by" int8
)
;

-- ----------------------------
-- Table structure for tr_sppa_quotation
-- ----------------------------
DROP TABLE IF EXISTS "public"."tr_sppa_quotation";
CREATE TABLE "public"."tr_sppa_quotation" (
  "id_sppa_quotation" int8 NOT NULL DEFAULT nextval('sppa_quotation_id_sequence'::regclass),
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
  "alamat" varchar COLLATE "pg_catalog"."default",
  "jenis_asuransi" varchar(255) COLLATE "pg_catalog"."default",
  "jenis_kelamin" varchar COLLATE "pg_catalog"."default",
  "jenis_jaminan" text COLLATE "pg_catalog"."default",
  "file_invoice" varchar(255) COLLATE "pg_catalog"."default",
  "deskripsi" text COLLATE "pg_catalog"."default",
  "tambahan_deskripsi" text COLLATE "pg_catalog"."default",
  "lokasi" text COLLATE "pg_catalog"."default",
  "okupasi" text COLLATE "pg_catalog"."default",
  "nilai_pertanggungan" float8,
  "awal_periode_penutupan" date,
  "akhir_periode_penutupan" date,
  "deductible" text COLLATE "pg_catalog"."default",
  "type_of_vehicle" text COLLATE "pg_catalog"."default",
  "vehicle_polis_number" varchar COLLATE "pg_catalog"."default",
  "year_made" date,
  "premium" int8,
  "premium_rate" float8,
  "extended_premium" float8,
  "extended_rate" float8,
  "standar_premium" float8,
  "standar_rate" float8,
  "sum_insured" float8,
  "brand" text COLLATE "pg_catalog"."default",
  "klaim_pasti_dibayar" text COLLATE "pg_catalog"."default",
  "pengalaman_klaim" text COLLATE "pg_catalog"."default",
  "alat" text COLLATE "pg_catalog"."default",
  "nilai_jaminan" float8,
  "dokumen" text COLLATE "pg_catalog"."default",
  "bank_penerbit" text COLLATE "pg_catalog"."default",
  "alamat_pemberi_kerja" text COLLATE "pg_catalog"."default",
  "nama_pemberi_kerja" text COLLATE "pg_catalog"."default",
  "usia_objek_pertanggungan" int8,
  "objek_pertanggungan" text COLLATE "pg_catalog"."default",
  "hubungan_keluarga" text COLLATE "pg_catalog"."default",
  "alamat_ahli_waris" text COLLATE "pg_catalog"."default",
  "ahli_waris" text COLLATE "pg_catalog"."default",
  "proyek_yang_pernah_dikerjakan" text COLLATE "pg_catalog"."default",
  "kategori" text COLLATE "pg_catalog"."default",
  "class" text COLLATE "pg_catalog"."default",
  "telepon" int8,
  "tanggal_lahir" date,
  "tempat_lahir" text COLLATE "pg_catalog"."default",
  "perluasan" text COLLATE "pg_catalog"."default",
  "resiko_sekitar" text COLLATE "pg_catalog"."default",
  "test" varchar COLLATE "pg_catalog"."default",
  "type_of_vehiclee" text COLLATE "pg_catalog"."default",
  "no_binding" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for tr_termin_pembayaran
-- ----------------------------
DROP TABLE IF EXISTS "public"."tr_termin_pembayaran";
CREATE TABLE "public"."tr_termin_pembayaran" (
  "id_termin_pembayaran" int8 NOT NULL DEFAULT nextval('"termin_pembayaran_ID_sequence"'::regclass),
  "id_sppa_quotation" int8,
  "no_dokumen" varchar(255) COLLATE "pg_catalog"."default",
  "tgl_bayar" timestamp(6),
  "jumlah" float4,
  "cara_bayar" varchar(255) COLLATE "pg_catalog"."default",
  "tgl_terima" timestamp(6),
  "add_time" timestamp(6),
  "add_by" int8,
  "sppa_number" varchar COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."agent_ID_sequence"
OWNED BY "public"."m_agent"."id_agent";
SELECT setval('"public"."agent_ID_sequence"', 10, true);
SELECT setval('"public"."approve_sppa_ID_sequence"', 4, true);
SELECT setval('"public"."asuransi_ID_sequence"', 3, true);
SELECT setval('"public"."bagian_ID_sequence"', 14, true);
SELECT setval('"public"."bank_ID_sequence"', 62, true);
ALTER SEQUENCE "public"."business_pa_ID_sequence"
OWNED BY "public"."m_business_partner"."id_business_partner";
SELECT setval('"public"."business_pa_ID_sequence"', 2, true);
SELECT setval('"public"."cabang_bank_ID_sequence"', 4, true);
SELECT setval('"public"."cash_bank_ID_sequence"', 3, true);
SELECT setval('"public"."cob_ID_sequence"', 16, true);
ALTER SEQUENCE "public"."coverage_ID_sequence"
OWNED BY "public"."coverage"."id_coverage";
SELECT setval('"public"."coverage_ID_sequence"', 23, true);
SELECT setval('"public"."coverage_mop_id_sequence"', 12, true);
SELECT setval('"public"."currency_forecast_ID_sequence"', 2, false);
SELECT setval('"public"."data_klaim_ID_sequence"', 2, false);
SELECT setval('"public"."desa_id_sequence"', 2, false);
ALTER SEQUENCE "public"."direct_ID_sequence"
OWNED BY "public"."m_direct"."id_direct";
SELECT setval('"public"."direct_ID_sequence"', 2, true);
SELECT setval('"public"."dok_persyaratan_ajk_ID_sequence"', 2, false);
SELECT setval('"public"."dokumen_klaim_ID_sequence"', 2, false);
SELECT setval('"public"."dokumen_sppa_ID_sequence"', 21, true);
SELECT setval('"public"."field_sppa_ID_sequence"', 53, true);
SELECT setval('"public"."field_sppa_cob_ID_sequence"', 2, false);
ALTER SEQUENCE "public"."group_menu_ID_sequence"
OWNED BY "public"."ref_group_menu"."id";
SELECT setval('"public"."group_menu_ID_sequence"', 101, false);
SELECT setval('"public"."indikator_ID_sequence"', 4, true);
SELECT setval('"public"."introduction_ID_sequence"', 2, false);
SELECT setval('"public"."jabatan_ID_sequence"', 30, true);
SELECT setval('"public"."jenis_bank_ID_sequence"', 9, true);
SELECT setval('"public"."jenis_kelamin_ID_sequence"', 2, false);
SELECT setval('"public"."jenis_klaim_ID_sequence"', 9, true);
SELECT setval('"public"."karyawan_ID_sequence"', 37, true);
SELECT setval('"public"."kategori_as_ID_sequence"', 4, true);
SELECT setval('"public"."kecamatan_id_sequence"', 2, false);
SELECT setval('"public"."klaim_ID_sequence"', 2, false);
SELECT setval('"public"."klasifikasi_klaim_ID_sequence"', 4, true);
SELECT setval('"public"."kota_ID_sequence"', 2, false);
SELECT setval('"public"."kota_id_sequence"', 2, true);
ALTER SEQUENCE "public"."level_otorisasi_ID_sequence"
OWNED BY "public"."level_otorisasi"."id_level_otorisasi";
SELECT setval('"public"."level_otorisasi_ID_sequence"', 8, true);
ALTER SEQUENCE "public"."level_user_ID_sequence"
OWNED BY "public"."level_user"."id_level_user";
SELECT setval('"public"."level_user_ID_sequence"', 4, true);
SELECT setval('"public"."lob_ID_sequence"', 61, true);
ALTER SEQUENCE "public"."loss_ID_sequence"
OWNED BY "public"."m_loss_adjuster"."id_loss_adjuster";
SELECT setval('"public"."loss_ID_sequence"', 11, true);
ALTER SEQUENCE "public"."m_field_sppa_prop_id_field_sppa_prop_seq"
OWNED BY "public"."m_field_sppa_prop"."id_field_sppa_prop";
SELECT setval('"public"."m_field_sppa_prop_id_field_sppa_prop_seq"', 79, true);
ALTER SEQUENCE "public"."m_name_management_id_name_management_seq"
OWNED BY "public"."m_name_management"."id_name_management";
SELECT setval('"public"."m_name_management_id_name_management_seq"', 2, false);
ALTER SEQUENCE "public"."m_sppa_field_spec_id_sppa_field_spec_seq"
OWNED BY "public"."m_sppa_field_spec"."id_sppa_field_spec";
SELECT setval('"public"."m_sppa_field_spec_id_sppa_field_spec_seq"', 83, true);
ALTER SEQUENCE "public"."menu_ID_sequence"
OWNED BY "public"."ref_menu"."id";
SELECT setval('"public"."menu_ID_sequence"', 135, true);
SELECT setval('"public"."misi_ID_sequence"', 2, false);
ALTER SEQUENCE "public"."mop_id_mop_seq"
OWNED BY "public"."mop"."id_mop";
SELECT setval('"public"."mop_id_mop_seq"', 6, true);
SELECT setval('"public"."nasabah_ID_sequence"', 13, true);
SELECT setval('"public"."negara_ID_sequence"', 4, true);
SELECT setval('"public"."parameter_scoring_ID_sequence"', 26, true);
SELECT setval('"public"."pembayaran_klaim_ID_sequence"', 2, false);
SELECT setval('"public"."polis_ID_sequence"', 2, false);
ALTER SEQUENCE "public"."privilage_ID_sequence"
OWNED BY "public"."privilage"."id_privillage";
SELECT setval('"public"."privilage_ID_sequence"', 3, true);
SELECT setval('"public"."produk_ID_sequence"', 2, false);
SELECT setval('"public"."produk_title_ID_sequence"', 2, false);
SELECT setval('"public"."provinsi_ID_sequence"', 2, false);
SELECT setval('"public"."provinsi_id_sequence"', 2, true);
SELECT setval('"public"."relasi_cob_lob_ID_sequence"', 61, true);
SELECT setval('"public"."restitusi_ID_sequence"', 2, false);
ALTER SEQUENCE "public"."role_ID_sequence"
OWNED BY "public"."role"."id_role";
SELECT setval('"public"."role_ID_sequence"', 3, true);
SELECT setval('"public"."scoring_asuransi_ID_sequence"', 2, false);
SELECT setval('"public"."sob_ID_sequence"', 11, true);
SELECT setval('"public"."sppa_ID_sequence"', 2, false);
SELECT setval('"public"."sppa_quotation_id_sequence"', 40, true);
SELECT setval('"public"."status_klaim_ID_sequence"', 12, true);
SELECT setval('"public"."subtitle_management_ID_sequence"', 14, true);
SELECT setval('"public"."termin_pembayaran_ID_sequence"', 3, true);
SELECT setval('"public"."tipe_as_ID_sequence"', 5, true);
SELECT setval('"public"."tipe_cob_ID_sequence"', 8, true);
SELECT setval('"public"."tipe_klaim_ID_sequence"', 4, true);
SELECT setval('"public"."title_management_ID_sequence"', 4, true);
SELECT setval('"public"."tr_endorsment_id_sequence"', 4, true);
ALTER SEQUENCE "public"."tr_histori_status_sob_id_histori_status_sob_seq"
OWNED BY "public"."tr_histori_status_sob"."id_histori_status_sob";
SELECT setval('"public"."tr_histori_status_sob_id_histori_status_sob_seq"', 47, true);
ALTER SEQUENCE "public"."tr_premi_adt_id_tr_premi_adt_seq"
OWNED BY "public"."tr_premi_adt"."id_tr_premi_adt";
SELECT setval('"public"."tr_premi_adt_id_tr_premi_adt_seq"', 4, true);
ALTER SEQUENCE "public"."tr_premi_id_tr_premi_seq"
OWNED BY "public"."tr_premi"."id_tr_premi";
SELECT setval('"public"."tr_premi_id_tr_premi_seq"', 54, true);
SELECT setval('"public"."user_ID_sequence"', 9, true);
SELECT setval('"public"."value_ID_sequence"', 2, false);
SELECT setval('"public"."visi_ID_sequence"', 2, true);
SELECT setval('"public"."wilayah_ID_sequence"', 2, false);

-- ----------------------------
-- Primary Key structure for table dok_persyaratan_ajk
-- ----------------------------
ALTER TABLE "public"."dok_persyaratan_ajk" ADD CONSTRAINT "dok_persyaratan_ajk_pkey" PRIMARY KEY ("id_dok_persyaratan_ajk");

-- ----------------------------
-- Primary Key structure for table dokumen_klaim
-- ----------------------------
ALTER TABLE "public"."dokumen_klaim" ADD CONSTRAINT "dokumen_klaim_pkey" PRIMARY KEY ("id_dokumen_klaim");

-- ----------------------------
-- Primary Key structure for table dokumen_sppa
-- ----------------------------
ALTER TABLE "public"."dokumen_sppa" ADD CONSTRAINT "dokumen_sppa_pkey" PRIMARY KEY ("id_dokumen_sppa");

-- ----------------------------
-- Primary Key structure for table field_sppa_cob
-- ----------------------------
ALTER TABLE "public"."field_sppa_cob" ADD CONSTRAINT "field_sppa_cob_pkey" PRIMARY KEY ("id_field_sppa_cob");

-- ----------------------------
-- Primary Key structure for table m_asuransi
-- ----------------------------
ALTER TABLE "public"."m_asuransi" ADD CONSTRAINT "m_asuransi_pkey" PRIMARY KEY ("id_asuransi");

-- ----------------------------
-- Primary Key structure for table m_bagian
-- ----------------------------
ALTER TABLE "public"."m_bagian" ADD CONSTRAINT "m_bagian_pkey" PRIMARY KEY ("id_bagian");

-- ----------------------------
-- Primary Key structure for table m_bank
-- ----------------------------
ALTER TABLE "public"."m_bank" ADD CONSTRAINT "m_bank_pkey" PRIMARY KEY ("id_bank");

-- ----------------------------
-- Primary Key structure for table m_cabang_bank
-- ----------------------------
ALTER TABLE "public"."m_cabang_bank" ADD CONSTRAINT "m_cabang_bank_pkey" PRIMARY KEY ("id_cabang_bank");

-- ----------------------------
-- Primary Key structure for table m_cashbank
-- ----------------------------
ALTER TABLE "public"."m_cashbank" ADD CONSTRAINT "m_cashbank_pkey" PRIMARY KEY ("id_cashbank");

-- ----------------------------
-- Primary Key structure for table m_cob
-- ----------------------------
ALTER TABLE "public"."m_cob" ADD CONSTRAINT "m_cob_pkey" PRIMARY KEY ("id_cob");

-- ----------------------------
-- Primary Key structure for table m_currency_forecast
-- ----------------------------
ALTER TABLE "public"."m_currency_forecast" ADD CONSTRAINT "m_currency_forecast_pkey" PRIMARY KEY ("id_currency_forecast");

-- ----------------------------
-- Primary Key structure for table m_desa
-- ----------------------------
ALTER TABLE "public"."m_desa" ADD CONSTRAINT "m_kota_copy1_pkey1" PRIMARY KEY ("id_desa");

-- ----------------------------
-- Primary Key structure for table m_field_sppa
-- ----------------------------
ALTER TABLE "public"."m_field_sppa" ADD CONSTRAINT "m_field_sppa_pkey" PRIMARY KEY ("id_field_sppa");

-- ----------------------------
-- Primary Key structure for table m_field_sppa_prop
-- ----------------------------
ALTER TABLE "public"."m_field_sppa_prop" ADD CONSTRAINT "m_field_sppa_prop_pk" PRIMARY KEY ("id_field_sppa_prop");

-- ----------------------------
-- Primary Key structure for table m_indikator
-- ----------------------------
ALTER TABLE "public"."m_indikator" ADD CONSTRAINT "m_indikator_pkey" PRIMARY KEY ("id_indikator");

-- ----------------------------
-- Primary Key structure for table m_introduction
-- ----------------------------
ALTER TABLE "public"."m_introduction" ADD CONSTRAINT "m_introduction_pkey" PRIMARY KEY ("id_introduction");

-- ----------------------------
-- Primary Key structure for table m_jabatan
-- ----------------------------
ALTER TABLE "public"."m_jabatan" ADD CONSTRAINT "m_jabatan_pkey" PRIMARY KEY ("id_jabatan");

-- ----------------------------
-- Primary Key structure for table m_jenis_bank
-- ----------------------------
ALTER TABLE "public"."m_jenis_bank" ADD CONSTRAINT "m_jenis_bank_pkey" PRIMARY KEY ("id_jenis_bank");

-- ----------------------------
-- Primary Key structure for table m_jenis_klaim
-- ----------------------------
ALTER TABLE "public"."m_jenis_klaim" ADD CONSTRAINT "m_jenis_klaim_pkey" PRIMARY KEY ("id_jenis_klaim");

-- ----------------------------
-- Primary Key structure for table m_karyawan
-- ----------------------------
ALTER TABLE "public"."m_karyawan" ADD CONSTRAINT "m_karyawan_pkey" PRIMARY KEY ("id_karyawan");

-- ----------------------------
-- Primary Key structure for table m_kategori_as
-- ----------------------------
ALTER TABLE "public"."m_kategori_as" ADD CONSTRAINT "m_kategori_as_pkey" PRIMARY KEY ("id_kategori_as");

-- ----------------------------
-- Primary Key structure for table m_kecamatan
-- ----------------------------
ALTER TABLE "public"."m_kecamatan" ADD CONSTRAINT "m_kota_copy1_pkey" PRIMARY KEY ("id_kecamatan");

-- ----------------------------
-- Primary Key structure for table m_klasifikasi_klaim
-- ----------------------------
ALTER TABLE "public"."m_klasifikasi_klaim" ADD CONSTRAINT "m_klasifikasi_klaim_pkey" PRIMARY KEY ("id_klasifikasi_klaim");

-- ----------------------------
-- Primary Key structure for table m_kota
-- ----------------------------
ALTER TABLE "public"."m_kota" ADD CONSTRAINT "m_kota_pkey" PRIMARY KEY ("id_kota");

-- ----------------------------
-- Primary Key structure for table m_lob
-- ----------------------------
ALTER TABLE "public"."m_lob" ADD CONSTRAINT "m_lob_pkey" PRIMARY KEY ("id_lob");

-- ----------------------------
-- Primary Key structure for table m_misi
-- ----------------------------
ALTER TABLE "public"."m_misi" ADD CONSTRAINT "m_misi_pkey" PRIMARY KEY ("id_misi");

-- ----------------------------
-- Primary Key structure for table m_name_management
-- ----------------------------
ALTER TABLE "public"."m_name_management" ADD CONSTRAINT "m_name_management_pk" PRIMARY KEY ("id_name_management");

-- ----------------------------
-- Primary Key structure for table m_nasabah
-- ----------------------------
ALTER TABLE "public"."m_nasabah" ADD CONSTRAINT "m_nasabah_pkey" PRIMARY KEY ("id_nasabah");

-- ----------------------------
-- Primary Key structure for table m_negara
-- ----------------------------
ALTER TABLE "public"."m_negara" ADD CONSTRAINT "m_negara_pkey" PRIMARY KEY ("id_negara");

-- ----------------------------
-- Primary Key structure for table m_parameter_scoring
-- ----------------------------
ALTER TABLE "public"."m_parameter_scoring" ADD CONSTRAINT "m_parameter_scoring_pkey" PRIMARY KEY ("id_parameter_scoring");

-- ----------------------------
-- Primary Key structure for table m_provinsi
-- ----------------------------
ALTER TABLE "public"."m_provinsi" ADD CONSTRAINT "m_provinsi_pkey" PRIMARY KEY ("id_provinsi");

-- ----------------------------
-- Primary Key structure for table m_sob
-- ----------------------------
ALTER TABLE "public"."m_sob" ADD CONSTRAINT "m_sob_pkey" PRIMARY KEY ("id_sob");

-- ----------------------------
-- Primary Key structure for table m_sppa_field_spec
-- ----------------------------
ALTER TABLE "public"."m_sppa_field_spec" ADD CONSTRAINT "m_sppa_field_spec_pk" PRIMARY KEY ("id_sppa_field_spec");

-- ----------------------------
-- Primary Key structure for table m_status_klaim
-- ----------------------------
ALTER TABLE "public"."m_status_klaim" ADD CONSTRAINT "m_stat_pkey" PRIMARY KEY ("id_status_klaim");

-- ----------------------------
-- Primary Key structure for table m_subtitle_management
-- ----------------------------
ALTER TABLE "public"."m_subtitle_management" ADD CONSTRAINT "m_subtitle_management_pkey" PRIMARY KEY ("id_subtitle_management");

-- ----------------------------
-- Primary Key structure for table m_tipe_as
-- ----------------------------
ALTER TABLE "public"."m_tipe_as" ADD CONSTRAINT "m_tipe_as_pkey" PRIMARY KEY ("id_tipe_as");

-- ----------------------------
-- Primary Key structure for table m_tipe_cob
-- ----------------------------
ALTER TABLE "public"."m_tipe_cob" ADD CONSTRAINT "m_tipe_cob_pkey" PRIMARY KEY ("id_tipe_cob");

-- ----------------------------
-- Primary Key structure for table m_tipe_klaim
-- ----------------------------
ALTER TABLE "public"."m_tipe_klaim" ADD CONSTRAINT "m_tipe_klaim_pkey" PRIMARY KEY ("id_tipe_klaim");

-- ----------------------------
-- Primary Key structure for table m_title_management
-- ----------------------------
ALTER TABLE "public"."m_title_management" ADD CONSTRAINT "m_title_management_pkey" PRIMARY KEY ("id_title_management");

-- ----------------------------
-- Primary Key structure for table m_user
-- ----------------------------
ALTER TABLE "public"."m_user" ADD CONSTRAINT "m_user_pkey" PRIMARY KEY ("id_user");

-- ----------------------------
-- Primary Key structure for table m_value
-- ----------------------------
ALTER TABLE "public"."m_value" ADD CONSTRAINT "m_value_pkey" PRIMARY KEY ("id_value");

-- ----------------------------
-- Primary Key structure for table m_visi
-- ----------------------------
ALTER TABLE "public"."m_visi" ADD CONSTRAINT "m_visi_pkey" PRIMARY KEY ("id_visi");

-- ----------------------------
-- Primary Key structure for table m_wilayah
-- ----------------------------
ALTER TABLE "public"."m_wilayah" ADD CONSTRAINT "m_wilayah_pkey" PRIMARY KEY ("id_wilayah");

-- ----------------------------
-- Primary Key structure for table ref_group_menu
-- ----------------------------
ALTER TABLE "public"."ref_group_menu" ADD CONSTRAINT "ref_group_menu_pk" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table ref_menu
-- ----------------------------
ALTER TABLE "public"."ref_menu" ADD CONSTRAINT "ref_menu_pk" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table relasi_cob_lob
-- ----------------------------
ALTER TABLE "public"."relasi_cob_lob" ADD CONSTRAINT "relasi_cob_lob_pkey" PRIMARY KEY ("id_relasi_cob_lob");

-- ----------------------------
-- Primary Key structure for table scoring_asuransi
-- ----------------------------
ALTER TABLE "public"."scoring_asuransi" ADD CONSTRAINT "scoring_asuransi_pkey" PRIMARY KEY ("id_scoring_as");

-- ----------------------------
-- Primary Key structure for table tr_approve_sppa
-- ----------------------------
ALTER TABLE "public"."tr_approve_sppa" ADD CONSTRAINT "tr_approve_sppa_pkey" PRIMARY KEY ("id_approve_sppa");

-- ----------------------------
-- Primary Key structure for table tr_data_klaim
-- ----------------------------
ALTER TABLE "public"."tr_data_klaim" ADD CONSTRAINT "tr_data_klaim_pkey" PRIMARY KEY ("id_data_klaim");

-- ----------------------------
-- Primary Key structure for table tr_klaim
-- ----------------------------
ALTER TABLE "public"."tr_klaim" ADD CONSTRAINT "tr_klaim_pkey" PRIMARY KEY ("id_klaim");

-- ----------------------------
-- Primary Key structure for table tr_pembayaran_klaim
-- ----------------------------
ALTER TABLE "public"."tr_pembayaran_klaim" ADD CONSTRAINT "tr_pembayaran_klaim_pkey" PRIMARY KEY ("id_pembayaran_klaim");

-- ----------------------------
-- Primary Key structure for table tr_polis
-- ----------------------------
ALTER TABLE "public"."tr_polis" ADD CONSTRAINT "tr_polis_pkey" PRIMARY KEY ("id_polis");

-- ----------------------------
-- Primary Key structure for table tr_restitusi
-- ----------------------------
ALTER TABLE "public"."tr_restitusi" ADD CONSTRAINT "tr_restitusi_pkey" PRIMARY KEY ("id_restitusi");

-- ----------------------------
-- Primary Key structure for table tr_sppa_quotation
-- ----------------------------
ALTER TABLE "public"."tr_sppa_quotation" ADD CONSTRAINT "tr_sppa_quotation_pkey" PRIMARY KEY ("id_sppa_quotation");

-- ----------------------------
-- Primary Key structure for table tr_termin_pembayaran
-- ----------------------------
ALTER TABLE "public"."tr_termin_pembayaran" ADD CONSTRAINT "tr_termin_pembayaran_pkey" PRIMARY KEY ("id_termin_pembayaran");
