-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 23, 2026 at 04:43 PM
-- Server version: 11.8.9-MariaDB-deb13-log
-- PHP Version: 8.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u631918861_hNqDxEN0K_dboslapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('opticore-solutions-limited-cache-0cd7c3a9b93d3bb93c33c3bd8b5e0486', 'i:1;', 1773193165),
('opticore-solutions-limited-cache-0cd7c3a9b93d3bb93c33c3bd8b5e0486:timer', 'i:1773193165;', 1773193165),
('opticore-solutions-limited-cache-257ceef2c44e22372519a57260f0ea47', 'i:1;', 1776487363),
('opticore-solutions-limited-cache-257ceef2c44e22372519a57260f0ea47:timer', 'i:1776487363;', 1776487363),
('opticore-solutions-limited-cache-292fba9d64db65f682fd791bd8ee6a98', 'i:2;', 1771452207),
('opticore-solutions-limited-cache-292fba9d64db65f682fd791bd8ee6a98:timer', 'i:1771452207;', 1771452207),
('opticore-solutions-limited-cache-2f363e74665dc195f518109190832710', 'i:1;', 1774767333),
('opticore-solutions-limited-cache-2f363e74665dc195f518109190832710:timer', 'i:1774767333;', 1774767333),
('opticore-solutions-limited-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1773487390),
('opticore-solutions-limited-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1773487390;', 1773487390),
('opticore-solutions-limited-cache-43190b684b53b184daa255aa1b53fce4', 'i:1;', 1773487130),
('opticore-solutions-limited-cache-43190b684b53b184daa255aa1b53fce4:timer', 'i:1773487130;', 1773487130),
('opticore-solutions-limited-cache-acc_admins', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:2:{i:0;O:15:\"App\\Models\\User\":38:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:14:{s:2:\"id\";i:9;s:4:\"name\";s:6:\"Viewer\";s:5:\"email\";s:14:\"viewer@osl.com\";s:17:\"email_verified_at\";s:19:\"2026-03-14 17:06:28\";s:8:\"password\";s:97:\"$argon2id$v=19$m=65536,t=4,p=2$SlIxUlNhbnQ3bGRvWlVhdg$dXfbQnH4elGdH879zhkATrdCwVZtV8KIrZxZ2QdpZro\";s:17:\"two_factor_secret\";N;s:25:\"two_factor_recovery_codes\";N;s:23:\"two_factor_confirmed_at\";N;s:14:\"remember_token\";N;s:4:\"role\";s:8:\"vw_admin\";s:8:\"provider\";N;s:11:\"provider_id\";N;s:10:\"created_at\";s:19:\"2026-03-14 17:06:28\";s:10:\"updated_at\";s:19:\"2026-03-14 17:06:28\";}s:11:\"\0*\0original\";a:14:{s:2:\"id\";i:9;s:4:\"name\";s:6:\"Viewer\";s:5:\"email\";s:14:\"viewer@osl.com\";s:17:\"email_verified_at\";s:19:\"2026-03-14 17:06:28\";s:8:\"password\";s:97:\"$argon2id$v=19$m=65536,t=4,p=2$SlIxUlNhbnQ3bGRvWlVhdg$dXfbQnH4elGdH879zhkATrdCwVZtV8KIrZxZ2QdpZro\";s:17:\"two_factor_secret\";N;s:25:\"two_factor_recovery_codes\";N;s:23:\"two_factor_confirmed_at\";N;s:14:\"remember_token\";N;s:4:\"role\";s:8:\"vw_admin\";s:8:\"provider\";N;s:11:\"provider_id\";N;s:10:\"created_at\";s:19:\"2026-03-14 17:06:28\";s:10:\"updated_at\";s:19:\"2026-03-14 17:06:28\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:3:{s:17:\"email_verified_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:4:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";i:2;s:25:\"two_factor_recovery_codes\";i:3;s:17:\"two_factor_secret\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:8:\"password\";i:3;s:4:\"role\";i:4;s:8:\"provider\";i:5;s:11:\"provider_id\";i:6;s:17:\"email_verified_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:14:\"\0*\0accessToken\";N;s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}i:1;O:15:\"App\\Models\\User\":38:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:14:{s:2:\"id\";i:1;s:4:\"name\";s:13:\"Rashed Bishal\";s:5:\"email\";s:22:\"rashed.bishal@live.com\";s:17:\"email_verified_at\";s:19:\"2025-12-22 13:12:49\";s:8:\"password\";s:97:\"$argon2id$v=19$m=65536,t=4,p=2$VXFpTmtXdENZbTlKN2ZmSw$KpRnzBFxek44aMyzatngqArged0FwXyQhrqP99jZmnM\";s:17:\"two_factor_secret\";N;s:25:\"two_factor_recovery_codes\";N;s:23:\"two_factor_confirmed_at\";N;s:14:\"remember_token\";N;s:4:\"role\";s:9:\"acc_admin\";s:8:\"provider\";N;s:11:\"provider_id\";N;s:10:\"created_at\";s:19:\"2025-12-22 13:11:25\";s:10:\"updated_at\";s:19:\"2025-12-25 17:30:24\";}s:11:\"\0*\0original\";a:14:{s:2:\"id\";i:1;s:4:\"name\";s:13:\"Rashed Bishal\";s:5:\"email\";s:22:\"rashed.bishal@live.com\";s:17:\"email_verified_at\";s:19:\"2025-12-22 13:12:49\";s:8:\"password\";s:97:\"$argon2id$v=19$m=65536,t=4,p=2$VXFpTmtXdENZbTlKN2ZmSw$KpRnzBFxek44aMyzatngqArged0FwXyQhrqP99jZmnM\";s:17:\"two_factor_secret\";N;s:25:\"two_factor_recovery_codes\";N;s:23:\"two_factor_confirmed_at\";N;s:14:\"remember_token\";N;s:4:\"role\";s:9:\"acc_admin\";s:8:\"provider\";N;s:11:\"provider_id\";N;s:10:\"created_at\";s:19:\"2025-12-22 13:11:25\";s:10:\"updated_at\";s:19:\"2025-12-25 17:30:24\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:3:{s:17:\"email_verified_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:4:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";i:2;s:25:\"two_factor_recovery_codes\";i:3;s:17:\"two_factor_secret\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:8:\"password\";i:3;s:4:\"role\";i:4;s:8:\"provider\";i:5;s:11:\"provider_id\";i:6;s:17:\"email_verified_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:14:\"\0*\0accessToken\";N;s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1773489988),
('opticore-solutions-limited-cache-cf36bc5af67c154d7ec9200e3995252b', 'i:1;', 1771929792),
('opticore-solutions-limited-cache-cf36bc5af67c154d7ec9200e3995252b:timer', 'i:1771929792;', 1771929792),
('opticore-solutions-limited-cache-client_info_8', 'O:22:\"App\\Models\\User\\Client\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"clients\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:1:{s:5:\"phone\";s:11:\"01821144599\";}s:11:\"\0*\0original\";a:1:{s:5:\"phone\";s:11:\"01821144599\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:12:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:7:\"address\";i:3;s:4:\"city\";i:4;s:5:\"state\";i:5;s:3:\"zip\";i:6;s:7:\"country\";i:7;s:5:\"phone\";i:8;s:12:\"company_name\";i:9;s:15:\"company_address\";i:10;s:10:\"concern_id\";i:11;s:7:\"user_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}', 1773488578),
('opticore-solutions-limited-cache-count-pending-invoices', 'i:0;', 1774789270),
('opticore-solutions-limited-cache-current-orders', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;O:24:\"App\\Models\\Service\\Order\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"orders\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:3;s:12:\"order_number\";s:16:\"ORD-202603-00002\";s:9:\"client_id\";i:1;s:17:\"contracted_amount\";s:6:\"200.00\";s:11:\"paid_amount\";s:5:\"10.00\";s:10:\"due_amount\";s:6:\"190.00\";s:10:\"created_at\";s:19:\"2026-03-14 17:23:31\";s:5:\"notes\";N;}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:3;s:12:\"order_number\";s:16:\"ORD-202603-00002\";s:9:\"client_id\";i:1;s:17:\"contracted_amount\";s:6:\"200.00\";s:11:\"paid_amount\";s:5:\"10.00\";s:10:\"due_amount\";s:6:\"190.00\";s:10:\"created_at\";s:19:\"2026-03-14 17:23:31\";s:5:\"notes\";N;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:6:\"client\";O:22:\"App\\Models\\User\\Client\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"clients\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:1;s:4:\"name\";s:14:\"Anonymous User\";s:5:\"email\";s:21:\"backup25gb1@gmail.com\";s:7:\"address\";N;s:4:\"city\";N;s:5:\"state\";N;s:3:\"zip\";N;s:7:\"country\";N;s:5:\"phone\";s:11:\"01821144599\";s:15:\"phone_secondary\";N;s:12:\"company_name\";s:14:\"Anonymous User\";s:15:\"company_address\";N;s:10:\"concern_id\";i:2;s:7:\"user_id\";i:8;s:10:\"created_at\";s:19:\"2026-03-14 10:47:20\";s:10:\"updated_at\";s:19:\"2026-03-14 17:31:23\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:1;s:4:\"name\";s:14:\"Anonymous User\";s:5:\"email\";s:21:\"backup25gb1@gmail.com\";s:7:\"address\";N;s:4:\"city\";N;s:5:\"state\";N;s:3:\"zip\";N;s:7:\"country\";N;s:5:\"phone\";s:11:\"01821144599\";s:15:\"phone_secondary\";N;s:12:\"company_name\";s:14:\"Anonymous User\";s:15:\"company_address\";N;s:10:\"concern_id\";i:2;s:7:\"user_id\";i:8;s:10:\"created_at\";s:19:\"2026-03-14 10:47:20\";s:10:\"updated_at\";s:19:\"2026-03-14 17:31:23\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:12:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:7:\"address\";i:3;s:4:\"city\";i:4;s:5:\"state\";i:5;s:3:\"zip\";i:6;s:7:\"country\";i:7;s:5:\"phone\";i:8;s:12:\"company_name\";i:9;s:15:\"company_address\";i:10;s:10:\"concern_id\";i:11;s:7:\"user_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}s:8:\"services\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;O:25:\"App\\Models\\Config\\Service\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"services\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:5;s:4:\"name\";s:41:\"Hotel Jana The Dove - Cox\'s Bazar (Share)\";s:11:\"description\";s:22:\"Hotel Jana Cox\'s Bazar\";s:10:\"concern_id\";i:2;s:10:\"created_at\";s:19:\"2026-03-14 01:26:35\";s:10:\"updated_at\";s:19:\"2026-03-14 01:26:35\";}s:11:\"\0*\0original\";a:12:{s:2:\"id\";i:5;s:4:\"name\";s:41:\"Hotel Jana The Dove - Cox\'s Bazar (Share)\";s:11:\"description\";s:22:\"Hotel Jana Cox\'s Bazar\";s:10:\"concern_id\";i:2;s:10:\"created_at\";s:19:\"2026-03-14 01:26:35\";s:10:\"updated_at\";s:19:\"2026-03-14 01:26:35\";s:14:\"pivot_order_id\";i:3;s:16:\"pivot_service_id\";i:5;s:14:\"pivot_quantity\";i:1;s:16:\"pivot_unit_price\";s:6:\"200.00\";s:16:\"pivot_created_at\";s:19:\"2026-03-14 17:23:31\";s:16:\"pivot_updated_at\";s:19:\"2026-03-14 17:23:31\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":37:{s:13:\"\0*\0connection\";N;s:8:\"\0*\0table\";s:13:\"order_service\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:0;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:8:\"order_id\";i:3;s:10:\"service_id\";i:5;s:8:\"quantity\";i:1;s:10:\"unit_price\";s:6:\"200.00\";s:10:\"created_at\";s:19:\"2026-03-14 17:23:31\";s:10:\"updated_at\";s:19:\"2026-03-14 17:23:31\";}s:11:\"\0*\0original\";a:6:{s:8:\"order_id\";i:3;s:10:\"service_id\";i:5;s:8:\"quantity\";i:1;s:10:\"unit_price\";s:6:\"200.00\";s:10:\"created_at\";s:19:\"2026-03-14 17:23:31\";s:10:\"updated_at\";s:19:\"2026-03-14 17:23:31\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:11:\"pivotParent\";O:24:\"App\\Models\\Service\\Order\":35:{s:13:\"\0*\0connection\";N;s:8:\"\0*\0table\";s:6:\"orders\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:0;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:0:{}s:11:\"\0*\0original\";a:0:{}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:12:\"order_number\";i:1;s:17:\"contracted_amount\";i:2;s:10:\"due_amount\";i:3;s:11:\"paid_amount\";i:4;s:5:\"notes\";i:5;s:8:\"share_id\";i:6;s:16:\"sales_officer_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}s:12:\"pivotRelated\";O:25:\"App\\Models\\Config\\Service\":35:{s:13:\"\0*\0connection\";N;s:8:\"\0*\0table\";N;s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:0;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:0:{}s:11:\"\0*\0original\";a:0:{}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:4:\"name\";i:1;s:11:\"description\";i:2;s:10:\"concern_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}s:13:\"\0*\0foreignKey\";s:8:\"order_id\";s:13:\"\0*\0relatedKey\";s:10:\"service_id\";}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:4:\"name\";i:1;s:11:\"description\";i:2;s:10:\"concern_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:9:\"shareform\";O:28:\"App\\Models\\Service\\Shareform\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"shareforms\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:42:{s:2:\"id\";i:7;s:12:\"share_number\";s:7:\"ZD68A38\";s:4:\"name\";s:11:\"Sample Name\";s:9:\"gender_id\";i:1;s:11:\"father_name\";s:11:\"Sample Name\";s:11:\"mother_name\";s:11:\"Sample Name\";s:15:\"present_address\";s:11:\"Sample Name\";s:17:\"permanent_address\";N;s:11:\"spouse_name\";N;s:6:\"mobile\";s:11:\"01888888888\";s:3:\"nid\";N;s:11:\"religion_id\";i:1;s:3:\"dob\";N;s:10:\"profession\";N;s:5:\"email\";N;s:3:\"dom\";N;s:10:\"service_id\";i:5;s:18:\"ownership_category\";N;s:16:\"ownership_number\";i:1;s:4:\"size\";i:19;s:15:\"ownership_price\";d:200;s:16:\"special_discount\";N;s:16:\"contracted_price\";d:200;s:12:\"total_amount\";d:200;s:16:\"paymentmethod_id\";i:3;s:13:\"booking_money\";N;s:18:\"booking_money_date\";N;s:12:\"down_payment\";N;s:17:\"down_payment_date\";N;s:14:\"rest_amount_by\";N;s:12:\"installments\";N;s:17:\"installments_date\";N;s:19:\"payment_instruction\";N;s:9:\"nominee_1\";s:11:\"Sample Name\";s:9:\"nominee_2\";N;s:15:\"nominee_address\";N;s:14:\"nominee_mobile\";N;s:6:\"status\";i:1;s:8:\"order_id\";i:3;s:16:\"sales_officer_id\";i:5;s:10:\"created_at\";s:19:\"2026-03-14 17:22:14\";s:10:\"updated_at\";s:19:\"2026-03-14 17:23:31\";}s:11:\"\0*\0original\";a:42:{s:2:\"id\";i:7;s:12:\"share_number\";s:7:\"ZD68A38\";s:4:\"name\";s:11:\"Sample Name\";s:9:\"gender_id\";i:1;s:11:\"father_name\";s:11:\"Sample Name\";s:11:\"mother_name\";s:11:\"Sample Name\";s:15:\"present_address\";s:11:\"Sample Name\";s:17:\"permanent_address\";N;s:11:\"spouse_name\";N;s:6:\"mobile\";s:11:\"01888888888\";s:3:\"nid\";N;s:11:\"religion_id\";i:1;s:3:\"dob\";N;s:10:\"profession\";N;s:5:\"email\";N;s:3:\"dom\";N;s:10:\"service_id\";i:5;s:18:\"ownership_category\";N;s:16:\"ownership_number\";i:1;s:4:\"size\";i:19;s:15:\"ownership_price\";d:200;s:16:\"special_discount\";N;s:16:\"contracted_price\";d:200;s:12:\"total_amount\";d:200;s:16:\"paymentmethod_id\";i:3;s:13:\"booking_money\";N;s:18:\"booking_money_date\";N;s:12:\"down_payment\";N;s:17:\"down_payment_date\";N;s:14:\"rest_amount_by\";N;s:12:\"installments\";N;s:17:\"installments_date\";N;s:19:\"payment_instruction\";N;s:9:\"nominee_1\";s:11:\"Sample Name\";s:9:\"nominee_2\";N;s:15:\"nominee_address\";N;s:14:\"nominee_mobile\";N;s:6:\"status\";i:1;s:8:\"order_id\";i:3;s:16:\"sales_officer_id\";i:5;s:10:\"created_at\";s:19:\"2026-03-14 17:22:14\";s:10:\"updated_at\";s:19:\"2026-03-14 17:23:31\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:12:\"salesOfficer\";O:30:\"App\\Models\\Config\\SalesOfficer\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:14:\"sales_officers\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:5;s:4:\"name\";s:15:\"Sales Officer 2\";s:5:\"email\";s:17:\"sample@client.com\";s:11:\"designation\";s:7:\"Manager\";s:10:\"created_at\";s:19:\"2026-03-14 01:27:18\";s:10:\"updated_at\";s:19:\"2026-03-14 01:27:18\";}s:11:\"\0*\0original\";a:6:{s:2:\"id\";i:5;s:4:\"name\";s:15:\"Sales Officer 2\";s:5:\"email\";s:17:\"sample@client.com\";s:11:\"designation\";s:7:\"Manager\";s:10:\"created_at\";s:19:\"2026-03-14 01:27:18\";s:10:\"updated_at\";s:19:\"2026-03-14 01:27:18\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:4:\"name\";i:1;s:11:\"designation\";i:2;s:5:\"email\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:38:{i:0;s:4:\"name\";i:1;s:9:\"gender_id\";i:2;s:11:\"father_name\";i:3;s:11:\"mother_name\";i:4;s:15:\"present_address\";i:5;s:17:\"permanent_address\";i:6;s:11:\"spouse_name\";i:7;s:6:\"mobile\";i:8;s:3:\"nid\";i:9;s:11:\"religion_id\";i:10;s:3:\"dob\";i:11;s:10:\"profession\";i:12;s:5:\"email\";i:13;s:3:\"dom\";i:14;s:10:\"service_id\";i:15;s:18:\"ownership_category\";i:16;s:16:\"ownership_number\";i:17;s:4:\"size\";i:18;s:15:\"ownership_price\";i:19;s:16:\"special_discount\";i:20;s:16:\"contracted_price\";i:21;s:12:\"total_amount\";i:22;s:21:\"contracted_price_word\";i:23;s:16:\"paymentmethod_id\";i:24;s:13:\"booking_money\";i:25;s:18:\"booking_money_date\";i:26;s:12:\"down_payment\";i:27;s:17:\"down_payment_date\";i:28;s:14:\"rest_amount_by\";i:29;s:12:\"installments\";i:30;s:17:\"installments_date\";i:31;s:19:\"payment_instruction\";i:32;s:9:\"nominee_1\";i:33;s:9:\"nominee_2\";i:34;s:15:\"nominee_address\";i:35;s:14:\"nominee_mobile\";i:36;s:6:\"status\";i:37;s:16:\"sales_officer_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:12:\"order_number\";i:1;s:17:\"contracted_amount\";i:2;s:10:\"due_amount\";i:3;s:11:\"paid_amount\";i:4;s:5:\"notes\";i:5;s:8:\"share_id\";i:6;s:16:\"sales_officer_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1774789270),
('opticore-solutions-limited-cache-daily-osl-payment', 'a:2:{s:6:\"labels\";a:31:{i:0;s:6:\"Mar 01\";i:1;s:6:\"Mar 02\";i:2;s:6:\"Mar 03\";i:3;s:6:\"Mar 04\";i:4;s:6:\"Mar 05\";i:5;s:6:\"Mar 06\";i:6;s:6:\"Mar 07\";i:7;s:6:\"Mar 08\";i:8;s:6:\"Mar 09\";i:9;s:6:\"Mar 10\";i:10;s:6:\"Mar 11\";i:11;s:6:\"Mar 12\";i:12;s:6:\"Mar 13\";i:13;s:6:\"Mar 14\";i:14;s:6:\"Mar 15\";i:15;s:6:\"Mar 16\";i:16;s:6:\"Mar 17\";i:17;s:6:\"Mar 18\";i:18;s:6:\"Mar 19\";i:19;s:6:\"Mar 20\";i:20;s:6:\"Mar 21\";i:21;s:6:\"Mar 22\";i:22;s:6:\"Mar 23\";i:23;s:6:\"Mar 24\";i:24;s:6:\"Mar 25\";i:25;s:6:\"Mar 26\";i:26;s:6:\"Mar 27\";i:27;s:6:\"Mar 28\";i:28;s:6:\"Mar 29\";i:29;s:6:\"Mar 30\";i:30;s:6:\"Mar 31\";}s:4:\"data\";a:31:{i:0;i:0;i:1;i:0;i:2;i:0;i:3;i:0;i:4;i:0;i:5;i:0;i:6;i:0;i:7;i:0;i:8;i:0;i:9;i:0;i:10;i:0;i:11;i:0;i:12;i:0;i:13;i:0;i:14;i:0;i:15;i:0;i:16;i:0;i:17;i:0;i:18;i:0;i:19;i:0;i:20;i:0;i:21;i:0;i:22;i:0;i:23;i:0;i:24;i:0;i:25;i:0;i:26;i:0;i:27;i:0;i:28;i:0;i:29;i:0;i:30;i:0;}}', 1774789270),
('opticore-solutions-limited-cache-dd8a1ed35d0f29ba83d9b4b63b25563c', 'i:1;', 1773429575),
('opticore-solutions-limited-cache-dd8a1ed35d0f29ba83d9b4b63b25563c:timer', 'i:1773429575;', 1773429575),
('opticore-solutions-limited-cache-ee97cf9e43477e28deb804c5a905f445', 'i:1;', 1771219247),
('opticore-solutions-limited-cache-ee97cf9e43477e28deb804c5a905f445:timer', 'i:1771219247;', 1771219247),
('opticore-solutions-limited-cache-ef52e0aaa6a43717ddb0bc92efdb4cfc', 'i:2;', 1773487239),
('opticore-solutions-limited-cache-ef52e0aaa6a43717ddb0bc92efdb4cfc:timer', 'i:1773487239;', 1773487239),
('opticore-solutions-limited-cache-fff216769660374690f7a33d9c71937a', 'i:1;', 1774174438),
('opticore-solutions-limited-cache-fff216769660374690f7a33d9c71937a:timer', 'i:1774174438;', 1774174438),
('opticore-solutions-limited-cache-jana-client-count', 'i:1;', 1774789270),
('opticore-solutions-limited-cache-jana-client-stat', 'i:0;', 1774789270),
('opticore-solutions-limited-cache-jem.eg.i.z.642@gmail.com|185.220.101.18', 'i:1;', 1774174438),
('opticore-solutions-limited-cache-jem.eg.i.z.642@gmail.com|185.220.101.18:timer', 'i:1774174438;', 1774174438),
('opticore-solutions-limited-cache-monthly-osl-payment', 'a:2:{s:6:\"labels\";a:12:{i:0;s:3:\"Jan\";i:1;s:3:\"Feb\";i:2;s:3:\"Mar\";i:3;s:3:\"Apr\";i:4;s:3:\"May\";i:5;s:3:\"Jun\";i:6;s:3:\"Jul\";i:7;s:3:\"Aug\";i:8;s:3:\"Sep\";i:9;s:3:\"Oct\";i:10;s:3:\"Nov\";i:11;s:3:\"Dec\";}s:4:\"data\";a:12:{i:0;i:0;i:1;i:0;i:2;i:0;i:3;i:0;i:4;i:0;i:5;i:0;i:6;i:0;i:7;i:0;i:8;i:0;i:9;i:0;i:10;i:0;i:11;i:0;}}', 1774789270),
('opticore-solutions-limited-cache-monthly-provider-split', 'a:2:{s:6:\"labels\";a:2:{i:0;s:4:\"Jana\";i:1;s:3:\"OSL\";}s:4:\"data\";a:2:{i:0;i:80;i:1;i:0;}}', 1774789270),
('opticore-solutions-limited-cache-o.r.uk.o.taj.ig0.5.5@gmail.com|94.16.115.121', 'i:1;', 1776487364),
('opticore-solutions-limited-cache-o.r.uk.o.taj.ig0.5.5@gmail.com|94.16.115.121:timer', 'i:1776487364;', 1776487364),
('opticore-solutions-limited-cache-osl-client-count', 'i:0;', 1774789270),
('opticore-solutions-limited-cache-osl-client-stat', 'i:0;', 1774789270),
('opticore-solutions-limited-cache-osl-monthly-payment-count', 'i:0;', 1774789270);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('opticore-solutions-limited-cache-paid-invoices', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:8:{i:0;O:23:\"App\\Models\\Bill\\Invoice\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"invoices\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:12:{s:2:\"id\";i:10;s:14:\"invoice_number\";s:16:\"INV-202603-00009\";s:20:\"money_receipt_number\";N;s:12:\"order_number\";N;s:12:\"invoice_date\";s:10:\"2026-03-29\";s:8:\"due_date\";N;s:10:\"due_amount\";N;s:12:\"payment_date\";N;s:14:\"payment_amount\";s:5:\"10.00\";s:14:\"invoice_status\";s:10:\"Processing\";s:10:\"updated_at\";s:19:\"2026-03-29 08:13:09\";s:14:\"payment_method\";s:11:\"BKASH-BKash\";}s:11:\"\0*\0original\";a:12:{s:2:\"id\";i:10;s:14:\"invoice_number\";s:16:\"INV-202603-00009\";s:20:\"money_receipt_number\";N;s:12:\"order_number\";N;s:12:\"invoice_date\";s:10:\"2026-03-29\";s:8:\"due_date\";N;s:10:\"due_amount\";N;s:12:\"payment_date\";N;s:14:\"payment_amount\";s:5:\"10.00\";s:14:\"invoice_status\";s:10:\"Processing\";s:10:\"updated_at\";s:19:\"2026-03-29 08:13:09\";s:14:\"payment_method\";s:11:\"BKASH-BKash\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:14:\"payment_amount\";s:5:\"float\";s:10:\"due_amount\";s:5:\"float\";s:23:\"public_token_expires_at\";s:8:\"datetime\";s:23:\"public_token_revoked_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"order\";N;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:11:{i:0;s:12:\"invoice_date\";i:1;s:20:\"money_receipt_number\";i:2;s:8:\"due_date\";i:3;s:12:\"payment_date\";i:4;s:10:\"due_amount\";i:5;s:14:\"payment_amount\";i:6;s:7:\"remarks\";i:7;s:14:\"invoice_status\";i:8;s:12:\"public_token\";i:9;s:23:\"public_token_revoked_at\";i:10;s:23:\"public_token_expires_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}i:1;O:23:\"App\\Models\\Bill\\Invoice\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"invoices\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:12:{s:2:\"id\";i:9;s:14:\"invoice_number\";s:16:\"INV-202603-00008\";s:20:\"money_receipt_number\";N;s:12:\"order_number\";N;s:12:\"invoice_date\";s:10:\"2026-03-29\";s:8:\"due_date\";N;s:10:\"due_amount\";N;s:12:\"payment_date\";N;s:14:\"payment_amount\";s:5:\"10.00\";s:14:\"invoice_status\";s:10:\"Processing\";s:10:\"updated_at\";s:19:\"2026-03-29 06:56:37\";s:14:\"payment_method\";s:11:\"BKASH-BKash\";}s:11:\"\0*\0original\";a:12:{s:2:\"id\";i:9;s:14:\"invoice_number\";s:16:\"INV-202603-00008\";s:20:\"money_receipt_number\";N;s:12:\"order_number\";N;s:12:\"invoice_date\";s:10:\"2026-03-29\";s:8:\"due_date\";N;s:10:\"due_amount\";N;s:12:\"payment_date\";N;s:14:\"payment_amount\";s:5:\"10.00\";s:14:\"invoice_status\";s:10:\"Processing\";s:10:\"updated_at\";s:19:\"2026-03-29 06:56:37\";s:14:\"payment_method\";s:11:\"BKASH-BKash\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:14:\"payment_amount\";s:5:\"float\";s:10:\"due_amount\";s:5:\"float\";s:23:\"public_token_expires_at\";s:8:\"datetime\";s:23:\"public_token_revoked_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"order\";N;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:11:{i:0;s:12:\"invoice_date\";i:1;s:20:\"money_receipt_number\";i:2;s:8:\"due_date\";i:3;s:12:\"payment_date\";i:4;s:10:\"due_amount\";i:5;s:14:\"payment_amount\";i:6;s:7:\"remarks\";i:7;s:14:\"invoice_status\";i:8;s:12:\"public_token\";i:9;s:23:\"public_token_revoked_at\";i:10;s:23:\"public_token_expires_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}i:2;O:23:\"App\\Models\\Bill\\Invoice\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"invoices\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:12:{s:2:\"id\";i:8;s:14:\"invoice_number\";s:16:\"INV-202603-00007\";s:20:\"money_receipt_number\";N;s:12:\"order_number\";N;s:12:\"invoice_date\";s:10:\"2026-03-29\";s:8:\"due_date\";N;s:10:\"due_amount\";N;s:12:\"payment_date\";N;s:14:\"payment_amount\";s:5:\"10.00\";s:14:\"invoice_status\";s:10:\"Processing\";s:10:\"updated_at\";s:19:\"2026-03-29 06:31:26\";s:14:\"payment_method\";s:11:\"BKASH-BKash\";}s:11:\"\0*\0original\";a:12:{s:2:\"id\";i:8;s:14:\"invoice_number\";s:16:\"INV-202603-00007\";s:20:\"money_receipt_number\";N;s:12:\"order_number\";N;s:12:\"invoice_date\";s:10:\"2026-03-29\";s:8:\"due_date\";N;s:10:\"due_amount\";N;s:12:\"payment_date\";N;s:14:\"payment_amount\";s:5:\"10.00\";s:14:\"invoice_status\";s:10:\"Processing\";s:10:\"updated_at\";s:19:\"2026-03-29 06:31:26\";s:14:\"payment_method\";s:11:\"BKASH-BKash\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:14:\"payment_amount\";s:5:\"float\";s:10:\"due_amount\";s:5:\"float\";s:23:\"public_token_expires_at\";s:8:\"datetime\";s:23:\"public_token_revoked_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"order\";N;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:11:{i:0;s:12:\"invoice_date\";i:1;s:20:\"money_receipt_number\";i:2;s:8:\"due_date\";i:3;s:12:\"payment_date\";i:4;s:10:\"due_amount\";i:5;s:14:\"payment_amount\";i:6;s:7:\"remarks\";i:7;s:14:\"invoice_status\";i:8;s:12:\"public_token\";i:9;s:23:\"public_token_revoked_at\";i:10;s:23:\"public_token_expires_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}i:3;O:23:\"App\\Models\\Bill\\Invoice\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"invoices\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:12:{s:2:\"id\";i:7;s:14:\"invoice_number\";s:16:\"INV-202603-00006\";s:20:\"money_receipt_number\";N;s:12:\"order_number\";N;s:12:\"invoice_date\";s:10:\"2026-03-29\";s:8:\"due_date\";N;s:10:\"due_amount\";N;s:12:\"payment_date\";N;s:14:\"payment_amount\";s:5:\"10.00\";s:14:\"invoice_status\";s:10:\"Processing\";s:10:\"updated_at\";s:19:\"2026-03-29 06:24:21\";s:14:\"payment_method\";s:11:\"BKASH-BKash\";}s:11:\"\0*\0original\";a:12:{s:2:\"id\";i:7;s:14:\"invoice_number\";s:16:\"INV-202603-00006\";s:20:\"money_receipt_number\";N;s:12:\"order_number\";N;s:12:\"invoice_date\";s:10:\"2026-03-29\";s:8:\"due_date\";N;s:10:\"due_amount\";N;s:12:\"payment_date\";N;s:14:\"payment_amount\";s:5:\"10.00\";s:14:\"invoice_status\";s:10:\"Processing\";s:10:\"updated_at\";s:19:\"2026-03-29 06:24:21\";s:14:\"payment_method\";s:11:\"BKASH-BKash\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:14:\"payment_amount\";s:5:\"float\";s:10:\"due_amount\";s:5:\"float\";s:23:\"public_token_expires_at\";s:8:\"datetime\";s:23:\"public_token_revoked_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"order\";N;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:11:{i:0;s:12:\"invoice_date\";i:1;s:20:\"money_receipt_number\";i:2;s:8:\"due_date\";i:3;s:12:\"payment_date\";i:4;s:10:\"due_amount\";i:5;s:14:\"payment_amount\";i:6;s:7:\"remarks\";i:7;s:14:\"invoice_status\";i:8;s:12:\"public_token\";i:9;s:23:\"public_token_revoked_at\";i:10;s:23:\"public_token_expires_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}i:4;O:23:\"App\\Models\\Bill\\Invoice\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"invoices\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:12:{s:2:\"id\";i:6;s:14:\"invoice_number\";s:16:\"INV-202603-00005\";s:20:\"money_receipt_number\";N;s:12:\"order_number\";N;s:12:\"invoice_date\";s:10:\"2026-03-29\";s:8:\"due_date\";N;s:10:\"due_amount\";N;s:12:\"payment_date\";N;s:14:\"payment_amount\";s:5:\"10.00\";s:14:\"invoice_status\";s:10:\"Processing\";s:10:\"updated_at\";s:19:\"2026-03-29 06:14:57\";s:14:\"payment_method\";s:11:\"BKASH-BKash\";}s:11:\"\0*\0original\";a:12:{s:2:\"id\";i:6;s:14:\"invoice_number\";s:16:\"INV-202603-00005\";s:20:\"money_receipt_number\";N;s:12:\"order_number\";N;s:12:\"invoice_date\";s:10:\"2026-03-29\";s:8:\"due_date\";N;s:10:\"due_amount\";N;s:12:\"payment_date\";N;s:14:\"payment_amount\";s:5:\"10.00\";s:14:\"invoice_status\";s:10:\"Processing\";s:10:\"updated_at\";s:19:\"2026-03-29 06:14:57\";s:14:\"payment_method\";s:11:\"BKASH-BKash\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:14:\"payment_amount\";s:5:\"float\";s:10:\"due_amount\";s:5:\"float\";s:23:\"public_token_expires_at\";s:8:\"datetime\";s:23:\"public_token_revoked_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"order\";N;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:11:{i:0;s:12:\"invoice_date\";i:1;s:20:\"money_receipt_number\";i:2;s:8:\"due_date\";i:3;s:12:\"payment_date\";i:4;s:10:\"due_amount\";i:5;s:14:\"payment_amount\";i:6;s:7:\"remarks\";i:7;s:14:\"invoice_status\";i:8;s:12:\"public_token\";i:9;s:23:\"public_token_revoked_at\";i:10;s:23:\"public_token_expires_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}i:5;O:23:\"App\\Models\\Bill\\Invoice\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"invoices\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:12:{s:2:\"id\";i:5;s:14:\"invoice_number\";s:16:\"INV-202603-00004\";s:20:\"money_receipt_number\";N;s:12:\"order_number\";N;s:12:\"invoice_date\";s:10:\"2026-03-29\";s:8:\"due_date\";N;s:10:\"due_amount\";N;s:12:\"payment_date\";N;s:14:\"payment_amount\";s:5:\"10.00\";s:14:\"invoice_status\";s:10:\"Processing\";s:10:\"updated_at\";s:19:\"2026-03-29 06:12:51\";s:14:\"payment_method\";s:11:\"BKASH-BKash\";}s:11:\"\0*\0original\";a:12:{s:2:\"id\";i:5;s:14:\"invoice_number\";s:16:\"INV-202603-00004\";s:20:\"money_receipt_number\";N;s:12:\"order_number\";N;s:12:\"invoice_date\";s:10:\"2026-03-29\";s:8:\"due_date\";N;s:10:\"due_amount\";N;s:12:\"payment_date\";N;s:14:\"payment_amount\";s:5:\"10.00\";s:14:\"invoice_status\";s:10:\"Processing\";s:10:\"updated_at\";s:19:\"2026-03-29 06:12:51\";s:14:\"payment_method\";s:11:\"BKASH-BKash\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:14:\"payment_amount\";s:5:\"float\";s:10:\"due_amount\";s:5:\"float\";s:23:\"public_token_expires_at\";s:8:\"datetime\";s:23:\"public_token_revoked_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"order\";N;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:11:{i:0;s:12:\"invoice_date\";i:1;s:20:\"money_receipt_number\";i:2;s:8:\"due_date\";i:3;s:12:\"payment_date\";i:4;s:10:\"due_amount\";i:5;s:14:\"payment_amount\";i:6;s:7:\"remarks\";i:7;s:14:\"invoice_status\";i:8;s:12:\"public_token\";i:9;s:23:\"public_token_revoked_at\";i:10;s:23:\"public_token_expires_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}i:6;O:23:\"App\\Models\\Bill\\Invoice\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"invoices\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:12:{s:2:\"id\";i:4;s:14:\"invoice_number\";s:16:\"INV-202603-00003\";s:20:\"money_receipt_number\";N;s:12:\"order_number\";N;s:12:\"invoice_date\";s:10:\"2026-03-28\";s:8:\"due_date\";N;s:10:\"due_amount\";N;s:12:\"payment_date\";N;s:14:\"payment_amount\";s:5:\"10.00\";s:14:\"invoice_status\";s:10:\"Processing\";s:10:\"updated_at\";s:19:\"2026-03-28 13:03:28\";s:14:\"payment_method\";s:11:\"BKASH-BKash\";}s:11:\"\0*\0original\";a:12:{s:2:\"id\";i:4;s:14:\"invoice_number\";s:16:\"INV-202603-00003\";s:20:\"money_receipt_number\";N;s:12:\"order_number\";N;s:12:\"invoice_date\";s:10:\"2026-03-28\";s:8:\"due_date\";N;s:10:\"due_amount\";N;s:12:\"payment_date\";N;s:14:\"payment_amount\";s:5:\"10.00\";s:14:\"invoice_status\";s:10:\"Processing\";s:10:\"updated_at\";s:19:\"2026-03-28 13:03:28\";s:14:\"payment_method\";s:11:\"BKASH-BKash\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:14:\"payment_amount\";s:5:\"float\";s:10:\"due_amount\";s:5:\"float\";s:23:\"public_token_expires_at\";s:8:\"datetime\";s:23:\"public_token_revoked_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"order\";N;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:11:{i:0;s:12:\"invoice_date\";i:1;s:20:\"money_receipt_number\";i:2;s:8:\"due_date\";i:3;s:12:\"payment_date\";i:4;s:10:\"due_amount\";i:5;s:14:\"payment_amount\";i:6;s:7:\"remarks\";i:7;s:14:\"invoice_status\";i:8;s:12:\"public_token\";i:9;s:23:\"public_token_revoked_at\";i:10;s:23:\"public_token_expires_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}i:7;O:23:\"App\\Models\\Bill\\Invoice\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"invoices\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:12:{s:2:\"id\";i:3;s:14:\"invoice_number\";s:16:\"INV-202603-00002\";s:20:\"money_receipt_number\";s:8:\"202603-2\";s:12:\"order_number\";s:16:\"ORD-202603-00002\";s:12:\"invoice_date\";s:10:\"2026-03-14\";s:8:\"due_date\";s:10:\"2026-03-14\";s:10:\"due_amount\";s:6:\"190.00\";s:12:\"payment_date\";s:10:\"2026-03-14\";s:14:\"payment_amount\";s:5:\"10.00\";s:14:\"invoice_status\";s:10:\"Processing\";s:10:\"updated_at\";s:19:\"2026-03-14 17:40:48\";s:14:\"payment_method\";s:11:\"BKASH-BKash\";}s:11:\"\0*\0original\";a:12:{s:2:\"id\";i:3;s:14:\"invoice_number\";s:16:\"INV-202603-00002\";s:20:\"money_receipt_number\";s:8:\"202603-2\";s:12:\"order_number\";s:16:\"ORD-202603-00002\";s:12:\"invoice_date\";s:10:\"2026-03-14\";s:8:\"due_date\";s:10:\"2026-03-14\";s:10:\"due_amount\";s:6:\"190.00\";s:12:\"payment_date\";s:10:\"2026-03-14\";s:14:\"payment_amount\";s:5:\"10.00\";s:14:\"invoice_status\";s:10:\"Processing\";s:10:\"updated_at\";s:19:\"2026-03-14 17:40:48\";s:14:\"payment_method\";s:11:\"BKASH-BKash\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:14:\"payment_amount\";s:5:\"float\";s:10:\"due_amount\";s:5:\"float\";s:23:\"public_token_expires_at\";s:8:\"datetime\";s:23:\"public_token_revoked_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"order\";O:24:\"App\\Models\\Service\\Order\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"orders\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:2:\"id\";i:3;s:12:\"order_number\";s:16:\"ORD-202603-00002\";s:9:\"client_id\";i:1;s:17:\"contracted_amount\";s:6:\"200.00\";s:11:\"paid_amount\";s:5:\"10.00\";s:10:\"due_amount\";s:6:\"190.00\";s:5:\"notes\";N;s:10:\"created_at\";s:19:\"2026-03-14 17:23:31\";s:10:\"updated_at\";s:19:\"2026-03-14 17:40:48\";}s:11:\"\0*\0original\";a:9:{s:2:\"id\";i:3;s:12:\"order_number\";s:16:\"ORD-202603-00002\";s:9:\"client_id\";i:1;s:17:\"contracted_amount\";s:6:\"200.00\";s:11:\"paid_amount\";s:5:\"10.00\";s:10:\"due_amount\";s:6:\"190.00\";s:5:\"notes\";N;s:10:\"created_at\";s:19:\"2026-03-14 17:23:31\";s:10:\"updated_at\";s:19:\"2026-03-14 17:40:48\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"client\";O:22:\"App\\Models\\User\\Client\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"clients\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:1;s:4:\"name\";s:14:\"Anonymous User\";s:5:\"email\";s:21:\"backup25gb1@gmail.com\";s:7:\"address\";N;s:4:\"city\";N;s:5:\"state\";N;s:3:\"zip\";N;s:7:\"country\";N;s:5:\"phone\";s:11:\"01821144599\";s:15:\"phone_secondary\";N;s:12:\"company_name\";s:14:\"Anonymous User\";s:15:\"company_address\";N;s:10:\"concern_id\";i:2;s:7:\"user_id\";i:8;s:10:\"created_at\";s:19:\"2026-03-14 10:47:20\";s:10:\"updated_at\";s:19:\"2026-03-14 17:31:23\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:1;s:4:\"name\";s:14:\"Anonymous User\";s:5:\"email\";s:21:\"backup25gb1@gmail.com\";s:7:\"address\";N;s:4:\"city\";N;s:5:\"state\";N;s:3:\"zip\";N;s:7:\"country\";N;s:5:\"phone\";s:11:\"01821144599\";s:15:\"phone_secondary\";N;s:12:\"company_name\";s:14:\"Anonymous User\";s:15:\"company_address\";N;s:10:\"concern_id\";i:2;s:7:\"user_id\";i:8;s:10:\"created_at\";s:19:\"2026-03-14 10:47:20\";s:10:\"updated_at\";s:19:\"2026-03-14 17:31:23\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:7:\"concern\";O:25:\"App\\Models\\Config\\Concern\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"concerns\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:4:{s:2:\"id\";i:2;s:4:\"name\";s:10:\"Hotel Jana\";s:10:\"created_at\";s:19:\"2026-02-10 12:24:01\";s:10:\"updated_at\";s:19:\"2026-02-10 12:24:01\";}s:11:\"\0*\0original\";a:4:{s:2:\"id\";i:2;s:4:\"name\";s:10:\"Hotel Jana\";s:10:\"created_at\";s:19:\"2026-02-10 12:24:01\";s:10:\"updated_at\";s:19:\"2026-02-10 12:24:01\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:1:{i:0;s:4:\"name\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:12:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:7:\"address\";i:3;s:4:\"city\";i:4;s:5:\"state\";i:5;s:3:\"zip\";i:6;s:7:\"country\";i:7;s:5:\"phone\";i:8;s:12:\"company_name\";i:9;s:15:\"company_address\";i:10;s:10:\"concern_id\";i:11;s:7:\"user_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}s:9:\"shareform\";O:28:\"App\\Models\\Service\\Shareform\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"shareforms\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:42:{s:2:\"id\";i:7;s:12:\"share_number\";s:7:\"ZD68A38\";s:4:\"name\";s:11:\"Sample Name\";s:9:\"gender_id\";i:1;s:11:\"father_name\";s:11:\"Sample Name\";s:11:\"mother_name\";s:11:\"Sample Name\";s:15:\"present_address\";s:11:\"Sample Name\";s:17:\"permanent_address\";N;s:11:\"spouse_name\";N;s:6:\"mobile\";s:11:\"01888888888\";s:3:\"nid\";N;s:11:\"religion_id\";i:1;s:3:\"dob\";N;s:10:\"profession\";N;s:5:\"email\";N;s:3:\"dom\";N;s:10:\"service_id\";i:5;s:18:\"ownership_category\";N;s:16:\"ownership_number\";i:1;s:4:\"size\";i:19;s:15:\"ownership_price\";d:200;s:16:\"special_discount\";N;s:16:\"contracted_price\";d:200;s:12:\"total_amount\";d:200;s:16:\"paymentmethod_id\";i:3;s:13:\"booking_money\";N;s:18:\"booking_money_date\";N;s:12:\"down_payment\";N;s:17:\"down_payment_date\";N;s:14:\"rest_amount_by\";N;s:12:\"installments\";N;s:17:\"installments_date\";N;s:19:\"payment_instruction\";N;s:9:\"nominee_1\";s:11:\"Sample Name\";s:9:\"nominee_2\";N;s:15:\"nominee_address\";N;s:14:\"nominee_mobile\";N;s:6:\"status\";i:1;s:8:\"order_id\";i:3;s:16:\"sales_officer_id\";i:5;s:10:\"created_at\";s:19:\"2026-03-14 17:22:14\";s:10:\"updated_at\";s:19:\"2026-03-14 17:23:31\";}s:11:\"\0*\0original\";a:42:{s:2:\"id\";i:7;s:12:\"share_number\";s:7:\"ZD68A38\";s:4:\"name\";s:11:\"Sample Name\";s:9:\"gender_id\";i:1;s:11:\"father_name\";s:11:\"Sample Name\";s:11:\"mother_name\";s:11:\"Sample Name\";s:15:\"present_address\";s:11:\"Sample Name\";s:17:\"permanent_address\";N;s:11:\"spouse_name\";N;s:6:\"mobile\";s:11:\"01888888888\";s:3:\"nid\";N;s:11:\"religion_id\";i:1;s:3:\"dob\";N;s:10:\"profession\";N;s:5:\"email\";N;s:3:\"dom\";N;s:10:\"service_id\";i:5;s:18:\"ownership_category\";N;s:16:\"ownership_number\";i:1;s:4:\"size\";i:19;s:15:\"ownership_price\";d:200;s:16:\"special_discount\";N;s:16:\"contracted_price\";d:200;s:12:\"total_amount\";d:200;s:16:\"paymentmethod_id\";i:3;s:13:\"booking_money\";N;s:18:\"booking_money_date\";N;s:12:\"down_payment\";N;s:17:\"down_payment_date\";N;s:14:\"rest_amount_by\";N;s:12:\"installments\";N;s:17:\"installments_date\";N;s:19:\"payment_instruction\";N;s:9:\"nominee_1\";s:11:\"Sample Name\";s:9:\"nominee_2\";N;s:15:\"nominee_address\";N;s:14:\"nominee_mobile\";N;s:6:\"status\";i:1;s:8:\"order_id\";i:3;s:16:\"sales_officer_id\";i:5;s:10:\"created_at\";s:19:\"2026-03-14 17:22:14\";s:10:\"updated_at\";s:19:\"2026-03-14 17:23:31\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:12:\"salesOfficer\";O:30:\"App\\Models\\Config\\SalesOfficer\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:14:\"sales_officers\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:5;s:4:\"name\";s:15:\"Sales Officer 2\";s:5:\"email\";s:17:\"sample@client.com\";s:11:\"designation\";s:7:\"Manager\";s:10:\"created_at\";s:19:\"2026-03-14 01:27:18\";s:10:\"updated_at\";s:19:\"2026-03-14 01:27:18\";}s:11:\"\0*\0original\";a:6:{s:2:\"id\";i:5;s:4:\"name\";s:15:\"Sales Officer 2\";s:5:\"email\";s:17:\"sample@client.com\";s:11:\"designation\";s:7:\"Manager\";s:10:\"created_at\";s:19:\"2026-03-14 01:27:18\";s:10:\"updated_at\";s:19:\"2026-03-14 01:27:18\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:4:\"name\";i:1;s:11:\"designation\";i:2;s:5:\"email\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:38:{i:0;s:4:\"name\";i:1;s:9:\"gender_id\";i:2;s:11:\"father_name\";i:3;s:11:\"mother_name\";i:4;s:15:\"present_address\";i:5;s:17:\"permanent_address\";i:6;s:11:\"spouse_name\";i:7;s:6:\"mobile\";i:8;s:3:\"nid\";i:9;s:11:\"religion_id\";i:10;s:3:\"dob\";i:11;s:10:\"profession\";i:12;s:5:\"email\";i:13;s:3:\"dom\";i:14;s:10:\"service_id\";i:15;s:18:\"ownership_category\";i:16;s:16:\"ownership_number\";i:17;s:4:\"size\";i:18;s:15:\"ownership_price\";i:19;s:16:\"special_discount\";i:20;s:16:\"contracted_price\";i:21;s:12:\"total_amount\";i:22;s:21:\"contracted_price_word\";i:23;s:16:\"paymentmethod_id\";i:24;s:13:\"booking_money\";i:25;s:18:\"booking_money_date\";i:26;s:12:\"down_payment\";i:27;s:17:\"down_payment_date\";i:28;s:14:\"rest_amount_by\";i:29;s:12:\"installments\";i:30;s:17:\"installments_date\";i:31;s:19:\"payment_instruction\";i:32;s:9:\"nominee_1\";i:33;s:9:\"nominee_2\";i:34;s:15:\"nominee_address\";i:35;s:14:\"nominee_mobile\";i:36;s:6:\"status\";i:37;s:16:\"sales_officer_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:12:\"order_number\";i:1;s:17:\"contracted_amount\";i:2;s:10:\"due_amount\";i:3;s:11:\"paid_amount\";i:4;s:5:\"notes\";i:5;s:8:\"share_id\";i:6;s:16:\"sales_officer_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:11:{i:0;s:12:\"invoice_date\";i:1;s:20:\"money_receipt_number\";i:2;s:8:\"due_date\";i:3;s:12:\"payment_date\";i:4;s:10:\"due_amount\";i:5;s:14:\"payment_amount\";i:6;s:7:\"remarks\";i:7;s:14:\"invoice_status\";i:8;s:12:\"public_token\";i:9;s:23:\"public_token_revoked_at\";i:10;s:23:\"public_token_expires_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1774789270),
('opticore-solutions-limited-cache-pending-invoices', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1774789270),
('opticore-solutions-limited-cache-services', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:2:{i:0;O:25:\"App\\Models\\Config\\Service\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"services\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:5;s:4:\"name\";s:41:\"Hotel Jana The Dove - Cox\'s Bazar (Share)\";s:11:\"description\";s:22:\"Hotel Jana Cox\'s Bazar\";s:10:\"concern_id\";i:2;s:10:\"created_at\";s:19:\"2026-03-14 01:26:35\";s:10:\"updated_at\";s:19:\"2026-03-14 01:26:35\";}s:11:\"\0*\0original\";a:6:{s:2:\"id\";i:5;s:4:\"name\";s:41:\"Hotel Jana The Dove - Cox\'s Bazar (Share)\";s:11:\"description\";s:22:\"Hotel Jana Cox\'s Bazar\";s:10:\"concern_id\";i:2;s:10:\"created_at\";s:19:\"2026-03-14 01:26:35\";s:10:\"updated_at\";s:19:\"2026-03-14 01:26:35\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:7:\"concern\";O:25:\"App\\Models\\Config\\Concern\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"concerns\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:4:{s:2:\"id\";i:2;s:4:\"name\";s:10:\"Hotel Jana\";s:10:\"created_at\";s:19:\"2026-02-10 12:24:01\";s:10:\"updated_at\";s:19:\"2026-02-10 12:24:01\";}s:11:\"\0*\0original\";a:4:{s:2:\"id\";i:2;s:4:\"name\";s:10:\"Hotel Jana\";s:10:\"created_at\";s:19:\"2026-02-10 12:24:01\";s:10:\"updated_at\";s:19:\"2026-02-10 12:24:01\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:1:{i:0;s:4:\"name\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:4:\"name\";i:1;s:11:\"description\";i:2;s:10:\"concern_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}i:1;O:25:\"App\\Models\\Config\\Service\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"services\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:4;s:4:\"name\";s:28:\"Hotel Jana - Kuakata (Share)\";s:11:\"description\";s:18:\"Hotel Jana Kuakata\";s:10:\"concern_id\";i:2;s:10:\"created_at\";s:19:\"2026-03-14 01:25:53\";s:10:\"updated_at\";s:19:\"2026-03-14 01:25:53\";}s:11:\"\0*\0original\";a:6:{s:2:\"id\";i:4;s:4:\"name\";s:28:\"Hotel Jana - Kuakata (Share)\";s:11:\"description\";s:18:\"Hotel Jana Kuakata\";s:10:\"concern_id\";i:2;s:10:\"created_at\";s:19:\"2026-03-14 01:25:53\";s:10:\"updated_at\";s:19:\"2026-03-14 01:25:53\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:7:\"concern\";r:40;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:4:\"name\";i:1;s:11:\"description\";i:2;s:10:\"concern_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1773490808),
('opticore-solutions-limited-cache-shareform-list', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;O:28:\"App\\Models\\Service\\Shareform\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"shareforms\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:7;s:12:\"share_number\";s:7:\"ZD68A38\";s:4:\"name\";s:11:\"Sample Name\";s:6:\"mobile\";s:11:\"01888888888\";s:16:\"ownership_number\";i:1;s:6:\"status\";i:1;s:12:\"total_amount\";d:200;s:10:\"created_at\";s:19:\"2026-03-14 17:22:14\";s:16:\"sales_officer_id\";i:5;s:8:\"order_id\";i:3;s:10:\"service_id\";i:5;}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:7;s:12:\"share_number\";s:7:\"ZD68A38\";s:4:\"name\";s:11:\"Sample Name\";s:6:\"mobile\";s:11:\"01888888888\";s:16:\"ownership_number\";i:1;s:6:\"status\";i:1;s:12:\"total_amount\";d:200;s:10:\"created_at\";s:19:\"2026-03-14 17:22:14\";s:16:\"sales_officer_id\";i:5;s:8:\"order_id\";i:3;s:10:\"service_id\";i:5;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:5:\"order\";O:24:\"App\\Models\\Service\\Order\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:6:\"orders\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:2:\"id\";i:3;s:12:\"order_number\";s:16:\"ORD-202603-00002\";s:9:\"client_id\";i:1;s:17:\"contracted_amount\";s:6:\"200.00\";s:11:\"paid_amount\";s:4:\"0.00\";s:10:\"due_amount\";s:6:\"200.00\";s:5:\"notes\";N;s:10:\"created_at\";s:19:\"2026-03-14 17:23:31\";s:10:\"updated_at\";s:19:\"2026-03-14 17:23:31\";}s:11:\"\0*\0original\";a:9:{s:2:\"id\";i:3;s:12:\"order_number\";s:16:\"ORD-202603-00002\";s:9:\"client_id\";i:1;s:17:\"contracted_amount\";s:6:\"200.00\";s:11:\"paid_amount\";s:4:\"0.00\";s:10:\"due_amount\";s:6:\"200.00\";s:5:\"notes\";N;s:10:\"created_at\";s:19:\"2026-03-14 17:23:31\";s:10:\"updated_at\";s:19:\"2026-03-14 17:23:31\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:6:\"client\";O:22:\"App\\Models\\User\\Client\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"clients\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:1;s:4:\"name\";s:14:\"Anonymous User\";s:5:\"email\";s:21:\"backup25gb1@gmail.com\";s:7:\"address\";N;s:4:\"city\";N;s:5:\"state\";N;s:3:\"zip\";N;s:7:\"country\";N;s:5:\"phone\";N;s:15:\"phone_secondary\";N;s:12:\"company_name\";N;s:15:\"company_address\";N;s:10:\"concern_id\";i:2;s:7:\"user_id\";i:8;s:10:\"created_at\";s:19:\"2026-03-14 10:47:20\";s:10:\"updated_at\";s:19:\"2026-03-14 10:47:20\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:1;s:4:\"name\";s:14:\"Anonymous User\";s:5:\"email\";s:21:\"backup25gb1@gmail.com\";s:7:\"address\";N;s:4:\"city\";N;s:5:\"state\";N;s:3:\"zip\";N;s:7:\"country\";N;s:5:\"phone\";N;s:15:\"phone_secondary\";N;s:12:\"company_name\";N;s:15:\"company_address\";N;s:10:\"concern_id\";i:2;s:7:\"user_id\";i:8;s:10:\"created_at\";s:19:\"2026-03-14 10:47:20\";s:10:\"updated_at\";s:19:\"2026-03-14 10:47:20\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:12:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:7:\"address\";i:3;s:4:\"city\";i:4;s:5:\"state\";i:5;s:3:\"zip\";i:6;s:7:\"country\";i:7;s:5:\"phone\";i:8;s:12:\"company_name\";i:9;s:15:\"company_address\";i:10;s:10:\"concern_id\";i:11;s:7:\"user_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:12:\"order_number\";i:1;s:17:\"contracted_amount\";i:2;s:10:\"due_amount\";i:3;s:11:\"paid_amount\";i:4;s:5:\"notes\";i:5;s:8:\"share_id\";i:6;s:16:\"sales_officer_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}s:12:\"salesOfficer\";O:30:\"App\\Models\\Config\\SalesOfficer\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:14:\"sales_officers\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:5;s:4:\"name\";s:15:\"Sales Officer 2\";s:5:\"email\";s:17:\"sample@client.com\";s:11:\"designation\";s:7:\"Manager\";s:10:\"created_at\";s:19:\"2026-03-14 01:27:18\";s:10:\"updated_at\";s:19:\"2026-03-14 01:27:18\";}s:11:\"\0*\0original\";a:6:{s:2:\"id\";i:5;s:4:\"name\";s:15:\"Sales Officer 2\";s:5:\"email\";s:17:\"sample@client.com\";s:11:\"designation\";s:7:\"Manager\";s:10:\"created_at\";s:19:\"2026-03-14 01:27:18\";s:10:\"updated_at\";s:19:\"2026-03-14 01:27:18\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:4:\"name\";i:1;s:11:\"designation\";i:2;s:5:\"email\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}s:7:\"service\";O:25:\"App\\Models\\Config\\Service\":35:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"services\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:5;s:4:\"name\";s:41:\"Hotel Jana The Dove - Cox\'s Bazar (Share)\";s:11:\"description\";s:22:\"Hotel Jana Cox\'s Bazar\";s:10:\"concern_id\";i:2;s:10:\"created_at\";s:19:\"2026-03-14 01:26:35\";s:10:\"updated_at\";s:19:\"2026-03-14 01:26:35\";}s:11:\"\0*\0original\";a:6:{s:2:\"id\";i:5;s:4:\"name\";s:41:\"Hotel Jana The Dove - Cox\'s Bazar (Share)\";s:11:\"description\";s:22:\"Hotel Jana Cox\'s Bazar\";s:10:\"concern_id\";i:2;s:10:\"created_at\";s:19:\"2026-03-14 01:26:35\";s:10:\"updated_at\";s:19:\"2026-03-14 01:26:35\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:4:\"name\";i:1;s:11:\"description\";i:2;s:10:\"concern_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0oldAttributes\";a:0:{}s:25:\"enableLoggingModelsEvents\";b:1;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:38:{i:0;s:4:\"name\";i:1;s:9:\"gender_id\";i:2;s:11:\"father_name\";i:3;s:11:\"mother_name\";i:4;s:15:\"present_address\";i:5;s:17:\"permanent_address\";i:6;s:11:\"spouse_name\";i:7;s:6:\"mobile\";i:8;s:3:\"nid\";i:9;s:11:\"religion_id\";i:10;s:3:\"dob\";i:11;s:10:\"profession\";i:12;s:5:\"email\";i:13;s:3:\"dom\";i:14;s:10:\"service_id\";i:15;s:18:\"ownership_category\";i:16;s:16:\"ownership_number\";i:17;s:4:\"size\";i:18;s:15:\"ownership_price\";i:19;s:16:\"special_discount\";i:20;s:16:\"contracted_price\";i:21;s:12:\"total_amount\";i:22;s:21:\"contracted_price_word\";i:23;s:16:\"paymentmethod_id\";i:24;s:13:\"booking_money\";i:25;s:18:\"booking_money_date\";i:26;s:12:\"down_payment\";i:27;s:17:\"down_payment_date\";i:28;s:14:\"rest_amount_by\";i:29;s:12:\"installments\";i:30;s:17:\"installments_date\";i:31;s:19:\"payment_instruction\";i:32;s:9:\"nominee_1\";i:33;s:9:\"nominee_2\";i:34;s:15:\"nominee_address\";i:35;s:14:\"nominee_mobile\";i:36;s:6:\"status\";i:37;s:16:\"sales_officer_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1773491063);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('opticore-solutions-limited-cache-transactions', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:7:{i:0;O:27:\"App\\Models\\Bill\\Transaction\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"transactions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:37:{s:2:\"id\";i:10;s:4:\"name\";s:13:\"Rashed Bishal\";s:5:\"email\";s:21:\"backup25gb1@gmail.com\";s:5:\"phone\";s:11:\"01821144599\";s:7:\"address\";s:5:\"Dhaka\";s:14:\"invoice_number\";s:16:\"INV-202603-00008\";s:14:\"transaction_id\";s:17:\"TRX-DUGSPLKFU0LMS\";s:22:\"gateway_transaction_id\";N;s:6:\"val_id\";s:27:\"260329125637171951343496205\";s:6:\"amount\";s:5:\"10.00\";s:9:\"card_type\";s:11:\"BKASH-BKash\";s:12:\"store_amount\";s:4:\"9.75\";s:7:\"card_no\";s:12:\"KXDCT7KYUXH3\";s:12:\"bank_tran_id\";s:20:\"BGT23712026032982092\";s:6:\"status\";s:10:\"Processing\";s:9:\"tran_date\";s:19:\"2026-03-29 12:56:10\";s:5:\"error\";N;s:8:\"currency\";s:3:\"BDT\";s:11:\"card_issuer\";s:20:\"BKash Mobile Banking\";s:10:\"card_brand\";s:13:\"MOBILEBANKING\";s:14:\"card_sub_brand\";s:2:\"MB\";s:19:\"card_issuer_country\";s:10:\"Bangladesh\";s:24:\"card_issuer_country_code\";s:2:\"BD\";s:8:\"store_id\";s:27:\"alliancebuildersltdorg0live\";s:11:\"verify_sign\";s:32:\"369273526a728e0ef58a5c69746a7d9e\";s:16:\"verify_sign_sha2\";s:64:\"57413f3bbaf8735c67b88bc0725cbd915ef58d06d33720f4c6f1cdc198ba02f5\";s:13:\"currency_type\";s:3:\"BDT\";s:15:\"currency_amount\";s:5:\"10.00\";s:13:\"currency_rate\";s:6:\"1.0000\";s:9:\"base_fair\";s:4:\"0.00\";s:15:\"subscription_id\";N;s:10:\"risk_level\";s:1:\"0\";s:10:\"risk_title\";s:4:\"Safe\";s:13:\"cl_identifier\";N;s:13:\"cn_identifier\";s:1:\"2\";s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2026-03-29 06:56:37\";}s:11:\"\0*\0original\";a:37:{s:2:\"id\";i:10;s:4:\"name\";s:13:\"Rashed Bishal\";s:5:\"email\";s:21:\"backup25gb1@gmail.com\";s:5:\"phone\";s:11:\"01821144599\";s:7:\"address\";s:5:\"Dhaka\";s:14:\"invoice_number\";s:16:\"INV-202603-00008\";s:14:\"transaction_id\";s:17:\"TRX-DUGSPLKFU0LMS\";s:22:\"gateway_transaction_id\";N;s:6:\"val_id\";s:27:\"260329125637171951343496205\";s:6:\"amount\";s:5:\"10.00\";s:9:\"card_type\";s:11:\"BKASH-BKash\";s:12:\"store_amount\";s:4:\"9.75\";s:7:\"card_no\";s:12:\"KXDCT7KYUXH3\";s:12:\"bank_tran_id\";s:20:\"BGT23712026032982092\";s:6:\"status\";s:10:\"Processing\";s:9:\"tran_date\";s:19:\"2026-03-29 12:56:10\";s:5:\"error\";N;s:8:\"currency\";s:3:\"BDT\";s:11:\"card_issuer\";s:20:\"BKash Mobile Banking\";s:10:\"card_brand\";s:13:\"MOBILEBANKING\";s:14:\"card_sub_brand\";s:2:\"MB\";s:19:\"card_issuer_country\";s:10:\"Bangladesh\";s:24:\"card_issuer_country_code\";s:2:\"BD\";s:8:\"store_id\";s:27:\"alliancebuildersltdorg0live\";s:11:\"verify_sign\";s:32:\"369273526a728e0ef58a5c69746a7d9e\";s:16:\"verify_sign_sha2\";s:64:\"57413f3bbaf8735c67b88bc0725cbd915ef58d06d33720f4c6f1cdc198ba02f5\";s:13:\"currency_type\";s:3:\"BDT\";s:15:\"currency_amount\";s:5:\"10.00\";s:13:\"currency_rate\";s:6:\"1.0000\";s:9:\"base_fair\";s:4:\"0.00\";s:15:\"subscription_id\";N;s:10:\"risk_level\";s:1:\"0\";s:10:\"risk_title\";s:4:\"Safe\";s:13:\"cl_identifier\";N;s:13:\"cn_identifier\";s:1:\"2\";s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2026-03-29 06:56:37\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:34:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:5:\"phone\";i:3;s:7:\"address\";i:4;s:14:\"invoice_number\";i:5;s:14:\"transaction_id\";i:6;s:7:\"tran_id\";i:7;s:6:\"val_id\";i:8;s:6:\"amount\";i:9;s:9:\"card_type\";i:10;s:12:\"store_amount\";i:11;s:7:\"card_no\";i:12;s:12:\"bank_tran_id\";i:13;s:6:\"status\";i:14;s:9:\"tran_date\";i:15;s:5:\"error\";i:16;s:8:\"currency\";i:17;s:11:\"card_issuer\";i:18;s:10:\"card_brand\";i:19;s:14:\"card_sub_brand\";i:20;s:19:\"card_issuer_country\";i:21;s:24:\"card_issuer_country_code\";i:22;s:8:\"store_id\";i:23;s:11:\"verify_sign\";i:24;s:16:\"verify_sign_sha2\";i:25;s:13:\"currency_type\";i:26;s:15:\"currency_amount\";i:27;s:13:\"currency_rate\";i:28;s:9:\"base_fair\";i:29;s:15:\"subscription_id\";i:30;s:10:\"risk_level\";i:31;s:10:\"risk_title\";i:32;s:13:\"cl_identifier\";i:33;s:13:\"cn_identifier\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:27:\"App\\Models\\Bill\\Transaction\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"transactions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:37:{s:2:\"id\";i:9;s:4:\"name\";s:13:\"Rashed Bishal\";s:5:\"email\";s:21:\"backup25gb1@gmail.com\";s:5:\"phone\";s:11:\"01821144599\";s:7:\"address\";s:5:\"Dhaka\";s:14:\"invoice_number\";s:16:\"INV-202603-00007\";s:14:\"transaction_id\";s:17:\"TRX-UI501EBXIJD4N\";s:22:\"gateway_transaction_id\";N;s:6:\"val_id\";s:27:\"26032912312580304079669394d\";s:6:\"amount\";s:5:\"10.00\";s:9:\"card_type\";s:11:\"BKASH-BKash\";s:12:\"store_amount\";s:4:\"9.75\";s:7:\"card_no\";s:12:\"KXDCT8KXOXLC\";s:12:\"bank_tran_id\";s:20:\"BGT18772026032975899\";s:6:\"status\";s:10:\"Processing\";s:9:\"tran_date\";s:19:\"2026-03-29 12:30:46\";s:5:\"error\";N;s:8:\"currency\";s:3:\"BDT\";s:11:\"card_issuer\";s:20:\"BKash Mobile Banking\";s:10:\"card_brand\";s:13:\"MOBILEBANKING\";s:14:\"card_sub_brand\";s:2:\"MB\";s:19:\"card_issuer_country\";s:10:\"Bangladesh\";s:24:\"card_issuer_country_code\";s:2:\"BD\";s:8:\"store_id\";s:27:\"alliancebuildersltdorg0live\";s:11:\"verify_sign\";s:32:\"646f71acfcc9f30f9e31516d5443b56d\";s:16:\"verify_sign_sha2\";s:64:\"4b4a3342cf15daf61e1384d08a36fe47e13bf7ada5cc587b9b340349e720656c\";s:13:\"currency_type\";s:3:\"BDT\";s:15:\"currency_amount\";s:5:\"10.00\";s:13:\"currency_rate\";s:6:\"1.0000\";s:9:\"base_fair\";s:4:\"0.00\";s:15:\"subscription_id\";N;s:10:\"risk_level\";s:1:\"0\";s:10:\"risk_title\";s:4:\"Safe\";s:13:\"cl_identifier\";N;s:13:\"cn_identifier\";s:1:\"2\";s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2026-03-29 06:31:26\";}s:11:\"\0*\0original\";a:37:{s:2:\"id\";i:9;s:4:\"name\";s:13:\"Rashed Bishal\";s:5:\"email\";s:21:\"backup25gb1@gmail.com\";s:5:\"phone\";s:11:\"01821144599\";s:7:\"address\";s:5:\"Dhaka\";s:14:\"invoice_number\";s:16:\"INV-202603-00007\";s:14:\"transaction_id\";s:17:\"TRX-UI501EBXIJD4N\";s:22:\"gateway_transaction_id\";N;s:6:\"val_id\";s:27:\"26032912312580304079669394d\";s:6:\"amount\";s:5:\"10.00\";s:9:\"card_type\";s:11:\"BKASH-BKash\";s:12:\"store_amount\";s:4:\"9.75\";s:7:\"card_no\";s:12:\"KXDCT8KXOXLC\";s:12:\"bank_tran_id\";s:20:\"BGT18772026032975899\";s:6:\"status\";s:10:\"Processing\";s:9:\"tran_date\";s:19:\"2026-03-29 12:30:46\";s:5:\"error\";N;s:8:\"currency\";s:3:\"BDT\";s:11:\"card_issuer\";s:20:\"BKash Mobile Banking\";s:10:\"card_brand\";s:13:\"MOBILEBANKING\";s:14:\"card_sub_brand\";s:2:\"MB\";s:19:\"card_issuer_country\";s:10:\"Bangladesh\";s:24:\"card_issuer_country_code\";s:2:\"BD\";s:8:\"store_id\";s:27:\"alliancebuildersltdorg0live\";s:11:\"verify_sign\";s:32:\"646f71acfcc9f30f9e31516d5443b56d\";s:16:\"verify_sign_sha2\";s:64:\"4b4a3342cf15daf61e1384d08a36fe47e13bf7ada5cc587b9b340349e720656c\";s:13:\"currency_type\";s:3:\"BDT\";s:15:\"currency_amount\";s:5:\"10.00\";s:13:\"currency_rate\";s:6:\"1.0000\";s:9:\"base_fair\";s:4:\"0.00\";s:15:\"subscription_id\";N;s:10:\"risk_level\";s:1:\"0\";s:10:\"risk_title\";s:4:\"Safe\";s:13:\"cl_identifier\";N;s:13:\"cn_identifier\";s:1:\"2\";s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2026-03-29 06:31:26\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:34:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:5:\"phone\";i:3;s:7:\"address\";i:4;s:14:\"invoice_number\";i:5;s:14:\"transaction_id\";i:6;s:7:\"tran_id\";i:7;s:6:\"val_id\";i:8;s:6:\"amount\";i:9;s:9:\"card_type\";i:10;s:12:\"store_amount\";i:11;s:7:\"card_no\";i:12;s:12:\"bank_tran_id\";i:13;s:6:\"status\";i:14;s:9:\"tran_date\";i:15;s:5:\"error\";i:16;s:8:\"currency\";i:17;s:11:\"card_issuer\";i:18;s:10:\"card_brand\";i:19;s:14:\"card_sub_brand\";i:20;s:19:\"card_issuer_country\";i:21;s:24:\"card_issuer_country_code\";i:22;s:8:\"store_id\";i:23;s:11:\"verify_sign\";i:24;s:16:\"verify_sign_sha2\";i:25;s:13:\"currency_type\";i:26;s:15:\"currency_amount\";i:27;s:13:\"currency_rate\";i:28;s:9:\"base_fair\";i:29;s:15:\"subscription_id\";i:30;s:10:\"risk_level\";i:31;s:10:\"risk_title\";i:32;s:13:\"cl_identifier\";i:33;s:13:\"cn_identifier\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:27:\"App\\Models\\Bill\\Transaction\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"transactions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:37:{s:2:\"id\";i:8;s:4:\"name\";s:10:\"Rashed Bro\";s:5:\"email\";s:21:\"backup25gb1@gmail.com\";s:5:\"phone\";s:11:\"01821144599\";s:7:\"address\";s:12:\"Mirpur Dhaka\";s:14:\"invoice_number\";s:16:\"INV-202603-00006\";s:14:\"transaction_id\";s:17:\"TRX-FOSCGRQFLBGNV\";s:22:\"gateway_transaction_id\";N;s:6:\"val_id\";s:27:\"260329122420835782846da6664\";s:6:\"amount\";s:5:\"10.00\";s:9:\"card_type\";s:11:\"BKASH-BKash\";s:12:\"store_amount\";s:4:\"9.75\";s:7:\"card_no\";s:12:\"KXDCT8KXD5PW\";s:12:\"bank_tran_id\";s:20:\"BGT64952026032974291\";s:6:\"status\";s:10:\"Processing\";s:9:\"tran_date\";s:19:\"2026-03-29 12:23:49\";s:5:\"error\";N;s:8:\"currency\";s:3:\"BDT\";s:11:\"card_issuer\";s:20:\"BKash Mobile Banking\";s:10:\"card_brand\";s:13:\"MOBILEBANKING\";s:14:\"card_sub_brand\";s:2:\"MB\";s:19:\"card_issuer_country\";s:10:\"Bangladesh\";s:24:\"card_issuer_country_code\";s:2:\"BD\";s:8:\"store_id\";s:27:\"alliancebuildersltdorg0live\";s:11:\"verify_sign\";s:32:\"d1031bb853bef2be32e886978607adbc\";s:16:\"verify_sign_sha2\";s:64:\"bbb145e8519cd52bfaa871a71c269d7cf12810c9b3e4741da0631e1b4ab69d75\";s:13:\"currency_type\";s:3:\"BDT\";s:15:\"currency_amount\";s:5:\"10.00\";s:13:\"currency_rate\";s:6:\"1.0000\";s:9:\"base_fair\";s:4:\"0.00\";s:15:\"subscription_id\";N;s:10:\"risk_level\";s:1:\"0\";s:10:\"risk_title\";s:4:\"Safe\";s:13:\"cl_identifier\";N;s:13:\"cn_identifier\";s:1:\"2\";s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2026-03-29 06:24:21\";}s:11:\"\0*\0original\";a:37:{s:2:\"id\";i:8;s:4:\"name\";s:10:\"Rashed Bro\";s:5:\"email\";s:21:\"backup25gb1@gmail.com\";s:5:\"phone\";s:11:\"01821144599\";s:7:\"address\";s:12:\"Mirpur Dhaka\";s:14:\"invoice_number\";s:16:\"INV-202603-00006\";s:14:\"transaction_id\";s:17:\"TRX-FOSCGRQFLBGNV\";s:22:\"gateway_transaction_id\";N;s:6:\"val_id\";s:27:\"260329122420835782846da6664\";s:6:\"amount\";s:5:\"10.00\";s:9:\"card_type\";s:11:\"BKASH-BKash\";s:12:\"store_amount\";s:4:\"9.75\";s:7:\"card_no\";s:12:\"KXDCT8KXD5PW\";s:12:\"bank_tran_id\";s:20:\"BGT64952026032974291\";s:6:\"status\";s:10:\"Processing\";s:9:\"tran_date\";s:19:\"2026-03-29 12:23:49\";s:5:\"error\";N;s:8:\"currency\";s:3:\"BDT\";s:11:\"card_issuer\";s:20:\"BKash Mobile Banking\";s:10:\"card_brand\";s:13:\"MOBILEBANKING\";s:14:\"card_sub_brand\";s:2:\"MB\";s:19:\"card_issuer_country\";s:10:\"Bangladesh\";s:24:\"card_issuer_country_code\";s:2:\"BD\";s:8:\"store_id\";s:27:\"alliancebuildersltdorg0live\";s:11:\"verify_sign\";s:32:\"d1031bb853bef2be32e886978607adbc\";s:16:\"verify_sign_sha2\";s:64:\"bbb145e8519cd52bfaa871a71c269d7cf12810c9b3e4741da0631e1b4ab69d75\";s:13:\"currency_type\";s:3:\"BDT\";s:15:\"currency_amount\";s:5:\"10.00\";s:13:\"currency_rate\";s:6:\"1.0000\";s:9:\"base_fair\";s:4:\"0.00\";s:15:\"subscription_id\";N;s:10:\"risk_level\";s:1:\"0\";s:10:\"risk_title\";s:4:\"Safe\";s:13:\"cl_identifier\";N;s:13:\"cn_identifier\";s:1:\"2\";s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2026-03-29 06:24:21\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:34:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:5:\"phone\";i:3;s:7:\"address\";i:4;s:14:\"invoice_number\";i:5;s:14:\"transaction_id\";i:6;s:7:\"tran_id\";i:7;s:6:\"val_id\";i:8;s:6:\"amount\";i:9;s:9:\"card_type\";i:10;s:12:\"store_amount\";i:11;s:7:\"card_no\";i:12;s:12:\"bank_tran_id\";i:13;s:6:\"status\";i:14;s:9:\"tran_date\";i:15;s:5:\"error\";i:16;s:8:\"currency\";i:17;s:11:\"card_issuer\";i:18;s:10:\"card_brand\";i:19;s:14:\"card_sub_brand\";i:20;s:19:\"card_issuer_country\";i:21;s:24:\"card_issuer_country_code\";i:22;s:8:\"store_id\";i:23;s:11:\"verify_sign\";i:24;s:16:\"verify_sign_sha2\";i:25;s:13:\"currency_type\";i:26;s:15:\"currency_amount\";i:27;s:13:\"currency_rate\";i:28;s:9:\"base_fair\";i:29;s:15:\"subscription_id\";i:30;s:10:\"risk_level\";i:31;s:10:\"risk_title\";i:32;s:13:\"cl_identifier\";i:33;s:13:\"cn_identifier\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:27:\"App\\Models\\Bill\\Transaction\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"transactions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:37:{s:2:\"id\";i:7;s:4:\"name\";s:13:\"Rashed Bishal\";s:5:\"email\";s:21:\"backup25gb2@gmail.com\";s:5:\"phone\";s:11:\"01444444444\";s:7:\"address\";s:14:\"93 B, Gulistan\";s:14:\"invoice_number\";s:16:\"INV-202603-00005\";s:14:\"transaction_id\";s:17:\"TRX-F64NZODLPWX9F\";s:22:\"gateway_transaction_id\";N;s:6:\"val_id\";s:27:\"260329121456691552892256740\";s:6:\"amount\";s:5:\"10.00\";s:9:\"card_type\";s:11:\"BKASH-BKash\";s:12:\"store_amount\";s:4:\"9.75\";s:7:\"card_no\";s:12:\"KXDCT0KWWJXE\";s:12:\"bank_tran_id\";s:20:\"BGT75932026032972135\";s:6:\"status\";s:10:\"Processing\";s:9:\"tran_date\";s:19:\"2026-03-29 12:14:11\";s:5:\"error\";N;s:8:\"currency\";s:3:\"BDT\";s:11:\"card_issuer\";s:20:\"BKash Mobile Banking\";s:10:\"card_brand\";s:13:\"MOBILEBANKING\";s:14:\"card_sub_brand\";s:2:\"MB\";s:19:\"card_issuer_country\";s:10:\"Bangladesh\";s:24:\"card_issuer_country_code\";s:2:\"BD\";s:8:\"store_id\";s:27:\"alliancebuildersltdorg0live\";s:11:\"verify_sign\";s:32:\"51d238bf4d8fd53a7a4bd8d8ffa157e8\";s:16:\"verify_sign_sha2\";s:64:\"cf7a5522ac06bbf43715e4e7e6ae37180df2242e59397e87dfc76a70ca23e651\";s:13:\"currency_type\";s:3:\"BDT\";s:15:\"currency_amount\";s:5:\"10.00\";s:13:\"currency_rate\";s:6:\"1.0000\";s:9:\"base_fair\";s:4:\"0.00\";s:15:\"subscription_id\";N;s:10:\"risk_level\";s:1:\"0\";s:10:\"risk_title\";s:4:\"Safe\";s:13:\"cl_identifier\";N;s:13:\"cn_identifier\";s:1:\"2\";s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2026-03-29 06:14:57\";}s:11:\"\0*\0original\";a:37:{s:2:\"id\";i:7;s:4:\"name\";s:13:\"Rashed Bishal\";s:5:\"email\";s:21:\"backup25gb2@gmail.com\";s:5:\"phone\";s:11:\"01444444444\";s:7:\"address\";s:14:\"93 B, Gulistan\";s:14:\"invoice_number\";s:16:\"INV-202603-00005\";s:14:\"transaction_id\";s:17:\"TRX-F64NZODLPWX9F\";s:22:\"gateway_transaction_id\";N;s:6:\"val_id\";s:27:\"260329121456691552892256740\";s:6:\"amount\";s:5:\"10.00\";s:9:\"card_type\";s:11:\"BKASH-BKash\";s:12:\"store_amount\";s:4:\"9.75\";s:7:\"card_no\";s:12:\"KXDCT0KWWJXE\";s:12:\"bank_tran_id\";s:20:\"BGT75932026032972135\";s:6:\"status\";s:10:\"Processing\";s:9:\"tran_date\";s:19:\"2026-03-29 12:14:11\";s:5:\"error\";N;s:8:\"currency\";s:3:\"BDT\";s:11:\"card_issuer\";s:20:\"BKash Mobile Banking\";s:10:\"card_brand\";s:13:\"MOBILEBANKING\";s:14:\"card_sub_brand\";s:2:\"MB\";s:19:\"card_issuer_country\";s:10:\"Bangladesh\";s:24:\"card_issuer_country_code\";s:2:\"BD\";s:8:\"store_id\";s:27:\"alliancebuildersltdorg0live\";s:11:\"verify_sign\";s:32:\"51d238bf4d8fd53a7a4bd8d8ffa157e8\";s:16:\"verify_sign_sha2\";s:64:\"cf7a5522ac06bbf43715e4e7e6ae37180df2242e59397e87dfc76a70ca23e651\";s:13:\"currency_type\";s:3:\"BDT\";s:15:\"currency_amount\";s:5:\"10.00\";s:13:\"currency_rate\";s:6:\"1.0000\";s:9:\"base_fair\";s:4:\"0.00\";s:15:\"subscription_id\";N;s:10:\"risk_level\";s:1:\"0\";s:10:\"risk_title\";s:4:\"Safe\";s:13:\"cl_identifier\";N;s:13:\"cn_identifier\";s:1:\"2\";s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2026-03-29 06:14:57\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:34:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:5:\"phone\";i:3;s:7:\"address\";i:4;s:14:\"invoice_number\";i:5;s:14:\"transaction_id\";i:6;s:7:\"tran_id\";i:7;s:6:\"val_id\";i:8;s:6:\"amount\";i:9;s:9:\"card_type\";i:10;s:12:\"store_amount\";i:11;s:7:\"card_no\";i:12;s:12:\"bank_tran_id\";i:13;s:6:\"status\";i:14;s:9:\"tran_date\";i:15;s:5:\"error\";i:16;s:8:\"currency\";i:17;s:11:\"card_issuer\";i:18;s:10:\"card_brand\";i:19;s:14:\"card_sub_brand\";i:20;s:19:\"card_issuer_country\";i:21;s:24:\"card_issuer_country_code\";i:22;s:8:\"store_id\";i:23;s:11:\"verify_sign\";i:24;s:16:\"verify_sign_sha2\";i:25;s:13:\"currency_type\";i:26;s:15:\"currency_amount\";i:27;s:13:\"currency_rate\";i:28;s:9:\"base_fair\";i:29;s:15:\"subscription_id\";i:30;s:10:\"risk_level\";i:31;s:10:\"risk_title\";i:32;s:13:\"cl_identifier\";i:33;s:13:\"cn_identifier\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:27:\"App\\Models\\Bill\\Transaction\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"transactions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:37:{s:2:\"id\";i:6;s:4:\"name\";s:13:\"Rashed Bishal\";s:5:\"email\";s:21:\"backup25gb2@gmail.com\";s:5:\"phone\";s:11:\"01821144599\";s:7:\"address\";s:18:\"Dhaka, Bangladeshj\";s:14:\"invoice_number\";s:16:\"INV-202603-00004\";s:14:\"transaction_id\";s:17:\"TRX-7NYH4D9JP9QCX\";s:22:\"gateway_transaction_id\";N;s:6:\"val_id\";s:27:\"260329121250536298220c6ab72\";s:6:\"amount\";s:5:\"10.00\";s:9:\"card_type\";s:11:\"BKASH-BKash\";s:12:\"store_amount\";s:4:\"9.75\";s:7:\"card_no\";s:12:\"KXDCT5KWT3ND\";s:12:\"bank_tran_id\";s:20:\"BGT83992026032971686\";s:6:\"status\";s:10:\"Processing\";s:9:\"tran_date\";s:19:\"2026-03-29 12:12:19\";s:5:\"error\";N;s:8:\"currency\";s:3:\"BDT\";s:11:\"card_issuer\";s:20:\"BKash Mobile Banking\";s:10:\"card_brand\";s:13:\"MOBILEBANKING\";s:14:\"card_sub_brand\";s:2:\"MB\";s:19:\"card_issuer_country\";s:10:\"Bangladesh\";s:24:\"card_issuer_country_code\";s:2:\"BD\";s:8:\"store_id\";s:27:\"alliancebuildersltdorg0live\";s:11:\"verify_sign\";s:32:\"313e70bc7b5c006330c22432e5a1e26d\";s:16:\"verify_sign_sha2\";s:64:\"ea76f4a57d87a7d944610c20d4c6ad75e7d0aaaa11b05c53d705abf61ccf1d2b\";s:13:\"currency_type\";s:3:\"BDT\";s:15:\"currency_amount\";s:5:\"10.00\";s:13:\"currency_rate\";s:6:\"1.0000\";s:9:\"base_fair\";s:4:\"0.00\";s:15:\"subscription_id\";N;s:10:\"risk_level\";s:1:\"0\";s:10:\"risk_title\";s:4:\"Safe\";s:13:\"cl_identifier\";N;s:13:\"cn_identifier\";s:1:\"2\";s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2026-03-29 06:12:51\";}s:11:\"\0*\0original\";a:37:{s:2:\"id\";i:6;s:4:\"name\";s:13:\"Rashed Bishal\";s:5:\"email\";s:21:\"backup25gb2@gmail.com\";s:5:\"phone\";s:11:\"01821144599\";s:7:\"address\";s:18:\"Dhaka, Bangladeshj\";s:14:\"invoice_number\";s:16:\"INV-202603-00004\";s:14:\"transaction_id\";s:17:\"TRX-7NYH4D9JP9QCX\";s:22:\"gateway_transaction_id\";N;s:6:\"val_id\";s:27:\"260329121250536298220c6ab72\";s:6:\"amount\";s:5:\"10.00\";s:9:\"card_type\";s:11:\"BKASH-BKash\";s:12:\"store_amount\";s:4:\"9.75\";s:7:\"card_no\";s:12:\"KXDCT5KWT3ND\";s:12:\"bank_tran_id\";s:20:\"BGT83992026032971686\";s:6:\"status\";s:10:\"Processing\";s:9:\"tran_date\";s:19:\"2026-03-29 12:12:19\";s:5:\"error\";N;s:8:\"currency\";s:3:\"BDT\";s:11:\"card_issuer\";s:20:\"BKash Mobile Banking\";s:10:\"card_brand\";s:13:\"MOBILEBANKING\";s:14:\"card_sub_brand\";s:2:\"MB\";s:19:\"card_issuer_country\";s:10:\"Bangladesh\";s:24:\"card_issuer_country_code\";s:2:\"BD\";s:8:\"store_id\";s:27:\"alliancebuildersltdorg0live\";s:11:\"verify_sign\";s:32:\"313e70bc7b5c006330c22432e5a1e26d\";s:16:\"verify_sign_sha2\";s:64:\"ea76f4a57d87a7d944610c20d4c6ad75e7d0aaaa11b05c53d705abf61ccf1d2b\";s:13:\"currency_type\";s:3:\"BDT\";s:15:\"currency_amount\";s:5:\"10.00\";s:13:\"currency_rate\";s:6:\"1.0000\";s:9:\"base_fair\";s:4:\"0.00\";s:15:\"subscription_id\";N;s:10:\"risk_level\";s:1:\"0\";s:10:\"risk_title\";s:4:\"Safe\";s:13:\"cl_identifier\";N;s:13:\"cn_identifier\";s:1:\"2\";s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2026-03-29 06:12:51\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:34:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:5:\"phone\";i:3;s:7:\"address\";i:4;s:14:\"invoice_number\";i:5;s:14:\"transaction_id\";i:6;s:7:\"tran_id\";i:7;s:6:\"val_id\";i:8;s:6:\"amount\";i:9;s:9:\"card_type\";i:10;s:12:\"store_amount\";i:11;s:7:\"card_no\";i:12;s:12:\"bank_tran_id\";i:13;s:6:\"status\";i:14;s:9:\"tran_date\";i:15;s:5:\"error\";i:16;s:8:\"currency\";i:17;s:11:\"card_issuer\";i:18;s:10:\"card_brand\";i:19;s:14:\"card_sub_brand\";i:20;s:19:\"card_issuer_country\";i:21;s:24:\"card_issuer_country_code\";i:22;s:8:\"store_id\";i:23;s:11:\"verify_sign\";i:24;s:16:\"verify_sign_sha2\";i:25;s:13:\"currency_type\";i:26;s:15:\"currency_amount\";i:27;s:13:\"currency_rate\";i:28;s:9:\"base_fair\";i:29;s:15:\"subscription_id\";i:30;s:10:\"risk_level\";i:31;s:10:\"risk_title\";i:32;s:13:\"cl_identifier\";i:33;s:13:\"cn_identifier\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:5;O:27:\"App\\Models\\Bill\\Transaction\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"transactions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:37:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"Rashed Bro\";s:5:\"email\";s:22:\"rashed.bishal@live.com\";s:5:\"phone\";s:11:\"01444444444\";s:7:\"address\";s:17:\"Dhaka, Bangladesh\";s:14:\"invoice_number\";s:16:\"INV-202603-00003\";s:14:\"transaction_id\";s:17:\"TRX-YOVEVBTJL1SAZ\";s:22:\"gateway_transaction_id\";N;s:6:\"val_id\";s:27:\"2603281903261048120933ca05e\";s:6:\"amount\";s:5:\"10.00\";s:9:\"card_type\";s:11:\"BKASH-BKash\";s:12:\"store_amount\";s:4:\"9.75\";s:7:\"card_no\";s:12:\"KXDCS6K7OMRG\";s:12:\"bank_tran_id\";s:21:\"BGT473420260328139098\";s:6:\"status\";s:10:\"Processing\";s:9:\"tran_date\";s:19:\"2026-03-28 19:02:45\";s:5:\"error\";N;s:8:\"currency\";s:3:\"BDT\";s:11:\"card_issuer\";s:20:\"BKash Mobile Banking\";s:10:\"card_brand\";s:13:\"MOBILEBANKING\";s:14:\"card_sub_brand\";s:2:\"MB\";s:19:\"card_issuer_country\";s:10:\"Bangladesh\";s:24:\"card_issuer_country_code\";s:2:\"BD\";s:8:\"store_id\";s:27:\"alliancebuildersltdorg0live\";s:11:\"verify_sign\";s:32:\"b83c6d96c4a640ee4fa4bd1ed46ad835\";s:16:\"verify_sign_sha2\";s:64:\"65e299e3dff7a4186c8320501d7b36ed5c0e1d7211f929f1be3433fcada1185a\";s:13:\"currency_type\";s:3:\"BDT\";s:15:\"currency_amount\";s:5:\"10.00\";s:13:\"currency_rate\";s:6:\"1.0000\";s:9:\"base_fair\";s:4:\"0.00\";s:15:\"subscription_id\";N;s:10:\"risk_level\";s:1:\"0\";s:10:\"risk_title\";s:4:\"Safe\";s:13:\"cl_identifier\";N;s:13:\"cn_identifier\";s:1:\"2\";s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2026-03-28 13:03:28\";}s:11:\"\0*\0original\";a:37:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"Rashed Bro\";s:5:\"email\";s:22:\"rashed.bishal@live.com\";s:5:\"phone\";s:11:\"01444444444\";s:7:\"address\";s:17:\"Dhaka, Bangladesh\";s:14:\"invoice_number\";s:16:\"INV-202603-00003\";s:14:\"transaction_id\";s:17:\"TRX-YOVEVBTJL1SAZ\";s:22:\"gateway_transaction_id\";N;s:6:\"val_id\";s:27:\"2603281903261048120933ca05e\";s:6:\"amount\";s:5:\"10.00\";s:9:\"card_type\";s:11:\"BKASH-BKash\";s:12:\"store_amount\";s:4:\"9.75\";s:7:\"card_no\";s:12:\"KXDCS6K7OMRG\";s:12:\"bank_tran_id\";s:21:\"BGT473420260328139098\";s:6:\"status\";s:10:\"Processing\";s:9:\"tran_date\";s:19:\"2026-03-28 19:02:45\";s:5:\"error\";N;s:8:\"currency\";s:3:\"BDT\";s:11:\"card_issuer\";s:20:\"BKash Mobile Banking\";s:10:\"card_brand\";s:13:\"MOBILEBANKING\";s:14:\"card_sub_brand\";s:2:\"MB\";s:19:\"card_issuer_country\";s:10:\"Bangladesh\";s:24:\"card_issuer_country_code\";s:2:\"BD\";s:8:\"store_id\";s:27:\"alliancebuildersltdorg0live\";s:11:\"verify_sign\";s:32:\"b83c6d96c4a640ee4fa4bd1ed46ad835\";s:16:\"verify_sign_sha2\";s:64:\"65e299e3dff7a4186c8320501d7b36ed5c0e1d7211f929f1be3433fcada1185a\";s:13:\"currency_type\";s:3:\"BDT\";s:15:\"currency_amount\";s:5:\"10.00\";s:13:\"currency_rate\";s:6:\"1.0000\";s:9:\"base_fair\";s:4:\"0.00\";s:15:\"subscription_id\";N;s:10:\"risk_level\";s:1:\"0\";s:10:\"risk_title\";s:4:\"Safe\";s:13:\"cl_identifier\";N;s:13:\"cn_identifier\";s:1:\"2\";s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2026-03-28 13:03:28\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:34:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:5:\"phone\";i:3;s:7:\"address\";i:4;s:14:\"invoice_number\";i:5;s:14:\"transaction_id\";i:6;s:7:\"tran_id\";i:7;s:6:\"val_id\";i:8;s:6:\"amount\";i:9;s:9:\"card_type\";i:10;s:12:\"store_amount\";i:11;s:7:\"card_no\";i:12;s:12:\"bank_tran_id\";i:13;s:6:\"status\";i:14;s:9:\"tran_date\";i:15;s:5:\"error\";i:16;s:8:\"currency\";i:17;s:11:\"card_issuer\";i:18;s:10:\"card_brand\";i:19;s:14:\"card_sub_brand\";i:20;s:19:\"card_issuer_country\";i:21;s:24:\"card_issuer_country_code\";i:22;s:8:\"store_id\";i:23;s:11:\"verify_sign\";i:24;s:16:\"verify_sign_sha2\";i:25;s:13:\"currency_type\";i:26;s:15:\"currency_amount\";i:27;s:13:\"currency_rate\";i:28;s:9:\"base_fair\";i:29;s:15:\"subscription_id\";i:30;s:10:\"risk_level\";i:31;s:10:\"risk_title\";i:32;s:13:\"cl_identifier\";i:33;s:13:\"cn_identifier\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:6;O:27:\"App\\Models\\Bill\\Transaction\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"transactions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:37:{s:2:\"id\";i:4;s:4:\"name\";s:14:\"Anonymous User\";s:5:\"email\";s:21:\"backup25gb1@gmail.com\";s:5:\"phone\";s:11:\"01821144599\";s:7:\"address\";N;s:14:\"invoice_number\";s:16:\"INV-202603-00002\";s:14:\"transaction_id\";s:17:\"TRX-BB8TAFPBDMPS2\";s:22:\"gateway_transaction_id\";N;s:6:\"val_id\";s:27:\"26031417404750037021936393f\";s:6:\"amount\";s:5:\"10.00\";s:9:\"card_type\";s:11:\"BKASH-BKash\";s:12:\"store_amount\";s:4:\"9.75\";s:7:\"card_no\";s:12:\"KXDCE047HCD2\";s:12:\"bank_tran_id\";s:21:\"BGT746920260314126987\";s:6:\"status\";s:10:\"Processing\";s:9:\"tran_date\";s:19:\"2026-03-14 17:40:17\";s:5:\"error\";N;s:8:\"currency\";s:3:\"BDT\";s:11:\"card_issuer\";s:20:\"BKash Mobile Banking\";s:10:\"card_brand\";s:13:\"MOBILEBANKING\";s:14:\"card_sub_brand\";s:2:\"MB\";s:19:\"card_issuer_country\";s:10:\"Bangladesh\";s:24:\"card_issuer_country_code\";s:2:\"BD\";s:8:\"store_id\";s:25:\"opticoresolutionsltd0live\";s:11:\"verify_sign\";s:32:\"a0c54e6e69c00fb8ae5f5821a1337308\";s:16:\"verify_sign_sha2\";s:64:\"81b3d4c154cc04e4e46d516ab5341ccdab8e15825a8f555d81ddd07092a8c899\";s:13:\"currency_type\";s:3:\"BDT\";s:15:\"currency_amount\";s:5:\"10.00\";s:13:\"currency_rate\";s:6:\"1.0000\";s:9:\"base_fair\";s:4:\"0.00\";s:15:\"subscription_id\";N;s:10:\"risk_level\";s:1:\"0\";s:10:\"risk_title\";s:4:\"Safe\";s:13:\"cl_identifier\";s:1:\"8\";s:13:\"cn_identifier\";s:1:\"2\";s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2026-03-14 17:40:48\";}s:11:\"\0*\0original\";a:37:{s:2:\"id\";i:4;s:4:\"name\";s:14:\"Anonymous User\";s:5:\"email\";s:21:\"backup25gb1@gmail.com\";s:5:\"phone\";s:11:\"01821144599\";s:7:\"address\";N;s:14:\"invoice_number\";s:16:\"INV-202603-00002\";s:14:\"transaction_id\";s:17:\"TRX-BB8TAFPBDMPS2\";s:22:\"gateway_transaction_id\";N;s:6:\"val_id\";s:27:\"26031417404750037021936393f\";s:6:\"amount\";s:5:\"10.00\";s:9:\"card_type\";s:11:\"BKASH-BKash\";s:12:\"store_amount\";s:4:\"9.75\";s:7:\"card_no\";s:12:\"KXDCE047HCD2\";s:12:\"bank_tran_id\";s:21:\"BGT746920260314126987\";s:6:\"status\";s:10:\"Processing\";s:9:\"tran_date\";s:19:\"2026-03-14 17:40:17\";s:5:\"error\";N;s:8:\"currency\";s:3:\"BDT\";s:11:\"card_issuer\";s:20:\"BKash Mobile Banking\";s:10:\"card_brand\";s:13:\"MOBILEBANKING\";s:14:\"card_sub_brand\";s:2:\"MB\";s:19:\"card_issuer_country\";s:10:\"Bangladesh\";s:24:\"card_issuer_country_code\";s:2:\"BD\";s:8:\"store_id\";s:25:\"opticoresolutionsltd0live\";s:11:\"verify_sign\";s:32:\"a0c54e6e69c00fb8ae5f5821a1337308\";s:16:\"verify_sign_sha2\";s:64:\"81b3d4c154cc04e4e46d516ab5341ccdab8e15825a8f555d81ddd07092a8c899\";s:13:\"currency_type\";s:3:\"BDT\";s:15:\"currency_amount\";s:5:\"10.00\";s:13:\"currency_rate\";s:6:\"1.0000\";s:9:\"base_fair\";s:4:\"0.00\";s:15:\"subscription_id\";N;s:10:\"risk_level\";s:1:\"0\";s:10:\"risk_title\";s:4:\"Safe\";s:13:\"cl_identifier\";s:1:\"8\";s:13:\"cn_identifier\";s:1:\"2\";s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2026-03-14 17:40:48\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:34:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:5:\"phone\";i:3;s:7:\"address\";i:4;s:14:\"invoice_number\";i:5;s:14:\"transaction_id\";i:6;s:7:\"tran_id\";i:7;s:6:\"val_id\";i:8;s:6:\"amount\";i:9;s:9:\"card_type\";i:10;s:12:\"store_amount\";i:11;s:7:\"card_no\";i:12;s:12:\"bank_tran_id\";i:13;s:6:\"status\";i:14;s:9:\"tran_date\";i:15;s:5:\"error\";i:16;s:8:\"currency\";i:17;s:11:\"card_issuer\";i:18;s:10:\"card_brand\";i:19;s:14:\"card_sub_brand\";i:20;s:19:\"card_issuer_country\";i:21;s:24:\"card_issuer_country_code\";i:22;s:8:\"store_id\";i:23;s:11:\"verify_sign\";i:24;s:16:\"verify_sign_sha2\";i:25;s:13:\"currency_type\";i:26;s:15:\"currency_amount\";i:27;s:13:\"currency_rate\";i:28;s:9:\"base_fair\";i:29;s:15:\"subscription_id\";i:30;s:10:\"risk_level\";i:31;s:10:\"risk_title\";i:32;s:13:\"cl_identifier\";i:33;s:13:\"cn_identifier\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1774775075),
('opticore-solutions-limited-cache-weekly-osl-payment', 'a:4:{s:6:\"labels\";a:7:{i:0;s:6:\"Sat 28\";i:1;s:6:\"Sun 29\";i:2;s:6:\"Mon 30\";i:3;s:6:\"Tue 31\";i:4;s:6:\"Wed 01\";i:5;s:6:\"Thu 02\";i:6;s:6:\"Fri 03\";}s:4:\"data\";a:7:{i:0;i:0;i:1;i:0;i:2;i:0;i:3;i:0;i:4;i:0;i:5;i:0;i:6;i:0;}s:9:\"weekTotal\";i:0;s:9:\"weekRange\";s:21:\"Mar 28 - Apr 03, 2026\";}', 1774789270),
('opticore-solutions-limited-cache-wisir.en.eq.e9.8.6@gmail.com|185.220.101.38', 'i:1;', 1773193165),
('opticore-solutions-limited-cache-wisir.en.eq.e9.8.6@gmail.com|185.220.101.38:timer', 'i:1773193165;', 1773193165);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone_secondary` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `concern_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `address`, `city`, `state`, `zip`, `country`, `phone`, `phone_secondary`, `company_name`, `company_address`, `concern_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Anonymous User', 'backup25gb1@gmail.com', NULL, NULL, NULL, NULL, NULL, '01821144599', NULL, 'Anonymous User', NULL, 2, 8, '2026-03-14 10:47:20', '2026-03-14 17:31:23');

-- --------------------------------------------------------

--
-- Table structure for table `client_images`
--

CREATE TABLE `client_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `shareform_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_images`
--

INSERT INTO `client_images` (`id`, `name`, `shareform_id`, `created_at`, `updated_at`) VALUES
(1, '20260314172214-ZD68A38.jpg', 7, '2026-03-14 17:22:15', '2026-03-14 17:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `concerns`
--

CREATE TABLE `concerns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `concerns`
--

INSERT INTO `concerns` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Opticore Solutions Limited', '2026-02-10 12:24:01', '2026-02-10 12:24:01'),
(2, 'Hotel Jana', '2026-02-10 12:24:01', '2026-02-10 12:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Male', '2026-02-10 12:24:01', '2026-02-10 12:24:01'),
(2, 'Female', '2026-02-10 12:24:01', '2026-02-10 12:24:01'),
(3, 'Rather Not Say', '2026-02-10 12:24:01', '2026-02-10 12:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `money_receipt_number` varchar(50) DEFAULT NULL,
  `invoice_date` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `due_amount` decimal(12,2) DEFAULT NULL,
  `payment_amount` decimal(12,2) DEFAULT NULL,
  `invoice_status` varchar(255) NOT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `public_token` varchar(80) DEFAULT NULL,
  `public_token_expires_at` timestamp NULL DEFAULT NULL,
  `public_token_revoked_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_number`, `money_receipt_number`, `invoice_date`, `due_date`, `payment_date`, `due_amount`, `payment_amount`, `invoice_status`, `order_number`, `remarks`, `public_token`, `public_token_expires_at`, `public_token_revoked_at`, `created_at`, `updated_at`) VALUES
(3, 'INV-202603-00002', '202603-2', '2026-03-14', '2026-03-14', '2026-03-14', 190.00, 10.00, 'Processing', 'ORD-202603-00002', 'Online Payment', '5131600fade9b313c6acacad6611440ac241bb7a1d07bdeed2575aa156f9047a', '2027-03-14 17:40:48', NULL, '2026-03-14 17:40:48', '2026-03-14 17:40:48'),
(4, 'INV-202603-00003', NULL, '2026-03-28', NULL, NULL, NULL, 10.00, 'Processing', NULL, 'Online Payment', '7d77a7cfe51c68ec29190711256436fde2e32832903437a9c980b44b054962e1', '2027-03-28 13:03:27', NULL, '2026-03-28 13:03:28', '2026-03-28 13:03:28'),
(5, 'INV-202603-00004', NULL, '2026-03-29', NULL, NULL, NULL, 10.00, 'Processing', NULL, 'Online Payment', '4da01f0d443b6e8254e1882bf13a98bcd3fe774a907982d50fd15578938374ae', '2027-03-29 06:12:51', NULL, '2026-03-29 06:12:51', '2026-03-29 06:12:51'),
(6, 'INV-202603-00005', NULL, '2026-03-29', NULL, NULL, NULL, 10.00, 'Processing', NULL, 'Online Payment', 'bd6cffb0f007b59ec52bb71bc0a3f3c3ab1ed3b6232afa549e9f46fbe572e196', '2027-03-29 06:14:56', NULL, '2026-03-29 06:14:57', '2026-03-29 06:14:57'),
(7, 'INV-202603-00006', NULL, '2026-03-29', NULL, NULL, NULL, 10.00, 'Processing', NULL, 'Online Payment', '7e40f400926deee62dc7d5db7b5ffd282aa195184c32146ce0e247a4a7c84429', '2027-03-29 06:24:21', NULL, '2026-03-29 06:24:21', '2026-03-29 06:24:21'),
(8, 'INV-202603-00007', NULL, '2026-03-29', NULL, NULL, NULL, 10.00, 'Processing', NULL, 'Online Payment', '59c65565b6dfba846579fcbcf93621a7ace896dd82601ec3c14371a4d77057e2', '2027-03-29 06:31:26', NULL, '2026-03-29 06:31:26', '2026-03-29 06:31:26'),
(9, 'INV-202603-00008', NULL, '2026-03-29', NULL, NULL, NULL, 10.00, 'Processing', NULL, 'Online Payment', '5555fb13f5339e97f1bafe2f22a8c63bf1b51cf2cd411cf2257fe797caf81160', '2027-03-29 06:56:37', NULL, '2026-03-29 06:56:37', '2026-03-29 06:56:37'),
(10, 'INV-202603-00009', NULL, '2026-03-29', NULL, NULL, NULL, 10.00, 'Processing', NULL, 'Online Payment', 'c88fa19c1ffa46ec507d1d3a1a49ec0d0c7f8f8b7f8aa5bc7dba8d70de5f58ae', '2027-03-29 08:13:08', NULL, '2026-03-29 08:13:09', '2026-03-29 08:13:09'),
(11, 'INV-202604-00001', NULL, '2026-04-01', NULL, NULL, NULL, 10.00, 'Processing', NULL, 'Online Payment', '833c6645576680888a30cea82817853593df94c184d62302cd5a25c2d483df82', '2027-04-01 07:27:33', NULL, '2026-04-01 07:27:33', '2026-04-01 07:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_number_sequence`
--

CREATE TABLE `invoice_number_sequence` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prefix` varchar(20) NOT NULL,
  `period` varchar(6) NOT NULL,
  `last_number` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_number_sequence`
--

INSERT INTO `invoice_number_sequence` (`id`, `prefix`, `period`, `last_number`, `created_at`, `updated_at`) VALUES
(1, 'INV', '202602', 1, '2026-02-24 16:46:34', '2026-02-24 16:46:34'),
(2, 'INV', '202603', 9, '2026-03-14 01:32:42', '2026-03-29 08:13:08'),
(3, 'INV', '202604', 1, '2026-04-01 07:27:33', '2026-04-01 07:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(148, '2026_02_02_174219_create_projects_table', 1),
(153, '0001_01_01_000000_create_users_table', 2),
(154, '0001_01_01_000001_create_cache_table', 2),
(155, '0001_01_01_000002_create_jobs_table', 2),
(156, '2025_10_16_110705_add_two_factor_columns_to_users_table', 2),
(157, '2025_10_16_110713_create_personal_access_tokens_table', 2),
(158, '2025_10_16_112053_create_activity_log_table', 2),
(159, '2025_10_16_112054_add_event_column_to_activity_log_table', 2),
(160, '2025_10_16_112055_add_batch_uuid_column_to_activity_log_table', 2),
(161, '2025_10_16_120617_create_concerns_table', 2),
(162, '2025_10_16_120747_create_clients_table', 2),
(163, '2025_11_02_132839_add_indexes_to_activity_log_table', 2),
(164, '2025_11_06_143417_create_sales_officers_table', 2),
(165, '2025_11_07_133212_create_services_table', 2),
(166, '2025_11_07_223011_create_orders_table', 2),
(167, '2025_11_07_223949_create_order_service_table', 2),
(168, '2025_11_07_225158_create_order_number_sequences_table', 2),
(169, '2025_11_07_225216_create_invoice_number_sequence_table', 2),
(170, '2025_11_13_115529_create_invoices_table', 2),
(171, '2025_11_17_022933_create_transactions_table', 2),
(172, '2026_01_12_175240_create_money_receipt_sequences_table', 2),
(173, '2026_02_02_174211_create_genders_table', 2),
(174, '2026_02_02_174234_create_religions_table', 2),
(175, '2026_02_02_174555_create_payment_methods_table', 2),
(176, '2026_02_02_175050_create_shareforms_table', 2),
(177, '2026_02_05_123458_create_client_images_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `money_receipt_sequences`
--

CREATE TABLE `money_receipt_sequences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `period` varchar(6) NOT NULL,
  `last_number` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `money_receipt_sequences`
--

INSERT INTO `money_receipt_sequences` (`id`, `period`, `last_number`, `created_at`, `updated_at`) VALUES
(1, '202602', 1, '2026-02-24 16:46:34', '2026-02-24 16:46:34'),
(2, '202603', 2, '2026-03-14 01:32:42', '2026-03-14 17:40:48');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `contracted_amount` decimal(12,2) NOT NULL,
  `paid_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `due_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `client_id`, `contracted_amount`, `paid_amount`, `due_amount`, `notes`, `created_at`, `updated_at`) VALUES
(3, 'ORD-202603-00002', 1, 200.00, 10.00, 190.00, NULL, '2026-03-14 17:23:31', '2026-03-14 17:40:48');

-- --------------------------------------------------------

--
-- Table structure for table `order_number_sequences`
--

CREATE TABLE `order_number_sequences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prefix` varchar(20) NOT NULL DEFAULT 'ORD',
  `period` varchar(6) NOT NULL,
  `last_number` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_number_sequences`
--

INSERT INTO `order_number_sequences` (`id`, `prefix`, `period`, `last_number`, `created_at`, `updated_at`) VALUES
(1, 'ORD', '202602', 1, '2026-02-24 16:45:03', '2026-02-24 16:45:03'),
(2, 'ORD', '202603', 2, '2026-03-14 01:31:15', '2026-03-14 17:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `order_service`
--

CREATE TABLE `order_service` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_service`
--

INSERT INTO `order_service` (`id`, `order_id`, `service_id`, `unit_price`, `quantity`, `created_at`, `updated_at`) VALUES
(3, 3, 5, 200.00, 1, '2026-03-14 17:23:31', '2026-03-14 17:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Cash', '2026-02-10 12:24:01', '2026-02-10 12:24:01'),
(2, 'Cheque', '2026-02-10 12:24:01', '2026-02-10 12:24:01'),
(3, 'Online', '2026-02-10 12:24:01', '2026-02-10 12:24:01'),
(4, 'Pay Order', '2026-02-10 12:24:01', '2026-02-10 12:24:01'),
(5, 'D.D', '2026-02-10 12:24:01', '2026-02-10 12:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `religions`
--

CREATE TABLE `religions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `religions`
--

INSERT INTO `religions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Islam', '2026-02-10 12:24:01', '2026-02-10 12:24:01'),
(2, 'Hinduism', '2026-02-10 12:24:01', '2026-02-10 12:24:01'),
(3, 'Christianity', '2026-02-10 12:24:01', '2026-02-10 12:24:01'),
(4, 'Buddhism', '2026-02-10 12:24:01', '2026-02-10 12:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `sales_officers`
--

CREATE TABLE `sales_officers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_officers`
--

INSERT INTO `sales_officers` (`id`, `name`, `email`, `designation`, `created_at`, `updated_at`) VALUES
(4, 'Sales Officer 1', 'sales@gmail.com', 'Executive', '2026-03-14 01:27:06', '2026-03-14 01:27:06'),
(5, 'Sales Officer 2', 'sample@client.com', 'Manager', '2026-03-14 01:27:18', '2026-03-14 01:27:18');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `concern_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `concern_id`, `created_at`, `updated_at`) VALUES
(4, 'Hotel Jana - Kuakata (Share)', 'Hotel Jana Kuakata', 2, '2026-03-14 01:25:53', '2026-03-14 01:25:53'),
(5, 'Hotel Jana The Dove - Cox\'s Bazar (Share)', 'Hotel Jana Cox\'s Bazar', 2, '2026-03-14 01:26:35', '2026-03-14 01:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('08JBWFluPv4BOZZfrNmP5BQOzf2oscsshG76ksq8', NULL, '103.187.95.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVDhPcGdOd0phVXFpR3BOVnFqdUdWRFFXQ29KU1ZmRHlxdWl1YzRxVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vaW52ZXN0LmFsbGlhbmNlYnVpbGRlcnNsdGQub3JnIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1790162173),
('34etaOb1GYFgnXMp3ZXOTVviYDDadoaGm7HGEro8', NULL, '2a03:2880:f800:9::', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 (compatible; meta-externalads/1.1 (+https://developers.facebook.com/docs/sharing/webmasters/crawler))', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSjZEOW11bmsyTUxuZmdKWTFHbFpCSzV5a1ZROWRONmdZTlJic2JIUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vaW52ZXN0LmFsbGlhbmNlYnVpbGRlcnNsdGQub3JnIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1790151408),
('AB57T3qRggUfqR9IhnWOY6zKEWO3ggjP0TIvuR8R', NULL, '116.179.37.13', 'Mozilla/5.0 (compatible; Baiduspider-render/2.0; +http://www.baidu.com/search/spider.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTVp2ZU53YmJOcnY5bTFtTlRDenNCaUYwVURwdEtKbWFYbHhhM1pkRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9pbnZlc3QuYWxsaWFuY2VidWlsZGVyc2x0ZC5vcmciO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1790113582),
('h1kjVs6xW6UUowYmhuiYdBqXvmRApUqfjNJXZGCS', NULL, '74.179.70.94', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.7444.162 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVjR6ZHJoU3hTUUg4VWNGUFNpRjdlVGdiRXJJczREMWJwN1ZaTFFzOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vaW52ZXN0LmFsbGlhbmNlYnVpbGRlcnNsdGQub3JnIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1790175590),
('jo9fDhi1srtqk6Enensnnk71JEjtmDN8Pnkgp1rJ', NULL, '45.115.41.150', 'WhatsApp/2.23.20.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVlQ1RzkwZHA4dTRyZ3JPSEVBbzN5ZE5JNUs3S0RZdGpxNVpGdFJNYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vaW52ZXN0LmFsbGlhbmNlYnVpbGRlcnNsdGQub3JnIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1790160762),
('jVzj1Vssk8mwjJlwtAn5JUCKnNWYb1tmVEuLdXLp', NULL, '9.169.121.185', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.7444.162 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiak1VY2tFUnJxUFdwakVPbDBnY2RJWHJwNkVKODlkN3BvZnIxS0loNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vaW52ZXN0LmFsbGlhbmNlYnVpbGRlcnNsdGQub3JnIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1790175283),
('llCLmBHSZykXKC6S8bQnrhNshntR2GWjy3nlgp9j', NULL, '9.169.121.184', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMDd2eXowUXI1NE1Vd01Xd1M0Z01pVlloQ2xnRGNNVGxCQ3NabGEwOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vaW52ZXN0LmFsbGlhbmNlYnVpbGRlcnNsdGQub3JnIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1790175476),
('maYFR0YisOqyRqOOeMlA8WxThy7TxDguLe9BAf1h', NULL, '2a03:2880:f814:37::', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 (compatible; meta-externalads/1.1 (+https://developers.facebook.com/docs/sharing/webmasters/crawler))', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYWZaOW5NSXVVdDVLRkxZMW1oT2loUk1WWHZXd2xEbUs3NmlRQVFMbiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vaW52ZXN0LmFsbGlhbmNlYnVpbGRlcnNsdGQub3JnIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1790103140),
('mp7AcnKZRecBTNKo5Svag1ygpwIVoLNXByGVrLKx', NULL, '2a02:4780:5d:c0de::10', 'Go-http-client/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibmJNTER6WXlSdHh4TG5SdFNVQkFHUGt0aU5MOFFmb2tMOFdGQm5kZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vaW52ZXN0LmFsbGlhbmNlYnVpbGRlcnNsdGQub3JnIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1790155297),
('q4TjiqO4vLIz5OulFTjzL91NHMjsw9xfYNqscqBq', NULL, '45.115.41.150', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU3RkQURHY0hTTVV1ZFFMdzVOSU8wZkNzZFNxanhCTDl4VnVXSGU3UiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vaW52ZXN0LmFsbGlhbmNlYnVpbGRlcnNsdGQub3JnIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1790167273),
('u50k2GGsbZPttLKZOqo6LEOL6Vp4D9nzZs8Yx4h9', NULL, '2a03:2880:f814:48::', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 (compatible; meta-externalads/1.1 (+https://developers.facebook.com/docs/sharing/webmasters/crawler))', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTkRBMDFXaEhsN0ZGQTJNZllReFJxMktaRUN0VjZqUW9tc2ZmWFRQcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vaW52ZXN0LmFsbGlhbmNlYnVpbGRlcnNsdGQub3JnIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1790108195),
('Uis4yfCui9u2bN3mkHeVW1P4adpg1bA3KBD059PA', NULL, '45.115.41.151', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ2pyakh4dzZWcmZyN2ZxR0VrVEdVb3c5SWFlaldIbXAxeUtaUEp6bSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vaW52ZXN0LmFsbGlhbmNlYnVpbGRlcnNsdGQub3JnIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1790160755),
('xXdjhJm5ZVjW0AkbAVu3pZHbT9efwmrxQadyNQlu', NULL, '34.40.220.144', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT3djOERZczFsTFhOQ21KbkNLaEtud3MzdTdwZXJsODB3VUxJMzA0TCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vaW52ZXN0LmFsbGlhbmNlYnVpbGRlcnNsdGQub3JnIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1790164608);

-- --------------------------------------------------------

--
-- Table structure for table `shareforms`
--

CREATE TABLE `shareforms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `share_number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `present_address` text NOT NULL,
  `permanent_address` text DEFAULT NULL,
  `spouse_name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) NOT NULL,
  `nid` varchar(255) DEFAULT NULL,
  `religion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `dom` date DEFAULT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ownership_category` varchar(255) DEFAULT NULL,
  `ownership_number` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `ownership_price` double NOT NULL,
  `special_discount` double DEFAULT NULL,
  `contracted_price` double NOT NULL,
  `total_amount` double NOT NULL,
  `paymentmethod_id` bigint(20) UNSIGNED DEFAULT NULL,
  `booking_money` double DEFAULT NULL,
  `booking_money_date` date DEFAULT NULL,
  `down_payment` double DEFAULT NULL,
  `down_payment_date` date DEFAULT NULL,
  `rest_amount_by` varchar(255) DEFAULT NULL,
  `installments` double DEFAULT NULL,
  `installments_date` date DEFAULT NULL,
  `payment_instruction` varchar(255) DEFAULT NULL,
  `nominee_1` varchar(255) NOT NULL,
  `nominee_2` varchar(255) DEFAULT NULL,
  `nominee_address` varchar(255) DEFAULT NULL,
  `nominee_mobile` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sales_officer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shareforms`
--

INSERT INTO `shareforms` (`id`, `share_number`, `name`, `gender_id`, `father_name`, `mother_name`, `present_address`, `permanent_address`, `spouse_name`, `mobile`, `nid`, `religion_id`, `dob`, `profession`, `email`, `dom`, `service_id`, `ownership_category`, `ownership_number`, `size`, `ownership_price`, `special_discount`, `contracted_price`, `total_amount`, `paymentmethod_id`, `booking_money`, `booking_money_date`, `down_payment`, `down_payment_date`, `rest_amount_by`, `installments`, `installments_date`, `payment_instruction`, `nominee_1`, `nominee_2`, `nominee_address`, `nominee_mobile`, `status`, `order_id`, `sales_officer_id`, `created_at`, `updated_at`) VALUES
(7, 'ZD68A38', 'Sample Name', 1, 'Sample Name', 'Sample Name', 'Sample Name', NULL, NULL, '01888888888', NULL, 1, NULL, NULL, NULL, NULL, 5, NULL, 1, 19, 200, NULL, 200, 200, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sample Name', NULL, NULL, NULL, 1, 3, 5, '2026-03-14 17:22:14', '2026-03-14 17:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `gateway_transaction_id` varchar(255) DEFAULT NULL,
  `val_id` varchar(255) DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `card_type` varchar(255) DEFAULT NULL,
  `store_amount` decimal(12,2) DEFAULT NULL,
  `card_no` varchar(255) DEFAULT NULL,
  `bank_tran_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `tran_date` varchar(255) DEFAULT NULL,
  `error` varchar(255) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `card_issuer` varchar(255) DEFAULT NULL,
  `card_brand` varchar(255) DEFAULT NULL,
  `card_sub_brand` varchar(255) DEFAULT NULL,
  `card_issuer_country` varchar(255) DEFAULT NULL,
  `card_issuer_country_code` varchar(5) DEFAULT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `verify_sign` varchar(255) DEFAULT NULL,
  `verify_sign_sha2` varchar(255) DEFAULT NULL,
  `currency_type` varchar(10) DEFAULT NULL,
  `currency_amount` decimal(12,2) DEFAULT NULL,
  `currency_rate` decimal(12,4) DEFAULT NULL,
  `base_fair` decimal(12,2) DEFAULT NULL,
  `subscription_id` varchar(255) DEFAULT NULL,
  `risk_level` varchar(255) DEFAULT NULL,
  `risk_title` varchar(255) DEFAULT NULL,
  `cl_identifier` varchar(255) DEFAULT NULL,
  `cn_identifier` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `name`, `email`, `phone`, `address`, `invoice_number`, `transaction_id`, `gateway_transaction_id`, `val_id`, `amount`, `card_type`, `store_amount`, `card_no`, `bank_tran_id`, `status`, `tran_date`, `error`, `currency`, `card_issuer`, `card_brand`, `card_sub_brand`, `card_issuer_country`, `card_issuer_country_code`, `store_id`, `verify_sign`, `verify_sign_sha2`, `currency_type`, `currency_amount`, `currency_rate`, `base_fair`, `subscription_id`, `risk_level`, `risk_title`, `cl_identifier`, `cn_identifier`, `created_at`, `updated_at`) VALUES
(3, 'Anonymous User', 'backup25gb1@gmail.com', '01821144599', NULL, NULL, 'TRX-WEWHKGAZODVEG', NULL, NULL, 10.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Anonymous User', 'backup25gb1@gmail.com', '01821144599', NULL, 'INV-202603-00002', 'TRX-BB8TAFPBDMPS2', NULL, '26031417404750037021936393f', 10.00, 'BKASH-BKash', 9.75, 'KXDCE047HCD2', 'BGT746920260314126987', 'Processing', '2026-03-14 17:40:17', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'MB', 'Bangladesh', 'BD', 'opticoresolutionsltd0live', 'a0c54e6e69c00fb8ae5f5821a1337308', '81b3d4c154cc04e4e46d516ab5341ccdab8e15825a8f555d81ddd07092a8c899', 'BDT', 10.00, 1.0000, 0.00, NULL, '0', 'Safe', '8', '2', NULL, '2026-03-14 17:40:48'),
(5, 'Rashed Bro', 'rashed.bishal@live.com', '01444444444', 'Dhaka, Bangladesh', 'INV-202603-00003', 'TRX-YOVEVBTJL1SAZ', NULL, '2603281903261048120933ca05e', 10.00, 'BKASH-BKash', 9.75, 'KXDCS6K7OMRG', 'BGT473420260328139098', 'Processing', '2026-03-28 19:02:45', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'MB', 'Bangladesh', 'BD', 'alliancebuildersltdorg0live', 'b83c6d96c4a640ee4fa4bd1ed46ad835', '65e299e3dff7a4186c8320501d7b36ed5c0e1d7211f929f1be3433fcada1185a', 'BDT', 10.00, 1.0000, 0.00, NULL, '0', 'Safe', NULL, '2', NULL, '2026-03-28 13:03:28'),
(6, 'Rashed Bishal', 'backup25gb2@gmail.com', '01821144599', 'Dhaka, Bangladeshj', 'INV-202603-00004', 'TRX-7NYH4D9JP9QCX', NULL, '260329121250536298220c6ab72', 10.00, 'BKASH-BKash', 9.75, 'KXDCT5KWT3ND', 'BGT83992026032971686', 'Processing', '2026-03-29 12:12:19', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'MB', 'Bangladesh', 'BD', 'alliancebuildersltdorg0live', '313e70bc7b5c006330c22432e5a1e26d', 'ea76f4a57d87a7d944610c20d4c6ad75e7d0aaaa11b05c53d705abf61ccf1d2b', 'BDT', 10.00, 1.0000, 0.00, NULL, '0', 'Safe', NULL, '2', NULL, '2026-03-29 06:12:51'),
(7, 'Rashed Bishal', 'backup25gb2@gmail.com', '01444444444', '93 B, Gulistan', 'INV-202603-00005', 'TRX-F64NZODLPWX9F', NULL, '260329121456691552892256740', 10.00, 'BKASH-BKash', 9.75, 'KXDCT0KWWJXE', 'BGT75932026032972135', 'Processing', '2026-03-29 12:14:11', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'MB', 'Bangladesh', 'BD', 'alliancebuildersltdorg0live', '51d238bf4d8fd53a7a4bd8d8ffa157e8', 'cf7a5522ac06bbf43715e4e7e6ae37180df2242e59397e87dfc76a70ca23e651', 'BDT', 10.00, 1.0000, 0.00, NULL, '0', 'Safe', NULL, '2', NULL, '2026-03-29 06:14:57'),
(8, 'Rashed Bro', 'backup25gb1@gmail.com', '01821144599', 'Mirpur Dhaka', 'INV-202603-00006', 'TRX-FOSCGRQFLBGNV', NULL, '260329122420835782846da6664', 10.00, 'BKASH-BKash', 9.75, 'KXDCT8KXD5PW', 'BGT64952026032974291', 'Processing', '2026-03-29 12:23:49', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'MB', 'Bangladesh', 'BD', 'alliancebuildersltdorg0live', 'd1031bb853bef2be32e886978607adbc', 'bbb145e8519cd52bfaa871a71c269d7cf12810c9b3e4741da0631e1b4ab69d75', 'BDT', 10.00, 1.0000, 0.00, NULL, '0', 'Safe', NULL, '2', NULL, '2026-03-29 06:24:21'),
(9, 'Rashed Bishal', 'backup25gb1@gmail.com', '01821144599', 'Dhaka', 'INV-202603-00007', 'TRX-UI501EBXIJD4N', NULL, '26032912312580304079669394d', 10.00, 'BKASH-BKash', 9.75, 'KXDCT8KXOXLC', 'BGT18772026032975899', 'Processing', '2026-03-29 12:30:46', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'MB', 'Bangladesh', 'BD', 'alliancebuildersltdorg0live', '646f71acfcc9f30f9e31516d5443b56d', '4b4a3342cf15daf61e1384d08a36fe47e13bf7ada5cc587b9b340349e720656c', 'BDT', 10.00, 1.0000, 0.00, NULL, '0', 'Safe', NULL, '2', NULL, '2026-03-29 06:31:26'),
(10, 'Rashed Bishal', 'backup25gb1@gmail.com', '01821144599', 'Dhaka', 'INV-202603-00008', 'TRX-DUGSPLKFU0LMS', NULL, '260329125637171951343496205', 10.00, 'BKASH-BKash', 9.75, 'KXDCT7KYUXH3', 'BGT23712026032982092', 'Processing', '2026-03-29 12:56:10', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'MB', 'Bangladesh', 'BD', 'alliancebuildersltdorg0live', '369273526a728e0ef58a5c69746a7d9e', '57413f3bbaf8735c67b88bc0725cbd915ef58d06d33720f4c6f1cdc198ba02f5', 'BDT', 10.00, 1.0000, 0.00, NULL, '0', 'Safe', NULL, '2', NULL, '2026-03-29 06:56:37'),
(11, 'ajosdjkaf', '', '01896204425', 'Dhaka', NULL, 'TRX-0BPZPVFGIZSJX', NULL, NULL, 10.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Rashed Bishal', 'backup25gb1@gmail.com', '01821144599', 'Dhaka', 'INV-202603-00009', 'TRX-IX0HRWOIPOQOX', NULL, '260329141305128517482857761', 10.00, 'BKASH-BKash', 9.75, 'KXDCT1L1P3KB', 'BGT49772026032998239', 'Processing', '2026-03-29 14:12:40', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'MB', 'Bangladesh', 'BD', 'alliancebuildersltdorg0live', 'fb1aaa14255cf237ecc4bb55b63f049a', '9cb46b3b8d12524509ab7664e62c53eeba7858b1091c640e165bdd34f5b3d401', 'BDT', 10.00, 1.0000, 0.00, NULL, '0', 'Safe', NULL, '2', NULL, '2026-03-29 08:13:09'),
(13, 'Rashed Bishal', 'backup25gb1@gmail.com', '01821144599', 'Dhaka', NULL, 'TRX-SKZF54IEGQEBQ', NULL, NULL, 10.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Rashed Bishal', 'backup25gb1@gmail.com', '01821144599', 'Dhaka', NULL, 'TRX-7GMHLVS2UPBFZ', NULL, NULL, 10.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Rashed Bishal', '', '01821144599', 'Mirpur Dhaka', NULL, 'TRX-RH8K6HU9T4UGA', NULL, NULL, 10.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Rashed Bishal', '', '01821144599', 'Dhaka', NULL, 'TRX-GYBAE2EXEOTV8', NULL, NULL, 10.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Rashed Bishal', 'rashed.bishal@live.com', '01821144599', 'Mirpur Dhaka', NULL, 'TRX-TF02F27KRW12Z', NULL, NULL, 10.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Rashed', '', '01821144599', 'Dhaka', NULL, 'TRX-ID638I8WOY6NM', NULL, NULL, 10.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Sample Name', '', '+8801541255442', 'Dhaka', NULL, 'TRX-O63RFDX35CM8E', NULL, NULL, 10.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Sample Name', '', '+8801541255442', 'Dhaka', NULL, 'TRX-VKP3TWBGMJVFH', NULL, NULL, 10.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Sample Name', '', '+8801541255442', 'Dhaka', NULL, 'TRX-TVVZB2ZCFCHBU', NULL, NULL, 10.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Rashed Bishal', '', '01821144599', 'Mirpur Dhaka', 'INV-202604-00001', 'TRX-5AKQC2B542ZQK', NULL, '26040113273080374066595c9c2', 10.00, 'BKASH-BKash', 9.75, 'KXDD17OH4UBL', 'BGT805420260401112713', 'Processing', '2026-04-01 13:27:04', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'MB', 'Bangladesh', 'BD', 'alliancebuildersltdorg0live', '2c1569e5a6be360fbcce6835111ab4d0', '24044c9420a0e70aa58de9a7f2de9c93d4e680651b12411adcf889c6996f9dce', 'BDT', 10.00, 1.0000, 0.00, NULL, '0', 'Safe', NULL, '2', NULL, '2026-04-01 07:27:33'),
(23, 'Rashed Bishal', '', '01821144599', '93 B, New Eskaton Road', NULL, 'TRX-V2WQMHZMAVTZD', NULL, NULL, 10.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'MD BULBUL SORKAR', 'mdbulbulsorkar112@gmail.com', '+8801752823112', 'Dhaka', NULL, 'TRX-HVJ47XM1KI2M1', NULL, NULL, 10.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'Rashed Bishal', '', '01821144599', '93 B, New Eskaton Road', NULL, 'TRX-EP3LLW3XHH6E8', NULL, NULL, 10.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'Rashed Bishal', 'backup25gb2@gmail.com', '01821144599', '93 B, New Eskaton Road', NULL, 'TRX-DVG9JREK62RO4', NULL, NULL, 10.00, NULL, NULL, NULL, NULL, 'Cancelled', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'Rashed Bishal', '', '01821144599', 'Mirpur Dhaka', NULL, 'TRX-WZ4RWUTX6CGIC', NULL, NULL, 10.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'Lamia Rahman Atushi', 'lamiarahmanatushi@gmail.com', '+8801830266685', 'House-90, Road-Bosaw-purbo Para, Pubail-1721,Gajipur.', NULL, 'TRX-BG9QJIOQ3HBKF', NULL, NULL, 10.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'Rashed Bishal', '', '01821144599', 'Mirpur Dhaka', NULL, 'TRX-WFUY3D1VMZD7C', NULL, NULL, 10.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'XYZ', '', '01717171717', 'Dhaka', NULL, 'TRX-VKUHUUAAE5TYD', NULL, NULL, 300000.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'Sanjida', '', '01641132939', 'Mirpur', NULL, 'TRX-XHMKRFCGLAARC', NULL, NULL, 300000.00, NULL, NULL, NULL, NULL, 'Failed', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'Monisha', '', '01686768762', 'Mirur', NULL, 'TRX-XPZM04KDG4GQX', NULL, NULL, 300000.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'Saadman Omar Siddique', 'saadman.opticoresolutionsltd@gmail.com', '+8801898877532', '1179 East Monipur Road Dhaka 1216 Monipur, 1216', NULL, 'TRX-9TLM9WNTAF1S6', NULL, NULL, 300000.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'Rashed Bishal', '', '0182114459', 'mirpur', NULL, 'TRX-WGKRMLM3XQWLL', NULL, NULL, 300000.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'Opticore Solutions Ltd', 'osl.web.bd@gmail.com', '01821144599', 'asadrfaswdfswdf', NULL, 'TRX-IJMMELRUFHV73', NULL, NULL, 300000.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'Opticore Solutions Ltd', 'osl.web.bd@gmail.com', '01821144599', 'asasdfadasdasd', NULL, 'TRX-YBSU3WX8XGVKL', NULL, NULL, 300000.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'Opticore Solutions Ltd', 'osl.web.bd@gmail.com', '01821144599', 'asasdfadasdasd', NULL, 'TRX-M6XHSSXG2PFR3', NULL, NULL, 300000.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'Opticore Solutions Ltd', 'osl.web.bd@gmail.com', '01821144599', 'asdaasdada', NULL, 'TRX-GGYLON9IWQ4EB', NULL, NULL, 300000.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'Opticore Solutions Ltd', 'osl.web.bd@gmail.com', '01821144599', '1178, East Monipur, Mirpur', NULL, 'TRX-AW2MIA8KE5SO8', NULL, NULL, 300000.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'Saadman Omar Siddique', 'saadman.opticoresolutionsltd@gmail.com', '01898877532', '93 B, Eskton Road', NULL, 'TRX-Y3CRWIYXNFPKG', NULL, NULL, 300000.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'Opticore Solutions Ltd', 'osl.web.bd@gmail.com', '01821144599', '1178, East Monipur, Mirpur', NULL, 'TRX-F5RDUQA5ZJEWL', NULL, NULL, 300000.00, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, 'BDT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` enum('acc_admin','admin','client','vw_admin','sales') NOT NULL DEFAULT 'client',
  `provider` varchar(255) DEFAULT NULL,
  `provider_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `role`, `provider`, `provider_id`, `created_at`, `updated_at`) VALUES
(1, 'Rashed Bishal', 'rashed.bishal@live.com', '2025-12-22 13:12:49', '$argon2id$v=19$m=65536,t=4,p=2$VXFpTmtXdENZbTlKN2ZmSw$KpRnzBFxek44aMyzatngqArged0FwXyQhrqP99jZmnM', NULL, NULL, NULL, NULL, 'acc_admin', NULL, NULL, '2025-12-22 13:11:25', '2025-12-25 17:30:24'),
(8, 'Anonymous User', 'backup25gb1@gmail.com', '2026-03-14 10:47:13', '$argon2id$v=19$m=65536,t=4,p=2$U2tLbXFHNDJxS2hrZmhPVQ$HoPKOlOnf+oTjc/y1cXpR4QibwtI9JEs7hBdW+1Y+es', NULL, NULL, NULL, NULL, 'client', 'google', '103409754807726443701', '2026-03-14 10:47:13', '2026-03-14 17:41:06'),
(9, 'Viewer', 'viewer@osl.com', '2026-03-14 17:06:28', '$argon2id$v=19$m=65536,t=4,p=2$SlIxUlNhbnQ3bGRvWlVhdg$dXfbQnH4elGdH879zhkATrdCwVZtV8KIrZxZ2QdpZro', NULL, NULL, NULL, NULL, 'vw_admin', NULL, NULL, '2026-03-14 17:06:28', '2026-03-14 17:06:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`),
  ADD KEY `clients_concern_id_foreign` (`concern_id`),
  ADD KEY `clients_user_id_foreign` (`user_id`);

--
-- Indexes for table `client_images`
--
ALTER TABLE `client_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_images_shareform_id_foreign` (`shareform_id`);

--
-- Indexes for table `concerns`
--
ALTER TABLE `concerns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  ADD UNIQUE KEY `invoices_public_token_unique` (`public_token`),
  ADD KEY `invoices_order_number_index` (`order_number`),
  ADD KEY `invoices_invoice_number_index` (`invoice_number`);

--
-- Indexes for table `invoice_number_sequence`
--
ALTER TABLE `invoice_number_sequence`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_number_sequence_prefix_period_unique` (`prefix`,`period`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `money_receipt_sequences`
--
ALTER TABLE `money_receipt_sequences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `money_receipt_sequences_period_unique` (`period`),
  ADD KEY `money_receipt_sequences_period_index` (`period`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_client_id_index` (`client_id`),
  ADD KEY `orders_order_number_index` (`order_number`);

--
-- Indexes for table `order_number_sequences`
--
ALTER TABLE `order_number_sequences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_number_sequences_prefix_period_unique` (`prefix`,`period`);

--
-- Indexes for table `order_service`
--
ALTER TABLE `order_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_service_order_id_foreign` (`order_id`),
  ADD KEY `order_service_service_id_foreign` (`service_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `religions`
--
ALTER TABLE `religions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_officers`
--
ALTER TABLE `sales_officers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sales_officers_email_unique` (`email`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_concern_id_foreign` (`concern_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shareforms`
--
ALTER TABLE `shareforms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shareforms_share_number_unique` (`share_number`),
  ADD KEY `shareforms_gender_id_foreign` (`gender_id`),
  ADD KEY `shareforms_religion_id_foreign` (`religion_id`),
  ADD KEY `shareforms_service_id_foreign` (`service_id`),
  ADD KEY `shareforms_paymentmethod_id_foreign` (`paymentmethod_id`),
  ADD KEY `shareforms_order_id_foreign` (`order_id`),
  ADD KEY `shareforms_sales_officer_id_foreign` (`sales_officer_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_transaction_id_unique` (`transaction_id`),
  ADD UNIQUE KEY `transactions_gateway_transaction_id_unique` (`gateway_transaction_id`),
  ADD UNIQUE KEY `transactions_val_id_unique` (`val_id`),
  ADD UNIQUE KEY `transactions_bank_tran_id_unique` (`bank_tran_id`),
  ADD KEY `transactions_cn_identifier_updated_at_index` (`cn_identifier`,`updated_at`),
  ADD KEY `transactions_status_updated_at_index` (`status`,`updated_at`);

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
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client_images`
--
ALTER TABLE `client_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `concerns`
--
ALTER TABLE `concerns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `invoice_number_sequence`
--
ALTER TABLE `invoice_number_sequence`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `money_receipt_sequences`
--
ALTER TABLE `money_receipt_sequences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_number_sequences`
--
ALTER TABLE `order_number_sequences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_service`
--
ALTER TABLE `order_service`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `religions`
--
ALTER TABLE `religions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales_officers`
--
ALTER TABLE `sales_officers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shareforms`
--
ALTER TABLE `shareforms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_concern_id_foreign` FOREIGN KEY (`concern_id`) REFERENCES `concerns` (`id`),
  ADD CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `client_images`
--
ALTER TABLE `client_images`
  ADD CONSTRAINT `client_images_shareform_id_foreign` FOREIGN KEY (`shareform_id`) REFERENCES `shareforms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_order_number_foreign` FOREIGN KEY (`order_number`) REFERENCES `orders` (`order_number`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_service`
--
ALTER TABLE `order_service`
  ADD CONSTRAINT `order_service_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_service_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_concern_id_foreign` FOREIGN KEY (`concern_id`) REFERENCES `concerns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shareforms`
--
ALTER TABLE `shareforms`
  ADD CONSTRAINT `shareforms_gender_id_foreign` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `shareforms_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `shareforms_paymentmethod_id_foreign` FOREIGN KEY (`paymentmethod_id`) REFERENCES `payment_methods` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `shareforms_religion_id_foreign` FOREIGN KEY (`religion_id`) REFERENCES `religions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `shareforms_sales_officer_id_foreign` FOREIGN KEY (`sales_officer_id`) REFERENCES `sales_officers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `shareforms_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
