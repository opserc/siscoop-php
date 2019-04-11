-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-04-2019 a las 14:39:09
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbsiscoop2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `afiliado`
--

CREATE TABLE `afiliado` (
  `idafiliado` int(11) NOT NULL,
  `idcontrato` int(11) NOT NULL,
  `tipo_persona` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `condicion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `afiliado`
--

INSERT INTO `afiliado` (`idafiliado`, `idcontrato`, `tipo_persona`, `nombre`, `tipo_documento`, `num_documento`, `fecha`, `condicion`) VALUES
(1, 1, 'Persona Natural', 'YENIFER MATA', 'Cedula de Identidad', '26447539', '2019-03-21 02:52:17', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE `bancos` (
  `idbancos` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nombre_corto` varchar(5) NOT NULL,
  `descripcion` varchar(256) DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `nombre_corto`, `descripcion`, `condicion`) VALUES
(1, 'CONTABLE', 'C', 'Para registrar contablemente', 1),
(2, 'NO CONTABLE', 'NC', 'Para registrar las cuentas no contables', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conciliacion_b`
--

CREATE TABLE `conciliacion_b` (
  `idconciliacion_b` int(11) NOT NULL,
  `idbancos` int(11) NOT NULL,
  `idingreso` int(11) NOT NULL,
  `ref_transferencia` varchar(10) NOT NULL,
  `ref_interna` varchar(10) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_inicial`
--

CREATE TABLE `config_inicial` (
  `idconfig_inicial` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `documento` varchar(45) NOT NULL,
  `periodo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_sistema`
--

CREATE TABLE `config_sistema` (
  `idconfig_sistema` int(11) NOT NULL,
  `idconfig_inicial` int(11) NOT NULL,
  `semanas` int(11) NOT NULL,
  `costo` decimal(11,2) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `idcontrato` int(11) NOT NULL,
  `idsocio` int(11) NOT NULL,
  `ncontrato` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `condicion` varchar(15) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`idcontrato`, `idsocio`, `ncontrato`, `fecha`, `condicion`) VALUES
(1, 1, 1569, '2019-03-17 15:37:50', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_egreso`
--

CREATE TABLE `detalle_egreso` (
  `iddetalle_egreso` int(11) NOT NULL,
  `idingreso` int(11) NOT NULL,
  `idplanc` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL,
  `semana` int(11) NOT NULL,
  `cantidad_egreso` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_egreso`
--

INSERT INTO `detalle_egreso` (`iddetalle_egreso`, `idingreso`, `idplanc`, `idcategoria`, `semana`, `cantidad_egreso`) VALUES
(2, 30, 1, 2, 0, '12000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ingreso`
--

CREATE TABLE `detalle_ingreso` (
  `iddetalle_ingreso` int(11) NOT NULL,
  `idingreso` int(11) NOT NULL,
  `idplanc` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL,
  `semana` int(11) NOT NULL,
  `cantidad_ingreso` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_ingreso`
--

INSERT INTO `detalle_ingreso` (`iddetalle_ingreso`, `idingreso`, `idplanc`, `idcategoria`, `semana`, `cantidad_ingreso`) VALUES
(45, 30, 3, 2, 4, '1000.00'),
(46, 30, 4, 2, 4, '1000.00'),
(47, 30, 5, 2, 4, '1000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egreso`
--

CREATE TABLE `egreso` (
  `idegreso` int(11) NOT NULL,
  `idsocio` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idcontrato` int(11) NOT NULL,
  `tipo_comprobante` varchar(20) NOT NULL,
  `serie_comprobante` varchar(7) DEFAULT NULL,
  `num_comprobante` varchar(10) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `total_egreso` decimal(11,2) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `idingreso` int(11) NOT NULL,
  `idsocio` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idcontrato` int(11) NOT NULL,
  `num_comprobante` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `total_ingreso` decimal(11,2) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`idingreso`, `idsocio`, `idusuario`, `idcontrato`, `num_comprobante`, `fecha_hora`, `total_ingreso`, `estado`) VALUES
(30, 1, 1, 1, 1, '2019-03-18 00:00:00', '12000.00', 'Aceptado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre`) VALUES
(1, 'Escritorio'),
(2, 'Contabilidad'),
(3, 'Colecta'),
(4, 'Asociados'),
(5, 'Acceso'),
(6, 'Consulta Compras'),
(7, 'Consulta Ventas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planc`
--

CREATE TABLE `planc` (
  `idplanc` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(256) DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `planc`
--

INSERT INTO `planc` (`idplanc`, `codigo`, `nombre`, `descripcion`, `condicion`) VALUES
(1, '11110101001', 'CAJA SOLUCIONES FINANCIAREAS', 'CAJA DE INGRESOS EN EFECTIVO', 1),
(2, '11110101002', 'BANCO BANESCO 0134', 'CAJA DE INGRESOS EN TRANFERECNCIAS', 1),
(3, '21210701001', 'AHORRO', 'AHORRO NATURAL DEL ASOCIADO', 1),
(4, '32210201006', 'FDO. APOYO ADMINISTRATIVO', 'FONDO DE GASTOS', 1),
(5, '32210201008', 'SALUD', 'FONDO DE SALUD', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socio`
--

CREATE TABLE `socio` (
  `idsocio` int(11) NOT NULL,
  `nsocio` int(11) NOT NULL,
  `tipo_persona` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `direccion` varchar(70) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fecha_nac` varchar(20) DEFAULT NULL,
  `fecha_ins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `condicion` varchar(8) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `socio`
--

INSERT INTO `socio` (`idsocio`, `nsocio`, `tipo_persona`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `fecha_nac`, `fecha_ins`, `condicion`) VALUES
(1, 2836, 'Natural', 'Jesus Crespo', 'Cedula', '19436172', 'Loyola', '04169540786', 'jesusecrespo@gmail.com', '1990-04-11', '2019-03-17 15:37:04', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cargo` varchar(20) DEFAULT NULL,
  `login` varchar(20) NOT NULL,
  `clave` varchar(64) NOT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `cargo`, `login`, `clave`, `imagen`, `condicion`) VALUES
(1, 'Super Usuario', 'DNI', '05061970', 'Callejon Paraiso, entre Rosario y Castañeda', '0252-421.11.34', 'loyola.asociados1970@gmail.com', 'Administrador', 'admin', '1432d55680d6f605dd011fdb50e09e847a9483f071a60bb61ebeff08c717da9f', '1487132068.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`idusuario_permiso`, `idusuario`, `idpermiso`) VALUES
(8, 1, 1),
(9, 1, 2),
(10, 1, 3),
(11, 1, 4),
(12, 1, 5),
(13, 1, 6),
(14, 1, 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `afiliado`
--
ALTER TABLE `afiliado`
  ADD PRIMARY KEY (`idafiliado`),
  ADD KEY `fk_afiliado_contrato_idx` (`idcontrato`);

--
-- Indices de la tabla `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`idbancos`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  ADD UNIQUE KEY `nombre_corto_UNIQUE` (`nombre_corto`);

--
-- Indices de la tabla `conciliacion_b`
--
ALTER TABLE `conciliacion_b`
  ADD PRIMARY KEY (`idconciliacion_b`),
  ADD KEY `fk_conciliacion_b_ingreso_idx` (`idingreso`),
  ADD KEY `fk_conciliacion_b_bancos_idx` (`idbancos`);

--
-- Indices de la tabla `config_inicial`
--
ALTER TABLE `config_inicial`
  ADD PRIMARY KEY (`idconfig_inicial`),
  ADD UNIQUE KEY `periodo_UNIQUE` (`periodo`);

--
-- Indices de la tabla `config_sistema`
--
ALTER TABLE `config_sistema`
  ADD PRIMARY KEY (`idconfig_sistema`),
  ADD KEY `fk_config_sistema_config_inicial_idx` (`idconfig_inicial`);

--
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`idcontrato`),
  ADD KEY `fk_contrato_socio_idx` (`idsocio`);

--
-- Indices de la tabla `detalle_egreso`
--
ALTER TABLE `detalle_egreso`
  ADD PRIMARY KEY (`iddetalle_egreso`),
  ADD KEY `fk_detalle_egreso_planc_idx` (`idplanc`),
  ADD KEY `fk_detalle_egreso_ingreso_idx` (`idingreso`),
  ADD KEY `fk_detalle_egreso_categoria_idx` (`idcategoria`);

--
-- Indices de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD PRIMARY KEY (`iddetalle_ingreso`),
  ADD KEY `fk_detalle_ingreso_ingreso_idx` (`idingreso`),
  ADD KEY `fk_detalle_ingreso_planc_idx` (`idplanc`),
  ADD KEY `fk_detalle_ingreso_categoria_idx` (`idcategoria`);

--
-- Indices de la tabla `egreso`
--
ALTER TABLE `egreso`
  ADD PRIMARY KEY (`idegreso`),
  ADD KEY `fk_egreso_socio_idx` (`idsocio`),
  ADD KEY `fk_egreso_usuario_idx` (`idusuario`),
  ADD KEY `fk_egreso_contrato_idx` (`idcontrato`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`idingreso`),
  ADD KEY `fk_ingreso_socio_idx` (`idsocio`),
  ADD KEY `fk_ingreso_usuario_idx` (`idusuario`),
  ADD KEY `fk_ingreso_contrato_idx` (`idcontrato`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `planc`
--
ALTER TABLE `planc`
  ADD PRIMARY KEY (`idplanc`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `socio`
--
ALTER TABLE `socio`
  ADD PRIMARY KEY (`idsocio`),
  ADD UNIQUE KEY `nsocio_UNIQUE` (`nsocio`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`idusuario_permiso`),
  ADD KEY `fk_usuario_permiso_usuario_idx` (`idusuario`),
  ADD KEY `fk_usuario_permiso_permiso_idx` (`idpermiso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `afiliado`
--
ALTER TABLE `afiliado`
  MODIFY `idafiliado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `bancos`
--
ALTER TABLE `bancos`
  MODIFY `idbancos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `conciliacion_b`
--
ALTER TABLE `conciliacion_b`
  MODIFY `idconciliacion_b` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `config_inicial`
--
ALTER TABLE `config_inicial`
  MODIFY `idconfig_inicial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `config_sistema`
--
ALTER TABLE `config_sistema`
  MODIFY `idconfig_sistema` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `idcontrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_egreso`
--
ALTER TABLE `detalle_egreso`
  MODIFY `iddetalle_egreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  MODIFY `iddetalle_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `egreso`
--
ALTER TABLE `egreso`
  MODIFY `idegreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `idingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `planc`
--
ALTER TABLE `planc`
  MODIFY `idplanc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `socio`
--
ALTER TABLE `socio`
  MODIFY `idsocio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `afiliado`
--
ALTER TABLE `afiliado`
  ADD CONSTRAINT `fk_afiliado_contrato` FOREIGN KEY (`idcontrato`) REFERENCES `contrato` (`idcontrato`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `conciliacion_b`
--
ALTER TABLE `conciliacion_b`
  ADD CONSTRAINT `fk_conciliacion_b_bancos` FOREIGN KEY (`idbancos`) REFERENCES `bancos` (`idbancos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_conciliacion_b_ingreso` FOREIGN KEY (`idingreso`) REFERENCES `ingreso` (`idingreso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `config_sistema`
--
ALTER TABLE `config_sistema`
  ADD CONSTRAINT `fk_config_sistema_config_inicial` FOREIGN KEY (`idconfig_inicial`) REFERENCES `config_inicial` (`idconfig_inicial`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `fk_contrato_socio` FOREIGN KEY (`idsocio`) REFERENCES `socio` (`idsocio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_egreso`
--
ALTER TABLE `detalle_egreso`
  ADD CONSTRAINT `fk_detalle_egreso_categoria` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_egreso_ingreso` FOREIGN KEY (`idingreso`) REFERENCES `ingreso` (`idingreso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_egreso_planc` FOREIGN KEY (`idplanc`) REFERENCES `planc` (`idplanc`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD CONSTRAINT `fk_detalle_ingreso_categoria` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_ingreso_ingreso` FOREIGN KEY (`idingreso`) REFERENCES `ingreso` (`idingreso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_ingreso_planc` FOREIGN KEY (`idplanc`) REFERENCES `planc` (`idplanc`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `egreso`
--
ALTER TABLE `egreso`
  ADD CONSTRAINT `fk_egreso_contrato` FOREIGN KEY (`idcontrato`) REFERENCES `contrato` (`idcontrato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_egreso_socio` FOREIGN KEY (`idsocio`) REFERENCES `socio` (`idsocio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_egreso_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD CONSTRAINT `fk_ingreso_contrato` FOREIGN KEY (`idcontrato`) REFERENCES `contrato` (`idcontrato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ingreso_socio` FOREIGN KEY (`idsocio`) REFERENCES `socio` (`idsocio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ingreso_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `fk_usuario_permiso_permiso` FOREIGN KEY (`idpermiso`) REFERENCES `permiso` (`idpermiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_permiso_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
