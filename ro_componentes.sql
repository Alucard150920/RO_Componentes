-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2025 a las 16:21:31
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ro_componentes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codPro` int(11) NOT NULL,
  `nomPro` varchar(100) DEFAULT NULL,
  `imgPro` varchar(255) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `prePro` decimal(10,2) DEFAULT NULL,
  `stkPro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codPro`, `nomPro`, `imgPro`, `categoria`, `prePro`, `stkPro`) VALUES
(1, 'Procesador Ryzen 5 5600X', NULL, 'Componentes PC', 699.00, 7),
(2, 'Tarjeta Gráfica RTX 3060', NULL, 'Componentes PC', 1600.00, 4),
(3, 'Placa Madre B550', NULL, 'Componentes PC', 480.00, 6),
(4, 'Procesador AMD Ryzen 5 5600X', NULL, 'Componentes PC', 699.00, 9),
(5, 'Procesador Intel Core i5-12400F', NULL, 'Componentes PC', 780.00, 7),
(6, 'Tarjeta Gráfica NVIDIA RTX 3060', NULL, 'Componentes PC', 1600.00, 5),
(7, 'Tarjeta Gráfica AMD Radeon RX 6600', NULL, 'Componentes PC', 1450.00, 6),
(8, 'Placa Madre MSI B550M PRO', NULL, 'Componentes PC', 480.00, 11),
(9, 'Placa Madre ASUS Prime B660M', NULL, 'Componentes PC', 530.00, 10),
(10, 'Memoria RAM Corsair Vengeance 16GB (2x8) DDR4', NULL, 'Componentes PC', 330.00, 15),
(11, 'Memoria RAM Kingston Fury 8GB DDR4', NULL, 'Componentes PC', 160.00, 18),
(12, 'SSD Kingston NV2 500GB M.2 NVMe', NULL, 'Componentes PC', 230.00, 18),
(13, 'SSD Crucial MX500 1TB SATA', NULL, 'Componentes PC', 320.00, 14),
(14, 'Disco Duro Seagate Barracuda 2TB', NULL, 'Componentes PC', 280.00, 9),
(15, 'Fuente de Poder EVGA 600W 80+ Bronze', NULL, 'Componentes PC', 250.00, 8),
(16, 'Fuente de Poder Corsair CX650M 80+ Bronze', NULL, 'Componentes PC', 295.00, 6),
(17, 'Gabinete Cougar MX330 ATX', NULL, 'Componentes PC', 240.00, 6),
(18, 'Gabinete NZXT H510 ATX', NULL, 'Componentes PC', 370.00, 5),
(19, 'Cooler Master Hyper 212 Black Edition', NULL, 'Otros', 150.00, 11),
(20, 'Mouse Logitech G203 LIGHTSYNC RGB', NULL, 'Periféricos', 95.00, 25),
(21, 'Teclado Redragon Kumara K552 RGB', NULL, 'Periféricos', 150.00, 16),
(22, 'Monitor LG 24MP400-B 24\" IPS 75Hz', NULL, 'Periféricos', 650.00, 8),
(23, 'Monitor AOC 27G2 27\" 144Hz IPS', NULL, 'Periféricos', 1050.00, 4),
(24, 'Procesador Intel Core i7-12700K', NULL, 'Componentes PC', 1350.00, 7),
(25, 'Procesador AMD Ryzen 9 7900X', NULL, 'Componentes PC', 2150.00, 3),
(26, 'Tarjeta Gráfica NVIDIA RTX 4070 Ti', NULL, 'Componentes PC', 3400.00, 2),
(27, 'Tarjeta Gráfica AMD Radeon RX 7900 XT', NULL, 'Componentes PC', 3100.00, 3),
(28, 'Placa Madre ASUS ROG Strix Z690-E', NULL, 'Componentes PC', 1500.00, 5),
(29, 'Placa Madre Gigabyte X670 AORUS Elite', NULL, 'Componentes PC', 1250.00, 6),
(30, 'Memoria RAM G.Skill Trident Z RGB 32GB (2x16) DDR5', NULL, 'Componentes PC', 850.00, 8),
(31, 'Memoria RAM Corsair Dominator Platinum 64GB (4x16) DDR5', NULL, 'Componentes PC', 1700.00, 2),
(32, 'SSD Samsung 980 Pro 1TB M.2 NVMe', NULL, 'Componentes PC', 720.00, 10),
(33, 'SSD WD Black SN850X 2TB M.2 NVMe', NULL, 'Componentes PC', 1350.00, 4),
(34, 'Disco Duro Toshiba X300 4TB', NULL, 'Componentes PC', 560.00, 5),
(35, 'Fuente de Poder Seasonic Focus GX-750 80+ Gold', NULL, 'Componentes PC', 520.00, 6),
(36, 'Fuente de Poder Corsair RM850x 80+ Gold', NULL, 'Componentes PC', 680.00, 3),
(37, 'Gabinete Lian Li PC-O11 Dynamic', NULL, 'Componentes PC', 950.00, 2),
(38, 'Gabinete Phanteks Eclipse P400A', NULL, 'Componentes PC', 540.00, 4),
(39, 'Refrigeración Líquida NZXT Kraken X63', NULL, 'Componentes PC', 890.00, 3),
(40, 'Refrigeración Líquida Corsair H150i Elite Capellix', NULL, 'Componentes PC', 1250.00, 2),
(41, 'Monitor Samsung Odyssey G7 32\" 240Hz', NULL, 'Periféricos', 3150.00, 1),
(42, 'Monitor Dell UltraSharp U2723QE 27\" 4K', NULL, 'Periféricos', 2800.00, 2),
(43, 'Teclado Logitech G915 TKL Wireless RGB', NULL, 'Periféricos', 950.00, 5),
(44, 'Mouse Razer DeathAdder V2 Pro Wireless', NULL, 'Periféricos', 620.00, 6),
(45, 'Auriculares HyperX Cloud II Wireless', NULL, 'Periféricos', 680.00, 7),
(46, 'Auriculares SteelSeries Arctis Nova 7 Wireless', NULL, 'Periféricos', 750.00, 4),
(47, 'Cámara Web Logitech C922 Pro Stream', NULL, 'Periféricos', 420.00, 8),
(48, 'Cámara Web Razer Kiyo Pro', NULL, 'Periféricos', 680.00, 5),
(49, 'Silla Gamer Corsair T3 Rush', NULL, 'Periféricos', 1550.00, 2),
(50, 'Silla Gamer Secretlab Titan Evo 2022', NULL, 'Periféricos', 2250.00, 1),
(51, 'Impresora HP LaserJet Pro M404dn', NULL, 'Periféricos', 1100.00, 3),
(52, 'Impresora Epson EcoTank L3250', NULL, 'Periféricos', 950.00, 4),
(53, 'Router ASUS RT-AX88U WiFi 6', NULL, 'Periféricos', 1350.00, 2),
(54, 'Router TP-Link Archer AX6000 WiFi 6', NULL, 'Periféricos', 1280.00, 3),
(55, 'Tarjeta de Sonido Creative Sound BlasterX AE-5', NULL, 'Otros', 780.00, 4),
(56, 'Hub USB-C Anker 7-en-1', NULL, 'Periféricos', 280.00, 10),
(57, 'Cargador Portátil Anker PowerCore 26800mAh', NULL, 'Periféricos', 450.00, 7),
(58, 'Lector de Tarjetas SanDisk Extreme PRO', NULL, 'Periféricos', 180.00, 12),
(59, 'Alfombrilla Logitech G640', NULL, 'Periféricos', 150.00, 15),
(60, 'Alfombrilla Razer Goliathus Extended Chroma', NULL, 'Periféricos', 380.00, 8),
(61, 'Cámara de Seguridad Xiaomi Mi 360°', NULL, 'Periféricos', 320.00, 9),
(62, 'Disco Externo WD Elements 2TB', NULL, 'Otros', 400.00, 6),
(63, 'Disco Externo Seagate Backup Plus 4TB', NULL, 'Otros', 750.00, 4),
(64, 'Kit Ventiladores Corsair LL120 RGB (3 Pack)', NULL, 'Periféricos', 850.00, 5),
(65, 'Kit Ventiladores NZXT Aer RGB 2 (3 Pack)', NULL, 'Periféricos', 920.00, 3),
(66, 'Adaptador WiFi USB TP-Link Archer T3U Plus', NULL, 'Periféricos', 120.00, 20),
(67, 'Adaptador Bluetooth 5.0 UGREEN', NULL, 'Periféricos', 90.00, 25),
(68, 'Soporte Monitor North Bayou F80', NULL, 'Periféricos', 240.00, 10),
(69, 'Soporte Monitor Ergotron LX Desk Mount', NULL, 'Periféricos', 980.00, 3),
(70, 'Micrófono HyperX QuadCast S RGB', NULL, 'Periféricos', 650.00, 4),
(71, 'Micrófono Blue Yeti X', NULL, 'Periféricos', 850.00, 2),
(72, 'Control Xbox Series X Wireless', NULL, 'Periféricos', 380.00, 8),
(73, 'Control Sony DualSense PS5', NULL, 'Periféricos', 420.00, 6),
(74, 'Procesador AMD Ryzen 7 5800X3D', NULL, 'Componentes PC', 1900.00, 5),
(75, 'Procesador Intel Core i9-13900K', NULL, 'Componentes PC', 2600.00, 3),
(76, 'Tarjeta Gráfica NVIDIA RTX 4080', NULL, 'Componentes PC', 4600.00, 2),
(77, 'Tarjeta Gráfica AMD Radeon RX 7800 XT', NULL, 'Componentes PC', 3900.00, 3),
(78, 'Placa Madre MSI MAG B650 Tomahawk', NULL, 'Componentes PC', 1350.00, 4),
(79, 'Placa Madre ASRock X670E Taichi', NULL, 'Componentes PC', 2100.00, 2),
(80, 'Memoria RAM Kingston Fury Beast 32GB (2x16) DDR5', NULL, 'Componentes PC', 1100.00, 6),
(81, 'Memoria RAM G.Skill Ripjaws V 64GB (2x32) DDR4', NULL, 'Componentes PC', 1900.00, 3),
(82, 'SSD Samsung 990 Pro 2TB M.2 NVMe', NULL, 'Componentes PC', 1800.00, 4),
(83, 'SSD Crucial P5 Plus 1TB M.2 NVMe', NULL, 'Componentes PC', 850.00, 7),
(84, 'Disco Duro Seagate IronWolf 6TB NAS', NULL, 'Componentes PC', 1150.00, 2),
(85, 'Fuente de Poder EVGA SuperNOVA 1000 G5 80+ Gold', NULL, 'Componentes PC', 1200.00, 3),
(86, 'Fuente de Poder Thermaltake Toughpower GF3 850W 80+ Gold', NULL, 'Componentes PC', 1050.00, 4),
(87, 'Gabinete Fractal Design Meshify 2', NULL, 'Componentes PC', 1250.00, 2),
(88, 'Gabinete Cooler Master TD500 Mesh', NULL, 'Componentes PC', 890.00, 5),
(89, 'Refrigeración Líquida Arctic Liquid Freezer II 360', NULL, 'Componentes PC', 950.00, 3),
(90, 'Refrigeración Líquida EK-AIO 360 D-RGB', NULL, 'Componentes PC', 1450.00, 2),
(91, 'Monitor ASUS TUF Gaming VG27AQ1A 27\" 170Hz', NULL, 'Periféricos', 1350.00, 6),
(92, 'Monitor Gigabyte M32Q 32\" 165Hz QHD', NULL, 'Periféricos', 2100.00, 2),
(93, 'Teclado SteelSeries Apex Pro TKL Wireless', NULL, 'Periféricos', 1350.00, 3),
(94, 'Mouse Logitech MX Master 3S', NULL, 'Periféricos', 480.00, 8),
(95, 'Auriculares Razer BlackShark V2 Pro Wireless', NULL, 'Periféricos', 980.00, 4),
(96, 'Auriculares Logitech G PRO X Wireless', NULL, 'Periféricos', 1050.00, 3),
(97, 'Cámara Web Elgato Facecam', NULL, 'Periféricos', 1100.00, 2),
(98, 'Cámara Web Logitech Brio 4K', NULL, 'Periféricos', 1450.00, 1),
(99, 'Silla Gamer Cougar Armor S', NULL, 'Periféricos', 1750.00, 3),
(100, 'Silla Ergonomica Herman Miller Aeron', NULL, 'Periféricos', 8500.00, 1),
(101, 'Impresora Brother HL-L2350DW', NULL, 'Periféricos', 950.00, 5),
(102, 'Impresora Canon PIXMA G6020 MegaTank', NULL, 'Periféricos', 1200.00, 2),
(103, 'Router Netgear Nighthawk AX12 WiFi 6', NULL, 'Periféricos', 1950.00, 1),
(104, 'Router Linksys Velop MX4200 Mesh WiFi 6', NULL, 'Periféricos', 2450.00, 2),
(105, 'Tarjeta de Sonido ASUS Xonar AE', NULL, 'Otros', 580.00, 6),
(106, 'Hub USB-C Satechi Multiport Adapter V2', NULL, 'Periféricos', 420.00, 8),
(107, 'Cargador Portátil Xiaomi Mi Power Bank 3 Pro 20000mAh', NULL, 'Periféricos', 390.00, 10),
(108, 'Lector de Tarjetas Kingston MobileLite Plus', NULL, 'Periféricos', 250.00, 7),
(109, 'Alfombrilla Corsair MM700 RGB Extended', NULL, 'Periféricos', 650.00, 4),
(110, 'Alfombrilla HyperX Fury S Pro XL', NULL, 'Periféricos', 280.00, 9),
(111, 'Cámara de Seguridad Blink Outdoor (3rd Gen)', NULL, 'Periféricos', 950.00, 3),
(112, 'Disco Externo LaCie Rugged 5TB', NULL, 'Otros', 1250.00, 2),
(113, 'Disco Externo Samsung T7 Touch 1TB', NULL, 'Otros', 750.00, 5),
(114, 'Kit Ventiladores Arctic F12 PWM PST (5 Pack)', NULL, 'Periféricos', 450.00, 10),
(115, 'Kit Ventiladores Thermaltake Pure 12 ARGB (3 Pack)', NULL, 'Periféricos', 650.00, 6),
(116, 'Adaptador WiFi PCIe ASUS PCE-AX58BT WiFi 6', NULL, 'Periféricos', 680.00, 4),
(117, 'Adaptador Bluetooth ASUS USB-BT500', NULL, 'Periféricos', 120.00, 12),
(118, 'Soporte Monitor Huanuo HNDS6', NULL, 'Periféricos', 380.00, 8),
(119, 'Soporte Monitor AmazonBasics Premium', NULL, 'Periféricos', 980.00, 3),
(120, 'Micrófono Shure MV7 USB/XLR', NULL, 'Periféricos', 1450.00, 2),
(121, 'Micrófono Rode NT-USB Mini', NULL, 'Periféricos', 550.00, 5),
(122, 'Control Nintendo Switch Pro', NULL, 'Periféricos', 420.00, 6),
(123, 'Control 8BitDo Pro 2 Bluetooth', NULL, 'Periféricos', 360.00, 7),
(124, 'Batería Original HP Pavilion 15', NULL, 'Componentes Laptop', 320.00, 10),
(125, 'Pantalla LED 14\" Slim Full HD para Lenovo', NULL, 'Componentes Laptop', 450.00, 8),
(126, 'Teclado Retroiluminado para ASUS VivoBook', NULL, 'Componentes Laptop', 180.00, 15),
(127, 'Cargador Original Dell 65W Tipo C', NULL, 'Componentes Laptop', 220.00, 12),
(128, 'Disco SSD NVMe 512GB para Laptop Acer', NULL, 'Componentes Laptop', 370.00, 9),
(129, 'Módulo RAM DDR4 8GB 2666MHz para HP', NULL, 'Componentes Laptop', 250.00, 18),
(130, 'Touchpad Original para MacBook Pro 13\"', NULL, 'Componentes Laptop', 800.00, 5),
(131, 'Batería ASUS A32-K55', NULL, 'Componentes Laptop', 310.00, 11),
(132, 'Pantalla Retina 13\" para MacBook Air', NULL, 'Componentes Laptop', 1250.00, 3),
(133, 'Ventilador Interno para Acer Aspire 5', NULL, 'Componentes Laptop', 90.00, 20),
(134, 'Cable Flex de Pantalla para HP 250 G7', NULL, 'Componentes Laptop', 60.00, 25),
(135, 'Altavoces Internos para Lenovo IdeaPad', NULL, 'Componentes Laptop', 150.00, 7),
(136, 'Batería Original Dell Inspiron 15', NULL, 'Componentes Laptop', 340.00, 9),
(137, 'Cargador MagSafe 2 para MacBook Pro', NULL, 'Componentes Laptop', 480.00, 6),
(138, 'HDD 1TB 2.5\" para Laptop Toshiba', NULL, 'Componentes Laptop', 320.00, 8),
(139, 'Bisagras de Repuesto para ASUS X556U', NULL, 'Componentes Laptop', 100.00, 12),
(140, 'Webcam HD Interna para Lenovo ThinkPad', NULL, 'Componentes Laptop', 190.00, 10),
(141, 'Memoria RAM DDR4 16GB 3200MHz para Dell', NULL, 'Componentes Laptop', 480.00, 5),
(142, 'Teclado Español para HP EliteBook 840', NULL, 'Componentes Laptop', 200.00, 9),
(143, 'Pantalla Touch 15.6\" para Dell XPS', NULL, 'Componentes Laptop', 1850.00, 2),
(144, 'Batería Original MSI GE75 Raider', NULL, 'Componentes Laptop', 550.00, 4),
(145, 'Cable DC Jack para Acer Nitro 5', NULL, 'Componentes Laptop', 75.00, 18),
(146, 'Disco SSD SATA 1TB para Laptop ASUS', NULL, 'Componentes Laptop', 590.00, 7),
(147, 'Kit Tornillos y Gomas para MacBook Air', NULL, 'Componentes Laptop', 85.00, 30),
(148, 'Cargador Original Lenovo 65W USB-C', NULL, 'Componentes Laptop', 260.00, 10),
(149, 'Placa Base para HP Pavilion Gaming 15', NULL, 'Componentes Laptop', 2100.00, 1),
(150, 'Altavoces Estéreo para Dell Latitude', NULL, 'Componentes Laptop', 180.00, 6),
(151, 'Touchpad para ASUS ZenBook UX425', NULL, 'Componentes Laptop', 380.00, 5),
(152, 'Pantalla OLED 14\" para ASUS ZenBook', NULL, 'Componentes Laptop', 2300.00, 2),
(153, 'Repuesto Ventilador para MacBook Air M1', NULL, 'Componentes Laptop', 420.00, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `codUsu` int(11) NOT NULL,
  `nomUsu` varchar(100) DEFAULT NULL,
  `emaUsu` varchar(100) DEFAULT NULL,
  `pasUsu` varchar(255) DEFAULT NULL,
  `rol` enum('admin','cliente') NOT NULL DEFAULT 'cliente',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`codUsu`, `nomUsu`, `emaUsu`, `pasUsu`, `rol`, `fecha_registro`) VALUES
(1, 'Renzo', 'renzo@gmail.com', '$2y$10$AhXsbOOJBKBaMrbm35Ek5.Gw1JOqeWWr1SF1T7I8ATtp1H66wUT/m', 'admin', '2025-07-05 18:10:57'),
(2, 'Hugo', 'hugo@gmail.com', '$2y$10$E0nwwFXKAff6u0NvUjRj8Osf8IOB0tdxpV1JhQ/pICarLA22FQWWG', 'cliente', '2025-07-05 18:23:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `codVen` int(11) NOT NULL,
  `codPro` int(11) DEFAULT NULL,
  `canVen` int(11) DEFAULT NULL,
  `fecVen` timestamp NOT NULL DEFAULT current_timestamp(),
  `codUsu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`codVen`, `codPro`, `canVen`, `fecVen`, `codUsu`) VALUES
