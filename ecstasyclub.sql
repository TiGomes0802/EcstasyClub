-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 07-Jan-2023 às 20:19
-- Versão do servidor: 5.7.31
-- versão do PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ecstasyclub`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1670331358),
('cliente', '33', 1670886157),
('cliente', '34', 1670988876),
('cliente', '38', 1671498064),
('cliente', '40', 1672170923),
('cliente', '41', 1672227687),
('cliente', '42', 1673119296),
('cliente', '43', 1673120075),
('gestor', '35', 1671071423),
('gestor', '39', 1671677975),
('rp', '31', 1670334855),
('rp', '37', 1671487537),
('seguranca', '36', 1671417994);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('adicionarGaleria', 2, 'Adicionar fotografia', NULL, NULL, 1670331358, 1670331358),
('admin', 1, NULL, NULL, NULL, 1670331358, 1670331358),
('cliente', 1, NULL, NULL, NULL, 1670331358, 1670331358),
('comprarPulseira', 2, 'Comprar pulseira/VIP para evento', NULL, NULL, 1670331358, 1670331358),
('createBebida', 2, 'Create Bebida', NULL, NULL, 1670331358, 1670331358),
('createEmpregado', 2, 'Create a Empregado', NULL, NULL, 1670331358, 1670331358),
('createEvento', 2, 'Create a evento', NULL, NULL, 1670331358, 1670331358),
('createNoticia', 2, 'Create Noticia', NULL, NULL, 1670331358, 1670331358),
('createRP', 2, 'Create RP', NULL, NULL, 1670331358, 1670331358),
('deleteBebida', 2, 'Delete Bebida', NULL, NULL, 1670331358, 1670331358),
('deleteEmpregado', 2, 'Delete a Empregado', NULL, NULL, 1670331358, 1670331358),
('deleteEvento', 2, 'Delete a evento', NULL, NULL, 1670331358, 1670331358),
('deleteGaleria', 2, 'Delete a fotografia', NULL, NULL, 1670331358, 1670331358),
('deleteNoticia', 2, 'Delete Noticia', NULL, NULL, 1670331358, 1670331358),
('deleteRP', 2, 'Delete RP', NULL, NULL, 1670331358, 1670331358),
('gestor', 1, NULL, NULL, NULL, 1670331358, 1670331358),
('rp', 1, NULL, NULL, NULL, 1670331358, 1670331358),
('seguranca', 1, NULL, NULL, NULL, 1670331358, 1670331358),
('updateBebida', 2, 'Update Bebida', NULL, NULL, 1670331358, 1670331358),
('updateEmpregado', 2, 'Update a Empregado', NULL, NULL, 1670331358, 1670331358),
('updateEvento', 2, 'Update a evento', NULL, NULL, 1670331358, 1670331358),
('updateNoticia', 2, 'Update Noticia', NULL, NULL, 1670331358, 1670331358),
('updateRP', 2, 'Update RP', NULL, NULL, 1670331358, 1670331358),
('verdadosEstatisticosCodigo', 2, 'Ver dados estatísticos do seu código de RP', NULL, NULL, 1670331358, 1670331358),
('verDadosEventos', 2, 'Ver dados dos eventos passados', NULL, NULL, 1670331358, 1670331358),
('viewBebida', 2, 'View Bebida', NULL, NULL, 1670331358, 1670331358),
('viewEmpregado', 2, 'View a Empregado', NULL, NULL, 1670331358, 1670331358),
('viewEvento', 2, 'View a evento', NULL, NULL, 1670331358, 1670331358),
('viewGaleria', 2, 'View fotografia', NULL, NULL, 1670331358, 1670331358),
('viewNoticia', 2, 'View Noticia', NULL, NULL, 1670331358, 1670331358),
('viewRP', 2, 'View RP', NULL, NULL, 1670331358, 1670331358);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('gestor', 'adicionarGaleria'),
('cliente', 'comprarPulseira'),
('gestor', 'createBebida'),
('admin', 'createEmpregado'),
('gestor', 'createEvento'),
('gestor', 'createNoticia'),
('gestor', 'createRP'),
('gestor', 'deleteBebida'),
('admin', 'deleteEmpregado'),
('gestor', 'deleteEvento'),
('gestor', 'deleteGaleria'),
('gestor', 'deleteNoticia'),
('gestor', 'deleteRP'),
('admin', 'gestor'),
('gestor', 'updateBebida'),
('admin', 'updateEmpregado'),
('gestor', 'updateEvento'),
('gestor', 'updateNoticia'),
('gestor', 'updateRP'),
('rp', 'verdadosEstatisticosCodigo'),
('gestor', 'verDadosEventos'),
('gestor', 'viewBebida'),
('admin', 'viewEmpregado'),
('gestor', 'viewEvento'),
('gestor', 'viewGaleria'),
('gestor', 'viewNoticia'),
('gestor', 'viewRP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bebidas`
--

