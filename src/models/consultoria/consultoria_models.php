<?php

namespace Src\Models\Consultoria;

use PDO;

/**
 * Classe ConsultoriaModel
 *
 * Responsável pela interação com a tabela `consultoria`.
 */
class ConsultoriaModel
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
     * Cria uma nova consultoria.
     *
     * @param array $dados
     * @return int
     */
    public function criar(array $dados): int
    {
        $sql = "INSERT INTO consultoria (agricultor_id, consultor_id, lavoura_id, status, tipo, data_agendamento) VALUES (:agricultor_id, :consultor_id, :lavoura_id, :status, :tipo, :data_agendamento)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($dados);
        return $this->pdo->lastInsertId();
    }

    /**
     * Busca uma consultoria pelo ID.
     *
     * @param int $id
     * @return array|null
     */
    public function buscar(int $id): ?array
    {
        $sql = "SELECT * FROM consultoria WHERE id = :id AND deletado_em IS NULL";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }

    /**
     * Atualiza uma consultoria.
     *
     * @param int $id
     * @param array $dados
     * @return bool
     */
    public function atualizar(int $id, array $dados): bool
    {
        $sql = "UPDATE consultoria SET agricultor_id = :agricultor_id, consultor_id = :consultor_id, lavoura_id = :lavoura_id, status = :status, tipo = :tipo, data_agendamento = :data_agendamento, atualizado_em = NOW() WHERE id = :id";
        $dados['id'] = $id;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($dados);
    }

    /**
     * Realiza o soft delete de uma consultoria.
     *
     * @param int $id
     * @return bool
     */
    public function deletar(int $id): bool
    {
        $sql = "UPDATE consultoria SET deletado_em = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Busca todas as consultorias ativas.
     *
     * @return array
     */
    public function buscarTodos(): array
    {
        $sql = "SELECT * FROM consultoria WHERE deletado_em IS NULL";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}