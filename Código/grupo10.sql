-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2015 a las 20:36:29
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `grupo10`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `idcategoria` int(45) NOT NULL AUTO_INCREMENT,
  `contenido_cat` varchar(100) NOT NULL,
  `idestadocat` int(45) NOT NULL,
  PRIMARY KEY (`idcategoria`),
  KEY `idestadocat` (`idestadocat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `contenido_cat`, `idestadocat`) VALUES
(1, 'Alimentos', 1),
(2, 'Computacion', 1),
(3, 'Electrodomesticos', 1),
(4, 'Ropa y Accesorios', 1),
(5, 'Antiguedades', 1),
(6, 'Camaras', 1),
(7, 'Libros y Revistas', 1),
(8, 'Joyas y Relojes', 1),
(9, 'Muebles', 1),
(10, 'Animales', 1),
(11, 'Coleccionables', 1),
(12, 'Celulares y Telefones', 1),
(13, 'Otros', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `idcomentario` int(45) NOT NULL AUTO_INCREMENT,
  `cuerpo` varchar(250) NOT NULL,
  `idusuariocom` int(45) NOT NULL,
  `idsubastacom` int(45) NOT NULL,
  `idestadocom` int(45) NOT NULL,
  PRIMARY KEY (`idcomentario`),
  KEY `idusuariocom` (`idusuariocom`,`idsubastacom`,`idestadocom`),
  KEY `idsubastacom` (`idsubastacom`),
  KEY `idestadocom` (`idestadocom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_categoria`
--

CREATE TABLE IF NOT EXISTS `estado_categoria` (
  `idestadocat` int(45) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idestadocat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `estado_categoria`
--

INSERT INTO `estado_categoria` (`idestadocat`, `descripcion`) VALUES
(1, 'Activa'),
(2, 'Eliminada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_comentario`
--

CREATE TABLE IF NOT EXISTS `estado_comentario` (
  `idestadocom` int(45) NOT NULL AUTO_INCREMENT,
  `descripcioncom` varchar(45) NOT NULL,
  PRIMARY KEY (`idestadocom`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `estado_comentario`
--

INSERT INTO `estado_comentario` (`idestadocom`, `descripcioncom`) VALUES
(1, 'Activo'),
(2, 'Eliminado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_oferta`
--

CREATE TABLE IF NOT EXISTS `estado_oferta` (
  `idestadooferta` int(45) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idestadooferta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `estado_oferta`
--

INSERT INTO `estado_oferta` (`idestadooferta`, `descripcion`) VALUES
(1, 'Activa'),
(2, 'Eliminada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_subasta`
--

CREATE TABLE IF NOT EXISTS `estado_subasta` (
  `idestadosubasta` int(45) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(25) NOT NULL,
  PRIMARY KEY (`idestadosubasta`),
  KEY `idestadosubasta` (`idestadosubasta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `estado_subasta`
--

INSERT INTO `estado_subasta` (`idestadosubasta`, `descripcion`) VALUES
(1, 'Activa'),
(2, 'Cancelada'),
(3, 'Finalizada con exito'),
(4, 'Finalizada sin exito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto_subasta`
--

CREATE TABLE IF NOT EXISTS `foto_subasta` (
  `idfoto` int(45) NOT NULL AUTO_INCREMENT,
  `idsubasta` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`idfoto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `foto_subasta`
--

INSERT INTO `foto_subasta` (`idfoto`, `idsubasta`, `foto`) VALUES
(1, 1, 'imagenes/guante.jpg'),
(2, 2, 'imagenes/llama.jpg'),
(5, 5, 'imagenes/espejo.jpg'),
(6, 6, 'imagenes/kriptonita2.jpg'),
(7, 7, 'imagenes/aceiteyvinagre.jpg'),
(8, 8, 'imagenes/relojcalculadora.jpg'),
(9, 9, 'imagenes/angry.jpg'),
(10, 10, 'imagenes/gatito.jpg'),
(11, 11, 'imagenes/chocotorta.jpg'),
(12, 12, 'imagenes/autito.jpg'),
(13, 13, 'imagenes/boyero.jpg'),
(14, 14, 'imagenes/cien.jpg'),
(15, 15, 'imagenes/castillo.jpg'),
(16, 16, 'imagenes/empanadas.jpg'),
(17, 17, 'imagenes/pileta.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

CREATE TABLE IF NOT EXISTS `oferta` (
  `idoferta` int(45) NOT NULL AUTO_INCREMENT,
  `razon` varchar(200) NOT NULL,
  `monto` double NOT NULL,
  `esganador` tinyint(1) NOT NULL,
  `idestadoofer` int(45) NOT NULL,
  `idusuarioofer` int(45) NOT NULL,
  `idsubastaofer` int(45) NOT NULL,
  PRIMARY KEY (`idoferta`),
  KEY `idestadoofer` (`idestadoofer`,`idusuarioofer`,`idsubastaofer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subasta`
--

CREATE TABLE IF NOT EXISTS `subasta` (
  `idsubasta` int(25) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `idestadosub` int(45) NOT NULL,
  `idusuariosub` int(45) NOT NULL,
  `idcategoriasub` int(45) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  PRIMARY KEY (`idsubasta`),
  KEY `idestadosub` (`idestadosub`,`idusuariosub`,`idcategoriasub`),
  KEY `idusuariosub` (`idusuariosub`),
  KEY `idcategoriasub` (`idcategoriasub`),
  KEY `idestadosub_2` (`idestadosub`),
  KEY `idsubasta` (`idsubasta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `subasta`
--

INSERT INTO `subasta` (`idsubasta`, `descripcion`, `fecha_inicio`, `fecha_fin`, `idestadosub`, `idusuariosub`, `idcategoriasub`, `titulo`) VALUES
(1, 'Guantes de malla de acero inox.tejido, anticorte , marca "manulatex" de marca e industria francesa.', '2015-06-01', '2015-06-15', 1, 3, 4, 'Guantes de acero'),
(2, 'llama adulta oriunda de Tilcara.Es mansita.', '2015-05-30', '2015-06-15', 1, 4, 10, 'Llama'),
(5, 'Espejo sin marco.Medidas 0.8m x 1.2m. ', '2015-05-10', '2015-05-25', 1, 3, 5, 'Espejo'),
(6, '200 gr. de Kriptonita.', '2015-04-07', '2015-05-01', 1, 4, 13, 'Kriptonita'),
(7, '200ml. de aceite y 300ml de vinagre.No incluye frascos.', '2015-05-30', '2015-06-14', 1, 5, 1, 'Aceite y Vinagre'),
(8, 'Reloj de pulsera con calculadora incluida.', '2015-03-09', '2015-04-01', 1, 7, 8, 'Reloj calculadora'),
(9, 'Alcancia personaliza con un Angry Bird.', '2015-05-12', '2015-05-27', 1, 8, 13, 'Alcancia Angry Birds'),
(10, 'Gato cachorro y macho muy mimoso.', '2015-06-01', '2015-06-18', 1, 9, 10, 'Gatito pardo'),
(11, 'Deliciosa torta de chocolate.Hecha por Maru Botana.', '2015-02-03', '2015-03-01', 1, 6, 1, 'Chocotorta'),
(12, 'Autito HotWells 0km.', '2015-06-09', '2015-06-23', 1, 7, 11, 'Autito Hotweels'),
(13, 'Hermoso Boyero de Berna.Es mas bueno que el pan.', '2015-04-08', '2015-04-23', 1, 9, 10, 'Boyero de Berna'),
(14, 'Una obra maestra de la literatura Hispanoamericana.', '2015-06-01', '2015-06-15', 1, 8, 7, 'Cien anos de Soledad'),
(15, 'Castillo inflable para que se diviertan todos.', '2015-05-20', '2015-06-30', 1, 7, 13, 'Castillo inflable'),
(16, 'Las empanadas son todas de jamon y queso caseras', '2015-05-27', '2015-06-17', 1, 6, 1, 'Una docena de empanadas'),
(17, 'Tiene 3m de diametro y 1m de profundidad.', '2015-05-20', '2015-06-02', 1, 8, 13, 'Pileta pelopincho');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `idtipousuario` int(45) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idtipousuario`),
  KEY `idtipousuario` (`idtipousuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`idtipousuario`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Usuario'),
(3, 'Administrador Eliminado'),
(4, 'Usuario Eliminado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(45) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `fecha_alta` date NOT NULL,
  `idtipo` int(45) NOT NULL,
  `password` varchar(12) NOT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `idtipo` (`idtipo`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `apellido`, `email`, `fecha_alta`, `idtipo`, `password`) VALUES
(1, 'Este', 'es el admin', 'admin@hotmail.com', '2015-04-07', 1, 'admin'),
(2, 'Este', 'es el usuario', 'usuario@hotmail.com', '2015-05-03', 2, 'usuario'),
(3, 'Carlos', 'Maidana', 'Carlitos@hotmail.com', '2015-05-25', 2, '12345'),
(4, 'Catalina', 'Perez', 'CataPerez@gmail.com', '2015-05-30', 2, '12345'),
(5, 'Sergio', 'Ramirez', 'SergioRamirez@yahoo.com.ar', '2015-05-26', 2, '12345'),
(6, 'Ramiro', 'Lamas', 'RamaLamas@hotmail.com', '2015-06-02', 2, '12345'),
(7, 'Mariano', 'Petrucci', 'MarianoPetrucci@hotmail.com', '2015-04-14', 2, '12345'),
(8, 'Mabel', 'Rimano', 'Mabel.Rimano@hotmail.com', '2015-02-08', 2, '12345'),
(9, 'Roberto', 'Vegas', 'RobertVegas@hotmail.com', '2015-01-12', 2, '12345'),
(10, 'pepelot', 'jaunsafa', 'pepito@hotmail.com', '2015-06-05', 2, '123456'),
(11, 'PUMELA', 'affonso', 'pepit33o@hotmail.com', '2015-06-05', 2, 'pepepe'),
(12, 'emanuel', 'nucilli', 'emanuel@emanuel.com', '2015-06-05', 2, '123456');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
