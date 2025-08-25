<?php

namespace Src\Controllers\Consultoria;

use Src\Models\Consultoria\ConsultoriaModel;

class ConsultoriaController
{
    protected $model;

    /**
     * Construtor do controlador.
     *
     * @param ConsultoriaModel $model O modelo de consultoria.
     */
    public function __construct(ConsultoriaModel $model)
    {
        $this->model = $model;
    }

    /**
     * Lista todas as consultorias.
     *
     * @return void
     */
    public function listarTodos()
    {
        $consultorias = $this->model->buscarTodos();
        // Aqui você chamaria a view para renderizar as consultorias.
    }

    /**
     * Busca uma consultoria pelo ID.
     *
     * @param int $id O ID da consultoria.
     * @return void
     */
    public function buscarPorId(int $id)
    {
        $consultoria = $this->model->buscarPorId($id);
        // Aqui você chamaria a view para renderizar a consultoria.
    }

    /**
     * Cria uma nova consultoria.
     *
     * @return void
     */
    public function criar()
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'id_agricultor' => 1, // Exemplo
            'id_consultor' => 1, // Exemplo
            'id_lavoura' => 1, // Exemplo
            'data_inicio' => date('Y-m-d'),
            'data_fim' => null,
            'status' => 'em_andamento'
        ];
        $this->model->criar($dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Atualiza uma consultoria existente.
     *
     * @param int $id O ID da consultoria.
     * @return void
     */
    public function atualizar(int $id)
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'status' => 'concluida'
        ];
        $this->model->atualizar($id, $dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Deleta uma consultoria.
     *
     * @param int $id O ID da consultoria.
     * @return void
     */
    public function deletar(int $id)
    {
        $this->model->deletar($id);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }
}
