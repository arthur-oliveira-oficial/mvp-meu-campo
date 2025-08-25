<?php

namespace Src\Models;

use PDO;
use PDOException;

require_once __DIR__ . '/../../config/config_database.php';

abstract class BaseModel
{
    protected $db;
    protected $table;

    public function __construct()
    {
        try {
            $this->db = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
                DB_USER,
                DB_PASSWORD
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Em um ambiente de produção, você pode querer logar o erro em vez de exibi-lo
            die("Erro de conexão com o banco de dados: " . $e->getMessage());
        }
    }

    /**
     * Cria um novo registro.
     *
     * @param array $dados Os dados a serem inseridos.
     * @return int|false O ID do último registro inserido ou false em caso de falha.
     */
    public function criar(array $dados)
    {
        $colunas = implode(', ', array_keys($dados));
        $placeholders = ':' . implode(', :', array_keys($dados));

        $sql = "INSERT INTO {$this->table} ({$colunas}) VALUES ({$placeholders})";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($dados);
            return (int)$this->db->lastInsertId();
        } catch (PDOException $e) {
            // Logar o erro
            return false;
        }
    }

    /**
     * Busca um registro pelo ID.
     *
     * @param int $id O ID do registro.
     * @return array|false O registro encontrado ou false se não encontrado.
     */
    public function buscarPorId(int $id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id AND deletado_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Busca todos os registros.
     *
     * @return array
     */
    public function buscarTodos(): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE deletado_em IS NULL";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Atualiza um registro.
     *
     * @param int $id O ID do registro a ser atualizado.
     * @param array $dados Os novos dados.
     * @return bool True em caso de sucesso, false em caso de falha.
     */
    public function atualizar(int $id, array $dados): bool
    {
        $dados['atualizado_em'] = date('Y-m-d H:i:s');
        $set = [];
        foreach ($dados as $coluna => $valor) {
            $set[] = "{$coluna} = :{$coluna}";
        }
        $set = implode(', ', $set);

        $sql = "UPDATE {$this->table} SET {$set} WHERE id = :id";
        $dados['id'] = $id;

        try {
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($dados);
        } catch (PDOException $e) {
            // Logar o erro
            return false;
        }
    }

    /**
     * Realiza o soft delete de um registro.
     *
     * @param int $id O ID do registro a ser deletado.
     * @return bool True em caso de sucesso, false em caso de falha.
     */
    public function deletar(int $id): bool
    {
        $sql = "UPDATE {$this->table} SET deletado_em = :deletado_em WHERE id = :id";
        
        try {
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':deletado_em' => date('Y-m-d H:i:s'),
                ':id' => $id
            ]);
        } catch (PDOException $e) {
            // Logar o erro
            return false;
        }
    }
}