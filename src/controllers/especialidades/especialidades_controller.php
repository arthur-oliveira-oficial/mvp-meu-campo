<?php

namespace Src\Controllers\Especialidades;

use Src\Models\Especialidades\EspecialidadesModel;

class EspecialidadesController
{
    protected $model;

    /**
     * Construtor do controlador.
     *
     * @param EspecialidadesModel $model O modelo de especialidades.
     */
    public function __construct(EspecialidadesModel $model)
    {
        $this->model = $model;
    }

    /**
     * Lista todas as especialidades.
     *
     * @return void
     */
    public function listarTodos()
    {
        $especialidades = $this->model->buscarTodos();
        // Aqui você chamaria a view para renderizar as especialidades.
    }

    /**
     * Busca uma especialidade pelo ID.
     *
     * @param int $id O ID da especialidade.
     * @return void
     */
    public function buscarPorId(int $id)
    {
        $especialidade = $this->model->buscarPorId($id);
        // Aqui você chamaria a view para renderizar a especialidade.
    }

    /**
     * Cria uma nova especialidade.
     *
     * @return void
     */
    public function criar()
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'nome' => 'Nova Especialidade'
        ];
        $this->model->criar($dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Atualiza uma especialidade existente.
     *
     * @param int $id O ID da especialidade.
     * @return void
     */
    public function atualizar(int $id)
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'nome' => 'Especialidade Atualizada'
        ];
        $this->model->atualizar($id, $dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Deleta uma especialidade.
     *
     * @param int $id O ID da especialidade.
     * @return void
     */
    public function deletar(int $id)
    {
        $this->model->deletar($id);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }
}
