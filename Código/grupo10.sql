-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-07-2015 a las 23:53:29
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

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
  `fecha_com` date NOT NULL,
  PRIMARY KEY (`idcomentario`),
  KEY `idusuariocom` (`idusuariocom`,`idsubastacom`,`idestadocom`),
  KEY `idsubastacom` (`idsubastacom`),
  KEY `idestadocom` (`idestadocom`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`idcomentario`, `cuerpo`, `idusuariocom`, `idsubastacom`, `idestadocom`, `fecha_com`) VALUES
(1, 'Que talle es la campera?', 10, 74, 1, '2015-07-01'),
(2, 'Muy linda la campera, abriga mucho?', 11, 74, 1, '2015-07-02'),
(3, 'Parece nueva,la usaste alguna vez?', 7, 74, 1, '2015-07-03'),
(4, 'Que tan fuerte suenan los parlantes?', 15, 75, 1, '2015-07-02'),
(5, 'Funciona bien la impresora?', 4, 76, 1, '2015-07-01'),
(16, 'la tele es a coloooor?', 3, 78, 1, '2015-07-09'),
(17, 'Funciona la tele?', 3, 78, 1, '2015-07-03'),
(18, 'De que material esta hecha la caja?', 20, 82, 1, '2015-07-07'),
(19, 'Todavia anda el nokia 1100?', 12, 87, 1, '2015-07-07'),
(20, 'cuantos aÃ±os tiene el caballo?', 12, 86, 1, '2015-07-07'),
(21, 'como vas a hacer para darme la palmera si lo quiero comprar', 19, 27, 2, '2015-07-07'),
(22, 'Es trucho el billete?', 6, 88, 1, '2015-07-07'),
(25, 'Puedo ir al banco y cambiarlo por un peso?', 4, 88, 1, '2015-07-07'),
(27, 'Muy linda esta , como para hacerme varios licuados.', 6, 79, 1, '2015-07-07'),
(28, 'funciona,no?', 6, 79, 1, '2015-07-07'),
(29, 'enfria bien la heladera?', 3, 80, 1, '2015-07-07'),
(31, 'Esta fria el agua?', 16, 90, 1, '2015-07-08'),
(32, 'muy fea palmera', 19, 27, 2, '2015-07-09'),
(33, '	que linda			    ', 3, 74, 1, '2015-07-14'),
(34, 'trmendo', 3, 77, 1, '2015-07-15'),
(35, 'tre mene dooooo', 3, 77, 1, '2015-07-15'),
(37, 'y cambiarle el color?', 19, 94, 2, '2015-07-15'),
(39, 'usuariopruebamesacomentario', 28, 89, 1, '2015-07-15'),
(41, 'cuanto la medusa?', 3, 96, 2, '2015-07-15'),
(42, 'el agua es natural?', 28, 90, 1, '2015-07-17'),
(45, 'comentario', 29, 92, 2, '2015-07-17'),
(46, 'son de lana?', 0, 99, 1, '2015-07-17'),
(47, 'es sumergible?', 0, 92, 1, '2015-07-17'),
(48, 'es el que me falta en la coleccion', 0, 77, 1, '2015-07-17'),
(49, 'Es original?', 0, 98, 1, '2015-07-17'),
(50, 'es hp ? ', 31, 76, 1, '2015-07-17'),
(51, 'longitud?', 0, 103, 1, '2015-07-17'),
(52, 'Viene con pico?', 0, 101, 1, '2015-07-17'),
(53, 'trae pilas?', 0, 92, 1, '2015-07-17'),
(54, 'Es muy daÃ±ina?', 30, 107, 1, '2015-07-17');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `estado_oferta`
--

INSERT INTO `estado_oferta` (`idestadooferta`, `descripcion`) VALUES
(1, 'Activa'),
(2, 'Eliminada'),
(3, 'Sin exito'),
(4, 'Ganadora');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_respuesta`
--

CREATE TABLE IF NOT EXISTS `estado_respuesta` (
  `idestadorespuesta` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_respuesta`
--

INSERT INTO `estado_respuesta` (`idestadorespuesta`, `descripcion`) VALUES
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `estado_subasta`
--

