<?php

namespace Src\Controllers\ConsultorEspecialidade;

use Src\Models\ConsultorEspecialidade\ConsultorEspecialidadeModel;

class ConsultorEspecialidadeController
{
    protected $model;

    /**
     * Construtor do controlador.
     *
     * @param ConsultorEspecialidadeModel $model O modelo de consultor especialidade.
     */
    public function __construct(ConsultorEspecialidadeModel $model)
    {
        $this->model = $model;
    }

    /**
     * Lista todas as especialidades de consultores.
     *
     * @return void
     */
    public function listarTodos()
    {
        $registros = $this->model->buscarTodos();
        // Aqui você chamaria a view para renderizar os registros.
    }

    /**
     * Busca um registro pelo ID.
     *
     * @param int $id O ID do registro.
     * @return void
     */
    public function buscarPorId(int $id)
    {
        $registro = $this->model->buscarPorId($id);
        // Aqui você chamaria a view para renderizar o registro.
    }

    /**
     * Cria um novo registro de especialidade para um consultor.
     *
     * @return void
     */
    public function criar()
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'id_consultor' => 1, // Exemplo
            'id_especialidade' => 1 // Exemplo
        ];
        $this->model->criar($dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Deleta um registro de especialidade de um consultor.
     *
     * @param int $id O ID do registro.
     * @return void
     */
    public function deletar(int $id)
    {
        $this->model->deletar($id);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }
}
