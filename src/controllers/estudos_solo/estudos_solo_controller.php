<?php

namespace Src\Controllers\EstudosSolo;

use Src\Models\EstudosSolo\EstudosSoloModel;

class EstudosSoloController
{
    protected $model;

    /**
     * Construtor do controlador.
     *
     * @param EstudosSoloModel $model O modelo de estudos de solo.
     */
    public function __construct(EstudosSoloModel $model)
    {
        $this->model = $model;
    }

    /**
     * Lista todos os estudos de solo.
     *
     * @return void
     */
    public function listarTodos()
    {
        $estudos = $this->model->buscarTodos();
        // Aqui você chamaria a view para renderizar os estudos.
    }

    /**
     * Busca um estudo de solo pelo ID.
     *
     * @param int $id O ID do estudo.
     * @return void
     */
    public function buscarPorId(int $id)
    {
        $estudo = $this->model->buscarPorId($id);
        // Aqui você chamaria a view para renderizar o estudo.
    }

    /**
     * Cria um novo estudo de solo.
     *
     * @return void
     */
    public function criar()
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'id_lavoura' => 1, // Exemplo
            'data_estudo' => date('Y-m-d'),
            'ph' => 6.5,
            'nitrogenio' => 10,
            'fosforo' => 20,
            'potassio' => 30,
            'calcio' => 40,
            'magnesio' => 50,
            'enxofre' => 60,
            'boro' => 0.5,
            'cobre' => 1,
            'ferro' => 2,
            'manganes' => 3,
            'zinco' => 4
        ];
        $this->model->criar($dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Atualiza um estudo de solo existente.
     *
     * @param int $id O ID do estudo.
     * @return void
     */
    public function atualizar(int $id)
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'ph' => 6.8
        ];
        $this->model->atualizar($id, $dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Deleta um estudo de solo.
     *
     * @param int $id O ID do estudo.
     * @return void
     */
    public function deletar(int $id)
    {
        $this->model->deletar($id);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }
}
