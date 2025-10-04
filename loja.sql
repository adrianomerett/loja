-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 04/10/2025 às 17:44
-- Versão do servidor: 8.4.0
-- Versão do PHP: 8.3.6

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
(43, 20, '0uyeny.webp'),
(44, 21, '147noa.webp'),
(45, 21, '18srep.webp'),
(46, 21, 'g4ky5f.webp'),
(47, 21, 'd7iube.webp'),
(48, 22, 'd6n7e6.webp'),
(49, 22, 'c98rp1.webp'),
(50, 22, 'ka4wdq.webp'),
(51, 22, 'q1f35f.webp'),
(52, 23, '4y8emt.webp'),
(53, 23, '2dw3k2.webp'),
(54, 23, 'pqkhan.webp'),
(55, 23, 'z1wg8b.webp');

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
(20, 'iPhone 16e Apple (128GB) Preto, Tela de 6,1\", 5G e Câmera de 48 MP', '<p>Descrição de iphne 16	</p>', '<p>Informações de Iphone 16</p>', 15, 3, 16, 4500.00, 7812.45, 8901.24, 'S', 'A'),
(21, 'Monitor Gamer Curvo Samsung Odyssey Ark 2ª Geração 55\", com Mini-LED, UHD, 165 Hz, 1ms(GtG), Preto', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Tipo da Tela: LCD</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Resolução Máxima: 3,840 x 2,160</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Tamanho da Tela: 55\"</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Brilho: 600 cd</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Contraste: 1,000,000:1 (Static)</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Ângulo de Visão: 178°(H)/178°(V)</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Tempo de Resposta: 1ms(MPRT)</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Formato: Curvo</span></p>', '<p><strong style=\"color: rgb(0, 0, 0); background-color: rgba(0, 0, 0, 0);\">Tela curva</strong></p><p><span style=\"color: rgb(77, 77, 77); background-color: rgba(0, 0, 0, 0);\">1000R</span></p><p><strong style=\"color: rgb(0, 0, 0); background-color: rgba(0, 0, 0, 0);\">Proporção de Tela</strong></p><p><span style=\"color: rgb(77, 77, 77); background-color: rgba(0, 0, 0, 0);\">16:9</span></p><p><strong style=\"color: rgb(0, 0, 0); background-color: rgba(0, 0, 0, 0);\">Brilho (Típico)</strong></p><p><span style=\"color: rgb(77, 77, 77); background-color: rgba(0, 0, 0, 0);\">600 cd/㎡</span></p><p><strong style=\"color: rgb(0, 0, 0); background-color: rgba(0, 0, 0, 0);\">Contraste Estático</strong></p><p><span style=\"color: rgb(77, 77, 77); background-color: rgba(0, 0, 0, 0);\">1,000,000:1 (Static)</span></p><p><strong style=\"color: rgb(0, 0, 0); background-color: rgba(0, 0, 0, 0);\">Resolução</strong></p><p><span style=\"color: rgb(77, 77, 77); background-color: rgba(0, 0, 0, 0);\">4K (3,840 x 2,160)</span></p><p><strong style=\"color: rgb(0, 0, 0); background-color: rgba(0, 0, 0, 0);\">Tempo de Resposta</strong></p><p><span style=\"color: rgb(77, 77, 77); background-color: rgba(0, 0, 0, 0);\">1ms(GTG)</span></p><p><strong style=\"color: rgb(0, 0, 0); background-color: rgba(0, 0, 0, 0);\">Ângulo de Visão (Horizontal / Vertical)</strong></p><p><span style=\"color: rgb(77, 77, 77); background-color: rgba(0, 0, 0, 0);\">178°(H)/178°(V)</span></p><p><strong style=\"color: rgb(0, 0, 0); background-color: rgba(0, 0, 0, 0);\">Taxa de Atualização</strong></p><p><span style=\"color: rgb(77, 77, 77); background-color: rgba(0, 0, 0, 0);\">Max 165Hz</span></p><p><br></p>', 14, 4, 10, 1500.00, 2395.11, 2545.74, 'S', 'A'),
(22, 'Impressora Térmica Pantum PT-D160nw 127V ', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">A impressora térmica Pantum PT-D160 foi projetada para proporcionar uma impressão rápida e precisa em papel térmico, com uma impressionante velocidade de até 152 mm/s. Com uma resolução máxima de 203 dpi e largura de impressão de até 108 mm, ela garante resultados nítidos e detalhados. Equipado com sensores inteligentes, como detecção de falta de papel, monitoramento da posição da cabeça de impressão e outros recursos, o dispositivo assegura uma operação contínua e sem falhas. Sua interface USB permite uma conexão simples e eficiente com diversos dispositivos.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Características principais:</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Método de Impressão: Impressão térmica direta</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Velocidade Máxima de Impressão: Até 152 mm/s</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Resolução Máxima de Impressão: 203 dpi, para impressões nítidas</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Largura Máxima de Impressão: 108 mm</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Comprimento Máximo de Impressão: 1778 mm</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Interface: USB, para fácil conexão com diversos dispositivos</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Sensores: Detecção de falta de papel, sensor de corte de papel, monitoramento da posição da cabeça de impressão e sensor de início de impressão</span></p>', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">EAN: 6936358031141</span></p><p><br></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Itens inclusos</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">01 Impressora Térmica Pantum PT-D160nw 127V</span></p>', 14, 5, 2, 615.00, 835.00, 980.45, 'S', 'A'),
(23, 'Tablet Lenovo Tab M9 Prata com 9\", Wi-Fi, Android 12, Processador Octa-Core e 64GB', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Processador MediaTek Helio G80 Octa-Core 4GB 64GB Wi-Fi  Android™ 12, Tela de  9 WVA (1920x1200), Centificação TÜV Low Blue Light e Superfície Anti-Impressão Digital, três anos de atualização do sistema operacional</span></p>', '<p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Sistema Operacional</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Android 12</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Tela</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Tipo da Tela: LCD</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Tamanho da Tela: 9</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Resolução da Tela: HD (1340x800)</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Conectividade</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Wi-Fi</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Bluetooth</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Capacidade</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">64GB LPDDR4x*</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">*</span><em style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\"> Parte da memória interna já é utilizada pelo sistema operacional e aplicativos pré-instalados</em></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Processador</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">MediaTek Helio G80</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Memória RAM</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">4GB</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Câmera</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Câmera Traseira: 8MP</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Câmera Frontal: 2MP</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Portas de Entrada</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">1 USB-C (Tranferência de dados e alimentação)</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Duração da Bateria</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">5100mAh</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Outros Recursos</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Idiomas do Menu: Português</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Número do PPB</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Processo MCT/Data: 01245.014804/2021-19 de 27/08/2021</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Portaria MCT/MDIC/MF: 5771, de 08/04/2022 DOU 13/04/2022</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Cor</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Prata</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">EAN</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">7908317361384</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Especificações Técnicas</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Modelo: ZAC30198BR</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Garantia: 12 meses</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Certificado de Homologação da ANATEL: 04843-23-06667</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Dimensões e Peso</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Dimensões do produto sem embalagem (AxLxP): 244,5x154,3x7,0 mm</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Dimensões do produto com embalagem (AxLxP): 280,0x187,0x225 mm</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Peso do produto sem embalagem: 0,47 Kg</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Peso do produto com embalagem: 4,80 Kg</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Itens Inclusos</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">01 Tablet Lenovo TB310FU</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">01 kit de Manuais</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">01 Cabo de Sincronização</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">01 Carregador de Parede</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">01 Ferramente de Remoção</span></p><p><br></p>', 14, 6, 2, 1245.57, 1645.77, 1984.57, 'S', 'A');

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
(3, 15, 'Iphones'),
(4, 14, 'Monitores'),
(5, 14, 'Impressoras'),
(6, 14, 'Tablets');

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
  MODIFY `imgid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `produtoid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `subcategoriaid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
