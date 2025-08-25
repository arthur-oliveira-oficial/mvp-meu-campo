<?php

namespace Src\Models\Especialidades;

use PDO;

/**
 * Classe EspecialidadesModel
 *
 * Gerencia os dados da tabela `especialidades`.
 */
class EspecialidadesModel
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
     * Cria uma nova especialidade.
     *
     * @param array $dados
     * @return int
     */
    public function criar(array $dados): int
    {
        $sql = "INSERT INTO especialidades (nome) VALUES (:nome)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($dados);
        return $this->pdo->lastInsertId();
    }

    /**
     * Busca uma especialidade pelo ID.
     *
     * @param int $id
     * @return array|null
     */
    public function buscar(int $id): ?array
    {
        $sql = "SELECT * FROM especialidades WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }

    /**
     * Atualiza uma especialidade.
     *
     * @param int $id
     * @param array $dados
     * @return bool
     */
    public function atualizar(int $id, array $dados): bool
    {
        $sql = "UPDATE especialidades SET nome = :nome WHERE id = :id";
        $dados['id'] = $id;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($dados);
    }

    /**
     * Deleta uma especialidade.
     *
     * @param int $id
     * @return bool
     */
    public function deletar(int $id): bool
    {
        $sql = "DELETE FROM especialidades WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Busca todas as especialidades.
     *
     * @return array
     */
    public function buscarTodos(): array
    {
        $sql = "SELECT * FROM especialidades";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}