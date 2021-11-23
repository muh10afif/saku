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

 Date: 19/05/2021 18:19:50
*/


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
-- Records of ref_menu
-- ----------------------------
INSERT INTO "public"."ref_menu" VALUES (76, 11, 'Negara', '/master/negara', 16, 1, '2021-05-17 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (128, 115, 'Entry MOP', 'mop', 1, 1, '2021-05-19 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (129, 3, 'Master Home', '#', 7, 1, '2021-05-19 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (118, 3, 'Client Database', '/source_business', 6, 1, '2021-05-17 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (73, 11, 'Kota', '/master/kota', 13, 1, '2021-05-11 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (60, 3, 'Master Technical', '#', 1, 1, '2021-05-11 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (68, 120, 'Jabatan', '/jabatan/admin', 2, 1, '2021-05-11 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (62, 120, 'Bagian', '/bagian/admin', 1, 1, '2021-05-11 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (70, 120, 'Karyawan ', '/karyawan ', 3, 1, '2021-05-11 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (80, 11, 'Provinsi', '/master/provinsi', 20, 1, '2021-05-17 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (88, 120, 'User', '/user/admin', 28, 1, '2021-05-17 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (116, 115, 'Entry COB and LOB', 'cob_lob', 2, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (42, 23, 'Binding Slip', 'binding', 3, 1, '2021-05-19 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (90, 129, 'Visi', '/master/visi', 2, 1, '2021-05-19 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (74, 129, 'misi', '/master/misi', 2, 1, '2021-05-19 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (89, 129, 'Value', '/master/value', 3, 1, '2021-05-19 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (87, 129, 'Title Management', '/master/title_management', 4, 1, '2021-05-19 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (83, 129, 'Subtitle Manajemen', '/master/subtitle', 5, 1, '2021-05-19 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (67, 129, 'Introduction', '/master/introduction', 1, 1, '2021-05-19 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (126, 118, 'Loss Adjuster', 'lost_adjuster', 6, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (125, 118, 'Direct', 'direct', 4, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (124, 118, 'Business Partner', 'business_partner', 4, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (123, 118, 'Agent', 'agent', 3, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (122, 118, 'Insured', 'nasabah', 2, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (121, 118, 'Insurer', 'master/asuransi', 1, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (115, 3, 'Class Of Business', '#', 5, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (113, 0, 'Restitusi', '/ajk/restitusi', 4, 1, '2021-04-24 00:00:00', 'ajk', 'icon-website-1');
INSERT INTO "public"."ref_menu" VALUES (111, 113, 'Input Pembayaran', '/ajk/restitusi/bayar', 5, 1, '2021-04-24 00:00:00', 'ajk', '');
INSERT INTO "public"."ref_menu" VALUES (110, 113, 'Posting', '/ajk/restitusi/posting', 4, 1, '2021-04-24 00:00:00', 'ajk', '');
INSERT INTO "public"."ref_menu" VALUES (109, 113, 'Enquiry', '/ajk/restitusi/enquiry', 3, 1, '2021-04-24 00:00:00', 'ajk', '');
INSERT INTO "public"."ref_menu" VALUES (108, 113, 'Cetak Nota Restitusi', '/ajk/restitusi/cetak', 2, 1, '2021-04-24 00:00:00', 'ajk', '');
INSERT INTO "public"."ref_menu" VALUES (107, 113, 'Aplikasi Restitusi', '/ajk/restitusi', 1, 1, '2021-04-24 00:00:00', 'ajk', '');
INSERT INTO "public"."ref_menu" VALUES (106, 0, 'Klaim', '/ajk/klaim', 3, 1, '2021-04-24 00:00:00', 'ajk', 'icon-hammer');
INSERT INTO "public"."ref_menu" VALUES (105, 106, 'Input Pembayaran', '/ajk/klaim/bayar', 5, 1, '2021-04-24 00:00:00', 'ajk', '');
INSERT INTO "public"."ref_menu" VALUES (104, 106, 'Posting', '/ajk/klaim/posting', 4, 1, '2021-04-24 00:00:00', 'ajk', '');
INSERT INTO "public"."ref_menu" VALUES (103, 106, 'Enquiry', '/ajk/klaim/enquiry', 3, 1, '2021-04-24 00:00:00', 'ajk', '');
INSERT INTO "public"."ref_menu" VALUES (102, 106, 'Cetak Nota Klaim', '/ajk/klaim/cetak', 2, 1, '2021-04-24 00:00:00', 'ajk', '');
INSERT INTO "public"."ref_menu" VALUES (101, 106, 'Aplikasi Klaim', '/ajk/klaim', 1, 1, '2021-04-24 00:00:00', 'ajk', '');
INSERT INTO "public"."ref_menu" VALUES (100, 0, 'Polis', '/ajk/polis', 2, 1, '2021-04-24 00:00:00', 'ajk', 'icon-spread');
INSERT INTO "public"."ref_menu" VALUES (99, 100, 'Posting', '/ajk/polis/posting', 4, 1, '2021-04-24 00:00:00', 'ajk', '');
INSERT INTO "public"."ref_menu" VALUES (98, 100, 'Enquiry', '/ajk/polis/enquiry', 3, 1, '2021-04-24 00:00:00', 'ajk', '');
INSERT INTO "public"."ref_menu" VALUES (97, 100, 'Cetak Sertifikat', '/ajk/polis/cetak', 2, 1, '2021-04-24 00:00:00', 'ajk', '');
INSERT INTO "public"."ref_menu" VALUES (96, 100, 'Aplikasi Polis', '/ajk/polis', 1, 1, '2021-04-24 00:00:00', 'ajk', '');
INSERT INTO "public"."ref_menu" VALUES (94, 0, 'Dashboard', '/ajk/dashboard', 1, 1, '2021-04-24 00:00:00', 'ajk', 'icon-accelerator');
INSERT INTO "public"."ref_menu" VALUES (93, 11, 'Currency Forecast', '/master_ref/currency_rate', 3, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (92, 11, 'Cash/Bank', 'cashbank', 2, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (91, 11, 'Wilayah', '/master_ref/wilayah', 1, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (86, 60, 'Tipe Klaim', 'tipe_klaim', 26, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (85, 60, 'Tipe COB', 'type_cob', 25, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (84, 60, 'Tipe Asuransi', '/master/tipe_as', 24, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (82, 60, 'Status Klaim', 'status_klaim', 22, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (81, 60, 'SOB', '/master/sob', 21, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (77, 60, 'Parameter Scoring', '/master/parameter_scoring', 17, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (72, 60, 'Klasifikasi Klaim', 'klasifikasi_klaim', 12, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (71, 60, 'Kategori Asuransi', '/master/kategori_as', 11, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (69, 60, 'Jenis Klaim', 'jenis_klaim', 9, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (66, 60, 'Indikator', 'indikator', 6, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (65, 60, 'Field SPPA', 'field_sppa', 5, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (64, 60, 'Cabang Bank', 'cabang_bank', 4, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (63, 60, 'Bank', 'list_bank', 3, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (59, 9, 'Client Database', '/client_database', 1, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (57, 4, 'AJK', '/ajk/dashboard', 4, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (56, 8, 'User Role', '/role/admin/1', 2, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (55, 23, 'Entry SPPA', 'entry_sppa', 1, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (52, 2, 'Change Password', '/change_password', 3, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (51, 25, 'Delete Transaction', 'finance/delete_tr', 5, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (50, 25, 'Closing Book', 'finance/closing_book', 4, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (49, 25, 'Journal Entry', 'finance/j_entry', 3, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (48, 25, 'Production and Payment', 'finance/p_and_p', 2, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (47, 25, 'Quick Positing', 'finance/quick_posting', 1, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (46, 24, 'Upload Detail claim', '/outgoing/upload', 2, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (45, 24, 'Entry Claim Documents', '/outgoing/entry', 1, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (44, 23, 'Policy Issue', '/incoming/policy_issue', 5, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (40, 8, 'User Data', '/user/admin', 1, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (39, 22, 'Cash Flow', '#', 3, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (38, 22, 'Laba/Rugi', '#', 2, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (37, 22, 'Neraca', '#', 1, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (36, 5, 'Cash Flow', '/report/cash_flow', 11, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (35, 5, 'Profit and Loss Statement', '/report/profit', 10, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (34, 5, 'General Ledger', '/report/general', 9, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (33, 5, 'Trial Balance', '/report/trial', 8, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (32, 5, 'Journal Posting', '/report/journal', 7, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (31, 5, 'Alert of Account Production Placement', '/report/alert', 6, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (30, 5, 'Aging Schedule of OS Statement', '/report/aging', 5, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (29, 5, 'Mutasi Kas/Bank', '/report/mutasi_kas_bank', 4, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (28, 5, 'Bank Account', '/report/bank_account', 3, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (27, 5, 'Pipeline', '/report/pipeline', 2, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (26, 5, 'Production Report', '/report/production_report', 1, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (25, 4, 'Finance and Accounting', '#', 3, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (24, 4, 'Outgoing', '#', 2, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (23, 4, 'Incoming', '#', 1, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (22, 12, 'Currency Forecast', '#', 3, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (21, 12, 'Master Cash/Bank', '#', 2, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (20, 12, 'Table Wilayah', '#', 1, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (14, 14, 'Set Business Specifications', '#', 2, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (13, 14, 'Entry COB and LOB', '#', 1, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (11, 3, 'Master References', '#', 3, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (8, 2, 'Users Administration', '#', 2, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (7, 2, 'Menu Administration', '/menu/admin', 1, 1, '2021-04-24 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (5, 0, 'REPORTS', '#', 5, 1, '2021-04-24 00:00:00', 'home', 'icon-todolist');
INSERT INTO "public"."ref_menu" VALUES (4, 0, 'TRANSACTION', '#', 4, 1, '2021-04-24 00:00:00', 'home', 'icon-paper-pen');
INSERT INTO "public"."ref_menu" VALUES (3, 0, 'MASTER TABLES', '#', 3, 1, '2021-04-24 00:00:00', 'home', 'icon-portable-pc');
INSERT INTO "public"."ref_menu" VALUES (2, 0, 'PREFERENCE', '#', 2, 1, '2021-04-24 00:00:00', 'home', 'icon-setting-1');
INSERT INTO "public"."ref_menu" VALUES (1, 0, 'HOME', '/dashboard', 1, 1, '2021-04-24 00:00:00', 'home', 'icon-home');
INSERT INTO "public"."ref_menu" VALUES (10, 3, 'Finance and Accounting', '#', 6, 1, '2021-05-11 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (120, 3, 'User dan Kepegawaian', '#', 6, 1, '2021-05-11 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (117, 115, 'Set Business Specifications', 'business_specifications', 3, 1, '2021-05-10 00:00:00', 'home', '');
INSERT INTO "public"."ref_menu" VALUES (41, 23, 'SPPA Approval and Quotation', '/approval', 2, 1, '2021-05-19 00:00:00', 'home', '');

-- ----------------------------
-- Primary Key structure for table ref_menu
-- ----------------------------
ALTER TABLE "public"."ref_menu" ADD CONSTRAINT "ref_menu_pk" PRIMARY KEY ("id");
