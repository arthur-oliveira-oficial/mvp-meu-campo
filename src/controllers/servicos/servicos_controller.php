<?php

namespace Src\Controllers\Servicos;

use Src\Models\Servicos\ServicosModel;

class ServicosController
{
    protected $model;

    /**
     * Construtor do controlador.
     *
     * @param ServicosModel $model O modelo de serviços.
     */
    public function __construct(ServicosModel $model)
    {
        $this->model = $model;
    }

    /**
     * Lista todos os serviços.
     *
     * @return void
     */
    public function listarTodos()
    {
        $servicos = $this->model->buscarTodos();
        // Aqui você chamaria a view para renderizar os serviços.
    }

    /**
     * Busca um serviço pelo ID.
     *
     * @param int $id O ID do serviço.
     * @return void
     */
    public function buscarPorId(int $id)
    {
        $servico = $this->model->buscarPorId($id);
        // Aqui você chamaria a view para renderizar o serviço.
    }

    /**
     * Cria um novo serviço.
     *
     * @return void
     */
    public function criar()
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'nome' => 'Novo Serviço',
            'descricao' => 'Descrição do novo serviço'
        ];
        $this->model->criar($dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Atualiza um serviço existente.
     *
     * @param int $id O ID do serviço.
     * @return void
     */
    public function atualizar(int $id)
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'nome' => 'Serviço Atualizado'
        ];
        $this->model->atualizar($id, $dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Deleta um serviço.
     *
     * @param int $id O ID do serviço.
     * @return void
     */
    public function deletar(int $id)
    {
        $this->model->deletar($id);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }
}
