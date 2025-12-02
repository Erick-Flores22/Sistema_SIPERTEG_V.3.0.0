-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2025 a las 00:12:53
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `siperteg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonados`
--

CREATE TABLE `abonados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `ci` varchar(255) NOT NULL,
  `telefono1` varchar(255) NOT NULL,
  `telefono2` varchar(255) DEFAULT NULL,
  `zona` varchar(255) NOT NULL,
  `calle` varchar(255) NOT NULL,
  `numero_casa` varchar(255) NOT NULL,
  `fecha_corte` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `abonados`
--

INSERT INTO `abonados` (`id`, `nombre`, `apellido`, `ci`, `telefono1`, `telefono2`, `zona`, `calle`, `numero_casa`, `fecha_corte`, `created_at`, `updated_at`, `estado`) VALUES
(1, 'Erick', 'Flores', '9869194', '76554914', '78624247', 'Los Andes III', 'Calle 7', '300', NULL, '2025-12-02 01:46:44', '2025-12-02 01:46:44', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas_distribucion`
--

CREATE TABLE `cajas_distribucion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nodo_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `zona` varchar(255) NOT NULL,
  `capacidad` tinyint(3) UNSIGNED NOT NULL DEFAULT 16,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `potencia_partida` decimal(6,2) NOT NULL,
  `potencia_llegada` decimal(6,2) NOT NULL,
  `potencia_distribucion` decimal(6,2) NOT NULL,
  `usuarios_conectados` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `plano_subtroncal` varchar(255) DEFAULT NULL,
  `foto_caja` varchar(255) DEFAULT NULL,
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobros`
--

CREATE TABLE `cobros` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `abonado_id` bigint(20) UNSIGNED NOT NULL,
  `periodo_id` bigint(20) UNSIGNED NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `plataforma` varchar(255) DEFAULT NULL,
  `estado_pago` enum('pagado','pendiente') NOT NULL DEFAULT 'pendiente',
  `fecha_pago` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_tecnicos`
--

CREATE TABLE `datos_tecnicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `abonado_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `odn` varchar(255) NOT NULL,
  `pon` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `codigo_tecnico` varchar(255) NOT NULL,
  `codigo_sistema` varchar(255) NOT NULL,
  `fecha_instalacion` date NOT NULL,
  `foto_plano` varchar(255) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nodo_id` bigint(20) UNSIGNED NOT NULL,
  `caja_distribucion_id` bigint(20) UNSIGNED NOT NULL,
  `potencia_partida` decimal(6,2) NOT NULL,
  `potencia_llegada` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `defectos`
--

