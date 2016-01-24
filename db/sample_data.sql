SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

INSERT INTO `agreements` (`id`, `name`) VALUES
(9, 'Acuerdo 1'),
(11, 'Acuerdo 2');

INSERT INTO `agreement_relations` (`id_agreement`, `id_relation`, `order`) VALUES
(9, 22, 1),
(11, 17, 1),
(9, 18, 2),
(11, 16, 2),
(9, 23, 3);

INSERT INTO `companies` (`id`, `name`) VALUES
(8, 'Empresa A'),
(6, 'Empresa B'),
(1, 'Empresa C'),
(15, 'Empresa D'),
(16, 'Empresa E');

INSERT INTO `relations` (`id`, `client`, `provider`) VALUES
(10, 1, 6),
(22, 1, 8),
(24, 1, 16),
(17, 6, 8),
(23, 6, 16),
(16, 8, 1),
(18, 8, 6),
(21, 15, 8);
