<?php

namespace Src\Models\Lavouras;

use PDO;

/**
 * Classe LavourasModel
 *
 * Gerencia os dados da tabela `lavouras`.
 */
class LavourasModel
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
     * Cria uma nova lavoura.
     *
     * @param array $dados
     * @return int
     */
    public function criar(array $dados): int
    {
        $sql = "INSERT INTO lavouras (propriedade_id, identificacao, cultura_atual_id, tamanho_area, status, coordenadas_area, tem_estudo_solo_valido, data_ultimo_estudo) VALUES (:propriedade_id, :identificacao, :cultura_atual_id, :tamanho_area, :status, :coordenadas_area, :tem_estudo_solo_valido, :data_ultimo_estudo)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($dados);
        return $this->pdo->lastInsertId();
    }

    /**
     * Busca uma lavoura pelo ID.
     *
     * @param int $id
     * @return array|null
     */
    public function buscar(int $id): ?array
    {
        $sql = "SELECT * FROM lavouras WHERE id = :id AND deletado_em IS NULL";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }

    /**
     * Atualiza uma lavoura.
     *
     * @param int $id
     * @param array $dados
     * @return bool
     */
    public function atualizar(int $id, array $dados): bool
    {
        $sql = "UPDATE lavouras SET propriedade_id = :propriedade_id, identificacao = :identificacao, cultura_atual_id = :cultura_atual_id, tamanho_area = :tamanho_area, status = :status, coordenadas_area = :coordenadas_area, tem_estudo_solo_valido = :tem_estudo_solo_valido, data_ultimo_estudo = :data_ultimo_estudo, atualizado_em = NOW() WHERE id = :id";
        $dados['id'] = $id;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($dados);
    }

    /**
     * Realiza o soft delete de uma lavoura.
     *
     * @param int $id
     * @return bool
     */
    public function deletar(int $id): bool
    {
        $sql = "UPDATE lavouras SET deletado_em = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Busca todas as lavouras ativas.
     *
     * @return array
     */
    public function buscarTodos(): array
    {
        $sql = "SELECT * FROM lavouras WHERE deletado_em IS NULL";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}