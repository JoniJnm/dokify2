SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `agreements` (
`id` int(11) NOT NULL,
  `name` varchar(127) NOT NULL COMMENT 'Name of the agreement'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='The companies be part of one agreement ID';

CREATE TABLE `agreement_relations` (
  `id_agreement` int(11) NOT NULL,
  `id_relation` int(11) NOT NULL,
  `order` smallint(6) NOT NULL COMMENT 'To control downstream'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Relations in the agreement';

CREATE TABLE `companies` (
`id` int(11) NOT NULL,
  `name` varchar(127) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `relations` (
`id` int(11) NOT NULL,
  `client` int(11) NOT NULL COMMENT 'Company ID',
  `provider` int(11) NOT NULL COMMENT 'Company ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Relations between companies (client -> provider)';


ALTER TABLE `agreements`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `agreement_relations`
 ADD UNIQUE KEY `id_agreement` (`id_agreement`,`id_relation`), ADD KEY `id_relation` (`id_relation`), ADD KEY `order` (`order`);

ALTER TABLE `companies`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

ALTER TABLE `relations`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `client` (`client`,`provider`), ADD KEY `provider` (`provider`);


ALTER TABLE `agreements`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `companies`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `relations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `agreement_relations`
ADD CONSTRAINT `agreement_relations_ibfk_1` FOREIGN KEY (`id_agreement`) REFERENCES `agreements` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `agreement_relations_ibfk_2` FOREIGN KEY (`id_relation`) REFERENCES `relations` (`id`);

ALTER TABLE `relations`
ADD CONSTRAINT `relations_ibfk_2` FOREIGN KEY (`provider`) REFERENCES `companies` (`id`),
ADD CONSTRAINT `relations_ibfk_1` FOREIGN KEY (`client`) REFERENCES `companies` (`id`);
