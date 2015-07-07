-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2015 a las 03:46:55
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.5.24

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
  `idcategoria` int(45) NOT NULL,
  `contenido_cat` varchar(100) NOT NULL,
  `idestadocat` int(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

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
  `idcomentario` int(45) NOT NULL,
  `cuerpo` varchar(250) NOT NULL,
  `idusuariocom` int(45) NOT NULL,
  `idsubastacom` int(45) NOT NULL,
  `idestadocom` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_categoria`
--

CREATE TABLE IF NOT EXISTS `estado_categoria` (
  `idestadocat` int(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
  `idestadocom` int(45) NOT NULL,
  `descripcioncom` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
  `idestadooferta` int(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
  `idestadosubasta` int(45) NOT NULL,
  `descripcion` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
  `idfoto` int(45) NOT NULL,
  `idsubasta` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=latin1;

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
(40, 28, 'imagenes/pino.jpg'),
(41, 28, 'imagenes/pino2.jpg'),
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
(132, 88, 'imagenes/132patacon2.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

CREATE TABLE IF NOT EXISTS `oferta` (
  `idoferta` int(45) NOT NULL,
  `razon` varchar(200) NOT NULL,
  `monto` double NOT NULL,
  `esganador` tinyint(1) NOT NULL,
  `idestadoofer` int(45) NOT NULL,
  `idusuarioofer` int(45) NOT NULL,
  `idsubastaofer` int(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `oferta`
--

INSERT INTO `oferta` (`idoferta`, `razon`, `monto`, `esganador`, `idestadoofer`, `idusuarioofer`, `idsubastaofer`) VALUES
(1, 'me gusto demasiado.', 1500, 0, 1, 5, 1),
(2, 'Tengo un local de ropa y me es muy necesario.', 500, 0, 1, 8, 12),
(3, 'La necesito urgente para un cumple!!', 250, 0, 1, 10, 10),
(4, 'Me parecio espectacular y me vendria muy bien', 80, 0, 1, 9, 1),
(5, 'soy carnicero y lamentablemente perdi un dedo trabajando.Me gustaria comprar el producto para que no me vuelva a ocurrir', 600, 0, 1, 6, 1),
(6, 'Siempre me gustaron los animales porque vivo solo y son buena compania.Una llama es justo lo que necesito.', 2500, 0, 1, 7, 2),
(7, 'Siempre quise ser un vampiro.Con este espejo no me convertiria en vampiro pero me ayudaria a sentirme uno.', 20, 0, 1, 6, 5),
(8, 'Odio a superman y si algun dia lo llego a cruzar este producto me vendria al pelo.', 1500, 0, 1, 8, 6),
(9, 'Soy carpintero y la necesito para cuando manejo la sierra.', 500, 0, 1, 9, 1),
(10, 'La verdad, si estas seguro de lo que queres hacer, me tenes que elegir a mi.', 10, 0, 1, 6, 7),
(11, 'Me vendria muy bien una palmera para decorar mi parque pequeño pero extravagante', 200, 0, 1, 7, 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subasta`
--

CREATE TABLE IF NOT EXISTS `subasta` (
  `idsubasta` int(25) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `idestadosub` int(45) NOT NULL,
  `idusuariosub` int(45) NOT NULL,
  `idcategoriasub` int(45) NOT NULL,
  `titulo` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subasta`
--

INSERT INTO `subasta` (`idsubasta`, `descripcion`, `fecha_inicio`, `fecha_fin`, `idestadosub`, `idusuariosub`, `idcategoriasub`, `titulo`) VALUES
(1, 'Guantes de malla de acero inox.tejido, anticorte , marca "manulatex" de marca e industria francesa.', '2015-06-20', '2015-07-07', 1, 3, 3, 'Guantes de acerox'),
(2, 'llama adulta oriunda de Tilcara.Es mansita.', '2015-06-12', '2015-06-30', 1, 4, 10, 'Llama'),
(5, 'Espejo sin marco.Medidas 0.8m x 1.2m. ', '2015-06-25', '2015-07-15', 1, 3, 5, 'Espejo'),
(6, '200 gr. de Kriptonita.', '2015-06-07', '2015-07-01', 1, 4, 13, 'Kriptonita'),
(7, '200ml. de aceite y 300ml de vinagre.No incluye frascos.', '2015-05-30', '2015-06-14', 4, 5, 1, 'Aceite y Vinagre'),
(8, 'Reloj de pulsera con calculadora incluida.', '2015-03-09', '2015-04-01', 4, 7, 8, 'Reloj calculadora'),
(9, 'Alcancia personaliza con un Angry Bird.', '2015-06-12', '2015-06-27', 4, 8, 13, 'Alcancia Angry Birds'),
(10, 'Gato cachorro y macho muy mimoso.', '2015-06-01', '2015-07-01', 1, 9, 10, 'Gatito pardo'),
(11, 'Deliciosa torta de chocolate.Hecha por Maru Botana.', '2015-02-03', '2015-03-01', 4, 6, 1, 'Chocotorta'),
(12, 'Autito HotWells 0km.', '2015-06-09', '2015-06-28', 4, 7, 11, 'Autito Hotweels'),
(13, 'Hermoso Boyero de Berna.Es mas bueno que el pan.', '2015-06-08', '2015-06-29', 4, 9, 10, 'Boyero de Berna'),
(14, 'Una obra maestra de la literatura Hispanoamericana.', '2015-06-01', '2015-06-19', 4, 8, 7, 'Cien anos de Soledad'),
(15, 'Castillo inflable para que se diviertan todos.', '2015-06-01', '2015-06-22', 4, 7, 13, 'Castillo inflable'),
(16, 'Las empanadas son todas de jamon y queso caseras', '2015-05-27', '2015-06-17', 2, 6, 1, 'Una docena de empanadas'),
(17, 'Tiene 3m de diametro y 1m de profundidad.', '2015-05-20', '2015-06-02', 2, 8, 13, 'Pileta pelopincho'),
(19, 'pileta enorme', '2015-06-01', '2015-06-15', 4, 5, 5, 'Pileta'),
(27, 'Palmera tropical, 3 metros , esta en excelente estado.', '2015-06-20', '2015-07-15', 1, 3, 11, 'Palmera'),
(28, 'Pinito hermoso, perfecto para decoracion de exteriores', '2015-06-26', '2015-07-10', 1, 3, 11, 'Pino'),
(74, 'Campera impermeable ideal para el invierno', '2015-06-29', '2015-07-29', 1, 16, 4, 'Campera'),
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
(88, 'Eran como los pesos pero mas divertidos', '2015-06-29', '2015-07-29', 1, 25, 11, 'Billete Patacon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `idtipousuario` int(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
  `idusuario` int(45) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `fecha_alta` date NOT NULL,
  `idtipo` int(45) NOT NULL,
  `password` varchar(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

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
(20, 'Mario', 'Cascarelli', 'MarioCascarelli@hotmail.com', '2015-05-05', 2, 'contraseña'),
(21, 'Eugenia', 'Gutierrez', 'EugeGutie@yahoo.com.ar', '2015-03-26', 2, 'euge9'),
(22, 'Mariano', 'Gonzalez', 'mariangon@hotmail.com', '2015-04-09', 2, '312893'),
(23, 'Josefina', 'Suarez', 'Josefina@hotmail.com', '2015-05-14', 2, '1234567'),
(24, 'Roberto', 'Gomez', 'chavo@hotmail.com', '2015-04-24', 2, 'chavito8'),
(25, 'Andres', 'Formia', 'andyformia@hotmail.com', '2015-01-30', 2, '5555555'),
(26, 'Carlos', 'Barca', 'CarlosBarca@hotmail.com', '2015-03-30', 2, '1carlos123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`), ADD KEY `idestadocat` (`idestadocat`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`idcomentario`), ADD KEY `idusuariocom` (`idusuariocom`,`idsubastacom`,`idestadocom`), ADD KEY `idsubastacom` (`idsubastacom`), ADD KEY `idestadocom` (`idestadocom`);

--
-- Indices de la tabla `estado_categoria`
--
ALTER TABLE `estado_categoria`
  ADD PRIMARY KEY (`idestadocat`);

--
-- Indices de la tabla `estado_comentario`
--
ALTER TABLE `estado_comentario`
  ADD PRIMARY KEY (`idestadocom`);

--
-- Indices de la tabla `estado_oferta`
--
ALTER TABLE `estado_oferta`
  ADD PRIMARY KEY (`idestadooferta`);

--
-- Indices de la tabla `estado_subasta`
--
ALTER TABLE `estado_subasta`
  ADD PRIMARY KEY (`idestadosubasta`), ADD KEY `idestadosubasta` (`idestadosubasta`);

--
-- Indices de la tabla `foto_subasta`
--
ALTER TABLE `foto_subasta`
  ADD PRIMARY KEY (`idfoto`);

--
-- Indices de la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD PRIMARY KEY (`idoferta`), ADD KEY `idestadoofer` (`idestadoofer`,`idusuarioofer`,`idsubastaofer`), ADD KEY `idusuarioofer` (`idusuarioofer`), ADD KEY `idsubastaofer` (`idsubastaofer`);

--
-- Indices de la tabla `subasta`
--
ALTER TABLE `subasta`
  ADD PRIMARY KEY (`idsubasta`), ADD KEY `idestadosub` (`idestadosub`,`idusuariosub`,`idcategoriasub`), ADD KEY `idusuariosub` (`idusuariosub`), ADD KEY `idcategoriasub` (`idcategoriasub`), ADD KEY `idestadosub_2` (`idestadosub`), ADD KEY `idsubasta` (`idsubasta`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`idtipousuario`), ADD KEY `idtipousuario` (`idtipousuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`), ADD KEY `idtipo` (`idtipo`), ADD KEY `idusuario` (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(45) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `idcomentario` int(45) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estado_categoria`
--
ALTER TABLE `estado_categoria`
  MODIFY `idestadocat` int(45) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `estado_comentario`
--
ALTER TABLE `estado_comentario`
  MODIFY `idestadocom` int(45) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `estado_oferta`
--
ALTER TABLE `estado_oferta`
  MODIFY `idestadooferta` int(45) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `estado_subasta`
--
ALTER TABLE `estado_subasta`
  MODIFY `idestadosubasta` int(45) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `foto_subasta`
--
ALTER TABLE `foto_subasta`
  MODIFY `idfoto` int(45) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=133;
--
-- AUTO_INCREMENT de la tabla `oferta`
--
ALTER TABLE `oferta`
  MODIFY `idoferta` int(45) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `subasta`
--
ALTER TABLE `subasta`
  MODIFY `idsubasta` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `idtipousuario` int(45) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(45) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
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
