<?php

namespace Src\Models\Auth;

require_once __DIR__ . '/../BaseModel.php';

use Src\Models\BaseModel;

class AuthModel extends BaseModel
{
    protected $table = 'usuarios';

    /**
     * Busca um usuário pelo email.
     *
     * @param string $email O email do usuário.
     * @return array|false O usuário encontrado ou false se não encontrado.
     */
    public function buscarPorEmail(string $email)
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email AND deletado_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
