<?php

namespace Src\Models\Usuarios;

use PDO;

/**
 * Classe UsuariosModel
 *
 * Gerencia os dados da tabela `usuarios`.
 */
class UsuariosModel
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
     * Cria um novo usuário.
     *
     * @param array $dados
     * @return int
     */
    public function criar(array $dados): int
    {
        $sql = "INSERT INTO usuarios (nome, email, senha_hash, telefone, foto_perfil, tipo, status) VALUES (:nome, :email, :senha_hash, :telefone, :foto_perfil, :tipo, :status)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($dados);
        return $this->pdo->lastInsertId();
    }

    /**
     * Busca um usuário pelo ID.
     *
     * @param int $id
     * @return array|null
     */
    public function buscar(int $id): ?array
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id AND deletado_em IS NULL";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }

    /**
     * Atualiza um usuário.
     *
     * @param int $id
     * @param array $dados
     * @return bool
     */
    public function atualizar(int $id, array $dados): bool
    {
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha_hash = :senha_hash, telefone = :telefone, foto_perfil = :foto_perfil, tipo = :tipo, status = :status, atualizado_em = NOW() WHERE id = :id";
        $dados['id'] = $id;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($dados);
    }

    /**
     * Realiza o soft delete de um usuário.
     *
     * @param int $id
     * @return bool
     */
    public function deletar(int $id): bool
    {
        $sql = "UPDATE usuarios SET deletado_em = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Busca todos os usuários ativos.
     *
     * @return array
     */
    public function buscarTodos(): array
    {
        $sql = "SELECT * FROM usuarios WHERE deletado_em IS NULL";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}