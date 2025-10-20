-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 20/10/2025 às 00:16
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
(34, 'Informática'),
(35, 'Eletrodomésticos'),
(36, 'Smartphones'),
(38, 'Games');

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
(87, 27, 'fv07ho.jpg'),
(88, 27, '38aysd.jpg'),
(89, 27, 'fh6vv9.jpg'),
(90, 27, 'pyfffi.jpg'),
(91, 28, '1y1os4.webp'),
(92, 28, 'ueempy.webp'),
(93, 28, 'dabywf.webp'),
(94, 28, 'cv0cyu.webp'),
(95, 29, '9ql7o1.webp'),
(96, 29, 'mfx9s3.webp'),
(97, 29, 'f0j21l.webp'),
(98, 29, '3epaxz.webp'),
(99, 30, 'ivrpdq.webp'),
(100, 30, '543l2v.webp'),
(101, 30, 'nsol8v.webp'),
(102, 30, 'q102ol.webp');

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
(27, 'Apple iPhone 14 (128 GB) – Estelar', '<p><span style=\"color: rgb(15, 17, 17); background-color: rgb(255, 255, 255);\">Tela Super Retina XDR de 6,1 polegadas</span></p><p><span style=\"color: rgb(15, 17, 17); background-color: rgb(255, 255, 255);\">Sistema de câmera avançado para fotos melhores em qualquer luz</span></p><p><span style=\"color: rgb(15, 17, 17); background-color: rgb(255, 255, 255);\">Modo Cinema, agora em 4K Dolby Vision até 30 qps</span></p><p><span style=\"color: rgb(15, 17, 17); background-color: rgb(255, 255, 255);\">Modo Ação para vídeos em movimento com mais estabilidade</span></p><p><span style=\"color: rgb(15, 17, 17); background-color: rgb(255, 255, 255);\">Tecnologia de segurança — Detecção de Acidente, que liga para a emergência se você não puder</span></p><p><span style=\"color: rgb(15, 17, 17); background-color: rgb(255, 255, 255);\">Este iPhone é compatível com eSIM. Entre em contato com a sua operadora para saber como ativar.</span></p>', '<table><tbody><tr><td data-row=\"1\"><strong style=\"background-color: rgb(255, 255, 255); color: rgb(15, 17, 17);\">Tela</strong></td><td data-row=\"1\"><span style=\"background-color: rgb(255, 255, 255); color: rgb(15, 17, 17);\">Tela Super Retina XDR de 6,1 polegadas</span></td></tr><tr><td data-row=\"2\"><strong style=\"background-color: rgb(255, 255, 255); color: rgb(15, 17, 17);\">Capacidade</strong></td><td data-row=\"2\"><span style=\"background-color: rgb(255, 255, 255); color: rgb(15, 17, 17);\">64GB, 128GB, 256GB</span></td></tr><tr><td data-row=\"3\"><strong style=\"background-color: rgb(255, 255, 255); color: rgb(15, 17, 17);\">Resistente a respingos, água e poeira</strong></td><td data-row=\"3\"><span style=\"background-color: rgb(255, 255, 255); color: rgb(15, 17, 17);\">Ceramic Shield frontal, vidro traseiro e design de alumínio, resistente à água e poeira (classificação IP68 - profundidade máxima de 6 metros até 30 minutos)</span></td></tr><tr><td data-row=\"4\"><strong style=\"background-color: rgb(255, 255, 255); color: rgb(15, 17, 17);\">Câmera &amp; Video</strong></td><td data-row=\"4\"><span style=\"background-color: rgb(255, 255, 255); color: rgb(15, 17, 17);\">Sistema de câmera dupla: 12MP principal, 12MP ultrawide com modo retrato, controle de profundidade, iluminação de retrato, Smart HDR 4 e vídeo 4K Dolby Vision HDR até 60 fps</span></td></tr><tr><td data-row=\"5\"><strong style=\"background-color: rgb(255, 255, 255); color: rgb(15, 17, 17);\">Câmera Frontal</strong></td><td data-row=\"5\"><span style=\"background-color: rgb(255, 255, 255); color: rgb(15, 17, 17);\">Câmera frontal TrueDepth de 12MP com modo Retrato, Controle de Profundidade, Iluminação Retrato e Smart HDR 4</span></td></tr><tr><td data-row=\"6\"><strong style=\"background-color: rgb(255, 255, 255); color: rgb(15, 17, 17);\">Energia e bateria</strong></td><td data-row=\"6\"><span style=\"background-color: rgb(255, 255, 255); color: rgb(15, 17, 17);\">Reprodução de vídeo: até 20 horas Reprodução de vídeo (streaming): até 16 horas Reprodução de áudio: até 80 horas Adaptador de 20 W ou superior (vendido separadamente) Capacidade de carregamento rápido: até 50% de carga em cerca de 30 minutos com adaptador de 20 W ou superior (disponível separadamente)</span></td></tr></tbody></table>', 36, 20, 2, 3503.52, 3990.02, 4403.51, 'S', 'A'),
(28, 'Geladeira Electrolux Frost Free 400L AutoSense Duplex Black Inox Look (TF44B)', '<p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Geladeira Electrolux Frost Free 400L AutoSense Duplex Black Inox Look (TF44B)</span></p><p><br></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">A Geladeira Electrolux Frost Free 400L AutoSense Black Inox Look (TF44B) possui Tecnologia AutoSense, que controla a temperatura automaticamente e prolonga a vida útil dos alimentos em até 30%. Para prevenir o desperdício, a Gaveta HortiFruti ajuda você a organizar e visualizar suas frutas e legumes dentro da geladeira, mantendo seus alimentos frescos por mais tempo.</span></p><p><br></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">O novo design é robusto e garante que esse refrigerador seja não apenas durável, mas também prático, adaptando-se perfeitamente à sua rotina e às suas necessidades de armazenamento. O puxador é feito com material parcialmente reciclado, que ajuda a reduzir o desperdício por meio da circularidade.</span></p><p><br></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Para aqueles momentos em que você precisa de resfriamento rápido, o Turbo Freezer é a solução ideal, perfeito para festas ou para quando você chega em casa com as compras e precisa refrigerar algo rapidamente. A conveniência continua com a Bandeja de Ovos, que oferece espaço organizado para até 12 ovos, enquanto a Forma de Gelo mantém suas bebidas sempre geladas, com capacidade para até 30 cubos de gelo. A iluminação de LED interna não só proporciona uma visão clara do interior da geladeira, como também economiza energia.</span></p><p><br></p>', '<p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Este Produto Inclui:</span></p><p><br></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Água na Porta: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Wi-Fi: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Alarme de Porta Aberta: Sim</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Cesta Porta-Ovos: Sim</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Compartimento Congelamento Rápido: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Compartimento Extra Frio: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Degelo Automático: Sim</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Gelo na Porta: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Home Bar: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Pés Niveladores: Sim</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Porta Latas: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Porta Reversível: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Prateleiras de Vidro Temperado: Sim</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Prateleiras na Porta: Sim</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Prateleiras Removíveis: Sim</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Separador de Garrafas: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Prateleiras no Freezer: Sim</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Puxadores: Sim (Embutido)</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Trava Painel de Controle: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Tipo de Compressor: Fixed Speed</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Iluminação no Compartimento Refrigerador: Sim</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Iluminação no Compartimento Freezer: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Compartimento FlexiSpace: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Conectividade: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Filtro Desodorizador: Não</span></p><p><br></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Específicações Técnicas:</span></p><p><br></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Modelo: TF44B</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Frequência: 60 Hz</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Instalação gratuita: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Acabamento lateral: Preto</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Capacidade bruta do refrigerador: 291 L</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Capacidade líquida do freezer: 114 L</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Capacidade líquida do refrigerador: 286 L</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Capacidade bruta do freezer: 128 L</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Capacidade líquida total: 400 L</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Acabamento frontal: Black Inox Look</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Cor: Black Inox Look</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Quantidade de portas: 2</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Painel digital: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Conteúdo da embalagem: Refrigerador, Porta Ovos, Forma de Gelo, Guia Rápido e Manual de Instruções</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Gás refrigerante: R600A</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Quantidade de prateleiras e gavetas do freezer: Gabinete: 1 Prateleira | Porta: 1 Prateleira</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Quantidade de prateleiras e gavetas do refrigerador: Gabinete: 3 Prateleiras e 1 Gaveta | Porta: 3 Prateleiras</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Prateleiras retráteis: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Prateleiras reversíveis: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Prateleiras expansíveis (Fast Adapt): Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Nível de ruído: 46.3 dB</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Tipo de degelo: Frost Free</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Dispenser de gelo na porta: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Função turbo freezer: Sim</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Função turbo refrigerador: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Selo Procel: Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Tipo de compressor: Fixed Speed</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Iluminação interna (freezer): Não</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">AutoSense: Sim</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Consumo: 59,7 kWh/mês</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Classificação energética: A</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">EAN: 7909569478523 (127V), 7909569478530 (220V)</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Voltagem: 127V / 220V (Não e Bivolt)</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Garantia do produto: 12 meses</span></p><p><br></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Dimensões (Produto Embalado):</span></p><p><br></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Altura: 187,5 cm</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Largura: 62,5 cm</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Profundidade: 76 cm</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Peso: 58 kg</span></p><p><br></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Dimensões (Sem Embalagem):</span></p><p><br></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Altura: 185 cm</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Largura: 60,4 cm</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Profundidade: 71,7 cm</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Peso: 56 Kg</span></p>', 35, 17, 2, 2245.63, 3124.54, 3547.85, 'S', 'A'),
(29, 'Ventilador Britânia 2 em 1 Tecnologia Maxx Force 150W BVT401', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Com o Ventilador Britânia 2 em 1 Tecnologia Maxx Force 150W BVT401 os dias de verão não serão mais os mesmos.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">2 em 1, pode ser usado na mesa ou na parede. A grande flexibilidade permite 3 opções de inclinação vertical e botão que aciona a oscilação horizontal automática.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Conta também com 3 velocidades e tecnologia Maxx Force de hélice de 6 pás com 40cm, promovendo altíssimo desempenho e poder de ventilação. Afinal, possui 150W de potência.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">O Ventilador Britânia BVT401 é super seguro, pois seu motor tem sistema que interrompe o funcionamento do produto em caso de superaquecimento, além de trava nas grades.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Econômico e prático, esse Ventilador conta com classificação energética “A”, mas sem abrir mão da incrível vazão de ar e capacidade de ventilação.</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">Ventilador Britânia 2 em 1 Tecnologia Maxx Force 150W BVT401, versatilidade, praticidade e muito mais conforto no seu dia a dia.</span></p>', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\"> 3 velocidades</span></p><p><br></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">• Hélice de 6 pás</span></p><p><br></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">• Potência de 150W</span></p><p><br></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">• Grade que obedece às normas de segurança (contato com partes móveis)</span></p><p><br></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">• Oscilação horizontal automática com novo sistema de acionamento (botão integrado à carcaça)</span></p><p><br></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">• Sistema de articulação para ajuste da inclinação vertical</span></p><p><br></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">• Porta-fio</span></p><p><br></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">• Novo sistema de travamento entre grade frontal e traseira</span></p><p><br></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">• Alça na grade traseira para transportar o aparelho</span></p><p><br></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(48, 48, 48);\">• Motor com fusível térmico de segurança.</span></p>', 35, 19, 10, 85.63, 132.25, 153.21, 'S', 'A'),
(30, 'Forno de Embutir a Gás Brastemp 78 Litros Preto com Grill e Timer Touch - BOA84AE', '<p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Você está procurando um forno a gás de embutir que ofereça praticidade e eficiência na sua cozinha? Então o Forno de Embutir a Gás Brastemp é a opção perfeita para você! Com diversas funcionalidades avançadas, como acendimento Superautomático, Timer, Grill e Painel Automático, esse produto vai facilitar o preparo das suas receitas.</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Com capacidade de 78 litros líquidos e 84 litros brutos, esse forno conta com duas prateleiras que podem ser ajustadas em até 5 níveis diferentes, permitindo que você asse dois pratos simultaneamente. Além disso, o Touch Timer, além de moderno, avisa quando o assado está pronto, garantindo um cozimento perfeito. E com o Grill, você pode finalizar os pratos com maior precisão.</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">O Forno de Embutir a Gás Brastemp possui acabamento interno em Inox, o que garante durabilidade e facilidade na hora da limpeza. Além disso, o vidro na porta permite que você visualize o interior do forno, acompanhando o preparo dos seus pratos sem precisar abrir a porta.</span></p>', '<p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Tipo: Embutir</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Funcionamento: Gás</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Tipo de Acendimento: Superautomático</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Capacidade: 78 Litros (Líquida) / 84 Litros (Bruta)</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Temperatura Máxima: 280ºC</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Abertura da Porta: Frontal</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Vidro na Porta</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Grill</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Touch Timer</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Painel: Automático</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Prateleiras Removíveis</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Lâmpada Inclusa: Sim</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Tecnologia Cleartec</span></p><p><strong style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Especificações Técnicas:</strong></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Modelo: BOA84AERNA</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Material Interno: Inox</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Potência: 1250W</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Cor: Preto</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Selo Procel (Eficiência Energética): A</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Voltagem: 220V</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">EAN: 7891129243828</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Garantia: 12 meses</span></p><p><strong style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Dimensões e Peso:</strong></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Dimensões do produto sem embalagem (AxLxP): 620x600x580 mm</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Dimensões do produto com embalagem (AxLxP): 700x670x675 mm</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Dimensões do nicho (AxLxP): 610x570x580 mm</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Peso do produto sem embalagem: 27 Kg</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Peso do produto com embalagem: 30 Kg</span></p><p><strong style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Itens Inclusos:</strong></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">01 Forno</span></p><p><span style=\"color: rgb(48, 48, 48); background-color: rgb(255, 255, 255);\">Manual</span></p><p><br></p>', 35, 18, 1, 986.32, 1225.32, 1583.02, 'S', 'A');

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
(17, 35, 'Geladeiras'),
(18, 35, 'Fornos'),
(19, 35, 'Ventiladores'),
(20, 36, 'Iphones'),
(21, 36, 'Xiaomi'),
(22, 36, 'Samsung'),
(23, 34, 'Computadores de mesa'),
(24, 34, 'Notebooks'),
(25, 34, 'Impressoras'),
(26, 34, 'Periféricos'),
(28, 38, 'Xbox'),
(29, 38, 'Playstation'),
(30, 38, 'Controles');

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
  MODIFY `categoriaid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
  MODIFY `imgid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `produtoid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `subcategoriaid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
