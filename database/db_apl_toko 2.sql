-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 26, 2023 at 03:32 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_apl_toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `app`
--

CREATE TABLE `app` (
  `id_app` int(11) NOT NULL,
  `app_nama` varchar(255) DEFAULT NULL,
  `package_name` varchar(255) DEFAULT NULL,
  `version_name` varchar(255) DEFAULT NULL,
  `version_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `app`
--

INSERT INTO `app` (`id_app`, `app_nama`, `package_name`, `version_name`, `version_code`) VALUES
(1, 'toko', 'id.toko', '1.0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `log_eror_callback_va`
--

CREATE TABLE `log_eror_callback_va` (
  `id` int(11) NOT NULL,
  `log` text DEFAULT NULL,
  `cdd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nik` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `master_kab`
--

CREATE TABLE `master_kab` (
  `NO_KAB` int(11) DEFAULT NULL,
  `NAMA_KAB` varchar(255) DEFAULT NULL,
  `NO_PROP` int(11) DEFAULT NULL,
  `ID_KAB` varchar(6) DEFAULT NULL,
  `ID_CITY_ONGKIR` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `master_kab`
--

INSERT INTO `master_kab` (`NO_KAB`, `NAMA_KAB`, `NO_PROP`, `ID_KAB`, `ID_CITY_ONGKIR`) VALUES
(15, 'WAROPEN', 91, '91#15', NULL),
(16, 'BOVEN DIGUL', 91, '91#16', NULL),
(17, 'MAPPI', 91, '91#17', NULL),
(18, 'ASMAT', 91, '91#18', NULL),
(19, 'SUPIORI', 91, '91#19', NULL),
(20, 'MAMBERAMO RAYA', 91, '91#20', NULL),
(21, 'MAMBERAMO TENGAH', 91, '91#21', NULL),
(22, 'YALIMO', 91, '91#22', NULL),
(23, 'LANNY JAYA', 91, '91#23', NULL),
(24, 'NDUGA', 91, '91#24', NULL),
(28, 'DEIYAI', 91, '91#28', NULL),
(1, 'SORONG', 92, '92#1', NULL),
(4, 'SORONG SELATAN', 92, '92#4', NULL),
(7, 'TELUK WONDAMA', 92, '92#7', NULL),
(10, 'MAYBRAT', 92, '92#10', NULL),
(8, 'SIMALUNGUN', 12, '12#8', NULL),
(11, 'DAIRI', 12, '12#11', NULL),
(15, 'PAKPAK BHARAT', 12, '12#15', NULL),
(16, 'HUMBANG HASUNDUTAN', 12, '12#16', NULL),
(21, 'PADANG LAWAS', 12, '12#21', NULL),
(23, 'LABUHANBATU UTARA', 12, '12#23', NULL),
(78, 'KOTA TASIKMALAYA', 32, '32#78', NULL),
(79, 'KOTA BANJAR', 32, '32#79', NULL),
(2, 'BANYUMAS', 33, '33#2', NULL),
(3, 'PURBALINGGA', 33, '33#3', NULL),
(15, 'GROBOGAN', 33, '33#15', NULL),
(72, 'KOTA SINGKAWANG', 61, '61#72', NULL),
(1, 'KOTAWARINGIN BARAT', 62, '62#1', NULL),
(2, 'KOTAWARINGIN TIMUR', 62, '62#2', NULL),
(3, 'KAPUAS', 62, '62#3', NULL),
(4, 'BARITO SELATAN', 62, '62#4', NULL),
(7, 'SERUYAN', 62, '62#7', NULL),
(10, 'GUNUNG MAS', 62, '62#10', NULL),
(12, 'MURUNG RAYA', 62, '62#12', NULL),
(71, 'KOTA PALANGKARAYA', 62, '62#71', NULL),
(1, 'TANAH LAUT', 63, '63#1', NULL),
(2, 'KOTABARU', 63, '63#2', NULL),
(3, 'BANJAR', 63, '63#3', NULL),
(4, 'BARITO KUALA', 63, '63#4', NULL),
(7, 'HULU SUNGAI TENGAH', 63, '63#7', NULL),
(9, 'TABALONG', 63, '63#9', NULL),
(11, 'BALANGAN', 63, '63#11', NULL),
(72, 'KOTA BANJAR BARU', 63, '63#72', NULL),
(3, 'BERAU', 64, '64#3', NULL),
(6, 'MALINAU', 64, '64#6', NULL),
(8, 'KUTAI TIMUR', 64, '64#8', NULL),
(10, 'TANA TIDUNG', 64, '64#10', NULL),
(72, 'KOTA SAMARINDA', 64, '64#72', NULL),
(1, 'BOLAANG MONGONDOW', 71, '71#1', NULL),
(3, 'KEPULAUAN SANGIHE', 71, '71#3', NULL),
(6, 'MINAHASA UTARA', 71, '71#6', NULL),
(8, 'BOLAANG MONGONDOW UTARA', 71, '71#8', NULL),
(10, 'BOLAANG MONGONDOW TIMUR', 71, '71#10', NULL),
(11, 'BOLAANG MONGONDOW SELATAN', 71, '71#11', NULL),
(73, 'KOTA TOMOHON', 71, '71#73', NULL),
(1, 'BANGGAI', 72, '72#1', NULL),
(4, 'TOLI TOLI', 72, '72#4', NULL),
(8, 'PARIGI MOUTONG', 72, '72#8', NULL),
(9, 'TOJO UNA-UNA', 72, '72#9', NULL),
(2, 'BULUKUMBA', 73, '73#2', NULL),
(4, 'JENEPONTO', 73, '73#4', NULL),
(8, 'BONE', 73, '73#8', NULL),
(11, 'BARRU', 73, '73#11', NULL),
(13, 'WAJO', 73, '73#13', NULL),
(14, 'SIDENRENG RAPANG', 73, '73#14', NULL),
(15, 'PINRANG', 73, '73#15', NULL),
(16, 'ENREKANG', 73, '73#16', NULL),
(17, 'LUWU', 73, '73#17', NULL),
(22, 'LUWU UTARA', 73, '73#22', NULL),
(26, 'TORAJA UTARA', 73, '73#26', NULL),
(73, 'KOTA PALOPO', 73, '73#73', NULL),
(3, 'MUNA', 74, '74#3', NULL),
(6, 'BOMBANA', 74, '74#6', NULL),
(8, 'KOLAKA UTARA', 74, '74#8', NULL),
(71, 'KOTA KENDARI', 74, '74#71', NULL),
(1, 'GORONTALO', 75, '75#1', NULL),
(4, 'PAHUWATO', 75, '75#4', NULL),
(71, 'KOTA GORONTALO', 75, '75#71', NULL),
(3, 'MAMASA', 76, '76#3', NULL),
(5, 'MAJENE', 76, '76#5', NULL),
(3, 'MALUKU TENGGARA BARAT', 81, '81#3', NULL),
(6, 'SERAM BAGIAN BARAT', 81, '81#6', NULL),
(8, 'MALUKU BARAT DAYA', 81, '81#8', NULL),
(71, 'KOTA AMBON', 81, '81#71', NULL),
(2, 'HALMAHERA TENGAH', 82, '82#2', NULL),
(71, 'KOTA TANGERANG', 36, '36#71', '456'),
(18, 'PANGANDARAN', 32, '32#18', NULL),
(9, 'NGADA', 53, '53#9', NULL),
(11, 'SUMBA TIMUR', 53, '53#11', NULL),
(2, 'SOLOK', 13, '13#2', NULL),
(3, 'MUARA ENIM', 16, '16#3', NULL),
(10, 'DHARMASRAYA', 13, '13#10', NULL),
(26, 'PEKALONGAN', 33, '33#26', NULL),
(78, 'KOTA SURABAYA', 35, '35#78', NULL),
(6, 'PURWOREJO', 33, '33#6', NULL),
(5, 'BARITO UTARA', 62, '62#5', NULL),
(6, 'KATINGAN', 62, '62#6', NULL),
(8, 'SUKAMARA', 62, '62#8', NULL),
(9, 'LAMANDAU', 62, '62#9', NULL),
(11, 'PULANG PISAU', 62, '62#11', NULL),
(13, 'BARITO TIMUR', 62, '62#13', NULL),
(5, 'TAPIN', 63, '63#5', NULL),
(6, 'HULU SUNGAI SELATAN', 63, '63#6', NULL),
(8, 'HULU SUNGAI UTARA', 63, '63#8', NULL),
(10, 'TANAH BUMBU', 63, '63#10', NULL),
(71, 'KOTA BANJARMASIN', 63, '63#71', NULL),
(1, 'PASER', 64, '64#1', NULL),
(2, 'KUTAI KERTANEGARA', 64, '64#2', NULL),
(4, 'BULUNGAN', 64, '64#4', NULL),
(5, 'NUNUKAN', 64, '64#5', NULL),
(7, 'KUTAI BARAT', 64, '64#7', NULL),
(9, 'PENAJAM PASER UTARA', 64, '64#9', NULL),
(71, 'KOTA BALIKPAPAN', 64, '64#71', NULL),
(73, 'KOTA TARAKAN', 64, '64#73', NULL),
(74, 'KOTA BONTANG', 64, '64#74', NULL),
(2, 'MINAHASA', 71, '71#2', NULL),
(4, 'KEPULAUAN TALAUD', 71, '71#4', NULL),
(5, 'MINAHASA SELATAN', 71, '71#5', NULL),
(7, 'MINAHASA TENGGARA', 71, '71#7', NULL),
(9, 'KEP. SIAU TAGULANDANG BIARO', 71, '71#9', NULL),
(71, 'KOTA MANADO', 71, '71#71', NULL),
(72, 'KOTA BITUNG', 71, '71#72', NULL),
(74, 'KOTA KOTAMOBAGU', 71, '71#74', NULL),
(2, 'POSO', 72, '72#2', NULL),
(3, 'DONGGALA', 72, '72#3', NULL),
(5, 'BUOL', 72, '72#5', NULL),
(6, 'MOROWALI', 72, '72#6', NULL),
(7, 'BANGGAI KEPULAUAN', 72, '72#7', NULL),
(10, 'SIGI', 72, '72#10', NULL),
(71, 'KOTA PALU', 72, '72#71', NULL),
(1, 'KEPULAUAN SELAYAR', 73, '73#1', NULL),
(3, 'BANTAENG', 73, '73#3', NULL),
(5, 'TAKALAR', 73, '73#5', NULL),
(6, 'GOWA', 73, '73#6', NULL),
(7, 'SINJAI', 73, '73#7', NULL),
(9, 'MAROS', 73, '73#9', NULL),
(10, 'PANGKAJENE KEPULAUAN', 73, '73#10', NULL),
(12, 'SOPPENG', 73, '73#12', NULL),
(18, 'TANA TORAJA', 73, '73#18', NULL),
(24, 'LUWU TIMUR', 73, '73#24', NULL),
(71, 'KOTA MAKASSAR', 73, '73#71', NULL),
(72, 'KOTA PARE PARE', 73, '73#72', NULL),
(1, 'KOLAKA', 74, '74#1', NULL),
(2, 'KONAWE', 74, '74#2', NULL),
(4, 'BUTON', 74, '74#4', NULL),
(5, 'KONAWE SELATAN', 74, '74#5', NULL),
(7, 'WAKATOBI', 74, '74#7', NULL),
(9, 'KONAWE UTARA', 74, '74#9', NULL),
(10, 'BUTON UTARA', 74, '74#10', NULL),
(72, 'KOTA BAU BAU', 74, '74#72', NULL),
(2, 'BOALEMO', 75, '75#2', NULL),
(3, 'BONE BOLANGO', 75, '75#3', NULL),
(5, 'GORONTALO UTARA', 75, '75#5', NULL),
(1, 'MAMUJU UTARA', 76, '76#1', NULL),
(2, 'MAMUJU', 76, '76#2', NULL),
(4, 'POLEWALI MANDAR', 76, '76#4', NULL),
(1, 'MALUKU TENGAH', 81, '81#1', NULL),
(2, 'MALUKU TENGGARA', 81, '81#2', NULL),
(4, 'BURU', 81, '81#4', NULL),
(5, 'SERAM BAGIAN TIMUR', 81, '81#5', NULL),
(7, 'KEPULAUAN ARU', 81, '81#7', NULL),
(9, 'BURU SELATAN', 81, '81#9', NULL),
(72, 'KOTA TUAL', 81, '81#72', NULL),
(1, 'HALMAHERA BARAT', 82, '82#1', NULL),
(3, 'HALMAHERA UTARA', 82, '82#3', NULL),
(5, 'ALOR', 53, '53#5', NULL),
(8, 'ACEH UTARA', 11, '11#8', NULL),
(9, 'SIMEULUE', 11, '11#9', NULL),
(11, 'BIREUEN', 11, '11#11', NULL),
(12, 'ACEH BARAT DAYA', 11, '11#12', NULL),
(14, 'ACEH JAYA', 11, '11#14', NULL),
(16, 'ACEH TAMIANG', 11, '11#16', NULL),
(17, 'BENER MERIAH', 11, '11#17', NULL),
(71, 'KOTA BANDA ACEH', 11, '11#71', NULL),
(74, 'KOTA LANGSA', 11, '11#74', NULL),
(1, 'TAPANULI TENGAH', 12, '12#1', NULL),
(3, 'TAPANULI SELATAN', 12, '12#3', NULL),
(5, 'LANGKAT', 12, '12#5', NULL),
(6, 'KARO', 12, '12#6', NULL),
(19, 'BATU BARA', 12, '12#19', NULL),
(20, 'PADANG LAWAS UTARA', 12, '12#20', NULL),
(24, 'NIAS UTARA', 12, '12#24', NULL),
(71, 'KOTA MEDAN', 12, '12#71', NULL),
(72, 'KOTA PEMATANG SIANTAR', 12, '12#72', NULL),
(76, 'KOTA TEBING TINGGI', 12, '12#76', NULL),
(78, 'KOTA GUNUNGSITOLI', 12, '12#78', NULL),
(3, 'SIJUNJUNG', 13, '13#3', NULL),
(4, 'TANAH DATAR', 13, '13#4', NULL),
(6, 'AGAM', 13, '13#6', NULL),
(7, 'LIMA PULUH KOTA', 13, '13#7', NULL),
(9, 'KEPULAUAN MENTAWAI', 13, '13#9', NULL),
(12, 'PASAMAN BARAT', 13, '13#12', NULL),
(72, 'KOTA SOLOK', 13, '13#72', NULL),
(73, 'KOTA SAWAHLUNTO', 13, '13#73', NULL),
(75, 'KOTA BUKITTINGGI', 13, '13#75', NULL),
(77, 'KOTA PARIAMAN', 13, '13#77', NULL),
(2, 'INDRAGIRI HULU', 14, '14#2', NULL),
(4, 'INDRAGIRI HILIR', 14, '14#4', NULL),
(5, 'PELALAWAN', 14, '14#5', NULL),
(71, 'KOTA TARAKAN', 65, '65#71', NULL),
(1, 'BULUNGAN', 65, '65#1', NULL),
(4, 'TANA TIDUNG', 65, '65#4', NULL),
(2, 'MALINAU', 65, '65#2', NULL),
(3, 'NUNUKAN', 65, '65#3', NULL),
(13, 'PESISIR BARAT', 18, '18#13', NULL),
(7, 'ROKAN HILIR', 14, '14#7', NULL),
(9, 'KUANTAN SINGINGI', 14, '14#9', NULL),
(10, 'KEPULAUAN MERANTI', 14, '14#10', NULL),
(72, 'KOTA DUMAI', 14, '14#72', NULL),
(2, 'MERANGIN', 15, '15#2', NULL),
(3, 'SAROLANGUN', 15, '15#3', NULL),
(5, 'MUARO JAMBI', 15, '15#5', NULL),
(7, 'TANJUNG JABUNG TIMUR', 15, '15#7', NULL),
(9, 'TEBO', 15, '15#9', NULL),
(71, 'KOTA JAMBI', 15, '15#71', NULL),
(1, 'OGAN KOMERING ULU', 16, '16#1', NULL),
(4, 'LAHAT', 16, '16#4', NULL),
(5, 'MUSI RAWAS', 16, '16#5', NULL),
(5, 'KEBUMEN', 33, '33#5', NULL),
(6, 'MUSI BANYUASIN', 16, '16#6', NULL),
(8, 'OGAN KOMERING ULU TIMUR', 16, '16#8', NULL),
(11, 'EMPAT LAWANG', 16, '16#11', NULL),
(2, 'REJANG LEBONG', 17, '17#2', NULL),
(5, 'SELUMA', 17, '17#5', NULL),
(6, 'MUKO MUKO', 17, '17#6', NULL),
(8, 'KEPAHIANG', 17, '17#8', NULL),
(9, 'BENGKULU TENGAH', 17, '17#9', NULL),
(1, 'LAMPUNG SELATAN', 18, '18#1', NULL),
(3, 'LAMPUNG UTARA', 18, '18#3', NULL),
(5, 'TULANG BAWANG', 18, '18#5', NULL),
(7, 'LAMPUNG TIMUR', 18, '18#7', NULL),
(8, 'WAY KANAN', 18, '18#8', NULL),
(10, 'PRINGSEWU', 18, '18#10', NULL),
(11, 'MESUJI', 18, '18#11', NULL),
(71, 'KOTA BANDAR LAMPUNG', 18, '18#71', NULL),
(1, 'BANGKA', 19, '19#1', NULL),
(2, 'BELITUNG', 19, '19#2', NULL),
(4, 'BANGKA TENGAH', 19, '19#4', NULL),
(6, 'BELITUNG TIMUR', 19, '19#6', NULL),
(71, 'KOTA PANGKAL PINANG', 19, '19#71', NULL),
(2, 'KARIMUN', 21, '21#2', NULL),
(4, 'LINGGA', 21, '21#4', NULL),
(71, 'JAKARTA PUSAT', 31, '31#71', NULL),
(73, 'JAKARTA BARAT', 31, '31#73', NULL),
(75, 'JAKARTA TIMUR', 31, '31#75', NULL),
(1, 'BOGOR', 32, '32#1', NULL),
(3, 'CIANJUR', 32, '32#3', NULL),
(4, 'BANDUNG', 32, '32#4', NULL),
(6, 'TASIKMALAYA', 32, '32#6', NULL),
(7, 'CIAMIS', 32, '32#7', NULL),
(9, 'CIREBON', 32, '32#9', NULL),
(10, 'MAJALENGKA', 32, '32#10', NULL),
(12, 'INDRAMAYU', 32, '32#12', NULL),
(13, 'SUBANG', 32, '32#13', NULL),
(14, 'PURWAKARTA', 32, '32#14', NULL),
(16, 'BEKASI', 32, '32#16', NULL),
(17, 'BANDUNG BARAT', 32, '32#17', NULL),
(72, 'KOTA SUKABUMI', 32, '32#72', NULL),
(74, 'KOTA CIREBON', 32, '32#74', NULL),
(76, 'KOTA DEPOK', 32, '32#76', NULL),
(77, 'KOTA CIMAHI', 32, '32#77', NULL),
(10, 'KLATEN', 33, '33#10', NULL),
(11, 'SUKOHARJO', 33, '33#11', NULL),
(13, 'KARANGANYAR', 33, '33#13', NULL),
(14, 'SRAGEN', 33, '33#14', NULL),
(17, 'REMBANG', 33, '33#17', NULL),
(4, 'KAUR', 17, '17#4', NULL),
(16, 'MOJOKERTO', 35, '35#16', NULL),
(73, 'KOTA SIBOLGA', 12, '12#73', NULL),
(6, 'BIMA', 52, '52#6', NULL),
(72, 'KOTA SABANG', 11, '11#72', NULL),
(17, 'SAMOSIR', 12, '12#17', NULL),
(11, 'KAYONG UTARA', 61, '61#11', NULL),
(79, 'KOTA BATU', 35, '35#79', NULL),
(1, 'ACEH SELATAN', 11, '11#1', NULL),
(18, 'PATI', 33, '33#18', NULL),
(20, 'JEPARA', 33, '33#20', NULL),
(21, 'DEMAK', 33, '33#21', NULL),
(22, 'SEMARANG', 33, '33#22', NULL),
(71, 'KOTA MAGELANG', 33, '33#71', NULL),
(73, 'KOTA SALATIGA', 33, '33#73', NULL),
(75, 'KOTA PEKALONGAN', 33, '33#75', NULL),
(76, 'KOTA TEGAL', 33, '33#76', NULL),
(2, 'BANTUL', 34, '34#2', NULL),
(3, 'GUNUNG KIDUL', 34, '34#3', NULL),
(71, 'KOTA YOGYAKARTA', 34, '34#71', NULL),
(2, 'PONOROGO', 35, '35#2', NULL),
(3, 'TRENGGALEK', 35, '35#3', NULL),
(5, 'BLITAR', 35, '35#5', NULL),
(6, 'KEDIRI', 35, '35#6', NULL),
(8, 'LUMAJANG', 35, '35#8', NULL),
(9, 'JEMBER', 35, '35#9', NULL),
(10, 'BANYUWANGI', 35, '35#10', NULL),
(12, 'SITUBONDO', 35, '35#12', NULL),
(14, 'PASURUAN', 35, '35#14', NULL),
(15, 'SIDOARJO', 35, '35#15', NULL),
(18, 'NGANJUK', 35, '35#18', NULL),
(19, 'MADIUN', 35, '35#19', NULL),
(20, 'MAGETAN', 35, '35#20', NULL),
(22, 'BOJONEGORO', 35, '35#22', NULL),
(23, 'TUBAN', 35, '35#23', NULL),
(25, 'GRESIK', 35, '35#25', NULL),
(26, 'BANGKALAN', 35, '35#26', NULL),
(28, 'PAMEKASAN', 35, '35#28', NULL),
(29, 'SUMENEP', 35, '35#29', NULL),
(76, 'KOTA MOJOKERTO', 35, '35#76', NULL),
(1, 'PANDEGLANG', 36, '36#1', '331'),
(2, 'LEBAK', 36, '36#2', '232'),
(3, 'TANGERANG', 36, '36#3', '455'),
(72, 'KOTA CILEGON', 36, '36#72', '106'),
(74, 'KOTA TANGERANG SELATAN', 36, '36#74', '457'),
(2, 'TABANAN', 51, '51#2', NULL),
(3, 'BADUNG', 51, '51#3', NULL),
(5, 'KLUNGKUNG', 51, '51#5', NULL),
(6, 'BANGLI', 51, '51#6', NULL),
(8, 'BULELENG', 51, '51#8', NULL),
(71, 'KOTA DENPASAR', 51, '51#71', NULL),
(2, 'LOMBOK TENGAH', 52, '52#2', NULL),
(4, 'SUMBAWA', 52, '52#4', NULL),
(5, 'DOMPU', 52, '52#5', NULL),
(7, 'SUMBAWA BARAT', 52, '52#7', NULL),
(71, 'KOTA MATARAM', 52, '52#71', NULL),
(1, 'KUPANG', 53, '53#1', NULL),
(2, 'TIMOR TENGAH SELATAN', 53, '53#2', NULL),
(4, 'BELU', 53, '53#4', NULL),
(6, 'FLORES TIMUR', 53, '53#6', NULL),
(8, 'ENDE', 53, '53#8', NULL),
(10, 'MANGGARAI', 53, '53#10', NULL),
(13, 'LEMBATA', 53, '53#13', NULL),
(14, 'ROTENDAO', 53, '53#14', NULL),
(16, 'NAGEKEO', 53, '53#16', NULL),
(17, 'SUMBA TENGAH', 53, '53#17', NULL),
(19, 'MANGGARAI TIMUR', 53, '53#19', NULL),
(71, 'KOTA KUPANG', 53, '53#71', NULL),
(1, 'SAMBAS', 61, '61#1', NULL),
(3, 'SANGGAU', 61, '61#3', NULL),
(4, 'KETAPANG', 61, '61#4', NULL),
(6, 'KAPUAS HULU', 61, '61#6', NULL),
(7, 'BENGKAYANG', 61, '61#7', NULL),
(9, 'SEKADAU', 61, '61#9', NULL),
(12, 'KUBU RAYA', 61, '61#12', NULL),
(71, 'KOTA PONTIANAK', 61, '61#71', NULL),
(25, 'PUNCAK', 91, '91#25', NULL),
(26, 'DOGIYAI', 91, '91#26', NULL),
(27, 'INTAN JAYA', 91, '91#27', NULL),
(71, 'KOTA JAYAPURA', 91, '91#71', NULL),
(2, 'MANOKWARI', 92, '92#2', NULL),
(3, 'FAK FAK', 92, '92#3', NULL),
(5, 'RAJA AMPAT', 92, '92#5', NULL),
(6, 'TELUK BINTUNI', 92, '92#6', NULL),
(8, 'KAIMANA', 92, '92#8', NULL),
(9, 'TAMBRAUW', 92, '92#9', NULL),
(71, 'KOTA SORONG', 92, '92#71', NULL),
(10, 'LABUHANBATU', 12, '12#10', NULL),
(2, 'ACEH TENGGARA', 11, '11#2', NULL),
(3, 'ACEH TIMUR', 11, '11#3', NULL),
(4, 'ACEH TENGAH', 11, '11#4', NULL),
(5, 'ACEH BARAT', 11, '11#5', NULL),
(6, 'ACEH BESAR', 11, '11#6', NULL),
(7, 'PIDIE', 11, '11#7', NULL),
(10, 'ACEH SINGKIL', 11, '11#10', NULL),
(13, 'GAYO LUES', 11, '11#13', NULL),
(15, 'NAGAN RAYA', 11, '11#15', NULL),
(18, 'PIDIE JAYA', 11, '11#18', NULL),
(73, 'KOTA LHOKSEUMAWE', 11, '11#73', NULL),
(75, 'KOTA SUBULUSSALAM', 11, '11#75', NULL),
(2, 'TAPANULI UTARA', 12, '12#2', NULL),
(4, 'NIAS', 12, '12#4', NULL),
(7, 'DELI SERDANG', 12, '12#7', NULL),
(9, 'ASAHAN', 12, '12#9', NULL),
(12, 'TOBA SAMOSIR', 12, '12#12', NULL),
(13, 'MANDAILING NATAL', 12, '12#13', NULL),
(14, 'NIAS SELATAN', 12, '12#14', NULL),
(18, 'SERDANG BEDAGAI', 12, '12#18', NULL),
(22, 'LABUHANBATU SELATAN', 12, '12#22', NULL),
(25, 'NIAS BARAT', 12, '12#25', NULL),
(74, 'KOTA TANJUNG BALAI', 12, '12#74', NULL),
(75, 'KOTA BINJAI', 12, '12#75', NULL),
(77, 'KOTA PADANG SIDIMPUAN', 12, '12#77', NULL),
(1, 'PESISIR SELATAN', 13, '13#1', NULL),
(5, 'PADANG PARIAMAN', 13, '13#5', NULL),
(8, 'PASAMAN', 13, '13#8', NULL),
(11, 'SOLOK SELATAN', 13, '13#11', NULL),
(71, 'KOTA PADANG', 13, '13#71', NULL),
(74, 'KOTA PADANG PANJANG', 13, '13#74', NULL),
(76, 'KOTA PAYAKUMBUH', 13, '13#76', NULL),
(1, 'KAMPAR', 14, '14#1', NULL),
(3, 'BENGKALIS', 14, '14#3', NULL),
(6, 'ROKAN HULU', 14, '14#6', NULL),
(8, 'SIAK', 14, '14#8', NULL),
(71, 'KOTA PEKANBARU', 14, '14#71', NULL),
(1, 'KERINCI', 15, '15#1', NULL),
(4, 'BATANG HARI', 15, '15#4', NULL),
(6, 'TANJUNG JABUNG BARAT', 15, '15#6', NULL),
(8, 'BUNGO', 15, '15#8', NULL),
(72, 'KOTA SUNGAI PENUH', 15, '15#72', NULL),
(2, 'OGAN KOMERING ILIR', 16, '16#2', NULL),
(7, 'BANYUASIN', 16, '16#7', NULL),
(9, 'OGAN KOMERING ULU SELATAN', 16, '16#9', NULL),
(10, 'OGAN ILIR', 16, '16#10', NULL),
(71, 'KOTA PALEMBANG', 16, '16#71', NULL),
(72, 'KOTA PAGAR ALAM', 16, '16#72', NULL),
(73, 'KOTA LUBUK LINGGAU', 16, '16#73', NULL),
(74, 'KOTA PRABUMULIH', 16, '16#74', NULL),
(1, 'BENGKULU SELATAN', 17, '17#1', NULL),
(3, 'BENGKULU UTARA', 17, '17#3', NULL),
(7, 'LEBONG', 17, '17#7', NULL),
(71, 'KOTA BENGKULU', 17, '17#71', NULL),
(2, 'LAMPUNG TENGAH', 18, '18#2', NULL),
(4, 'LAMPUNG BARAT', 18, '18#4', NULL),
(6, 'TANGGAMUS', 18, '18#6', NULL),
(9, 'PESAWARAN', 18, '18#9', NULL),
(12, 'TULANG BAWANG BARAT', 18, '18#12', NULL),
(72, 'KOTA METRO', 18, '18#72', NULL),
(3, 'BANGKA SELATAN', 19, '19#3', NULL),
(5, 'BANGKA BARAT', 19, '19#5', NULL),
(1, 'BINTAN', 21, '21#1', NULL),
(3, 'NATUNA', 21, '21#3', NULL),
(5, 'KEPULAUAN ANAMBAS', 21, '21#5', NULL),
(71, 'KOTA BATAM', 21, '21#71', NULL),
(72, 'KOTA TANJUNG PINANG', 21, '21#72', NULL),
(1, 'KEPULAUAN SERIBU', 31, '31#1', NULL),
(72, 'JAKARTA UTARA', 31, '31#72', NULL),
(74, 'JAKARTA SELATAN', 31, '31#74', NULL),
(2, 'SUKABUMI', 32, '32#2', NULL),
(5, 'GARUT', 32, '32#5', NULL),
(8, 'KUNINGAN', 32, '32#8', NULL),
(11, 'SUMEDANG', 32, '32#11', NULL),
(15, 'KARAWANG', 32, '32#15', NULL),
(71, 'KOTA BOGOR', 32, '32#71', NULL),
(73, 'KOTA BANDUNG', 32, '32#73', NULL),
(75, 'KOTA BEKASI', 32, '32#75', NULL),
(1, 'CILACAP', 33, '33#1', NULL),
(4, 'BANJARNEGARA', 33, '33#4', NULL),
(7, 'WONOSOBO', 33, '33#7', NULL),
(8, 'MAGELANG', 33, '33#8', NULL),
(9, 'BOYOLALI', 33, '33#9', NULL),
(12, 'WONOGIRI', 33, '33#12', NULL),
(16, 'BLORA', 33, '33#16', NULL),
(19, 'KUDUS', 33, '33#19', NULL),
(23, 'TEMANGGUNG', 33, '33#23', NULL),
(24, 'KENDAL', 33, '33#24', NULL),
(25, 'BATANG', 33, '33#25', NULL),
(27, 'PEMALANG', 33, '33#27', NULL),
(28, 'TEGAL', 33, '33#28', NULL),
(29, 'BREBES', 33, '33#29', NULL),
(72, 'KOTA SURAKARTA', 33, '33#72', NULL),
(74, 'KOTA SEMARANG', 33, '33#74', NULL),
(1, 'KULONPROGO', 34, '34#1', NULL),
(4, 'SLEMAN', 34, '34#4', NULL),
(1, 'PACITAN', 35, '35#1', NULL),
(4, 'TULUNGAGUNG', 35, '35#4', NULL),
(7, 'MALANG', 35, '35#7', NULL),
(11, 'BONDOWOSO', 35, '35#11', NULL),
(13, 'PROBOLINGGO', 35, '35#13', NULL),
(17, 'JOMBANG', 35, '35#17', NULL),
(21, 'NGAWI', 35, '35#21', NULL),
(24, 'LAMONGAN', 35, '35#24', NULL),
(27, 'SAMPANG', 35, '35#27', NULL),
(71, 'KOTA KEDIRI', 35, '35#71', NULL),
(72, 'KOTA BLITAR', 35, '35#72', NULL),
(73, 'KOTA MALANG', 35, '35#73', NULL),
(74, 'KOTA PROBOLINGGO', 35, '35#74', NULL),
(75, 'KOTA PASURUAN', 35, '35#75', NULL),
(77, 'KOTA MADIUN', 35, '35#77', NULL),
(4, 'SERANG', 36, '36#4', '402'),
(73, 'KOTA SERANG', 36, '36#73', '403'),
(1, 'JEMBRANA', 51, '51#1', NULL),
(4, 'GIANYAR', 51, '51#4', NULL),
(7, 'KARANG ASEM', 51, '51#7', NULL),
(1, 'LOMBOK BARAT', 52, '52#1', NULL),
(3, 'LOMBOK TIMUR', 52, '52#3', NULL),
(8, 'LOMBOK UTARA', 52, '52#8', NULL),
(72, 'KOTA BIMA', 52, '52#72', NULL),
(3, 'TIMOR TENGAH UTARA', 53, '53#3', NULL),
(7, 'SIKKA', 53, '53#7', NULL),
(12, 'SUMBA BARAT', 53, '53#12', NULL),
(15, 'MANGGARAI BARAT', 53, '53#15', NULL),
(18, 'SUMBA BARAT DAYA', 53, '53#18', NULL),
(20, 'SABU RAIJUA', 53, '53#20', NULL),
(2, 'MEMPAWAH', 61, '61#2', NULL),
(5, 'SINTANG', 61, '61#5', NULL),
(8, 'LANDAK', 61, '61#8', NULL),
(10, 'MELAWI', 61, '61#10', NULL),
(4, 'HALMAHERA SELATAN', 82, '82#4', NULL),
(5, 'KEPULAUAN SULA', 82, '82#5', NULL),
(6, 'HALMAHERA TIMUR', 82, '82#6', NULL),
(7, 'PULAU MOROTAI', 82, '82#7', NULL),
(71, 'KOTA TERNATE', 82, '82#71', NULL),
(72, 'KOTA TIDORE KEPULAUAN', 82, '82#72', NULL),
(1, 'MERAUKE', 91, '91#1', NULL),
(2, 'JAYAWIJAYA', 91, '91#2', NULL),
(3, 'JAYAPURA', 91, '91#3', NULL),
(4, 'NABIRE', 91, '91#4', NULL),
(5, 'KEPULAUAN YAPEN', 91, '91#5', NULL),
(6, 'BIAK NUMFOR', 91, '91#6', NULL),
(7, 'PUNCAK JAYA', 91, '91#7', NULL),
(8, 'PANIAI', 91, '91#8', NULL),
(9, 'MIMIKA', 91, '91#9', NULL),
(10, 'SARMI', 91, '91#10', NULL),
(11, 'KEEROM', 91, '91#11', NULL),
(12, 'PEG. BINTANG', 91, '91#12', NULL),
(13, 'YAHUKIMO', 91, '91#13', NULL),
(14, 'TOLIKARA', 91, '91#14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `modalusaha`
--

CREATE TABLE `modalusaha` (
  `id_modalusaha` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `no_kk` varchar(20) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_daftar` datetime NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `id_kelurahan` int(11) NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `rt` int(11) NOT NULL,
  `rw` int(11) NOT NULL,
  `id_jenis_usaha` int(11) NOT NULL,
  `jenis_usaha` varchar(255) DEFAULT NULL,
  `jenis_usaha_lainnya` varchar(255) DEFAULT NULL,
  `nama_usaha` varchar(255) NOT NULL,
  `total` varchar(255) DEFAULT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `trash` enum('0','1') NOT NULL DEFAULT '0',
  `status` enum('menunggu','diterima','ditolak','realisasi') NOT NULL DEFAULT 'menunggu',
  `ket_status` varchar(255) DEFAULT NULL,
  `sumber` enum('web','mobile') DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `notlp` varchar(255) DEFAULT NULL,
  `bank` int(11) DEFAULT NULL,
  `nama_bank` varchar(255) DEFAULT NULL,
  `norek` varchar(255) DEFAULT NULL,
  `atasnama` varchar(255) DEFAULT NULL,
  `medsos` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `tahap` int(11) DEFAULT NULL,
  `status_tahap2` enum('menunggu','diterima','ditolak','realisasi') DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `kategori_lainnya` varchar(255) DEFAULT NULL,
  `foto_buku_bank` varchar(255) DEFAULT NULL,
  `verif_by` varchar(255) DEFAULT NULL,
  `realisasi_by` varchar(255) DEFAULT NULL,
  `umkm` int(11) DEFAULT 0,
  `tgl_umkm` datetime DEFAULT NULL,
  `akun_tlive` varchar(255) DEFAULT NULL,
  `keuangan` varchar(255) DEFAULT NULL,
  `jeniskelamin` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `m_agenda`
--

CREATE TABLE `m_agenda` (
  `id_agenda` int(11) NOT NULL,
  `kode_agenda` varchar(10) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `long` varchar(50) DEFAULT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_agenda`
--

INSERT INTO `m_agenda` (`id_agenda`, `kode_agenda`, `username`, `judul`, `foto`, `tanggal`, `keterangan`, `long`, `lat`, `lokasi`, `created_at`, `updated_at`, `status`) VALUES
(1, '1579578846', 'egov', 'GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis', '3fb99b5bc48b3d0070081e38befd3e6a.jpg', '2020-01-13', '<p>Jadwal Kursus GoUKM Bandung 2019. Sebagai daerah pariwisata, Bandung memiliki potensi besar dalam bisnis. Selain dijuluki sebagai Kota kreatif, Bandung juga memiliki peluang menjanjikan dalam berbisnis kuliner. GoUKM sebagai lembaga pelatihan dan mendukung kewirausahaan, saat ini telah membuka cabang di Kota Bandung, Jawa Barat.</p>\n\n<p>Berlokasi di Jalan Asia Afrika No.45 Kota Bandung, program kursus yang dibuka terdiri dari kursus usaha kuliner dan usaha non-kuliner. Sebagian dari program yang diselenggarakan di Bandung merupakan program yang sama dengan program di GoUKM Jakarta.</p>\n\n<p>Belajar di GoUKM Training Center tidak hanya praktik, Anda bisa berkonsultasi bisnis karena pengajar di GoUKM berlatar belakang pengusaha di bidang yang terkait. Anda dapat memilih program yang prospektif yang diselenggarakan GoUKM Training Center.</p>\n\n<p>Berikut ini adalah Jadwal Kursus GoUKM Training Center Bandung 2019 yang bisa Anda sesusaikan. Jadwal ini dapat berubah sewaktu-waktu. untuk informasi lebih lanjut Telp/WA&nbsp; 0813 8831 9900 (Vira) / 0812 2060 0100 (Suci) / 0813 1000 9410 (Ripal) / 0852 8020 7171</p>\n', '106.63897514868316', '-6.169884317243533', 'Masjid Raya Al Azhom, Suka Asih, Kecamatan Tangerang, Kota Tangerang', '2020-01-21 10:06:54', '2020-01-21 15:45:22', 'aktif'),
(2, '1579579479', 'egov', 'Mau Buat Startup? Apa Yang Harus Disiapkan? ', 'a9c55d4418ea0a478a2a3d0e45833d1a.jpeg', '2020-01-15', '<p>Dalam menjalankan usaha, tentu saja para entrepreneur, pelaku UMKM, dan juga usaha rintisan (startup) membutuhkan beberapa dokumen legal. Tetapi terkadang, para pelaku usaha ini mempunyai kendala dalam memenuhi apa saja kebutuhan-kebutuhan legal yang diperlukan dalam praktik bisnis mereka sehari-hari.<br />\nUntuk memberikan solusi atas kendala tersebut, MULA by Galeria Jakarta dengan Kontrak Hukum menghadirkan program yang dapat membantu para pelaku usaha dalam mengembangkan usahanya dan menjaganya secara legal.</p>\n', '106.62414202991653', '-6.159345355865041', 'Jalan Kisaiman, Koang Jaya, Kecamatan Karawaci ', '2020-01-21 11:39:04', '2020-10-13 10:11:54', 'aktif'),
(3, '1602558551', 'egov', 'testing', '0c643dbfd2538ac77ae6f3785b06b65c.png', '2020-10-13', '<p>testing edit</p>\n', '106.63135616633792', '-6.166610466554882', 'DISPORBUDPAR, Pasar Baru, Kecamatan Karawaci, Kota Tangerang', '2020-10-13 10:09:11', '2020-10-13 10:11:50', 'aktif'),
(4, '1607402746', '198602132011011002', 'Testing Agenda 8-12-2020', '49871b184d55754c479c0b5c42335d7f.jpeg', '2020-12-08', '<p>testing agenda edit</p>\n', '106.64004491526735', '-6.171489419846418', 'RW 1, Sukaasih, Tangerang', '2020-12-08 11:45:46', '2020-12-08 11:49:45', 'aktif'),
(5, '1607411725', '198602132011011002', 'testing 123', '2d3c66f499f5b4618f7f79bd0694a3f6.jpeg', '2020-12-09', '<p>testing agenda</p>\n', '106.63724603278109', '-6.171309151815072', 'RW 3, Sukaasih, Tangerang', '2020-12-08 14:15:25', NULL, 'aktif'),
(6, '1610697495', 'egov', 'GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2', 'ac8e0a13a958cd2d91b284739f268967.jpeg', '2021-01-14', '<p>GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;GoUKM Training Center, Tempat Kursus Usaha dan Pelatihan Bisnis 2&nbsp;</p>\n', '106.63020952198441', '-6.166711800728554', 'RW 3, Koang Jaya, Karawaci', '2021-01-15 14:58:15', NULL, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `m_alamat`
--

CREATE TABLE `m_alamat` (
  `id_alamat` int(11) NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `nama_alamat` varchar(100) DEFAULT NULL,
  `id_prop` int(11) DEFAULT NULL,
  `nama_prop` varchar(100) DEFAULT NULL,
  `id_kota` int(11) DEFAULT NULL,
  `nama_kota` varchar(100) DEFAULT NULL,
  `id_kec` int(11) DEFAULT NULL,
  `nama_kec` varchar(100) DEFAULT NULL,
  `id_kel` int(11) DEFAULT NULL,
  `nama_kel` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nama_penerima` varchar(100) DEFAULT NULL,
  `no_penerima` varchar(15) DEFAULT NULL,
  `utama` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif' COMMENT 'aktif,nonaktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_alamat`
--

INSERT INTO `m_alamat` (`id_alamat`, `id_pengguna`, `username`, `nama_alamat`, `id_prop`, `nama_prop`, `id_kota`, `nama_kota`, `id_kec`, `nama_kec`, `id_kel`, `nama_kel`, `alamat`, `nama_penerima`, `no_penerima`, `utama`, `created_at`, `updated_at`, `status`) VALUES
(2, 2719, '3671111301950002', 'Kantor', 36, 'Banten', 71, 'Kota Tangerang', 11, 'Pinang', 1003, 'Neroktog', 'Jl Kh Hasyim ', 'Abdurrahman Shifa', '083878878080', 0, '2020-03-16 16:50:41', '2023-03-26 13:11:06', 'aktif'),
(3, 2748, '3671081105960002', 'Kantor', 36, 'Banten', 71, 'Kota Tangerang', 1, 'Tangerang', 1002, 'Sukaasih', 'Dinas Kominfo Kota Tangerang Pusat Pemerintahan', 'Gani Prayoga', '029381', 0, '2020-03-17 10:23:14', '2023-03-26 13:11:06', 'aktif'),
(5, 27578, '3603282009920005', 'Rumah', 36, 'Banten', 71, 'Kota Tangerang', 1, 'Tangerang', 1002, 'Sukaasih', 'Jl Pemuda No3 RT03/2 Kel Sukaasih Kec. tangerang Kab.Tangerang  Kota Banten', 'Richi', '082219839232', 0, '2020-05-27 16:29:10', '2023-03-26 13:11:06', 'aktif'),
(6, 2570, '3201380301900018', 'Kantor', 36, 'BANTEN', 71, 'KOTA TANGERANG', 1, 'TANGERANG', 1002, 'SUKAASIH', 'Gedung Puspem Lt. 04 Dinas Kominfo Kota Tangerang', 'Ahmad Alizi', '082111155224', 0, '2020-06-30 13:05:19', '2023-03-26 13:11:06', 'aktif'),
(8, 2570, '3201380301900018', 'Alamat Rumah', 32, 'Jawa Barat', 1, 'Bogor', 38, 'Cigombong', 2001, 'Cigombong', 'Kp. Duren Gede T 004/002 Des. Tugujaya', 'Siti', '082111155220', 0, '2020-07-02 13:33:18', '2023-03-26 13:11:06', 'aktif'),
(9, 1870, '3671071707890015', 'Alamat Kantor', 36, 'Banten', 71, 'Kota Tangerang', 1, 'Tangerang', 1002, 'Sukaasih', 'puspem', 'Taqwa Arif', '323232323232', 0, '2020-07-22 16:51:19', '2023-03-26 13:11:06', 'aktif'),
(13, 137834, '3603111908960002', 'Rumah', 36, 'BANTEN', 3, 'TANGERANG', 11, 'RAJEG', 1010, 'SUKATANI', 'rajeg mas pratama d3/19', 'Taqwa Arif Priambodo', '089654020925', 0, '2020-08-25 14:51:34', '2023-03-26 13:11:06', 'aktif'),
(14, 137834, '3603111908960002', 'kantor', 36, 'BANTEN', 3, 'TANGERANG', 11, 'RAJEG', 2007, 'SUKAMANAH', 'Sukamanah', 'taqwa arif', '089654020925', 0, '2020-09-04 09:36:52', '2023-03-26 13:11:06', 'aktif'),
(19, 137834, '3603111908960002', 'Rumah Testing', 36, 'BANTEN', 71, 'KOTA TANGERANG', 9, 'CIBODAS', 1003, 'CIBODAS BARU', 'Jl Srieijaya No 1 Kel Bencongan Indah Kec Kelapa Dua Kab Tangerang Banten 18840', 'Taqwaw', '089654020925', 0, '2020-12-05 10:20:17', '2023-03-26 13:11:06', 'aktif'),
(20, 36160, '3671052710810004', 'Rumah', 36, 'BANTEN', 71, 'KOTA TANGERANG', 1, 'TANGERANG', 1002, 'SUKAASIH', 'testing', 'Sandy Bayu', '12345678', 0, '2020-12-07 17:01:25', '2023-03-26 13:11:06', 'aktif'),
(21, 182, '3671012506930002', 'Thanks For All Of', 33, 'JAWA TENGAH', 15, 'GROBOGAN', 15, 'KLAMBU', 2002, 'SELOJARI', 'Leukemia And Lymphoma Society Of America Joined The Attached File Is Scanned Image', 'Kantor Saya', '088222588855', 0, '2020-12-09 01:40:30', '2023-03-26 13:11:06', 'nonaktif'),
(22, 182, '3671012506930002', 'Thanks For All Of', 33, 'JAWA TENGAH', 15, 'GROBOGAN', 15, 'KLAMBU', 2002, 'SELOJARI', 'Leukemia And Lymphoma Society Of America Joined The Attached File Is Scanned Image', 'For Example', '088222588855', 0, '2020-12-09 01:41:22', '2023-03-26 13:11:06', 'nonaktif'),
(26, 182, '3671012506930002', 'Rumah', 31, 'DKI JAKARTA', 1, 'KEPULAUAN SERIBU', 1, 'KEPULAUAN SERIBU UTARA', 1001, 'PULAU PANGGANG', 'Desa Sumberagung Rt03 Rw 01 Kec Godong Kab Grobogan Jawa Tengan', 'Asep', '08213377575', 0, '2020-12-09 11:11:10', '2023-03-26 13:11:06', 'nonaktif'),
(27, 182, '3671012506930002', 'Rumah', 33, 'JAWA TENGAH', 15, 'GROBOGAN', 12, 'GROBOGAN', 2007, 'KARANGREJO', 'Desa Sumberagung Rt03 Rw 01 Kec Godong Kab Grobogan Jawa Tengan', 'Asep', '08213377575', 0, '2020-12-09 11:12:34', '2023-03-26 13:11:06', 'nonaktif'),
(28, 182, '3671012506930002', 'Test', 31, 'DKI JAKARTA', 1, 'KEPULAUAN SERIBU', 1, 'KEPULAUAN SERIBU UTARA', 1001, 'PULAU PANGGANG', 'Twenty Five To Seven Months ', 'How Are The Same', '0885', 0, '2020-12-09 11:24:29', '2023-03-26 13:11:06', 'nonaktif'),
(29, 182, '3671012506930002', 'Alamat Second', 17, 'BENGKULU', 8, 'KEPAHIANG', 5, 'MERIGI', 2001, 'PULO GETO', 'Nana And Papa John\'s Pizza ????????', 'Yah I Am', '85554', 0, '2020-12-09 11:25:47', '2023-03-26 13:11:06', 'nonaktif'),
(36, 182, '3671012506930002', 'Kos ', 36, 'BANTEN', 71, 'KOTA TANGERANG', 7, 'KARAWACI', 1006, 'CIMONE JAYA', 'Jl Dipati Unus No 34 Kel Cimane Jaya Kec Karawaci Kota Tangerang', 'Jihan', '08222133454', 0, '2020-12-09 13:04:24', '2023-03-26 13:11:06', 'nonaktif'),
(37, 182, '3671012506930002', 'Rumahku', 36, 'BANTEN', 3, 'TANGERANG', 28, 'KELAPA DUA', 1003, 'BENCONGAN INDAH', 'Jln Sriwijaya 1 No27 Bencongan Indah Kec Kelapa Dua Kab Tangerang Banten', 'Testing', '0822133456', 0, '2020-12-09 13:06:26', '2023-03-26 13:11:06', 'nonaktif'),
(38, 137834, '3603111908960002', 'Kosan Mantap', 36, 'BANTEN', 1, 'PANDEGLANG', 3, 'CIBALIUNG', 2016, 'SORONGAN', 'Jl Sriwijaya Fc No 1 Kel Bencongan Indah Kec Kelapa Dua Kab Tangaerang Banten 62810', 'Asepsoo', '082213337858', 0, '2020-12-14 02:26:34', '2023-03-26 13:11:06', 'nonaktif'),
(39, 137834, '3603111908960002', 'Kosan Gais', 36, 'BANTEN', 73, 'KOTA SERANG', 6, 'TAKTAKAN', 1004, 'KURANJI', 'Jl Kemiri No 9 Kel Kuranji Kec Taktakan Kota Serang Banten', 'Asepsoo', '0822134657', 0, '2020-12-14 10:26:56', '2023-03-26 13:11:06', 'nonaktif'),
(40, 137834, '3603111908960002', 'Rumahmu', 36, 'BANTEN', 71, 'KOTA TANGERANG', 9, 'CIBODAS', 1003, 'CIBODAS BARU', 'Jl Diponegoro No 01 Kec Cibodas Tangerang Kota Banten', 'Asepsoo', '082211331513', 0, '2020-12-22 10:19:02', '2023-03-26 13:11:06', 'aktif'),
(41, 182, '3671012506930002', 'Rumah', 36, 'BANTEN', 71, 'KOTA TANGERANG', 9, 'CIBODAS', 1003, 'CIBODAS BARU', 'Jln Dipati Rangga RT 09 RW 03 Kel Cibodas Baru Kec Cibodas Kota Tangerang Banten', 'Asepsoo', '082211557273', 0, '2021-01-11 08:24:45', '2023-03-26 13:11:06', 'nonaktif'),
(42, 182, '3671012506930002', 'Asd', 32, 'JAWA BARAT', 9, 'CIREBON', 30, 'GEBANG', 2004, 'KALIMARO', 'Di Tunggu Al Qur\'an Dan Hadits Yang Diriwayatkan Oleh Orang Lain', 'Fg Di Dunia MPL Pindah Ke', '088551255368', 0, '2021-01-11 09:05:39', '2023-03-26 13:11:06', 'nonaktif'),
(43, 182, '3671012506930002', 'TT Dan Yang Paling Banyak', 31, 'DKI JAKARTA', 1, 'KEPULAUAN SERIBU', 1, 'KEPULAUAN SERIBU UTARA', 1001, 'PULAU PANGGANG', 'Toko Online Di Indonesia Yang Memiliki Pengalaman Kerja Di Posisi Kedua Dengan Demikian Maka Akan', 'Foto Saya Kirim Ke Seluruh', '08852588000', 0, '2021-01-11 09:11:30', '2023-03-26 13:11:06', 'nonaktif'),
(44, 182, '3671012506930002', 'Asepsoo', 36, 'BANTEN', 71, 'KOTA TANGERANG', 1, 'TANGERANG', 1001, 'SUKARASA', 'puspem ', 'Fg Di Dunia MPL Pindah Ke', '088551255368', 0, '2021-01-11 09:05:39', '2023-03-26 13:11:06', 'aktif'),
(45, 1696815137, '3671076910950001', 'alamat rumah', 36, 'BANTEN', 71, 'KOTA TANGERANG', 7, 'KARAWACI', 1009, 'BUGEL', 'jl. nikel blok c19 no.09', 'dhiamara', '081313949809', 0, '2021-01-12 14:33:43', '2023-03-26 13:11:06', 'aktif'),
(46, 137834, '3603111908960002', 'alamat kantor', 36, 'BANTEN', 71, 'KOTA TANGERANG', 7, 'KARAWACI', 1009, 'BUGEL', 'jl. testing', 'test', '0888888888', 0, '2021-01-12 15:17:48', '2023-03-26 13:11:06', 'aktif'),
(47, 2570, '3201380301900018', 'Jalan baru', 34, 'DAERAH ISTIMEWA YOGYAKARTA', 3, 'GUNUNG KIDUL', 16, 'GIRISUBO', 2003, 'KARANGAWEN', 'Kp. Karangawen No. 23, 33 ', 'Komar', '082111155224', 0, '2021-01-17 07:17:21', '2023-03-26 13:11:06', 'nonaktif'),
(48, 137834, '3603111908960002', 'rumah', 36, 'BANTEN', 74, 'KOTA TANGERANG SELATAN', 1, 'SERPONG', 1001, 'CIATER', 'jl. abc no. 66 (belakang masjid)', 'firda', '0811111111', 0, '2021-01-29 10:21:19', '2023-03-26 13:11:06', 'aktif'),
(49, 27943, '3674055109950004', 'ciputat', 36, 'BANTEN', 74, 'KOTA TANGERANG SELATAN', 4, 'CIPUTAT', 1003, 'CIPUTAT', 'testing', 'tika', '1244567654', 0, '2021-02-02 10:01:17', '2023-03-26 13:11:06', 'aktif'),
(50, 2817, '3674065709910009', 'Kantor', 36, 'BANTEN', 71, 'KOTA TANGERANG', 1, 'TANGERANG', 1002, 'SUKAASIH', 'Puspem Kota Tangerang', 'Firda', '08111180880', 0, '2021-02-02 10:47:59', '2023-03-26 13:11:06', 'aktif'),
(52, 1696885615, '3671091103900002', 'Kantor', 36, 'BANTEN', 71, 'KOTA TANGERANG', 3, 'BATUCEPER', 1001, 'BATUCEPER', 'Jl Satria sudirman', 'Farid', '08222182828', 0, '2021-02-04 16:25:52', '2023-03-26 13:11:06', 'aktif'),
(53, 140120, '3301182905970002', 'Kantor', 36, 'BANTEN', 71, 'KOTA TANGERANG', 5, 'CIPONDOH', 1002, 'CIPONDOH MAKMUR', 'Jln Sriwijaya 1 No27 Bencongan Indah Kec Kelapa Dua Kab Tangerang Selatan Banten ', 'Misbahul Munir', '082211227572', 0, '2021-02-05 02:15:45', '2023-03-26 13:11:06', 'aktif'),
(54, 1696972088, '3203070105980003', 'Rumah', 34, 'DAERAH ISTIMEWA YOGYAKARTA', 4, 'SLEMAN', 7, 'DEPOK', 2003, 'CONDONG CATUR', 'jln kenanga', 'Ari', '08211212121', 0, '2021-02-09 14:10:38', '2023-03-26 13:11:06', 'aktif'),
(55, 1696972088, '3203070105980003', 'Rumah', 36, 'BANTEN', 71, 'KOTA TANGERANG', 9, 'CIBODAS', 1006, 'JATIUWUNG', 'jln jatiuwung', 'Ari', '08211212121', 0, '2021-02-09 14:20:43', '2023-03-26 13:11:06', 'aktif'),
(56, 1696972088, '3203070105980003', 'Kantor', 32, 'JAWA BARAT', 4, 'BANDUNG', 32, 'BALEENDAH', 1001, 'BALEENDAH', 'jln. bale', 'Budi', '01287127127', 0, '2021-02-09 14:31:27', '2023-03-26 13:11:06', 'aktif'),
(57, 1696972076, '3603141905980005', 'rawa burung', 36, 'BANTEN', 3, 'TANGERANG', 14, 'KOSAMBI', 2006, 'RAWA BURUNG', 'dvchdbxvjnzfdmnvc hjvcbv hjdbxcvzxd, ', 'ega', '124354657687990', 0, '2021-02-09 15:53:40', '2023-03-26 13:11:06', 'aktif'),
(58, 1696972076, '3603141905980005', 'fak fak', 92, 'PAPUA BARAT', 3, 'FAK FAK', 2, 'FAKFAK BARAT', 2006, 'SIBORU', 'fscgcdbfvkgbkvcb vxdkjnfv dklxcszdcsd', 'ega', '124354657687990', 0, '2021-02-09 16:06:12', '2023-03-26 13:11:06', 'aktif'),
(59, 1696972076, '3603141905980005', 'cengkareng', 31, 'DKI JAKARTA', 73, 'JAKARTA BARAT', 1, 'CENGKARENG', 1003, 'RAWA BUAYA', 'ngghfvdxc', 'ega', '124354657687990', 0, '2021-02-09 16:07:01', '2023-03-26 13:11:06', 'aktif'),
(60, 1696972076, '3603141905980005', 'serang', 36, 'BANTEN', 73, 'KOTA SERANG', 4, 'CURUG', 1009, 'CURUG MANIS', 'dfdv', 'ega', '124354657687990', 0, '2021-02-09 16:08:37', '2023-03-26 13:11:06', 'aktif'),
(61, 1696912367, '3671054712020001', 'jl. kh hasyim ashari', 36, 'BANTEN', 71, 'KOTA TANGERANG', 5, 'CIPONDOH', 1009, '', 'gg annur 2 no. 39 rt.05 rw.01 ', 'popi lestari', '089697254318', 0, '2021-02-10 08:57:28', '2023-03-26 13:11:06', 'nonaktif'),
(62, 43040, '3671050303940009', 'Rumah', 36, 'BANTEN', 2, 'LEBAK', 18, 'CIBADAK', 2008, 'BOJONGCAE', 'fgfdy', 'Budi', '08211212121', 0, '2021-02-10 09:01:42', '2023-03-26 13:11:06', 'aktif'),
(63, 43040, '3671050303940009', 'Kantor', 36, 'BANTEN', 71, 'KOTA TANGERANG', 9, 'CIBODAS', 1006, 'JATIUWUNG', 'fyfyfyty', 'joko', '08211212121', 0, '2021-02-10 09:02:50', '2023-03-26 13:11:06', 'aktif'),
(64, 1696486046, '3671110702970001', 'Rumah Ade Ubaydilah', 36, 'BANTEN', 71, 'KOTA TANGERANG', 11, 'PINANG', 1003, 'NEROKTOG', 'Jl Kh hasyim Ashari Gg inpres 2 no.7', 'Ubay', '07', 0, '2021-02-10 10:07:38', '2023-03-26 13:11:06', 'aktif'),
(65, 1696503782, '3603110906970007', 'RUMAH', 36, 'BANTEN', 3, 'TANGERANG', 11, 'RAJEG', 1010, 'SUKATANI', 'PSP C1', 'JOKO', '082212341234', 0, '2021-02-10 11:20:25', '2023-03-26 13:11:06', 'aktif'),
(66, 1696912367, '3671054712020001', 'Rumah', 36, 'BANTEN', 71, 'KOTA TANGERANG', 5, 'CIPONDOH', 1009, 'PORIS PLAWAD UTARA', 'no. 39 RT.005 RW.001 ', 'Popi Lestari', '089697254318', 0, '2021-02-15 09:55:15', '2023-03-26 13:11:06', 'aktif'),
(67, 1696972084, '3671092303850004', 'Kp. Cibodas', 36, 'BANTEN', 71, 'KOTA TANGERANG', 9, 'CIBODAS', 1001, 'CIBODAS', 'No. 14 RT. 002 RW. 002 15138', 'Machtum', '081286057729', 0, '2021-02-19 11:08:27', '2023-03-26 13:11:06', 'aktif'),
(68, 1696518608, '3671044708770004', 'Poris Indah Paradise', 36, 'BANTEN', 71, 'KOTA TANGERANG', 5, 'CIPONDOH', 1001, 'CIPONDOH', 'Poris Indah Blok H Cmr 2 No 90', 'Ari', '08211212121', 0, '2021-03-08 11:12:15', '2023-03-26 13:11:06', 'aktif'),
(69, 182, '3671012506930002', 'Rumah', 36, 'BANTEN', 71, 'KOTA TANGERANG', 9, 'CIBODAS', 1006, 'JATIUWUNG', 'jln Sriwijaya 1 no27 Bencongan indah Kec kelapa dua kab tangerang Banten', 'Susan', '8807842243', 0, '2021-07-31 01:29:32', '2023-03-26 13:11:06', 'aktif'),
(70, 1696986024, '3603284710880003', 'Rumpak Sinang', 36, 'BANTEN', 3, 'TANGERANG', 1, 'BALARAJA', 2010, 'SENTUL', 'tes', 'Dewi', '087809106231', 0, '2021-08-24 16:39:15', '2023-03-26 13:11:06', 'aktif'),
(71, 182, '3671012506930002', 'Kantor', 36, 'BANTEN', 71, 'KOTA TANGERANG', 9, 'CIBODAS', 1003, 'CIBODAS BARU', 'jln Sriwijaya 1 no27 Bencongan indah', 'Asep', '082211337572', 0, '2021-08-25 08:24:05', '2023-03-26 13:11:06', 'aktif'),
(77, 1696809676, '3315162107950003', 'Kantor', 36, 'BANTEN', 71, 'KOTA TANGERANG', 1, 'TANGERANG', 1007, 'SUKASARI', 'jln Sriwijaya 1 no27 Bencongan indah Kec kelapa dua kab tangerang Banten', 'Asepsoo', '082211557273', 0, '2021-09-01 10:03:44', '2023-03-26 13:11:06', 'nonaktif'),
(78, 1696809676, '3315162107950003', 'Kantor', 36, 'BANTEN', 71, 'KOTA TANGERANG', 9, 'CIBODAS', 1006, 'JATIUWUNG', 'jln Sriwijaya 1 no27 Bencongan indah Kec kelapa dua kab tangerang', 'Asep', '082211557273', 0, '2021-09-08 12:23:27', '2023-03-26 13:11:06', 'aktif'),
(79, 1696486046, '3671110702970001', 'testing', 51, 'BALI', 6, 'BANGLI', 2, 'BANGLI', 1004, 'KAWAN', 'Reee', 'test', '0830180381', 0, '2022-06-03 10:49:30', '2023-03-26 13:11:06', 'aktif'),
(80, 5, 'hypermartkarawaci', 'kantor', 36, 'BANTEN', 74, 'KOTA TANGERANG SELATAN', 4, 'CIPUTAT', 1006, 'JOMBANG', 'sdadasddasdasd', 'ogut', '3423423', 1, '2023-03-20 17:07:23', '2023-03-26 13:11:06', 'aktif'),
(81, NULL, '1781661229', 'kantor', 36, 'BANTEN', 74, 'KOTA TANGERANG SELATAN', 4, 'CIPUTAT', 1006, 'JOMBANG', 'dasdasdnlasndklnaslkdn asndjansldjansldnas d', 'dasdasd', '0893182938123', 0, '2023-03-26 10:23:22', '2023-03-26 13:11:06', 'aktif'),
(82, NULL, '1501298859', 'dasdasd', 36, 'BANTEN', 74, 'KOTA TANGERANG SELATAN', 4, 'CIPUTAT', 1006, 'JOMBANG', 'dasdas', 'dasdasd', '089823891823', 0, '2023-03-26 11:57:16', '2023-03-26 13:11:06', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `m_bahan_bakar`
--

CREATE TABLE `m_bahan_bakar` (
  `id_bahan_bakar` int(11) NOT NULL,
  `nama_bahan_bakar` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_bahan_bakar`
--

INSERT INTO `m_bahan_bakar` (`id_bahan_bakar`, `nama_bahan_bakar`, `status`) VALUES
(1, 'LPG. 3 KG', 1),
(2, 'LPG. 5 KG', 1),
(3, 'Minyak Tanah', 1),
(4, 'Kayu Bakar', 1),
(5, 'Lainnya', 1),
(6, 'Tidak tahu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_banner`
--

CREATE TABLE `m_banner` (
  `id_banner` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `image` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(800) CHARACTER SET utf8 DEFAULT NULL,
  `telepon` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `jenis` enum('url','telepon','halaman','produk','umkm','berita','agenda') CHARACTER SET utf8 DEFAULT NULL,
  `status` enum('0','1') CHARACTER SET utf8 DEFAULT '1',
  `halaman` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `id_jenis` int(11) DEFAULT NULL COMMENT 'primary key dari jenis yg dipilih, ex : id_produk',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL COMMENT 'username',
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL COMMENT 'username'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_banner`
--

INSERT INTO `m_banner` (`id_banner`, `title`, `image`, `url`, `telepon`, `jenis`, `status`, `halaman`, `id_jenis`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Testing banner produk', '814caa16291f5d34f9a2e2103502b915.jpg', 'http://172.16.10.57/umkm/list-produk/kategori/kuliner', NULL, 'url', '1', NULL, NULL, '2020-12-17 07:36:06', '198602132011011002', '2023-03-26 14:01:01', 'egov'),
(2, 'Testing banner umkm', '10a727e98f59d85a43b23a3ac0e17e96.jpg', 'http://172.16.10.57/umkm/list-produk/kategori/gadget-dan-elektronik', NULL, 'url', '1', NULL, NULL, '2020-12-17 08:33:05', '198602132011011002', '2023-03-26 14:01:12', 'egov');

-- --------------------------------------------------------

--
-- Table structure for table `m_banner_produk`
--

CREATE TABLE `m_banner_produk` (
  `id_banner_produk` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `url` varchar(800) DEFAULT NULL,
  `status` enum('0','1') CHARACTER SET utf8 DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL COMMENT 'username',
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL COMMENT 'username'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_banner_produk`
--

INSERT INTO `m_banner_produk` (`id_banner_produk`, `title`, `image`, `id_produk`, `url`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'testing', 'Group_13366.png', 66, 'http://172.16.10.57/umkm/list-produk/produk/kflWfa', '1', '2020-12-17 09:47:52', '198602132011011002', NULL, NULL),
(2, 'testing2', 'Group_13355.png', 65, 'http://172.16.10.57/umkm/list-produk/produk/kflWzU', '1', '2020-12-17 09:56:53', '198602132011011002', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_bentuk_usaha`
--

CREATE TABLE `m_bentuk_usaha` (
  `id_bentuk_usaha` int(11) NOT NULL,
  `nama_bentuk_usaha` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_bentuk_usaha`
--

INSERT INTO `m_bentuk_usaha` (`id_bentuk_usaha`, `nama_bentuk_usaha`, `status`) VALUES
(1, 'PT. Persero', 1),
(2, 'PT.', 1),
(3, 'CV.', 1),
(4, 'Firma', 1),
(5, 'Koperasi', 1),
(6, 'Yayasan', 1),
(7, 'Badan Hukum Lainnya', 1),
(8, 'Tidak Berbadan Hukum/Perorangan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_berita`
--

CREATE TABLE `m_berita` (
  `id_berita` int(11) NOT NULL,
  `kode_berita` varchar(10) DEFAULT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `berita` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status_berita` varchar(15) DEFAULT NULL,
  `dilihat` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_berita`
--

INSERT INTO `m_berita` (`id_berita`, `kode_berita`, `id_pengguna`, `username`, `foto`, `judul`, `berita`, `created_at`, `updated_at`, `status_berita`, `dilihat`) VALUES
(1, '1679836466', 1, 'admin', 'f4d6ae78ab9db87e6050e703c3ea6bf6.jpg', 'Lorem Ipsum i', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n', '2023-03-26 20:14:26', NULL, 'aktif', 0);

-- --------------------------------------------------------

--
-- Table structure for table `m_dasar_hukum`
--

CREATE TABLE `m_dasar_hukum` (
  `id_dasar_hukum` int(11) NOT NULL,
  `kode_dasar_hukum` varchar(10) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `m_data_vaksin`
--

CREATE TABLE `m_data_vaksin` (
  `id_vaksin` int(11) NOT NULL,
  `tanggal` varchar(10) DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `kabupaten` varchar(50) DEFAULT NULL,
  `faskes` varchar(50) DEFAULT NULL,
  `nik` varchar(17) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` varchar(15) DEFAULT NULL,
  `kelompok_usia` varchar(10) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `sub_kategori` varchar(50) DEFAULT NULL,
  `vaksinasi` varchar(25) DEFAULT NULL,
  `tiket_vaksinasi` varchar(25) DEFAULT NULL,
  `jenis_vaksin` varchar(25) DEFAULT NULL,
  `no_kec_siak` varchar(5) DEFAULT NULL,
  `kec_siak` varchar(100) DEFAULT NULL,
  `no_kel_siak` varchar(5) DEFAULT NULL,
  `kel_siak` varchar(100) DEFAULT NULL,
  `rt_siak` varchar(4) DEFAULT NULL,
  `rw_siak` varchar(4) DEFAULT NULL,
  `alamat_siak` varchar(255) DEFAULT NULL,
  `kode_kategori` varchar(100) DEFAULT NULL,
  `tgl_lahir` varchar(255) DEFAULT NULL,
  `usia` varchar(4) DEFAULT NULL,
  `tanggal_vaksinasi` datetime DEFAULT NULL,
  `tanggal_bc` varchar(255) DEFAULT NULL,
  `ket_double` varchar(255) DEFAULT NULL,
  `jns_pkrjn` varchar(255) DEFAULT NULL,
  `sumber_data` varchar(255) DEFAULT NULL,
  `flag_status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `m_diskusi`
--

CREATE TABLE `m_diskusi` (
  `id_diskusi` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `pesan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `read_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `m_diskusi_balasan`
--

CREATE TABLE `m_diskusi_balasan` (
  `id_diskusi_balasan` int(11) NOT NULL,
  `id_diskusi` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `pesan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `read_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `m_group`
--

CREATE TABLE `m_group` (
  `id_group` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_group`
--

INSERT INTO `m_group` (`id_group`, `nama`) VALUES
(1, 'Administrator'),
(2, 'Customer'),
(3, 'Verifikator');

-- --------------------------------------------------------

--
-- Table structure for table `m_history`
--

CREATE TABLE `m_history` (
  `id_history` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_history`
--

INSERT INTO `m_history` (`id_history`, `id_produk`, `username`, `created_at`) VALUES
(1, 1, '1781661229', '2023-03-26 19:57:15'),
(2, 1, '1781661229', '2023-03-26 19:28:16'),
(3, 1, 'rianto@gmail.com', '2023-03-26 19:51:16'),
(4, 1, 'rianto@gmail.com', '2023-03-26 19:32:18'),
(5, 1, 'rianto@gmail.com', '2023-03-26 19:20:19'),
(6, 1, 'rianto@gmail.com', '2023-03-26 19:28:19'),
(7, 2, '1781661229', '2023-03-26 20:27:04'),
(8, 1, '1781661229', '2023-03-26 20:05:05'),
(9, 1, '1781661229', '2023-03-26 20:48:07'),
(10, 1, '1781661229', '2023-03-26 20:13:12'),
(11, 1, '1781661229', '2023-03-26 20:22:12'),
(12, 1, '1781661229', '2023-03-26 20:33:12'),
(13, 2, '1781661229', '2023-03-26 20:24:28'),
(14, 2, '1781661229', '2023-03-26 20:14:30');

-- --------------------------------------------------------

--
-- Table structure for table `m_jenis_usaha`
--

CREATE TABLE `m_jenis_usaha` (
  `id_jenis_usaha` int(11) NOT NULL,
  `nama_usaha` varchar(100) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_show_home` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_jenis_usaha`
--

INSERT INTO `m_jenis_usaha` (`id_jenis_usaha`, `nama_usaha`, `icon`, `banner`, `status`, `is_show_home`) VALUES
(1, 'Celana', 'KATEGORI_SABA_KOTA-08.png', 'Mask_Group_11@2x.png', 1, 1),
(2, 'Jaket', 'KATEGORI_SABA_KOTA-03.png', 'Mask_Group_5@2x.png', 1, 1),
(3, 'Baju', 'KATEGORI_SABA_KOTA-02.png', 'Mask_Group_4@2x.png', 1, 1),
(4, 'Aksesoris', 'KATEGORI_SABA_KOTA-05.png', 'Mask_Group_10@2x.png', 1, NULL),
(5, 'Sepatu', 'KATEGORI_SABA_KOTA-04.png', 'Mask_Group_6@2x.png', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_kecamatan`
--

CREATE TABLE `m_kecamatan` (
  `no_kec` int(11) NOT NULL,
  `nama_kec` varchar(255) DEFAULT NULL,
  `no_kab` int(11) DEFAULT NULL,
  `no_prop` int(11) DEFAULT NULL,
  `id_subdistrict_ongkir` int(11) DEFAULT NULL COMMENT 'id kec sesuai dengan raja ongkir'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_kecamatan`
--

INSERT INTO `m_kecamatan` (`no_kec`, `nama_kec`, `no_kab`, `no_prop`, `id_subdistrict_ongkir`) VALUES
(1, 'TANGERANG', 71, 36, 6309),
(2, 'JATIUWUNG', 71, 36, 6302),
(3, 'BATU CEPER', 71, 36, 6297),
(4, 'BENDA', 71, 36, 6298),
(5, 'CIPONDOH', 71, 36, 6301),
(6, 'CILEDUG', 71, 36, 6300),
(7, 'KARAWACI', 71, 36, 6304),
(8, 'PERIUK', 71, 36, 6307),
(9, 'CIBODAS', 71, 36, 6299),
(10, 'NEGLASARI', 71, 36, 6306),
(11, 'PINANG', 71, 36, 6308),
(12, 'KARANG TENGAH', 71, 36, 6303),
(13, 'LARANGAN', 71, 36, 6305);

-- --------------------------------------------------------

--
-- Table structure for table `m_kelurahan`
--

CREATE TABLE `m_kelurahan` (
  `id_kel` int(11) NOT NULL,
  `no_kel` int(11) DEFAULT NULL,
  `nama_kel` varchar(255) DEFAULT NULL,
  `no_kec` int(11) DEFAULT NULL,
  `no_kab` int(11) DEFAULT NULL,
  `no_prop` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_kelurahan`
--

INSERT INTO `m_kelurahan` (`id_kel`, `no_kel`, `nama_kel`, `no_kec`, `no_kab`, `no_prop`) VALUES
(1, 1001, 'SUKARASA', 1, 71, 36),
(2, 1002, 'SUKAASIH', 1, 71, 36),
(3, 1003, 'TANAH TINGGI', 1, 71, 36),
(4, 1004, 'BUARAN INDAH', 1, 71, 36),
(5, 1005, 'CIKOKOL', 1, 71, 36),
(6, 1006, 'KELAPA INDAH', 1, 71, 36),
(7, 1007, 'SUKASARI', 1, 71, 36),
(8, 1008, 'BABAKAN', 1, 71, 36),
(9, 1005, 'MANIS JAYA', 2, 71, 36),
(10, 1006, 'ALAM JAYA', 2, 71, 36),
(11, 1003, 'PASIR JAYA', 2, 71, 36),
(12, 1004, 'GANDASARI', 2, 71, 36),
(13, 1001, 'KERONCONG', 2, 71, 36),
(14, 1002, 'JATAKE', 2, 71, 36),
(15, 1002, 'BATUJAYA', 3, 71, 36),
(16, 1003, 'PORIS GAGA', 3, 71, 36),
(17, 1005, 'KEBON BESAR', 3, 71, 36),
(18, 1007, 'PORIS JAYA', 3, 71, 36),
(19, 1001, 'BATUCEPER', 3, 71, 36),
(20, 1006, 'BATUSARI', 3, 71, 36),
(21, 1004, 'PORIS GAGA BARU', 3, 71, 36),
(22, 1001, 'BELENDUNG', 4, 71, 36),
(23, 1002, 'JURUMUDI', 4, 71, 36),
(24, 1003, 'BENDA', 4, 71, 36),
(25, 1004, 'PAJANG', 4, 71, 36),
(26, 1005, 'JURUMUDI BARU', 4, 71, 36),
(27, 1002, 'CIPONDOH MAKMUR', 5, 71, 36),
(28, 1003, 'CIPONDOH INDAH', 5, 71, 36),
(29, 1004, 'GONDRONG', 5, 71, 36),
(30, 1005, 'KENANGA', 5, 71, 36),
(31, 1006, 'PETIR', 5, 71, 36),
(32, 1008, 'PORIS PLAWAD', 5, 71, 36),
(33, 1009, 'PORIS PLAWAD UTARA', 5, 71, 36),
(34, 1010, 'PORIS PLAWAD INDAH', 5, 71, 36),
(35, 1001, 'CIPONDOH', 5, 71, 36),
(36, 1007, 'KETAPANG', 5, 71, 36),
(37, 1001, 'PANINGGILAN', 6, 71, 36),
(38, 1002, 'SUDIMARA BARAT', 6, 71, 36),
(39, 1005, 'PARUNG SERAB', 6, 71, 36),
(40, 1006, 'SUDIMARA JAYA', 6, 71, 36),
(41, 1004, 'TAJUR', 6, 71, 36),
(42, 1007, 'SUDIMARA SELATAN', 6, 71, 36),
(43, 1008, 'PANINGGILAN UTARA', 6, 71, 36),
(44, 1003, 'SUDIMARA TIMUR', 6, 71, 36),
(45, 1002, 'BOJONG JAYA', 7, 71, 36),
(46, 1003, 'KARAWACI BARU', 7, 71, 36),
(47, 1007, 'PABUARAN', 7, 71, 36),
(48, 1008, 'SUMUR PACING', 7, 71, 36),
(49, 1011, 'PABUARAN TUMPENG', 7, 71, 36),
(50, 1012, 'NAMBO JAYA', 7, 71, 36),
(51, 1016, 'KOANG JAYA', 7, 71, 36),
(52, 1001, 'KARAWACI', 7, 71, 36),
(53, 1010, 'MARGASARI', 7, 71, 36),
(54, 1014, 'SUKAJADI', 7, 71, 36),
(55, 1006, 'CIMONE JAYA', 7, 71, 36),
(56, 1015, 'PASAR BARU', 7, 71, 36),
(57, 1004, 'NUSA JAYA', 7, 71, 36),
(58, 1005, 'CIMONE', 7, 71, 36),
(59, 1009, 'BUGEL', 7, 71, 36),
(60, 1013, 'GERENDENG', 7, 71, 36),
(64, 1003, 'GEBANG RAYA', 8, 71, 36),
(65, 1004, 'SANGIANG JAYA', 8, 71, 36),
(66, 1005, 'PERIUK JAYA', 8, 71, 36),
(67, 1001, 'PERIUK', 8, 71, 36),
(68, 1002, 'GEMBOR', 8, 71, 36),
(69, 1003, 'CIBODAS BARU', 9, 71, 36),
(70, 1004, 'PANUNGGANGAN BARAT', 9, 71, 36),
(71, 1005, 'UWUNG JAYA', 9, 71, 36),
(72, 1001, 'CIBODAS', 9, 71, 36),
(73, 1002, 'CIBODASARI', 9, 71, 36),
(74, 1006, 'JATIUWUNG', 9, 71, 36),
(75, 1001, 'NEGLASARI', 10, 71, 36),
(76, 1002, 'KARANG SARI', 10, 71, 36),
(77, 1005, 'MEKARSARI', 10, 71, 36),
(78, 1006, 'KARANG ANYAR', 10, 71, 36),
(79, 1007, 'KEDAUNG BARU', 10, 71, 36),
(80, 1003, 'SELAPAJANG JAYA', 10, 71, 36),
(81, 1004, 'KEDAUNG WETAN', 10, 71, 36),
(82, 1001, 'PINANG', 11, 71, 36),
(83, 1002, 'SUDIMARA PINANG', 11, 71, 36),
(84, 1005, 'KUNCIRAN INDAH', 11, 71, 36),
(85, 1006, 'KUNCIRAN JAYA', 11, 71, 36),
(86, 1008, 'PAKOJAN', 11, 71, 36),
(87, 1010, 'PANUNGGANGAN UTARA', 11, 71, 36),
(88, 1011, 'PANUNGGANGAN TIMUR', 11, 71, 36),
(89, 1003, 'NEROKTOG', 11, 71, 36),
(90, 1007, 'CIPETE', 11, 71, 36),
(91, 1009, 'PANUNGGANGAN', 11, 71, 36),
(92, 1004, 'KUNCIRAN', 11, 71, 36),
(93, 1006, 'PEDURENAN', 12, 71, 36),
(94, 1007, 'PARUNG JAYA', 12, 71, 36),
(95, 1001, 'KARANG TENGAH', 12, 71, 36),
(96, 1002, 'KARANG MULYA', 12, 71, 36),
(97, 1003, 'PONDOK BAHAR', 12, 71, 36),
(98, 1004, 'PONDOK PUCUNG', 12, 71, 36),
(99, 1005, 'KARANG TIMUR', 12, 71, 36),
(100, 1001, 'LARANGAN UTARA', 13, 71, 36),
(101, 1002, 'LARANGAN SELATAN', 13, 71, 36),
(102, 1005, 'LARANGAN INDAH', 13, 71, 36),
(103, 1006, 'GAGA', 13, 71, 36),
(104, 1008, 'KREO SELATAN', 13, 71, 36),
(105, 1004, 'KREO', 13, 71, 36),
(106, 1007, 'CIPADU JAYA', 13, 71, 36),
(107, 1003, 'CIPADU', 13, 71, 36);

-- --------------------------------------------------------

--
-- Table structure for table `m_keranjang`
--

CREATE TABLE `m_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'simpan' COMMENT 'simpan,hapus',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `is_checked` tinyint(1) DEFAULT 0 COMMENT '1 atau 0',
  `size` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_keranjang`
--

INSERT INTO `m_keranjang` (`id_keranjang`, `id_produk`, `username`, `status`, `created_at`, `updated_at`, `quantity`, `is_checked`, `size`) VALUES
(15, 1, 'rianto@gmail.com', 'simpan', '2023-03-26 19:19:32', '2023-03-26 19:19:36', 1, 1, 'L');

-- --------------------------------------------------------

--
-- Table structure for table `m_kode_pos`
--

CREATE TABLE `m_kode_pos` (
  `id_kode_pos` int(11) NOT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `kode_wilayah` varchar(50) DEFAULT NULL,
  `kelurahan` varchar(255) DEFAULT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  `id_kelurahan` int(11) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `id_kabkota` int(11) DEFAULT NULL,
  `kabkota` varchar(255) DEFAULT NULL,
  `id_provinsi` int(11) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_kode_pos`
--

INSERT INTO `m_kode_pos` (`id_kode_pos`, `kode_pos`, `kode_wilayah`, `kelurahan`, `id_kecamatan`, `id_kelurahan`, `kecamatan`, `id_kabkota`, `kabkota`, `id_provinsi`, `provinsi`) VALUES
(1, ' 15315', '36.74.07.1006', 'Bakti Jaya', NULL, NULL, 'Setu', 74, 'KOTA TANGSEL', 36, 'Banten'),
(2, ' 15313', '36.74.07.1004', 'Kademangan', NULL, NULL, 'Setu', 74, 'KOTA TANGSEL', 36, 'Banten'),
(3, ' 15312', '36.74.07.1003', 'Keranggan (Kranggan)', NULL, NULL, 'Setu', 74, 'KOTA TANGSEL', 36, 'Banten'),
(4, ' 15314', '36.74.07.1001', 'Muncul', NULL, NULL, 'Setu', 74, 'KOTA TANGSEL', 36, 'Banten'),
(5, ' 15314', '36.74.07.1002', 'Setu', NULL, NULL, 'Setu', 74, 'KOTA TANGSEL', 36, 'Banten'),
(6, ' 15323', '36.74.02.1006', 'Jelupang', NULL, NULL, 'Serpong Utara', 74, 'KOTA TANGSEL', 36, 'Banten'),
(7, ' 15320', '36.74.02.1007', 'Lengkong Karya', NULL, NULL, 'Serpong Utara', 74, 'KOTA TANGSEL', 36, 'Banten'),
(8, ' 15320', '36.74.02.1002', 'Pakualam', NULL, NULL, 'Serpong Utara', 74, 'KOTA TANGSEL', 36, 'Banten'),
(9, ' 15324', '36.74.02.1003', 'Pakujaya (Paku Jaya)', NULL, NULL, 'Serpong Utara', 74, 'KOTA TANGSEL', 36, 'Banten'),
(10, ' 15325', '36.74.02.1001', 'Pakulonan', NULL, NULL, 'Serpong Utara', 74, 'KOTA TANGSEL', 36, 'Banten'),
(11, ' 15326', '36.74.02.1004', 'Pondok Jagung', NULL, NULL, 'Serpong Utara', 74, 'KOTA TANGSEL', 36, 'Banten'),
(12, ' 15326', '36.74.02.1005', 'Pondok Jagung Timur', NULL, NULL, 'Serpong Utara', 74, 'KOTA TANGSEL', 36, 'Banten'),
(13, ' 15310', '36.74.01.1006', 'Buaran', NULL, NULL, 'Serpong', 74, 'KOTA TANGSEL', 36, 'Banten'),
(14, ' 15310', '36.74.01.1001', 'Ciater', NULL, NULL, 'Serpong', 74, 'KOTA TANGSEL', 36, 'Banten'),
(15, ' 15310', '36.74.01.1008', 'Cilenggang', NULL, NULL, 'Serpong', 74, 'KOTA TANGSEL', 36, 'Banten'),
(16, ' 15321', '36.74.01.1004', 'Lengkong Gudang', NULL, NULL, 'Serpong', 74, 'KOTA TANGSEL', 36, 'Banten'),
(17, ' 15321', '36.74.01.1007', 'Lengkong Gudang Timur', NULL, NULL, 'Serpong', 74, 'KOTA TANGSEL', 36, 'Banten'),
(18, ' 15322', '36.74.01.1005', 'Lengkong Wetan', NULL, NULL, 'Serpong', 74, 'KOTA TANGSEL', 36, 'Banten'),
(19, ' 15310', '36.74.01.1003', 'Rawa Mekarjaya (Rawa Mekar Jaya)', NULL, NULL, 'Serpong', 74, 'KOTA TANGSEL', 36, 'Banten'),
(20, ' 15318', '36.74.01.1002', 'Rawabuntu (Rawa Buntu)', NULL, NULL, 'Serpong', 74, 'KOTA TANGSEL', 36, 'Banten'),
(21, ' 15311', '36.74.01.1009', 'Serpong', NULL, NULL, 'Serpong', 74, 'KOTA TANGSEL', 36, 'Banten'),
(22, ' 15315', '36.74.07.1005', 'Babakan', NULL, 1008, 'Setu', 74, 'KOTA TANGSEL', 36, 'Banten'),
(23, ' 42278', '36.01.14.2012', 'Girijaya', NULL, NULL, 'Saketi', 1, 'KAB. PANDEGLANG', 36, 'Banten'),
(24, ' 42278', '36.01.14.2007', 'Kadudampit', NULL, NULL, 'Saketi', 1, 'KAB. PANDEGLANG', 36, 'Banten'),
(25, ' 42278', '36.01.14.2001', 'Langensari', NULL, NULL, 'Saketi', 1, 'KAB. PANDEGLANG', 36, 'Banten'),
(26, ' 42278', '36.01.14.2003', 'Majau', NULL, NULL, 'Saketi', 1, 'KAB. PANDEGLANG', 36, 'Banten'),
(27, ' 42278', '36.01.14.2002', 'Medalsari', NULL, NULL, 'Saketi', 1, 'KAB. PANDEGLANG', 36, 'Banten'),
(28, ' 42278', '36.01.14.2010', 'Mekarwangi', NULL, NULL, 'Saketi', 1, 'KAB. PANDEGLANG', 36, 'Banten'),
(29, ' 42278', '36.01.14.2009', 'Parigi', NULL, NULL, 'Saketi', 1, 'KAB. PANDEGLANG', 36, 'Banten'),
(30, ' 42278', '36.01.14.2011', 'Saketi', NULL, NULL, 'Saketi', 1, 'KAB. PANDEGLANG', 36, 'Banten'),
(31, ' 42278', '36.01.14.2013', 'Sindanghayu', NULL, NULL, 'Saketi', 1, 'KAB. PANDEGLANG', 36, 'Banten'),
(32, ' 42278', '36.01.14.2004', 'Sodong', NULL, NULL, 'Saketi', 1, 'KAB. PANDEGLANG', 36, 'Banten'),
(33, ' 42278', '36.01.14.2014', 'Sukalangu', NULL, NULL, 'Saketi', 1, 'KAB. PANDEGLANG', 36, 'Banten'),
(34, ' 42278', '36.01.14.2005', 'Talagasari', NULL, NULL, 'Saketi', 1, 'KAB. PANDEGLANG', 36, 'Banten'),
(35, ' 42278', '36.01.14.2008', 'Wanagiri', NULL, NULL, 'Saketi', 1, 'KAB. PANDEGLANG', 36, 'Banten'),
(36, ' 42278', '36.01.14.2006', 'Ciandur', NULL, NULL, 'Saketi', 1, 'KAB. PANDEGLANG', 36, 'Banten'),
(37, ' 42371', '36.02.12.2004', 'Calungbungur', NULL, NULL, 'Sajira', 2, 'KAB. LEBAK', 36, 'Banten'),
(38, ' 42371', '36.02.12.2015', 'Ciuyah', NULL, NULL, 'Sajira', 2, 'KAB. LEBAK', 36, 'Banten'),
(39, ' 42371', '36.02.12.2001', 'Maraya', NULL, NULL, 'Sajira', 2, 'KAB. LEBAK', 36, 'Banten'),
(40, ' 42371', '36.02.12.2013', 'Margaluyu', NULL, NULL, 'Sajira', 2, 'KAB. LEBAK', 36, 'Banten'),
(41, ' 42371', '36.02.12.2007', 'Mekarsari', NULL, 1005, 'Sajira', 2, 'KAB. LEBAK', 36, 'Banten'),
(42, ' 42371', '36.02.12.2012', 'Paja', NULL, NULL, 'Sajira', 2, 'KAB. LEBAK', 36, 'Banten'),
(43, ' 42371', '36.02.12.2009', 'Pajagan', NULL, NULL, 'Sajira', 2, 'KAB. LEBAK', 36, 'Banten'),
(44, ' 42371', '36.02.12.2005', 'Parungsari', NULL, NULL, 'Sajira', 2, 'KAB. LEBAK', 36, 'Banten'),
(45, ' 42371', '36.02.12.2002', 'Sajira', NULL, NULL, 'Sajira', 2, 'KAB. LEBAK', 36, 'Banten'),
(46, ' 42371', '36.02.12.2011', 'Sajira Mekar (Sajiramekar)', NULL, NULL, 'Sajira', 2, 'KAB. LEBAK', 36, 'Banten'),
(47, ' 42371', '36.02.12.2006', 'Sindangsari', NULL, NULL, 'Sajira', 2, 'KAB. LEBAK', 36, 'Banten'),
(48, ' 42371', '36.02.12.2010', 'Sukajaya', NULL, NULL, 'Sajira', 2, 'KAB. LEBAK', 36, 'Banten'),
(49, ' 42371', '36.02.12.2008', 'Sukamarga', NULL, NULL, 'Sajira', 2, 'KAB. LEBAK', 36, 'Banten'),
(50, ' 42371', '36.02.12.2003', 'Sukarame', NULL, NULL, 'Sajira', 2, 'KAB. LEBAK', 36, 'Banten'),
(51, ' 42317', '36.02.14.1006', 'Cijoro Lebak', NULL, NULL, 'Rangkasbitung', 2, 'KAB. LEBAK', 36, 'Banten'),
(52, ' 42316', '36.02.14.1008', 'Cijoro Pasir', NULL, NULL, 'Rangkasbitung', 2, 'KAB. LEBAK', 36, 'Banten'),
(53, ' 42312', '36.02.14.2021', 'Cimangeunteung (Cimangeungteung)', NULL, NULL, 'Rangkasbitung', 2, 'KAB. LEBAK', 36, 'Banten'),
(54, ' 42312', '36.02.14.2009', 'Citeras', NULL, NULL, 'Rangkasbitung', 2, 'KAB. LEBAK', 36, 'Banten'),
(55, ' 42315', '36.02.14.2013', 'Jatimulya', NULL, NULL, 'Rangkasbitung', 2, 'KAB. LEBAK', 36, 'Banten'),
(56, ' 42312', '36.02.14.2011', 'Kolelet Wetan', NULL, NULL, 'Rangkasbitung', 2, 'KAB. LEBAK', 36, 'Banten'),
(57, ' 42312', '36.02.14.2014', 'Mekarsari', NULL, 1005, 'Rangkasbitung', 2, 'KAB. LEBAK', 36, 'Banten'),
(58, ' 42311', '36.02.14.1007', 'Muara Ciujung Barat', NULL, NULL, 'Rangkasbitung', 2, 'KAB. LEBAK', 36, 'Banten'),
(59, ' 42314', '36.02.14.1012', 'Muara Ciujung Timur', NULL, NULL, 'Rangkasbitung', 2, 'KAB. LEBAK', 36, 'Banten'),
(60, ' 42312', '36.02.14.2010', 'Nameng', NULL, NULL, 'Rangkasbitung', 2, 'KAB. LEBAK', 36, 'Banten'),
(61, ' 42319', '36.02.14.2023', 'Narimbang Mulia', NULL, NULL, 'Rangkasbitung', 2, 'KAB. LEBAK', 36, 'Banten'),
(62, ' 42312', '36.02.14.2016', 'Pabuaran', NULL, 1007, 'Rangkasbitung', 2, 'KAB. LEBAK', 36, 'Banten'),
(63, ' 42312', '36.02.14.2001', 'Pasirtanjung', NULL, NULL, 'Rangkasbitung', 2, 'KAB. LEBAK', 36, 'Banten'),
(64, ' 42312', '36.02.14.1002', 'Rangkasbitung Barat', NULL, NULL, 'Rangkasbitung', 2, 'KAB. LEBAK', 36, 'Banten'),
(65, ' 42313', '36.02.14.2017', 'Rangkasbitung Timur', NULL, NULL, 'Rangkasbitung', 2, 'KAB. LEBAK', 36, 'Banten'),
(66, ' 42312', '36.02.14.2019', 'Sukamanah', NULL, NULL, 'Rangkasbitung', 2, 'KAB. LEBAK', 36, 'Banten'),
(67, ' 42371', '36.02.12.2014', 'Bungurmekar (Bangunmekar)', NULL, NULL, 'Rangkasbitung', 2, 'KAB. LEBAK', 36, 'Banten'),
(68, ' 15720', '36.03.04.2009', 'Ancol Pasir', NULL, NULL, 'Jambe', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(69, ' 15820', '36.03.20.1011', 'Babakan', NULL, 1008, 'Legok', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(70, ' 15510', '36.03.13.2003', 'Babakan Asem', NULL, NULL, 'Teluknaga', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(71, ' 15820', '36.03.20.2004', 'Babat', NULL, NULL, 'Legok', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(72, ' 15561', '36.03.29.2007', 'Badak Anom', NULL, NULL, 'Sindang Jaya', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(73, ' 15550', '36.03.07.2013', 'Bakung', NULL, NULL, 'Kronjo', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(74, ' 15610', '36.03.01.1001', 'Balaraja', NULL, NULL, 'Balaraja', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(75, ' 15721', '36.03.03.2014', 'Bantar Panjang', NULL, NULL, 'Tigaraksa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(76, ' 15531', '36.03.08.2011', 'Banyu Asih', NULL, NULL, 'Mauk', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(77, ' 15212', '36.03.14.2008', 'Belimbing', NULL, NULL, 'Kosambi', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(78, ' 15811', '36.03.28.1002', 'Bencongan', NULL, NULL, 'Kelapa Dua', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(79, ' 15811', '36.03.28.1003', 'Bencongan Indah', NULL, NULL, 'Kelapa Dua', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(80, ' 15612', '36.03.27.2001', 'Benda', NULL, 1003, 'Sukamulya', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(81, ' 15810', '36.03.17.1006', 'Binong', NULL, NULL, 'Curug', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(82, ' 15710', '36.03.18.2009', 'Bitung Jaya', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(83, ' 15550', '36.03.07.2015', 'Blukbuk', NULL, NULL, 'Kronjo', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(84, ' 15710', '36.03.18.2014', 'Bojong', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(85, ' 15730', '36.03.05.2006', 'Bojong Loa (Bojongloa)', NULL, NULL, 'Cisoka', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(86, ' 15811', '36.03.28.1005', 'Bojong Nangka', NULL, NULL, 'Kelapa Dua', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(87, ' 15510', '36.03.13.2002', 'Bojong Renged', NULL, NULL, 'Teluknaga', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(88, ' 15820', '36.03.20.2008', 'Bojongkamal (Bojong Kamal)', NULL, NULL, 'Legok', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(89, ' 15570', '36.03.15.2006', 'Buaran Bambu', NULL, NULL, 'Pakuhaji', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(90, ' 15532', '36.03.10.2002', 'Buaran Jati', NULL, NULL, 'Sukadiri', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(91, ' 15570', '36.03.15.2005', 'Buaran Mangga', NULL, NULL, 'Pakuhaji', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(92, ' 15710', '36.03.18.2013', 'Budi Mulya', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(93, ' 15612', '36.03.27.2007', 'Bunar', NULL, NULL, 'Sukamulya', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(94, ' 15710', '36.03.18.1003', 'Bunder', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(95, ' 15612', '36.03.27.2004', 'Buniayu (Buni Ayu)', NULL, NULL, 'Sukamulya', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(96, ' 15570', '36.03.15.2003', 'Bunisari (Bonasari)', NULL, NULL, 'Pakuhaji', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(97, ' 15610', '36.03.01.2003', 'Cangkudu', NULL, NULL, 'Balaraja', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(98, ' 15730', '36.03.05.2009', 'Carenang', NULL, NULL, 'Cisoka', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(99, ' 15730', '36.03.05.2002', 'Caringin', NULL, NULL, 'Cisoka', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(100, ' 15820', '36.03.20.2002', 'Caringin', NULL, NULL, 'Legok', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(101, ' 15730', '36.03.05.2008', 'Cempaka', NULL, NULL, 'Cisoka', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(102, ' 15212', '36.03.14.2007', 'Cengklong', NULL, NULL, 'Kosambi', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(103, ' 15711', '36.03.19.2007', 'Ciakar', NULL, NULL, 'Panongan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(104, ' 15820', '36.03.20.2005', 'Ciangir', NULL, NULL, 'Legok', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(105, ' 15710', '36.03.18.2002', 'Cibadak', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(106, ' 15620', '36.03.32.2009', 'Cibetok', NULL, NULL, 'Gunung Kaler', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(107, ' 15344', '36.03.23.2011', 'Cibogo', NULL, NULL, 'Cisauk', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(108, ' 15730', '36.03.05.2007', 'Cibugel', NULL, NULL, 'Cisoka', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(109, ' 15336', '36.03.22.2002', 'Cicalengka', NULL, NULL, 'Pagedangan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(110, ' 15332', '36.03.22.2009', 'Cihuni', NULL, NULL, 'Pagedangan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(111, ' 15335', '36.03.22.2005', 'Cijantra', NULL, NULL, 'Pagedangan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(112, ' 15551', '36.03.33.2003', 'Cijeruk', NULL, NULL, 'Mekar Baru', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(113, ' 15611', '36.03.02.2008', 'Cikande', NULL, NULL, 'Jayanti', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(114, ' 15731', '36.03.31.2005', 'Cikareo', NULL, NULL, 'Solear', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(115, ' 15731', '36.03.31.2003', 'Cikasungka', NULL, NULL, 'Solear', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(116, ' 15710', '36.03.18.2007', 'Cikupa', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(117, ' 15731', '36.03.31.2002', 'Cikuya', NULL, NULL, 'Solear', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(118, ' 15721', '36.03.03.2011', 'Cileles', NULL, NULL, 'Tigaraksa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(119, ' 15620', '36.03.32.2005', 'Cipaeh', NULL, NULL, 'Gunung Kaler', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(120, ' 15820', '36.03.20.2012', 'Cirarab', NULL, NULL, 'Legok', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(121, ' 15731', '36.03.31.2004', 'Cireundeu', NULL, NULL, 'Solear', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(122, ' 15550', '36.03.07.2017', 'Cirumpak', NULL, NULL, 'Kronjo', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(123, ' 15341', '36.03.23.1001', 'Cisauk', NULL, NULL, 'Cisauk', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(124, ' 15721', '36.03.03.2009', 'Cisereh', NULL, NULL, 'Tigaraksa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(125, ' 15730', '36.03.05.2001', 'Cisoka', NULL, NULL, 'Cisoka', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(126, ' 15810', '36.03.17.2010', 'Cukanggalih (Cukang Galih)', NULL, NULL, 'Curug', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(127, ' 15810', '36.03.17.1001', 'Curug Kulon', NULL, NULL, 'Curug', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(128, ' 15811', '36.03.28.2006', 'Curug Sangerang (Curug Sangereng)', NULL, NULL, 'Kelapa Dua', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(129, ' 15810', '36.03.17.2002', 'Curug Wetan', NULL, NULL, 'Curug', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(130, ' 15211', '36.03.14.1010', 'Dadap', NULL, NULL, 'Kosambi', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(131, ' 15342', '36.03.23.2009', 'Dangdang', NULL, NULL, 'Cisauk', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(132, ' 15611', '36.03.02.2007', 'Dangdeur (Dang Deur)', NULL, NULL, 'Jayanti', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(133, ' 15540', '36.03.11.2013', 'Daon', NULL, NULL, 'Rajeg', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(134, ' 15720', '36.03.04.2005', 'Daru', NULL, NULL, 'Jambe', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(135, ' 15710', '36.03.18.2006', 'Dukuh', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(136, ' 15570', '36.03.15.2014', 'Gaga', NULL, 1006, 'Pakuhaji', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(137, ' 15551', '36.03.33.2008', 'Gandaria (Ganda Ria)', NULL, NULL, 'Mekar Baru', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(138, ' 15560', '36.03.12.2013', 'Gelam Jaya', NULL, NULL, 'Pasar Kemis', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(139, ' 15610', '36.03.01.2011', 'Gembong', NULL, NULL, 'Balaraja', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(140, ' 15521', '36.03.30.2005', 'Gempol Sari', NULL, NULL, 'Sepatan Timur', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(141, ' 15532', '36.03.10.2008', 'Gintung', NULL, NULL, 'Sukadiri', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(142, ' 15620', '36.03.32.2001', 'Gunung Kaler', NULL, NULL, 'Gunung Kaler', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(143, ' 15531', '36.03.08.2006', 'Gunung Sari', NULL, NULL, 'Mauk', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(144, ' 15720', '36.03.04.2002', 'Jambe', NULL, NULL, 'Jambe', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(145, ' 15540', '36.03.11.2005', 'Jambu Karya', NULL, NULL, 'Rajeg', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(146, ' 15330', '36.03.22.2008', 'Jatake', NULL, 1002, 'Pagedangan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(147, ' 15521', '36.03.30.2003', 'Jati Mulya', NULL, NULL, 'Sepatan Timur', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(148, ' 15211', '36.03.14.2009', 'Jati Mulya (Jatimulya)', NULL, NULL, 'Kosambi', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(149, ' 15531', '36.03.08.2010', 'Jatiwaringin (Jati Waringin)', NULL, NULL, 'Mauk', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(150, ' 15611', '36.03.02.2006', 'Jayanti', NULL, NULL, 'Jayanti', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(151, ' 15551', '36.03.33.2006', 'Jenggot', NULL, NULL, 'Mekar Baru', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(152, ' 15621', '36.03.06.2014', 'Jengkol', NULL, NULL, 'Kresek', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(153, ' 15730', '36.03.05.2017', 'Jeungjing (Jeung Jing)', NULL, NULL, 'Cisoka', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(154, ' 15810', '36.03.17.2003', 'Kadu', NULL, NULL, 'Curug', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(155, ' 15721', '36.03.03.1007', 'Kadu Agung', NULL, NULL, 'Tigaraksa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(156, ' 15810', '36.03.17.2004', 'Kadu Jaya', NULL, NULL, 'Curug', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(157, ' 15337', '36.03.22.2010', 'Kadu Sirung', NULL, NULL, 'Pagedangan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(158, ' 15612', '36.03.27.2003', 'Kaliasin (Kali Asin)', NULL, NULL, 'Sukamulya', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(159, ' 15570', '36.03.15.2007', 'Kalibaru', NULL, NULL, 'Pakuhaji', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(160, ' 15510', '36.03.13.2013', 'Kampung Besar', NULL, NULL, 'Teluknaga', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(161, ' 15521', '36.03.30.2006', 'Kampung Kelor', NULL, NULL, 'Sepatan Timur', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(162, ' 15510', '36.03.13.2007', 'Kampung Melayu Barat', NULL, NULL, 'Teluknaga', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(163, ' 15510', '36.03.13.2006', 'Kampung Melayu Timur', NULL, NULL, 'Teluknaga', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(164, ' 15820', '36.03.20.2010', 'Kamuning (Kemuning)', NULL, NULL, 'Legok', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(165, ' 15620', '36.03.32.2008', 'Kandawati (Kanda Wati)', NULL, NULL, 'Gunung Kaler', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(166, ' 15530', '36.03.09.2002', 'Karang Anyar', NULL, 1006, 'Kemiri', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(167, ' 15730', '36.03.05.2014', 'Karang Harja (Karangharja)', NULL, NULL, 'Cisoka', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(168, ' 15532', '36.03.10.2005', 'Karang Serang', NULL, NULL, 'Sukadiri', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(169, ' 15157', '36.03.22.2012', 'Karang Tengah', NULL, 1001, 'Pagedangan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(170, ' 15520', '36.03.16.2002', 'Karet', NULL, NULL, 'Sepatan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(171, ' 15520', '36.03.16.2003', 'Kayu Agung', NULL, NULL, 'Sepatan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(172, ' 15520', '36.03.16.2004', 'Kayu Bongkok', NULL, NULL, 'Sepatan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(173, ' 15510', '36.03.13.2004', 'Keboncau (Kebon Cau)', NULL, NULL, 'Teluknaga', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(174, ' 15551', '36.03.33.2002', 'Kedaung', NULL, NULL, 'Mekar Baru', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(175, ' 15521', '36.03.30.2001', 'Kedaung Barat', NULL, NULL, 'Sepatan Timur', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(176, ' 15620', '36.03.32.2004', 'Kedung', NULL, NULL, 'Gunung Kaler', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(177, ' 15531', '36.03.08.2007', 'Kedung Dalem', NULL, NULL, 'Mauk', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(178, ' 15811', '36.03.28.1001', 'Kelapa Dua', NULL, NULL, 'Kelapa Dua', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(179, ' 15530', '36.03.09.2004', 'Kemiri', NULL, NULL, 'Kemiri', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(180, ' 15621', '36.03.06.2007', 'Kemuning', NULL, NULL, 'Kresek', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(181, ' 15531', '36.03.08.2012', 'Ketapang', NULL, 1007, 'Mauk', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(182, ' 15570', '36.03.15.2012', 'Kiara Payung', NULL, NULL, 'Pakuhaji', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(183, ' 15530', '36.03.09.2006', 'Klebet (Kjlebet / Kelebet)', NULL, NULL, 'Kemiri', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(184, ' 15551', '36.03.33.2005', 'Klutuk', NULL, NULL, 'Mekar Baru', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(185, ' 15570', '36.03.15.2008', 'Kohod', NULL, NULL, 'Pakuhaji', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(186, ' 15621', '36.03.06.2013', 'Koper', NULL, NULL, 'Kresek', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(187, ' 15532', '36.03.10.2006', 'Kosambi', NULL, NULL, 'Sukadiri', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(188, ' 15213', '36.03.14.1001', 'Kosambi Barat', NULL, NULL, 'Kosambi', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(189, ' 15551', '36.03.33.2007', 'Kosambi Dalam', NULL, NULL, 'Mekar Baru', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(190, ' 15213', '36.03.14.2002', 'Kosambi Timur', NULL, NULL, 'Kosambi', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(191, ' 15570', '36.03.15.2009', 'Kramat', NULL, NULL, 'Pakuhaji', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(192, ' 15621', '36.03.06.2018', 'Kresek', NULL, NULL, 'Kresek', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(193, ' 15550', '36.03.07.2001', 'Kronjo', NULL, NULL, 'Kronjo', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(194, ' 15612', '36.03.27.2008', 'Kubang', NULL, NULL, 'Sukamulya', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(195, ' 15560', '36.03.12.1014', 'Kuta Baru', NULL, NULL, 'Pasar Kemis', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(196, ' 15560', '36.03.12.1012', 'Kuta Jaya', NULL, NULL, 'Pasar Kemis', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(197, ' 15560', '36.03.12.1010', 'Kutabumi (Kuta Bumi)', NULL, NULL, 'Pasar Kemis', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(198, ' 15720', '36.03.04.2006', 'Kutruk', NULL, NULL, 'Jambe', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(199, ' 15570', '36.03.15.2013', 'Laksana', NULL, NULL, 'Pakuhaji', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(200, ' 15521', '36.03.30.2002', 'Lebak Wangi', NULL, NULL, 'Sepatan Timur', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(201, ' 15820', '36.03.20.2006', 'Legok', NULL, NULL, 'Legok', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(202, ' 15530', '36.03.09.2007', 'Legok Suka Maju (Legok Sula Maju)', NULL, NULL, 'Kemiri', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(203, ' 15540', '36.03.11.2006', 'Lembangsari (Lembang Sari)', NULL, NULL, 'Rajeg', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(204, ' 15510', '36.03.13.2009', 'Lemo', NULL, NULL, 'Teluknaga', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(205, ' 15331', '36.03.22.2006', 'Lengkong Kulon', NULL, NULL, 'Pagedangan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(206, ' 15530', '36.03.09.2003', 'Lontar', NULL, NULL, 'Kemiri', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(207, ' 15330', '36.03.22.2011', 'Malang Nengah', NULL, NULL, 'Pagedangan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(208, ' 15531', '36.03.08.2008', 'Marga Mulya', NULL, NULL, 'Mauk', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(209, ' 15721', '36.03.03.2010', 'Margasari (Marga Sari)', NULL, NULL, 'Tigaraksa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(210, ' 15721', '36.03.03.2003', 'Matagara (Mata Gara)', NULL, NULL, 'Tigaraksa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(211, ' 15531', '36.03.08.2001', 'Mauk Barat', NULL, NULL, 'Mauk', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(212, ' 15531', '36.03.08.1002', 'Mauk Timur', NULL, NULL, 'Mauk', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(213, ' 15334', '36.03.22.1004', 'Medang', NULL, NULL, 'Pagedangan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(214, ' 15711', '36.03.19.1002', 'Mekar Bakti', NULL, NULL, 'Panongan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(215, ' 15551', '36.03.33.2001', 'Mekar Baru', NULL, NULL, 'Mekar Baru', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(216, ' 15711', '36.03.19.2006', 'Mekar Jaya', NULL, NULL, 'Panongan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(217, ' 15520', '36.03.16.2012', 'Mekar Jaya', NULL, NULL, 'Sepatan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(218, ' 15532', '36.03.10.2007', 'Mekar Kondang', NULL, NULL, 'Sukadiri', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(219, ' 15340', '36.03.23.2003', 'Mekar Wangi (Mekarwangi)', NULL, NULL, 'Cisauk', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(220, ' 15720', '36.03.04.2008', 'Mekarsari', NULL, 1005, 'Jambe', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(221, ' 15540', '36.03.11.2014', 'Mekarsari', NULL, 1005, 'Rajeg', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(222, ' 15612', '36.03.27.2006', 'Merak', NULL, NULL, 'Sukamulya', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(223, ' 15510', '36.03.13.2008', 'Muara', NULL, NULL, 'Teluknaga', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(224, ' 15550', '36.03.07.2007', 'Muncung', NULL, NULL, 'Kronjo', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(225, ' 15731', '36.03.31.2007', 'Munjul', NULL, NULL, 'Solear', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(226, ' 15620', '36.03.32.2006', 'Onyam', NULL, NULL, 'Gunung Kaler', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(227, ' 15611', '36.03.02.2002', 'Pabuaran', NULL, 1007, 'Jayanti', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(228, ' 15339', '36.03.22.2003', 'Pagedangan', NULL, NULL, 'Pagedangan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(229, ' 15550', '36.03.07.2008', 'Pagedangan Ilir', NULL, NULL, 'Kronjo', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(230, ' 15550', '36.03.07.2009', 'Pagedangan Udik', NULL, NULL, 'Kronjo', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(231, ' 15550', '36.03.07.2002', 'Pagenjahan', NULL, NULL, 'Kronjo', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(232, ' 15570', '36.03.15.2002', 'Paku Alam', NULL, NULL, 'Pakuhaji', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(233, ' 15570', '36.03.15.1001', 'Pakuhaji', NULL, NULL, 'Pakuhaji', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(234, ' 15811', '36.03.28.1004', 'Pakulonan Barat', NULL, NULL, 'Kelapa Dua', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(235, ' 15820', '36.03.20.2007', 'Palasari (Pala Sari)', NULL, NULL, 'Legok', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(236, ' 15560', '36.03.12.2011', 'Pangadegan', NULL, NULL, 'Pasar Kemis', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(237, ' 15540', '36.03.11.2003', 'Pangarengan', NULL, NULL, 'Rajeg', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(238, ' 15510', '36.03.13.2005', 'Pangkalan', NULL, NULL, 'Teluknaga', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(239, ' 15611', '36.03.02.2001', 'Pangkat', NULL, NULL, 'Jayanti', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(240, ' 15711', '36.03.19.2008', 'Panongan', NULL, NULL, 'Panongan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(241, ' 15612', '36.03.27.2005', 'Parahu', NULL, NULL, 'Sukamulya', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(242, ' 15731', '36.03.31.2006', 'Pasanggrahan', NULL, NULL, 'Solear', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(243, ' 15560', '36.03.12.2001', 'Pasar Kemis', NULL, NULL, 'Pasar Kemis', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(244, ' 15550', '36.03.07.2010', 'Pasilian', NULL, NULL, 'Kronjo', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(245, ' 15550', '36.03.07.2006', 'Pasir', NULL, NULL, 'Kronjo', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(246, ' 15621', '36.03.06.2001', 'Pasir Ampo', NULL, NULL, 'Kresek', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(247, ' 15720', '36.03.04.2010', 'Pasir Barat', NULL, NULL, 'Jambe', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(248, ' 15721', '36.03.03.2002', 'Pasir Bolang', NULL, NULL, 'Tigaraksa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(249, ' 15710', '36.03.18.2010', 'Pasir Gadung', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(250, ' 15611', '36.03.02.2009', 'Pasir Gintung', NULL, NULL, 'Jayanti', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(251, ' 15710', '36.03.18.2012', 'Pasir Jaya', NULL, 1003, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(252, ' 15611', '36.03.02.2004', 'Pasir Muncang', NULL, NULL, 'Jayanti', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(253, ' 15721', '36.03.03.2004', 'Pasir Nangka', NULL, NULL, 'Tigaraksa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(254, ' 15530', '36.03.09.2001', 'Patramanggala (Patra Manggala)', NULL, NULL, 'Kemiri', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(255, ' 15621', '36.03.06.2015', 'Patrasana (Patra Sana)', NULL, NULL, 'Kresek', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(256, ' 15532', '36.03.10.2004', 'Pekayon', NULL, NULL, 'Sukadiri', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(257, ' 15721', '36.03.03.2008', 'Pematang', NULL, NULL, 'Tigaraksa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(258, ' 15721', '36.03.03.2005', 'Pete', NULL, NULL, 'Tigaraksa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(259, ' 15711', '36.03.19.2003', 'Peusar', NULL, NULL, 'Panongan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(260, ' 15520', '36.03.16.2011', 'Pisangan Jaya', NULL, NULL, 'Sepatan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(261, ' 15520', '36.03.16.2008', 'Pondok Jaya', NULL, NULL, 'Sepatan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(262, ' 15521', '36.03.30.2007', 'Pondok Kelor', NULL, NULL, 'Sepatan Timur', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(263, ' 15540', '36.03.11.2001', 'Rajeg', NULL, NULL, 'Rajeg', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(264, ' 15540', '36.03.11.2002', 'Rajeg Mulya (Rajegmulya)', NULL, NULL, 'Rajeg', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(265, ' 15540', '36.03.11.2012', 'Ranca Bango', NULL, NULL, 'Rajeg', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(266, ' 15720', '36.03.04.2007', 'Ranca Buaya (Rancabuaya)', NULL, NULL, 'Jambe', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(267, ' 15711', '36.03.19.2001', 'Ranca Iyuh', NULL, NULL, 'Panongan', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(268, ' 15811', '36.03.28.1004', 'Pakulonan Barat', NULL, NULL, 'Kelapa Dua', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(269, ' 15611', '36.03.02.2008', 'Cikande', NULL, NULL, 'Jayanti', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(270, ' 15611', '36.03.02.2007', 'Dangdeur (Dang Deur)', NULL, NULL, 'Jayanti', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(271, ' 15611', '36.03.02.2006', 'Jayanti', NULL, NULL, 'Jayanti', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(272, ' 15611', '36.03.02.2002', 'Pabuaran', NULL, 1007, 'Jayanti', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(273, ' 15611', '36.03.02.2001', 'Pangkat', NULL, NULL, 'Jayanti', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(274, ' 15611', '36.03.02.2009', 'Pasir Gintung', NULL, NULL, 'Jayanti', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(275, ' 15611', '36.03.02.2004', 'Pasir Muncang', NULL, NULL, 'Jayanti', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(276, ' 15611', '36.03.02.2005', 'Sumur Bandung', NULL, NULL, 'Jayanti', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(277, ' 15720', '36.03.04.2009', 'Ancol Pasir', NULL, NULL, 'Jambe', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(278, ' 15720', '36.03.04.2005', 'Daru', NULL, NULL, 'Jambe', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(279, ' 15720', '36.03.04.2002', 'Jambe', NULL, NULL, 'Jambe', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(280, ' 15720', '36.03.04.2006', 'Kutruk', NULL, NULL, 'Jambe', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(281, ' 15720', '36.03.04.2008', 'Mekarsari', NULL, 1005, 'Jambe', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(282, ' 15720', '36.03.04.2010', 'Pasir Barat', NULL, NULL, 'Jambe', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(283, ' 15720', '36.03.04.2007', 'Ranca Buaya (Rancabuaya)', NULL, NULL, 'Jambe', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(284, ' 15720', '36.03.04.2001', 'Sukamanah (Suka Manah)', NULL, NULL, 'Jambe', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(285, ' 15720', '36.03.04.2004', 'Taban', NULL, NULL, 'Jambe', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(286, ' 15720', '36.03.04.2003', 'Tipar Raya (Tipar Jaya / Tiparraya)', NULL, NULL, 'Jambe', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(287, ' 15620', '36.03.32.2009', 'Cibetok', NULL, NULL, 'Gunung Kaler', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(288, ' 15620', '36.03.32.2005', 'Cipaeh', NULL, NULL, 'Gunung Kaler', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(289, ' 15620', '36.03.32.2001', 'Gunung Kaler', NULL, NULL, 'Gunung Kaler', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(290, ' 15620', '36.03.32.2008', 'Kandawati (Kanda Wati)', NULL, NULL, 'Gunung Kaler', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(291, ' 15620', '36.03.32.2004', 'Kedung', NULL, NULL, 'Gunung Kaler', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(292, ' 15620', '36.03.32.2006', 'Onyam', NULL, NULL, 'Gunung Kaler', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(293, ' 15620', '36.03.32.2003', 'Rancagede (Ranca Gede)', NULL, NULL, 'Gunung Kaler', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(294, ' 15620', '36.03.32.2002', 'Sidoko', NULL, NULL, 'Gunung Kaler', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(295, ' 15620', '36.03.32.2007', 'Tamiang', NULL, NULL, 'Gunung Kaler', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(296, ' 15810', '36.03.17.1006', 'Binong', NULL, NULL, 'Curug', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(297, ' 15810', '36.03.17.2010', 'Cukanggalih (Cukang Galih)', NULL, NULL, 'Curug', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(298, ' 15810', '36.03.17.1001', 'Curug Kulon', NULL, NULL, 'Curug', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(299, ' 15810', '36.03.17.2002', 'Curug Wetan', NULL, NULL, 'Curug', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(300, ' 15810', '36.03.17.2003', 'Kadu', NULL, NULL, 'Curug', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(301, ' 15810', '36.03.17.2004', 'Kadu Jaya', NULL, NULL, 'Curug', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(302, ' 15810', '36.03.17.1005', 'Sukabakti (Suka Bakti)', NULL, NULL, 'Curug', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(303, ' 15730', '36.03.05.2006', 'Bojong Loa (Bojongloa)', NULL, NULL, 'Cisoka', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(304, ' 15730', '36.03.05.2009', 'Carenang', NULL, NULL, 'Cisoka', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(305, ' 15730', '36.03.05.2002', 'Caringin', NULL, NULL, 'Cisoka', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(306, ' 15730', '36.03.05.2008', 'Cempaka', NULL, NULL, 'Cisoka', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(307, ' 15730', '36.03.05.2007', 'Cibugel', NULL, NULL, 'Cisoka', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(308, ' 15730', '36.03.05.2001', 'Cisoka', NULL, NULL, 'Cisoka', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(309, ' 15730', '36.03.05.2017', 'Jeungjing (Jeung Jing)', NULL, NULL, 'Cisoka', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(310, ' 15730', '36.03.05.2014', 'Karang Harja (Karangharja)', NULL, NULL, 'Cisoka', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(311, ' 15730', '36.03.05.2003', 'Selapajang', NULL, NULL, 'Cisoka', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(312, ' 15730', '36.03.05.2004', 'Sukatani', NULL, NULL, 'Cisoka', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(313, ' 15344', '36.03.23.2011', 'Cibogo', NULL, NULL, 'Cisauk', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(314, ' 15341', '36.03.23.1001', 'Cisauk', NULL, NULL, 'Cisauk', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(315, ' 15342', '36.03.23.2009', 'Dangdang', NULL, NULL, 'Cisauk', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(316, ' 15340', '36.03.23.2003', 'Mekar Wangi (Mekarwangi)', NULL, NULL, 'Cisauk', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(317, ' 15345', '36.03.23.2006', 'Sampora', NULL, NULL, 'Cisauk', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(318, ' 15343', '36.03.23.2005', 'Suradita', NULL, NULL, 'Cisauk', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(319, ' 15710', '36.03.18.2009', 'Bitung Jaya', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(320, ' 15710', '36.03.18.2014', 'Bojong', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(321, ' 15710', '36.03.18.2013', 'Budi Mulya', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(322, ' 15710', '36.03.18.1003', 'Bunder', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(323, ' 15710', '36.03.18.2002', 'Cibadak', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(324, ' 15710', '36.03.18.2007', 'Cikupa', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(325, ' 15710', '36.03.18.2006', 'Dukuh', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(326, ' 15710', '36.03.18.2010', 'Pasir Gadung', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(327, ' 15710', '36.03.18.2012', 'Pasir Jaya', NULL, 1003, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(328, ' 15710', '36.03.18.2011', 'Sukadamai (Suka Damai)', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(329, ' 15710', '36.03.18.1001', 'Sukamulya (Suka Mulya)', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(330, ' 15710', '36.03.18.2008', 'Sukanagara (Suka Nagara)', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(331, ' 15710', '36.03.18.2004', 'Talaga', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(332, ' 15710', '36.03.18.2005', 'Talagasari (Talaga Sari)', NULL, NULL, 'Cikupa', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(333, ' 15610', '36.03.01.1001', 'Balaraja', NULL, NULL, 'Balaraja', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(334, ' 15610', '36.03.01.2003', 'Cangkudu', NULL, NULL, 'Balaraja', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(335, ' 15610', '36.03.01.2011', 'Gembong', NULL, NULL, 'Balaraja', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(336, ' 15610', '36.03.01.2014', 'Saga', NULL, NULL, 'Balaraja', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(337, ' 15610', '36.03.01.2010', 'Sentul', NULL, NULL, 'Balaraja', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(338, ' 15610', '36.03.01.2016', 'Sentul Jaya', NULL, NULL, 'Balaraja', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(339, ' 15610', '36.03.01.2013', 'Sukamurni (Suka Murni)', NULL, NULL, 'Balaraja', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(340, ' 15610', '36.03.01.2005', 'Talagasari', NULL, NULL, 'Balaraja', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(341, ' 15610', '36.03.01.2009', 'Tobat', NULL, NULL, 'Balaraja', 3, 'Kabupaten Tangerang', 36, 'Banten'),
(342, ' 42193', '36.04.13.2012', 'Alang Alang', NULL, NULL, 'Tirtayasa', 4, 'Kabupaten Serang', 36, 'Banten'),
(343, ' 42165', '36.04.32.2003', 'Angsana', NULL, NULL, 'Mancak', 4, 'Kabupaten Serang', 36, 'Banten'),
(344, ' 42166', '36.04.30.2001', 'Anyar', NULL, NULL, 'Anyar', 4, 'Kabupaten Serang', 36, 'Banten'),
(345, ' 42455', '36.04.08.2006', 'Argawana', NULL, NULL, 'Pulo Ampel', 4, 'Kabupaten Serang', 36, 'Banten'),
(346, ' 42176', '36.04.34.2007', 'Babakan', NULL, 1008, 'Bandung', 4, 'Kabupaten Serang', 36, 'Banten'),
(347, ' 42178', '36.04.25.2009', 'Babakanjaya (Babakan Jaya)', NULL, NULL, 'Kopo', 4, 'Kabupaten Serang', 36, 'Banten'),
(348, ' 42186', '36.04.15.2006', 'Bakung', NULL, NULL, 'Cikande', 4, 'Kabupaten Serang', 36, 'Banten'),
(349, ' 42165', '36.04.32.2013', 'Bale Kambang (Balekambang)', NULL, NULL, 'Mancak', 4, 'Kabupaten Serang', 36, 'Banten'),
(350, ' 42165', '36.04.32.2014', 'Bale Kencana', NULL, NULL, 'Mancak', 4, 'Kabupaten Serang', 36, 'Banten'),
(351, ' 42166', '36.04.30.2005', 'Bandulu', NULL, NULL, 'Anyar', 4, 'Kabupaten Serang', 36, 'Banten'),
(352, ' 42176', '36.04.34.2001', 'Bandung', NULL, NULL, 'Bandung', 4, 'Kabupaten Serang', 36, 'Banten'),
(353, ' 42166', '36.04.30.2008', 'Banjarsari', NULL, NULL, 'Anyar', 4, 'Kabupaten Serang', 36, 'Banten'),
(354, ' 42175', '36.04.23.2010', 'Bantar Panjang', NULL, NULL, 'Cikeusal', 4, 'Kabupaten Serang', 36, 'Banten'),
(355, ' 42167', '36.04.31.2012', 'Bantar Wangi (Bantarwangi)', NULL, NULL, 'Cinangka', 4, 'Kabupaten Serang', 36, 'Banten'),
(356, ' 42167', '36.04.31.2002', 'Bantar Waru (Bantarwaru)', NULL, NULL, 'Cinangka', 4, 'Kabupaten Serang', 36, 'Banten'),
(357, ' 42455', '36.04.08.2007', 'Banyuwangi', NULL, NULL, 'Pulo Ampel', 4, 'Kabupaten Serang', 36, 'Banten'),
(358, ' 42185', '36.04.16.2006', 'Barengkok', NULL, NULL, 'Kibin', 4, 'Kabupaten Serang', 36, 'Banten'),
(359, ' 42173', '36.04.22.2001', 'Baros', NULL, NULL, 'Baros', 4, 'Kabupaten Serang', 36, 'Banten'),
(360, ' 42167', '36.04.31.2014', 'Baros Jaya', NULL, NULL, 'Cinangka', 4, 'Kabupaten Serang', 36, 'Banten'),
(361, ' 42168', '36.04.29.2007', 'Barugbug', NULL, NULL, 'Padarincang', 4, 'Kabupaten Serang', 36, 'Banten'),
(362, ' 42168', '36.04.29.2008', 'Batu Kuwung (Batukuwung)', NULL, NULL, 'Padarincang', 4, 'Kabupaten Serang', 36, 'Banten'),
(363, ' 42165', '36.04.32.2011', 'Batukuda', NULL, NULL, 'Mancak', 4, 'Kabupaten Serang', 36, 'Banten'),
(364, ' 42182', '36.04.09.2015', 'Beberan', NULL, NULL, 'Ciruas', 4, 'Kabupaten Serang', 36, 'Banten'),
(365, ' 42194', '36.04.14.2007', 'Bendung', NULL, NULL, 'Tanara', 4, 'Kabupaten Serang', 36, 'Banten'),
(366, ' 42453', '36.04.06.2003', 'Binangun', NULL, NULL, 'Waringinkurung (Waringin Kurung)', 4, 'Kabupaten Serang', 36, 'Banten'),
(367, ' 42179', '36.04.24.2006', 'Binong', NULL, NULL, 'Pamarayan', 4, 'Kabupaten Serang', 36, 'Banten'),
(368, ' 42196', '36.04.18.2001', 'Binuang', NULL, NULL, 'Binuang', 4, 'Kabupaten Serang', 36, 'Banten'),
(369, ' 42176', '36.04.34.2006', 'Blokang', NULL, NULL, 'Bandung', 4, 'Kabupaten Serang', 36, 'Banten'),
(370, ' 42454', '36.04.07.2001', 'Bojonegara', NULL, NULL, 'Bojonegara', 4, 'Kabupaten Serang', 36, 'Banten'),
(371, ' 42174', '36.04.20.2007', 'Bojong Catang', NULL, NULL, 'Tunjung Teja', 4, 'Kabupaten Serang', 36, 'Banten'),
(372, ' 42174', '36.04.20.2006', 'Bojong Menteng', NULL, NULL, 'Tunjung Teja', 4, 'Kabupaten Serang', 36, 'Banten'),
(373, ' 42172', '36.04.19.2015', 'Bojong Nangka', NULL, NULL, 'Petir', 4, 'Kabupaten Serang', 36, 'Banten'),
(374, ' 42174', '36.04.20.2008', 'Bojong Pandan', NULL, NULL, 'Tunjung Teja', 4, 'Kabupaten Serang', 36, 'Banten'),
(375, ' 42177', '36.04.26.2002', 'Bojot', NULL, NULL, 'Jawilan', 4, 'Kabupaten Serang', 36, 'Banten'),
(376, ' 42181', '36.04.35.2008', 'Bolang', NULL, NULL, 'Lebak Wangi', 4, 'Kabupaten Serang', 36, 'Banten'),
(377, ' 42168', '36.04.29.2002', 'Bugel', NULL, 1009, 'Padarincang', 4, 'Kabupaten Serang', 36, 'Banten'),
(378, ' 42167', '36.04.31.2004', 'Bulakan', NULL, NULL, 'Cinangka', 4, 'Kabupaten Serang', 36, 'Banten'),
(379, ' 42182', '36.04.09.2009', 'Bumijaya', NULL, NULL, 'Ciruas', 4, 'Kabupaten Serang', 36, 'Banten'),
(380, ' 42166', '36.04.30.2006', 'Bunihara', NULL, NULL, 'Anyar', 4, 'Kabupaten Serang', 36, 'Banten'),
(381, ' 42196', '36.04.18.2002', 'Cakung', NULL, NULL, 'Binuang', 4, 'Kabupaten Serang', 36, 'Banten'),
(382, ' 42195', '36.04.17.2001', 'Carenang', NULL, NULL, 'Carenang (Cerenang)', 4, 'Kabupaten Serang', 36, 'Banten'),
(383, ' 42178', '36.04.25.2007', 'Carenang Udik', NULL, NULL, 'Kopo', 4, 'Kabupaten Serang', 36, 'Banten'),
(384, ' 42164', '36.04.27.2008', 'Cemplang', NULL, NULL, 'Ciomas', 4, 'Kabupaten Serang', 36, 'Banten'),
(385, ' 42177', '36.04.26.2003', 'Cemplang', NULL, NULL, 'Jawilan', 4, 'Kabupaten Serang', 36, 'Banten'),
(386, ' 42194', '36.04.14.2002', 'Cerukcuk', NULL, NULL, 'Tanara', 4, 'Kabupaten Serang', 36, 'Banten'),
(387, ' 42185', '36.04.16.2009', 'Ciagel', NULL, NULL, 'Kibin', 4, 'Kabupaten Serang', 36, 'Banten'),
(388, ' 42194', '36.04.14.2009', 'Cibodas', NULL, 1001, 'Tanara', 4, 'Kabupaten Serang', 36, 'Banten'),
(389, ' 42168', '36.04.29.2003', 'Cibojong', NULL, NULL, 'Padarincang', 4, 'Kabupaten Serang', 36, 'Banten'),
(390, ' 42178', '36.04.25.2004', 'Cidahu', NULL, NULL, 'Kopo', 4, 'Kabupaten Serang', 36, 'Banten'),
(391, ' 42182', '36.04.09.2012', 'Cigelam', NULL, NULL, 'Ciruas', 4, 'Kabupaten Serang', 36, 'Banten'),
(392, ' 42160', '36.04.33.2002', 'Ciherang', NULL, NULL, 'Gunung Sari (Gunungsari)', 4, 'Kabupaten Serang', 36, 'Banten'),
(393, ' 42185', '36.04.16.2003', 'Cijeruk', NULL, NULL, 'Kibin', 4, 'Kabupaten Serang', 36, 'Banten'),
(394, ' 42186', '36.04.15.2001', 'Cikande', NULL, NULL, 'Cikande', 4, 'Kabupaten Serang', 36, 'Banten'),
(395, ' 42186', '36.04.15.2013', 'Cikande Permai', NULL, NULL, 'Cikande', 4, 'Kabupaten Serang', 36, 'Banten'),
(396, ' 42165', '36.04.32.2005', 'Cikedung', NULL, NULL, 'Mancak', 4, 'Kabupaten Serang', 36, 'Banten'),
(397, ' 42175', '36.04.23.2001', 'Cikeusal', NULL, NULL, 'Cikeusal', 4, 'Kabupaten Serang', 36, 'Banten'),
(398, ' 42167', '36.04.31.2009', 'Cikolelet', NULL, NULL, 'Cinangka', 4, 'Kabupaten Serang', 36, 'Banten'),
(399, ' 42166', '36.04.30.2003', 'Cikoneng', NULL, NULL, 'Anyar', 4, 'Kabupaten Serang', 36, 'Banten'),
(400, ' 42175', '36.04.23.2005', 'Cilayang', NULL, NULL, 'Cikeusal', 4, 'Kabupaten Serang', 36, 'Banten'),
(401, ' 42175', '36.04.23.2017', 'Cilayang Guha', NULL, NULL, 'Cikeusal', 4, 'Kabupaten Serang', 36, 'Banten'),
(402, ' 42175', '36.04.23.2007', 'Cimaung', NULL, NULL, 'Cikeusal', 4, 'Kabupaten Serang', 36, 'Banten'),
(403, ' 42167', '36.04.31.2001', 'Cinangka', NULL, NULL, 'Cinangka', 4, 'Kabupaten Serang', 36, 'Banten'),
(404, ' 42168', '36.04.29.2006', 'Ciomas', NULL, NULL, 'Padarincang', 4, 'Kabupaten Serang', 36, 'Banten'),
(405, ' 42168', '36.04.29.2012', 'Cipayung', NULL, NULL, 'Padarincang', 4, 'Kabupaten Serang', 36, 'Banten'),
(406, ' 42172', '36.04.19.2002', 'Cirangkong', NULL, NULL, 'Petir', 4, 'Kabupaten Serang', 36, 'Banten'),
(407, ' 42172', '36.04.19.2009', 'Cirendeu (Cireundeu)', NULL, NULL, 'Petir', 4, 'Kabupaten Serang', 36, 'Banten'),
(408, ' 42182', '36.04.09.2001', 'Ciruas', NULL, NULL, 'Ciruas', 4, 'Kabupaten Serang', 36, 'Banten'),
(409, ' 42168', '36.04.29.2005', 'Cisaat', NULL, NULL, 'Padarincang', 4, 'Kabupaten Serang', 36, 'Banten'),
(410, ' 42184', '36.04.11.2013', 'Cisait', NULL, NULL, 'Kragilan', 4, 'Kabupaten Serang', 36, 'Banten'),
(411, ' 42173', '36.04.22.2008', 'Cisalam', NULL, NULL, 'Baros', 4, 'Kabupaten Serang', 36, 'Banten'),
(412, ' 42164', '36.04.27.2009', 'Cisitu', NULL, NULL, 'Ciomas', 4, 'Kabupaten Serang', 36, 'Banten'),
(413, ' 42164', '36.04.27.2010', 'Citaman', NULL, NULL, 'Ciomas', 4, 'Kabupaten Serang', 36, 'Banten'),
(414, ' 42168', '36.04.29.2004', 'Citasuk', NULL, NULL, 'Padarincang', 4, 'Kabupaten Serang', 36, 'Banten'),
(415, ' 42182', '36.04.09.2002', 'Citerep', NULL, NULL, 'Ciruas', 4, 'Kabupaten Serang', 36, 'Banten'),
(416, ' 42165', '36.04.32.2002', 'Ciwarna', NULL, NULL, 'Mancak', 4, 'Kabupaten Serang', 36, 'Banten'),
(417, ' 42453', '36.04.06.2010', 'Cokopsulanjana', NULL, NULL, 'Waringinkurung (Waringin Kurung)', 4, 'Kabupaten Serang', 36, 'Banten'),
(418, ' 42168', '36.04.29.2013', 'Curug Goong', NULL, NULL, 'Padarincang', 4, 'Kabupaten Serang', 36, 'Banten'),
(419, ' 42160', '36.04.33.2007', 'Curug Sulanjana', NULL, NULL, 'Gunung Sari (Gunungsari)', 4, 'Kabupaten Serang', 36, 'Banten'),
(420, ' 42173', '36.04.22.2011', 'Curugagung (Curug Agung)', NULL, NULL, 'Baros', 4, 'Kabupaten Serang', 36, 'Banten'),
(421, ' 42175', '36.04.23.2002', 'Dahu', NULL, NULL, 'Cikeusal', 4, 'Kabupaten Serang', 36, 'Banten'),
(422, ' 42179', '36.04.24.2002', 'Damping', NULL, NULL, 'Pamarayan', 4, 'Kabupaten Serang', 36, 'Banten'),
(423, ' 42192', '36.04.12.2009', 'Domas', NULL, NULL, 'Pontang', 4, 'Kabupaten Serang', 36, 'Banten'),
(424, ' 42184', '36.04.11.2004', 'Dukuh', NULL, NULL, 'Kragilan', 4, 'Kabupaten Serang', 36, 'Banten'),
(425, ' 42178', '36.04.25.2006', 'Gabus', NULL, NULL, 'Kopo', 4, 'Kabupaten Serang', 36, 'Banten'),
(426, ' 42175', '36.04.23.2009', 'Gandayasa', NULL, NULL, 'Cikeusal', 4, 'Kabupaten Serang', 36, 'Banten'),
(427, ' 42178', '36.04.25.2002', 'Garut', NULL, NULL, 'Kopo', 4, 'Kabupaten Serang', 36, 'Banten'),
(428, ' 42455', '36.04.08.2004', 'Gedung Soka (Kedung Soka)', NULL, NULL, 'Pulo Ampel', 4, 'Kabupaten Serang', 36, 'Banten'),
(429, ' 42196', '36.04.18.2004', 'Gembor', NULL, 1002, 'Binuang', 4, 'Kabupaten Serang', 36, 'Banten'),
(430, ' 42186', '36.04.15.2011', 'Gembor Udik', NULL, NULL, 'Cikande', 4, 'Kabupaten Serang', 36, 'Banten'),
(431, ' 42182', '36.04.09.2006', 'Gosara', NULL, NULL, 'Ciruas', 4, 'Kabupaten Serang', 36, 'Banten'),
(432, ' 42166', '36.04.30.2012', 'Grogol Indah', NULL, NULL, 'Anyar', 4, 'Kabupaten Serang', 36, 'Banten'),
(433, ' 42160', '36.04.33.2001', 'Gunungsari', NULL, NULL, 'Gunung Sari (Gunungsari)', 4, 'Kabupaten Serang', 36, 'Banten'),
(434, ' 42161', '36.04.05.2005', 'Harjatani', NULL, NULL, 'Kramatwatu', 4, 'Kabupaten Serang', 36, 'Banten'),
(435, ' 42175', '36.04.23.2012', 'Harundang', NULL, NULL, 'Cikeusal', 4, 'Kabupaten Serang', 36, 'Banten'),
(436, ' 42177', '36.04.26.2001', 'Jawilan', NULL, NULL, 'Jawilan', 4, 'Kabupaten Serang', 36, 'Banten'),
(437, ' 42184', '36.04.11.2008', 'Jeruk Tipis (Jeruktipis)', NULL, NULL, 'Kragilan', 4, 'Kabupaten Serang', 36, 'Banten'),
(438, ' 42186', '36.04.15.2007', 'Julang', NULL, NULL, 'Cikande', 4, 'Kabupaten Serang', 36, 'Banten'),
(439, ' 42177', '36.04.26.2009', 'Junti', NULL, NULL, 'Jawilan', 4, 'Kabupaten Serang', 36, 'Banten'),
(440, ' 42182', '36.04.09.2004', 'Kadikaran', NULL, NULL, 'Ciruas', 4, 'Kabupaten Serang', 36, 'Banten'),
(441, ' 42160', '36.04.33.2005', 'Kadu Agung', NULL, NULL, 'Gunung Sari (Gunungsari)', 4, 'Kabupaten Serang', 36, 'Banten'),
(442, ' 42168', '36.04.29.2014', 'Kadu Kempong', NULL, NULL, 'Padarincang', 4, 'Kabupaten Serang', 36, 'Banten'),
(443, ' 42163', '36.04.28.2006', 'Kadubeureum', NULL, NULL, 'Pabuaran', 4, 'Kabupaten Serang', 36, 'Banten'),
(444, ' 42168', '36.04.29.2011', 'Kadubeureum', NULL, NULL, 'Padarincang', 4, 'Kabupaten Serang', 36, 'Banten'),
(445, ' 42172', '36.04.19.2008', 'Kadugenep', NULL, NULL, 'Petir', 4, 'Kabupaten Serang', 36, 'Banten'),
(446, ' 42193', '36.04.13.2003', 'Kamanisan (Kemanisan)', NULL, NULL, 'Tirtayasa', 4, 'Kabupaten Serang', 36, 'Banten'),
(447, ' 42181', '36.04.35.2001', 'Kamaruton', NULL, NULL, 'Lebak Wangi', 4, 'Kabupaten Serang', 36, 'Banten'),
(448, ' 42167', '36.04.31.2011', 'Kamasan', NULL, NULL, 'Cinangka', 4, 'Kabupaten Serang', 36, 'Banten'),
(449, ' 42179', '36.04.24.2008', 'Kampung Baru', NULL, NULL, 'Pamarayan', 4, 'Kabupaten Serang', 36, 'Banten'),
(450, ' 42172', '36.04.19.2011', 'Kampung Baru', NULL, NULL, 'Petir', 4, 'Kabupaten Serang', 36, 'Banten'),
(451, ' 42186', '36.04.15.2010', 'Kamurang', NULL, NULL, 'Cikande', 4, 'Kabupaten Serang', 36, 'Banten'),
(452, ' 42454', '36.04.07.2004', 'Karang Kepuh (Karangkepuh)', NULL, NULL, 'Bojonegara', 4, 'Kabupaten Serang', 36, 'Banten'),
(453, ' 42167', '36.04.31.2005', 'Karang Suraga', NULL, NULL, 'Cinangka', 4, 'Kabupaten Serang', 36, 'Banten'),
(454, ' 42177', '36.04.26.2008', 'Kareo', NULL, NULL, 'Jawilan', 4, 'Kabupaten Serang', 36, 'Banten'),
(455, ' 42182', '36.04.09.2016', 'Kaserangan', NULL, NULL, 'Ciruas', 4, 'Kabupaten Serang', 36, 'Banten'),
(456, ' 42192', '36.04.12.2011', 'Kaserangan (Keserangan)', NULL, NULL, 'Pontang', 4, 'Kabupaten Serang', 36, 'Banten'),
(457, ' 42175', '36.04.23.2003', 'Katulisan', NULL, NULL, 'Cikeusal', 4, 'Kabupaten Serang', 36, 'Banten'),
(458, ' 42193', '36.04.13.2005', 'Kebon', NULL, NULL, 'Tirtayasa', 4, 'Kabupaten Serang', 36, 'Banten');
INSERT INTO `m_kode_pos` (`id_kode_pos`, `kode_pos`, `kode_wilayah`, `kelurahan`, `id_kecamatan`, `id_kelurahan`, `kecamatan`, `id_kabkota`, `kabkota`, `id_provinsi`, `provinsi`) VALUES
(459, ' 42179', '36.04.24.2004', 'Keboncau (Kebon Cau)', NULL, NULL, 'Pamarayan', 4, 'Kabupaten Serang', 36, 'Banten'),
(460, ' 42181', '36.04.35.2010', 'Kebonratu', NULL, NULL, 'Lebak Wangi', 4, 'Kabupaten Serang', 36, 'Banten'),
(461, ' 42193', '36.04.13.2013', 'Kebuyutan', NULL, NULL, 'Tirtayasa', 4, 'Kabupaten Serang', 36, 'Banten'),
(462, ' 42192', '36.04.12.2006', 'Kelapian (Kalapian)', NULL, NULL, 'Pontang', 4, 'Kabupaten Serang', 36, 'Banten'),
(463, ' 42168', '36.04.29.2010', 'Kelumpang (Kalumpang)', NULL, NULL, 'Padarincang', 4, 'Kabupaten Serang', 36, 'Banten'),
(464, ' 42453', '36.04.06.2011', 'Kemuning', NULL, NULL, 'Waringinkurung (Waringin Kurung)', 4, 'Kabupaten Serang', 36, 'Banten'),
(465, ' 42174', '36.04.20.2005', 'Kemuning (Kamuning)', NULL, NULL, 'Tunjung Teja', 4, 'Kabupaten Serang', 36, 'Banten'),
(466, ' 42181', '36.04.35.2005', 'Kencana Harapan', NULL, NULL, 'Lebak Wangi', 4, 'Kabupaten Serang', 36, 'Banten'),
(467, ' 42184', '36.04.11.2011', 'Kendayakan', NULL, NULL, 'Kragilan', 4, 'Kabupaten Serang', 36, 'Banten'),
(468, '15118', '36.71.01.1008', 'Babakan', 1, 1008, 'Tangerang', 71, 'Kota Tangerang', 36, 'Banten'),
(469, ' 15119', '36.71.01.1004', 'Buaran Indah', 1, 1004, 'Tangerang', 71, 'Kota Tangerang', 36, 'Banten'),
(470, '15117', '36.71.01.1005', 'Cikokol', 1, 1005, 'Tangerang', 71, 'Kota Tangerang', 36, 'Banten'),
(471, ' 15117', '36.71.01.1006', 'Kelapa Indah', 1, 1006, 'Tangerang', 71, 'Kota Tangerang', 36, 'Banten'),
(472, '15111', '36.71.01.1002', 'Sukaasih (Suka Asih)', 1, 1002, 'Tangerang', 71, 'Kota Tangerang', 36, 'Banten'),
(473, ' 15111', '36.71.01.1001', 'Sukarasa', 1, 1001, 'Tangerang', 71, 'Kota Tangerang', 36, 'Banten'),
(474, '15118', '36.71.01.1007', 'Sukasari', 1, 1007, 'Tangerang', 71, 'Kota Tangerang', 36, 'Banten'),
(475, ' 15119', '36.71.01.1003', 'Tanah Tinggi', 1, 1003, 'Tangerang', 71, 'Kota Tangerang', 36, 'Banten'),
(476, ' 15142', '36.71.11.1007', 'Cipete', NULL, 1007, 'Pinang (Penang)', 71, 'Kota Tangerang', 36, 'Banten'),
(477, ' 15144', '36.71.11.1004', 'Kunciran', NULL, 1004, 'Pinang (Penang)', 71, 'Kota Tangerang', 36, 'Banten'),
(478, ' 15144', '36.71.11.1005', 'Kunciran Indah', NULL, 1005, 'Pinang (Penang)', 71, 'Kota Tangerang', 36, 'Banten'),
(479, ' 15144', '36.71.11.1006', 'Kunciran Jaya', NULL, 1006, 'Pinang (Penang)', 71, 'Kota Tangerang', 36, 'Banten'),
(480, ' 15145', '36.71.11.1003', 'Nerogtog', NULL, NULL, 'Pinang (Penang)', 71, 'Kota Tangerang', 36, 'Banten'),
(481, ' 15142', '36.71.11.1008', 'Pakojan', NULL, 1008, 'Pinang (Penang)', 71, 'Kota Tangerang', 36, 'Banten'),
(482, ' 15143', '36.71.11.1009', 'Panunggangan', NULL, 1009, 'Pinang (Penang)', 71, 'Kota Tangerang', 36, 'Banten'),
(483, ' 15143', '36.71.11.1011', 'Panunggangan Timur', NULL, 1011, 'Pinang (Penang)', 71, 'Kota Tangerang', 36, 'Banten'),
(484, ' 15143', '36.71.11.1010', 'Panunggangan Utara', NULL, 1010, 'Pinang (Penang)', 71, 'Kota Tangerang', 36, 'Banten'),
(485, ' 15145', '36.71.11.1001', 'Pinang', NULL, 1001, 'Pinang (Penang)', 71, 'Kota Tangerang', 36, 'Banten'),
(486, ' 15145', '36.71.11.1002', 'Sudimara Pinang', NULL, 1002, 'Pinang (Penang)', 71, 'Kota Tangerang', 36, 'Banten'),
(487, ' 15132', '36.71.08.1003', 'Gebang Raya', 8, 1003, 'Periuk', 71, 'Kota Tangerang', 36, 'Banten'),
(488, ' 15133', '36.71.08.1002', 'Gembor', 8, 1002, 'Periuk', 71, 'Kota Tangerang', 36, 'Banten'),
(489, ' 15131', '36.71.08.1001', 'Periuk', 8, 1001, 'Periuk', 71, 'Kota Tangerang', 36, 'Banten'),
(490, ' 15131', '36.71.08.1005', 'Periuk Jaya', 8, 1005, 'Periuk', 71, 'Kota Tangerang', 36, 'Banten'),
(491, ' 15132', '36.71.08.1004', 'Sangiang Jaya', 8, 1004, 'Periuk', 71, 'Kota Tangerang', 36, 'Banten'),
(492, ' 15121', '36.71.10.1006', 'Karang Anyar', 10, 1006, 'Neglasari', 71, 'Kota Tangerang', 36, 'Banten'),
(493, ' 15121', '36.71.10.1002', 'Karang Sari', 10, 1002, 'Neglasari', 71, 'Kota Tangerang', 36, 'Banten'),
(494, ' 15128', '36.71.10.1007', 'Kedaung Baru', 10, 1007, 'Neglasari', 71, 'Kota Tangerang', 36, 'Banten'),
(495, ' 15128', '36.71.10.1004', 'Kedaung Wetan', 10, 1004, 'Neglasari', 71, 'Kota Tangerang', 36, 'Banten'),
(496, ' 15129', '36.71.10.1005', 'Mekarsari (Mekar Sari)', 10, 1005, 'Neglasari', 71, 'Kota Tangerang', 36, 'Banten'),
(497, ' 15129', '36.71.10.1001', 'Neglasari', 10, 1001, 'Neglasari', 71, 'Kota Tangerang', 36, 'Banten'),
(498, ' 15127', '36.71.10.1003', 'Selapajang Jaya', 10, 1003, 'Neglasari', 71, 'Kota Tangerang', 36, 'Banten'),
(499, ' 15155', '36.71.13.1003', 'Cipadu', 13, 1003, 'Larangan', 71, 'Kota Tangerang', 36, 'Banten'),
(500, ' 15155', '36.71.13.1007', 'Cipadu Jaya', 13, 1007, 'Larangan', 71, 'Kota Tangerang', 36, 'Banten'),
(501, ' 15154', '36.71.13.1006', 'Gaga', 13, 1006, 'Larangan', 71, 'Kota Tangerang', 36, 'Banten'),
(502, ' 15156', '36.71.13.1004', 'Kreo', 13, 1004, 'Larangan', 71, 'Kota Tangerang', 36, 'Banten'),
(503, ' 15156', '36.71.13.1008', 'Kreo Selatan', 13, 1008, 'Larangan', 71, 'Kota Tangerang', 36, 'Banten'),
(504, ' 15154', '36.71.13.1005', 'Larangan Indah', 13, 1005, 'Larangan', 71, 'Kota Tangerang', 36, 'Banten'),
(505, ' 15154', '36.71.13.1002', 'Larangan Selatan', 13, 1002, 'Larangan', 71, 'Kota Tangerang', 36, 'Banten'),
(506, ' 15154', '36.71.13.1001', 'Larangan Utara', 13, 1001, 'Larangan', 71, 'Kota Tangerang', 36, 'Banten'),
(507, ' 15115', '36.71.07.1002', 'Bojong Jaya', 7, 1002, 'Karawaci', 71, 'Kota Tangerang', 36, 'Banten'),
(508, ' 15113', '36.71.07.1009', 'Bugel', 7, 1009, 'Karawaci', 71, 'Kota Tangerang', 36, 'Banten'),
(509, ' 15114', '36.71.07.1005', 'Cimone', 7, 1005, 'Karawaci', 71, 'Kota Tangerang', 36, 'Banten'),
(510, ' 15116', '36.71.07.1006', 'Cimone Jaya', 7, 1006, 'Karawaci', 71, 'Kota Tangerang', 36, 'Banten'),
(511, ' 15113', '36.71.07.1013', 'Gerendeng', 7, 1013, 'Karawaci', 71, 'Kota Tangerang', 36, 'Banten'),
(512, ' 15115', '36.71.07.1001', 'Karawaci', 7, 1001, 'Karawaci', 71, 'Kota Tangerang', 36, 'Banten'),
(513, ' 15116', '36.71.07.1003', 'Karawaci Baru', 7, 1003, 'Karawaci', 71, 'Kota Tangerang', 36, 'Banten'),
(514, ' 15112', '36.71.07.1016', 'Koang Jaya', 7, 1016, 'Karawaci', 71, 'Kota Tangerang', 36, 'Banten'),
(515, ' 15113', '36.71.07.1010', 'Margasari (Marga Sari)', 7, 1010, 'Karawaci', 71, 'Kota Tangerang', 36, 'Banten'),
(516, ' 15112', '36.71.07.1012', 'Nambo Jaya', 7, 1012, 'Karawaci', 71, 'Kota Tangerang', 36, 'Banten'),
(517, ' 15116', '36.71.07.1004', 'Nusa Jaya', 7, 1004, 'Karawaci', 71, 'Kota Tangerang', 36, 'Banten'),
(518, ' 15114', '36.71.07.1007', 'Pabuaran', 7, 1007, 'Karawaci', 71, 'Kota Tangerang', 36, 'Banten'),
(519, ' 15112', '36.71.07.1011', 'Pabuaran Tumpeng', 7, 1011, 'Karawaci', 71, 'Kota Tangerang', 36, 'Banten'),
(520, ' 15112', '36.71.07.1015', 'Pasar Baru', 7, 1015, 'Karawaci', 71, 'Kota Tangerang', 36, 'Banten'),
(521, ' 15113', '36.71.07.1014', 'Sukajadi (Suka Jadi)', 7, 1014, 'Karawaci', 71, 'Kota Tangerang', 36, 'Banten'),
(522, ' 15114', '36.71.07.1008', 'Sumur Pancing (Pacing)', 7, 1008, 'Karawaci', 71, 'Kota Tangerang', 36, 'Banten'),
(523, ' 15157', '36.71.12.1002', 'Karang Mulya', 12, 1002, 'Karang Tengah', 71, 'Kota Tangerang', 36, 'Banten'),
(524, ' 15157', '36.71.12.1001', 'Karang Tengah', 12, 1001, 'Karang Tengah', 71, 'Kota Tangerang', 36, 'Banten'),
(525, ' 15157', '36.71.12.1005', 'Karang Timur', 12, 1005, 'Karang Tengah', 71, 'Kota Tangerang', 36, 'Banten'),
(526, ' 15159', '36.71.12.1006', 'Padurenan (Pedurenan)', 12, 1006, 'Karang Tengah', 71, 'Kota Tangerang', 36, 'Banten'),
(527, ' 15159', '36.71.12.1007', 'Parung Jaya', 12, 1007, 'Karang Tengah', 71, 'Kota Tangerang', 36, 'Banten'),
(528, ' 15159', '36.71.12.1003', 'Pondok Bahar', 12, 1003, 'Karang Tengah', 71, 'Kota Tangerang', 36, 'Banten'),
(529, ' 15158', '36.71.12.1004', 'Pondok Pucung', 12, 1004, 'Karang Tengah', 71, 'Kota Tangerang', 36, 'Banten'),
(530, ' 15133', '36.71.02.1006', 'Alam Jaya', 2, 1006, 'Jatiuwung', 71, 'Kota Tangerang', 36, 'Banten'),
(531, ' 15137', '36.71.02.1004', 'Gandasari', 2, 1004, 'Jatiuwung', 71, 'Kota Tangerang', 36, 'Banten'),
(532, ' 15136', '36.71.02.1002', 'Jatake', 2, 1002, 'Jatiuwung', 71, 'Kota Tangerang', 36, 'Banten'),
(533, ' 15134', '36.71.02.1001', 'Keroncong', 2, 1001, 'Jatiuwung', 71, 'Kota Tangerang', 36, 'Banten'),
(534, ' 15136', '36.71.02.1005', 'Manis Jaya', 2, 1005, 'Jatiuwung', 71, 'Kota Tangerang', 36, 'Banten'),
(535, ' 15135', '36.71.02.1003', 'Pasir Jaya', 2, 1003, 'Jatiuwung', 71, 'Kota Tangerang', 36, 'Banten'),
(536, ' 15148', '36.71.05.1001', 'Cipondoh', 5, 1001, 'Cipondoh', 71, 'Kota Tangerang', 36, 'Banten'),
(537, ' 15148', '36.71.05.1003', 'Cipondoh Indah', 5, 1003, 'Cipondoh', 71, 'Kota Tangerang', 36, 'Banten'),
(538, ' 15148', '36.71.05.1002', 'Cipondoh Makmur', 5, 1002, 'Cipondoh', 71, 'Kota Tangerang', 36, 'Banten'),
(539, ' 15146', '36.71.05.1004', 'Gondrong', 5, 1004, 'Cipondoh', 71, 'Kota Tangerang', 36, 'Banten'),
(540, ' 15146', '36.71.05.1005', 'Kenanga', 5, 1005, 'Cipondoh', 71, 'Kota Tangerang', 36, 'Banten'),
(541, ' 15147', '36.71.05.1007', 'Ketapang', 5, 1007, 'Cipondoh', 71, 'Kota Tangerang', 36, 'Banten'),
(542, ' 15147', '36.71.05.1006', 'Petir', 5, 1006, 'Cipondoh', 71, 'Kota Tangerang', 36, 'Banten'),
(543, ' 15141', '36.71.05.1008', 'Poris Plawad', 5, 1008, 'Cipondoh', 71, 'Kota Tangerang', 36, 'Banten'),
(544, ' 15141', '36.71.05.1010', 'Poris Plawad Indah', 5, 1010, 'Cipondoh', 71, 'Kota Tangerang', 36, 'Banten'),
(545, ' 15141', '36.71.05.1009', 'Poris Plawad Utara', 5, 1009, 'Cipondoh', 71, 'Kota Tangerang', 36, 'Banten'),
(546, ' 15153', '36.71.06.1001', 'Paninggilan', 6, 1001, 'Ciledug', 71, 'Kota Tangerang', 36, 'Banten'),
(547, ' 15153', '36.71.06.1008', 'Paninggilan Utara', 6, 1008, 'Ciledug', 71, 'Kota Tangerang', 36, 'Banten'),
(548, ' 15153', '36.71.06.1005', 'Parung Serab', 6, 1005, 'Ciledug', 71, 'Kota Tangerang', 36, 'Banten'),
(549, ' 15151', '36.71.06.1002', 'Sudimara Barat', 6, 1002, 'Ciledug', 71, 'Kota Tangerang', 36, 'Banten'),
(550, ' 15151', '36.71.06.1006', 'Sudimara Jaya', 6, 1006, 'Ciledug', 71, 'Kota Tangerang', 36, 'Banten'),
(551, ' 15151', '36.71.06.1007', 'Sudimara Selatan', 6, 1007, 'Ciledug', 71, 'Kota Tangerang', 36, 'Banten'),
(552, ' 15151', '36.71.06.1003', 'Sudimara Timur', 6, 1003, 'Ciledug', 71, 'Kota Tangerang', 36, 'Banten'),
(553, ' 15152', '36.71.06.1004', 'Tajur', 6, 1004, 'Ciledug', 71, 'Kota Tangerang', 36, 'Banten'),
(554, ' 15138', '36.71.09.1001', 'Cibodas', 9, 1001, 'Cibodas', 71, 'Kota Tangerang', 36, 'Banten'),
(555, ' 15138', '36.71.09.1003', 'Cibodas Baru', 9, 1003, 'Cibodas', 71, 'Kota Tangerang', 36, 'Banten'),
(556, ' 15138', '36.71.09.1002', 'Cibodasari (Cibodas Sari)', 9, 1002, 'Cibodas', 71, 'Kota Tangerang', 36, 'Banten'),
(557, ' 15134', '36.71.09.1006', 'Jatiuwung', 9, 1006, 'Cibodas', 71, 'Kota Tangerang', 36, 'Banten'),
(558, ' 15139', '36.71.09.1004', 'Panunggangan Barat', 9, 1004, 'Cibodas', 71, 'Kota Tangerang', 36, 'Banten'),
(559, ' 15138', '36.71.09.1005', 'Uwung Jaya', 9, 1005, 'Cibodas', 71, 'Kota Tangerang', 36, 'Banten'),
(560, ' 15123', '36.71.04.1001', 'Belendung', 4, 1001, 'Benda', 71, 'Kota Tangerang', 36, 'Banten'),
(561, ' 15125', '36.71.04.1003', 'Benda', 4, 1003, 'Benda', 71, 'Kota Tangerang', 36, 'Banten'),
(562, ' 15124', '36.71.04.1002', 'Jurumudi', 4, 1002, 'Benda', 71, 'Kota Tangerang', 36, 'Banten'),
(563, ' 15124', '36.71.04.1005', 'Jurumudi Baru', 4, 1005, 'Benda', 71, 'Kota Tangerang', 36, 'Banten'),
(564, ' 15126', '36.71.04.1004', 'Pajang', 4, 1004, 'Benda', 71, 'Kota Tangerang', 36, 'Banten'),
(565, ' 15122', '36.71.03.1001', 'Batuceper (Batu Ceper)', 3, 1001, 'Batuceper', 71, 'Kota Tangerang', 36, 'Banten'),
(566, ' 15121', '36.71.03.1002', 'Batujaya (Batu Jaya)', 3, 1002, 'Batuceper', 71, 'Kota Tangerang', 36, 'Banten'),
(567, ' 15121', '36.71.03.1006', 'Batusari (Batu Sari)', 3, 1006, 'Batuceper', 71, 'Kota Tangerang', 36, 'Banten'),
(568, ' 15122', '36.71.03.1005', 'Kebon Besar', 3, 1005, 'Batuceper', 71, 'Kota Tangerang', 36, 'Banten'),
(569, ' 15122', '36.71.03.1003', 'Poris Gaga', 3, 1003, 'Batuceper', 71, 'Kota Tangerang', 36, 'Banten'),
(570, ' 15122', '36.71.03.1004', 'Poris Gaga Baru', 3, 1004, 'Batuceper', 71, 'Kota Tangerang', 36, 'Banten'),
(571, ' 15122', '36.71.03.1007', 'Poris Jaya', 3, 1007, 'Batuceper', 71, 'Kota Tangerang', 36, 'Banten'),
(572, ' 42122', '36.73.05.1004', 'Banjar Agung (Banjaragung)', NULL, NULL, 'Cipocok Jaya', 73, 'Kota Serang', 36, 'Banten'),
(573, ' 42123', '36.73.05.1005', 'Banjarsari', NULL, NULL, 'Cipocok Jaya', 73, 'Kota Serang', 36, 'Banten'),
(574, ' 42121', '36.73.05.1001', 'Cipocok Jaya', NULL, NULL, 'Cipocok Jaya', 73, 'Kota Serang', 36, 'Banten'),
(575, ' 42127', '36.73.05.1007', 'Dalung', NULL, NULL, 'Cipocok Jaya', 73, 'Kota Serang', 36, 'Banten'),
(576, ' 42128', '36.73.05.1008', 'Gelam', NULL, NULL, 'Cipocok Jaya', 73, 'Kota Serang', 36, 'Banten'),
(577, ' 42125', '36.73.05.1002', 'Karundang', NULL, NULL, 'Cipocok Jaya', 73, 'Kota Serang', 36, 'Banten'),
(578, ' 42124', '36.73.05.1003', 'Panancangan', NULL, NULL, 'Cipocok Jaya', 73, 'Kota Serang', 36, 'Banten'),
(579, ' 42126', '36.73.05.1006', 'Tembong', NULL, NULL, 'Cipocok Jaya', 73, 'Kota Serang', 36, 'Banten'),
(580, ' 42171', '36.73.04.1005', 'Cilaku', NULL, NULL, 'Curug', 73, 'Kota Serang', 36, 'Banten'),
(581, ' 42171', '36.73.04.1004', 'Cipete', NULL, 1007, 'Curug', 73, 'Kota Serang', 36, 'Banten'),
(582, ' 42171', '36.73.04.1001', 'Curug', NULL, NULL, 'Curug', 73, 'Kota Serang', 36, 'Banten'),
(583, ' 42171', '36.73.04.1009', 'Curug Manis (Curugmanis)', NULL, NULL, 'Curug', 73, 'Kota Serang', 36, 'Banten'),
(584, ' 42171', '36.73.04.1003', 'Kemanisan (Kamanisan)', NULL, NULL, 'Curug', 73, 'Kota Serang', 36, 'Banten'),
(585, ' 42171', '36.73.04.1006', 'Pancalaksana', NULL, NULL, 'Curug', 73, 'Kota Serang', 36, 'Banten'),
(586, ' 42171', '36.73.04.1010', 'Sukajaya', NULL, NULL, 'Curug', 73, 'Kota Serang', 36, 'Banten'),
(587, ' 42171', '36.73.04.1008', 'Sukalaksana', NULL, NULL, 'Curug', 73, 'Kota Serang', 36, 'Banten'),
(588, ' 42171', '36.73.04.1007', 'Sukawana', NULL, NULL, 'Curug', 73, 'Kota Serang', 36, 'Banten'),
(589, ' 42171', '36.73.04.1002', 'Tinggar', NULL, NULL, 'Curug', 73, 'Kota Serang', 36, 'Banten'),
(590, ' 42191', '36.73.02.1007', 'Banten', NULL, NULL, 'Kasemen', 73, 'Kota Serang', 36, 'Banten'),
(591, ' 42191', '36.73.02.1006', 'Bendung', NULL, NULL, 'Kasemen', 73, 'Kota Serang', 36, 'Banten'),
(592, ' 42191', '36.73.02.1001', 'Kasemen', NULL, NULL, 'Kasemen', 73, 'Kota Serang', 36, 'Banten'),
(593, ' 42191', '36.73.02.1010', 'Kasunyatan', NULL, NULL, 'Kasemen', 73, 'Kota Serang', 36, 'Banten'),
(594, ' 42191', '36.73.02.1009', 'Kilasah', NULL, NULL, 'Kasemen', 73, 'Kota Serang', 36, 'Banten'),
(595, ' 42191', '36.73.02.1011', 'Margaluyu', NULL, NULL, 'Kasemen', 73, 'Kota Serang', 36, 'Banten'),
(596, ' 42191', '36.73.02.1002', 'Mesjid Priyayi', NULL, NULL, 'Kasemen', 73, 'Kota Serang', 36, 'Banten'),
(597, ' 42191', '36.73.02.1008', 'Sawah Luhur', NULL, NULL, 'Kasemen', 73, 'Kota Serang', 36, 'Banten'),
(598, ' 42191', '36.73.02.1003', 'Terumbu', NULL, NULL, 'Kasemen', 73, 'Kota Serang', 36, 'Banten'),
(599, ' 42191', '36.73.02.1004', 'Warung Jaud', NULL, NULL, 'Kasemen', 73, 'Kota Serang', 36, 'Banten'),
(600, ' 42111', '36.73.01.1006', 'Cimuncang', NULL, NULL, 'Serang', 73, 'Kota Serang', 36, 'Banten'),
(601, ' 42117', '36.73.01.1002', 'Cipare', NULL, NULL, 'Serang', 73, 'Kota Serang', 36, 'Banten'),
(602, ' 42114', '36.73.01.1012', 'Kagungan', NULL, NULL, 'Serang', 73, 'Kota Serang', 36, 'Banten'),
(603, ' 42116', '36.73.01.1010', 'Kaligandu', NULL, NULL, 'Serang', 73, 'Kota Serang', 36, 'Banten'),
(604, ' 42112', '36.73.01.1004', 'Kota Baru (Kotabaru)', NULL, NULL, 'Serang', 73, 'Kota Serang', 36, 'Banten'),
(605, ' 42115', '36.73.01.1009', 'Lontarbaru', NULL, NULL, 'Serang', 73, 'Kota Serang', 36, 'Banten'),
(606, ' 42113', '36.73.01.1005', 'Lopang', NULL, NULL, 'Serang', 73, 'Kota Serang', 36, 'Banten'),
(607, ' 42116', '36.73.01.1001', 'Serang', NULL, NULL, 'Serang', 73, 'Kota Serang', 36, 'Banten'),
(608, ' 42116', '36.73.01.1008', 'Sukawana', NULL, NULL, 'Serang', 73, 'Kota Serang', 36, 'Banten'),
(609, ' 42118', '36.73.01.1003', 'Sumur Pecung (Sumurpecung)', NULL, NULL, 'Serang', 73, 'Kota Serang', 36, 'Banten'),
(610, ' 42119', '36.73.01.1011', 'Terondol', NULL, NULL, 'Serang', 73, 'Kota Serang', 36, 'Banten'),
(611, ' 42111', '36.73.01.1007', 'Unyur', NULL, NULL, 'Serang', 73, 'Kota Serang', 36, 'Banten'),
(612, ' 42162', '36.73.06.1006', 'Cilowong', NULL, NULL, 'Taktakan', 73, 'Kota Serang', 36, 'Banten'),
(613, ' 42162', '36.73.06.1008', 'Drangong', NULL, NULL, 'Taktakan', 73, 'Kota Serang', 36, 'Banten'),
(614, ' 42162', '36.73.06.1005', 'Kalanganyar (Kalang Anyar)', NULL, NULL, 'Taktakan', 73, 'Kota Serang', 36, 'Banten'),
(615, ' 42162', '36.73.06.1004', 'Kuranji', NULL, NULL, 'Taktakan', 73, 'Kota Serang', 36, 'Banten'),
(616, ' 42162', '36.73.06.1011', 'Lialang', NULL, NULL, 'Taktakan', 73, 'Kota Serang', 36, 'Banten'),
(617, ' 42162', '36.73.06.1003', 'Pancur', NULL, NULL, 'Taktakan', 73, 'Kota Serang', 36, 'Banten'),
(618, ' 42162', '36.73.06.1007', 'Panggungjati', NULL, NULL, 'Taktakan', 73, 'Kota Serang', 36, 'Banten'),
(619, ' 42162', '36.73.06.1002', 'Sayar', NULL, NULL, 'Taktakan', 73, 'Kota Serang', 36, 'Banten'),
(620, ' 42162', '36.73.06.1010', 'Sepang', NULL, NULL, 'Taktakan', 73, 'Kota Serang', 36, 'Banten'),
(621, ' 42162', '36.73.06.1001', 'Taktakan', NULL, NULL, 'Taktakan', 73, 'Kota Serang', 36, 'Banten'),
(622, ' 42162', '36.73.06.1012', 'Taman Baru (Tamanbaru)', NULL, NULL, 'Taktakan', 73, 'Kota Serang', 36, 'Banten'),
(623, ' 42162', '36.73.06.1009', 'Umbul Tengah', NULL, NULL, 'Taktakan', 73, 'Kota Serang', 36, 'Banten'),
(624, ' 42183', '36.73.03.1002', 'Cigoong', NULL, NULL, 'Walantaka', 73, 'Kota Serang', 36, 'Banten'),
(625, ' 42183', '36.73.03.1008', 'Kalodoran / Kalodran', NULL, NULL, 'Walantaka', 73, 'Kota Serang', 36, 'Banten'),
(626, ' 42183', '36.73.03.1009', 'Kapuren (Kepuren)', NULL, NULL, 'Walantaka', 73, 'Kota Serang', 36, 'Banten'),
(627, ' 42183', '36.73.03.1006', 'Kiara', NULL, NULL, 'Walantaka', 73, 'Kota Serang', 36, 'Banten'),
(628, ' 42183', '36.73.03.1016', 'Lebakwangi', NULL, NULL, 'Walantaka', 73, 'Kota Serang', 36, 'Banten'),
(629, ' 42183', '36.73.03.1003', 'Nyapah', NULL, NULL, 'Walantaka', 73, 'Kota Serang', 36, 'Banten'),
(630, ' 42183', '36.73.03.1011', 'Pabuaran', NULL, 1007, 'Walantaka', 73, 'Kota Serang', 36, 'Banten'),
(631, ' 42183', '36.73.03.1007', 'Pager Agung (Pageragung)', NULL, NULL, 'Walantaka', 73, 'Kota Serang', 36, 'Banten'),
(632, ' 42183', '36.73.03.1004', 'Pangampelan (Pengampelan)', NULL, NULL, 'Walantaka', 73, 'Kota Serang', 36, 'Banten'),
(633, ' 42183', '36.73.03.1012', 'Pasuluhan', NULL, NULL, 'Walantaka', 73, 'Kota Serang', 36, 'Banten'),
(634, ' 42183', '36.73.03.1014', 'Pipitan', NULL, NULL, 'Walantaka', 73, 'Kota Serang', 36, 'Banten'),
(635, ' 42183', '36.73.03.1013', 'Tegalsari', NULL, NULL, 'Walantaka', 73, 'Kota Serang', 36, 'Banten'),
(636, ' 42183', '36.73.03.1010', 'Teritih', NULL, NULL, 'Walantaka', 73, 'Kota Serang', 36, 'Banten'),
(637, ' 42183', '36.73.03.1001', 'Walantaka', NULL, NULL, 'Walantaka', 73, 'Kota Serang', 36, 'Banten'),
(638, ' 42426', '36.72.01.1003', 'Bulakan', NULL, NULL, 'Cibeber', 72, 'Kota Cilegon', 36, 'Banten'),
(639, ' 42423', '36.72.01.1001', 'Cibeber', NULL, NULL, 'Cibeber', 72, 'Kota Cilegon', 36, 'Banten'),
(640, ' 42427', '36.72.01.1004', 'Cikerai', NULL, NULL, 'Cibeber', 72, 'Kota Cilegon', 36, 'Banten'),
(641, ' 42424', '36.72.01.1006', 'Kalitimbang', NULL, NULL, 'Cibeber', 72, 'Kota Cilegon', 36, 'Banten'),
(642, ' 42425', '36.72.01.1005', 'Karang Asem (Karangasem)', NULL, NULL, 'Cibeber', 72, 'Kota Cilegon', 36, 'Banten'),
(643, ' 42422', '36.72.01.1002', 'Kedaleman', NULL, NULL, 'Cibeber', 72, 'Kota Cilegon', 36, 'Banten'),
(644, ' 42419', '36.72.02.1001', 'Bagendung', NULL, NULL, 'Cilegon', 72, 'Kota Cilegon', 36, 'Banten'),
(645, ' 42417', '36.72.02.1003', 'Bendungan', NULL, NULL, 'Cilegon', 72, 'Kota Cilegon', 36, 'Banten'),
(646, ' 42415', '36.72.02.1005', 'Ciwaduk', NULL, NULL, 'Cilegon', 72, 'Kota Cilegon', 36, 'Banten'),
(647, ' 42418', '36.72.02.1002', 'Ciwedus', NULL, NULL, 'Cilegon', 72, 'Kota Cilegon', 36, 'Banten'),
(648, ' 42416', '36.72.02.1004', 'Ketileng', NULL, NULL, 'Cilegon', 72, 'Kota Cilegon', 36, 'Banten'),
(649, ' 42441', '36.72.08.1007', 'Citangkil', NULL, NULL, 'Citangkil', 72, 'Kota Cilegon', 36, 'Banten'),
(650, ' 42444', '36.72.08.1002', 'Dringo (Deringo)', NULL, NULL, 'Citangkil', 72, 'Kota Cilegon', 36, 'Banten'),
(651, ' 42442', '36.72.08.1005', 'Kebonsari', NULL, NULL, 'Citangkil', 72, 'Kota Cilegon', 36, 'Banten'),
(652, ' 42442', '36.72.08.1003', 'Lebak Denok (Lebakdenok)', NULL, NULL, 'Citangkil', 72, 'Kota Cilegon', 36, 'Banten'),
(653, ' 42443', '36.72.08.1006', 'Samangraya', NULL, NULL, 'Citangkil', 72, 'Kota Cilegon', 36, 'Banten'),
(654, ' 42441', '36.72.08.1004', 'Taman Baru (Tamanbaru)', NULL, NULL, 'Citangkil', 72, 'Kota Cilegon', 36, 'Banten'),
(655, ' 42443', '36.72.08.1001', 'Warnasari', NULL, NULL, 'Citangkil', 72, 'Kota Cilegon', 36, 'Banten'),
(656, ' 42441', '36.72.04.1001', 'Banjar Negara', NULL, NULL, 'Ciwandan', 72, 'Kota Cilegon', 36, 'Banten'),
(657, ' 42447', '36.72.04.1004', 'Gunung Sugih (Gunungsugih)', NULL, NULL, 'Ciwandan', 72, 'Kota Cilegon', 36, 'Banten'),
(658, ' 42446', '36.72.04.1005', 'Kepuh', NULL, NULL, 'Ciwandan', 72, 'Kota Cilegon', 36, 'Banten'),
(659, ' 42445', '36.72.04.1003', 'Kubangsari', NULL, NULL, 'Ciwandan', 72, 'Kota Cilegon', 36, 'Banten'),
(660, ' 42446', '36.72.04.1006', 'Randakari', NULL, NULL, 'Ciwandan', 72, 'Kota Cilegon', 36, 'Banten'),
(661, ' 42445', '36.72.04.1002', 'Tegal Ratu (Tegalratu)', NULL, NULL, 'Ciwandan', 72, 'Kota Cilegon', 36, 'Banten'),
(662, ' 42438', '36.72.06.1004', 'Gerem', NULL, NULL, 'Gerogol', 72, 'Kota Cilegon', 36, 'Banten'),
(663, ' 42436', '36.72.06.1002', 'Grogol (Gerogol)', NULL, NULL, 'Gerogol', 72, 'Kota Cilegon', 36, 'Banten'),
(664, ' 42436', '36.72.06.1001', 'Kotasari', NULL, NULL, 'Gerogol', 72, 'Kota Cilegon', 36, 'Banten'),
(665, ' 42436', '36.72.06.1003', 'Rawa Arum', NULL, NULL, 'Gerogol', 72, 'Kota Cilegon', 36, 'Banten'),
(666, ' 42413', '36.72.05.1005', 'Gedong Dalem', NULL, NULL, 'Jombang', 72, 'Kota Cilegon', 36, 'Banten'),
(667, ' 42411', '36.72.05.1002', 'Jombang Wetan', NULL, NULL, 'Jombang', 72, 'Kota Cilegon', 36, 'Banten'),
(668, ' 42414', '36.72.05.1003', 'Masigit', NULL, NULL, 'Jombang', 72, 'Kota Cilegon', 36, 'Banten'),
(669, ' 42412', '36.72.05.1004', 'Panggung Rawi', NULL, NULL, 'Jombang', 72, 'Kota Cilegon', 36, 'Banten'),
(670, ' 42416', '36.72.05.1001', 'Sukmajaya', NULL, NULL, 'Jombang', 72, 'Kota Cilegon', 36, 'Banten'),
(671, ' 42431', '36.72.03.1002', 'Lebakgede (Lebak Gede)', NULL, NULL, 'Pulomerak', 72, 'Kota Cilegon', 36, 'Banten'),
(672, ' 42438', '36.72.03.1003', 'Mekarsari', NULL, 1005, 'Pulomerak', 72, 'Kota Cilegon', 36, 'Banten'),
(673, ' 42439', '36.72.03.1004', 'Suralaya', NULL, NULL, 'Pulomerak', 72, 'Kota Cilegon', 36, 'Banten'),
(674, ' 42438', '36.72.03.1001', 'Tamansari', NULL, NULL, 'Pulomerak', 72, 'Kota Cilegon', 36, 'Banten'),
(675, ' 42433', '36.72.07.1003', 'Kebon Dalem (Kebondalem)', NULL, NULL, 'Purwakarta', 72, 'Kota Cilegon', 36, 'Banten'),
(676, ' 42434', '36.72.07.1002', 'Kotabumi', NULL, NULL, 'Purwakarta', 72, 'Kota Cilegon', 36, 'Banten'),
(677, ' 42437', '36.72.07.1006', 'Pabean', NULL, NULL, 'Purwakarta', 72, 'Kota Cilegon', 36, 'Banten'),
(678, ' 42437', '36.72.07.1004', 'Purwakarta', NULL, NULL, 'Purwakarta', 72, 'Kota Cilegon', 36, 'Banten'),
(679, ' 42431', '36.72.07.1001', 'Ramanuju', NULL, NULL, 'Purwakarta', 72, 'Kota Cilegon', 36, 'Banten'),
(680, ' 42437', '36.72.07.1005', 'Tegal Bunder', NULL, NULL, 'Purwakarta', 72, 'Kota Cilegon', 36, 'Banten');

-- --------------------------------------------------------

--
-- Table structure for table `m_kurir`
--

CREATE TABLE `m_kurir` (
  `id_kurir` int(11) NOT NULL,
  `nama_kurir` varchar(50) NOT NULL,
  `kode_kurir` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_kurir`
--

INSERT INTO `m_kurir` (`id_kurir`, `nama_kurir`, `kode_kurir`, `status`) VALUES
(1, 'JNE Express', 'jne', 1),
(2, 'J&T Express', 'jnt', 1),
(3, 'POS Indonesia', 'pos', 1),
(4, 'TIKI', 'tiki', 1),
(5, 'SiCepat', 'sicepat', 1),
(6, 'Wahana', 'wahana', 1),
(7, 'Lainnya', 'l', 0),
(8, 'RPX', 'rpx', 1),
(9, 'Pandu Express', 'pandu', 1),
(10, 'Pahala Express', 'pahala', 1),
(11, 'SAP Express', 'sap', 1),
(12, 'JET Express', 'jet', 1),
(13, 'Indah Cargo', 'indah', 1),
(14, 'Ninja Xpress', 'ninja', 1),
(15, 'Kirim Sendiri', 'ks', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_lainnya`
--

CREATE TABLE `m_lainnya` (
  `id_lainnya` int(11) NOT NULL,
  `nama_lainnya` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_lainnya`
--

INSERT INTO `m_lainnya` (`id_lainnya`, `nama_lainnya`, `status`) VALUES
(1, 'Negara Expor', 1),
(2, 'Volume Expor', 1),
(3, 'Nominal Expor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_modal_luar`
--

CREATE TABLE `m_modal_luar` (
  `id_modal_luar` int(11) NOT NULL,
  `nama_modal_luar` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_modal_luar`
--

INSERT INTO `m_modal_luar` (`id_modal_luar`, `nama_modal_luar`, `status`) VALUES
(1, 'Pinjaman Koperasi', 1),
(2, 'Pinjaman Perorangan', 1),
(3, 'Pinajaman Bank', 1),
(4, 'Bantuan Pemerintah', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_notifikasi`
--

CREATE TABLE `m_notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `username_penerima` varchar(16) DEFAULT NULL,
  `username_pengirim` varchar(16) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `id_detail` varchar(50) DEFAULT NULL COMMENT 'parameter, contoh: id_transaksi',
  `is_read` tinyint(1) DEFAULT 0 COMMENT '1 dibaca 0 belum',
  `modul` enum('transaksi_pembelian','transaksi_penjualan') DEFAULT NULL COMMENT 'membedakan notifikasi',
  `submodul` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_notifikasi`
--

INSERT INTO `m_notifikasi` (`id_notifikasi`, `username_penerima`, `username_pengirim`, `judul`, `message`, `tanggal`, `id_detail`, `is_read`, `modul`, `submodul`) VALUES
(1, '3315162107950003', '3315162107950003', 'Pesanan berhasil dibuat', 'Bayar sebelum 02 Sep 2021 11:13', '2021-09-01 11:13:00', '38', 1, 'transaksi_pembelian', 'detail_transaksi'),
(2, '3315162107950003', '3315162107950003', 'Pesanan berhasil dibuat', 'Bayar sebelum 02 Sep 2021 11:13', '2021-09-01 11:13:00', '39', 1, 'transaksi_pembelian', 'detail_transaksi'),
(3, '3315162107950003', '3315162107950003', 'Pesanan berhasil dibuat', 'Bayar sebelum 01 Sep 2021 12:15', '2021-09-01 11:15:24', '1759144010000099', 1, 'transaksi_pembelian', 'detail_transaksi_va_belum_bayar'),
(4, '3603111908960002', '3315162107950003', 'Pesanan Invoice INV/UMKM/16408/010921/111300', 'Dibatalkan pembeli. Klik untuk melihat detail pesanan', '2021-09-01 11:35:54', '38', 1, 'transaksi_penjualan', 'detail_transaksi'),
(5, '3315162107950003', '', 'Pesanan berhasil dibuat', 'Bayar sebelum 02 Sep 2021 11:07', '2021-09-02 10:07:03', '1759144010000079', 1, 'transaksi_pembelian', 'detail_transaksi_va_belum_bayar'),
(6, '3315162107950003', '', 'Pesanan berhasil dibuat', 'Bayar sebelum 02 Sep 2021 11:07', '2021-09-02 10:07:25', '1759144010000079', 1, 'transaksi_pembelian', 'detail_transaksi_va_belum_bayar'),
(7, '3315162107950003', '', 'Pesanan berhasil dibuat', 'Bayar sebelum 02 Sep 2021 11:13', '2021-09-02 10:13:22', '1759144010000079', 1, 'transaksi_pembelian', 'detail_transaksi_va_belum_bayar'),
(8, '3315162107950003', '', 'Pesanan berhasil dibuat', 'Bayar sebelum 02 Sep 2021 11:35', '2021-09-02 10:35:33', '1759144010000079', 1, 'transaksi_pembelian', 'detail_transaksi_va_belum_bayar'),
(9, '3315162107950003', '', 'Pesanan berhasil dibuat', 'Bayar sebelum 02 Sep 2021 11:37', '2021-09-02 10:37:44', '1759144010000079', 1, 'transaksi_pembelian', 'detail_transaksi_va_belum_bayar'),
(10, '3315162107950003', '3315162107950003', 'Pesanan berhasil dibuat', 'Bayar sebelum 08 Sep 2021 13:24', '2021-09-08 12:24:17', '1759144010000100', 1, 'transaksi_pembelian', 'detail_transaksi_va_belum_bayar'),
(11, '3671012506930002', '3671012506930002', 'Pesanan berhasil dibuat', 'Bayar sebelum 11 Sep 2021 22:18', '2021-09-11 21:18:18', '1759144010000101', 0, 'transaksi_pembelian', 'detail_transaksi_va_belum_bayar'),
(12, '3603284710880003', '3603284710880003', 'Pesanan berhasil dibuat', 'Bayar sebelum 12 Sep 2021 11:11', '2021-09-12 10:11:10', '1759144010000102', 0, 'transaksi_pembelian', 'detail_transaksi_va_belum_bayar'),
(13, '3315162107950003', '3315162107950003', 'Pesanan berhasil dibuat', 'Bayar sebelum 15 Nov 2021 11:08', '2021-11-15 10:08:09', '1759144010000103', 1, 'transaksi_pembelian', 'detail_transaksi_va_belum_bayar'),
(14, '3671012506930002', '3671012506930002', 'Pesanan berhasil dibuat', 'Bayar sebelum 16 Nov 2021 11:49', '2021-11-16 10:49:53', '1759144010000104', 0, 'transaksi_pembelian', 'detail_transaksi_va_belum_bayar'),
(15, '3671012506930002', '3671012506930002', 'Pesanan berhasil dibuat', 'Bayar sebelum 16 Nov 2021 11:49', '2021-11-16 10:49:53', '1759144010000105', 0, 'transaksi_pembelian', 'detail_transaksi_va_belum_bayar'),
(16, '3315162107950003', '', 'Pesanan berhasil dibuat', 'Bayar sebelum 07 Mar 2022 11:15', '2022-03-07 10:15:37', '1759144010000079', 1, 'transaksi_pembelian', 'detail_transaksi_va_belum_bayar'),
(17, '3671110702970001', '3301182905970002', 'Pesanan  berhasil dibuat', 'Silahkan melakukan pembayaran dan upload bukti pembayaran dalam waktu 1x24 jam.', '2022-05-18 09:10:46', '48', 1, 'transaksi_pembelian', 'detail_transaksi'),
(18, '3301182905970002', '3671110702970001', '1 pesanan baru ', 'Klik disini untuk melihat detail pesanan', '2022-05-18 09:10:46', '48', 0, 'transaksi_penjualan', 'detail_transaksi'),
(19, '3603284710880003', '3671110702970001', 'Pesanan INV/UMKM/16469/300821/111225 sedang diproses penjual', 'Klik disini untuk melihat detail pesanan', '2022-05-19 08:47:14', '20', 0, 'transaksi_pembelian', 'detail_transaksi'),
(20, '3603284710880003', '3671110702970001', 'Pesanan INV/UMKM/16469/300821/111225 dibatalkan penjual', 'Alasan penjual : (testing)', '2022-05-19 08:47:40', '20', 0, 'transaksi_pembelian', 'detail_transaksi'),
(21, '3671110702970001', '3671092303850004', 'Pesanan  berhasil dibuat', 'Silahkan melakukan pembayaran dan upload bukti pembayaran dalam waktu 1x24 jam.', '2022-06-02 08:41:37', '49', 1, 'transaksi_pembelian', 'detail_transaksi'),
(22, '3671092303850004', '3671110702970001', '1 pesanan baru ', 'Klik disini untuk melihat detail pesanan', '2022-06-02 08:41:37', '49', 1, 'transaksi_penjualan', 'detail_transaksi'),
(23, '3671110702970001', '3671012506930002', 'Pesanan  berhasil dibuat', 'Silahkan melakukan pembayaran dan upload bukti pembayaran dalam waktu 1x24 jam.', '2022-06-02 08:41:37', '50', 0, 'transaksi_pembelian', 'detail_transaksi'),
(24, '3671012506930002', '3671110702970001', '1 pesanan baru ', 'Klik disini untuk melihat detail pesanan', '2022-06-02 08:41:38', '50', 0, 'transaksi_penjualan', 'detail_transaksi'),
(25, '3671092303850004', '3671110702970001', 'Pesanan INV/UMKM/16514/020622/084137 berhasil dibayar', 'Silahkan Cek Pembayaran dan proses pesanan', '2022-06-02 08:43:11', '49', 1, 'transaksi_penjualan', 'detail_transaksi'),
(26, '3671110702970001', '3671092303850004', 'Pesanan INV/UMKM/16514/020622/084137 sedang diproses penjual', 'Klik disini untuk melihat detail pesanan', '2022-06-02 08:43:34', '49', 1, 'transaksi_pembelian', 'detail_transaksi'),
(27, '3671110702970001', '3671092303850004', 'Pesanan INV/UMKM/16514/020622/084137 dibatalkan penjual', 'Alasan penjual : palsu', '2022-06-02 08:44:39', '49', 1, 'transaksi_pembelian', 'detail_transaksi'),
(28, '3671110702970001', '3671092303850004', 'Pesanan  berhasil dibuat', 'Silahkan melakukan pembayaran dan upload bukti pembayaran dalam waktu 1x24 jam.', '2022-06-02 08:45:48', '51', 1, 'transaksi_pembelian', 'detail_transaksi'),
(29, '3671092303850004', '3671110702970001', '1 pesanan baru ', 'Klik disini untuk melihat detail pesanan', '2022-06-02 08:45:48', '51', 1, 'transaksi_penjualan', 'detail_transaksi'),
(30, '3671092303850004', '3671110702970001', 'Pesanan INV/UMKM/16514/020622/084548 berhasil dibayar', 'Silahkan Cek Pembayaran dan proses pesanan', '2022-06-02 08:47:23', '51', 1, 'transaksi_penjualan', 'detail_transaksi'),
(31, '3671110702970001', '3671092303850004', 'Pesanan INV/UMKM/16514/020622/084548 sedang diproses penjual', 'Klik disini untuk melihat detail pesanan', '2022-06-02 08:47:46', '51', 1, 'transaksi_pembelian', 'detail_transaksi'),
(32, '3671110702970001', '3671092303850004', 'Pesanan INV/UMKM/16514/020622/084548 sudah dikirim penjual', 'Klik disini untuk melihat detail pesanan', '2022-06-02 08:48:08', '51', 1, 'transaksi_pembelian', 'detail_transaksi'),
(33, '3671092303850004', '3671110702970001', 'Pesanan INV/UMKM/16514/020622/084548 sudah diterima pembeli', 'Klik disini untuk melihat detail pesanan', '2022-06-02 08:48:45', '51', 1, 'transaksi_penjualan', 'detail_transaksi'),
(34, '3671092303850004', '3671110702970001', '1 ulasan baru', 'MAKNYOSSSSS ', '2022-06-02 08:49:09', '51', 1, 'transaksi_penjualan', 'ulasan'),
(35, '3671110702970001', '', 'Pesanan Invoice INV/UMKM/16518/020622/084137', 'Dibatalkan penjual, alasan penjual : test tolak', '2022-06-02 09:32:48', '50', 0, 'transaksi_pembelian', 'detail_transaksi'),
(36, '3671110702970001', '3671092303850004', 'Pesanan  berhasil dibuat', 'Silahkan melakukan pembayaran dan upload bukti pembayaran dalam waktu 1x24 jam.', '2022-06-03 15:18:24', '52', 0, 'transaksi_pembelian', 'detail_transaksi'),
(37, '3671092303850004', '3671110702970001', '1 pesanan baru ', 'Klik disini untuk melihat detail pesanan', '2022-06-03 15:18:24', '52', 1, 'transaksi_penjualan', 'detail_transaksi'),
(38, '3671092303850004', '3671110702970001', 'Pesanan INV/UMKM/16564/030622/031823 berhasil dibayar', 'Silahkan Cek Pembayaran dan proses pesanan', '2022-06-03 15:19:37', '52', 1, 'transaksi_penjualan', 'detail_transaksi'),
(39, '3671110702970001', '3671092303850004', 'Pesanan INV/UMKM/16564/030622/031823 sedang diproses penjual', 'Klik disini untuk melihat detail pesanan', '2022-06-03 15:20:22', '52', 1, 'transaksi_pembelian', 'detail_transaksi'),
(40, '3671110702970001', '3671092303850004', 'Pesanan INV/UMKM/16564/030622/031823 sudah dikirim penjual', 'Klik disini untuk melihat detail pesanan', '2022-06-03 15:21:17', '52', 1, 'transaksi_pembelian', 'detail_transaksi'),
(41, '3671092303850004', '3671110702970001', 'Pesanan INV/UMKM/16564/030622/031823 sudah diterima pembeli', 'Klik disini untuk melihat detail pesanan', '2022-06-03 15:21:49', '52', 1, 'transaksi_penjualan', 'detail_transaksi'),
(42, '3671092303850004', '3671110702970001', '1 ulasan baru', 'Barang nya bagus ', '2022-06-03 15:22:09', '52', 1, 'transaksi_penjualan', 'ulasan'),
(43, '3671110702970001', '3671092303850004', 'Pesanan  berhasil dibuat', 'Silahkan melakukan pembayaran dan upload bukti pembayaran dalam waktu 1x24 jam.', '2022-06-06 14:45:29', '53', 0, 'transaksi_pembelian', 'detail_transaksi'),
(44, '3671092303850004', '3671110702970001', '1 pesanan baru ', 'Klik disini untuk melihat detail pesanan', '2022-06-06 14:45:29', '53', 1, 'transaksi_penjualan', 'detail_transaksi'),
(45, '3671092303850004', '3671110702970001', 'Pesanan INV/UMKM/16564/060622/024528 berhasil dibayar', 'Silahkan Cek Pembayaran dan proses pesanan', '2022-06-06 14:48:37', '53', 1, 'transaksi_penjualan', 'detail_transaksi'),
(46, '3671110702970001', '3671092303850004', 'Pesanan INV/UMKM/16564/060622/024528 sedang diproses penjual', 'Klik disini untuk melihat detail pesanan', '2022-06-06 14:49:26', '53', 0, 'transaksi_pembelian', 'detail_transaksi'),
(47, '3671110702970001', '3671092303850004', 'Pesanan INV/UMKM/16564/060622/024528 sudah dikirim penjual', 'Klik disini untuk melihat detail pesanan', '2022-06-06 14:49:50', '53', 0, 'transaksi_pembelian', 'detail_transaksi'),
(48, '3671092303850004', '3671110702970001', 'Pesanan  berhasil dibuat', 'Silahkan melakukan pembayaran dan upload bukti pembayaran dalam waktu 1x24 jam.', '2022-06-06 16:29:02', '54', 1, 'transaksi_pembelian', 'detail_transaksi'),
(49, '3671110702970001', '3671092303850004', '1 pesanan baru ', 'Klik disini untuk melihat detail pesanan', '2022-06-06 16:29:02', '54', 0, 'transaksi_penjualan', 'detail_transaksi'),
(50, '3671110702970001', '3671092303850004', 'Pesanan INV/UMKM/16469/060622/042901 berhasil dibayar', 'Silahkan Cek Pembayaran dan proses pesanan', '2022-06-06 16:32:55', '54', 0, 'transaksi_penjualan', 'detail_transaksi'),
(51, '3671092303850004', '3671110702970001', 'Pesanan INV/UMKM/16469/060622/042901 sedang diproses penjual', 'Klik disini untuk melihat detail pesanan', '2022-06-06 16:34:13', '54', 1, 'transaksi_pembelian', 'detail_transaksi'),
(52, '3671092303850004', '3671110702970001', 'Pesanan  berhasil dibuat', 'Silahkan melakukan pembayaran dan upload bukti pembayaran dalam waktu 1x24 jam.', '2022-06-06 16:57:46', '55', 1, 'transaksi_pembelian', 'detail_transaksi'),
(53, '3671110702970001', '3671092303850004', '1 pesanan baru ', 'Klik disini untuk melihat detail pesanan', '2022-06-06 16:57:46', '55', 0, 'transaksi_penjualan', 'detail_transaksi'),
(54, '3671110702970001', '3671092303850004', 'Pesanan INV/UMKM/16469/060622/045745 berhasil dibayar', 'Silahkan Cek Pembayaran dan proses pesanan', '2022-06-06 16:58:16', '55', 0, 'transaksi_penjualan', 'detail_transaksi'),
(55, '3671092303850004', '3671110702970001', 'Pesanan INV/UMKM/16469/060622/042901 sudah dikirim penjual', 'Klik disini untuk melihat detail pesanan', '2022-06-07 08:36:05', '54', 0, 'transaksi_pembelian', 'detail_transaksi'),
(56, '3671110702970001', '3671092303850004', 'Pesanan  berhasil dibuat', 'Silahkan melakukan pembayaran dan upload bukti pembayaran dalam waktu 1x24 jam.', '2022-06-07 10:38:40', '56', 0, 'transaksi_pembelian', 'detail_transaksi'),
(57, '3671092303850004', '3671110702970001', '1 pesanan baru ', 'Klik disini untuk melihat detail pesanan', '2022-06-07 10:38:40', '56', 0, 'transaksi_penjualan', 'detail_transaksi'),
(58, '3671092303850004', '3671110702970001', 'Pesanan INV/UMKM/16482/070622/103838 berhasil dibayar', 'Silahkan Cek Pembayaran dan proses pesanan', '2022-06-07 15:59:01', '56', 1, 'transaksi_penjualan', 'detail_transaksi'),
(59, '3671110702970001', '3671092303850004', 'Pesanan INV/UMKM/16482/070622/103838 sedang diproses penjual', 'Klik disini untuk melihat detail pesanan', '2022-06-07 16:24:22', '56', 0, 'transaksi_pembelian', 'detail_transaksi'),
(60, '3671110702970001', '3671092303850004', 'Pesanan INV/UMKM/16482/070622/103838 sudah dikirim penjual', 'Klik disini untuk melihat detail pesanan', '2022-06-07 16:25:31', '56', 0, 'transaksi_pembelian', 'detail_transaksi'),
(61, '3671092303850004', '3671110702970001', 'Pesanan INV/UMKM/16482/070622/103838 sudah diterima pembeli', 'Klik disini untuk melihat detail pesanan', '2022-06-07 16:39:05', '56', 0, 'transaksi_penjualan', 'detail_transaksi'),
(62, '3671052710810004', '3603111908960002', 'Pesanan INV/UMKM/16408/010922/104822 berhasil dibuat', 'Silahkan melakukan pembayaran dan upload bukti pembayaran dalam waktu 1x24 jam.', '2022-09-01 22:48:22', '265', 0, 'transaksi_pembelian', 'detail_transaksi'),
(63, '3603111908960002', '3671052710810004', '1 pesanan baru INV/UMKM/16408/010922/104822', 'Klik disini untuk melihat detail pesanan', '2022-09-01 22:48:23', '265', 0, 'transaksi_penjualan', 'detail_transaksi'),
(64, '3671052710810004', '3603111908960002', 'Pesanan INV/UMKM/16408/010922/104851 berhasil dibuat', 'Silahkan melakukan pembayaran dan upload bukti pembayaran dalam waktu 1x24 jam.', '2022-09-01 22:48:51', '270', 0, 'transaksi_pembelian', 'detail_transaksi'),
(65, '3603111908960002', '3671052710810004', '1 pesanan baru INV/UMKM/16408/010922/104851', 'Klik disini untuk melihat detail pesanan', '2022-09-01 22:48:52', '270', 0, 'transaksi_penjualan', 'detail_transaksi'),
(66, '3671052710810004', '3603111908960002', 'Pesanan INV/UMKM/16408/010922/104908 berhasil dibuat', 'Silahkan melakukan pembayaran dan upload bukti pembayaran dalam waktu 1x24 jam.', '2022-09-01 22:49:08', '275', 0, 'transaksi_pembelian', 'detail_transaksi'),
(67, '3603111908960002', '3671052710810004', '1 pesanan baru INV/UMKM/16408/010922/104908', 'Klik disini untuk melihat detail pesanan', '2022-09-01 22:49:11', '275', 0, 'transaksi_penjualan', 'detail_transaksi'),
(68, '3671052710810004', '3603111908960002', 'Pesanan INV/UMKM/16408/010922/105153 berhasil dibuat', 'Silahkan melakukan pembayaran dan upload bukti pembayaran dalam waktu 1x24 jam.', '2022-09-01 22:51:54', '280', 0, 'transaksi_pembelian', 'detail_transaksi'),
(69, '3603111908960002', '3671052710810004', '1 pesanan baru INV/UMKM/16408/010922/105153', 'Klik disini untuk melihat detail pesanan', '2022-09-01 22:51:54', '280', 0, 'transaksi_penjualan', 'detail_transaksi'),
(70, '3603111908960002', '3671052710810004', 'Pesanan INV/UMKM/16408/010922/105153 berhasil dibayar', 'Silahkan Cek Pembayaran dan proses pesanan', '2022-09-01 22:53:30', '280', 0, 'transaksi_penjualan', 'detail_transaksi'),
(71, '3671081105960002', '3671125202900001', 'Pesanan  berhasil dibuat', 'Silahkan melakukan pembayaran dan upload bukti pembayaran dalam waktu 1x24 jam.', '2023-03-17 15:58:08', '57', 1, 'transaksi_pembelian', 'detail_transaksi'),
(72, '3671125202900001', '3671081105960002', '1 pesanan baru ', 'Klik disini untuk melihat detail pesanan', '2023-03-17 15:58:10', '57', 0, 'transaksi_penjualan', 'detail_transaksi'),
(73, '3671081105960002', '3671125202900001', 'Pesanan  berhasil dibuat', 'Silahkan melakukan pembayaran dan upload bukti pembayaran dalam waktu 1x24 jam.', '2023-03-18 10:10:42', '58', 1, 'transaksi_pembelian', 'detail_transaksi'),
(74, '3671125202900001', '3671081105960002', '1 pesanan baru ', 'Klik disini untuk melihat detail pesanan', '2023-03-18 10:10:43', '58', 0, 'transaksi_penjualan', 'detail_transaksi');

-- --------------------------------------------------------

--
-- Table structure for table `m_pengguna`
--

CREATE TABLE `m_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `id_group` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `domisili` varchar(10) DEFAULT NULL,
  `domisili_prop` int(11) DEFAULT NULL,
  `domisili_kota` int(11) DEFAULT NULL,
  `no_rt` int(11) DEFAULT NULL,
  `no_rw` int(11) DEFAULT NULL,
  `no_kel` int(11) DEFAULT NULL,
  `no_kec` int(11) DEFAULT NULL,
  `no_kab` int(11) DEFAULT NULL,
  `no_prop` int(11) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `kode_pos` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_pengguna`
--

INSERT INTO `m_pengguna` (`id_pengguna`, `id_group`, `username`, `nama`, `jenis_kelamin`, `alamat`, `email`, `domisili`, `domisili_prop`, `domisili_kota`, `no_rt`, `no_rw`, `no_kel`, `no_kec`, `no_kab`, `no_prop`, `no_telp`, `kode_pos`, `created_at`, `updated_at`, `last_login`, `password`, `status`) VALUES
(1, 1, 'admin', 'ADMINISTRATOR', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-12 14:27:43', '2020-03-04 11:15:37', '2023-03-26 20:13:39', '75141672a9601a29bd2761654dcd0fdbdaa17dd8b36c185110aca7a4778f8d0f', 1),
(5, 2, 'hypermartkarawaci', 'HYPERMART KARAWACI', 'Laki-Laki', 'KARAWACI', 'hypermart_karawaci@mail.com', 'Dalam Kota', 36, 71, 1, 1, 1001, 7, 71, 36, '089654020925', NULL, '2021-02-10 17:31:27', NULL, '2023-03-26 14:14:29', 'a6fab14876ae66833aa96f13a4b818f4008bf88f5910687c7981447cb8412268', 1),
(8, 2, 'rianto@gmail.com', 'rianto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-26 19:16:28', NULL, '2023-03-26 19:26:04', 'a6fab14876ae66833aa96f13a4b818f4008bf88f5910687c7981447cb8412268', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_pesan`
--

CREATE TABLE `m_pesan` (
  `id_pesan` int(11) NOT NULL,
  `username_pengirim` varchar(100) DEFAULT NULL,
  `username_penerima` varchar(100) DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `id_umkm` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_pesan`
--

INSERT INTO `m_pesan` (`id_pesan`, `username_pengirim`, `username_penerima`, `id_group`, `created_at`, `id_umkm`) VALUES
(1, '3603111908960002', '3671050303940009', 1630380963, '2021-08-31 10:36:03', 16470),
(2, '3671050303940009', '3603111908960002', 1630380963, '2021-08-31 10:36:03', 16470),
(3, '3603111908960002', '3671050303940009', 1630386618, '2021-08-31 12:10:18', 16484),
(4, '3671050303940009', '3603111908960002', 1630386618, '2021-08-31 12:10:18', 16484),
(5, '3603111908960002', '3603282009920005', 1630396996, '2021-08-31 15:03:16', 4),
(6, '3603282009920005', '3603111908960002', 1630396996, '2021-08-31 15:03:16', 4),
(7, '3603111908960002', '3671044708770004', 1630397008, '2021-08-31 15:03:28', 16504),
(8, '3671044708770004', '3603111908960002', 1630397008, '2021-08-31 15:03:28', 16504),
(9, '198602132011011002', '3671044708770004', 1630402950, '2021-08-31 16:42:30', 16504),
(10, '3671044708770004', '198602132011011002', 1630402950, '2021-08-31 16:42:30', 16504),
(11, '198602132011011002', '3603282009920005', 1630402962, '2021-08-31 16:42:42', 4),
(12, '3603282009920005', '198602132011011002', 1630402962, '2021-08-31 16:42:42', 4),
(13, '198602132011011002', '3671050303940009', 1630402968, '2021-08-31 16:42:48', 16470),
(14, '3671050303940009', '198602132011011002', 1630402968, '2021-08-31 16:42:48', 16470),
(15, '3603284710880003', '3671110702970001', 1630414302, '2021-08-31 19:51:42', 16469),
(16, '3671110702970001', '3603284710880003', 1630414302, '2021-08-31 19:51:42', 16469),
(17, '3315162107950003', '3671050303940009', 1630486277, '2021-09-01 15:51:17', 16484),
(18, '3671050303940009', '3315162107950003', 1630486277, '2021-09-01 15:51:17', 16484),
(19, '3315162107950003', '3301182905970002', 1630572740, '2021-09-02 15:52:20', 16531),
(20, '3301182905970002', '3315162107950003', 1630572740, '2021-09-02 15:52:20', 16531),
(21, '3315162107950003', '3671054712020001', 1631078528, '2021-09-08 12:22:08', 16467),
(22, '3671054712020001', '3315162107950003', 1631078528, '2021-09-08 12:22:08', 16467),
(23, '3671110702970001', '3671052808950008', 1652839436, '2022-05-18 09:03:56', 16472),
(24, '3671052808950008', '3671110702970001', 1652839436, '2022-05-18 09:03:56', 16472),
(25, '3671110702970001', '3671092303850004', 1654133985, '2022-06-02 08:39:45', 16514),
(26, '3671092303850004', '3671110702970001', 1654133985, '2022-06-02 08:39:45', 16514),
(27, NULL, NULL, 1662436342, '2022-09-06 10:52:22', 163985),
(28, NULL, NULL, 1662436342, '2022-09-06 10:52:22', 163985),
(29, NULL, NULL, 1662436352, '2022-09-06 10:52:32', 163985),
(30, NULL, NULL, 1662436352, '2022-09-06 10:52:32', 163985),
(31, '3671081105960002', '3671125202900001', 1679043013, '2023-03-17 15:50:13', 16565),
(32, '3671125202900001', '3671081105960002', 1679043013, '2023-03-17 15:50:13', 16565),
(33, 'egov', 'egov', 1679547284, '2023-03-23 11:54:44', 1),
(34, 'egov', 'egov', 1679547284, '2023-03-23 11:54:44', 1),
(35, 'hypermartkarawaci', 'egov', 1679630043, '2023-03-24 10:54:03', 1),
(36, 'egov', 'hypermartkarawaci', 1679630043, '2023-03-24 10:54:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_pesan_detail`
--

CREATE TABLE `m_pesan_detail` (
  `id_pesan_detail` int(11) NOT NULL,
  `id_group` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `pesan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `read_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_pesan_detail`
--

INSERT INTO `m_pesan_detail` (`id_pesan_detail`, `id_group`, `id_produk`, `id_transaksi`, `username`, `pesan`, `created_at`, `is_read`, `read_at`) VALUES
(1, 1630386618, NULL, 31, '3603111908960002', 'Bisa dikirim hari ini?', '2021-08-31 12:10:23', 0, NULL),
(2, 1630414302, NULL, NULL, '3603284710880003', 'belum dikirim barangya', '2021-08-31 19:51:51', 0, NULL),
(3, 1630386618, 0, NULL, '3603111908960002', ' Terima kasih !', '2021-09-01 10:57:46', NULL, NULL),
(4, 1630486277, NULL, 35, '3315162107950003', 'Hai, apakah barang masih ada?', '2021-09-01 15:51:30', 0, NULL),
(5, 1630486277, NULL, 35, '3315162107950003', 'Hai, apakah barang masih ada?', '2021-09-01 15:51:46', 0, NULL),
(6, 1630486277, NULL, NULL, '3315162107950003', 'Terima Kasih.', '2021-09-01 15:52:14', 0, NULL),
(7, 1630572740, 182, NULL, '3315162107950003', 'Hai, apakah barang masih ada?', '2021-09-02 15:52:23', 1, '2021-09-02 15:52:37'),
(8, 1631078528, 64, NULL, '3315162107950003', 'Hai, apakah barang masih ada?', '2021-09-08 12:22:12', 0, NULL),
(9, 1630486277, NULL, 35, '3315162107950003', 'Bisa dikirim hari ini?', '2021-09-08 12:25:08', 0, NULL),
(10, 1630397008, NULL, 32, '3603111908960002', 'tes', '2022-05-12 11:26:48', NULL, NULL),
(11, 1652839436, 68, NULL, '3671110702970001', ' Hai ! Apakah produk ini masih tersedia ?', '2022-05-18 09:04:00', 1, '2022-05-18 09:11:04'),
(12, 1652839436, 0, NULL, '3671110702970001', ' Terima kasih !', '2022-05-18 09:04:16', 1, '2022-05-18 09:26:04'),
(13, 1652839436, 0, NULL, '3671110702970001', ' Hai ! Apakah produk ini masih tersedia ?', '2022-05-18 09:04:21', 1, '2022-05-18 09:26:04'),
(14, 1652839436, 0, NULL, '3671052808950008', 'hai, produk masih tersedia ', '2022-05-18 09:04:51', 1, '2022-05-18 09:00:05'),
(15, 1654133985, 243, NULL, '3671110702970001', 'bang Hai ! Apakah produk ini masih tersedia ?', '2022-06-02 08:39:54', 1, '2022-06-02 08:36:40'),
(16, 1654133985, 0, NULL, '3671092303850004', 'buanyak', '2022-06-02 08:40:46', 1, '2022-06-02 08:57:40'),
(17, 1654133985, NULL, 49, '3671110702970001', 'bang ngapa di batalin', '2022-06-02 08:44:50', 1, '2022-06-02 08:27:45'),
(18, 1679630043, NULL, 1, 'hypermartkarawaci', 'gimana nih kehidupan', '2023-03-24 10:54:15', NULL, NULL),
(19, 1679630043, NULL, 1, 'hypermartkarawaci', 'gimana nih kehidupan', '2023-03-24 10:54:46', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_produk`
--

CREATE TABLE `m_produk` (
  `id_produk` int(11) NOT NULL,
  `id_umkm` int(11) DEFAULT NULL,
  `id_jenis_usaha` int(11) DEFAULT NULL,
  `kode_produk` varchar(10) DEFAULT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(10) UNSIGNED DEFAULT 0,
  `diskon` float(5,2) DEFAULT 0.00,
  `diskon_nominal` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `ratting` float(1,0) DEFAULT 0,
  `dilihat` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT NULL COMMENT '1=aktif, 2=nonaktif by user, 3=nonaktif by admin',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `alasan` varchar(255) DEFAULT NULL,
  `link_eksternal` text DEFAULT NULL COMMENT 'json array berisi link eksternal produk (ecommerce)',
  `link_sosmed` text DEFAULT NULL COMMENT 'json array berisi link produk (sosmed)',
  `link_video` text DEFAULT NULL COMMENT 'json array link video produk (youtube)',
  `id_kurir` varchar(255) DEFAULT NULL COMMENT 'json array id_kurir',
  `berat` float(5,2) DEFAULT NULL COMMENT 'kg',
  `is_eorder` tinyint(3) UNSIGNED DEFAULT NULL,
  `harga_modal` int(11) DEFAULT NULL,
  `id_unit` int(11) DEFAULT 2,
  `sumber` enum('borongsay web','borongsay mobile','qasir umkm') DEFAULT 'borongsay web',
  `is_delete` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_produk`
--

INSERT INTO `m_produk` (`id_produk`, `id_umkm`, `id_jenis_usaha`, `kode_produk`, `nama_produk`, `tags`, `harga`, `stok`, `diskon`, `diskon_nominal`, `deskripsi`, `ratting`, `dilihat`, `status`, `created_at`, `updated_at`, `alasan`, `link_eksternal`, `link_sosmed`, `link_video`, `id_kurir`, `berat`, `is_eorder`, `harga_modal`, `id_unit`, `sumber`, `is_delete`) VALUES
(1, 1, 3, '1679813842', 'Baju Coklat', 'baju lebaran,celana lebaran', 300000, 629, 20.00, 60000, '<p>baju coklat hangat 200 an</p>\n', 0, 16, 1, '2023-03-26 13:57:22', '2023-03-26 14:08:35', NULL, NULL, NULL, NULL, '[\"1\",\"2\",\"3\",\"5\"]', 0.30, 0, NULL, 2, 'borongsay web', 0),
(2, 1, 4, '1679813991', 'Parfum', '', 300000, 198, 15.00, 45000, '<p>perfum wangi</p>\n', 0, 4, 1, '2023-03-26 13:59:51', '2023-03-26 14:17:07', NULL, NULL, NULL, NULL, '[\"1\",\"2\",\"3\",\"5\"]', 0.40, 0, NULL, 2, 'borongsay web', 0),
(3, 1, 5, '1679836531', 'Sepatu Kulit', '', 300000, 23, 10.00, 30000, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n', 0, 0, 1, '2023-03-26 20:15:31', NULL, NULL, NULL, NULL, NULL, '[\"1\",\"2\",\"3\",\"5\"]', 1.00, 0, NULL, 2, 'borongsay web', 0),
(4, 1, 3, '1679836633', 'baju anti hujan', 'baju anti hujan', 1000000, 400, 0.00, 0, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n', 0, 0, 1, '2023-03-26 20:17:13', NULL, NULL, NULL, NULL, NULL, '[\"1\",\"2\",\"3\",\"5\"]', 0.20, 0, NULL, 2, 'borongsay web', 0);

-- --------------------------------------------------------

--
-- Table structure for table `m_produk_foto`
--

CREATE TABLE `m_produk_foto` (
  `id_foto` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_produk_foto`
--

INSERT INTO `m_produk_foto` (`id_foto`, `id_produk`, `foto`) VALUES
(1, 1, 'f23222c2c27777b842c64b903df44d28.png'),
(2, 1, '96181f2108b2f90d4a557e9b57155b4a.png'),
(3, 1, 'bfbb6c552c32b2b20fd0c39d56f2a808.png'),
(4, 1, '8e60a40a064f9e90fa27afeae1b61155.png'),
(5, 2, 'd5f50298d86357340c76525d23aeb509.jpg'),
(6, 3, 'c5dc367dda4b02a2d8101108d163dd5a.jpg'),
(7, 4, '03307e5e0c66ceee30ffcb8781322296.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `m_produk_stok`
--

CREATE TABLE `m_produk_stok` (
  `id_stok` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `ukuran` varchar(255) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_produk_stok`
--

INSERT INTO `m_produk_stok` (`id_stok`, `id_produk`, `ukuran`, `stok`) VALUES
(1, 1, 'XL', 229),
(2, 1, 'L', 200),
(3, 1, 'M', 200),
(4, 2, '30ml', 198),
(5, 3, '42', 20),
(6, 3, '43', 1),
(7, 3, '45', 2),
(8, 4, 'XL', 200),
(9, 4, 'M', 200);

-- --------------------------------------------------------

--
-- Table structure for table `m_sarana_usaha`
--

CREATE TABLE `m_sarana_usaha` (
  `id_sarana_usaha` int(11) NOT NULL,
  `nama_sarana` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_sarana_usaha`
--

INSERT INTO `m_sarana_usaha` (`id_sarana_usaha`, `nama_sarana`, `status`) VALUES
(1, 'Tempat Tinggal (Rumah)', 1),
(2, 'Kios', 1),
(3, 'Ruko', 1),
(4, 'Lainnya', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_sektor_usaha`
--

CREATE TABLE `m_sektor_usaha` (
  `id_sektor_usaha` int(11) NOT NULL,
  `id_jenis_usaha` varchar(100) DEFAULT NULL,
  `nama_sektor_usaha` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_sektor_usaha`
--

INSERT INTO `m_sektor_usaha` (`id_sektor_usaha`, `id_jenis_usaha`, `nama_sektor_usaha`, `status`) VALUES
(1, NULL, 'Pertanian/Kehutanan/Perikanan', 1),
(2, NULL, 'Pertambangan & Penggalian', 1),
(3, '2,3,4,6', 'Industri Pengolahan', 1),
(4, NULL, 'Pengadaan Listrik & Gas', 1),
(5, NULL, 'Pengadaan air/Pengolahan Sampah/Limbah & Daur Ulang', 1),
(6, NULL, 'Kontruksi', 1),
(7, '7,11', 'Perdagangan Besar& Eceran,Reparasi Mobil & Sepeda Motor', 1),
(8, '7', 'Transportasi & Pergudangan', 1),
(9, '1', 'Penyedia Akomodasi & Makan Minum', 1),
(10, '5,10', 'Informasi & Komunikasi', 1),
(11, NULL, 'Jasa Keuangan dan Asuransi', 1),
(12, NULL, 'Real Estat', 1),
(13, '12', 'Jasa Perusahaan', 1),
(14, NULL, 'Administrasi Pemerintahan, Pertanahan & Jaminan Sosial Wajib', 1),
(15, '8', 'Jasa Pendidikan', 1),
(16, NULL, 'Jasa Kesehatan & Kegiatan Sosial', 1),
(17, NULL, 'Jasa Lainnya', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_skala_usaha`
--

CREATE TABLE `m_skala_usaha` (
  `id_skala_usaha` int(11) NOT NULL,
  `nama_skala` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_skala_usaha`
--

INSERT INTO `m_skala_usaha` (`id_skala_usaha`, `nama_skala`, `status`) VALUES
(1, 'Micro', 1),
(2, 'Kecil', 1),
(3, 'Menengah', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_slider`
--

CREATE TABLE `m_slider` (
  `id_slider` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_slider`
--

INSERT INTO `m_slider` (`id_slider`, `judul`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Slide', '1ccc18b3897dc9f40797ab7143f3a451.png', 'nonaktif', '2020-01-21 17:44:04', '2020-10-05 14:22:57'),
(2, 'Banner', '34bc7a766d23088f12b5398981cb6011.png', 'aktif', '2020-02-06 09:41:46', '2020-02-06 09:20:58'),
(3, 'TEst ed', '4c90e21d2fa2671a4b4d137083001fec.jpg', 'nonaktif', '2020-10-05 14:22:23', '2020-10-05 14:23:42'),
(4, 'Slide', 'dummy_banner1.jpg', 'aktif', NULL, NULL),
(5, 'Slide', 'dummy_banner2.png', 'aktif', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_status`
--

CREATE TABLE `m_status` (
  `id_status` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_status`
--

INSERT INTO `m_status` (`id_status`, `nama`) VALUES
(1, 'Verifikasi Toko di Terima'),
(2, 'Menunggu Verifikasi Toko'),
(3, 'Verifikasi Toko di Tolak'),
(4, 'Data Belum Lengkap');

-- --------------------------------------------------------

--
-- Table structure for table `m_status_tempat_usaha`
--

CREATE TABLE `m_status_tempat_usaha` (
  `id_status_tempat_usaha` int(11) NOT NULL,
  `nama_status_tempat_usaha` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_status_tempat_usaha`
--

INSERT INTO `m_status_tempat_usaha` (`id_status_tempat_usaha`, `nama_status_tempat_usaha`, `status`) VALUES
(1, 'Milik Sendiri', 1),
(2, 'Kontrak', 1),
(3, 'Sewa', 1),
(4, 'Lainnya', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_status_transaksi`
--

CREATE TABLE `m_status_transaksi` (
  `id_status_transaksi` varchar(255) NOT NULL,
  `nama_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_status_transaksi`
--

INSERT INTO `m_status_transaksi` (`id_status_transaksi`, `nama_status`) VALUES
('0', 'Menunggu Pembayaran'),
('1', 'Menunggu Konfirmasi'),
('2', 'Pesanan Diproses'),
('3', 'Sedang Dikirim'),
('4', 'Sampai Tujuan'),
('5', 'Pesanan Dibatalkan'),
('6', 'Dibatalkan Otomatis');

-- --------------------------------------------------------

--
-- Table structure for table `m_transaksi`
--

CREATE TABLE `m_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_umkm` int(11) DEFAULT NULL,
  `id_status_transaksi` int(11) DEFAULT NULL,
  `no_invoice` varchar(100) DEFAULT NULL,
  `id_alamat` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL COMMENT 'total harga produk dlm 1 invoice yg sudah dikurang diskon produk',
  `nominal_diskon_produk` int(11) DEFAULT NULL COMMENT 'jml diskon produk',
  `nominal_diskon_ongkir` int(11) DEFAULT NULL,
  `ongkir` int(11) DEFAULT NULL COMMENT 'ongkir yg sudah dikurang diskon ongkir',
  `total_berat` float(5,2) DEFAULT NULL COMMENT 'total berat barang dlm satu invoice (kg)',
  `total` int(11) DEFAULT NULL COMMENT 'total_harga + ongkir',
  `id_kurir` int(11) DEFAULT NULL,
  `kurir_service` varchar(20) DEFAULT NULL,
  `no_resi` varchar(100) DEFAULT NULL,
  `ket_ongkir` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `bukti_pembayaran` varchar(100) DEFAULT NULL COMMENT 'file bukti pembayaran',
  `tgl_pembayaran` datetime DEFAULT NULL,
  `tgl_konfirmasi` datetime DEFAULT NULL,
  `tgl_kirim` datetime DEFAULT NULL,
  `tgl_sampai` datetime DEFAULT NULL,
  `pesan_batal` text DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL COMMENT 'username',
  `source` enum('web','android') DEFAULT NULL,
  `va` varchar(20) DEFAULT NULL,
  `va_full` varchar(24) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 sudah 0 belum',
  `is_read_penjual` tinyint(1) DEFAULT 0 COMMENT '1 sudah 0 belum',
  `metode_bayar` enum('bank_transfer','va','midtrans') DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `token_midtrans` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_transaksi`
--

INSERT INTO `m_transaksi` (`id_transaksi`, `id_umkm`, `id_status_transaksi`, `no_invoice`, `id_alamat`, `username`, `total_harga`, `nominal_diskon_produk`, `nominal_diskon_ongkir`, `ongkir`, `total_berat`, `total`, `id_kurir`, `kurir_service`, `no_resi`, `ket_ongkir`, `created_at`, `updated_at`, `bukti_pembayaran`, `tgl_pembayaran`, `tgl_konfirmasi`, `tgl_kirim`, `tgl_sampai`, `pesan_batal`, `updated_by`, `source`, `va`, `va_full`, `is_read`, `is_read_penjual`, `metode_bayar`, `size`, `token_midtrans`) VALUES
(1, 1, 3, 'INV/UMKM/1/260323/122926', 82, '1501298859', 900, 100, 0, 10000, 0.10, 10900, 1, 'CTC', 'noResidasdaav', 'JNE City Courier', '2023-03-26 12:29:26', '2023-03-26 12:49:05', NULL, NULL, '2023-03-26 12:47:36', '2023-03-26 12:49:05', NULL, NULL, 'egov', 'web', NULL, NULL, 0, 0, 'midtrans', NULL, '5bba29f2-0d62-4296-9894-d6d0d2dbacef'),
(4, 1, 0, 'INV/UMKM/1/260323/011131', 80, 'hypermartkarawaci', 900, 100, 0, 10000, 0.10, 10900, 1, 'CTC', NULL, 'JNE City Courier', '2023-03-26 13:11:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'web', NULL, NULL, 0, 0, 'midtrans', NULL, 'e0619188-b1e0-41f8-8c23-017c8513b2cf'),
(5, 1, 2, 'INV/UMKM/1/260323/020835', 80, 'hypermartkarawaci', 240000, 60000, 0, 10000, 0.30, 250000, 1, 'CTC', NULL, 'JNE City Courier', '2023-03-26 14:08:35', '2023-03-26 14:13:43', NULL, '2023-03-26 14:10:09', '2023-03-26 14:13:43', NULL, NULL, NULL, 'egov', 'web', NULL, NULL, 0, 0, 'midtrans', NULL, 'a8f96fc3-ebd8-4e38-ac17-3cd4fa508182'),
(6, 1, 2, 'INV/UMKM/1/260323/021707', 81, '1781661229', 510000, 90000, 0, 10000, 0.80, 520000, 1, 'CTC', NULL, 'JNE City Courier', '2023-03-26 14:17:07', '2023-03-26 14:18:57', NULL, '2023-03-26 14:17:52', '2023-03-26 14:18:57', NULL, NULL, NULL, 'egov', 'web', NULL, NULL, 0, 0, 'midtrans', NULL, '87b52e30-0f91-4cd8-a787-4bccdca6d01f');

-- --------------------------------------------------------

--
-- Table structure for table `m_transaksi_detail`
--

CREATE TABLE `m_transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `berat` float(5,2) DEFAULT NULL COMMENT 'berat barang satuan (kg)',
  `harga` int(11) DEFAULT NULL COMMENT 'harga barang satuan sesudah dipotong diskon',
  `harga_normal` int(11) DEFAULT NULL COMMENT 'harga yg belum dipotong diskon',
  `diskon` float(5,0) DEFAULT NULL COMMENT 'persen diskon',
  `nominal_diskon` int(11) DEFAULT NULL COMMENT 'nominal diskon',
  `jumlah_nominal_diskon` int(11) DEFAULT NULL COMMENT 'nominal_diskon * qty',
  `jumlah_berat` float(5,2) DEFAULT NULL COMMENT 'berat * qty',
  `jumlah_harga_normal` int(11) DEFAULT NULL COMMENT 'harga_normal * qty',
  `jumlah_harga` int(11) DEFAULT NULL COMMENT 'harga *qty',
  `catatan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_transaksi_detail`
--

INSERT INTO `m_transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `id_produk`, `quantity`, `berat`, `harga`, `harga_normal`, `diskon`, `nominal_diskon`, `jumlah_nominal_diskon`, `jumlah_berat`, `jumlah_harga_normal`, `jumlah_harga`, `catatan`, `created_at`, `updated_at`, `size`) VALUES
(1, 1, 253, 1, 0.10, 900, 1000, 10, 100, 100, 0.10, 1000, 900, '-', '2023-03-26 12:29:26', NULL, 'XL'),
(2, 2, 253, 1, 0.10, 900, 1000, 10, 100, 100, 0.10, 1000, 900, '-', '2023-03-26 13:01:51', NULL, 'XL'),
(3, 3, 253, 1, 0.10, 900, 1000, 10, 100, 100, 0.10, 1000, 900, '-', '2023-03-26 13:05:57', NULL, 'XL'),
(4, 4, 253, 1, 0.10, 900, 1000, 10, 100, 100, 0.10, 1000, 900, '-', '2023-03-26 13:11:31', NULL, 'XL'),
(5, 5, 1, 1, 0.30, 240000, 300000, 20, 60000, 60000, 0.30, 300000, 240000, '-', '2023-03-26 14:08:35', NULL, 'XL'),
(6, 6, 2, 2, 0.40, 255000, 300000, 15, 45000, 90000, 0.80, 600000, 510000, '-', '2023-03-26 14:17:07', NULL, '30ml');

-- --------------------------------------------------------

--
-- Table structure for table `m_ulasan`
--

CREATE TABLE `m_ulasan` (
  `id_ulasan` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_transaksi_detail` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `id_umkm` int(11) DEFAULT NULL,
  `username_toko` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `ratting` tinyint(1) DEFAULT NULL,
  `ratting_toko` tinyint(1) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_anonim` tinyint(1) DEFAULT 0 COMMENT 'tampil nama anonim, 1 anonim 0 tampil nama semua',
  `media` text DEFAULT NULL COMMENT 'json array'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_ulasan`
--

INSERT INTO `m_ulasan` (`id_ulasan`, `id_transaksi`, `id_transaksi_detail`, `id_produk`, `id_umkm`, `username_toko`, `username`, `ratting`, `ratting_toko`, `deskripsi`, `created_at`, `is_anonim`, `media`) VALUES
(1, 51, 52, 243, 16514, '3671092303850004', '3671110702970001', 5, 5, 'MAKNYOSSSSS ', '2022-06-02 08:49:08', 1, NULL),
(2, 52, 53, 245, 16564, '3671092303850004', '3671110702970001', 5, 5, 'Barang nya bagus ', '2022-06-03 15:22:08', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_umkm`
--

CREATE TABLE `m_umkm` (
  `id_umkm` int(11) NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `nama_perusahaan` varchar(100) DEFAULT NULL,
  `namausaha` varchar(100) DEFAULT NULL,
  `no_surat` varchar(100) DEFAULT NULL,
  `id_jenis_usaha` int(11) DEFAULT NULL,
  `id_bentuk_usaha` int(11) DEFAULT NULL,
  `id_sarana_usaha` int(11) DEFAULT NULL,
  `id_sektor_usaha` varchar(255) DEFAULT NULL,
  `nama_sarana_usaha_lainnya` varchar(255) DEFAULT NULL,
  `id_status_tempat_usaha` int(11) DEFAULT NULL,
  `nama_status_tempat_lainnya` varchar(255) DEFAULT NULL,
  `tgl_usaha` date DEFAULT NULL,
  `kegiatan_usaha_utama` varchar(255) DEFAULT NULL,
  `jml_pegawai` int(11) DEFAULT NULL,
  `pegawai_laki` int(11) DEFAULT NULL,
  `pegawai_perempuan` int(11) DEFAULT NULL,
  `id_skala_usaha` int(11) DEFAULT NULL,
  `jml_omset_sebelumnya` int(11) DEFAULT NULL,
  `jml_omset_sekarang` int(11) DEFAULT NULL,
  `jml_modal_awal` int(11) DEFAULT NULL,
  `id_modal_luar` int(11) DEFAULT NULL,
  `nominal_modal_luar` int(11) DEFAULT NULL,
  `jml_asset` varchar(50) DEFAULT NULL,
  `npwp` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_status` int(11) DEFAULT NULL,
  `id_verifikator` int(11) DEFAULT NULL,
  `alasan` varchar(100) DEFAULT NULL,
  `ratting` float(1,0) DEFAULT 0,
  `memiliki_surat_iumkm` int(11) DEFAULT 1,
  `kode_verifikasi` varchar(10) DEFAULT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `tahun_data` int(11) DEFAULT NULL,
  `situs_web` text DEFAULT NULL COMMENT 'json array link toko online umkm',
  `sosmed` text DEFAULT NULL COMMENT 'json array link sosmed umkm',
  `ojol` text DEFAULT NULL COMMENT 'json array link ojol umkm',
  `no_rumah` varchar(50) DEFAULT NULL,
  `no_kantor` varchar(50) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `id_bahan_bakar` int(11) DEFAULT NULL,
  `id_lainnya` int(11) DEFAULT NULL,
  `id_data` int(11) DEFAULT NULL,
  `sumber` enum('sidata','tangerangbisa','bpum','apl_kasir','apl_barong_say') DEFAULT NULL,
  `no_rekening` varchar(20) DEFAULT NULL,
  `an_rekening` varchar(255) DEFAULT NULL,
  `id_bank` int(11) DEFAULT NULL,
  `nama_bank` varchar(255) DEFAULT NULL,
  `kode_bank` int(11) DEFAULT NULL,
  `id_kurir` varchar(100) DEFAULT NULL COMMENT 'array json',
  `cara_pembayaran` varchar(50) DEFAULT NULL,
  `is_punya_qris` tinyint(1) DEFAULT 0,
  `asset_qris` varchar(255) DEFAULT NULL COMMENT 'asset qris statis',
  `email_qris` varchar(255) DEFAULT NULL COMMENT 'email untuk qris statis',
  `hp_qris` varchar(15) DEFAULT NULL COMMENT 'nomor hp untuk qris dinamis',
  `is_delete` tinyint(1) DEFAULT 0,
  `merchantMsisdn` varchar(20) DEFAULT NULL,
  `merchantName` varchar(200) DEFAULT NULL,
  `merchantMpan` varchar(200) DEFAULT NULL,
  `jumlah_meja` int(11) DEFAULT 0 COMMENT 'hanya untuk toko kategori kuliner',
  `include_pajak` tinyint(1) DEFAULT 1,
  `biaya_layanan` int(11) DEFAULT 0 COMMENT 'hanya untuk toko kuliner, max 10%, tidak wajib',
  `is_punya_qris_statis` tinyint(1) DEFAULT NULL,
  `asset_qris_statis` varchar(255) DEFAULT NULL,
  `email_qris_statis` varchar(255) DEFAULT NULL,
  `hp_qris_statis` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_umkm`
--

INSERT INTO `m_umkm` (`id_umkm`, `id_pengguna`, `username`, `nama_perusahaan`, `namausaha`, `no_surat`, `id_jenis_usaha`, `id_bentuk_usaha`, `id_sarana_usaha`, `id_sektor_usaha`, `nama_sarana_usaha_lainnya`, `id_status_tempat_usaha`, `nama_status_tempat_lainnya`, `tgl_usaha`, `kegiatan_usaha_utama`, `jml_pegawai`, `pegawai_laki`, `pegawai_perempuan`, `id_skala_usaha`, `jml_omset_sebelumnya`, `jml_omset_sekarang`, `jml_modal_awal`, `id_modal_luar`, `nominal_modal_luar`, `jml_asset`, `npwp`, `created_at`, `updated_at`, `id_status`, `id_verifikator`, `alasan`, `ratting`, `memiliki_surat_iumkm`, `kode_verifikasi`, `kode`, `tahun_data`, `situs_web`, `sosmed`, `ojol`, `no_rumah`, `no_kantor`, `no_hp`, `fax`, `email`, `id_bahan_bakar`, `id_lainnya`, `id_data`, `sumber`, `no_rekening`, `an_rekening`, `id_bank`, `nama_bank`, `kode_bank`, `id_kurir`, `cara_pembayaran`, `is_punya_qris`, `asset_qris`, `email_qris`, `hp_qris`, `is_delete`, `merchantMsisdn`, `merchantName`, `merchantMpan`, `jumlah_meja`, `include_pajak`, `biaya_layanan`, `is_punya_qris_statis`, `asset_qris_statis`, `email_qris_statis`, `hp_qris_statis`) VALUES
(1, 1, 'admin', '', 'Yazer Indonesia', '1235567890', 1, 1, 1, 'a:1:{i:0;s:1:\"9\";}', NULL, 1, NULL, '2020-03-03', 'usaha kelontong', 2, 0, 0, 1, 0, 2000000, 2000000, 0, 0, '2000000', '54.545.434.3-484.646', '2020-03-03 07:34:32', '2021-01-27 16:09:38', 1, 1, 'UMKM disetting sesuai ketentuan', 0, 1, 'aec6', '73725898ebebe869924436b56ca487bc62a8de4f', 2021, NULL, NULL, NULL, '', '', '0832423', NULL, 'budi91115@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[\"1\",\"2\",\"3\",\"5\"]', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_umkm_alamat`
--

CREATE TABLE `m_umkm_alamat` (
  `id_umkm_alamat` int(11) NOT NULL,
  `id_umkm` int(11) DEFAULT NULL,
  `id_kec` int(11) DEFAULT NULL,
  `nama_kec` varchar(100) DEFAULT NULL,
  `id_kel` int(11) DEFAULT NULL,
  `nama_kel` varchar(100) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `long` double DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_prop` int(11) DEFAULT 36,
  `no_kab` int(11) DEFAULT 71,
  `tmpt_tinggal` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_umkm_alamat`
--

INSERT INTO `m_umkm_alamat` (`id_umkm_alamat`, `id_umkm`, `id_kec`, `nama_kec`, `id_kel`, `nama_kel`, `lat`, `long`, `kode_pos`, `alamat`, `no_prop`, `no_kab`, `tmpt_tinggal`) VALUES
(16398, 1, 7, 'Karawaci', 1016, 'Koang Jaya', -6.158845011248603, 106.62096394750972, ' 15112', 'Jalan Raya Sangego, Koang Jaya, Kecamatan Karawaci', 36, 71, 0),
(16402, NULL, 5, 'Cipondoh', 1005, 'Kenanga', -6.193484676689566, 106.69100044820223, ' 15146', 'Puri Semanan 1, Kenanga, Kecamatan Cipondoh', 36, 71, 0);

-- --------------------------------------------------------

--
-- Table structure for table `m_umkm_berkas`
--

CREATE TABLE `m_umkm_berkas` (
  `id_umkm_berkas` int(11) NOT NULL,
  `id_umkm` int(11) DEFAULT NULL,
  `logo_umkm` varchar(255) DEFAULT NULL,
  `surat_iumkm` varchar(255) DEFAULT NULL,
  `foto_npwp` varchar(255) DEFAULT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL,
  `foto_kk` varchar(255) DEFAULT NULL,
  `foto_pas` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `m_umkm_izin_usaha`
--

CREATE TABLE `m_umkm_izin_usaha` (
  `id_izin_usaha` int(11) NOT NULL,
  `id_umkm` int(11) DEFAULT NULL,
  `nama_izin_usaha` varchar(100) DEFAULT NULL,
  `nama_izin_lainnya` varchar(100) DEFAULT NULL,
  `nomor_izin_usaha` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `m_unit`
--

CREATE TABLE `m_unit` (
  `id_unit` int(11) NOT NULL,
  `unit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_unit`
--

INSERT INTO `m_unit` (`id_unit`, `unit`) VALUES
(1, 'Kg'),
(2, 'Pcs'),
(3, 'Liter'),
(4, 'Ekor'),
(5, 'Bks'),
(6, 'Pak'),
(7, 'Butir'),
(8, 'Kaleng'),
(9, 'Buah'),
(10, 'Ikat'),
(11, 'Papan'),
(12, 'Tabung');

-- --------------------------------------------------------

--
-- Table structure for table `m_visitor_anon`
--

CREATE TABLE `m_visitor_anon` (
  `id_anon` int(11) NOT NULL,
  `visitor_id` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_visitor_anon`
--

INSERT INTO `m_visitor_anon` (`id_anon`, `visitor_id`, `nama`, `email`, `no_telp`) VALUES
(1, '1501298859', 'dasdasd', 'robbyimam@gmail.com', '089823891823'),
(2, '1781661229', 'dasdasd', 'dasd@gmail.com', '0893182938123');

-- --------------------------------------------------------

--
-- Table structure for table `m_wishlist`
--

CREATE TABLE `m_wishlist` (
  `id_wishlist` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'like' COMMENT 'like,unlike',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_wishlist`
--

INSERT INTO `m_wishlist` (`id_wishlist`, `id_produk`, `username`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '1781661229', 'like', '2023-03-26 20:18:39', NULL),
(2, 1, '1781661229', 'like', '2023-03-26 20:28:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_va`
--

CREATE TABLE `pembayaran_va` (
  `id` int(11) NOT NULL,
  `id_pembayaran` varchar(100) DEFAULT NULL,
  `nik_user` varchar(20) DEFAULT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `email_user` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `jenis_pembayaran` enum('BARONGSAY') DEFAULT NULL,
  `no_virtual_acount` varchar(15) DEFAULT NULL,
  `va_full` varchar(24) DEFAULT NULL,
  `urut_va` int(11) DEFAULT NULL,
  `expired_virtual_account` datetime DEFAULT NULL,
  `status_pembayaran` enum('Lunas','Belum Lunas') DEFAULT NULL,
  `is_bayar` enum('1','0') DEFAULT NULL,
  `jumlah_yg_dibayar` double DEFAULT NULL,
  `tgl_pembayaran` datetime DEFAULT NULL,
  `va_dari` enum('barongsay_android','barongsay_web') DEFAULT NULL,
  `va_ke` varchar(100) DEFAULT NULL,
  `bjb_response` text DEFAULT NULL,
  `bjb_token` varchar(255) DEFAULT NULL,
  `bjb_inquiry` text DEFAULT NULL,
  `bjb_inquiry_response_code` varchar(10) DEFAULT NULL,
  `bjb_callback` text DEFAULT NULL,
  `execution_time` varchar(255) DEFAULT NULL,
  `telp_user` varchar(20) DEFAULT NULL,
  `client_refnum` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `t_bsmpum`
--

CREATE TABLE `t_bsmpum` (
  `id_bsmpum` int(11) NOT NULL,
  `id_umkm` int(11) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `no_kk` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_tlp` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `id_provinsi` int(11) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `id_kabupaten` int(11) DEFAULT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `id_kelurahan` int(11) DEFAULT NULL,
  `kelurahan` varchar(255) DEFAULT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `rt` varchar(4) DEFAULT NULL,
  `rw` varchar(4) DEFAULT NULL,
  `alamat_usaha` varchar(255) DEFAULT NULL,
  `id_provinsi_usaha` int(11) DEFAULT NULL,
  `provinsi_usaha` varchar(255) DEFAULT NULL,
  `id_kabupaten_usaha` int(11) DEFAULT NULL,
  `kabupaten_usaha` varchar(255) DEFAULT NULL,
  `id_kecamatan_usaha` int(11) DEFAULT NULL,
  `kecamatan_usaha` varchar(255) DEFAULT NULL,
  `id_kelurahan_usaha` int(11) DEFAULT NULL,
  `kelurahan_usaha` varchar(255) DEFAULT NULL,
  `rt_usaha` varchar(4) DEFAULT NULL,
  `rw_usaha` varchar(4) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `bidang_usaha` varchar(255) DEFAULT NULL,
  `bidang_usaha_lainnya` varchar(255) DEFAULT NULL,
  `jenis_usaha` varchar(255) DEFAULT NULL,
  `lama_usaha` varchar(255) DEFAULT NULL,
  `foto_ktp` text DEFAULT NULL,
  `foto_kk` text DEFAULT NULL,
  `foto_super` text DEFAULT NULL,
  `foto_usaha` text DEFAULT NULL,
  `status_ktp` enum('dalam','luar') DEFAULT NULL,
  `statusdidata` enum('0','1','2','3','4') DEFAULT '0',
  `keterangan_ditolak` text DEFAULT NULL,
  `source` enum('sabakota','tlive','sistem') DEFAULT NULL,
  `is_claim` enum('0','1') DEFAULT '0',
  `status_lpj` enum('0','1') DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `edited_at` datetime DEFAULT NULL,
  `edited_by` varchar(255) DEFAULT NULL,
  `verif_at` datetime DEFAULT NULL,
  `verif_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `t_data_tampungan_bsmpum_flag`
--

CREATE TABLE `t_data_tampungan_bsmpum_flag` (
  `id_umkm` int(11) NOT NULL,
  `nama_usaha` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `nama_pemilik` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `no_rt` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `no_rw` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kecamatan` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kelurahan` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  `id_kelurahan` int(11) DEFAULT NULL,
  `kota` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `omset` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `assets` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `modal_sendiri` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created_at` varchar(100) DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `edited_at` varchar(100) DEFAULT NULL,
  `edited_by` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `provinsitematik` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kotatematik` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kecamataaantematik` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kelurahaantematik` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `lokasikampungtematik` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `tempatlahir` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `domisiliktp` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `tanggallahir` date DEFAULT NULL,
  `jeniskelamin` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `namaibukandung` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `namaizinusaha` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `keteranganizinusaha` varchar(255) DEFAULT NULL,
  `nosuratizinusaha` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `npwp` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `tanggalmulai` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `provinsiworkshop` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kotaworkshop` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kecamatanworkshop` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kelurahanworkshop` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kodeposworkshop` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `rtworkshop` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `rwworkshop` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kodepos` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `telpon` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `fax` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `website` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `bentukusaha` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `jenisusaha` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kegiatanutama` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `produkutama` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `tahundata` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `totalkariawanlakilaki` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `totaltenagakerjalakilaki` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `omzetawal` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `asset` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `modalluar` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `totalmodalluar` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `jenistempatusaha` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `saranausaha` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `statussarana` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `bahanbakar` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `negaraexpor` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `volumeexpor` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `nominalexpor` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `totaltenagakerjaperempuan` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `totalkariawanperempuan` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `namafilektp` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `cek_bansos` varchar(255) DEFAULT NULL,
  `cek_hasil_verifikasi` varchar(255) DEFAULT NULL,
  `statusdidata` varchar(1) DEFAULT '0',
  `alamatworkshop` varchar(100) DEFAULT NULL,
  `alamatsosialmedia` varchar(255) DEFAULT NULL,
  `profesi_pemilik` varchar(100) DEFAULT NULL,
  `tempat_pemasaran` varchar(100) DEFAULT NULL,
  `pemasaran_online` varchar(100) DEFAULT NULL,
  `json_kontak` text DEFAULT NULL,
  `id_data` int(11) DEFAULT NULL,
  `sertifikat_pkp` varchar(255) DEFAULT NULL,
  `keteranganjenistempat` varchar(255) DEFAULT NULL,
  `keteranganstatususaha` varchar(255) DEFAULT NULL,
  `keteranganstatussarana` varchar(255) DEFAULT NULL,
  `tambahan` int(11) DEFAULT NULL,
  `kelurahan_siak` varchar(255) DEFAULT NULL,
  `no_kel_siak` varchar(255) DEFAULT NULL,
  `kecamatan_siak` varchar(255) DEFAULT NULL,
  `no_kec_siak` varchar(255) DEFAULT NULL,
  `alamat_siak` varchar(255) DEFAULT NULL,
  `alamat_usaha` varchar(255) DEFAULT NULL,
  `bidang_usaha` varchar(255) DEFAULT NULL,
  `kategori_usaha` varchar(255) DEFAULT NULL,
  `rt_usaha` varchar(255) DEFAULT NULL,
  `rw_usaha` varchar(255) DEFAULT NULL,
  `bidang_usaha_lainnya` varchar(255) DEFAULT NULL,
  `id_kecamatan_workshop` int(11) DEFAULT NULL,
  `id_kelurahan_workshop` int(11) DEFAULT NULL,
  `json_foto` text DEFAULT NULL,
  `keterangan_ditolak` varchar(255) DEFAULT NULL,
  `umur` varchar(255) DEFAULT NULL,
  `no_kk` varchar(255) DEFAULT NULL,
  `cek_double` varchar(255) DEFAULT NULL,
  `kementrian` enum('ya','tidak') DEFAULT 'tidak',
  `tahap` int(11) DEFAULT NULL,
  `nama_kab` varchar(255) DEFAULT NULL,
  `id_kab` int(11) DEFAULT NULL,
  `nama_prop` varchar(255) DEFAULT NULL,
  `id_prop` int(11) DEFAULT NULL,
  `status_ktp` enum('dalam','luar') DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `akun_sabakota` enum('sudah','belum') DEFAULT 'belum',
  `is_claim` int(11) DEFAULT 0,
  `id_kab_workshop` int(11) DEFAULT NULL,
  `id_prop_workshop` int(11) DEFAULT NULL,
  `status_ditemukan` enum('ditemukan','tidak ditemukan') DEFAULT NULL,
  `status_sesuai` enum('sesuai','tidak sesuai') DEFAULT NULL,
  `keterangan_tidak_ditemukan` text DEFAULT NULL,
  `keterangan_tidak_sesuai` text DEFAULT NULL,
  `foto_ditemukan` text DEFAULT NULL,
  `lama_usaha` text DEFAULT NULL,
  `survey_by` text DEFAULT NULL,
  `survey_at` datetime DEFAULT NULL,
  `manual_indag` enum('tidak','ya') DEFAULT 'tidak',
  `distribusi` int(11) DEFAULT 0 COMMENT '0 = belum, 1 = sudah',
  `cek_nama` int(11) DEFAULT NULL COMMENT '0 = beda, 1 = sama',
  `tahap_2` varchar(255) DEFAULT NULL,
  `tangerang_bisa` varchar(255) DEFAULT NULL,
  `kementrian_1` varchar(255) DEFAULT NULL,
  `kementrian_2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `t_data_umkm`
--

CREATE TABLE `t_data_umkm` (
  `id_umkm` int(11) NOT NULL,
  `nama_usaha` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `nama_pemilik` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `no_rt` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `no_rw` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kecamatan` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kelurahan` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  `id_kelurahan` int(11) DEFAULT NULL,
  `kota` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `omset` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `assets` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `modal_sendiri` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created_at` varchar(100) DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `edited_at` varchar(100) DEFAULT NULL,
  `edited_by` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `provinsitematik` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kotatematik` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kecamataaantematik` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kelurahaantematik` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `lokasikampungtematik` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `tempatlahir` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `domisiliktp` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `tanggallahir` date DEFAULT NULL,
  `jeniskelamin` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `namaibukandung` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `namaizinusaha` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `keteranganizinusaha` varchar(255) DEFAULT NULL,
  `nosuratizinusaha` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `npwp` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `tanggalmulai` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `provinsiworkshop` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kotaworkshop` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kecamatanworkshop` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kelurahanworkshop` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kodeposworkshop` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `rtworkshop` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `rwworkshop` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kodepos` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `telpon` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `fax` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `website` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `bentukusaha` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `jenisusaha` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kegiatanutama` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `produkutama` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `tahundata` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `totalkariawanlakilaki` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `totaltenagakerjalakilaki` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `omzetawal` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `asset` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `modalluar` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `totalmodalluar` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `jenistempatusaha` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `saranausaha` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `statussarana` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `bahanbakar` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `negaraexpor` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `volumeexpor` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `nominalexpor` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `totaltenagakerjaperempuan` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `totalkariawanperempuan` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `namafilektp` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `cek_bansos` varchar(255) DEFAULT NULL,
  `cek_hasil_verifikasi` varchar(255) DEFAULT NULL,
  `statusdidata` varchar(1) DEFAULT '0',
  `alamatworkshop` varchar(100) DEFAULT NULL,
  `alamatsosialmedia` varchar(255) DEFAULT NULL,
  `profesi_pemilik` varchar(100) DEFAULT NULL,
  `tempat_pemasaran` varchar(100) DEFAULT NULL,
  `pemasaran_online` varchar(100) DEFAULT NULL,
  `json_kontak` text DEFAULT NULL,
  `id_data` int(11) DEFAULT NULL,
  `sertifikat_pkp` varchar(255) DEFAULT NULL,
  `keteranganjenistempat` varchar(255) DEFAULT NULL,
  `keteranganstatususaha` varchar(255) DEFAULT NULL,
  `keteranganstatussarana` varchar(255) DEFAULT NULL,
  `tambahan` int(11) DEFAULT NULL,
  `kelurahan_siak` varchar(255) DEFAULT NULL,
  `no_kel_siak` varchar(255) DEFAULT NULL,
  `kecamatan_siak` varchar(255) DEFAULT NULL,
  `no_kec_siak` varchar(255) DEFAULT NULL,
  `alamat_siak` varchar(255) DEFAULT NULL,
  `alamat_usaha` varchar(255) DEFAULT NULL,
  `bidang_usaha` varchar(255) DEFAULT NULL,
  `kategori_usaha` varchar(255) DEFAULT NULL,
  `rt_usaha` varchar(255) DEFAULT NULL,
  `rw_usaha` varchar(255) DEFAULT NULL,
  `bidang_usaha_lainnya` varchar(255) DEFAULT NULL,
  `id_kecamatan_workshop` int(11) DEFAULT NULL,
  `id_kelurahan_workshop` int(11) DEFAULT NULL,
  `json_foto` text DEFAULT NULL,
  `keterangan_ditolak` varchar(255) DEFAULT NULL,
  `umur` varchar(255) DEFAULT NULL,
  `no_kk` varchar(255) DEFAULT NULL,
  `cek_double` varchar(255) DEFAULT NULL,
  `kementrian` enum('ya','tidak') DEFAULT 'tidak',
  `tahap` int(11) DEFAULT NULL,
  `nama_kab` varchar(255) DEFAULT NULL,
  `id_kab` int(11) DEFAULT NULL,
  `nama_prop` varchar(255) DEFAULT NULL,
  `id_prop` int(11) DEFAULT NULL,
  `status_ktp` enum('dalam','luar') DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `akun_sabakota` enum('sudah','belum') DEFAULT 'belum',
  `is_claim` int(11) DEFAULT 0,
  `id_kab_workshop` int(11) DEFAULT NULL,
  `id_prop_workshop` int(11) DEFAULT NULL,
  `status_ditemukan` enum('ditemukan','tidak ditemukan') DEFAULT NULL,
  `status_sesuai` enum('sesuai','tidak sesuai') DEFAULT NULL,
  `keterangan_tidak_ditemukan` text DEFAULT NULL,
  `keterangan_tidak_sesuai` text DEFAULT NULL,
  `foto_ditemukan` text DEFAULT NULL,
  `lama_usaha` text DEFAULT NULL,
  `survey_by` text DEFAULT NULL,
  `survey_at` datetime DEFAULT NULL,
  `manual_indag` enum('tidak','ya') DEFAULT 'tidak',
  `distribusi` int(11) DEFAULT 0 COMMENT '0 = belum, 1 = sudah',
  `cek_nama` int(11) DEFAULT NULL COMMENT '0 = beda, 1 = sama',
  `akun_tlive` varchar(255) DEFAULT NULL,
  `cek_sk_bpum` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app`
--
ALTER TABLE `app`
  ADD PRIMARY KEY (`id_app`) USING BTREE;

--
-- Indexes for table `log_eror_callback_va`
--
ALTER TABLE `log_eror_callback_va`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `master_kab`
--
ALTER TABLE `master_kab`
  ADD KEY `NO_KAB` (`NO_KAB`) USING BTREE,
  ADD KEY `NO_PROP` (`NO_PROP`) USING BTREE,
  ADD KEY `ID_KAB` (`ID_KAB`) USING BTREE,
  ADD KEY `ID_CITY_ONGKIR` (`ID_CITY_ONGKIR`) USING BTREE;

--
-- Indexes for table `modalusaha`
--
ALTER TABLE `modalusaha`
  ADD PRIMARY KEY (`id_modalusaha`) USING BTREE,
  ADD KEY `nik` (`nik`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE,
  ADD KEY `no_kk` (`no_kk`) USING BTREE;

--
-- Indexes for table `m_agenda`
--
ALTER TABLE `m_agenda`
  ADD PRIMARY KEY (`id_agenda`) USING BTREE,
  ADD KEY `id_agenda` (`id_agenda`) USING BTREE,
  ADD KEY `kode_agenda` (`kode_agenda`) USING BTREE,
  ADD KEY `judul` (`judul`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE;

--
-- Indexes for table `m_alamat`
--
ALTER TABLE `m_alamat`
  ADD PRIMARY KEY (`id_alamat`) USING BTREE,
  ADD KEY `id_alamat` (`id_alamat`) USING BTREE,
  ADD KEY `id_pengguna` (`id_pengguna`) USING BTREE,
  ADD KEY `username` (`username`) USING BTREE,
  ADD KEY `utama` (`utama`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE;

--
-- Indexes for table `m_bahan_bakar`
--
ALTER TABLE `m_bahan_bakar`
  ADD PRIMARY KEY (`id_bahan_bakar`) USING BTREE,
  ADD KEY `id_bahan_bakar` (`id_bahan_bakar`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE;

--
-- Indexes for table `m_banner`
--
ALTER TABLE `m_banner`
  ADD PRIMARY KEY (`id_banner`) USING BTREE,
  ADD KEY `id_banner` (`id_banner`) USING BTREE;

--
-- Indexes for table `m_banner_produk`
--
ALTER TABLE `m_banner_produk`
  ADD PRIMARY KEY (`id_banner_produk`) USING BTREE,
  ADD KEY `id_banner_produk` (`id_banner_produk`) USING BTREE;

--
-- Indexes for table `m_bentuk_usaha`
--
ALTER TABLE `m_bentuk_usaha`
  ADD PRIMARY KEY (`id_bentuk_usaha`) USING BTREE,
  ADD KEY `id_bentuk_usaha` (`id_bentuk_usaha`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE;

--
-- Indexes for table `m_berita`
--
ALTER TABLE `m_berita`
  ADD PRIMARY KEY (`id_berita`) USING BTREE,
  ADD KEY `id_berita` (`id_berita`) USING BTREE,
  ADD KEY `kode_berita` (`kode_berita`) USING BTREE,
  ADD KEY `id_pengguna` (`id_pengguna`) USING BTREE,
  ADD KEY `username` (`username`) USING BTREE,
  ADD KEY `judul` (`judul`) USING BTREE,
  ADD KEY `status_berita` (`status_berita`) USING BTREE,
  ADD KEY `dilihat` (`dilihat`) USING BTREE;

--
-- Indexes for table `m_dasar_hukum`
--
ALTER TABLE `m_dasar_hukum`
  ADD PRIMARY KEY (`id_dasar_hukum`) USING BTREE,
  ADD KEY `id_dasar_hukum` (`id_dasar_hukum`) USING BTREE,
  ADD KEY `kode_dasar_hukum` (`kode_dasar_hukum`) USING BTREE,
  ADD KEY `judul` (`judul`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE;

--
-- Indexes for table `m_data_vaksin`
--
ALTER TABLE `m_data_vaksin`
  ADD PRIMARY KEY (`id_vaksin`) USING BTREE,
  ADD KEY `m_data_vaksin_kec_siak_IDX` (`kec_siak`,`kel_siak`,`rw_siak`,`rt_siak`) USING BTREE,
  ADD KEY `id_vaksin` (`id_vaksin`) USING BTREE,
  ADD KEY `nik` (`nik`) USING BTREE,
  ADD KEY `vaksinasi` (`vaksinasi`) USING BTREE,
  ADD KEY `tanggal` (`tanggal`) USING BTREE,
  ADD KEY `kode_kategori` (`kode_kategori`) USING BTREE,
  ADD KEY `kategori` (`kategori`) USING BTREE,
  ADD KEY `jns_pkrjn` (`jns_pkrjn`) USING BTREE,
  ADD KEY `m_data_vaksin_jenis_vaksin_IDX` (`jenis_vaksin`) USING BTREE,
  ADD KEY `sumber_data` (`sumber_data`) USING BTREE,
  ADD KEY `flag_status` (`flag_status`) USING BTREE,
  ADD KEY `nama` (`nama`) USING BTREE,
  ADD KEY `tgl_lahir` (`tgl_lahir`) USING BTREE,
  ADD KEY `m_data_vaksin_tgl_lahir_IDX` (`tgl_lahir`) USING BTREE;

--
-- Indexes for table `m_diskusi`
--
ALTER TABLE `m_diskusi`
  ADD PRIMARY KEY (`id_diskusi`) USING BTREE,
  ADD KEY `id_diskusi` (`id_diskusi`) USING BTREE,
  ADD KEY `id_produk` (`id_produk`) USING BTREE,
  ADD KEY `username` (`username`) USING BTREE;

--
-- Indexes for table `m_diskusi_balasan`
--
ALTER TABLE `m_diskusi_balasan`
  ADD PRIMARY KEY (`id_diskusi_balasan`) USING BTREE,
  ADD KEY `id_diskusi_balasan` (`id_diskusi_balasan`) USING BTREE,
  ADD KEY `id_diskusi` (`id_diskusi`) USING BTREE,
  ADD KEY `username` (`username`) USING BTREE;

--
-- Indexes for table `m_group`
--
ALTER TABLE `m_group`
  ADD PRIMARY KEY (`id_group`) USING BTREE,
  ADD KEY `id_group` (`id_group`) USING BTREE;

--
-- Indexes for table `m_history`
--
ALTER TABLE `m_history`
  ADD PRIMARY KEY (`id_history`) USING BTREE,
  ADD KEY `id_history` (`id_history`) USING BTREE,
  ADD KEY `id_produk` (`id_produk`) USING BTREE,
  ADD KEY `username` (`username`) USING BTREE;

--
-- Indexes for table `m_jenis_usaha`
--
ALTER TABLE `m_jenis_usaha`
  ADD PRIMARY KEY (`id_jenis_usaha`) USING BTREE,
  ADD KEY `id_jenis_usaha` (`id_jenis_usaha`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE;

--
-- Indexes for table `m_kecamatan`
--
ALTER TABLE `m_kecamatan`
  ADD PRIMARY KEY (`no_kec`) USING BTREE,
  ADD KEY `no_kec` (`no_kec`) USING BTREE,
  ADD KEY `no_kab` (`no_kab`) USING BTREE,
  ADD KEY `no_prop` (`no_prop`) USING BTREE;

--
-- Indexes for table `m_kelurahan`
--
ALTER TABLE `m_kelurahan`
  ADD PRIMARY KEY (`id_kel`) USING BTREE,
  ADD KEY `id_kel` (`id_kel`) USING BTREE,
  ADD KEY `no_kel` (`no_kel`) USING BTREE,
  ADD KEY `no_kec` (`no_kec`) USING BTREE,
  ADD KEY `no_kab` (`no_kab`) USING BTREE,
  ADD KEY `no_prop` (`no_prop`) USING BTREE;

--
-- Indexes for table `m_keranjang`
--
ALTER TABLE `m_keranjang`
  ADD PRIMARY KEY (`id_keranjang`) USING BTREE,
  ADD KEY `id_keranjang` (`id_keranjang`) USING BTREE,
  ADD KEY `id_produk` (`id_produk`) USING BTREE,
  ADD KEY `username` (`username`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE,
  ADD KEY `quantity` (`quantity`) USING BTREE;

--
-- Indexes for table `m_kode_pos`
--
ALTER TABLE `m_kode_pos`
  ADD PRIMARY KEY (`id_kode_pos`) USING BTREE,
  ADD KEY `id_kode_pos` (`id_kode_pos`) USING BTREE,
  ADD KEY `kode_pos` (`kode_pos`) USING BTREE,
  ADD KEY `kode_wilayah` (`kode_wilayah`) USING BTREE,
  ADD KEY `id_kecamatan` (`id_kecamatan`) USING BTREE,
  ADD KEY `id_kelurahan` (`id_kelurahan`) USING BTREE,
  ADD KEY `id_kabkota` (`id_kabkota`) USING BTREE,
  ADD KEY `id_provinsi` (`id_provinsi`) USING BTREE;

--
-- Indexes for table `m_kurir`
--
ALTER TABLE `m_kurir`
  ADD PRIMARY KEY (`id_kurir`) USING BTREE,
  ADD KEY `id_kurir` (`id_kurir`) USING BTREE,
  ADD KEY `kode_kurir` (`kode_kurir`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE;

--
-- Indexes for table `m_lainnya`
--
ALTER TABLE `m_lainnya`
  ADD PRIMARY KEY (`id_lainnya`) USING BTREE,
  ADD KEY `id_lainnya` (`id_lainnya`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE;

--
-- Indexes for table `m_modal_luar`
--
ALTER TABLE `m_modal_luar`
  ADD PRIMARY KEY (`id_modal_luar`) USING BTREE,
  ADD KEY `id_modal_luar` (`id_modal_luar`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE;

--
-- Indexes for table `m_notifikasi`
--
ALTER TABLE `m_notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`) USING BTREE,
  ADD KEY `id_kirim_notif` (`id_notifikasi`) USING BTREE,
  ADD KEY `username` (`username_penerima`) USING BTREE,
  ADD KEY `id_detail` (`id_detail`) USING BTREE,
  ADD KEY `status` (`is_read`) USING BTREE;

--
-- Indexes for table `m_pengguna`
--
ALTER TABLE `m_pengguna`
  ADD PRIMARY KEY (`id_pengguna`) USING BTREE,
  ADD KEY `id_pengguna` (`id_pengguna`) USING BTREE,
  ADD KEY `id_group` (`id_group`) USING BTREE,
  ADD KEY `username` (`username`) USING BTREE,
  ADD KEY `nama` (`nama`) USING BTREE,
  ADD KEY `email` (`email`) USING BTREE,
  ADD KEY `domisili` (`domisili`) USING BTREE,
  ADD KEY `no_kel` (`no_kel`) USING BTREE,
  ADD KEY `no_kec` (`no_kec`) USING BTREE,
  ADD KEY `no_kab` (`no_kab`) USING BTREE,
  ADD KEY `no_prop` (`no_prop`) USING BTREE;

--
-- Indexes for table `m_pesan`
--
ALTER TABLE `m_pesan`
  ADD PRIMARY KEY (`id_pesan`) USING BTREE,
  ADD KEY `id_pesan` (`id_pesan`) USING BTREE,
  ADD KEY `username_pengirim` (`username_pengirim`) USING BTREE,
  ADD KEY `username_penerima` (`username_penerima`) USING BTREE,
  ADD KEY `id_group` (`id_group`) USING BTREE,
  ADD KEY `id_umkm` (`id_umkm`) USING BTREE;

--
-- Indexes for table `m_pesan_detail`
--
ALTER TABLE `m_pesan_detail`
  ADD PRIMARY KEY (`id_pesan_detail`) USING BTREE,
  ADD KEY `id_pesan_detail` (`id_pesan_detail`) USING BTREE,
  ADD KEY `id_group` (`id_group`) USING BTREE,
  ADD KEY `id_produk` (`id_produk`) USING BTREE,
  ADD KEY `id_transaksi` (`id_transaksi`) USING BTREE,
  ADD KEY `username` (`username`) USING BTREE,
  ADD KEY `is_read` (`is_read`) USING BTREE;

--
-- Indexes for table `m_produk`
--
ALTER TABLE `m_produk`
  ADD PRIMARY KEY (`id_produk`) USING BTREE,
  ADD KEY `id_produk` (`id_produk`) USING BTREE,
  ADD KEY `id_umkm` (`id_umkm`) USING BTREE,
  ADD KEY `id_jenis_usaha` (`id_jenis_usaha`) USING BTREE,
  ADD KEY `kode_produk` (`kode_produk`) USING BTREE,
  ADD KEY `tags` (`tags`) USING BTREE,
  ADD KEY `nama_produk` (`nama_produk`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE;

--
-- Indexes for table `m_produk_foto`
--
ALTER TABLE `m_produk_foto`
  ADD PRIMARY KEY (`id_foto`) USING BTREE,
  ADD KEY `id_foto` (`id_foto`) USING BTREE,
  ADD KEY `id_produk` (`id_produk`) USING BTREE;

--
-- Indexes for table `m_produk_stok`
--
ALTER TABLE `m_produk_stok`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `m_sarana_usaha`
--
ALTER TABLE `m_sarana_usaha`
  ADD PRIMARY KEY (`id_sarana_usaha`) USING BTREE,
  ADD KEY `id_sarana_usaha` (`id_sarana_usaha`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE;

--
-- Indexes for table `m_sektor_usaha`
--
ALTER TABLE `m_sektor_usaha`
  ADD PRIMARY KEY (`id_sektor_usaha`) USING BTREE,
  ADD KEY `id_sektor_usaha` (`id_sektor_usaha`) USING BTREE,
  ADD KEY `id_jenis_usaha` (`id_jenis_usaha`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE;

--
-- Indexes for table `m_skala_usaha`
--
ALTER TABLE `m_skala_usaha`
  ADD PRIMARY KEY (`id_skala_usaha`) USING BTREE,
  ADD KEY `id_skala_usaha` (`id_skala_usaha`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE;

--
-- Indexes for table `m_slider`
--
ALTER TABLE `m_slider`
  ADD PRIMARY KEY (`id_slider`) USING BTREE,
  ADD KEY `id_slider` (`id_slider`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE;

--
-- Indexes for table `m_status`
--
ALTER TABLE `m_status`
  ADD PRIMARY KEY (`id_status`) USING BTREE,
  ADD KEY `id_status` (`id_status`) USING BTREE;

--
-- Indexes for table `m_status_tempat_usaha`
--
ALTER TABLE `m_status_tempat_usaha`
  ADD PRIMARY KEY (`id_status_tempat_usaha`) USING BTREE,
  ADD KEY `id_status_tempat_usaha` (`id_status_tempat_usaha`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE;

--
-- Indexes for table `m_status_transaksi`
--
ALTER TABLE `m_status_transaksi`
  ADD PRIMARY KEY (`id_status_transaksi`) USING BTREE,
  ADD KEY `id_status_transaksi` (`id_status_transaksi`) USING BTREE;

--
-- Indexes for table `m_transaksi`
--
ALTER TABLE `m_transaksi`
  ADD PRIMARY KEY (`id_transaksi`) USING BTREE,
  ADD KEY `id_transaksi` (`id_transaksi`) USING BTREE,
  ADD KEY `id_umkm` (`id_umkm`) USING BTREE,
  ADD KEY `id_status_transaksi` (`id_status_transaksi`) USING BTREE,
  ADD KEY `no_invoice` (`no_invoice`) USING BTREE,
  ADD KEY `id_alamat` (`id_alamat`) USING BTREE,
  ADD KEY `username` (`username`) USING BTREE,
  ADD KEY `id_kurir` (`id_kurir`) USING BTREE,
  ADD KEY `va` (`va`) USING BTREE,
  ADD KEY `va_full` (`va_full`) USING BTREE,
  ADD KEY `metode_bayar` (`metode_bayar`) USING BTREE;

--
-- Indexes for table `m_transaksi_detail`
--
ALTER TABLE `m_transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`) USING BTREE,
  ADD KEY `id_transaksi_detail` (`id_transaksi_detail`) USING BTREE,
  ADD KEY `id_transaksi` (`id_transaksi`) USING BTREE,
  ADD KEY `id_produk` (`id_produk`) USING BTREE;

--
-- Indexes for table `m_ulasan`
--
ALTER TABLE `m_ulasan`
  ADD PRIMARY KEY (`id_ulasan`) USING BTREE,
  ADD KEY `id_ulasan` (`id_ulasan`) USING BTREE,
  ADD KEY `id_transaksi` (`id_transaksi`) USING BTREE,
  ADD KEY `id_transaksi_detail` (`id_transaksi_detail`) USING BTREE,
  ADD KEY `id_produk` (`id_produk`) USING BTREE,
  ADD KEY `username_toko` (`username_toko`) USING BTREE,
  ADD KEY `username` (`username`) USING BTREE,
  ADD KEY `id_umkm` (`id_umkm`) USING BTREE;

--
-- Indexes for table `m_umkm`
--
ALTER TABLE `m_umkm`
  ADD PRIMARY KEY (`id_umkm`) USING BTREE,
  ADD KEY `id_umkm` (`id_umkm`) USING BTREE,
  ADD KEY `id_pengguna` (`id_pengguna`) USING BTREE,
  ADD KEY `username` (`username`) USING BTREE,
  ADD KEY `namausaha` (`namausaha`) USING BTREE,
  ADD KEY `id_jenis_usaha` (`id_jenis_usaha`) USING BTREE,
  ADD KEY `id_bentuk_usaha` (`id_bentuk_usaha`) USING BTREE,
  ADD KEY `id_sarana_usaha` (`id_sarana_usaha`) USING BTREE,
  ADD KEY `id_sektor_usaha` (`id_sektor_usaha`) USING BTREE,
  ADD KEY `id_status_tempat_usaha` (`id_status_tempat_usaha`) USING BTREE,
  ADD KEY `id_skala_usaha` (`id_skala_usaha`) USING BTREE,
  ADD KEY `id_modal_luar` (`id_modal_luar`) USING BTREE,
  ADD KEY `id_status` (`id_status`) USING BTREE,
  ADD KEY `tahun_data` (`tahun_data`) USING BTREE;

--
-- Indexes for table `m_umkm_alamat`
--
ALTER TABLE `m_umkm_alamat`
  ADD PRIMARY KEY (`id_umkm_alamat`) USING BTREE,
  ADD KEY `id_umkm_alamat` (`id_umkm_alamat`) USING BTREE,
  ADD KEY `id_umkm` (`id_umkm`) USING BTREE,
  ADD KEY `id_kec` (`id_kec`) USING BTREE,
  ADD KEY `id_kel` (`id_kel`) USING BTREE,
  ADD KEY `no_prop` (`no_prop`) USING BTREE,
  ADD KEY `no_kab` (`no_kab`) USING BTREE;

--
-- Indexes for table `m_umkm_berkas`
--
ALTER TABLE `m_umkm_berkas`
  ADD PRIMARY KEY (`id_umkm_berkas`) USING BTREE,
  ADD KEY `id_umkm_berkas` (`id_umkm_berkas`) USING BTREE,
  ADD KEY `id_umkm` (`id_umkm`) USING BTREE;

--
-- Indexes for table `m_umkm_izin_usaha`
--
ALTER TABLE `m_umkm_izin_usaha`
  ADD PRIMARY KEY (`id_izin_usaha`) USING BTREE,
  ADD KEY `id_izin_usaha` (`id_izin_usaha`) USING BTREE,
  ADD KEY `id_umkm` (`id_umkm`) USING BTREE;

--
-- Indexes for table `m_unit`
--
ALTER TABLE `m_unit`
  ADD PRIMARY KEY (`id_unit`) USING BTREE;

--
-- Indexes for table `m_visitor_anon`
--
ALTER TABLE `m_visitor_anon`
  ADD PRIMARY KEY (`id_anon`);

--
-- Indexes for table `m_wishlist`
--
ALTER TABLE `m_wishlist`
  ADD PRIMARY KEY (`id_wishlist`) USING BTREE,
  ADD KEY `id_wishlist` (`id_wishlist`) USING BTREE,
  ADD KEY `id_produk` (`id_produk`) USING BTREE,
  ADD KEY `username` (`username`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE;

--
-- Indexes for table `pembayaran_va`
--
ALTER TABLE `pembayaran_va`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `t_bsmpum`
--
ALTER TABLE `t_bsmpum`
  ADD PRIMARY KEY (`id_bsmpum`) USING BTREE,
  ADD KEY `nik` (`nik`) USING BTREE,
  ADD KEY `statusdidata` (`statusdidata`) USING BTREE;

--
-- Indexes for table `t_data_tampungan_bsmpum_flag`
--
ALTER TABLE `t_data_tampungan_bsmpum_flag`
  ADD PRIMARY KEY (`id_umkm`) USING BTREE,
  ADD UNIQUE KEY `id_umkm` (`id_umkm`) USING BTREE,
  ADD KEY `nik` (`nik`(191)) USING BTREE,
  ADD KEY `kecamatan` (`kecamatan`(191)) USING BTREE,
  ADD KEY `kelurahan` (`kelurahan`(191)) USING BTREE,
  ADD KEY `nama_pemilik` (`nama_pemilik`(191)) USING BTREE,
  ADD KEY `alamat` (`alamat`(191)) USING BTREE,
  ADD KEY `no_rt` (`no_rt`(191)) USING BTREE,
  ADD KEY `no_rw` (`no_rw`(191)) USING BTREE,
  ADD KEY `alamatworkshop` (`alamatworkshop`) USING BTREE,
  ADD KEY `latitude` (`latitude`) USING BTREE,
  ADD KEY `longitude` (`longitude`) USING BTREE,
  ADD KEY `kategori_usaha` (`kategori_usaha`) USING BTREE,
  ADD KEY `bidang_usaha` (`bidang_usaha`) USING BTREE,
  ADD KEY `bidang_usaha_lainnya` (`bidang_usaha_lainnya`) USING BTREE,
  ADD KEY `jenisusaha` (`jenisusaha`(191)) USING BTREE,
  ADD KEY `tambahan` (`tambahan`) USING BTREE,
  ADD KEY `telpon` (`telpon`) USING BTREE,
  ADD KEY `created_at` (`created_at`) USING BTREE,
  ADD KEY `created_by` (`created_by`(191)) USING BTREE,
  ADD KEY `statusdidata` (`statusdidata`) USING BTREE,
  ADD KEY `no_kk` (`no_kk`) USING BTREE,
  ADD KEY `akun_sabakota` (`akun_sabakota`) USING BTREE,
  ADD KEY `source` (`source`) USING BTREE,
  ADD KEY `kecamatanworkshop` (`kecamatanworkshop`) USING BTREE,
  ADD KEY `kelurahanworkshop` (`kelurahanworkshop`) USING BTREE;

--
-- Indexes for table `t_data_umkm`
--
ALTER TABLE `t_data_umkm`
  ADD PRIMARY KEY (`id_umkm`) USING BTREE,
  ADD UNIQUE KEY `id_umkm` (`id_umkm`) USING BTREE,
  ADD KEY `nik` (`nik`(191)) USING BTREE,
  ADD KEY `kecamatan` (`kecamatan`(191)) USING BTREE,
  ADD KEY `kelurahan` (`kelurahan`(191)) USING BTREE,
  ADD KEY `nama_pemilik` (`nama_pemilik`(191)) USING BTREE,
  ADD KEY `alamat` (`alamat`(191)) USING BTREE,
  ADD KEY `no_rt` (`no_rt`(191)) USING BTREE,
  ADD KEY `no_rw` (`no_rw`(191)) USING BTREE,
  ADD KEY `alamatworkshop` (`alamatworkshop`) USING BTREE,
  ADD KEY `latitude` (`latitude`) USING BTREE,
  ADD KEY `longitude` (`longitude`) USING BTREE,
  ADD KEY `kategori_usaha` (`kategori_usaha`) USING BTREE,
  ADD KEY `bidang_usaha` (`bidang_usaha`) USING BTREE,
  ADD KEY `bidang_usaha_lainnya` (`bidang_usaha_lainnya`) USING BTREE,
  ADD KEY `jenisusaha` (`jenisusaha`(191)) USING BTREE,
  ADD KEY `tambahan` (`tambahan`) USING BTREE,
  ADD KEY `telpon` (`telpon`) USING BTREE,
  ADD KEY `created_at` (`created_at`) USING BTREE,
  ADD KEY `created_by` (`created_by`(191)) USING BTREE,
  ADD KEY `statusdidata` (`statusdidata`) USING BTREE,
  ADD KEY `no_kk` (`no_kk`) USING BTREE,
  ADD KEY `akun_sabakota` (`akun_sabakota`) USING BTREE,
  ADD KEY `source` (`source`) USING BTREE,
  ADD KEY `kecamatanworkshop` (`kecamatanworkshop`) USING BTREE,
  ADD KEY `kelurahanworkshop` (`kelurahanworkshop`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app`
--
ALTER TABLE `app`
  MODIFY `id_app` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log_eror_callback_va`
--
ALTER TABLE `log_eror_callback_va`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modalusaha`
--
ALTER TABLE `modalusaha`
  MODIFY `id_modalusaha` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_agenda`
--
ALTER TABLE `m_agenda`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `m_alamat`
--
ALTER TABLE `m_alamat`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `m_bahan_bakar`
--
ALTER TABLE `m_bahan_bakar`
  MODIFY `id_bahan_bakar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `m_banner`
--
ALTER TABLE `m_banner`
  MODIFY `id_banner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_banner_produk`
--
ALTER TABLE `m_banner_produk`
  MODIFY `id_banner_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_bentuk_usaha`
--
ALTER TABLE `m_bentuk_usaha`
  MODIFY `id_bentuk_usaha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `m_berita`
--
ALTER TABLE `m_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `m_dasar_hukum`
--
ALTER TABLE `m_dasar_hukum`
  MODIFY `id_dasar_hukum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_data_vaksin`
--
ALTER TABLE `m_data_vaksin`
  MODIFY `id_vaksin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20791400;

--
-- AUTO_INCREMENT for table `m_diskusi`
--
ALTER TABLE `m_diskusi`
  MODIFY `id_diskusi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_diskusi_balasan`
--
ALTER TABLE `m_diskusi_balasan`
  MODIFY `id_diskusi_balasan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_group`
--
ALTER TABLE `m_group`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_history`
--
ALTER TABLE `m_history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `m_jenis_usaha`
--
ALTER TABLE `m_jenis_usaha`
  MODIFY `id_jenis_usaha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `m_kelurahan`
--
ALTER TABLE `m_kelurahan`
  MODIFY `id_kel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `m_keranjang`
--
ALTER TABLE `m_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `m_kode_pos`
--
ALTER TABLE `m_kode_pos`
  MODIFY `id_kode_pos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=681;

--
-- AUTO_INCREMENT for table `m_kurir`
--
ALTER TABLE `m_kurir`
  MODIFY `id_kurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `m_lainnya`
--
ALTER TABLE `m_lainnya`
  MODIFY `id_lainnya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_modal_luar`
--
ALTER TABLE `m_modal_luar`
  MODIFY `id_modal_luar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_notifikasi`
--
ALTER TABLE `m_notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `m_pengguna`
--
ALTER TABLE `m_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `m_pesan`
--
ALTER TABLE `m_pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `m_pesan_detail`
--
ALTER TABLE `m_pesan_detail`
  MODIFY `id_pesan_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `m_produk`
--
ALTER TABLE `m_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_produk_foto`
--
ALTER TABLE `m_produk_foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `m_produk_stok`
--
ALTER TABLE `m_produk_stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `m_sarana_usaha`
--
ALTER TABLE `m_sarana_usaha`
  MODIFY `id_sarana_usaha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_sektor_usaha`
--
ALTER TABLE `m_sektor_usaha`
  MODIFY `id_sektor_usaha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `m_skala_usaha`
--
ALTER TABLE `m_skala_usaha`
  MODIFY `id_skala_usaha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_slider`
--
ALTER TABLE `m_slider`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_status`
--
ALTER TABLE `m_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_status_tempat_usaha`
--
ALTER TABLE `m_status_tempat_usaha`
  MODIFY `id_status_tempat_usaha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_transaksi`
--
ALTER TABLE `m_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `m_transaksi_detail`
--
ALTER TABLE `m_transaksi_detail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `m_ulasan`
--
ALTER TABLE `m_ulasan`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_umkm`
--
ALTER TABLE `m_umkm`
  MODIFY `id_umkm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16567;

--
-- AUTO_INCREMENT for table `m_umkm_alamat`
--
ALTER TABLE `m_umkm_alamat`
  MODIFY `id_umkm_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16555;

--
-- AUTO_INCREMENT for table `m_umkm_berkas`
--
ALTER TABLE `m_umkm_berkas`
  MODIFY `id_umkm_berkas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_umkm_izin_usaha`
--
ALTER TABLE `m_umkm_izin_usaha`
  MODIFY `id_izin_usaha` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_unit`
--
ALTER TABLE `m_unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `m_visitor_anon`
--
ALTER TABLE `m_visitor_anon`
  MODIFY `id_anon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_wishlist`
--
ALTER TABLE `m_wishlist`
  MODIFY `id_wishlist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembayaran_va`
--
ALTER TABLE `pembayaran_va`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_bsmpum`
--
ALTER TABLE `t_bsmpum`
  MODIFY `id_bsmpum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_data_tampungan_bsmpum_flag`
--
ALTER TABLE `t_data_tampungan_bsmpum_flag`
  MODIFY `id_umkm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_data_umkm`
--
ALTER TABLE `t_data_umkm`
  MODIFY `id_umkm` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
