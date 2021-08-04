-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Ago-2021 às 20:44
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `a_loja`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `fk_carrinho_usuario` int(11) DEFAULT NULL,
  `fk_carrinho_produto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `fk_carrinho_usuario`, `fk_carrinho_produto`) VALUES
(22, 5, 19),
(25, 3, 19),
(29, 1, 19);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `conteudo` varchar(255) DEFAULT NULL,
  `dia_hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fk_coment_usuario` int(11) DEFAULT NULL,
  `fk_coment_produto` int(11) DEFAULT NULL,
  `fk_coment_vendedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `comentario`
--

INSERT INTO `comentario` (`id`, `conteudo`, `dia_hora`, `fk_coment_usuario`, `fk_coment_produto`, `fk_coment_vendedor`) VALUES
(8, 'Oi :)', '2021-07-19 12:45:06', 3, 19, NULL),
(12, 'Gears &eacute; incr&iacute;vel ', '2021-07-19 18:26:28', 3, 19, NULL),
(13, 'ainda tem?', '2021-07-19 20:22:44', 3, 19, NULL),
(16, 'Ol&aacute;, muito boa noite. O produto &eacute; novo? Vem nota fiscal?', '2021-07-19 23:05:21', 1, 19, NULL),
(17, 'E se esse coment&aacute;rio fosse t&atilde;o grande a ponto de interferir na interface do bloco de coment&aacute;rio uma vez que talvez, n&atilde;o tendo a certeza imposs&iacute;vel afirmar, o campo pode ser de tamanho limitado e at&eacute; mesmo o layout', '2021-07-20 00:43:47', 1, 19, NULL),
(21, 'Ainda tem?', '2021-08-04 17:00:18', 7, 38, NULL),
(22, 'Vende 4?', '2021-08-04 18:06:24', 5, 19, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `nome_produto` varchar(100) DEFAULT NULL,
  `preco` varchar(10) DEFAULT NULL,
  `desc_produto` varchar(255) DEFAULT NULL,
  `categoria` varchar(15) DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `clique` int(11) DEFAULT 0,
  `fk_produto_vendedor` int(11) DEFAULT NULL,
  `img_produto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `nome_produto`, `preco`, `desc_produto`, `categoria`, `qtd`, `clique`, `fk_produto_vendedor`, `img_produto`) VALUES
(19, 'Gears 5', '89', 'Desfrute da campanha &eacute;pica com at&eacute; 4 amigos em coop e dos v&aacute;rios modos multiplayer maneir&iacute;ssimos', 'game', 4, 498, 1, '561a75be1869b3038bbfe387be0a89a282f4a0be.jpg'),
(31, 'RTX 3090', '22200', 'Evolua a performance do seu pc ao m&aacute;ximo', 'pc', 2, 2, 1, '8b7b26cdbfa865ff6e1fda27b3da524efa2640ab.png'),
(32, 'Teclado Mec&acirc;nico', '350', 'Teclado de alta performance e durabilidade', 'pc', 25, 1, 1, '9f908c71187d4a2b7e24b75fddbb93656766ce4e.png'),
(33, 'Monitor Asus Rog Swift', '7500', 'Monitor com resolu&ccedil;&atilde;o quad hd 2560x1440 e taxa de atualiza&ccedil;&atilde;o de 144hz', 'pc', 5, 3, 1, 'd4cd4294290be4a0f88a7e87adc6bcb6520426a7.png'),
(34, 'Galaxy S21 Ultra', '7200', 'Smartphone mais poderoso da Samsung', 'smartphone', 12, 0, 1, '48565a9e481a6b030fd366120089cb6eea2ddea9.png'),
(35, 'Xbox Series S', '3400', 'O console custo x benef&iacute;cio da pr&oacute;xima gera&ccedil;&atilde;o', 'game', 5, 15, 1, '9afe6158cf425ede225a9f12a4318fd5548e1aa1.png'),
(37, 'Iphone 12 Pro Max', '9900', 'Iphone ', 'smartphone', 34, 1, 1, 'f19442fd35598e472893324a823c6a5d0841b8f0.png'),
(38, 'Xbox Series X', '4700', 'O console mais poderoso da atualidade', 'game', 20, 12, 1, '665b0b1dea2ab227815bf7465aec3611c7abd820.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reposta`
--

CREATE TABLE `reposta` (
  `id` int(11) NOT NULL,
  `conteudo` varchar(255) DEFAULT NULL,
  `dia_hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fk_coment` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `reposta`
--

INSERT INTO `reposta` (`id`, `conteudo`, `dia_hora`, `fk_coment`) VALUES
(1, 'Realmente Triss, jogo &eacute; sensacional!!!', '2021-07-19 19:18:30', 12),
(3, 'Oi, tudo bem? J&aacute; decidiu o que vai levar hoje?', '2021-07-19 19:41:06', 8),
(5, 'Tem sim, pode comprar que eu envio no mesmo dia que o pagamento for confirmado', '2021-07-19 20:41:58', 13),
(9, 'bugou a&iacute; ', '2021-07-20 13:45:42', 17),
(10, 'sim, todos os produtos da loja s&atilde;o novos e v&atilde;o com nota fiscal.', '2021-07-20 13:46:29', 16);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `perfil` varchar(12) DEFAULT 'comum',
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `perfil`, `nome`, `email`, `senha`) VALUES
(1, 'comum', 'jadson', 'jadson@hotmail.com', '$2y$10$w9OwG.YZTaGpdcRMous8n.P0RMep2CxNESG/GtTGZG6sbaE87YO0C'),
(3, 'comum', 'triss', 'triss@gmail.com', '$2y$10$W2.wHx8cJbtk5IYyx13n7.eQqAA0haacYEEl5Zvu8fcTX4zsq8iWS'),
(4, 'comum', 'margarita', 'margarita@gmail.com', '$2y$10$WO9H8Wn5vJnFsk2bWnLvjOtNExw2tNpK7u355lyzGh9a0PCeFBzg6'),
(5, 'comum', 'cirilla', 'cirilla@gmail.com', '$2y$10$OJBI87l8paxf6RCBk0RkPe9cdTzOfvjpCF6evQm2SJDYMVQFgHUfa'),
(6, 'comum', 'efraim', 'efraim@gmail.com', '$2y$10$hld23M1CsiPrIhAq5wrS1u9yd/h9PlxjOEQySip.nuqUVKUWxfaIe'),
(7, 'comum', 'anarietta', 'anarieta@gmail.com', '$2y$10$FlH0Iyb2XFVAf6rIlnyv/.YwNX/pNLKTvMf9WTx8q7jQpkcn0a94K'),
(8, 'comum', 'josue', 'josue@gmail.com', '$2y$10$XdFI8pOE0uWLBxDIxiYD6upa/40U0cACdFaE2FU/U6yRApG1LrvWu'),
(9, 'comum', 'matilda', 'matilda@gmail.com', '$2y$10$DcHaedu6IRZ6G4.XYTME/OVE3ZIhHeXknGtJWcKUEYZenn0oVyJlK');

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `hora_venda` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fk_venda_produto` int(11) DEFAULT NULL,
  `fk_venda_comprador` int(11) DEFAULT NULL,
  `fk_venda_vendedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `venda`
--

INSERT INTO `venda` (`id`, `hora_venda`, `fk_venda_produto`, `fk_venda_comprador`, `fk_venda_vendedor`) VALUES
(1, '2021-07-20 02:44:18', 19, 1, 1),
(2, '2021-07-20 02:45:31', 19, 1, 1),
(3, '2021-07-20 02:47:30', 19, 1, 1),
(4, '2021-07-20 02:47:48', 19, 1, 1),
(5, '2021-07-20 02:48:01', 19, 1, 1),
(6, '2021-07-20 02:48:06', 19, 1, 1),
(9, '2021-07-20 03:01:53', 19, 3, 1),
(13, '2021-07-20 03:56:22', 19, 3, 1),
(16, '2021-07-20 19:16:09', 19, 5, 1),
(17, '2021-07-20 19:19:00', 19, 5, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendedor`
--

CREATE TABLE `vendedor` (
  `id` int(11) NOT NULL,
  `perfil` varchar(12) DEFAULT 'vendedor',
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `vendedor`
--

INSERT INTO `vendedor` (`id`, `perfil`, `nome`, `email`, `senha`) VALUES
(1, 'boss', 'Jadson Store', 'jadson@gmail.com', '$2y$10$RNUVW9KFQaEXMdgkmqsuOO9dYBPeOPyhJhxgQ4oW1eSSmehsf6hBq');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carrinho_usuario` (`fk_carrinho_usuario`),
  ADD KEY `fk_carrinho_produto` (`fk_carrinho_produto`);

--
-- Índices para tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_coment_usuario` (`fk_coment_usuario`),
  ADD KEY `fk_coment_produto` (`fk_coment_produto`),
  ADD KEY `fk_coment_vendedor` (`fk_coment_vendedor`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `fk_produto_vendedor` (`fk_produto_vendedor`);

--
-- Índices para tabela `reposta`
--
ALTER TABLE `reposta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_coment` (`fk_coment`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_venda_produto` (`fk_venda_produto`),
  ADD KEY `fk_venda_comprador` (`fk_venda_comprador`),
  ADD KEY `fk_venda_vendedor` (`fk_venda_vendedor`);

--
-- Índices para tabela `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `reposta`
--
ALTER TABLE `reposta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`fk_carrinho_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`fk_carrinho_produto`) REFERENCES `produto` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`fk_coment_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`fk_coment_produto`) REFERENCES `produto` (`id_produto`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_3` FOREIGN KEY (`fk_coment_vendedor`) REFERENCES `vendedor` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`fk_produto_vendedor`) REFERENCES `vendedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `reposta`
--
ALTER TABLE `reposta`
  ADD CONSTRAINT `reposta_ibfk_1` FOREIGN KEY (`fk_coment`) REFERENCES `comentario` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`fk_venda_produto`) REFERENCES `produto` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venda_ibfk_2` FOREIGN KEY (`fk_venda_comprador`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venda_ibfk_3` FOREIGN KEY (`fk_venda_vendedor`) REFERENCES `vendedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
