-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/08/2025 às 22:10
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
-- Banco de dados: `meu_camopo_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacao_consultoria`
--

CREATE TABLE `avaliacao_consultoria` (
  `id` int(11) NOT NULL,
  `consultoria_id` int(11) NOT NULL,
  `nota` int(11) NOT NULL,
  `comentario` varchar(191) DEFAULT NULL,
  `data_avaliacao` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `deletado_em` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `consultoria`
--

CREATE TABLE `consultoria` (
  `id` int(11) NOT NULL,
  `agricultor_id` int(11) NOT NULL,
  `consultor_id` int(11) DEFAULT NULL,
  `lavoura_id` int(11) DEFAULT NULL,
  `status` enum('solicitada','agendada','realizada','cancelada','paga') NOT NULL DEFAULT 'solicitada',
  `tipo` enum('online','presencial') NOT NULL,
  `data_agendamento` datetime(3) NOT NULL,
  `criado_em` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `atualizado_em` datetime(3) NOT NULL,
  `deletado_em` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `consultor_especialidade`
--

CREATE TABLE `consultor_especialidade` (
  `id` int(11) NOT NULL,
  `consultor_id` int(11) NOT NULL,
  `especialidade_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `culturas`
--

CREATE TABLE `culturas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `especialidades`
--

CREATE TABLE `especialidades` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `estudos_solo`
--

CREATE TABLE `estudos_solo` (
  `id` int(11) NOT NULL,
  `lavoura_id` int(11) NOT NULL,
  `nome_arquivo` varchar(255) NOT NULL,
  `caminho_arquivo` varchar(500) NOT NULL,
  `tamanho_arquivo` bigint(20) NOT NULL,
  `tipo_mime` varchar(100) NOT NULL DEFAULT 'application/pdf',
  `hash_arquivo` varchar(64) NOT NULL,
  `data_coleta` datetime(3) DEFAULT NULL,
  `laboratorio` varchar(200) DEFAULT NULL,
  `valido_ate` datetime(3) DEFAULT NULL,
  `status` enum('pendente_validacao','aprovado','rejeitado','expirado') NOT NULL DEFAULT 'pendente_validacao',
  `observacoes_validacao` varchar(191) DEFAULT NULL,
  `validado_por` int(11) DEFAULT NULL,
  `data_validacao` datetime(3) DEFAULT NULL,
  `criado_em` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `atualizado_em` datetime(3) NOT NULL,
  `deletado_em` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `lavouras`
--

CREATE TABLE `lavouras` (
  `id` int(11) NOT NULL,
  `propriedade_id` int(11) NOT NULL,
  `identificacao` varchar(100) NOT NULL,
  `cultura_atual_id` int(11) DEFAULT NULL,
  `tamanho_area` decimal(10,2) NOT NULL,
  `status` enum('Em_Preparo','Plantada','Em_Crescimento','Colhida','Em_Pousio') NOT NULL DEFAULT 'Em_Preparo',
  `coordenadas_area` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`coordenadas_area`)),
  `criado_em` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `atualizado_em` datetime(3) NOT NULL,
  `deletado_em` datetime(3) DEFAULT NULL,
  `tem_estudo_solo_valido` tinyint(1) NOT NULL DEFAULT 0,
  `data_ultimo_estudo` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamentos`
--

CREATE TABLE `pagamentos` (
  `id` int(11) NOT NULL,
  `servico_id` int(11) NOT NULL,
  `valor_pago` decimal(10,2) NOT NULL,
  `metodo_pagamento` enum('pix','cartao_credito','boleto') NOT NULL,
  `status_pagamento` enum('pendente','aprovado','recusado','reembolsado') NOT NULL DEFAULT 'pendente',
  `data_pagamento` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `transacao_id` varchar(255) DEFAULT NULL,
  `criado_em` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `atualizado_em` datetime(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfil_admin`
--

CREATE TABLE `perfil_admin` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `nivel_permissao` varchar(50) NOT NULL DEFAULT 'Moderador',
  `ultima_atividade` datetime(3) DEFAULT NULL,
  `criado_em` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `atualizado_em` datetime(3) NOT NULL,
  `deletado_em` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `perfil_admin`
--

INSERT INTO `perfil_admin` (`id`, `usuario_id`, `cargo`, `nivel_permissao`, `ultima_atividade`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 1, 'Administrador', 'Moderador', NULL, '2025-08-22 04:48:10.577', '2025-08-22 04:48:10.577', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfil_agricultor`
--

CREATE TABLE `perfil_agricultor` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `criado_em` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `atualizado_em` datetime(3) NOT NULL,
  `deletado_em` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfil_consultor`
--

CREATE TABLE `perfil_consultor` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `registro_profissional` varchar(50) DEFAULT NULL,
  `biografia` varchar(191) DEFAULT NULL,
  `avaliacao_media` double NOT NULL DEFAULT 0,
  `municipio` varchar(100) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `disponibilidade` tinyint(1) NOT NULL DEFAULT 0,
  `asaas_wallet_id` varchar(255) DEFAULT NULL,
  `criado_em` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `atualizado_em` datetime(3) NOT NULL,
  `deletado_em` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `propriedades`
--

CREATE TABLE `propriedades` (
  `id` int(11) NOT NULL,
  `perfil_agricultor_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `coordenadas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`coordenadas`)),
  `tamanho_total` decimal(10,2) NOT NULL,
  `criado_em` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `atualizado_em` datetime(3) NOT NULL,
  `deletado_em` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

CREATE TABLE `servicos` (
  `id` int(11) NOT NULL,
  `consultoria_id` int(11) NOT NULL,
  `descricao` varchar(191) NOT NULL,
  `status` enum('pendente_aprovacao','aprovado','recusado','em_execucao','concluido','pago') NOT NULL DEFAULT 'pendente_aprovacao',
  `observacoes` varchar(191) DEFAULT NULL,
  `preco_servico` decimal(10,2) NOT NULL,
  `porcentagem_comissao` decimal(5,2) NOT NULL DEFAULT 20.00,
  `valor_final` decimal(65,30) DEFAULT NULL,
  `data_solicitacao` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `data_conclusao` datetime(3) DEFAULT NULL,
  `external_reference` varchar(255) DEFAULT NULL,
  `deletado_em` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `tipo` enum('agricultor','consultor','admin') NOT NULL,
  `status` enum('ativo','inativo') DEFAULT NULL,
  `criado_em` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `atualizado_em` datetime(3) NOT NULL,
  `ultimo_login` datetime(3) DEFAULT NULL,
  `deletado_em` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha_hash`, `telefone`, `foto_perfil`, `tipo`, `status`, `criado_em`, `atualizado_em`, `ultimo_login`, `deletado_em`) VALUES
(1, 'arthur', 'arthur@teste.com', '$2b$10$ehl73vROYi8y33L83ZmxWOiuOsCRSVCiId3AivDSM0BnBTEL5o0D.', NULL, NULL, 'admin', 'ativo', '2025-08-22 04:48:10.571', '2025-08-22 04:52:12.642', '2025-08-22 04:52:12.640', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `avaliacao_consultoria`
--
ALTER TABLE `avaliacao_consultoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `avaliacao_consultoria_consultoria_id_key` (`consultoria_id`);

--
-- Índices de tabela `consultoria`
--
ALTER TABLE `consultoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consultoria_agricultor_id_fkey` (`agricultor_id`),
  ADD KEY `consultoria_consultor_id_fkey` (`consultor_id`),
  ADD KEY `consultoria_lavoura_id_fkey` (`lavoura_id`);

--
-- Índices de tabela `consultor_especialidade`
--
ALTER TABLE `consultor_especialidade`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `consultor_especialidade_consultor_id_especialidade_id_key` (`consultor_id`,`especialidade_id`),
  ADD KEY `consultor_especialidade_especialidade_id_fkey` (`especialidade_id`);

--
-- Índices de tabela `culturas`
--
ALTER TABLE `culturas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `culturas_nome_key` (`nome`);

--
-- Índices de tabela `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `especialidades_nome_key` (`nome`);

--
-- Índices de tabela `estudos_solo`
--
ALTER TABLE `estudos_solo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estudos_solo_lavoura_id_fkey` (`lavoura_id`),
  ADD KEY `estudos_solo_validado_por_fkey` (`validado_por`);

--
-- Índices de tabela `lavouras`
--
ALTER TABLE `lavouras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lavouras_propriedade_id_fkey` (`propriedade_id`),
  ADD KEY `lavouras_cultura_atual_id_fkey` (`cultura_atual_id`);

--
-- Índices de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pagamentos_servico_id_fkey` (`servico_id`);

--
-- Índices de tabela `perfil_admin`
--
ALTER TABLE `perfil_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perfil_admin_usuario_id_fkey` (`usuario_id`);

--
-- Índices de tabela `perfil_agricultor`
--
ALTER TABLE `perfil_agricultor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perfil_agricultor_usuario_id_fkey` (`usuario_id`);

--
-- Índices de tabela `perfil_consultor`
--
ALTER TABLE `perfil_consultor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `perfil_consultor_asaas_wallet_id_key` (`asaas_wallet_id`),
  ADD KEY `perfil_consultor_usuario_id_fkey` (`usuario_id`);

--
-- Índices de tabela `propriedades`
--
ALTER TABLE `propriedades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `propriedades_perfil_agricultor_id_fkey` (`perfil_agricultor_id`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `servicos_external_reference_key` (`external_reference`),
  ADD KEY `servicos_consultoria_id_fkey` (`consultoria_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuarios_email_key` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avaliacao_consultoria`
--
ALTER TABLE `avaliacao_consultoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `consultoria`
--
ALTER TABLE `consultoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `consultor_especialidade`
--
ALTER TABLE `consultor_especialidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `culturas`
--
ALTER TABLE `culturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `estudos_solo`
--
ALTER TABLE `estudos_solo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lavouras`
--
ALTER TABLE `lavouras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `perfil_admin`
--
ALTER TABLE `perfil_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `perfil_agricultor`
--
ALTER TABLE `perfil_agricultor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `perfil_consultor`
--
ALTER TABLE `perfil_consultor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `propriedades`
--
ALTER TABLE `propriedades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `avaliacao_consultoria`
--
ALTER TABLE `avaliacao_consultoria`
  ADD CONSTRAINT `avaliacao_consultoria_consultoria_id_fkey` FOREIGN KEY (`consultoria_id`) REFERENCES `consultoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `consultoria`
--
ALTER TABLE `consultoria`
  ADD CONSTRAINT `consultoria_agricultor_id_fkey` FOREIGN KEY (`agricultor_id`) REFERENCES `perfil_agricultor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultoria_consultor_id_fkey` FOREIGN KEY (`consultor_id`) REFERENCES `perfil_consultor` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `consultoria_lavoura_id_fkey` FOREIGN KEY (`lavoura_id`) REFERENCES `lavouras` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Restrições para tabelas `consultor_especialidade`
--
ALTER TABLE `consultor_especialidade`
  ADD CONSTRAINT `consultor_especialidade_consultor_id_fkey` FOREIGN KEY (`consultor_id`) REFERENCES `perfil_consultor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultor_especialidade_especialidade_id_fkey` FOREIGN KEY (`especialidade_id`) REFERENCES `especialidades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `estudos_solo`
--
ALTER TABLE `estudos_solo`
  ADD CONSTRAINT `estudos_solo_lavoura_id_fkey` FOREIGN KEY (`lavoura_id`) REFERENCES `lavouras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estudos_solo_validado_por_fkey` FOREIGN KEY (`validado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Restrições para tabelas `lavouras`
--
ALTER TABLE `lavouras`
  ADD CONSTRAINT `lavouras_cultura_atual_id_fkey` FOREIGN KEY (`cultura_atual_id`) REFERENCES `culturas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `lavouras_propriedade_id_fkey` FOREIGN KEY (`propriedade_id`) REFERENCES `propriedades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD CONSTRAINT `pagamentos_servico_id_fkey` FOREIGN KEY (`servico_id`) REFERENCES `servicos` (`id`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `perfil_admin`
--
ALTER TABLE `perfil_admin`
  ADD CONSTRAINT `perfil_admin_usuario_id_fkey` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `perfil_agricultor`
--
ALTER TABLE `perfil_agricultor`
  ADD CONSTRAINT `perfil_agricultor_usuario_id_fkey` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `perfil_consultor`
--
ALTER TABLE `perfil_consultor`
  ADD CONSTRAINT `perfil_consultor_usuario_id_fkey` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `propriedades`
--
ALTER TABLE `propriedades`
  ADD CONSTRAINT `propriedades_perfil_agricultor_id_fkey` FOREIGN KEY (`perfil_agricultor_id`) REFERENCES `perfil_agricultor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `servicos`
--
ALTER TABLE `servicos`
  ADD CONSTRAINT `servicos_consultoria_id_fkey` FOREIGN KEY (`consultoria_id`) REFERENCES `consultoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
