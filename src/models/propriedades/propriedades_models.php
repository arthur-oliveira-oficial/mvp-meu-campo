<?php

namespace Src\Models\Propriedades;

use PDO;

/**
 * Classe PropriedadesModel
 *
 * Gerencia os dados da tabela `propriedades`.
 */
class PropriedadesModel
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
     * Cria uma nova propriedade.
     *
     * @param array $dados
     * @return int
     */
    public function criar(array $dados): int
    {
        $sql = "INSERT INTO propriedades (perfil_agricultor_id, nome, municipio, estado, coordenadas, tamanho_total) VALUES (:perfil_agricultor_id, :nome, :municipio, :estado, :coordenadas, :tamanho_total)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($dados);
        return $this->pdo->lastInsertId();
    }

    /**
     * Busca uma propriedade pelo ID.
     *
     * @param int $id
     * @return array|null
     */
    public function buscar(int $id): ?array
    {
        $sql = "SELECT * FROM propriedades WHERE id = :id AND deletado_em IS NULL";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }

    /**
     * Atualiza uma propriedade.
     *
     * @param int $id
     * @param array $dados
     * @return bool
     */
    public function atualizar(int $id, array $dados): bool
    {
        $sql = "UPDATE propriedades SET perfil_agricultor_id = :perfil_agricultor_id, nome = :nome, municipio = :municipio, estado = :estado, coordenadas = :coordenadas, tamanho_total = :tamanho_total, atualizado_em = NOW() WHERE id = :id";
        $dados['id'] = $id;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($dados);
    }

    /**
     * Realiza o soft delete de uma propriedade.
     *
     * @param int $id
     * @return bool
     */
    public function deletar(int $id): bool
    {
        $sql = "UPDATE propriedades SET deletado_em = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Busca todas as propriedades ativas.
     *
     * @return array
     */
    public function buscarTodos(): array
    {
        $sql = "SELECT * FROM propriedades WHERE deletado_em IS NULL";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}