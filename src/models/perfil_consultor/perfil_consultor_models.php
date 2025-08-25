<?php

namespace Src\Models\PerfilConsultor;

use PDO;

/**
 * Classe PerfilConsultorModel
 *
 * Modela e gerencia os dados da tabela `perfil_consultor`.
 */
class PerfilConsultorModel
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
     * Cria um novo perfil de consultor.
     *
     * @param array $dados
     * @return int
     */
    public function criar(array $dados): int
    {
        $sql = "INSERT INTO perfil_consultor (usuario_id, registro_profissional, biografia, avaliacao_media, municipio, estado, disponibilidade, asaas_wallet_id) VALUES (:usuario_id, :registro_profissional, :biografia, :avaliacao_media, :municipio, :estado, :disponibilidade, :asaas_wallet_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($dados);
        return $this->pdo->lastInsertId();
    }

    /**
     * Busca um perfil de consultor pelo ID.
     *
     * @param int $id
     * @return array|null
     */
    public function buscar(int $id): ?array
    {
        $sql = "SELECT * FROM perfil_consultor WHERE id = :id AND deletado_em IS NULL";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }

    /**
     * Atualiza um perfil de consultor.
     *
     * @param int $id
     * @param array $dados
     * @return bool
     */
    public function atualizar(int $id, array $dados): bool
    {
        $sql = "UPDATE perfil_consultor SET usuario_id = :usuario_id, registro_profissional = :registro_profissional, biografia = :biografia, avaliacao_media = :avaliacao_media, municipio = :municipio, estado = :estado, disponibilidade = :disponibilidade, asaas_wallet_id = :asaas_wallet_id, atualizado_em = NOW() WHERE id = :id";
        $dados['id'] = $id;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($dados);
    }

    /**
     * Realiza o soft delete de um perfil de consultor.
     *
     * @param int $id
     * @return bool
     */
    public function deletar(int $id): bool
    {
        $sql = "UPDATE perfil_consultor SET deletado_em = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Busca todos os perfis de consultor ativos.
     *
     * @return array
     */
    public function buscarTodos(): array
    {
        $sql = "SELECT * FROM perfil_consultor WHERE deletado_em IS NULL";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}