DROP TABLE IF EXISTS `bebidas`;
CREATE TABLE IF NOT EXISTS `bebidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bebidas`
--

INSERT INTO `bebidas` (`id`, `nome`) VALUES
(2, 'Vodka Absolut'),
(3, 'Wiskey Red Label'),
(4, 'Safari'),
(5, 'Beirão'),
(6, 'Gin Gordon\'s'),
(7, 'Whisky Jack Daniel\'s Honey'),
(8, 'Whisky Jack Daniel`S Apple'),
(9, 'Whisky Jack Daniel\'s Fire'),
(10, 'Whisky Jack Daniel\'s Bourbon'),
(11, 'Gin Bombay Sapphire'),
(12, 'Gin Hendricks'),
(13, 'Vodka Grey Goose Citron');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disco`
--

DROP TABLE IF EXISTS `disco`;
CREATE TABLE IF NOT EXISTS `disco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) NOT NULL,
  `nif` varchar(9) NOT NULL,
  `localidade` varchar(25) NOT NULL,
  `codpostal` varchar(8) NOT NULL,
  `morada` varchar(50) NOT NULL,
  `lotacao` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disco`
--

INSERT INTO `disco` (`id`, `nome`, `nif`, `localidade`, `codpostal`, `morada`, `lotacao`) VALUES
(1, 'EcstasyClub', '506743157', 'Leiria', '2400-241', 'R. Capitao Mouzinho de Albuquerque 93 Fração B, 24', 750);

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) NOT NULL,
  `descricao` varchar(750) NOT NULL,
  `cartaz` varchar(250) NOT NULL,
  `dataevento` datetime NOT NULL,
  `numbilhetesdisp` int(11) NOT NULL,
  `preco` float NOT NULL,
  `estado` varchar(25) NOT NULL,
  `id_criador` int(11) NOT NULL,
  `id_tipo_evento` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idcriador` (`id_criador`),
  KEY `idtipoevento` (`id_tipo_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id`, `nome`, `descricao`, `cartaz`, `dataevento`, `numbilhetesdisp`, `preco`, `estado`, `id_criador`, `id_tipo_evento`) VALUES
