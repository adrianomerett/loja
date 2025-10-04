-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 04/10/2025 às 01:36
-- Versão do servidor: 8.0.43
-- Versão do PHP: 8.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loja`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `categoriaid` int NOT NULL,
  `namecategoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`categoriaid`, `namecategoria`) VALUES
(14, 'Eletrônicos'),
(15, 'Smartphones');

-- --------------------------------------------------------

--
-- Estrutura para tabela `config`
--

CREATE TABLE `config` (
  `id` int NOT NULL,
  `nameloja` varchar(60) DEFAULT NULL,
  `fone` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `rua` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `instagran` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `version` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `config`
--

INSERT INTO `config` (`id`, `nameloja`, `fone`, `celular`, `email`, `bairro`, `rua`, `numero`, `instagran`, `facebook`, `x`, `version`) VALUES
(1, 'Tecno Mix', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.0.0');

-- --------------------------------------------------------

--
-- Estrutura para tabela `contatos`
--

CREATE TABLE `contatos` (
  `contatoid` int NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `assunto` varchar(100) DEFAULT NULL,
  `msg` longtext,
  `status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `img`
--

CREATE TABLE `img` (
  `imgid` int NOT NULL,
  `idproduto` int NOT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `img`
--

INSERT INTO `img` (`imgid`, `idproduto`, `img`) VALUES
(32, 18, 'yo5acz.webp'),
(33, 18, 'xd1d46.png'),
(34, 18, 'hd23c9.png'),
(35, 18, 'waxcru.png'),
(36, 19, 'x8t6gc.webp'),
(37, 19, 'y78gho.webp'),
(38, 19, 'z1j370.webp'),
(39, 19, '3clkb0.webp'),
(40, 20, 'ovk1f0.webp'),
(41, 20, 'theexm.webp'),
(42, 20, 'rgzvkk.webp'),
(43, 20, '0uyeny.webp');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `produtoid` int NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `informacoes` longtext,
  `idcategoria` int NOT NULL,
  `idsubcategoria` int NOT NULL,
  `estoque` int DEFAULT NULL,
  `valorcusto` decimal(10,2) DEFAULT NULL,
  `valoroferta` decimal(10,2) DEFAULT NULL,
  `valorvenda` decimal(10,2) DEFAULT NULL,
  `exibirpreco` char(1) DEFAULT NULL,
  `status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`produtoid`, `nome`, `descricao`, `informacoes`, `idcategoria`, `idsubcategoria`, `estoque`, `valorcusto`, `valoroferta`, `valorvenda`, `exibirpreco`, `status`) VALUES
(18, 'Notebbok Dell 14 Polegadas', '<p>DECRIÇÃO	</p>', '<p>iNFO TEC</p>', 14, 2, 2, 1500.00, 1789.23, 1850.32, 'S', 'A'),
(19, 'TV 32 polegadas Samsung ', '<p>Tvs 32 polegadas	</p>', '<p>TVs 32 poelgadas </p>', 14, 1, 0, 250.00, 1999.90, 2300.00, 'S', 'A'),
(20, 'iPhone 16e Apple (128GB) Preto, Tela de 6,1\", 5G e Câmera de 48 MP', '<p>Descrição de iphne 16	</p>', '<p>Informações de Iphone 16</p>', 15, 3, 16, 4500.00, 7812.45, 8901.24, 'S', 'A');

-- --------------------------------------------------------

--
-- Estrutura para tabela `subcategorias`
--

CREATE TABLE `subcategorias` (
  `subcategoriaid` int NOT NULL,
  `idcategoria` int NOT NULL,
  `namesubcategoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `subcategorias`
--

INSERT INTO `subcategorias` (`subcategoriaid`, `idcategoria`, `namesubcategoria`) VALUES
(1, 14, 'TVs'),
(2, 14, 'Notebooks'),
(3, 15, 'Iphones');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `userid` int NOT NULL,
  `name` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sobrenome` varchar(255) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` char(1) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `cadastrado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`userid`, `name`, `sobrenome`, `email`, `password`, `level`, `status`, `cadastrado`) VALUES
(1, 'Adriano', 'Merett Martins', 'adrianomerett@gmail.com', '$2y$12$pf9XNKq4BsfggH8atVUzdea/v6digHdg.6PpSK/ASBE8tJgbmTDM2', 'A', 'A', '2025-09-16 22:27:59');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoriaid`);

--
-- Índices de tabela `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`contatoid`);

--
-- Índices de tabela `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`imgid`),
  ADD KEY `fk_img_produtos` (`idproduto`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`produtoid`) USING BTREE,
  ADD KEY `fk_produtos_categorias` (`idcategoria`),
  ADD KEY `fk_produtos_subcategorias` (`idsubcategoria`);

--
-- Índices de tabela `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`subcategoriaid`),
  ADD KEY `fk_subcategorias_categorias` (`idcategoria`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoriaid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `config`
--
ALTER TABLE `config`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `contatos`
--
ALTER TABLE `contatos`
  MODIFY `contatoid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `img`
--
ALTER TABLE `img`
  MODIFY `imgid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `produtoid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `subcategoriaid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `userid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `img`
--
ALTER TABLE `img`
  ADD CONSTRAINT `fk_img_produtos` FOREIGN KEY (`idproduto`) REFERENCES `produtos` (`produtoid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produtos_categorias` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`categoriaid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_produtos_subcategorias` FOREIGN KEY (`idsubcategoria`) REFERENCES `subcategorias` (`subcategoriaid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `fk_subcategorias_categorias` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`categoriaid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
