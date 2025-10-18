-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 18/10/2025 às 02:53
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
(15, 'Smartphones'),
(25, 'Periféficos'),
(31, 'Computadores'),
(33, 'Tablets');

-- --------------------------------------------------------

--
-- Estrutura para tabela `config`
--

CREATE TABLE `config` (
  `id` int NOT NULL,
  `nameloja` varchar(60) DEFAULT NULL,
  `slogan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fone` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `email` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cidade` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
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

INSERT INTO `config` (`id`, `nameloja`, `slogan`, `fone`, `celular`, `email`, `cidade`, `bairro`, `rua`, `numero`, `instagran`, `facebook`, `x`, `version`) VALUES
(1, 'Tecno Mix', 'Onde a inovação nunca desliga', '(00) 0000-0000', '(99) 99999-9999', 'contato@tecnomix.com.br', 'Rio Branco', 'Centro', 'Alameda Prudente', '487', '@tecnomix', '@tecnomix', '@tecnomix', '1.0.0');

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

--
-- Despejando dados para a tabela `contatos`
--

INSERT INTO `contatos` (`contatoid`, `nome`, `email`, `telefone`, `assunto`, `msg`, `status`) VALUES
(1, 'Paulo Brandão', 'paulo@gmail.com', '6832263856', 'Produtos', 'Isso é uma mensagem  de teste', 'P'),
(2, 'Jona Borges', 'joana@gmail.com', '6899554567', 'Quantidade em estoque', 'Isso é uma mensagem de teste', 'V');

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
(40, 20, 'ovk1f0.webp'),
(44, 21, '147noa.webp'),
(45, 21, '18srep.webp'),
(46, 21, 'g4ky5f.webp'),
(47, 21, 'd7iube.webp'),
(67, 19, 'rhhefi.webp'),
(68, 19, '62udth.webp'),
(69, 19, 'u4r8v9.webp'),
(70, 20, 'f4gyu5.webp'),
(71, 20, '3nkrpx.webp'),
(72, 24, 'lelgq0.webp'),
(73, 24, 'z46f60.webp'),
(74, 24, 'nb2e1g.webp'),
(75, 24, '59c21u.webp'),
(76, 25, '3175z7.webp'),
(77, 25, '5xiezr.webp'),
(78, 25, 'arc5vf.webp'),
(79, 25, 'lrpfrh.webp'),
(83, 26, '0pqctb.webp'),
(84, 26, 'xxg0xd.jpg'),
(85, 26, '19feh9.jpg'),
(86, 26, 'yeudv3.jpg');

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
(18, 'Notebbok Dell 14 Polegadas', '<p>DECRIÇÃO</p>', '<p>iNFO TEC</p>', 31, 15, 2, 1500.00, 1789.23, 1850.32, 'N', 'A'),
(19, 'TV 32 polegadas Samsung  Plasma', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(102, 102, 102);\">A </span><strong style=\"background-color: rgb(255, 255, 255); color: rgb(102, 102, 102);\">Smart TV 32” Philco PTV32G23AGSSBLH Android TV LED Wi-Fi 2 HDMI 2 USB.</strong></p><p><br></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(102, 102, 102);\"> vai te surpreender! Ela é equipada com um Processador Quad Core que garante mais velocidade para executar todos os seus aplicativos </span></p>', '<p>TVs 32 poelgadas com plasma</p>', 14, 4, 2, 2154.61, 2300.00, 2500.00, 'S', 'A'),
(20, 'iPhone 16e Apple (128GB) Preto, Tela de 6,1', '<p>Descrição de iphne 16</p>', '<p>Informações de Iphone 16</p>', 15, 3, 0, 4500.00, 7812.45, 8901.24, 'N', 'A'),
(21, 'Monitor Gamer Curvo Samsung Odyssey Ark 2ª Geração 55', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Tipo da Tela: LCD</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Resolução Máxima: 3,840 x 2,160</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Tamanho da Tela: 55\"</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Brilho: 600 cd</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Contraste: 1,000,000:1 (Static)</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Ângulo de Visão: 178°(H)/178°(V)</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Tempo de Resposta: 1ms(MPRT)</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Formato: Curvo</span></p>', '<p><strong style=\"color: rgb(0, 0, 0); background-color: rgba(0, 0, 0, 0);\">Tela curva</strong></p><p><span style=\"color: rgb(77, 77, 77); background-color: rgba(0, 0, 0, 0);\">1000R</span></p><p><strong style=\"color: rgb(0, 0, 0); background-color: rgba(0, 0, 0, 0);\">Proporção de Tela</strong></p><p><span style=\"color: rgb(77, 77, 77); background-color: rgba(0, 0, 0, 0);\">16:9</span></p><p><strong style=\"color: rgb(0, 0, 0); background-color: rgba(0, 0, 0, 0);\">Brilho (Típico)</strong></p><p><span style=\"color: rgb(77, 77, 77); background-color: rgba(0, 0, 0, 0);\">600 cd/㎡</span></p><p><strong style=\"color: rgb(0, 0, 0); background-color: rgba(0, 0, 0, 0);\">Contraste Estático</strong></p><p><span style=\"color: rgb(77, 77, 77); background-color: rgba(0, 0, 0, 0);\">1,000,000:1 (Static)</span></p><p><strong style=\"color: rgb(0, 0, 0); background-color: rgba(0, 0, 0, 0);\">Resolução</strong></p><p><span style=\"color: rgb(77, 77, 77); background-color: rgba(0, 0, 0, 0);\">4K (3,840 x 2,160)</span></p><p><strong style=\"color: rgb(0, 0, 0); background-color: rgba(0, 0, 0, 0);\">Tempo de Resposta</strong></p><p><span style=\"color: rgb(77, 77, 77); background-color: rgba(0, 0, 0, 0);\">1ms(GTG)</span></p><p><strong style=\"color: rgb(0, 0, 0); background-color: rgba(0, 0, 0, 0);\">Ângulo de Visão (Horizontal / Vertical)</strong></p><p><span style=\"color: rgb(77, 77, 77); background-color: rgba(0, 0, 0, 0);\">178°(H)/178°(V)</span></p><p><strong style=\"color: rgb(0, 0, 0); background-color: rgba(0, 0, 0, 0);\">Taxa de Atualização</strong></p><p><span style=\"color: rgb(77, 77, 77); background-color: rgba(0, 0, 0, 0);\">Max 165Hz</span></p>', 14, 4, 10, 1500.00, 2500.00, 2752.50, 'S', 'A'),
(24, 'Teclado sem fio Logitech MX Keys S Iluminação Inteligente, Bluetooth/Receptor USB e Bateria Recarregável - Grafite', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Experimente um novo nível de desempenho com o MX Keys S. O MX Keys S é um teclado de alto desempenho, projetado para digitação confortável, rápida e fluida. Agora seu teclado conta com iluminação ainda mais inteligente, as teclas de luz de fundo acendem quando suas mãos se aproximam do teclado e automaticamente se iluminam ou se apagam para se adequar ao seu ambiente. Com o software Logi Option+ você pode configurar a duração e intensidade das luzes do seu MX Keys S. Uma tecla, é tudo o que você precisa para automatizar suas tarefas repetitivas com o Smart Action, função disponível no software Logi Option+, idealizada para facilitar sua vida e aumentar sua produtividade. O design discreto e o ângulo ideal para uma posição mais natural do pulso proporcionam precisão sem esforço e mais horas de conforto na digitação. O MX Keys S traz carregamento rápido via USB-C que permite uma autonomia de bateria de até 10 dias com uma carga completa e até 5 meses com a luz de fundo desativada. Você pode carregá-lo enquanto trabalha, sem problemas. Alterne facilmente entre até 3 dispositivos com apenas um botão. Além disso, o MX Keys S traz dupla conectividade: Bluetooth e Receptor USB Logi Bolt (incluso), escolha a maneira de conexão que mais combina com seu estilo e comece o trabalho.</span></p>', '<p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Características</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Tipo: Teclado Sem fio</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Wireless</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">USB</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Multimídia</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Quantidade de teclas: 108</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Padrão: Layout Americano</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Digite em um teclado desenvolvido para conforto, estabilidade e precisão</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Iluminação inteligente com detecção de proximidade das mãos</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Digite em vários computadores através da tecnologia Logitech Flow</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Pareie com até três dispositivos</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">USB-C recarregável - a carga completa dura até 10 dias</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Receptor USB Logi Bolt</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Bluetooth Low Energy</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Equipamentos compatíveis</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Compatibilidade Bluetooth</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Windows 10 ou superior</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">macOS 10.15 ou superior</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Linux</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Chrome OS</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">iPadOS 14 ou superior</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Android 8.0 ou superior</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Compatibilidade Receptor USB Logi Bolt</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Requer porta USB disponível</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Windows 10 ou superior</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">macOS 10.15 ou superior</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Linux</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Chrome OS</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Especificações Técnicas</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Modelo: 920011563</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Cor: Grafite</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Garantia: 12 meses</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Dimensões e Peso</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Dimensões do produto sem embalagem (AxLxP): 131,6x430,2x20,5 mm</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Dimensões do produto com embalagem (AxLxP): 39,5x450,5x147,5 mm</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Peso do produto sem embalagem: 0,81 Kg</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Peso do produto com embalagem: 1,12 Kg</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Itens Inclusos</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">01 Teclado MX Keys S</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">01 Receptor USB Logi Bolt</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">01 Cabo de carregamento USB-C (USB-A para USB-C)</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">01 Documentação do usuário</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">01 Garantia de 1 ano do fabricante</span></p>', 25, 14, 1, 150.00, 199.00, 225.32, 'S', 'A'),
(25, 'Fone de Ouvido JBL Tune 720BT Bluetooth 5.3 Headphone Conexões Multipontos Até 76 Horas de Bateria - Preto', '<p>Você procura por um fone de ouvido de alta qualidade, que ofereça uma experiência sonora incrível e uma bateria de longa duração? O Fone de Ouvido JBL Tune 720BT é exatamente o produto que você está procurando!</p><p>Com tecnologia Bluetooth 5.3, o headphone JBL Tune 720BT proporciona uma conexão sem fio estável e de alta qualidade, permitindo que você desfrute de suas músicas favoritas sem se preocupar com fios emaranhados. Além disso, ele conta com a função de conexões multipontos, o que significa que você pode conectá-lo a dois dispositivos simultaneamente, como seu smartphone e seu tablet, por exemplo.</p><p>A qualidade de som é garantida pelo famoso som JBL Pure Bass, que oferece graves profundos e potentes, realçando cada nota e batida de suas músicas preferidas. E se você gosta de personalizar sua experiência auditiva, o JBL Tune 720BT permite que você ajuste o equalizador de acordo com suas preferências, através do aplicativo JBL Headphones.</p><p>A bateria é outro destaque desse fone de ouvido. Com uma autonomia de até 76 horas de reprodução contínua, você pode usar o JBL Tune 720BT por vários dias antes de precisar recarregá-lo. E quando a bateria estiver acabando, você pode contar com a função de carregamento rápido, que permite obter horas de reprodução com apenas alguns minutos de carga.</p><p>Além de todas essas características incríveis, o JBL Tune 720BT também oferece chamadas viva-voz com Voice Aware, para que você possa atender suas chamadas sem precisar tirar o fone de ouvido. Ele é leve, confortável e possui um design dobrável, facilitando o transporte e o armazenamento.</p>', '<p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Especificações Técnicas:</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- Tipo: Headphone</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- Compatibilidade: A maioria dos dispositivos com Bluetooth</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- Sensibilidade: 101 dB SPL a 1 kHz</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- Som JBL Pure Bass</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- Tecnologia sem fio Bluetooth 5.3</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- Personalize sua experiência auditiva</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- Até 76 horas de bateria e carregamento rápido</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- Chamadas viva-voz com Voice Aware</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- Conexões multipontos</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- Leve, confortável e com design dobrável</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- Cabo de áudio destacável</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Dimensões e Peso:</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- Dimensões do produto sem embalagem (AxLxP): 220x184x75 mm</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- Dimensões do produto com embalagem (AxLxP): 251x245x220 mm</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- Peso do produto sem embalagem: 0,22 Kg</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- Peso do produto com embalagem: 0,45 Kg</span></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Itens Inclusos:</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- 01 Fones de Ouvido JBL Tune 720BT</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- 01 Cabo para Recarga USB-C</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- 01 Cabo de Áudio Removível</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- 01 Garantia/advertência</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">- 01 Guia de Início Rápido</span></p>', 25, 13, 5, 250.00, 365.00, 390.00, 'S', 'A'),
(26, 'Apple 2025 iPad (Wi-Fi, 128 GB) - Prateado (A16)', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(15, 17, 17);\">ECRÃ LIQUID RETINA DE 11 POLEGADAS — O espetacular ecrã Liquid Retina é ideal para ver filmes ou desenhar a sua próxima obra‑prima. O True Tone ajusta o ecrã à temperatura da cor da divisão para conseguir ver confortavelmente com qualquer luz ambiente.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(15, 17, 17);\">DESEMPENHO E ARMAZENAMENTO — O processador A16 oferece um desempenho ultrarrápido para as suas atividades preferidas. E a bateria para todo o dia torna o iPad perfeito para jogos envolventes ou edição de fotografias e vídeos. As opções de armazenamento começam em 128 GB e vão até 512 GB.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(15, 17, 17);\">APPLE PENCIL E MAGIC KEYBOARD FOLIO — Com o Apple Pencil (USB‑C), transforme o iPad numa imersiva tela em branco e no melhor bloco de notas do mundo. A Magic Keyboard Folio combina duas peças de forma versátil, um teclado amovível e uma proteção traseira, ambas com ligação magnética ao iPad. O Apple Pencil (1.ª geração) também é compatível com o iPad.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(15, 17, 17);\">CÂMARAS AVANÇADAS—O iPad Air inclui uma câmara frontal 12MP Center Stage, perfeita para selfies e videochamadas. A câmara traseira Grande angular de 12 MP é ideal para digitalizar documentos, tirar fotografias e gravar vídeos 4K.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(15, 17, 17);\">LIGAÇÕES WI‑FI ULTRARRÁPIDAS — O Wi‑Fi 6 permite aceder rapidamente a ficheiros, fazer uploads ou downloads e ver em streaming as suas séries preferidas.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(15, 17, 17);\">LIGAÇÕES WI‑FI ULTRARRÁPIDAS — O Wi‑Fi 6 permite aceder rapidamente a ficheiros, fazer uploads ou downloads e ver em streaming as suas séries preferidas.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(15, 17, 17);\">DESBLOQUEIE E PAGUE COM TOUCH ID — O Touch ID está integrado no botão superior. Pode usar a sua impressão digital para desbloquear o iPad, iniciar sessão em apps e fazer pagamentos seguros com o Apple Pay.</span></p>', '<table><tbody><tr><td data-row=\"1\"><strong style=\"color: rgb(15, 17, 17); background-color: rgb(255, 255, 255);\">Tela</strong></td><td data-row=\"1\"><span style=\"color: rgb(15, 17, 17); background-color: rgb(255, 255, 255);\">11 Polegadas; Liquid Retina; Tela Multi-Touch retroiluminada por LED com tecnologia IPS; Resolução de 2360 x 1640 pixels a 264 ppp; True Tone; 500 nits de brilho; Revestimento resistente a impressões digitais e oleosidade</span></td></tr><tr><td data-row=\"2\"><strong style=\"color: rgb(15, 17, 17); background-color: rgb(255, 255, 255);\">Capacidade</strong></td><td data-row=\"2\"><span style=\"color: rgb(15, 17, 17); background-color: rgb(255, 255, 255);\">128GB, 256GB, 512GB</span></td></tr><tr><td data-row=\"3\"><strong style=\"color: rgb(15, 17, 17); background-color: rgb(255, 255, 255);\">Chip</strong></td><td data-row=\"3\"><span style=\"color: rgb(15, 17, 17); background-color: rgb(255, 255, 255);\">Chip A16; CPU de 5 núcleos; GPU de 4 núcleos; Neural Engine de 16 núcleos</span></td></tr><tr><td data-row=\"4\"><strong style=\"color: rgb(15, 17, 17); background-color: rgb(255, 255, 255);\">Câmera e Video</strong></td><td data-row=\"4\"><span style=\"color: rgb(15, 17, 17); background-color: rgb(255, 255, 255);\">Câmera grande-angular de 12 MP, abertura ƒ/1.8; Zoom digital até 5x; Lente de cinco elementos; Foco automático com Focus Pixels Panorama (até 63 MP); HDR Inteligente 4 Fotos com localização geográfica; Estabilização automática de imagem; Modo contínuo; Formatos de imagem capturados: HEIF e JPEG</span></td></tr><tr><td data-row=\"5\"><strong style=\"color: rgb(15, 17, 17); background-color: rgb(255, 255, 255);\">Câmera Frontal</strong></td><td data-row=\"5\"><span style=\"color: rgb(15, 17, 17); background-color: rgb(255, 255, 255);\">Câmera 12MP Center Stage horizontal</span></td></tr><tr><td data-row=\"6\"><strong style=\"color: rgb(15, 17, 17); background-color: rgb(255, 255, 255);\">Tempo de bateria</strong></td><td data-row=\"6\"><span style=\"color: rgb(15, 17, 17); background-color: rgb(255, 255, 255);\">Todos os modelos; Bateria interna recarregável de polímero de lítio com capacidade de 28,93 watts/hora; Até 10 horas para navegar na internet via Wi‑Fi ou assistir a vídeos; Recarga via USB‑C do computador ou adaptador de energia; Modelos Wi-Fi + Cellular; Até 9 horas para navegar na internet usando dados de rede celular</span></td></tr></tbody></table>', 33, 16, 2, 2504.86, 3421.32, 3845.25, 'S', 'A');

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
(3, 15, 'Iphones'),
(4, 14, 'Monitores'),
(13, 25, 'Fone de Ouvido'),
(14, 25, 'Teclados'),
(15, 31, 'Notebooks'),
(16, 33, 'Apple');

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
(1, 'Adriano', 'Merett Martins', 'adrianomerett@gmail.com', '$2y$12$pf9XNKq4BsfggH8atVUzdea/v6digHdg.6PpSK/ASBE8tJgbmTDM2', 'A', 'A', '2025-09-16 22:27:59'),
(13, 'Manuela ', 'Silva Merett', 'manuelsilva@gmail.com', '$2y$10$DwgXwk2aP44V4UQE5VGLmuWkom5K1Cc5PzE49HclA7oT0pYa9S9Nq', 'M', 'I', '2025-10-07 18:49:44');

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
  MODIFY `categoriaid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `config`
--
ALTER TABLE `config`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `contatos`
--
ALTER TABLE `contatos`
  MODIFY `contatoid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `img`
--
ALTER TABLE `img`
  MODIFY `imgid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `produtoid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `subcategoriaid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `userid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
