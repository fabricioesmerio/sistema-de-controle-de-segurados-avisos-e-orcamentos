-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05-Mar-2018 Ã s 01:23
-- VersÃ£o do servidor: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sgsdb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `avisos`
--

CREATE TABLE `avisos` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `data_abertura` date DEFAULT NULL,
  `data_fechamnto` date DEFAULT NULL,
  `status` int(11) NOT NULL,
  `usuario_respons` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bem`
--

CREATE TABLE `bem` (
  `id` int(11) NOT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `anoModelo` varchar(10) DEFAULT NULL,
  `zeroKm` varchar(3) DEFAULT NULL,
  `combustivel` varchar(30) DEFAULT NULL,
  `codFipe` varchar(20) DEFAULT NULL,
  `placa` varchar(10) DEFAULT NULL,
  `chassi` varchar(50) DEFAULT NULL,
  `categoria` varchar(45) DEFAULT NULL,
  `uso` varchar(45) DEFAULT NULL,
  `transportes` varchar(45) DEFAULT NULL,
  `blindado` varchar(3) DEFAULT NULL,
  `cepPernoite` varchar(15) DEFAULT NULL,
  `cidadePernoite` varchar(100) DEFAULT NULL,
  `estadoPernoite` varchar(50) DEFAULT NULL,
  `atividadeEco` varchar(150) DEFAULT NULL,
  `cod_verificacao` varchar(30) NOT NULL,
  `tipoBem` int(11) NOT NULL,
  `cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `cod` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `cnpj` varchar(45) DEFAULT NULL,
  `tipo_cliente` int(11) NOT NULL,
  `razao` varchar(100) DEFAULT NULL,
  `celular` varchar(18) DEFAULT NULL,
  `cnh` varchar(20) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `estado_civil` varchar(45) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `telefone` varchar(18) DEFAULT NULL,
  `finali_eco` varchar(100) DEFAULT NULL,
  `last_modified` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `razao` varchar(100) DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `rua` varchar(100) DEFAULT NULL,
  `numero` int(5) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `id` int(11) NOT NULL,
  `rua` varchar(100) DEFAULT NULL,
  `numero` varchar(45) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cep` varchar(15) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estrutura da tabela `nivelacesso`
--

CREATE TABLE `nivelacesso` (
  `id` int(11) NOT NULL,
  `nivel` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `nivelacesso`
--

INSERT INTO `nivelacesso` (`id`, `nivel`) VALUES
(1, 'Administrador'),
(2, 'Padrão');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento`
--