(2, 'BAILÃO', '<p>Mais um <strong>bail&atilde;o</strong></p>\r\n', 'GAILÃO20221213020553000.jpg', '2022-12-15 11:30:00', 42, 13.02, 'desativo', 1, 1),
(3, 'TrapNation', '<p><strong><em>TRAP&nbsp;</em></strong><s>NATION</s></p>\r\n', 'TrapNation20221214083130000.jpg', '2022-12-17 11:30:00', 48, 42.21, 'desativo', 1, 3),
(4, 'Party', '<p>Vem te divertir-te na <strong>melhor festa</strong> de sempre.</p>\r\n', 'Party20221214101734000.jpg', '2022-12-14 11:30:00', 42, 50, 'desativo', 1, 2),
(5, 'Fifty Parte a Case Bro!', '<p><em>O</em> <em><strong>FIFTY&nbsp;</strong>vem</em> <s>partir a casa</s> <em>e tu</em> <strong>vens </strong><em>tambem?</em></p>\r\n', 'FiftyParteaCaseBro!20221215023405000.jpg', '2022-12-27 23:30:00', 1, 12.21, 'desativo', 18, 2),
(6, 'FESTA CAMARADINHA', '<p><strong>Lorem Ipsum</strong>&nbsp;porque is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '+120221219030043000.jpg', '2022-12-20 23:30:00', 42, 12, 'desativo', 1, 4),
(7, 'Festarola', '<p><strong>Fes</strong><em>ta</em><u>ro</u><s>la</s></p>\r\n', 'Festarola20221222012653000.jpg', '2022-12-22 23:30:00', 42, 13.75, 'desativo', 1, 1),
(8, 'new crue', '<p><strong>new crue</strong></p>\r\n', 'newcrue20221227084122000.jpg', '2022-12-29 21:19:24', 49, 25, 'cancelado', 1, 1),
(9, 'Um evento', '<p>+1 evento</p>\r\n', 'Umevento20221230041938000.jpg', '2022-12-30 23:30:00', 39, 5.01, 'desativo', 1, 5),
(10, 'outro evento', '<p>+2&nbsp;outro eventos</p>\r\n', 'outroevento20221230051231000.jpg', '2050-08-08 23:30:00', 32, 7, 'ativo', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `faturas`
--

DROP TABLE IF EXISTS `faturas`;
CREATE TABLE IF NOT EXISTS `faturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datahora_compra` datetime NOT NULL,
  `preco` float NOT NULL,
  `id_pulseira` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idpulseira` (`id_pulseira`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `faturas`
--

INSERT INTO `faturas` (`id`, `datahora_compra`, `preco`, `id_pulseira`) VALUES
(1, '2023-01-07 19:22:04', 40, 1),
(2, '2023-01-07 19:35:03', 65, 2),
(4, '2023-01-07 19:37:24', 7, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `galerias`
--

DROP TABLE IF EXISTS `galerias`;
CREATE TABLE IF NOT EXISTS `galerias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(250) NOT NULL,
  `id_evento` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idevento` (`id_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `galerias`
--

INSERT INTO `galerias` (`id`, `foto`, `id_evento`) VALUES
(10, '202212140324091670988249855582406.jpg', 2),
(11, '202212140324091670988249353297480.jpg', 2),
(13, '202212141015021671056102344520181.jpg', 2),
(14, '202212160332391671161559185802630.jpg', 4),
(15, '202212160332391671161559241056487.jpg', 4),
(16, '202212160332391671161559522152326.jpg', 4),
(17, '202212160332391671161559324662802.jpg', 4),
(18, '202212160332391671161559829172099.jpg', 4),
(19, '202212190256371671418597653939835.jpg', 3),
(20, '202212190256371671418597691581339.jpg', 3),
(21, '202212190256371671418597710086845.jpg', 3),
(22, '202212190256371671418597935249775.jpg', 3),
(23, '202212190256371671418597825053083.jpg', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `linha_fatura`
--

DROP TABLE IF EXISTS `linha_fatura`;
CREATE TABLE IF NOT EXISTS `linha_fatura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_bebida` int(11) NOT NULL,
  `id_fatura` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idbebida` (`id_bebida`),
  KEY `idfatura` (`id_fatura`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `linha_fatura`
--

INSERT INTO `linha_fatura` (`id`, `id_bebida`, `id_fatura`) VALUES
(1, 13, 1),
(2, 11, 1),
(3, 13, 2),
(4, 11, 2),
(5, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1665598053),
('m130524_201442_init', 1665598056),
('m190124_110200_add_verification_token_column_to_user_table', 1665598056),
('m140506_102106_rbac_init', 1666626038),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1666626038),
('m180523_151638_rbac_updates_indexes_without_prefix', 1666626038),
('m200409_110543_rbac_update_mssql_trigger', 1666626038);

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

DROP TABLE IF EXISTS `noticias`;
CREATE TABLE IF NOT EXISTS `noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(25) NOT NULL,
  `datanoticia` datetime NOT NULL,
  `descricao` varchar(750) NOT NULL,
  `id_criador` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idcriador` (`id_criador`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `datanoticia`, `descricao`, `id_criador`) VALUES
(2, 'Qualquer coisas', '2022-12-19 03:18:26', '<p>Qualquer <strong>coisas</strong></p>\r\n', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pulseiras`
--

DROP TABLE IF EXISTS `pulseiras`;
CREATE TABLE IF NOT EXISTS `pulseiras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(25) NOT NULL,
  `tipo` varchar(25) NOT NULL,
  `codigorp` varchar(25) DEFAULT NULL,
  `id_evento` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idevento` (`id_evento`),
  KEY `idcliente` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pulseiras`
--

INSERT INTO `pulseiras` (`id`, `estado`, `tipo`, `codigorp`, `id_evento`, `id_cliente`) VALUES
(1, 'ativa', 'vip', NULL, 10, 25),
(2, 'ativa', 'vip', NULL, 10, 26),
(4, 'ativa', 'normal', 'brunorp', 10, 16);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoevento`
--

DROP TABLE IF EXISTS `tipoevento`;
CREATE TABLE IF NOT EXISTS `tipoevento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipoevento`
--

INSERT INTO `tipoevento` (`id`, `tipo`) VALUES
(1, 'Funk'),
(2, 'Rap'),
(3, 'Trap'),
(4, 'Rock'),
(5, 'Trance');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'gomes0802', 'LaTqN8eSniehbJZc6c2YC5nnA5ZkRBuG', '$2y$13$5CZYw9c02bxsia/gL82uNOWbaCq7nX9FynHLruKwWHHgPT2OPqOsu', NULL, 'tigomes@gmail.com', 10, 1666026155, 1668443220, 'jakZweiCIsAqwJspIIRnEK8dsSQDyKHU_1667964184'),
(31, 'brunorp', 'PgpeBAeAzbZGqCMpS1EPEx_n_Xh6Igof', '$2y$13$wZRavIKxwvb.gHbdKLMSIOBZlxFioU3wZVzPxDNWCN0D8iRhoNdAa', NULL, 'brunorp@gmail.com', 10, 1670334855, 1670334855, 'P04_WffvytM8okL41fXQKvYdbvXNhuOu_1670334855'),
(33, 'clarinha', 'b1RvyFJVNeiIMeLp8IBGwe6DIF6WoEYt', '$2y$13$aZ4rWxG16eXrKrj3DjP3uOpZruvGDsASAzkGZbujmqCoqJC6b7vXq', NULL, 'clarinha@gmail.com', 10, 1670886157, 1671420781, 'qLLiz7vfDDIhptiLC-PjWg3sJmQItnYp_1670886157'),
(34, 'PauloBatista', 'muQmDGlazo3lnGWJu7C1z538inUCQFgO', '$2y$13$sPA1pHW4Qqht6IbivcLz4.Gs9iaFE1zwXww3bHpsEYRqkPAXplx5K', NULL, 'PauloBatista@gmail.com', 10, 1670988876, 1670988876, '2FTDRoM5ATSuLrQGsquthNv8wOmWiUYW_1670988876'),
(35, 'Lucas', '89l7q8iilOjh4NZnuqW4PM5L9QVupytk', '$2y$13$24rPkw1oIHfnUcQnhDf5jeS1XAYSmumAgxl5j/yLiLfdp3rIABIyO', NULL, 'lucas@gmail.com', 10, 1671071423, 1671071423, '2x7x37FU5RTYewvoEBYGWFPH34KCdIZF_1671071423'),
(36, 'PMatos06', 'xpxT03Bov4LR4CoPEvpTYXw6dWJNhIz0', '$2y$13$OaMVn0qoEMf/7r0/P73MkefNQb3AvkVJBdxLdmr76QGqtzB6Wtjg2', NULL, 'PMatos06@gmail.com', 10, 1671417994, 1671417994, 'jo1Cy76REVGu7kc3R5Eaj2KPDb2hyRk1_1671417994'),
(37, 'CamaradaXD', 'fM8xJUqnk4t4haFzSuET_MVShQfLFuKY', '$2y$13$Q2UrL0CN9mO9NUdl0HzomeOKiTUB5vJHOvvYwicKBFEd3hRvd9UO6', NULL, 'camarada@gmail.com', 10, 1671487537, 1671487537, 'LkylzF0tWMxiEl4joLpMn56EP_rDBY2m_1671487537'),
(38, 'fralves', 'Co-5F2lzD1ZEEe8d51qCUBR6__m3w6Bu', '$2y$13$YFkQrj6c6.Ipxd/6XO5T6OJOkKsxs9r168tr4YwpDdeGsjAD.ashK', NULL, 'francisco@gmail.com', 10, 1671498064, 1671498064, '15RLxNA_gtpootZ4BfAMocxIb3S2CdAT_1671498064'),
(39, 'marcelo', 'mXyqGS2R2ipHTaWP2fFl7IO929ebpNl-', '$2y$13$YknkKir2VImug351nty3Bud3DoBgQadPUMUCX1hAclJ3773MwneXq', NULL, 'marcelo@gmail.com', 10, 1671677975, 1671677975, '8dLxM5WSMkvFB9DTAc-ng67ZVSKU1_za_1671677975'),
(40, 'BerserkerPT', 'IGhYWcYYz7DnJ5gq5xQr0SktK6goOa4Q', '$2y$13$KH2/wrCwaRq8T6S.OBkRq.PzvUA1K.0HTMfdCnaYM4dBhFu9zYMee', NULL, 'botas@gmail.com', 10, 1672170923, 1672170923, '2oIlRZ8lnfWObmKml3hEkJ17c5f3JGJs_1672170923'),
(41, 'fgomes', 'oS8Wk1d61KBbXCua5KMWBwdSFZD1aw__', '$2y$13$dc13om3kX.FiQW8lWC7KmeJeWzSOJXxi/vA5yo..wcaPi95tb9d5y', NULL, 'fgomes@gmail.com', 10, 1672227687, 1672227687, 'HGm-CTPv6Czg_HlVMHYXO4-keekB5E2K_1672227687'),
(42, 'teste072134000', 'Wk8Gi8uvoPohWia7k7QkyNyjMHIEhnk6', '$2y$13$Y8Sz6EH0WtoVFN1MaC.NNubn7wOVlfVyrfDISfYoPhRi7CfxE0m6y', NULL, 'teste072134000@email.com', 10, 1673119296, 1673119296, 'fhJ3aE8n90y-JxvgbcLqEj2eQC6xg6FR_1673119296'),
(43, 'teste073434000', 'RD-n5xGU7kLe8Nv9YrbFZxaZPVJCwVzr', '$2y$13$qo22sgCHICYJauZ9e088DOx3Elnm0rIOP90iHAntw0c643PVjVMJe', NULL, 'teste073434000@email.com', 10, 1673120075, 1673120075, '9GB2iwzjqvM99R9RoP9gTJDe6CGEzALV_1673120075');

-- --------------------------------------------------------

--
-- Estrutura da tabela `userprofile`
--

DROP TABLE IF EXISTS `userprofile`;
CREATE TABLE IF NOT EXISTS `userprofile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) NOT NULL,
  `apelido` varchar(25) NOT NULL,
  `datanascimento` date NOT NULL,
  `codigoRP` varchar(25) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `sexo` varchar(9) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `userprofile`
--

INSERT INTO `userprofile` (`id`, `nome`, `apelido`, `datanascimento`, `codigoRP`, `user_id`, `sexo`) VALUES
(1, 'Tiago', 'Gomes', '2002-08-08', NULL, 1, 'masculino'),
(15, 'Bruno', 'Lopes', '1999-02-02', 'brunorp', 31, 'masculino'),
(16, 'Clara', 'Rodrigues', '1999-05-12', NULL, 33, 'feminino'),
(17, 'Paulo', 'Batista', '2000-01-12', NULL, 34, 'masculino'),
(18, 'Joao', 'Lucas', '2001-02-14', NULL, 35, 'masculino'),
(19, 'Pedro', 'Matos', '2001-06-28', NULL, 36, 'masculino'),
(20, 'Filipe', 'Camarada', '2001-10-27', 'CamaradaXD', 37, 'masculino'),
(21, 'Francisco', 'Alves', '1999-06-22', NULL, 38, 'masculino'),
(22, 'Marcelo', 'Rodrigues', '1996-02-08', NULL, 39, 'masculino'),
(23, 'Gabriel', 'Botas', '2002-08-30', NULL, 40, 'masculino'),
(24, 'Fernando', 'Gomes', '1998-02-17', NULL, 41, 'masculino'),
(25, 'teste', 'teste', '0613-01-20', NULL, 42, 'masculino'),
(26, 'teste', 'teste', '0613-01-20', NULL, 43, 'masculino');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vip`
--

DROP TABLE IF EXISTS `vip`;
CREATE TABLE IF NOT EXISTS `vip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `npessoas` int(11) NOT NULL,
  `descricao` varchar(750) NOT NULL,
  `nbebidas` int(11) NOT NULL,
  `preco` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `vip`
--

INSERT INTO `vip` (`id`, `npessoas`, `descricao`, `nbebidas`, `preco`) VALUES
(1, 10, '<p><strong>VIP&nbsp;</strong><u><em>incrivel!</em></u></p>\r\n', 5, 111.12),
(2, 8, '<p><strong>Melhor VIP</strong></p>\r\n', 4, 85),
(3, 6, '<p>Vip <strong>6</strong> pessoas.</p>\r\n', 3, 65),
(4, 4, '<p>VIP mais <em><strong>economico</strong></em></p>\r\n', 2, 40);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vip_pulseira`
--

DROP TABLE IF EXISTS `vip_pulseira`;
CREATE TABLE IF NOT EXISTS `vip_pulseira` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vip` int(11) NOT NULL,
  `id_pulseira` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idvip` (`id_vip`),
  KEY `idpulseira` (`id_pulseira`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `vip_pulseira`
--

INSERT INTO `vip_pulseira` (`id`, `id_vip`, `id_pulseira`) VALUES
(1, 4, 1),
(2, 3, 2);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`id_criador`) REFERENCES `userprofile` (`id`),
  ADD CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`id_tipo_evento`) REFERENCES `tipoevento` (`id`);

--
-- Limitadores para a tabela `faturas`
--
ALTER TABLE `faturas`
  ADD CONSTRAINT `faturas_ibfk_1` FOREIGN KEY (`id_pulseira`) REFERENCES `pulseiras` (`id`);

--
-- Limitadores para a tabela `galerias`
--
ALTER TABLE `galerias`
  ADD CONSTRAINT `galerias_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`);