INSERT INTO `estado_subasta` (`idestadosubasta`, `descripcion`) VALUES
(1, 'Activa'),
(2, 'Cancelada'),
(3, 'Finalizada con exito'),
(4, 'Finalizada sin exito'),
(5, 'Esperando Eleccion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto_subasta`
--

CREATE TABLE IF NOT EXISTS `foto_subasta` (
  `idfoto` int(45) NOT NULL AUTO_INCREMENT,
  `idsubasta` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`idfoto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=190 ;

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
(17, 17, 'imagenes/pileta.jpg'),
(18, 18, 'imagenes/lavarropas.jpg'),
(19, 19, 'imagenes/piletaprueba.jpg'),
(20, 20, 'imagenes/tele.jpg'),
(22, 22, 'imagenes/lavarropas2.jpg'),
(23, 23, 'imagenes/lavarropas3.jpg'),
(24, 9, 'imagenes/arbol.jpg'),
(26, 12, 'imagenes/autito2.jpg'),
(27, 2, 'imagenes/llama2.jpg'),
(28, 2, 'imagenes/llama3.jpg'),
(29, 1, 'imagenes/guante2.jpg'),
(30, 1, 'imagenes/guante3.jpg'),
(31, 5, 'imagenes/espejo2.jpg'),
(32, 5, 'imagenes/espejo3.jpg'),
(33, 6, 'imagenes/kriptonita.jpg'),
(34, 10, 'imagenes/gatito2.jpg'),
(35, 13, 'imagenes/boyero2.jpg'),
(36, 13, 'imagenes/boyero3.jpg'),
(37, 27, 'imagenes/palmera.jpg'),
(38, 27, 'imagenes/palmera.jpg'),
(39, 27, 'imagenes/palmera2.jpg'),
(90, 74, 'imagenes/campera1.jpg'),
(91, 74, 'imagenes/campera2.jpg'),
(92, 74, 'imagenes/campera3.jpg'),
(93, 75, 'imagenes/parlantes1.jpg'),
(94, 75, 'imagenes/parlantes2.jpg'),
(95, 75, 'imagenes/parlantes3.jpg'),
(96, 75, 'imagenes/parlantes4.jpg'),
(97, 75, 'imagenes/parlantes5.jpg'),
(98, 76, 'imagenes/impresora1.jpg'),
(99, 76, 'imagenes/impresora2.jpg'),
(100, 77, 'imagenes/pendrive1.jpg'),
(101, 77, 'imagenes/pendrive2.jpg'),
(102, 78, 'imagenes/televisor1.jpg'),
(103, 78, 'imagenes/televisor2.jpg'),
(104, 78, 'imagenes/televisor3.jpg'),
(105, 78, 'imagenes/televisor4.jpg'),
(106, 79, 'imagenes/licuadora1.jpg'),
(107, 79, 'imagenes/licuadora2.jpg'),
(108, 80, 'imagenes/heladera1.jpg'),
(109, 80, 'imagenes/heladera2.jpg'),
(110, 80, 'imagenes/heladera3.jpg'),
(111, 81, 'imagenes/ventilador1.jpg'),
(112, 81, 'imagenes/ventilador2.jpg'),
(113, 81, 'imagenes/ventilador3.jpg'),
(114, 82, 'imagenes/cajamusical1.jpg'),
(115, 82, 'imagenes/cajamusical2.jpg'),
(116, 82, 'imagenes/cajamusical3.jpg'),
(117, 82, 'imagenes/cajamusical4.jpg'),
(118, 83, 'imagenes/tocadiscos1.jpg'),
(119, 83, 'imagenes/tocadiscos2.jpg'),
(120, 83, 'imagenes/todadiscos3.jpg'),
(121, 84, 'imagenes/121camara1.jpg'),
(122, 84, 'imagenes/122camara2.jpg'),
(123, 84, 'imagenes/123camara3.jpg'),
(124, 85, 'imagenes/124conejo1.jpg'),
(125, 85, 'imagenes/125conejo2.jpg'),
(126, 86, 'imagenes/126caballo1.jpg'),
(127, 86, 'imagenes/127caballo2.jpg'),
(128, 87, 'imagenes/128nokia1.jpg'),
(129, 87, 'imagenes/129nokia2.jpg'),
(130, 87, 'imagenes/130nokia3.jpg'),
(131, 88, 'imagenes/131patacon1.jpg'),
(132, 88, 'imagenes/132patacon2.jpg'),
(162, 89, 'imagenes/162mesa1.jpg'),
(163, 89, 'imagenes/163mesa2.jpg'),
(164, 89, 'imagenes/164mesa3.jpg'),
(165, 28, 'imagenes/165137pino.jpg'),
(167, 90, 'imagenes/168Koala.jpg'),
(168, 92, 'imagenes/168relojpuma.jpg'),
(169, 93, 'imagenes/169images (4).jpg'),
(170, 94, 'imagenes/1702.jpg'),
(171, 95, 'imagenes/171Lighthouse.jpg'),
(172, 96, 'imagenes/172Jellyfish.jpg'),
(173, 97, 'imagenes/173camisa.jpg'),
(174, 97, 'imagenes/174camisa2.jpg'),
(175, 98, 'imagenes/175spurs.jpg'),
(176, 98, 'imagenes/176spurs2.jpg'),
(177, 99, 'imagenes/177Guante-de-lana-rojo2.jpg'),
(179, 100, 'imagenes/178tenis2.jpg'),
(180, 100, 'imagenes/179Tennis_Ball.jpg'),
(181, 101, 'imagenes/181pelota-de-basquet.jpg'),
(182, 102, 'imagenes/182raqueta-tenis-wilson.jpg'),
(183, 103, 'imagenes/183soga.jpg'),
(184, 104, 'imagenes/184piebionico.jpg'),
(185, 105, 'imagenes/185collar-de-perlas.jpg'),
(186, 106, 'imagenes/186ak47.jpg'),
(187, 106, 'imagenes/187AK-47.jpg'),
(188, 107, 'imagenes/188granada.jpg'),
(189, 108, 'imagenes/189remato-chaleco-antibalas.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `idmail` int(11) NOT NULL AUTO_INCREMENT,
  `origenmail` varchar(50) NOT NULL,
  `destinomail` varchar(50) NOT NULL,
  `fechamail` date NOT NULL,
  `asuntomail` varchar(50) NOT NULL,
  `contenidomail` varchar(150) NOT NULL,
  PRIMARY KEY (`idmail`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

CREATE TABLE IF NOT EXISTS `oferta` (
  `idoferta` int(45) NOT NULL AUTO_INCREMENT,
  `razon` varchar(200) NOT NULL,
  `monto` double NOT NULL,
  `esganador` int(11) NOT NULL,
  `idestadoofer` int(45) NOT NULL,
  `idusuarioofer` int(45) NOT NULL,
  `idsubastaofer` int(45) NOT NULL,
  PRIMARY KEY (`idoferta`),
  KEY `idestadoofer` (`idestadoofer`,`idusuarioofer`,`idsubastaofer`),
  KEY `idusuarioofer` (`idusuarioofer`),
  KEY `idsubastaofer` (`idsubastaofer`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Volcado de datos para la tabla `oferta`
--

INSERT INTO `oferta` (`idoferta`, `razon`, `monto`, `esganador`, `idestadoofer`, `idusuarioofer`, `idsubastaofer`) VALUES
(29, 'Me gusta para el cumple de mi sobrina! ', 25, 0, 1, 30, 99),
(30, 'Es una locura ese reloj ! tenia uno igual pero me lo robaron y no pude conseguirlo en ningun lado.', 600, 0, 1, 30, 92),
(31, 'Soy fanatico de los simpsons y solo me falta homero en pen drive.', 100, 0, 1, 31, 77),
(32, 'Me falta la remera de manu y tengo todo el equipo', 600, 0, 1, 31, 98),
(33, 'Me gusta para mis hijos', 10, 0, 1, 32, 103),
(34, 'Tengo una escuelita de basquet y nos faltan pelotas.', 100, 0, 1, 32, 101),
(35, 'Es el regalo perfecto para mi decimo aniversario.', 1000, 0, 1, 32, 92),
(36, 'La necesito porque tengo una tienda de ropa', 140, 0, 1, 30, 74);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE IF NOT EXISTS `respuesta` (
  `idrespuesta` int(11) NOT NULL AUTO_INCREMENT,
  `idcomentario` int(11) NOT NULL,
  `idusuariorespuesta` int(11) NOT NULL,
  `cuerpo` varchar(250) NOT NULL,
  `fecharespuesta` date NOT NULL,
  `idestadorespuesta` int(11) NOT NULL,
  PRIMARY KEY (`idrespuesta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`idrespuesta`, `idcomentario`, `idusuariorespuesta`, `cuerpo`, `fecharespuesta`, `idestadorespuesta`) VALUES
(1, 1, 16, 'El talle de la campera es XL', '2015-07-11', 1),
(2, 2, 16, 'Si abriga muchisimo', '2015-07-11', 1),
(3, 3, 16, 'Si , no mucho pero la use', '2015-07-11', 1),
(18, 34, 19, 'VISTE?', '2015-07-15', 1),
(19, 35, 19, 'sisi, claro que si', '2015-07-15', 1),
(20, 31, 3, 'wdadas', '2015-07-15', 1),
(21, 33, 3, 'sisi, lo que quieras', '2015-07-15', 1),
(22, 36, 3, 'si , es posible', '2015-07-15', 1),
(23, 37, 3, 'claro, podes !', '2015-07-15', 1),
(24, 39, 3, 'carlosrespuestamesa', '2015-07-15', 1),
(25, 41, 28, 'la medusa es venenosa.', '2015-07-15', 1),
(26, 42, 3, 'no.', '2015-07-17', 1),
(27, 45, 3, 'respuesta2', '2015-07-17', 1),
(28, 51, 31, '5 metros.', '2015-07-17', 1),
(29, 52, 30, 'No, no', '2015-07-17', 1),
(30, 54, 32, 'No, para nada', '2015-07-17', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=109 ;

--
-- Volcado de datos para la tabla `subasta`
--

INSERT INTO `subasta` (`idsubasta`, `descripcion`, `fecha_inicio`, `fecha_fin`, `idestadosub`, `idusuariosub`, `idcategoriasub`, `titulo`) VALUES
(1, 'Guantes de malla de acero inox.tejido, anticorte , marca "manulatex" de marca e industria francesa.', '2015-06-30', '2015-07-17', 1, 3, 3, 'Guantes de acerox'),
(2, 'llama adulta oriunda de Tilcara.Es mansita.', '2015-06-12', '2015-06-30', 4, 4, 10, 'Llama'),
(5, 'Espejo sin marco.Medidas 0.8m x 1.2m. ', '2015-06-25', '2015-07-15', 4, 3, 5, 'Espejo'),
(6, '200 gr. de Kriptonita.', '2015-06-07', '2015-07-01', 4, 4, 13, 'Kriptonita'),
(7, '200ml. de aceite y 300ml de vinagre.No incluye frascos.', '2015-05-30', '2015-06-14', 4, 5, 1, 'Aceite y Vinagre'),
(8, 'Reloj de pulsera con calculadora incluida.', '2015-03-09', '2015-04-01', 4, 7, 8, 'Reloj calculadora'),
(9, 'Alcancia personaliza con un Angry Bird.', '2015-06-12', '2015-06-27', 4, 8, 13, 'Alcancia Angry Birds'),
(10, 'Gato cachorro y macho muy mimoso.', '2015-06-01', '2015-07-01', 4, 9, 10, 'Gatito pardo'),
(11, 'Deliciosa torta de chocolate.Hecha por Maru Botana.', '2015-02-03', '2015-03-01', 4, 6, 1, 'Chocotorta'),
(12, 'Autito HotWells 0km.', '2015-06-09', '2015-06-28', 4, 7, 11, 'Autito Hotweels'),
(13, 'Hermoso Boyero de Berna.Es mas bueno que el pan.', '2015-06-08', '2015-06-29', 4, 9, 10, 'Boyero de Berna'),
(14, 'Una obra maestra de la literatura Hispanoamericana.', '2015-06-01', '2015-06-19', 4, 8, 7, 'Cien anos de Soledad'),
(15, 'Castillo inflable para que se diviertan todos.', '2015-06-01', '2015-06-22', 4, 7, 13, 'Castillo inflable'),
(16, 'Las empanadas son todas de jamon y queso caseras', '2015-05-27', '2015-06-17', 4, 6, 1, 'Una docena de empanadas'),
(17, 'Tiene 3m de diametro y 1m de profundidad.', '2015-05-20', '2015-06-02', 4, 8, 13, 'Pileta pelopincho'),
(19, 'pileta enorme', '2015-06-01', '2015-06-15', 4, 5, 5, 'Pileta'),
(27, 'Palmera tropical, 3 metros , esta en excelente estado.', '2015-06-20', '2015-07-15', 4, 3, 11, 'Palmera'),
(28, 'Pino para decoracion', '2015-06-26', '2015-07-10', 4, 3, 13, 'Pino'),
(74, 'Campera impermeable ideal para el invierno', '2015-06-29', '2015-07-17', 1, 3, 4, 'Campera'),
(75, 'Parlantes Edifier multimedia 2.1', '2015-06-29', '2015-07-29', 1, 17, 2, 'Parlantes'),
(76, 'Impresora Multifuncion Epson Stylus', '2015-06-29', '2015-07-29', 1, 18, 2, 'Impresora'),
(77, 'Pendrive 16 Gb Homero Simpson Usb 2.0', '2015-06-29', '2015-07-29', 1, 19, 2, 'Pendrive'),
(78, 'Televisor Philips 21 pulgadas', '2015-06-29', '2015-07-29', 1, 20, 3, 'Televisor'),
(79, 'Licuadora Atma Liliana', '2015-06-29', '2015-07-29', 1, 21, 3, 'Licuadora'),
(80, 'Heladera Siam Antigua de las mejores', '2015-06-29', '2015-07-29', 1, 22, 3, 'Heladera'),
(81, 'Ventilador Axel anda perfecto', '2015-06-29', '2015-07-29', 1, 25, 3, 'Ventilador'),
(82, 'Caja Musical Italiana Antigua Motivo De Cazeria', '2015-06-29', '2015-07-29', 1, 25, 5, 'Caja Musical'),
(83, 'Tocadiscos Wincofon Excelente Reliquia', '2015-06-29', '2015-07-29', 1, 25, 5, 'Tocadiscos'),
(84, 'Camara Digital Nikon Coolpix L30 Compacta 20 Megapixeles', '2015-06-29', '2015-07-29', 1, 25, 6, 'Camara'),
(85, 'Conejo Neozelandes Muy Inquieto', '2015-06-29', '2015-07-29', 1, 25, 10, 'Conejo'),
(86, 'Caballo negro muy obediente', '2015-06-29', '2015-07-29', 1, 25, 10, 'Caballo'),
(87, 'Nokia 1100 irrompible el mejore celular de la historia', '2015-06-29', '2015-07-29', 1, 25, 12, 'Nokia'),
(88, 'Eran como los pesos pero mas divertidos', '2015-06-29', '2015-07-29', 1, 25, 11, 'Billete Patacon'),
(89, 'Mesa Comedor Laqueada Minimalista Madera Moderna Asia 120cm', '2015-07-09', '2015-08-08', 1, 3, 9, 'Mesa'),
(90, 'koala adiestrado, 1 decada de edad , muy saludable.', '2015-07-09', '2015-07-17', 1, 3, 1, 'Koala'),
(92, 'Reloj pulsera puma', '2015-07-15', '2015-08-14', 1, 3, 8, 'Reloj'),
(93, 'aa', '2015-07-15', '2015-07-11', 0, 3, 10, 'bb'),
(94, 'carlosdescripcion', '2015-07-15', '2015-07-16', 4, 3, 11, 'subastacarlos'),
(95, 'prueba1', '2015-07-15', '2015-07-14', 4, 28, 3, 'pruebausuario'),
(96, 'prueba2', '2015-07-15', '2015-07-07', 4, 28, 4, 'pruebados'),
(97, 'camisa a estrenar', '2015-07-17', '2015-08-01', 1, 28, 4, 'camisa'),
(98, 'spursss', '2015-07-17', '2015-08-01', 1, 28, 4, 'remeras'),
(99, 'guanteeeprueba2', '2015-07-17', '2015-08-01', 1, 29, 4, 'guanteeee'),
(100, 'Es una pelotita que esta en muy buen estado', '2015-07-17', '2015-08-01', 1, 30, 13, 'Pelotita de Tenis'),
(101, 'Si queres ser el proximo manu ginobilli no podes dejar pasar esta pelota', '2015-07-17', '2015-08-11', 1, 30, 13, 'Pelota de Basquet'),
(102, 'Esta raqueta me la regalo Pico Monaco.', '2015-07-17', '2015-08-06', 1, 30, 13, 'Raqueta Pico Monaco'),
(103, 'soga para distintas funciones', '2015-07-17', '2015-08-01', 1, 31, 13, 'soga'),
(104, 'Pie bionico 2 anos de uso.', '2015-07-17', '2015-07-14', 4, 31, 2, 'Pie Bionico'),
(105, 'Collar con perlas blancas', '2015-07-17', '2015-08-06', 1, 31, 4, 'collar de perlas'),
(106, 'ak47 utilizada en irak', '2015-07-17', '2015-08-01', 1, 32, 5, 'Ak'),
(107, 'granada de humo de 1998', '2015-07-17', '2015-08-01', 1, 32, 5, 'granada de humo'),
(108, 'Chaleco de la policia de Estados Unidos', '2015-07-17', '2015-08-06', 1, 32, 5, 'Chaleco Antibalas');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

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
(10, 'Juan', 'Rodriguez', 'Jrodriguez@hotmail.com', '2015-05-19', 2, '123456'),
(11, 'Jose', 'Affonso', 'pepit33o@hotmail.com', '2015-04-06', 2, 'pepepe'),
(12, 'Pablo', 'Ortega', 'Pabloo@hotmail.com', '2015-04-25', 2, '123456'),
(13, 'Carlos Alberto', 'Diaz', 'carlosalberto@gmail.com', '2015-06-05', 2, '12345'),
(14, 'Pedro', 'Juarz', 'Peter@gmail.com', '2015-06-05', 2, 'juarez'),
(15, 'Nicolas', 'Insaurralde', 'fjoasf@gm.com', '2015-06-06', 2, 'insaur'),
(16, 'Manuel', 'Perez', 'perez@hotmail.com', '2015-06-16', 2, '123456'),
(17, 'Raul', 'Sosa', 'RaulS@hotmail.com', '2015-01-07', 2, '12345'),
(18, 'Lia', 'Gomez', 'GomezLia@gmail.com', '2015-02-02', 2, '12345lia'),
(19, 'Fernanda', 'Perez', 'FerPer@hotmail.com', '2015-03-03', 2, 'ferper12345'),
(20, 'Mario', 'Cascarelli', 'MarioCascarelli@hotmail.com', '2015-05-05', 2, '12345'),
(21, 'Eugenia', 'Gutierrez', 'EugeGutie@yahoo.com.ar', '2015-03-26', 2, 'euge9'),
(22, 'Mariano', 'Gonzalez', 'mariangon@hotmail.com', '2015-04-09', 2, '312893'),
(23, 'Josefina', 'Suarez', 'Josefina@hotmail.com', '2015-05-14', 2, '1234567'),
(24, 'Roberto', 'Gomez', 'chavo@hotmail.com', '2015-04-24', 2, 'chavito8'),
(25, 'Andres', 'Formia', 'andyformia@hotmail.com', '2015-01-30', 2, '5555555'),
(26, 'Carlos', 'Barca', 'CarlosBarca@hotmail.com', '2015-03-30', 2, '1carlos123'),
(27, 'jhkjhj', 'hhuhuh', 'jahdja22qq@hotmail.com', '2015-07-10', 1, '123456'),
(28, 'prueba', 'usuario', 'prueba@hotmail.com', '2015-07-15', 2, '123456'),
(29, 'pruebita', 'dos', 'prueba2@hotmail.com', '2015-07-17', 2, '123456'),
(30, 'nicolas', 'affonso', 'nico@hotmail.com', '2015-07-17', 2, '123456'),
(31, 'pablo', 'ordonez', 'pablo@hotmail.com', '2015-07-17', 2, '123456'),
(32, 'mauro', 'coscarelli', 'mauro@hotmail.com', '2015-07-17', 2, '123456');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD CONSTRAINT `oferta_ibfk_1` FOREIGN KEY (`idestadoofer`) REFERENCES `estado_oferta` (`idestadooferta`),
  ADD CONSTRAINT `oferta_ibfk_2` FOREIGN KEY (`idusuarioofer`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `oferta_ibfk_3` FOREIGN KEY (`idsubastaofer`) REFERENCES `subasta` (`idsubasta`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