CREATE TABLE `orcamento` (
  `id` int(11) NOT NULL,
  `data_abertura` date DEFAULT NULL,
  `data_fechmto` date DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `seguro`
--

CREATE TABLE `seguro` (
  `cod` int(11) NOT NULL,
  `dataInicio` date DEFAULT NULL,
  `dataFinal` date DEFAULT NULL,
  `sinistro` tinyint(4) DEFAULT '0',
  `classe` varchar(20) DEFAULT NULL,
  `is_closed` varchar(3) NOT NULL DEFAULT 'nao',
  `cliente` int(11) NOT NULL,
  `bem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'Ativo'),
(2, 'Inativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `statususuario`
--

CREATE TABLE `statususuario` (
  `id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `statususuario`
--

INSERT INTO `statususuario` (`id`, `status`) VALUES
(1, 'Ativo'),
(2, 'Inativo'),
(3, 'Férias');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipobem`
--

CREATE TABLE `tipobem` (
  `id` int(11) NOT NULL,
  `tipoBem` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipobem`
--

INSERT INTO `tipobem` (`id`, `tipoBem`) VALUES
(1, 'Residência'),
(2, 'Automóvel'),
(3, 'Empresa'),
(4, 'Motocicleta');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipocliente`
--

CREATE TABLE `tipocliente` (
  `id` int(11) NOT NULL,
  `tipo_cliente` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipocliente`
--

INSERT INTO `tipocliente` (`id`, `tipo_cliente`) VALUES
(1, 'Pessoa Fí­sica'),
(2, 'Pessoa Jurí­dica');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `nivelAcesso` int(11) NOT NULL,
  `statusUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `login`, `pass`, `nivelAcesso`, `statusUsuario`) VALUES
(1, 'Fabrí­cio Esmério', 'fabricio.dev', 'd48e6e147c1c719c6ce6bd6f6b0b0bb4', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avisos`
--
ALTER TABLE `avisos`
  ADD PRIMARY KEY (`id`,`status`,`usuario_respons`),
  ADD KEY `fk_avisos_status_aviso_idx` (`status`),
  ADD KEY `fk_avisos_usuario1_idx` (`usuario_respons`);

--
-- Indexes for table `bem`
--
ALTER TABLE `bem`
  ADD PRIMARY KEY (`id`,`tipoBem`,`cliente`),
  ADD KEY `fk_bem_tipoBem1_idx` (`tipoBem`),
  ADD KEY `fk_bem_cliente1_idx` (`cliente`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cod`,`tipo_cliente`),
  ADD KEY `fk_cliente_tipo_cliente_idx` (`tipo_cliente`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id`,`cliente`),
  ADD KEY `fk_endereco_cliente1_idx` (`cliente`);

--
-- Indexes for table `nivelacesso`
--
ALTER TABLE `nivelacesso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orcamento`
--
ALTER TABLE `orcamento`
  ADD PRIMARY KEY (`id`,`status`,`cliente`),
  ADD KEY `fk_orcamento_status1_idx` (`status`),
  ADD KEY `fk_orcamento_cliente1_idx` (`cliente`);

--
-- Indexes for table `seguro`
--
ALTER TABLE `seguro`
  ADD PRIMARY KEY (`cod`,`cliente`,`bem`),
  ADD KEY `fk_seguro_cliente1_idx` (`cliente`),
  ADD KEY `fk_seguro_bem1_idx1` (`bem`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statususuario`
--
ALTER TABLE `statususuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipobem`
--
ALTER TABLE `tipobem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipocliente`
--
ALTER TABLE `tipocliente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`,`nivelAcesso`,`statusUsuario`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`),
  ADD KEY `fk_usuario_nivelAcesso1_idx` (`nivelAcesso`),
  ADD KEY `fk_usuario_statusCliente1_idx` (`statusUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avisos`
--
ALTER TABLE `avisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bem`
--
ALTER TABLE `bem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `nivelacesso`
--
ALTER TABLE `nivelacesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orcamento`
--
ALTER TABLE `orcamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `seguro`
--
ALTER TABLE `seguro`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `statususuario`
--
ALTER TABLE `statususuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tipobem`
--
ALTER TABLE `tipobem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tipocliente`
--
ALTER TABLE `tipocliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `avisos`
--
ALTER TABLE `avisos`
  ADD CONSTRAINT `fk_avisos_status_aviso` FOREIGN KEY (`status`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_avisos_usuario1` FOREIGN KEY (`usuario_respons`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `bem`
--
ALTER TABLE `bem`
  ADD CONSTRAINT `fk_bem_cliente1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bem_tipoBem1` FOREIGN KEY (`tipoBem`) REFERENCES `tipobem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_cliente_tipo_cliente` FOREIGN KEY (`tipo_cliente`) REFERENCES `tipocliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `fk_endereco_cliente1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `orcamento`
--
ALTER TABLE `orcamento`
  ADD CONSTRAINT `fk_orcamento_cliente1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orcamento_status1` FOREIGN KEY (`status`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `seguro`
--
ALTER TABLE `seguro`
  ADD CONSTRAINT `fk_seguro_bem1` FOREIGN KEY (`bem`) REFERENCES `bem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_seguro_cliente1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_nivelAcesso1` FOREIGN KEY (`nivelAcesso`) REFERENCES `nivelacesso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_statusCliente1` FOREIGN KEY (`statusUsuario`) REFERENCES `statususuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
