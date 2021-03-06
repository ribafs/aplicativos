CREATE TABLE `produtos` (
`id` INT(11) NOT NULL AUTO_INCREMENT,
`descricao` VARCHAR(50) NULL DEFAULT NULL,
`estoque_minimo` INT(11) NULL DEFAULT NULL,
`estoque_maximo` INT(11) NULL DEFAULT NULL,
PRIMARY KEY (`id`));

CREATE TABLE `compras` (
`id` INT(11) NOT NULL AUTO_INCREMENT,
`produto_id` INT(11) NULL DEFAULT NULL,
`quantidade` INT(11) NULL DEFAULT NULL,
`valor_unitario` DECIMAL(9,2) NULL DEFAULT '0.00',
`data` DATE NULL DEFAULT NULL,
PRIMARY KEY (`id`));

CREATE TABLE `estoques` (
`id` INT(11) NOT NULL AUTO_INCREMENT,
`produto_id` INT(11) NULL DEFAULT NULL,
`quantidade` INT(11) NULL DEFAULT NULL,
`valor_unitario` DECIMAL(9,2) NULL DEFAULT '0.00',
PRIMARY KEY (`id`));

CREATE TABLE `vendas` (
`id` INT(11) NOT NULL AUTO_INCREMENT,
`produto_id` INT(11) NULL DEFAULT NULL,
`quantidade` INT(11) NULL DEFAULT NULL,
`data` DATE NULL DEFAULT NULL,
`valor_unitario` DECIMAL(9,2) NULL DEFAULT '0.00',
PRIMARY KEY (`id`));

