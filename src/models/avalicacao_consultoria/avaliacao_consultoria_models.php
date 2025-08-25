<?php

namespace Src\Models\AvaliacaoConsultoria;

use PDO;

/**
 * Classe AvaliacaoConsultoriaModel
 *
 * Esta classe é responsável por interagir com a tabela `avaliacao_consultoria` no banco de dados.
 * Ela fornece métodos para criar, ler, atualizar e deletar avaliações de consultoria.
 */
class AvaliacaoConsultoriaModel
{
    /**
     * @var PDO A instância da conexão PDO.
     */
    private $pdo;

    /**
     * Construtor da classe.
     *
     * @param PDO $pdo A instância da conexão PDO.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Cria uma nova avaliação de consultoria.
     *
     * @param array $dados Os dados da avaliação a serem inseridos.
     * @return int O ID da avaliação recém-criada.
     */
    public function criar(array $dados): int
    {
        $sql = "INSERT INTO avaliacao_consultoria (consultoria_id, nota, comentario) VALUES (:consultoria_id, :nota, :comentario)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($dados);
        return $this->pdo->lastInsertId();
    }

    /**
     * Busca uma avaliação de consultoria pelo seu ID.
     *
     * @param int $id O ID da avaliação a ser buscada.
     * @return array|null Os dados da avaliação ou null se não for encontrada.
     */
    public function buscar(int $id): ?array
    {
        $sql = "SELECT * FROM avaliacao_consultoria WHERE id = :id AND deletado_em IS NULL";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }

    /**
     * Atualiza uma avaliação de consultoria existente.
     *
     * @param int $id O ID da avaliação a ser atualizada.
     * @param array $dados Os novos dados da avaliação.
     * @return bool True se a atualização for bem-sucedida, false caso contrário.
     */
    public function atualizar(int $id, array $dados): bool
    {
        $sql = "UPDATE avaliacao_consultoria SET consultoria_id = :consultoria_id, nota = :nota, comentario = :comentario WHERE id = :id";
        $dados['id'] = $id;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($dados);
    }

    /**
     * "Deleta" uma avaliação de consultoria (soft delete).
     *
     * @param int $id O ID da avaliação a ser deletada.
     * @return bool True se a operação for bem-sucedida, false caso contrário.
     */
    public function deletar(int $id): bool
    {
        $sql = "UPDATE avaliacao_consultoria SET deletado_em = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Busca todas as avaliações de consultoria não deletadas.
     *
     * @return array Um array com todas as avaliações.
     */
    public function buscarTodos(): array
    {
        $sql = "SELECT * FROM avaliacao_consultoria WHERE deletado_em IS NULL";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}