--
-- Limitadores para a tabela `linha_fatura`
--
ALTER TABLE `linha_fatura`
  ADD CONSTRAINT `linha_fatura_ibfk_1` FOREIGN KEY (`id_bebida`) REFERENCES `bebidas` (`id`),
  ADD CONSTRAINT `linha_fatura_ibfk_2` FOREIGN KEY (`id_fatura`) REFERENCES `faturas` (`id`);

--
-- Limitadores para a tabela `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`id_criador`) REFERENCES `userprofile` (`id`);

--
-- Limitadores para a tabela `pulseiras`
--
ALTER TABLE `pulseiras`
  ADD CONSTRAINT `pulseiras_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`),
  ADD CONSTRAINT `pulseiras_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `userprofile` (`id`);

--
-- Limitadores para a tabela `userprofile`
--
ALTER TABLE `userprofile`
  ADD CONSTRAINT `userprofile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `vip_pulseira`
--
ALTER TABLE `vip_pulseira`
  ADD CONSTRAINT `vip_pulseira_ibfk_1` FOREIGN KEY (`id_vip`) REFERENCES `vip` (`id`),
  ADD CONSTRAINT `vip_pulseira_ibfk_2` FOREIGN KEY (`id_pulseira`) REFERENCES `pulseiras` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
