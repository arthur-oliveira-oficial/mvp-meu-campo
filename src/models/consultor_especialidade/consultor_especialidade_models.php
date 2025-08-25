<?php

namespace Src\Models\ConsultorEspecialidade;

use PDO;

/**
 * Classe ConsultorEspecialidadeModel
 *
 * Gerencia a tabela de relacionamento entre consultores e especialidades.
 */
class ConsultorEspecialidadeModel
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
     * Associa uma especialidade a um consultor.
     *
     * @param array $dados
     * @return int
     */
    public function criar(array $dados): int
    {
        $sql = "INSERT INTO consultor_especialidade (consultor_id, especialidade_id) VALUES (:consultor_id, :especialidade_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($dados);
        return $this->pdo->lastInsertId();
    }

    /**
     * Busca uma associação pelo ID.
     *
     * @param int $id
     * @return array|null
     */
    public function buscar(int $id): ?array
    {
        $sql = "SELECT * FROM consultor_especialidade WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }

    /**
     * Atualiza uma associação.
     *
     * @param int $id
     * @param array $dados
     * @return bool
     */
    public function atualizar(int $id, array $dados): bool
    {
        $sql = "UPDATE consultor_especialidade SET consultor_id = :consultor_id, especialidade_id = :especialidade_id WHERE id = :id";
        $dados['id'] = $id;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($dados);
    }

    /**
     * Deleta uma associação.
     *
     * @param int $id
     * @return bool
     */
    public function deletar(int $id): bool
    {
        $sql = "DELETE FROM consultor_especialidade WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Busca todas as associações.
     *
     * @return array
     */
    public function buscarTodos(): array
    {
        $sql = "SELECT * FROM consultor_especialidade";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}