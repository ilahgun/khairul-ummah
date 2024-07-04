-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2022 at 03:43 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbyayasan`
--

-- --------------------------------------------------------

--
-- Table structure for table `anak_asuh`
--

CREATE TABLE `anak_asuh` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `tmp_lahir` varchar(45) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `gender` enum('Laki-Laki','Perempuan') NOT NULL,
  `pendidikan` varchar(45) NOT NULL,
  `foto` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anak_asuh`
--

INSERT INTO `anak_asuh` (`id`, `nama`, `tmp_lahir`, `tgl_lahir`, `gender`, `pendidikan`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Jamal Abidin', 'Bogor', '2008-12-16', 'Laki-Laki', 'SMP', 'foto-Jamal Abidin.jpg', NULL, '2022-11-20 08:48:57'),
(6, 'Sintia Larasati', 'Bogor', '2005-12-16', 'Perempuan', 'SMA', 'foto-Sintia Larasati.jpg', '2022-12-22 01:16:19', '2022-12-22 01:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `keywords`, `meta_desc`, `created_at`, `updated_at`) VALUES
(1, 'pelatihan', 'pelatihan', 'pelatihan', 'pelatihan', '2022-12-16 00:22:38', '2022-12-16 00:22:38'),
(3, 'seni', 'seni', 'seni', 'seni', '2022-12-16 08:29:44', '2022-12-16 08:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `donasi`
--

CREATE TABLE `donasi` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  `tgl_donasi` date NOT NULL,
  `jml_donasi` double NOT NULL,
  `bukti_transfer` varchar(100) DEFAULT NULL,
  `donatur_id` int(11) NOT NULL,
  `metode_pembayaran_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donasi`
--

INSERT INTO `donasi` (`id`, `keterangan`, `tgl_donasi`, `jml_donasi`, `bukti_transfer`, `donatur_id`, `metode_pembayaran_id`, `created_at`, `updated_at`) VALUES
(9, 'Membantu anak asuh yang ingin bersekolah', '2022-12-22', 100000, 'bukti_transfer-Ade Ramanda-2022-12-22 134739.jpg', 10, 2, '2022-12-22 06:47:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `donatur`
--

CREATE TABLE `donatur` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `no_hp` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donatur`
--

INSERT INTO `donatur` (`id`, `nama`, `no_hp`, `created_at`, `updated_at`) VALUES
(10, 'Ade Ramanda', '082867352883', '2022-12-22 06:47:39', '2022-12-22 06:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `nomor` varchar(45) NOT NULL,
  `icon` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id`, `nama`, `nomor`, `icon`, `created_at`, `updated_at`) VALUES
(2, 'DANA', '083816274621', 'icon-DANA.png', '2022-12-21 07:28:59', '2022-12-21 23:22:41'),
(3, 'OVO', '08953646275', 'icon-OVO.png', '2022-12-21 22:06:34', '2022-12-21 23:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_12_16_064456_create_categories_table', 2),
(6, '2022_12_16_072329_create_tags_table', 3),
(7, '2022_12_16_073629_create_posts_table', 4),
(8, '2022_12_16_073755_create_post_tag_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `user_id`, `cover`, `title`, `slug`, `desc`, `keywords`, `meta_desc`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 'images/blog/u8nbdbpFwN92AE0cHywzbWhw7p9mazIdgfv4kyOC.jpg', 'Melakukan pelatihan komputer', 'melakukan-pelatihan-komputer', 'Pengujian Blog Laravel 8\r\nKita telah sampai di akhir artikel tutorial membuat blog dengan laravel 8 dan bootstrap. Untuk mengujinya, pastikan kamu sudah membuat atau menambahkan data post atau blog lengkap dengan category dan tag. Silahkan jalankan laravel project dengan perintah php artisan serve, lalu buka project di browser. \r\n\r\nUntuk melihat tampilan detail post atau blog, silahkan klik salah satu data post atau blog, maka kamu akan diarahkan ke halaman detail blog tersebut. Kemudian untuk melihat data-data post atau blog berdasarkan category, di bagian card footer terdapat data category dari post tersebut. Silahkan klik category tersebut, maka kamu akan diarahkan ke halaman category yang menampilkan data-data post atau blog berdasarkan category tersebut. Untuk melihat data-data post berdasarkan tag, di halaman detail blog atau tepatnya di bagian card footer juga terdapat data tag dari post tersebut. Silahkan klik data tag tersebut, maka kamu akan di arahkan ke halaman tag yang menampilkan data-data post atau blog berdasarkan tag tersebut.\r\n\r\nKesimpulan\r\nKita telah menyelesaikan tutorial cara membuat blog dengan laravel 8 dan bootstrap. Mungkin terlihat cukup panjang langkah-langkah di artikel ini, itu karena di artikel ini saya menjadikan satu artikel untuk langkah-langkah membuat CRUD category, CRUD tag dan CRUD post. Dari segi tampilan, mungkin terlihat cukup sederhana, tapi saya rasa point dari artikel ini sudah cukup jelas yaitu membuat blog sederhana dengan laravel versi 8 dan bootstrap, serta menerapkan SEO sederhana di setiap halaman di front end.\r\n\r\nKamu bisa improve kode-kode yang telah didapat dari artikel ini untuk membuat fungsinya lebih baik atau lebih kompleks dan dengan tampilan yang lebih menarik lagi.\r\n\r\nSekian artikel tutorial membuat blog dengan laravel 8 kali ini, semoga artikel ini bisa membantu. Selamat mencoba dan sampai jumpa di artikel berikutnya. 😊 🚀 👨‍🚀\r\n\r\n \r\n\r\nCredit: Internet illustrations by Storyset', 'pelatihan', 'pelatihan', '2022-12-16 01:00:03', '2022-12-19 07:37:13', NULL),
(2, 1, 3, 'images/blog/gIXZTUogwpQ2H6Nc3HA9KS948W2lMYrs6BaDPqlm.jpg', 'Melakukan pengajian', 'melakukan-pengajian', 'Jakarta - Membacakan dongeng sebelum tidur adalah hal yang paling dinantikan oleh Si Kecil nih, Bunda. Bukan tanpa alasan, kisah yang Bunda ceritakan tak hanya menarik, tetapi juga memiliki pesan moral untuk Si Kecil.\r\nSebuah penelitian mengungkapkan bahwa membacakan dongeng sebelum tidur bisa membuat Si Kecil belajar lebih banyak hal daripada apa yang mereka pikirkan. Pernyataan ini diungkapkan langsung oleh Kepala Institut Nasional Kesehatan Anak dan Perkembangan Manusia, Reid Lyon.\r\n\r\n\"Penelitian saraf menunjukkan ketika orang tua atau pengasuh berinteraksi dengan anak-anak secara verbal, termasuk membacakan untuk mereka, anak-anak akan belajar lebih banyak jika dibandingkan dengan yang kita pikirkan,\" katanya dikutip Resveralife.', 'pelatihan, agama', 'pelatihan, agama', '2022-12-16 02:41:16', '2022-12-19 08:31:40', NULL),
(3, 3, 3, 'images/blog/MPKGsvuaOAODqbFUCYHcl1dhvmLNWOue3NLAAk1S.jpg', 'Mengajarkan ank yatim seni rupa', 'mengajarkan-ank-yatim-seni-rupa', 'Gender adalah pembedaan peran, atribut, sifat, sikap dan perilaku yang tumbuh dan berkembang dalam masyarakat. Dan peran gender terbagi menjadi peran produktif, peran reproduksi serta peran sosial kemasyarakatan.\r\n\r\nKata gender dapat diartikan sebagai peran yang dibentuk oleh masyarakat serta perilaku yang tertanam lewat proses sosialisasi yang berhubungan dengan jenis kelamin perempuan dan laki-laki. Ada perbedaan secara biologis antara perempuan dan laki-laki-namun kebudayaan menafsirkan perbedaan biologis ini menjadi seperangkat tuntutan sosial tentang kepantasan dalam berperilaku, dan pada gilirannya hak-hak, sumber daya, dan kuasa. Kendati tuntutan ini bervariasi di setiap masyarakat, tapi terdapat beberapa kemiripan yang mencolok. Misalnya, hampir semua kelompok masyarakat menyerahkan tanggung jawab perawatan anak pada perempuan, sedangkan tugas kemiliteran diberikan pada laki-laki. Sebagaimana halnya ras, etnik, dan kelas, gender adalah sebuah kategori sosial yang sangat menentukan jalan hidup seseorang dan partisipasinya dalam masyarakat dan ekonomi. Tidak semua masyarakat mengalami diskriminasi berdasarkan ras atau etnis, namun semua masyarakat mengalami diskriminasi berdasarkan gender-dalam bentuk kesenjangan dan perbedaan-dalam tingkatan yang berbeda-beda. Seringkali dibutuhkan waktu cukup lama untuk mengubah ketidakadilan ini. Suasana ketidakadilan ini terkadang bisa berubah secara drastis karena kebijakan dan perubahan sosial-ekonomi.\r\n\r\nPengertian kesetaraan gender merujuk kepada suatu keadaan setara antara laki-laki dan perempuan dalam pemenuhan hak dan kewajiban.\r\n\r\nDiskriminasi berdasarkan gender masih terjadi pada seluruh aspek kehidupan, di seluruh dunia. Ini adalah fakta meskipun ada kemajuan yang cukup pesat dalam kesetaraan gender dewasa ini. Sifat dan tingkat diskriminasi sangat bervariasi di berbagai negara atau wilayah. Tidak ada satu wilayah pun di negara dunia ketiga di mana perempuan telah menikmati kesetaraan dalam hak-hak hukum, sosial dan ekonomi. Kesenjangan gender dalam kesempatan dan kendali atas sumber daya, ekonomi, kekuasaan, dan partisipasi politik terjadi di mana-mana. Perempuan dan anak perempuan menanggung beban paling berat akibat ketidaksetaraan yang terjadi, namun pada dasarnya ketidaksetaraan itu merugikan semua orang. Oleh sebab itu, kesetaraan gender merupakan persoalan pokok suatu tujuan pembangunan yang memiliki nilai tersendiri.\r\n\r\nKesetaraan gender akan memperkuat kemampuan negara untuk berkembang, mengurangi kemiskinan, dan memerintah secara efektif. Dengan demikian mempromosikan kesetaraan gender adalah bagian utama dari strategi pembangunan dalam rangka untuk memberdayakan masyarakat (semua orang)-perempuan dan laki-laki-untuk mengentaskan diri dari kemiskinan dan meningkatkan taraf hidup mereka.\r\n\r\nPembangunan ekonomi membuka banyak jalan untuk meningkatkan kesetaraan gender dalam jangka panjang.\r\n\r\nAgenda Tujuan Pembangunan Berkelanjutan memiliki makna yang penting karena setelah diadopsi maka akan dijadikan acuan secara global dan nasional sehingga agenda pembangunan menjadi lebih fokus. Setiap butir tujuan tersebut menjunjung tinggi Hak Asasi Manusia (HAM) dan untuk mencapai kesetaraan gender dan pemberdayaan perempuan, baik tua mau-pun muda.', 'seni, art', 'seni, art', '2022-12-16 08:32:13', '2022-12-19 07:32:22', NULL),
(4, 3, 3, 'images/blog/cqkR5LHAytrzV2Okal9fkbj5Zmu1JNVIiIwCUDuD.webp', 'Uji coba', 'uji-coba', 'tulis lainnya merupakan salah satu bagian yang penting dalam sebuah karya tulis. Bagi para pelajar atau akademisi yang sering terlibat dalam pembuatan karya tulis, contoh kata pengantar sangat penting sebagai referensi.\r\nKata pengantar merupakan salah satu bagian pendahuluan yang terdapat dalam sebuah karya tulis. Kata pengantar ini terdiri dari beberapa bagian penting seperti pembukaan, isi, dan penutup.\r\n\r\nKarena kata pengantar berada pada bagian awal karya tulis, maka kata pengantar ini berfungsi untuk mengantarkan pembaca pada bagian uraian yang tertuang dalam sebuah karya tulis. Umumnya, kata pengantar berisi gambaran umum tentang sebuah karya tulis dan berfungsi untuk menarik minat pembaca untuk membaca karya tulis tersebut.\r\n\r\n\r\nUntuk membuat kata pengantar yang baik dan benar, penulis harus memahami struktur dan cara membuat kata pengantar. Selain itu, perlu juga diketahui beberapa contoh kata pengantar sebagai referensi.\r\n\r\nBaca artikel detiksulsel, \"15 Contoh Kata Pengantar Makalah Beserta Struktur dan Cara Membuatnya\" selengkapnya https://www.detik.com/sulsel/berita/d-6366750/15-contoh-kata-pengantar-makalah-beserta-struktur-dan-cara-membuatnya.\r\n\r\nDownload Apps Detikcom Sekarang https://apps.detik.com/detik/', 'web', 'web', '2022-12-16 23:19:53', '2022-12-20 00:37:25', NULL),
(8, 1, 3, 'landingpage/images/news/LV7b1ZoOsmXN9Kml2EjYHUnyWPKaUvqYMZ0OKcw1.png', 'latihan coba', 'latihan-coba', 'latihan', 'latihan', 'latihan', '2022-12-18 03:15:54', '2022-12-18 04:13:19', '2022-12-18 04:13:19'),
(9, 1, 3, 'images/blog/ngLidBLqbPOwS0MyLSMQpgBHfDd7GNAUSBgtqjOV.jpg', 'Latihannnn', 'latihannnn', 'Latihannnn', 'Latihannnn', 'Latihannnn', '2022-12-18 04:59:10', '2022-12-19 08:25:05', '2022-12-19 08:25:05'),
(10, 1, 3, 'images/blog/3QIxRT1RLcmRPSzStLA8kaFfpB7e057HO78p9MnF.png', 'tes', 'tes', 'tes', 'tes', 'tes', '2022-12-19 06:54:16', '2022-12-19 07:34:02', '2022-12-19 07:34:02'),
(11, 1, 3, 'images/blog/q0oppCprxmXBAsMnSpntaOcWHrCJwZ6j2Voib2d0.jpg', 'nyoba', 'nyoba', 'Awal narasi biasanya berisi pengantar yaitu memperkenalkan suasana dan tokoh. Bagian awal harus dibuat menarik agar dapat mengikat pembaca. Bagian tengah merupakan bagian yang memunculkan suatu konflik. Konflik lalu diarahkan menuju klimaks cerita. Setelah konfik timbul dan mencapai klimaks, secara berangsur-angsur cerita akan mereda. Akhir cerita yang mereda ini memiliki cara pengungkapan bermacam-macam. Ada yang menceritakannya dengan panjang, ada yang singkat, ada pula yang berusaha menggantungkan akhir cerita dengan mempersilakan pembaca untuk menebaknya sendiri.', 'coba', 'nyoba', '2022-12-21 07:42:22', '2022-12-21 07:42:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`id`, `post_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 3, 3, NULL, NULL),
(4, 4, 1, NULL, NULL),
(8, 8, 2, NULL, NULL),
(9, 9, 2, NULL, NULL),
(10, 10, 3, NULL, NULL),
(11, 11, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `keywords`, `meta_desc`, `created_at`, `updated_at`) VALUES
(1, 'web', 'web', 'web', 'web', '2022-12-16 00:35:51', '2022-12-16 00:35:51'),
(2, 'agama', 'agama', 'agama', 'agama', '2022-12-16 02:38:21', '2022-12-16 02:38:21'),
(3, 'art', 'art', 'art', 'art', '2022-12-16 08:30:12', '2022-12-16 08:30:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('ketua','sekretaris','bendahara','staff') COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','pengurus') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pengurus',
  `isactive` tinyint(1) NOT NULL DEFAULT 0,
  `foto` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `no_hp`, `email`, `email_verified_at`, `password`, `status`, `role`, `isactive`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Admin', '088766276356', 'admin@gmail.com', NULL, '$2y$10$U8sV7lYrcBongJh86Lzs5.sZUMqZ97ClgCdce.bAqAKCP//wZQNjW', 'staff', 'admin', 1, NULL, NULL, '2022-11-29 09:16:26', '2022-11-29 10:32:04'),
(17, 'Madun Hawari', '08213672162', 'madun@gmail.com', NULL, '$2y$10$hQIbjV2ZeXnM0SEMIZeDmOzWZZKTQpuM/BMUW46nEjN6SJGLRR9eC', 'sekretaris', 'pengurus', 1, 'pict-Madun Hawari.jpg', NULL, '2022-12-21 09:09:19', '2022-12-22 08:45:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anak_asuh`
--
ALTER TABLE `anak_asuh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `donasi`
--
ALTER TABLE `donasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_donasi_metode_pembayaran1_idx` (`metode_pembayaran_id`),
  ADD KEY `fk_donasi_donatur1_idx` (`donatur_id`);

--
-- Indexes for table `donatur`
--
ALTER TABLE `donatur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_tag_post_id_foreign` (`post_id`),
  ADD KEY `post_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_name_unique` (`name`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anak_asuh`
--
ALTER TABLE `anak_asuh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `donasi`
--
ALTER TABLE `donasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `donatur`
--
ALTER TABLE `donatur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donasi`
--
ALTER TABLE `donasi`
  ADD CONSTRAINT `fk_donasi_donatur1` FOREIGN KEY (`donatur_id`) REFERENCES `donatur` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_donasi_metode_pembayaran1` FOREIGN KEY (`metode_pembayaran_id`) REFERENCES `metode_pembayaran` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
