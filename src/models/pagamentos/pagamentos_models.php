<?php

namespace Src\Models\Pagamentos;

use PDO;

/**
 * Classe PagamentosModel
 *
 * Responsável por interagir com a tabela `pagamentos`.
 */
class PagamentosModel
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
     * Cria um novo registro de pagamento.
     *
     * @param array $dados
     * @return int
     */
    public function criar(array $dados): int
    {
        $sql = "INSERT INTO pagamentos (servico_id, valor_pago, metodo_pagamento, status_pagamento, data_pagamento, transacao_id) VALUES (:servico_id, :valor_pago, :metodo_pagamento, :status_pagamento, :data_pagamento, :transacao_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($dados);
        return $this->pdo->lastInsertId();
    }

    /**
     * Busca um pagamento pelo ID.
     *
     * @param int $id
     * @return array|null
     */
    public function buscar(int $id): ?array
    {
        $sql = "SELECT * FROM pagamentos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }

    /**
     * Atualiza um pagamento.
     *
     * @param int $id
     * @param array $dados
     * @return bool
     */
    public function atualizar(int $id, array $dados): bool
    {
        $sql = "UPDATE pagamentos SET servico_id = :servico_id, valor_pago = :valor_pago, metodo_pagamento = :metodo_pagamento, status_pagamento = :status_pagamento, data_pagamento = :data_pagamento, transacao_id = :transacao_id, atualizado_em = NOW() WHERE id = :id";
        $dados['id'] = $id;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($dados);
    }

    /**
     * Deleta um pagamento.
     *
     * @param int $id
     * @return bool
     */
    public function deletar(int $id): bool
    {
        $sql = "DELETE FROM pagamentos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Busca todos os pagamentos.
     *
     * @return array
     */
    public function buscarTodos(): array
    {
        $sql = "SELECT * FROM pagamentos";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}