CREATE TABLE `defectos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `celular` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `detalle` text NOT NULL,
  `estado` enum('PENDIENTE','RESUELTA') NOT NULL DEFAULT 'PENDIENTE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
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
-- Estructura de tabla para la tabla `fallas`
--

CREATE TABLE `fallas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `abonado_id` bigint(20) UNSIGNED NOT NULL,
  `tipo_falla` enum('material','caja') NOT NULL,
  `detalle` text DEFAULT NULL,
  `estado` enum('pendiente','resuelta') NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestiones`
--

CREATE TABLE `gestiones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `anio` year(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instalaciones`
--

CREATE TABLE `instalaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `celular` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `estado` enum('PENDIENTE','COMPLETADA') NOT NULL DEFAULT 'PENDIENTE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
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
-- Estructura de tabla para la tabla `job_batches`
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
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(5, '2025_04_14_144051_create_datos_tecnicos_table', 2),
(6, '2025_04_16_135644_create_cobros_table', 3),
(7, '2025_04_17_182128_create_fallas_table', 4),
(8, '2025_04_18_013039_create_nodos_table', 5),
(9, '2025_04_18_013355_create_cajas_distribucion_table', 6),
(10, '2025_04_18_014224_create_cajas_distribucion_table', 7),
(11, '2025_04_18_230348_add_rol_and_telefono_to_users_table', 8),
(12, '2025_04_18_230743_add_rol_and_telefono_to_users_table', 9),
(13, '2025_05_12_160711_add_mapa_link_to_datos_tecnicos_table', 10),
(14, '2025_05_12_161030_add_mapa_link_to_datos_tecnicos_table', 11),
(15, '2025_05_14_152741_create_instalaciones_table', 12),
(16, '2025_05_14_160904_create_defectos_table', 13),
(17, '2025_05_25_221042_add_two_factor_columns_to_users_table', 14),
(18, '2025_05_26_201642_add_google2fa_secret_to_users_table', 15),
(19, '2025_05_28_000000_create_conversations_table', 16),
(20, '2025_05_28_000001_create_messages_table', 17),
(21, '2025_09_20_191924_create_gestiones_table', 18),
(22, '2025_09_20_192516_create_gestiones_table', 19),
(23, '2025_09_20_192723_create_periodos_table', 20),
(24, '2025_09_20_193346_create_cobros_table', 21),
(25, '2025_10_04_181215_add_role_to_users_table', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nodos`
--

CREATE TABLE `nodos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `zona` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `capacidad` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `puerto_olt` varchar(100) NOT NULL,
  `puerto_edfa` varchar(100) NOT NULL,
  `potencia_partida` decimal(5,2) NOT NULL,
  `potencia_llegada` decimal(5,2) NOT NULL,
  `potencia_distribucion` decimal(5,2) NOT NULL,
  `cajas_conectadas` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `plano_troncal` varchar(255) DEFAULT NULL,
  `foto_nodo` varchar(255) DEFAULT NULL,
  `observacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE `periodos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gestion_id` bigint(20) UNSIGNED NOT NULL,
  `mes` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `precio_mensual` decimal(10,2) NOT NULL,
  `velocidad_megas` int(11) NOT NULL,
  `dispositivos_tv` int(11) DEFAULT 0,
  `dispositivos_pc` int(11) DEFAULT 0,
  `dispositivos_celular` int(11) DEFAULT 0,
  `precio_instalacion` decimal(10,2) NOT NULL,
  `es_promocion` tinyint(1) DEFAULT 0,
  `precio_promocion_instalacion` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
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
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('PSlanhHyKF6UEFeb0FGnfoPHckLzy6Dm1dzvBmi5', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOGplNjVVeFh0MTNVZU15V2lCWUV4a3FiU2Q2Vm83aXFyQzJlVTJMUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wbGFuZXMiO31zOjc6ImNhcHRjaGEiO2E6MTp7czo2OiJwYXNzZWQiO2I6MTt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Nzt9', 1764552187),
('tbnNyVpTGeLucHX643gVPEsDYdOU2lbeK7GxDzUn', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibTY0NUhEOTA0ZzVKVHpqVWZsa3g5OGNBS01mVzY2c1Vyc0ZxOVlHMCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9nZXN0aW9uZXMiO31zOjc6ImNhcHRjaGEiO2E6MTp7czo2OiJwYXNzZWQiO2I6MTt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODt9', 1764628774);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','cobrador','tecnico','asistente') NOT NULL DEFAULT 'asistente',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `google2fa_secret` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `google2fa_secret`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Erick', 'erickfranciscofloresmendoza@gmail.com', 'admin', NULL, '$2y$12$VttjXJEK2G0H9dwKmqVjk.2SeqIopSouZbOulkGyVh56dbu0e3QuG', NULL, NULL, '2025-05-26 02:27:36', '2025-05-26 06:50:21'),
(7, 'Admin', 'admin@example.com', 'admin', '2025-10-04 23:25:05', '$2y$12$4rURNWEBmQ/TT.hy1xvxNugTsB5pfupTxLeOL6Qpj9Aiam463Z6G.', NULL, NULL, '2025-10-04 23:25:05', '2025-10-04 23:25:05'),
(8, 'Cobrador', 'cobrador@example.com', 'cobrador', '2025-10-04 23:25:05', '$2y$12$Qyp9afp9viuJU5IIZC7LROrsqAqFzdi1zWw96K7tJ0tVYWmgEU3gq', NULL, NULL, '2025-10-04 23:25:05', '2025-10-04 23:25:05'),
(9, 'Tecnico', 'tecnico@example.com', 'tecnico', '2025-10-04 23:25:06', '$2y$12$4ruUQd7eRUBt9sHAPKhTYumBfJc.Jj3ficoAQgveVRO8kH.uLx6Q2', NULL, NULL, '2025-10-04 23:25:06', '2025-10-04 23:25:06'),
(10, 'Asistente', 'asistente@example.com', 'asistente', NULL, '$2y$12$2z70SFuetV7nExbqBOoxHuhktA6TiGjCy/p1KJoUh1yrFYirpT9H6', NULL, NULL, '2025-12-02 02:00:19', '2025-12-02 02:00:19');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abonados`
--
ALTER TABLE `abonados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `abonados_ci_unique` (`ci`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cajas_distribucion`
--
ALTER TABLE `cajas_distribucion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cajas_distribucion_nodo_id_foreign` (`nodo_id`),
  ADD KEY `created_at` (`created_at`);

--
-- Indices de la tabla `cobros`
--
ALTER TABLE `cobros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cobros_abonado_id_periodo_id_unique` (`abonado_id`,`periodo_id`),
  ADD KEY `cobros_periodo_id_foreign` (`periodo_id`);

--
-- Indices de la tabla `datos_tecnicos`
--
ALTER TABLE `datos_tecnicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `datos_tecnicos_abonado_id_foreign` (`abonado_id`),
  ADD KEY `fk_datos_nodo` (`nodo_id`),
  ADD KEY `fk_datos_caja` (`caja_distribucion_id`),
  ADD KEY `datos_tecnicos_plan_id_foreign` (`plan_id`);

--
-- Indices de la tabla `defectos`
--
ALTER TABLE `defectos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `fallas`
--
ALTER TABLE `fallas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fallas_abonado` (`abonado_id`);

--
-- Indices de la tabla `gestiones`
--
ALTER TABLE `gestiones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gestiones_anio_unique` (`anio`);

--
-- Indices de la tabla `instalaciones`
--
ALTER TABLE `instalaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nodos`
--
ALTER TABLE `nodos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `periodos`
--
ALTER TABLE `periodos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonados`
--
ALTER TABLE `abonados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cajas_distribucion`
--
ALTER TABLE `cajas_distribucion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cobros`
--
ALTER TABLE `cobros`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datos_tecnicos`
--
ALTER TABLE `datos_tecnicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `defectos`
--
ALTER TABLE `defectos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fallas`
--
ALTER TABLE `fallas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gestiones`
--
ALTER TABLE `gestiones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `instalaciones`
--
ALTER TABLE `instalaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `nodos`
--
ALTER TABLE `nodos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `periodos`
--
ALTER TABLE `periodos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cajas_distribucion`
--
ALTER TABLE `cajas_distribucion`
  ADD CONSTRAINT `cajas_distribucion_nodo_id_foreign` FOREIGN KEY (`nodo_id`) REFERENCES `nodos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cobros`
--
ALTER TABLE `cobros`
  ADD CONSTRAINT `cobros_abonado_id_foreign` FOREIGN KEY (`abonado_id`) REFERENCES `abonados` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cobros_periodo_id_foreign` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `datos_tecnicos`
--
ALTER TABLE `datos_tecnicos`
  ADD CONSTRAINT `datos_tecnicos_abonado_id_foreign` FOREIGN KEY (`abonado_id`) REFERENCES `abonados` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `datos_tecnicos_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `planes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_datos_caja` FOREIGN KEY (`caja_distribucion_id`) REFERENCES `cajas_distribucion` (`id`),
  ADD CONSTRAINT `fk_datos_nodo` FOREIGN KEY (`nodo_id`) REFERENCES `nodos` (`id`);

--
-- Filtros para la tabla `fallas`
--
ALTER TABLE `fallas`
  ADD CONSTRAINT `fallas_abonado_id_foreign` FOREIGN KEY (`abonado_id`) REFERENCES `abonados` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_fallas_abonado` FOREIGN KEY (`abonado_id`) REFERENCES `abonados` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
