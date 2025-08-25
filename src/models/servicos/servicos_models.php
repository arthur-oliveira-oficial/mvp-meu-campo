<?php

namespace Src\Models\Servicos;

use PDO;

/**
 * Classe ServicosModel
 *
 * Interage com a tabela `servicos` do banco de dados.
 */
class ServicosModel
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Cria um novo serviço.
     *
     * @param array $dados
     * @return int
     */
    public function criar(array $dados): int
    {
        $sql = "INSERT INTO servicos (consultoria_id, descricao, status, observacoes, preco_servico, porcentagem_comissao, valor_final, data_solicitacao, data_conclusao, external_reference) VALUES (:consultoria_id, :descricao, :status, :observacoes, :preco_servico, :porcentagem_comissao, :valor_final, :data_solicitacao, :data_conclusao, :external_reference)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($dados);
        return $this->pdo->lastInsertId();
    }

    /**
     * Busca um serviço pelo ID.
     *
     * @param int $id
     * @return array|null
     */
    public function buscar(int $id): ?array
    {
        $sql = "SELECT * FROM servicos WHERE id = :id AND deletado_em IS NULL";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }

    /**
     * Atualiza um serviço.
     *
     * @param int $id
     * @param array $dados
     * @return bool
     */
    public function atualizar(int $id, array $dados): bool
    {
        $sql = "UPDATE servicos SET consultoria_id = :consultoria_id, descricao = :descricao, status = :status, observacoes = :observacoes, preco_servico = :preco_servico, porcentagem_comissao = :porcentagem_comissao, valor_final = :valor_final, data_solicitacao = :data_solicitacao, data_conclusao = :data_conclusao, external_reference = :external_reference WHERE id = :id";
        $dados['id'] = $id;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($dados);
    }

    /**
     * Realiza o soft delete de um serviço.
     *
     * @param int $id
     * @return bool
     */
    public function deletar(int $id): bool
    {
        $sql = "UPDATE servicos SET deletado_em = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Busca todos os serviços ativos.
     *
     * @return array
     */
    public function buscarTodos(): array
    {
        $sql = "SELECT * FROM servicos WHERE deletado_em IS NULL";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}