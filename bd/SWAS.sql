-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 09-01-2018 a las 17:48:50
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `SWAS`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CATEGORIAS`
--

CREATE TABLE `CATEGORIAS` (
  `IdCategoria` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `CATEGORIAS`
--

INSERT INTO `CATEGORIAS` (`IdCategoria`, `Nombre`) VALUES
(1, 'FerreterÃ­a'),
(2, 'PlomerÃ­a'),
(3, 'ElÃ©ctricidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DETALLEVENTA`
--

CREATE TABLE `DETALLEVENTA` (
  `Cantidad` varchar(45) NOT NULL,
  `PrecioUnitario` double NOT NULL,
  `Total` double NOT NULL,
  `Producto` int(11) NOT NULL,
  `IdVenta` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `DETALLEVENTA`
--

INSERT INTO `DETALLEVENTA` (`Cantidad`, `PrecioUnitario`, `Total`, `Producto`, `IdVenta`) VALUES
('1', 32, 32, 10021, 'V000002'),
('1', 32, 32, 10021, 'V000003'),
('1', 32, 32, 10021, 'V000004'),
('1', 32, 32, 10021, 'V000005'),
('19', 32, 608, 10021, 'V000006'),
('7', 136, 952, 10254, 'V000007'),
('2', 295, 590, 10323, 'V000007'),
('7', 136, 952, 10254, 'V000008'),
('2', 105, 210, 10324, 'V000008'),
('7', 136, 952, 10254, 'V000009'),
('5', 295, 1475, 10323, 'V000009'),
('7', 136, 952, 10254, 'V000010'),
('1', 136, 136, 10254, 'V000011'),
('1', 295, 295, 10323, 'V000011'),
('1', 105, 105, 10324, 'V000011'),
('1', 136, 136, 10254, 'V000012'),
('1', 105, 105, 10324, 'V000012'),
('1', 295, 295, 10323, 'V000012'),
('2', 136, 272, 10254, 'V000013'),
('2', 136, 272, 10254, 'V000014'),
('1', 136, 136, 10254, 'V000015'),
('4', 136, 544, 10254, 'V000016'),
('2', 295, 590, 10323, 'V000016'),
('1', 136, 136, 10254, 'V000017'),
('3', 136, 408, 10254, 'V000018'),
('9', 136, 1224, 10254, 'V000018'),
('1', 295, 295, 10323, 'V000018'),
('1', 295, 295, 10323, 'V000019'),
('1', 295, 295, 10323, 'V000019'),
('1', 295, 295, 10323, 'V000019');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PEDIDOS`
--

CREATE TABLE `PEDIDOS` (
  `IdPedido` int(11) NOT NULL,
  `Cantidad` varchar(45) DEFAULT NULL,
  `Precio` double DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Usuario` int(11) NOT NULL,
  `Producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PRODUCTOS`
--

CREATE TABLE `PRODUCTOS` (
  `Codigo` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(45) DEFAULT NULL,
  `PrecioCompra` double DEFAULT NULL,
  `PrecioVenta` double DEFAULT NULL,
  `Cantidad` int(45) DEFAULT NULL,
  `Fabricante` varchar(45) DEFAULT NULL,
  `Imagen` varchar(300) DEFAULT NULL,
  `Proveedor` int(11) NOT NULL,
  `Categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `PRODUCTOS`
--

INSERT INTO `PRODUCTOS` (`Codigo`, `Nombre`, `Descripcion`, `PrecioCompra`, `PrecioVenta`, `Cantidad`, `Fabricante`, `Imagen`, `Proveedor`, `Categoria`) VALUES
(123, 'Producto', 'DescripciÃ³n producto', 300, 350, 56, 'Truper', '967853.jpg', 1, 1),
(10021, 'Abrazaderas de acero inoxidable', 'Piezas por bolsa 4', 28, 32, 0, 'Truper', '', 1, 1),
(10254, 'Arcos jardineros tubulares', 'Segueta con dientes templados de acero', 105, 136, -3, 'Truper', 'arco-jardinero-tubular-truper.jpg', 1, 3),
(10323, 'Aspesor metalico reforzado', 'Area de riego 360 grados ', 225, 295, -2, 'Truper', 'aspersor-metalico-refprazado.jpg', 1, 2),
(10324, 'Aspesores metalicos con conexi?n de laton ', 'Area de riego 360 grados ', 79, 105, 4, 'Truper', 'aspersadores-metalicos.jpg', 1, 2),
(10382, 'Pota manguera plastico con 2 ruedas 60 m', 'Diametro 1/2 Largo;60 m', 975, 1115, 6, 'Truper', '', 1, 2),
(10492, 'Inversor de corriente c', 'Convierte la corriente del vehiculo de 12 v c', 3365, 3885, 5, 'Truper', 'imagen', 1, 1),
(10553, 'Azadon jardinero Classic con mango 54', '', 90, 119, 10, '   ', 'azadon-jardinero-classic-con-mango-54.jpg', 1, 3),
(10898, 'Azadon 2 Ib con martillo mango de 54', 'Angulo cerrado', 145, 183, 6, 'Truper', '', 1, 3),
(10901, 'Adadon 3 Ib con mango 54 de hoja profunda ', 'Mango de fresno americano', 148, 187, 6, 'Truper', 'azadon-3-lb.jpg', 1, 3),
(11548, 'Discos para desbaste de metal alto rendimient', 'Diametro de siete octavos', 35, 45, 20, 'Truper', 'disco-abrasivo-para-desvaste-de-metal-alto-rendimiento-truper.jpg', 1, 3),
(11708, 'Porta manguera metalico uso rudo con 4 ruedas', 'Diametro 1/2 Largo;70 m', 2375, 2715, 4, 'Truper', '', 1, 2),
(11894, 'Conchas para carretilla ', '', 279, 357, 5, 'Truper', 'cochas-para-carretilla.jpg', 1, 3),
(12279, 'Mini aspesor de plastico ', 'Area de riego 360 grados ', 29, 38, 19, 'Truper', 'aspersor-mini-plastico-360-grados.jpg', 1, 2),
(12322, 'Cinta de amarre', 'Impermeable', 28, 32, 20, 'Truper', '', 1, 2),
(12345, 'Ejemplo', 'Descripcion', 100, 200, 0, 'Truper', '760362.jpg', 1, 1),
(12764, 'Bloquero con llave ', 'Bro 1/2 N Compatible con adaptador SDS plus A', 63, 82, 12, 'Truper', '', 1, 3),
(12815, 'Amarrador de varilla', '', 82, 109, 30, 'Truper', '', 1, 3),
(12851, 'Mini cortador de tubo de cobre de 1 y un octa', 'Para lugares de dificil acceso  ', 155, 205, 3, 'Truper', 'mini-cortador-de-tubo-de-cobre.jpg', 1, 3),
(12855, 'Cortador de tubo de acero 2', 'Cuchillas de acero', 715, 955, 7, 'Truper', 'cortador-de-tubo-de-acero-2.jpg', 1, 3),
(12868, 'Avellanador de sinco octavos', 'Para materiales suabes como aluminio ', 258, 337, 5, 'Truper', 'avellanador-profesional-316-a-58-truper.jpg', 1, 3),
(16665, 'Taladro', '650 w', 1555, 2025, 6, 'Truper', '', 1, 3),
(16666, 'Rotomartillo industrial', '1200 w', 2035, 2589, 4, 'Truper', '16394.jpg', 1, 3),
(17002, 'Cuchillos para linoleo', 'Hoja de acero inoxidable', 32, 42, 13, 'Truper', 'cuchillo-para-linoleo-7-12-truper.jpg', 1, 1),
(17819, 'Puntas phillips largo 1', 'Precio por bolsa', 29, 37, 20, 'Truper', 'puntas-phillips-largo-1-truper.jpg', 1, 3),
(17832, '10 Puntas de hexagonales ', 'De acero S2', 47, 62, 15, 'Truper', 'puntas-phillips-largo-1-truper.jpg', 1, 3),
(18539, 'Navaja abatible para electricista', 'Ideal para cortar y pelar cable ', 115, 148, 15, 'Truper', 'navaja-abatible-para-electricista-truper.jpg', 1, 3),
(19077, 'jJuego de pistola sopleteadora con 5 boquilla', 'Cuerda de un cuarto NPT', 74, 97, 4, 'Truper', 'cortador-de-tubo-de-acero-2.jpg', 1, 3),
(19079, 'Juego de 18 de accesorios neumaticos para lim', 'Cuerda 1/4 NPT', 357, 415, 10, 'Truper', '', 1, 2),
(19740, 'Azadones mezcleros con mango 60', 'Mango de fresno americano', 175, 235, 12, 'Truper', 'azadones-mezcleros-con-mmango-60.jpg', 1, 3),
(19800, 'Grifa de 2 bocas 5/8 3/4', '', 109, 125, 30, 'Truper', '', 1, 3),
(20002, 'Mini arco de plastico ', 'Para cortes en espacios reducidos ', 40, 52, 12, 'Truper', '', 1, 3),
(22147, 'Llaves para manguera', 'De un medio', 25, 40, 30, 'Petrul', 'llaves-para-manguera.jpg', 1, 2),
(43507, 'Barra fija de alta seguridad ', '', 195, 245, 13, 'Hermex', 'oferta-portacandados-lock.jpg', 1, 3),
(43512, 'Barra fija de alta seguridad ', '', 235, 307, 14, 'Hermex', 'oferta-portacandados-lock.jpg', 1, 3),
(44045, 'Bandolas de laton ', 'Resistentes a la corrosion', 44, 59, 10, 'Fiero', '', 1, 3),
(44091, 'Ganchos S', 'Acabado galvanizado', 7, 9, 17, 'Fiero', 'gancho-s.jpg', 1, 3),
(44105, 'Destorsadores forjados ', 'Acabado galvanizado', 47, 62, 10, 'Fiero', 'gancho-s.jpg', 1, 3),
(44113, 'Garruchas para noria', 'Acabado niquelado para mayor resistencia a la', 22, 29, 15, 'Fiero', 'alambre-galvanizado.jpg', 1, 3),
(44335, 'Pijas multiusos', 'Presio por caja con  100 piezas', 10.5, 14, 10, 'Truper', 'pija-multiusos.jpg', 1, 3),
(44371, 'Armellas cerradas', 'Presio por caja con  100 piezas', 67, 89, 20, 'Truper', 'fieroarmella-cerrada.jpg', 1, 3),
(44470, 'Alambre Galvanizado', 'Precio por rollo de 1 kg', 39, 49, 30, 'Truper', 'alambre-galvanizado.jpg', 1, 3),
(44638, 'Tollero de barra ', 'Resistencia al peso 455 g', 239, 315, 5, 'Truper', 'Toallero-barra-Luisa.jpg', 1, 2),
(44645, 'Pijas cabeza de cruz con punta de broca', 'Presio por caja con  100 piezas', 17, 23, 20, 'Truper', 'pijas-cabeza-cruz.jpg', 1, 3),
(44987, 'Alcayatas roscadas', 'Presio por caja con  100 piezas', 125, 168, 20, 'Truper', '44985.jpg', 1, 3),
(45047, 'Valvulas de esfera plastica', 'Presion maxima de 23 a 82 grados centigrados ', 23, 30, 23, 'Hidroflou', 'llave-de-esfera-de-zamac-12-110-g-pretul.jpg', 1, 2),
(45172, 'Dados para termofusura', 'Fabricados en alumnio', 109, 145, 40, 'Foset', 'dado-para-termofusora-termoflow.jpg', 1, 2),
(45370, 'Adaptadores macho', 'Presion maxima de 23 a 82 grados centigrados ', 2, 3, 35, 'Foset', 'adaptadores-macho-de-cpvc-azul-foset.jpg', 1, 2),
(45376, 'Adaptadores hembra ', 'Presion maxima de 23 a 82 grados centigrados ', 7, 9, 40, 'Foset', 'adaptadores-hembra-de-cpvc-azul-foset.jpg', 1, 2),
(45382, 'Adaptadores macho con inseto de acero inoxida', 'Rosca compatible con los sistemas de acero NT', 32, 45, 45, 'Foset', 'adaptadores-macho-con-inserto-de-acero-inoxidable-de-cpvc-azul-foset.jpg', 1, 2),
(45400, 'Valvulas de esfera ', 'Presion maxima de 23 a 82 grados centigrados ', 86, 115, 24, 'Foset', 'valvulas-de-esfera-de-cpvc-azul-foset.jpg', 1, 2),
(45411, 'Codo 90', 'Diametro 1/2', 2.5, 3, 50, 'Foset', '', 1, 2),
(45429, 'Adaptadores', 'Diametro 1/2', 2.5, 3, 40, 'Foset', '', 1, 2),
(46143, 'Modulos ciegos ', '', 6, 5.5, 46, 'Volteck', 'modulos-ciegos.jpg', 1, 1),
(46406, 'Placa duplex de baquetita', '', 5.5, 7.5, 40, 'Volteck', 'interruptor-para-timbre-linea-italiana-color-blanco.jpg', 1, 1),
(46412, 'Placa para contacto redondo de baquetita ', '', 7, 9, 40, 'Volteck', 'placa-para-contacto-redondo-de-baquelita-linea-standard.jpg', 1, 1),
(46415, 'Placa para interruptor vertical de baquetita', '', 7, 9, 40, 'Volteck', 'placa-para-interruptor-verticalde-baquelita-linea-standard.jpg', 1, 1),
(46520, 'Portalampara de baquelita de 4', 'Tension 250 V ', 14.5, 16.5, 30, 'Volteck', 'portalampara-de-baquelita-4-1-2-volteck.jpg', 1, 1),
(46521, 'Portalampara de porcelana tipo anuncio', 'Tension 125 V', 7, 9, 40, 'Volteck', 'Portalampara-de-porcelana--tipo-anuncio--Voltech-233469.jpg', 1, 1),
(46631, 'Timbre inalambrico con contacto aterrizado 1 ', 'Tencion; 125 V Alcance m', 235, 315, 10, 'Volteck', 'timbre-inalambrico-con-contacto-aterrizado-1-control-1-tono.jpg', 1, 1),
(46805, 'Multicontactos triples reforzados con 2 polos', 'Tension 127 V  Corriente 15 A', 29, 33, 25, 'Volteck', 'multicontacto-triple-reforzado-de-abspvc-solido-2-polos-tierra-tipo-y.jpg', 1, 1),
(46811, 'Multicontacto cuadrado 2 polos + tierra 6 ent', 'Tension  127 V  Corriente 15 A', 34, 45, 25, 'Volteck', 'multicontacto-cuadrado-2-polos-tierra-6-entradas-volteck.jpg', 1, 1),
(46814, 'Multicontacto triple', 'Tension 127 V', 14, 19, 25, 'Volteck', 'multicontacto-triple-aterrizado.jpg', 1, 1),
(46862, 'Luminario lineal de LED de sobreponer  2 x 18', 'Tension de 120 a 240 v', 626, 817, 10, 'Truper', '', 1, 1),
(46970, 'Condulets conexi?n tipo LB', 'Diametro 1/2', 33, 44, 40, 'Volteck', '', 1, 1),
(46973, 'Condulets conexi?n tipo LR', 'Diametro 1/2', 33, 44, 40, 'Volteck', '', 1, 1),
(46976, 'Condulets conexi?n tipo LL', 'Diametro 1/2', 33, 44, 40, 'Volteck', '', 1, 1),
(46979, 'Condulest conexi?n tipo T', 'Diametro 1/2', 33, 44, 30, 'Volteck', '', 1, 1),
(46982, 'Condulest conexi?n tipo C', 'Diametro 1/2', 33, 44, 40, 'Volteck', '', 1, 1),
(47337, 'Arbotantes decorativos de LED', 'Tension de 120 a 240 v', 396, 517, 14, 'Truper', '', 1, 1),
(48064, 'Contactos 2 polos + tierra con 2 puertos USB', 'Tension  5 V Salida maxima  2.1 A', 199, 250, 45, 'Volteck', 'contacto-dos-polos-mas-tierra-dos-puestos-usb.jpg', 1, 1),
(48083, 'Interruptores 3 vias ', 'Tension 125 V', 19, 26, 50, 'Volteck', 'images.jpg', 1, 1),
(48084, 'Interruptores sencillos ', 'Tension 125 V', 16.5, 18.5, 50, 'Volteck', 'interruptores-censillos.jpg', 1, 1),
(48099, 'Interruptores para timbre ', 'Tencion 125 V', 17.5, 23, 50, 'Volteck', 'interruptor-para-timbre-linea-italiana-color-blanco.jpg', 1, 1),
(48111, 'Contactos sencillos sin tierra ', 'Tension 127 V', 18.5, 24, 45, 'Volteck', 'contacto-sencillo-2polos-sin-tierra-linea-italianablanco.jpg', 1, 1),
(48112, 'Contactos  sencillos, 2 polos + tierra ', 'Tension 127 V ', 20, 27, 45, 'Volteck', 'contacto-sencillo-2-polos-tierra.jpg', 1, 1),
(48386, 'Temporizador digital de 8 eventos', 'Tension 125 V', 225, 296, 20, 'Volteck', 'temporizador-digital-8-eventos.jpg', 1, 1),
(48390, 'Luminario lineales de LED para gabinete ultra', 'Tension de 120 a 240 v', 199, 165, 13, 'Truper', '', 1, 1),
(48477, 'Divisor de 4 salidas ', 'Se?al VHF UHF FM', 11, 15, 10, 'Truper', '', 1, 1),
(49083, 'Llaves de esfera ', 'De un medio ', 53, 68, 25, 'Petrul', 'llave-de-esfera-de-zamac-12-110-g-pretul.jpg', 1, 2),
(49290, 'Casquillos de 1 y tres cuartos cespol de freg', 'Diametro de 1 y un medio', 54, 70, 20, 'Foset', 'casquillos-de-cobre-para-cespol-de-fregadero-foset.jpg', 1, 2),
(49295, 'Extensiones de laton cromado para cespol de l', 'Diametro de 1 y un cuarto', 40, 52, 20, 'Foset', 'extensiones-de-laton-cromado-para-cespol-de-lavabo-foset.jpg', 1, 2),
(49305, 'Adaptadores macho para poliducto', 'Fbricado en laton para maxima duracion ', 16, 22, 46, 'Foset', '', 1, 2),
(49335, 'Cespol para lavado de un cuarto', 'Con tapon y cadena ', 199, 255, 20, 'Foset', 'cespol-para-lavabo-de-1-14-de-laton-cromado-foset.jpg', 1, 2),
(49396, 'Toallero de argolla', 'Resistencia al peso 110 g', 119, 157, 19, 'Truper', 'Toallero-argolla.jpg', 1, 2),
(49404, 'Jabonera ', 'Resistencia al peso 148 g', 105, 145, 8, 'Truper', 'jabonera.jpg', 1, 2),
(49441, 'Sistema de desague automatico para lavabo', 'Contienen sistema de desague y varillas ', 155, 215, 15, 'Foset', 'cespol-para-lavabo-de-1-14-de-laton-cromado-foset.jpg', 1, 2),
(49560, 'Pegamentos para PVC', '50 ml', 18.5, 24, 20, 'Foset', '', 1, 2),
(49595, 'Cubretaladros de 1 y tres cuartos', 'De acero inoxidable', 12, 15, 15, 'Foset', '', 1, 2),
(49625, 'Adaptadores de hule ', 'Para el lavabo o fregadero ', 6, 8, 40, 'Foset', 'adaptadores-de-hule-foset.jpg', 1, 2),
(49796, 'Juego de 2 llaves para empotrar roscables cru', '', 229, 565, 15, 'Truper', 'Juego-de-dos-llaves-para-empotrar-roscables-tipo-cruceta.png', 1, 2),
(49797, 'Juego de llaves para empotar roscables ', 'Cartucho ceramico de suave apertura', 499, 655, 15, 'Truper', 'Juego-de-dos-llaves-para-empotrar-roscables-tipo-p?lnaca.png', 1, 2),
(49810, 'Tuercas union ', 'presion maxima a 20 grados centigrados 2400 k', 39, 52, 50, 'Foset', 'tuercas-union.jpg', 1, 2),
(49828, 'Juego de 2 llaves para empotrar ', 'Cartucho ceramico', 269, 354, 25, 'Foset', 'juego-de-llaves-para-empotrar-termoflow.jpg', 1, 2),
(49935, 'Cespol sin contra para lavado de uno y un cua', 'Laton Cromado', 145, 187, 20, 'Foset', 'cespol-sin-contra-para-fregadero-de-1-12-de-laton-cromado-foset.jpg', 1, 2),
(49986, 'Cespol de bote sin contra para lavado de 1 y ', 'Laton Cromado', 247, 325, 15, 'Foset', 'cespol-de-bote-sin-contra-para-lavabo-1-14-de-laton-cromado-foset.jpg', 1, 2),
(55245, 'Rack para mesulas ', 'Base 25 cm y altura de 42 cm', 435, 496, 3, 'Truper', 'rack-para-mesulas.jpg', 1, 3),
(102323, 'Arco profesional de aluminio ', 'Dos posiciones de segueta', 189, 247, 15, 'Truper', 'arco-profesional-de-aluminio-truper.jpg', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PROVEEDORES`
--

CREATE TABLE `PROVEEDORES` (
  `IdProveedor` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Telefono` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `PROVEEDORES`
--

INSERT INTO `PROVEEDORES` (`IdProveedor`, `Nombre`, `Telefono`) VALUES
(1, 'Distribuidor Truper', '5567894423');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SLIDERS`
--

CREATE TABLE `SLIDERS` (
  `Id` int(11) NOT NULL,
  `Titulo` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Imagen` varchar(300) DEFAULT NULL,
  `Mostrar` enum('Si','No') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `SLIDERS`
--

INSERT INTO `SLIDERS` (`Id`, `Titulo`, `Descripcion`, `Imagen`, `Mostrar`) VALUES
(1, 'FerreterÃ­a', 'Gran variedad en artÃ­culos de ferreterÃ­a', '455602.jpg', 'Si'),
(2, 'PlomerÃ­a', 'Gran variedad en artÃ­culos de plomerÃ­a', '943690.jpg', 'Si'),
(3, 'ferre', 'azul', '941372.jpg', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS`
--

CREATE TABLE `USUARIOS` (
  `IdUsuario` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `APaterno` varchar(45) DEFAULT NULL,
  `AMaterno` varchar(45) DEFAULT NULL,
  `Usuario` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Tipo` enum('Administrador','Empleado') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `USUARIOS`
--

INSERT INTO `USUARIOS` (`IdUsuario`, `Nombre`, `APaterno`, `AMaterno`, `Usuario`, `Password`, `Tipo`) VALUES
(1, 'Antonio', 'Hernandez', 'Carrillo', 'admin', '12345', 'Administrador'),
(3, 'Roberto', 'JuÃ¡rez', 'Aguilar', 'user', 'user', 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `VENTAS`
--

CREATE TABLE `VENTAS` (
  `IdVenta` varchar(11) NOT NULL,
  `ProductosVendidos` int(11) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Total` double DEFAULT NULL,
  `Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `VENTAS`
--

INSERT INTO `VENTAS` (`IdVenta`, `ProductosVendidos`, `Fecha`, `Total`, `Usuario`) VALUES
('V000002', 1, '2017-12-11', 32, 1),
('V000003', 1, '2017-12-11', 32, 1),
('V000004', 1, '2017-12-11', 32, 1),
('V000005', 1, '2017-12-13', 32, 1),
('V000006', 19, '2017-12-13', 608, 1),
('V000007', 9, '2017-12-11', 1542, 1),
('V000008', 9, '2017-12-13', 1162, 1),
('V000009', 12, '2017-12-13', 2427, 1),
('V000010', 7, '2017-12-13', 952, 1),
('V000011', 3, '2017-12-13', 536, 1),
('V000012', 3, '2017-12-13', 536, 1),
('V000013', 2, '2017-12-13', 272, 3),
('V000014', 2, '2017-12-13', 272, 3),
('V000015', 1, '2017-12-13', 136, 3),
('V000016', 6, '2017-12-13', 1134, 1),
('V000017', 1, '2017-12-13', 136, 1),
('V000018', 13, '2017-12-13', 1927, 1),
('V000019', 3, '2017-12-14', 885, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `CATEGORIAS`
--
ALTER TABLE `CATEGORIAS`
  ADD PRIMARY KEY (`IdCategoria`);

--
-- Indices de la tabla `DETALLEVENTA`
--
ALTER TABLE `DETALLEVENTA`
  ADD KEY `fk_DETALLEVENTA_PRODUCTOS1_idx` (`Producto`),
  ADD KEY `fk_DETALLEVENTA_VENTAS1_idx` (`IdVenta`);

--
-- Indices de la tabla `PEDIDOS`
--
ALTER TABLE `PEDIDOS`
  ADD PRIMARY KEY (`IdPedido`),
  ADD KEY `fk_PEDIDOS_PRODUCTOS1_idx` (`Producto`),
  ADD KEY `fk_PEDIDOS_USUARIOS1_idx` (`Usuario`);

--
-- Indices de la tabla `PRODUCTOS`
--
ALTER TABLE `PRODUCTOS`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `fk_PRODUCTOS_PROVEEDORES1_idx` (`Proveedor`),
  ADD KEY `fk_PRODUCTOS_CATEGORIAS1_idx` (`Categoria`);

--
-- Indices de la tabla `PROVEEDORES`
--
ALTER TABLE `PROVEEDORES`
  ADD PRIMARY KEY (`IdProveedor`);

--
-- Indices de la tabla `SLIDERS`
--
ALTER TABLE `SLIDERS`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD UNIQUE KEY `Usuario_UNIQUE` (`Usuario`);

--
-- Indices de la tabla `VENTAS`
--
ALTER TABLE `VENTAS`
  ADD PRIMARY KEY (`IdVenta`),
  ADD KEY `fk_VENTAS_USUARIOS1_idx` (`Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `CATEGORIAS`
--
ALTER TABLE `CATEGORIAS`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `PEDIDOS`
--
ALTER TABLE `PEDIDOS`
  MODIFY `IdPedido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `PROVEEDORES`
--
ALTER TABLE `PROVEEDORES`
  MODIFY `IdProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `SLIDERS`
--
ALTER TABLE `SLIDERS`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `DETALLEVENTA`
--
ALTER TABLE `DETALLEVENTA`
  ADD CONSTRAINT `fk_DETALLEVENTA_PRODUCTOS1` FOREIGN KEY (`Producto`) REFERENCES `PRODUCTOS` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_DETALLEVENTA_VENTAS1` FOREIGN KEY (`IdVenta`) REFERENCES `VENTAS` (`IdVenta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `PEDIDOS`
--
ALTER TABLE `PEDIDOS`
  ADD CONSTRAINT `fk_PEDIDOS_PRODUCTOS1` FOREIGN KEY (`Producto`) REFERENCES `PRODUCTOS` (`Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PEDIDOS_USUARIOS1` FOREIGN KEY (`Usuario`) REFERENCES `USUARIOS` (`IdUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `PRODUCTOS`
--
ALTER TABLE `PRODUCTOS`
  ADD CONSTRAINT `fk_PRODUCTOS_CATEGORIAS1` FOREIGN KEY (`Categoria`) REFERENCES `CATEGORIAS` (`IdCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PRODUCTOS_PROVEEDORES1` FOREIGN KEY (`Proveedor`) REFERENCES `PROVEEDORES` (`IdProveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `VENTAS`
--
ALTER TABLE `VENTAS`
  ADD CONSTRAINT `fk_VENTAS_USUARIOS1` FOREIGN KEY (`Usuario`) REFERENCES `USUARIOS` (`IdUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
