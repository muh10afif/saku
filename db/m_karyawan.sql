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

 Date: 24/06/2021 15:06:28
*/


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
  "id_desa" int8,
  "id_negara" int8
)
;

-- ----------------------------
-- Records of m_karyawan
-- ----------------------------
INSERT INTO "public"."m_karyawan" VALUES (7, 'TRIJOKO PRIHANDONO', 'DSN MUNCAR, RT. 001/001 MUNCAR SUSUKAN - SALATIGA', 'trijoko@broker-legowo.com', '082135307057', '3322031210860004 	', 12, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (11, 'SYARIF NURHAYAT', 'Jl. Sukamanah. No. 326/8A Rt.007/008 Kebon Jeruk Andir Bandung', 'syarifnur.cecep@gmail.com', '08112498777', '3273050203670003', 10, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (18, 'MUHAMAD AFIF', 'cingcin permata indah blok H no. 202 rt/rw 007/018 kel/desa cingcin kec. soreang', 'muh10afif@gmail.com', '081220279652', '3204371002950001 	', 25, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (8, 'YUDASTRA EKA MARINDRA', 'Kadipuro RT 003 RW 024 Kel. Sinduharjo Kec. Ngaglik', 'yudastra.e.m84@gmail.com', '081227470880', '3404061809840002', 13, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (20, 'RIZKY FAJAR ANUGRAH', 'Jl. Gatot Subroto No. 108 RT 002 RW 008 Kel. Lingkar Selatan Kec. Lengkong', 'rizkyfajaranugrah2@gmail.com', '081210438087', '3273132704000003', 26, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (27, 'RANDI RESTU MOERTI', 'KP. GELAR PADANG RT.001/001 KEL. CILONGSONG KEC. TANGGEUNG', 'randi@gmail.com', '085320679940', '3203191505940001', 27, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (30, 'YUSUP', '-', '-', '085559723812', '3203030507900013', 28, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (12, 'WAHYUDI', 'Kp. Pabuaran RT 007 RW 005 Kel. Pabuaran Kec. Bojong Gede', 'wahyudiapkrindo@gmail.com', '08180266627', '3201130705820006', 14, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (14, 'AGNIA NOVIANI', 'Kp. Kahuripan RT 007 RW 005 Kel. Sukadamai Kec. Dramaga', 'agnianoviani11@gmail.com', '08112105291', '3201295411970003', 15, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (16, 'KEVIN LIA AUDIANA', 'Banjarmlati RT 003 RW 001 Kel. Banjaragung Kec. Balongpanggang', 'kevinliaaudiana1@gmail.com', '087869123931', '3525024810960001', 16, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (25, 'SANDI AHMAD RAMDANI', 'Jl. Soekarno Hatta No. 616 RT 001 RW 001 Kel. Sekejati Kec. Buah Batu', 'sandyahmadramdani@gmail.com', '085775120922', '3273221908950001', 18, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (4, 'RACHMAT FAUZI', 'Taman Depok Permai B 1 No.2 RT. 002 RW 023 Kel. Sukamaju Kec. Cilodong', 'rachmat.fauzi@broker-legowo.com', '082112710105', '3276050907740005', 8, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (6, 'BENNY MARDIYAWAN', 'Kampung Jati No. 53 RT 005 RW 003 Kel. Jati Kec. Pulogadung', 'benny@broker-legowo.com', '0811910067', '3175022903820003', 9, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (21, 'EDWIN SYAHRIZAL', 'Taman Kopo Indah 1, Blok 1 No. 115 Rt.003/010. Margahayu Tengah', 'emailedwin@gmail.com', '08112317778', '3204092508840005 	', 11, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (23, 'IIM SAIMAN', 'Dusun Kaliwon RT 005 RW 001 Kel. Cikeleng Kec. Japara', 'azzahraphotography88@gmail.com', '085794666644', '3208210305880002', 18, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (5, 'RATNA INDRIATI HINDARTO', 'Jl. Dewi Sartika A/14 RT 009 RW 003 Kel. Janti Kec. Waru', 'nana@broker-legowo@gmail.com', '08112460095', '3515186309800011 	', 19, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (31, 'CECEP JAENUDIN MZ', 'Jl. Sukarajin II No. 18-A RT 004 RW 012 Kel. Cikutra Kec. Cibeunying Kidul', 'mzjaenudin25@gmail.com', '081395555960', '3273142512930001', 28, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (24, 'DYAH KUSUMASTUTI', 'Kp. Sadang RT 004 RW 011 Kel.Cinunuk Kec. Cileunyi', 'dyahkusumastuti95.dk@gmail.com', '089694463765', '3204054711970018', 18, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (32, 'FEBRI RIDHA TRIYANA', 'Jl. Golf III No. 57 Cisaranten Wetan RT 004 RW 001 Kel. Cirasanten Wetan Kec. Cinambo', 'febri.ridha18@gmail.com', '085315640202', '3273291802980002', 18, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (22, 'RAHMAT NURRIZKI SOLEHUDIN', 'Kp. Bojong Buah RT 001 RW 008 Kel. Cilampeni Kec. Ketapang', 'rahmat.nurrizki.rns@gmail.com', '081222210914', '3204110204950010', 17, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (10, 'AYALA CHANAYA KRISTOFENY', 'Jl. Sinar Jaya No IB RT 004 RW 007 Kel. Pisangan Timur Kec. Pulo Gadung', 'ayalachanaya@gmail.com', '081280484465', '3175026604010002', 21, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (9, 'ASYIFA RAKHMANIA', 'Gg. Sukamanah No. 308/8A Rt.007/008 Kebon Jeruk , Andir Kota Bandung', 'sifaaaa1@gmail.com', '085861127004', '3273056911970010 	', 20, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (13, 'WINDI APRILIYANI', 'Jl. Holis No. 53/81 RT 003 RW 003 Kel. Cibuntu Kec. Bandung Kulon', 'windyaprilia107@gmail.com', '087822828222', '3273044701990001', 22, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (15, 'RESI REGINA', 'Jl. Centeh No.05 RT 007 RW 010 Kel. Samoja Kec. Batununggal', 'rresirregina@gmail.com', '085795205549', '3273125910930004', 23, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (19, 'AWALLUDIN FAJAR MAULID', 'GG Indik No 196B/98 RT 001 RW 009 Kel. Cibadak Kec. Astana Anyar', 'fajarawalludin25@gmail.com', '089531722622', '3273100407980001', 26, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (33, 'RIDWAN', 'Kp. Pasir Hayam RT 002 RW 004 Desa/Kec. Pagelaran Kab. Cianjur', 'ridwanhanafi977@gmail.com', '085624036508', '3203180910030005', 27, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (34, 'CHOERUL', 'Mulyo Asih RT 002 RW 001 Kel. MulyoAsih Kec. Keluang', 'Choerulreza09@gmail.com', '085692947317', '160608140998001', 27, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (35, 'YUYU WAHYUDIN', 'KP. BOJONG SAYANG RT 01/ RW 04', 'ades92455@gmail.com', '089515658633', '3204320507570020', 27, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (36, 'SAEFUL ROHMAN', 'Kp. Pasir kalapa RT 02/RW 06 Peuteuy Condong Cibeber kab. Cianjur', 'bueukrohman00@gmail.com', '0859109976551', '3203030108000025', 27, '2021-05-27 00:00:00', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."m_karyawan" VALUES (17, 'NURUL AF''IDAH', 'Babakan Sentral RT 005 RW 005 Kel. Sukapura Kec. Kiaracondong', 'nurul.a147@gmail.com', '081553902322', '3273165407970001', 24, '2021-06-15 00:00:00', 2, 32, 3273, 3273150, 3273150002, NULL);

-- ----------------------------
-- Primary Key structure for table m_karyawan
-- ----------------------------
ALTER TABLE "public"."m_karyawan" ADD CONSTRAINT "m_karyawan_pkey" PRIMARY KEY ("id_karyawan");