(1, 1, 1, '2025-06-30 18:28:35', NULL),
(2, 2, 1, '2025-06-30 20:16:46', NULL),
(3, 11, 2, '2025-06-30 20:16:46', NULL),
(4, 14, 1, '2025-06-30 20:16:46', NULL),
(5, 15, 1, '2025-06-30 20:16:46', NULL),
(6, 17, 1, '2025-06-30 20:16:46', NULL),
(7, 1, 1, '2025-06-30 20:33:55', NULL),
(8, 8, 1, '2025-06-30 20:33:55', NULL),
(9, 1, 3, '2025-06-30 20:58:55', NULL),
(10, 3, 1, '2025-07-10 09:15:26', 2),
(11, 4, 1, '2025-07-10 09:20:46', 1),
(12, 3, 1, '2025-08-11 20:59:36', 2),
(13, 5, 1, '2025-08-11 20:59:36', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codPro`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`codUsu`),
  ADD UNIQUE KEY `correo` (`emaUsu`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`codVen`),
  ADD KEY `producto_id` (`codPro`),
  ADD KEY `fk_usuario` (`codUsu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `codPro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `codUsu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `codVen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`codUsu`) REFERENCES `usuarios` (`codUsu`),
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`codPro`) REFERENCES `productos` (`codPro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
