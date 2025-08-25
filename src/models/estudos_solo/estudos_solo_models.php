<?php

namespace Src\Models\EstudosSolo;

use PDO;

/**
 * Classe EstudosSoloModel
 *
 * Interage com a tabela `estudos_solo`.
 */
class EstudosSoloModel
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
     * Cria um novo registro de estudo de solo.
     *
     * @param array $dados
     * @return int
     */
    public function criar(array $dados): int
    {
        $sql = "INSERT INTO estudos_solo (lavoura_id, nome_arquivo, caminho_arquivo, tamanho_arquivo, tipo_mime, hash_arquivo, data_coleta, laboratorio, valido_ate, status, observacoes_validacao, validado_por, data_validacao) VALUES (:lavoura_id, :nome_arquivo, :caminho_arquivo, :tamanho_arquivo, :tipo_mime, :hash_arquivo, :data_coleta, :laboratorio, :valido_ate, :status, :observacoes_validacao, :validado_por, :data_validacao)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($dados);
        return $this->pdo->lastInsertId();
    }

    /**
     * Busca um estudo de solo pelo ID.
     *
     * @param int $id
     * @return array|null
     */
    public function buscar(int $id): ?array
    {
        $sql = "SELECT * FROM estudos_solo WHERE id = :id AND deletado_em IS NULL";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }

    /**
     * Atualiza um estudo de solo.
     *
     * @param int $id
     * @param array $dados
     * @return bool
     */
    public function atualizar(int $id, array $dados): bool
    {
        $sql = "UPDATE estudos_solo SET lavoura_id = :lavoura_id, nome_arquivo = :nome_arquivo, caminho_arquivo = :caminho_arquivo, tamanho_arquivo = :tamanho_arquivo, tipo_mime = :tipo_mime, hash_arquivo = :hash_arquivo, data_coleta = :data_coleta, laboratorio = :laboratorio, valido_ate = :valido_ate, status = :status, observacoes_validacao = :observacoes_validacao, validado_por = :validado_por, data_validacao = :data_validacao, atualizado_em = NOW() WHERE id = :id";
        $dados['id'] = $id;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($dados);
    }

    /**
     * Realiza o soft delete de um estudo de solo.
     *
     * @param int $id
     * @return bool
     */
    public function deletar(int $id): bool
    {
        $sql = "UPDATE estudos_solo SET deletado_em = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Busca todos os estudos de solo ativos.
     *
     * @return array
     */
    public function buscarTodos(): array
    {
        $sql = "SELECT * FROM estudos_solo WHERE deletado_em IS NULL";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}