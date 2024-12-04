-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/11/2024 às 00:34
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `almoxarifado_farmacia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `quantidade`, `preco`) VALUES
(1, 'ACETATO DE MEDROXIPROGESTERONA + CIPIONATO ESTRADIOL  25MG +\r\n5MG/0,5ML [1 microgramas; Solucao inje', '1 mcg', 45, 19.67),
(2, 'ACETOFENIDA, ALGESTONA + ESTRADIOL, ENANTATO 150MG/ML + 10MG/ML\r\n[1 Unidade; Solucao injetavel/Ampol', '1 ml', 62, 12.72),
(3, 'ACICLOVIR 200MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 500, 109.11),
(4, 'ACICLOVIR 50MG/G [10 gramas; Creme/Bisnaga]', '10 gramas', 340, 99.69),
(5, 'ACIDO ACETILSALICILICO 100MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 890, 69.60),
(6, 'ACIDO ASCORBICO 200MG/ML [20 mililitros; Solucao oral/Frasco]', '20 ml', 120, 17.38),
(7, 'ACIDO ASCORBICO 500MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 240, 5.75),
(8, 'ACIDO FOLICO 5MG [1 Unidade; Comprimido revestido/Unidade]', 'comprimido', 310, 188.56),
(9, 'ALBENDAZOL 400MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 70, 118.00),
(10, 'ALBENDAZOL 40MG/ML [10 mililitros; Suspensao oral/Frasco]', '10 ml', 95, 132.27),
(11, 'ALENDRONATO SODICO 70MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 510, 16.13),
(12, 'AMIODARONA, CLORIDRATO 200MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 20, 157.59),
(13, 'AMOXICILINA 500MG [1 Unidade; Capsula/Unidade]', 'comprimido', 440, 68.09),
(14, 'AMOXICILINA 50MG/ML [60 mililitros; Suspensao oral/Frasco]', '60ml', 75, 79.64),
(15, 'AMOXICILINA 500 MG + CLAVULANATO DE POTASSIO 125 MG COMPRIMIDO', 'comprimido', 90, 5.25),
(16, 'AMOXICILINA 50MG/ML + CLAVULANATO DE POTASSIO 12,5MG/ML', '75ml', 200, 185.10),
(17, 'ANLODIPINO, BESILATO 10MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 350, 174.82),
(18, 'ANLODIPINO, BESILATO 5MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 150, 45.68),
(19, 'ATENOLOL 50MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 480, 29.49),
(20, 'AZITROMICINA 40MG/ML [15 mililitros; Po suspensao oral/Frasco]', '15 ml', 60, 138.22),
(21, 'AZITROMICINA 500MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 820, 84.46),
(22, 'BECLOMETASONA, DIPROPIONATO 200MCG/DOSE 200/DOSES [1 Unidade;\r\nAerossol bucal/Frasco]', '200 puffs', 125, 120.87),
(23, 'BECLOMETASONA, DIPROPIONATO 50MCG/DOSE 200/DOSES - 1 ML [1\r\nmililitros; Aerossol nasal/Frasco]', '200 puffs', 300, 96.64),
(24, 'BECLOMETASONA, DIPROPIONATO 50MCG/DOSE 200/DOSES [1 Unidade;\r\nAerossol bucal/Frasco]', '200 puffs', 215, 130.30),
(25, 'BENZILPENICILINA BENZATINA 1.200.000UI (MINISTERIAL) [1 Unidade;\r\nSuspensao injetavel/Frasco-ampola]', '1 ampola', 35, 56.43),
(26, 'BENZOILMETRONIDAZOL 40MG/ML [100 mililitros; Suspensao\r\noral/Frasco]', '100 ml', 290, 146.20),
(27, 'BENZOILMETRONIDAZOL 40MG/ML [120 mililitros; Suspensao\r\noral/Frasco]', '120 ml', 195, 49.99),
(28, 'BUPROPIONA, CLORIDRATO 150MG [1 Unidade; Comprimido liberacao\r\ncontrolada/Unidade]', 'comprimido', 88, 198.79),
(29, 'CAPTOPRIL 25MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 510, 76.86),
(30, 'CARBONATO DE CALCIO + COLECALCIFEROL 500MG + 400UI [1 Unidade;\r\nComprimido/Unidade]', 'comprimido ', 650, 53.32),
(31, 'CARVEDILOL 12.5MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 700, 17.16),
(32, 'CARVEDILOL 3.125MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 320, 43.97),
(33, 'CEFALEXINA 500MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 440, 90.78),
(34, 'CEFALEXINA 50MG/ML [60 mililitros; Po suspensao oral/Frasco]', '60 ml', 150, 158.01),
(35, 'CETOCONAZOL 200MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 120, 199.87),
(36, 'CETOCONAZOL 20MG/G - 1 MG [1 miligramas; Creme/Bisnaga]', '1 mg', 410, 107.02),
(37, 'CILOSTAZOL 100MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 85, 45.43),
(38, 'CIPROFLOXACINO, CLORIDRATO 500MG [1 Unidade;\r\nComprimido/Unidade]', 'comprimido', 150, 71.24),
(39, 'COLAGENASE 0,6UI/G [30 gramas; Pomada/Bisnaga]', '30g', 20, 138.81),
(40, 'DEXAMETASONA 0,1MG/ML [100 mililitros; Solucao oral/Frasco]', '100ml', 95, 69.43),
(41, 'DEXAMETASONA 1MG/ML [5 mililitros; Suspensao oftalmica/Frasco]', '5 ml', 45, 170.85),
(42, 'DEXAMETASONA 4MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 300, 98.26),
(43, 'DEXAMETASONA, ACETATO 1MG/G [10 gramas; Creme/Bisnaga]', '10g', 120, 141.60),
(44, 'DEXCLORFENIRAMINA 0,4 MG/ML XAROPE FRASCO DE 100 ML [100\r\nmililitros; Xarope/Frasco]', '100ml', 200, 52.87),
(45, 'DEXCLORFENIRAMINA, MALEATO 2MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 140, 75.18),
(46, 'DICLOFENACO POTASSICO 50MG [1 Unidade; Comprimido\r\nrevestido/Unidade]', 'comprimido', 85, 8.42),
(47, 'DIGOXINA 0.25MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 70, 115.92),
(48, 'DIPIRONA 500MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 250, 155.36),
(49, 'DIPIRONA 500MG/ML [10 mililitros; Solucao oral/Unidade]', '10ml', 90, 153.40),
(50, 'DOXAZOSINA, MESILATO 2MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 120, 79.83),
(51, 'ENALAPRIL, MALEATO 10MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 350, 20.34),
(52, 'ENALAPRIL, MALEATO 20MG [1 Unidade; Comprimido/Unidade]', '1\r\nUnidade', 480, 38.57),
(53, 'ESCOPOLAMINA, N-BUTILBROMETO + DIPIRONA SODICA 6,67 + 333,4\r\nMG/ML [20 mililitros; Solucao oral/Fras', '20 ml', 75, 104.21),
(54, 'ESPIRONOLACTONA 100MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 95, 43.63),
(55, 'ESPIRONOLACTONA 25MG [1 Unidade; Comprimido revestido/Unidade]', 'comprimido', 310, 108.07),
(56, 'EPINEFRINA 1MG/ML 1ML L [1 Unidade; Solucao injetavel/Ampola]', 'ampola', 45, 183.59),
(57, 'FINASTERIDA 5MG [1 Unidade; Comprimido/Unidade]', 'comprimido', 70, 109.68),
(58, 'FLUCONAZOL 150MG [1 Unidade; Capsula/Unidade]', 'comprimido', 150, 126.85),
(59, 'FUROSEMIDA 40MG [1 Unidade; Comprimido/Unidade]', '1 Unidade', 280, 161.76),
(60, 'GLIBENCLAMIDA 5MG [1 Unidade; Comprimido/Unidade]', '1 Unidade', 320, 103.65),
(61, 'GLICLAZIDA 60MG [1 Unidade; Comprimido liberacao\r\ncontrolada/Unidade]', '1 Unidade', 400, 31.37),
(62, 'GUACO ( MIKANIA GLOMERATA SPRENG) 35MG/ML [1 Unidade;\r\nXarope/Unidade]', '1 Unidade', 120, 48.62),
(63, 'GUACO (MIKANIA GLOMERATA SPRENG.) 0,1 ML/ML XAROPE', 'Descrição\r\nnão especificada', 50, 38.34),
(64, 'HIDROCLOROTIAZIDA 25MG [1 Unidade; Comprimido/Unidade]', '1\r\nUnidade', 270, 96.02),
(65, 'HIDROXIDO ALUMINIO 60MG/ML [150 mililitros; Suspensao\r\noral/Frasco]', '150 mililitros', 120, 31.04),
(66, 'IBUPROFENO 300MG [1 Unidade; Comprimido/Unidade]', '1 Unidade', 350, 189.70),
(67, 'IBUPROFENO 50MG/ML [30 mililitros; Suspensao oral/Frasco]', '30\r\nmililitros', 220, 33.93),
(68, 'IBUPROFENO 600MG [1 Unidade; Comprimido revestido/Unidade]', '1\r\nUnidade', 400, 150.74),
(69, 'IPRATROPIO, BROMETO 0,25MG/ML [20 mililitros; Solucao\r\ninalatoria/Frasco]', '20 mililitros', 110, 140.21),
(70, 'ISOFLAVONA DE SOJA 150 MG [1 Unidade; Capsula/Unidade]', '1\r\nUnidade', 90, 10.81),
(71, 'ISOFLAVONA DE SOJA 75 MG [1 Unidade; Capsula/Unidade]', '1\r\nUnidade', 160, 134.54),
(72, 'ISOSSORBIDA, MONONITRATO 20MG [1 Unidade; Comprimido/Unidade]', '1 Unidade', 180, 182.52),
(73, 'IVERMECTINA 6MG [1 Unidade; Comprimido/Unidade]', '1 Unidade', 75, 62.42),
(74, 'LIDOCAINA, CLORIDRATO 20MG/G [30 gramas; Geleia/Bisnaga]', '30\r\ngramas', 50, 104.86),
(75, 'LIDOCAINA, CLORIDRATO 20MG/ML 5ML [1 Unidade; Solucao\r\ninjetavel/Ampola]', '1 Unidade', 80, 108.77),
(76, 'LACTULOSE 667MG/ML [120 mililitros; Solucao oral/Frasco]', '120\r\nmililitros', 70, 121.09),
(77, 'LEVONORGESTREL + ETINILESTRADIOL 0,15 + 0,03MG - CAIXA [1\r\nUnidade; Comprimido/Unidade]', 'comprimido', 90, 22.65),
(78, 'LEVONORGESTREL 0.75MG [1 Unidade; Comprimido/Unidade]', '1\r\nUnidade', 65, 96.30),
(79, 'LEVOTIROXINA SODICA 100MCG [1 Unidade; Comprimido/Unidade]', '1\r\nUnidade', 300, 62.65),
(80, 'LEVOTIROXINA SODICA 25MCG [1 Unidade; Comprimido/Unidade]', '1\r\nUnidade', 310, 165.38),
(81, 'LEVOTIROXINA SODICA 50MCG [1 Unidade; Comprimido/Unidade]', '1\r\nUnidade', 250, 35.16),
(82, 'LORATADINA 1MG/ML [100 mililitros; Xarope/Frasco]', '100\r\nmililitros', 180, 182.67),
(83, 'LOSARTANA POTASSICA 50MG [1 Unidade; Comprimido\r\nrevestido/Unidade]', '1 Unidade', 400, 153.54),
(84, 'MEDROXIPROGESTERONA, ACETATO 150MG/ML 1ML [1 Unidade; Suspensao\r\ninjetavel/Ampola]', '1 Unidade', 120, 163.19),
(85, 'METFORMINA, CLORIDRATO 500MG [1 Unidade; Comprimido/Unidade]', '1 Unidade', 320, 100.39),
(86, 'METFORMINA, CLORIDRATO 850MG [1 Unidade; Comprimido/Unidade]', '1 Unidade', 350, 169.58),
(87, 'METILDOPA 250MG [1 Unidade; Comprimido revestido/Unidade]', '1\r\nUnidade', 85, 173.80),
(88, 'METOCLOPRAMIDA, CLORIDRATO 4MG/ML [10 mililitros; Solucao\r\noral/Frasco]', '10 mililitros', 110, 153.17),
(89, 'METOPROLOL, SUCCINATO 50MG [1 Unidade; Comprimido liberacao\r\ncontrolada/Unidade]', '1 Unidade', 90, 60.54),
(90, 'METRONIDAZOL 100MG/G [50 gramas; Gel vaginal/Bisnaga]', '50\r\ngramas', 130, 99.43),
(91, 'METRONIDAZOL 250MG [1 Unidade; Comprimido/Unidade]', '1\r\nUnidade', 300, 193.36),
(92, 'MICONAZOL, NITRATO 2% CREME VAGINAL, COM 7 APLICADORES [80\r\ngramas; Creme vaginal/Bisnaga]', '80 gramas', 90, 73.84),
(93, 'MICONAZOL, NITRATO 20MG/G [28 gramas; Creme/Bisnaga]', '28\r\ngramas', 150, 86.40),
(94, 'NICOTINA 14MG [1 Unidade; Adesivo transdermico/Unidade]', '1\r\nUnidade', 70, 172.17),
(95, 'NICOTINA 21MG [1 Unidade; Adesivo transdermico/Unidade]', '1\r\nUnidade', 50, 95.21),
(96, 'NICOTINA 7MG [1 Unidade; Adesivo transdermico/Unidade]', '1\r\nUnidade', 60, 169.80),
(97, 'NIFEDIPINA 10MG [1 Unidade; Comprimido/Unidade]', '1 Unidade', 110, 45.46),
(98, 'NISTATINA 100.000UI/ML [50 mililitros; Solucao oral/Frasco]', '50 mililitros', 70, 148.74),
(99, 'NORETISTERONA 0,35MG - CAIXA [1 Unidade; Comprimido/Unidade]', '1 Unidade', 80, 178.98),
(100, 'NORETISTERONA, ENANTATO + ESTRADIOL, VALERATO 50 + 5MG/ML 1ML\r\n[1 Unidade; Solucao injetavel/Ampola]', '1 Unidade', 50, 152.35),
(101, 'OLEO MINERAL [100 mililitros; Solucao/Frasco]', '100\r\nmililitros', 100, 155.98),
(102, 'OMEPRAZOL 20MG [1 Unidade; Capsula/Unidade]', '1 Unidade', 400, 84.63);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Estrutura para tabela `saidas`
--

CREATE TABLE `saidas` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data_saida` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `saidas`
--

INSERT INTO `saidas` (`id`, `produto_id`, `quantidade`, `data_saida`) VALUES
(1, 1, 1, '2024-11-19 16:43:06');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'Jucielen Valéria Souza Silva', 'jucielenvaleriasouza@gmail.com', '$2y$10$0CbxdD8bHZN2vPMSu253/./.OWCFFbGgSgQINqh6q7IU.0GSXL4pa');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `saidas`
--
ALTER TABLE `saidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `saidas`
--
ALTER TABLE `saidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `saidas`
--
ALTER TABLE `saidas`
  ADD CONSTRAINT `saidas_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;