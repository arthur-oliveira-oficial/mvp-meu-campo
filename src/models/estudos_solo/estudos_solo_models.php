<?php

namespace Src\Models\EstudosSolo;

require_once __DIR__ . '/../BaseModel.php';

use Src\Models\BaseModel;

class EstudosSoloModel extends BaseModel
{
    protected $table = 'estudos_solo';

    /**
     * Busca o nome da propriedade com base no ID da lavoura.
     *
     * @param int $id_lavoura O ID da lavoura.
     * @return string|false O nome da propriedade ou false se não encontrado.
     */
    public function buscarNomePropriedadePorLavouraId(int $id_lavoura)
    {
        $sql = "SELECT p.nome FROM propriedades p
                JOIN lavouras l ON p.id = l.id_propriedade
                WHERE l.id = :id_lavoura";
        
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id_lavoura' => $id_lavoura]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado ? $resultado['nome'] : false;
        } catch (PDOException $e) {
            // Logar o erro
            return false;
        }
    }
}
