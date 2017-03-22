-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2017 a las 22:30:18
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atomizadores`
--

CREATE TABLE `atomizadores` (
  `modelo` varchar(50) NOT NULL,
  `pagina` varchar(200) NOT NULL,
  `compra` varchar(200) NOT NULL,
  `precio` varchar(10) NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `atomizadores`
--

INSERT INTO `atomizadores` (`modelo`, `pagina`, `compra`, `precio`, `descripcion`) VALUES
('Griffin 25', 'http://www.geekvape.com/project/griffin-rta-25/', 'http://www.gearbest.com/rebuildable-atomizers/pp_359832.html', '€ 21.73', 'El que yo uso personalmente, es completo'),
('TFV8', 'http://www.smoktech.com/atomizer/the-tfv8-cloud-beast', 'https://es.aliexpress.com/store/product/100-Original-Smok-TFV8-Tanque-6-ml-Top-llenado-de-Control-de-Flujo-de-Aire-Ajustable/2182056_32672112997.html?detailNewVersion=&categoryId=200003564', '€ 26', 'La bestia de las nubes'),
('Estoc', 'http://www.vaporesso.com/vape-atomizers-vape-tanks-estoc-vape-tank', 'https://www.fasttech.com/product/5822400-authentic-vaporesso-estoc-tank-mega-clearomizer', '$ 15.66', 'Barato y bueno para iniciarse en el arte'),
('MELO III', 'http://www.eleafworld.com/melo-iii-atomizer/', 'https://es.aliexpress.com/store/product/100-Original-Eleaf-Melo-III-4ml-Tank-VS-Melo-III-Mini-2ml-Tank-Melo-3-Atomizer/2144005_32665523112.html?detailNewVersion=&categoryId=200003564', '€ 15.34', 'Ideal para iniciarse igual que el Estoc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargadores`
--

CREATE TABLE `cargadores` (
  `modelo` varchar(220) NOT NULL,
  `compra` varchar(200) NOT NULL,
  `precio` varchar(50) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `pagina` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargadores`
--

INSERT INTO `cargadores` (`modelo`, `compra`, `precio`, `descripcion`, `pagina`) VALUES
('Nitecore D4', 'http://www.gearbest.com/chargers-batteries/pp_56674.html?vip=763086&gclid=CJ_zw8K4ntICFW0A0wodlXAFew', '$ 29.30', 'El cargador mas popular del mercado', 'http://charger.nitecore.com/product/digicharger-d4'),
('Nitecore D2', 'http://www.gearbest.com/chargers-batteries/pp_70931.html?wid=21', '$ 21.93', 'El hermano pequeño del Nitecore D4', 'http://charger.nitecore.com/product/digicharger-d2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mods`
--

CREATE TABLE `mods` (
  `modelo` varchar(200) NOT NULL,
  `pagina` varchar(200) NOT NULL,
  `compra` varchar(200) NOT NULL,
  `precio` varchar(200) NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mods`
--

INSERT INTO `mods` (`modelo`, `pagina`, `compra`, `precio`, `descripcion`) VALUES
('Reuleaux RX2/3', 'http://www.wismec.com/product/reuleaux-rx23/', 'https://es.aliexpress.com/store/product/Wismec-Reuleaux-RX2-3-TC-150W-200W-Box-Mod-Vape-new-Electronic-Cigarette-power-by-Two/2193014_32707216464.html', '€ 52.91', 'El que yo uso personalmente, muy recomendado, capacidad para llevar 2 o 3 pilas'),
('Smok Alien', 'http://www.smoktech.com/kit/alien-kit', 'http://masquevapor.com/es/mods-electronicos/5784-smok-alien-220w-mod-red.html', '€ 59.95', 'Mod de muy buena calidad y muy buenas críticas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pilas`
--

CREATE TABLE `pilas` (
  `modelo` varchar(200) NOT NULL,
  `compra` varchar(200) NOT NULL,
  `precio` varchar(200) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `pagina` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pilas`
--

INSERT INTO `pilas` (`modelo`, `compra`, `precio`, `descripcion`, `pagina`) VALUES
('LG HG2', 'https://www.fasttech.com/products/0/10004182/6768800-authentic-lg-18650hg2-3-6v-3000mah-rechargeable', '$ 22.36', 'Las mejores pilas del mercado', 'https://batterybro.com/blogs/18650-wholesale-battery-reviews/57179459-lg-hg2-review-20a-3000mah'),
('LG HE4', 'https://www.fasttech.com/products/0/10004182/6768202-authentic-lg-inr-18650he4-3-7v-2500mah', ' $17.39', 'Las hermanas pequeñas', 'https://batterybro.com/blogs/18650-wholesale-battery-reviews/19198431-what-is-the-difference-between-the-lg-he2-and-lg-he4-which-is-newer-better');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `username` varchar(250) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `lastlogin` varchar(50) NOT NULL,
  `telefono` varchar(200) NOT NULL,
  `nombre` varchar(220) NOT NULL,
  `apellidos` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`username`, `hash`, `email`, `lastlogin`, `telefono`, `nombre`, `apellidos`) VALUES
('simete', '$2y$10$R5r2gXMaXvgGAfG/j.6WCu.eWxG82SNAXtBa1C17YfTy4.3fcqYCm', 'sime@reborn.com', 'Último login el dia. 20/02/2017 a las 20:33:25', '680114004', 'Simeon', 'Nikolaev Shopov'),
('localhost', '$2y$10$N6X1gkDuowu9zLgVAcc4j.AFKM35q4SOjF0U1GAaG3BfWRVPPkxVW', 'localhost@localhost.com', 'Último login el dia. 20/02/2017 a las 22:28:58', '680114004', 'localhost', 'localhost'),
('localhost2', '$2y$10$CvBFJzbizo/fmH0hkCNAzuYS2yPjc1Irm72IyiWiGCzsjb4BwsSMG', 'localhost2@localhost2.com', 'Último login el dia. 20/02/2017 a las 22:25:39', '680114004', 'localhost2', 'localhost2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
