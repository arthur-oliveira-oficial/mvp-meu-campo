<?php

namespace Src\Models\PerfilAdmin;

use PDO;

/**
 * Classe PerfilAdminModel
 *
 * Gerencia os dados da tabela `perfil_admin`.
 */
class PerfilAdminModel
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
     * Cria um novo perfil de administrador.
     *
     * @param array $dados
     * @return int
     */
    public function criar(array $dados): int
    {
        $sql = "INSERT INTO perfil_admin (usuario_id, cargo, nivel_permissao, ultima_atividade) VALUES (:usuario_id, :cargo, :nivel_permissao, :ultima_atividade)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($dados);
        return $this->pdo->lastInsertId();
    }

    /**
     * Busca um perfil de administrador pelo ID.
     *
     * @param int $id
     * @return array|null
     */
    public function buscar(int $id): ?array
    {
        $sql = "SELECT * FROM perfil_admin WHERE id = :id AND deletado_em IS NULL";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }

    /**
     * Atualiza um perfil de administrador.
     *
     * @param int $id
     * @param array $dados
     * @return bool
     */
    public function atualizar(int $id, array $dados): bool
    {
        $sql = "UPDATE perfil_admin SET usuario_id = :usuario_id, cargo = :cargo, nivel_permissao = :nivel_permissao, ultima_atividade = :ultima_atividade, atualizado_em = NOW() WHERE id = :id";
        $dados['id'] = $id;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($dados);
    }

    /**
     * Realiza o soft delete de um perfil de administrador.
     *
     * @param int $id
     * @return bool
     */
    public function deletar(int $id): bool
    {
        $sql = "UPDATE perfil_admin SET deletado_em = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Busca todos os perfis de administrador ativos.
     *
     * @return array
     */
    public function buscarTodos(): array
    {
        $sql = "SELECT * FROM perfil_admin WHERE deletado_em IS NULL";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}