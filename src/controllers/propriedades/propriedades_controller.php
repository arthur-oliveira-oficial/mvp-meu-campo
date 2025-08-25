<?php

namespace Src\Controllers\Propriedades;

use Src\Models\Propriedades\PropriedadesModel;

class PropriedadesController
{
    protected $model;

    /**
     * Construtor do controlador.
     *
     * @param PropriedadesModel $model O modelo de propriedades.
     */
    public function __construct(PropriedadesModel $model)
    {
        $this->model = $model;
    }

    /**
     * Lista todas as propriedades.
     *
     * @return void
     */
    public function listarTodos()
    {
        $propriedades = $this->model->buscarTodos();
        // Aqui você chamaria a view para renderizar as propriedades.
    }

    /**
     * Busca uma propriedade pelo ID.
     *
     * @param int $id O ID da propriedade.
     * @return void
     */
    public function buscarPorId(int $id)
    {
        $propriedade = $this->model->buscarPorId($id);
        // Aqui você chamaria a view para renderizar a propriedade.
    }

    /**
     * Cria uma nova propriedade.
     *
     * @return void
     */
    public function criar()
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'nome' => 'Nova Propriedade',
            'id_agricultor' => 1, // Exemplo
            'tamanho_ha' => 100,
            'localizacao' => 'Localização da nova propriedade'
        ];
        $this->model->criar($dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Atualiza uma propriedade existente.
     *
     * @param int $id O ID da propriedade.
     * @return void
     */
    public function atualizar(int $id)
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'nome' => 'Propriedade Atualizada'
        ];
        $this->model->atualizar($id, $dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Deleta uma propriedade.
     *
     * @param int $id O ID da propriedade.
     * @return void
     */
    public function deletar(int $id)
    {
        $this->model->deletar($id);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }
}
