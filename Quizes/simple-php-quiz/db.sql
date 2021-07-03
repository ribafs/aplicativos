CREATE TABLE `questions` (
  `question_number` int(11) NOT NULL,
  `question` text COLLATE utf16_bin NOT NULL,
  PRIMARY KEY (`question_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

INSERT INTO `questions` (`question_number`, `question`) VALUES
(1,	'Quem descobriu o Brasil'),
(2,	'Quem descobriu a América'),
(3,	'Quem libertou os escravos no Brasil');

CREATE TABLE `choices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_number` int(11) NOT NULL,
  `is_correct` tinyint(4) NOT NULL DEFAULT 0,
  `choice` text COLLATE utf16_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

INSERT INTO `choices` (`id`, `question_number`, `is_correct`, `choice`) VALUES
(1,	1,	1,	'Pedro Álvares Cabral'),
(2,	1,	0,	'João Brito'),
(3,	1,	0,	'Colombo'),
(4,	1,	0,	'Não sei'),
(5,	2,	0,	'Antoñio de Abreu'),
(6,	2,	1,	'Cristóvão Colombo'),
(7,	2,	0,	'Manoel Arruda'),
(8,	3,	0,	'Isabela Terceira'),
(9,	3,	0,	'Jorge Tereceiro'),
(10,	3,	0,	'Janjão Abreu'),
(11,	3,	1,	'Princesa Isabel');

-- 2021-03-22 16:14:04

