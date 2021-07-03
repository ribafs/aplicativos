CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `senha` varchar(250) DEFAULT NULL,
  `nome_completo` varchar(250) DEFAULT NULL,
  `morada` varchar(250) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `purl` varchar(50) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table php_store.clientes: ~1 rows (approximately)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`id_cliente`, `email`, `senha`, `nome_completo`, `morada`, `cidade`, `telefone`, `purl`, `activo`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'sys4soft.phpstore@gmail.com', '$2y$10$StumuKlVUQTIY3d/gCSI1u9kkCngnrwj4YjzG.6rHMGEZDVho0qS.', 'Joao ribeiro', 'morada do cliente', 'cidade do cliente', '', NULL, 1, '2021-01-30 17:31:06', '2021-02-27 23:19:42', NULL);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Dumping structure for table php_store.encomendas
CREATE TABLE IF NOT EXISTS `encomendas` (
  `id_encomenda` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cliente` int(10) unsigned DEFAULT NULL,
  `data_encomenda` datetime DEFAULT NULL,
  `morada` varchar(200) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `codigo_encomenda` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `mensagem` varchar(1000) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_encomenda`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table php_store.encomendas: ~0 rows (approximately)
/*!40000 ALTER TABLE `encomendas` DISABLE KEYS */;
INSERT INTO `encomendas` (`id_encomenda`, `id_cliente`, `data_encomenda`, `morada`, `cidade`, `email`, `telefone`, `codigo_encomenda`, `status`, `mensagem`, `created_at`, `updated_at`) VALUES
	(1, 1, '2021-03-17 23:12:04', 'morada do cliente', 'cidade do cliente', 'sys4soft.phpstore@gmail.com', '', 'SY430834', 'PENDENTE', '', '2021-03-17 23:12:04', '2021-03-17 23:12:04'),
	(2, NULL, '2021-03-17 23:14:26', NULL, NULL, NULL, NULL, NULL, 'PENDENTE', '', '2021-03-17 23:14:26', '2021-03-17 23:14:26'),
	(3, 1, '2021-03-17 23:15:17', 'morada do cliente', 'cidade do cliente', 'sys4soft.phpstore@gmail.com', '', 'RH588766', 'PENDENTE', '', '2021-03-17 23:15:17', '2021-03-17 23:15:17');
/*!40000 ALTER TABLE `encomendas` ENABLE KEYS */;

-- Dumping structure for table php_store.encomenda_produto
CREATE TABLE IF NOT EXISTS `encomenda_produto` (
  `id_encomenda_produto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_encomenda` int(10) unsigned DEFAULT NULL,
  `designacao_produto` varchar(200) DEFAULT NULL,
  `preco_unidade` decimal(6,2) unsigned DEFAULT NULL,
  `quantidade` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_encomenda_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table php_store.encomenda_produto: ~0 rows (approximately)
/*!40000 ALTER TABLE `encomenda_produto` DISABLE KEYS */;
INSERT INTO `encomenda_produto` (`id_encomenda_produto`, `id_encomenda`, `designacao_produto`, `preco_unidade`, `quantidade`, `created_at`) VALUES
	(1, 1, 'Tshirt Vermelha', 45.70, 1, '2021-03-17 23:12:04'),
	(2, 1, 'Tshirt Azul', 55.25, 2, '2021-03-17 23:12:04'),
	(3, 3, 'Tshirt Vermelha', 45.70, 1, '2021-03-17 23:15:17'),
	(4, 3, 'Tshirt Azul', 55.25, 1, '2021-03-17 23:15:17'),
	(5, 3, 'Tshirt Amarela', 32.00, 2, '2021-03-17 23:15:17'),
	(6, 3, 'Vestido Vermelho', 75.20, 1, '2021-03-17 23:15:17');
/*!40000 ALTER TABLE `encomenda_produto` ENABLE KEYS */;

-- Dumping structure for table php_store.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id_produto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) DEFAULT NULL,
  `nome_produto` varchar(50) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `imagem` varchar(200) DEFAULT NULL,
  `preco` decimal(6,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `visivel` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table php_store.produtos: ~9 rows (approximately)
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` (`id_produto`, `categoria`, `nome_produto`, `descricao`, `imagem`, `preco`, `stock`, `visivel`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'homem', 'Tshirt Vermelha', 'Ab laborum, commodi aspernatur, quas distinctio cum quae omnis autem ea, odit sint quisquam similique! Labore aliquam amet veniam ad fugiat optio.', 'tshirt_vermelha.png', 45.70, 100, 1, '2021-02-06 19:45:18', '2021-02-06 19:45:25', NULL),
	(2, 'homem', 'Tshirt Azul', 'Possimus iusto esse atque autem rem, porro officiis sapiente quos velit laboriosam id expedita odio obcaecati voluptate repudiandae dignissimos eveniet repellat blanditiis.', 'tshirt_azul.png', 55.25, 100, 1, '2021-02-06 19:45:19', '2021-02-06 19:45:25', NULL),
	(3, 'homem', 'Tshirt Verde', 'Nostrum quisquam dolorum dolor autem accusamus fugit nesciunt, atque et? Quis eum nemo quidem officia cum dolorem voluptates! Autem, earum. Similique, fugit.', 'tshirt_verde.png', 35.15, 0, 1, '2021-02-06 19:45:20', '2021-02-06 19:45:26', NULL),
	(4, 'homem', 'Tshirt Amarela', 'Molestiae quaerat distinctio, facere perferendis necessitatibus optio repellat alias commodi voluptatem velit corrupti natus exercitationem quos amet facilis sint nulla delectus.', 'tshirt_amarela.png', 32.00, 100, 1, '2021-02-06 19:45:20', '2021-02-06 19:45:27', NULL),
	(5, 'mulher', 'Vestido Vermelho', 'Labore voluptatem sed in distinctio iste tempora quo assumenda impedit illo soluta repudiandae animi earum suscipit, sequi excepturi inventore magnam velit voluptatibus.', 'dress_vermelho.png', 75.20, 100, 1, '2021-02-06 19:45:21', '2021-02-06 19:45:27', NULL),
	(6, 'mulher', 'Vertido Azul', 'Provident ipsum earum magnam odit in, illum nostrum est illo pariatur molestias esse delectus aliquam ullam maxime mollitia tempore, sunt officia suscipit.', 'dress_azul.png', 86.00, 100, 1, '2021-02-06 19:45:21', '2021-02-06 19:45:28', NULL),
	(7, 'mulher', 'Vestido Verde', 'Qui aliquid sed quisquam autem quas recusandae labore neque laudantium iusto modi repudiandae doloremque ipsam ad omnis inventore, cum ducimus praesentium. Consectetur!', 'dress_verde.png', 48.85, 100, 1, '2021-02-06 19:45:22', '2021-02-06 19:45:28', NULL),
	(8, 'mulher', 'Vestido Amarelo', 'Aspernatur labore corporis modi quis temporibus eos hic? Sed fugiat, repudiandae distinctio, labore temporibus, non magni consectetur dolorum earum amet impedit nesciunt.', 'dress_amarelo.png', 46.45, 100, 1, '2021-02-06 19:45:22', '2021-02-06 19:45:29', NULL),
	(11, 'roupa_criança', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
