-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2025 a las 03:02:51
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ucabits`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_prod` int(11) NOT NULL,
  `nombre_prod` varchar(100) NOT NULL,
  `descrip_prod` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `id_tienda` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_prod`, `nombre_prod`, `descrip_prod`, `precio`, `id_tienda`) VALUES
(1, 'Enchiladas rojas', 'Enchiladas con salsa roja, pollo, queso y crema', 75.50, 1),
(2, 'Chilaquiles verdes', 'Chilaquiles con salsa verde, pollo, queso y crema', 65.80, 1),
(3, 'Sincronizada', 'Tortilla de harina con queso oaxaca y jamón', 45.00, 1),
(4, 'Molletes', 'Bolillo con frijoles, queso y pico de gallo', 35.50, 1),
(5, 'Agua de limon', 'Agua fresca de limon', 15.00, 1),
(6, 'Boing de mango', 'Juguito boing chico', 18.00, 1),
(7, 'Orden de tacos de colores', '3 tacos con tortillas de colores, pastor y cilantro', 65.00, 2),
(8, 'Hot dogs', 'Hot dog con salchicha, cebolla, jalapeños y salsas', 40.00, 2),
(9, 'Licuado de plátano', 'Licuado de plátano con leche y azúcar', 25.00, 2),
(10, 'Malteada de chocolate', 'Malteada de chocolate con helado de vainilla', 35.00, 2),
(11, 'Agua de Jamaica', 'Agua fresca de Jamaica natural', 15.00, 2),
(12, 'Agua de horchata', 'Agua fresca de horchata con canela', 15.00, 2),
(13, 'Chicken tenders', '4 piezas de pollo empanizado con papas', 85.00, 3),
(14, 'Chilaquiles con chicken tenders', 'Chilaquiles rojos con piezas de pollo empanizado', 95.50, 3),
(15, 'Molletes', 'Bolillo con frijoles, queso y pollo deshebrado', 45.00, 3),
(16, 'Pizzas', 'Pizza personal con pepperoni y queso', 55.00, 3),
(17, 'Cocacolas', 'Refresco Coca-Cola 600ml', 20.00, 3),
(18, 'Mirinda', 'Refresco Mirinda naranja 600ml', 20.00, 3),
(19, 'Tacos de pastor', 'Tacos al pastor con piña y cilantro', 15.00, 4),
(20, 'Taco de bistec', 'Taco de bistec a la plancha con cebolla', 18.00, 4),
(21, 'Taco adobada', 'Taco de carne adobada con cebolla asada', 17.00, 4),
(22, 'Taco de guisado', 'Taco de guisado del día (pollo, res o cerdo)', 16.00, 4),
(23, 'Manzanita', 'Refresco Manzanita 600ml', 18.00, 4),
(24, 'Sprite', 'Refresco Sprite 600ml', 18.00, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_prod`),
  ADD KEY `id_tienda` (`id_tienda`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
