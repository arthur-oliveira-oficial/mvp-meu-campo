<?php

use FastRoute\RouteCollector;

return function(RouteCollector $r) {
    // Auth
    $r->addRoute('POST', '/login', ['App\controllers\auth\AuthController', 'login']);
    $r->addRoute('POST', '/logout', ['App\controllers\auth\AuthController', 'logout']);

    // Avaliacao Consultoria
    $r->addRoute('GET', '/avaliacoes_consultoria', ['App\controllers\avaliacao_consultoria\AvaliacaoConsultoriaController', 'index']);
    $r->addRoute('GET', '/avaliacoes_consultoria/{id}', ['App\controllers\avaliacao_consultoria\AvaliacaoConsultoriaController', 'show']);
    $r->addRoute('POST', '/avaliacoes_consultoria', ['App\controllers\avaliacao_consultoria\AvaliacaoConsultoriaController', 'create']);
    $r->addRoute('PUT', '/avaliacoes_consultoria/{id}', ['App\controllers\avaliacao_consultoria\AvaliacaoConsultoriaController', 'update']);
    $r->addRoute('DELETE', '/avaliacoes_consultoria/{id}', ['App\controllers\avaliacao_consultoria\AvaliacaoConsultoriaController', 'delete']);

    // Consultor Especialidade
    $r->addRoute('GET', '/consultores_especialidades', ['App\controllers\consultor_especialidade\ConsultorEspecialidadeController', 'index']);
    $r->addRoute('GET', '/consultores_especialidades/{id}', ['App\controllers\consultor_especialidade\ConsultorEspecialidadeController', 'show']);
    $r->addRoute('POST', '/consultores_especialidades', ['App\controllers\consultor_especialidade\ConsultorEspecialidadeController', 'create']);
    $r->addRoute('PUT', '/consultores_especialidades/{id}', ['App\controllers\consultor_especialidade\ConsultorEspecialidadeController', 'update']);
    $r->addRoute('DELETE', '/consultores_especialidades/{id}', ['App\controllers\consultor_especialidade\ConsultorEspecialidadeController', 'delete']);

    // Consultoria
    $r->addRoute('GET', '/consultorias', ['App\controllers\consultoria\ConsultoriaController', 'index']);
    $r->addRoute('GET', '/consultorias/{id}', ['App\controllers\consultoria\ConsultoriaController', 'show']);
    $r->addRoute('POST', '/consultorias', ['App\controllers\consultoria\ConsultoriaController', 'create']);
    $r->addRoute('PUT', '/consultorias/{id}', ['App\controllers\consultoria\ConsultoriaController', 'update']);
    $r->addRoute('DELETE', '/consultorias/{id}', ['App\controllers\consultoria\ConsultoriaController', 'delete']);

    // Culturas
    $r->addRoute('GET', '/culturas', ['App\controllers\culturas\CulturasController', 'index']);
    $r->addRoute('GET', '/culturas/{id}', ['App\controllers\culturas\CulturasController', 'show']);
    $r->addRoute('POST', '/culturas', ['App\controllers\culturas\CulturasController', 'create']);
    $r->addRoute('PUT', '/culturas/{id}', ['App\controllers\culturas\CulturasController', 'update']);
    $r->addRoute('DELETE', '/culturas/{id}', ['App\controllers\culturas\CulturasController', 'delete']);

    // Especialidades
    $r->addRoute('GET', '/especialidades', ['App\controllers\especialidades\EspecialidadesController', 'index']);
    $r->addRoute('GET', '/especialidades/{id}', ['App\controllers\especialidades\EspecialidadesController', 'show']);
    $r->addRoute('POST', '/especialidades', ['App\controllers\especialidades\EspecialidadesController', 'create']);
    $r->addRoute('PUT', '/especialidades/{id}', ['App\controllers\especialidades\EspecialidadesController', 'update']);
    $r->addRoute('DELETE', '/especialidades/{id}', ['App\controllers\especialidades\EspecialidadesController', 'delete']);

    // Estudos Solo
    $r->addRoute('GET', '/estudos_solo', ['App\controllers\estudos_solo\EstudosSoloController', 'index']);
    $r->addRoute('GET', '/estudos_solo/{id}', ['App\controllers\estudos_solo\EstudosSoloController', 'show']);
    $r->addRoute('POST', '/estudos_solo', ['App\controllers\estudos_solo\EstudosSoloController', 'create']);
    $r->addRoute('PUT', '/estudos_solo/{id}', ['App\controllers\estudos_solo\EstudosSoloController', 'update']);
    $r->addRoute('DELETE', '/estudos_solo/{id}', ['App\controllers\estudos_solo\EstudosSoloController', 'delete']);

    // Lavouras
    $r->addRoute('GET', '/lavouras', ['App\controllers\lavouras\LavourasController', 'index']);
    $r->addRoute('GET', '/lavouras/{id}', ['App\controllers\lavouras\LavourasController', 'show']);
    $r->addRoute('POST', '/lavouras', ['App\controllers\lavouras\LavourasController', 'create']);
    $r->addRoute('PUT', '/lavouras/{id}', ['App\controllers\lavouras\LavourasController', 'update']);
    $r->addRoute('DELETE', '/lavouras/{id}', ['App\controllers\lavouras\LavourasController', 'delete']);

    // Pagamentos
    $r->addRoute('GET', '/pagamentos', ['App\controllers\pagamentos\PagamentosController', 'index']);
    $r->addRoute('GET', '/pagamentos/{id}', ['App\controllers\pagamentos\PagamentosController', 'show']);
    $r->addRoute('POST', '/pagamentos', ['App\controllers\pagamentos\PagamentosController', 'create']);
    $r->addRoute('PUT', '/pagamentos/{id}', ['App\controllers\pagamentos\PagamentosController', 'update']);
    $r->addRoute('DELETE', '/pagamentos/{id}', ['App\controllers\pagamentos\PagamentosController', 'delete']);

    // Perfil Admin
    $r->addRoute('GET', '/perfil_admin', ['App\controllers\perfil_admin\PerfilAdminController', 'index']);
    $r->addRoute('GET', '/perfil_admin/{id}', ['App\controllers\perfil_admin\PerfilAdminController', 'show']);
    $r->addRoute('POST', '/perfil_admin', ['App\controllers\perfil_admin\PerfilAdminController', 'create']);
    $r->addRoute('PUT', '/perfil_admin/{id}', ['App\controllers\perfil_admin\PerfilAdminController', 'update']);
    $r->addRoute('DELETE', '/perfil_admin/{id}', ['App\controllers\perfil_admin\PerfilAdminController', 'delete']);

    // Perfil Agricultor
    $r->addRoute('GET', '/perfil_agricultor', ['App\controllers\perfil_agricultor\PerfilAgricultorController', 'index']);
    $r->addRoute('GET', '/perfil_agricultor/{id}', ['App\controllers\perfil_agricultor\PerfilAgricultorController', 'show']);
    $r->addRoute('POST', '/perfil_agricultor', ['App\controllers\perfil_agricultor\PerfilAgricultorController', 'create']);
    $r->addRoute('PUT', '/perfil_agricultor/{id}', ['App\controllers\perfil_agricultor\PerfilAgricultorController', 'update']);
    $r->addRoute('DELETE', '/perfil_agricultor/{id}', ['App\controllers\perfil_agricultor\PerfilAgricultorController', 'delete']);

    // Perfil Consultor
    $r->addRoute('GET', '/perfil_consultor', ['App\controllers\perfil_consultor\PerfilConsultorController', 'index']);
    $r->addRoute('GET', '/perfil_consultor/{id}', ['App\controllers\perfil_consultor\PerfilConsultorController', 'show']);
    $r->addRoute('POST', '/perfil_consultor', ['App\controllers\perfil_consultor\PerfilConsultorController', 'create']);
    $r->addRoute('PUT', '/perfil_consultor/{id}', ['App\controllers\perfil_consultor\PerfilConsultorController', 'update']);
    $r->addRoute('DELETE', '/perfil_consultor/{id}', ['App\controllers\perfil_consultor\PerfilConsultorController', 'delete']);

    // Propriedades
    $r->addRoute('GET', '/propriedades', ['App\controllers\propriedades\PropriedadesController', 'index']);
    $r->addRoute('GET', '/propriedades/{id}', ['App\controllers\propriedades\PropriedadesController', 'show']);
    $r->addRoute('POST', '/propriedades', ['App\controllers\propriedades\PropriedadesController', 'create']);
    $r->addRoute('PUT', '/propriedades/{id}', ['App\controllers\propriedades\PropriedadesController', 'update']);
    $r->addRoute('DELETE', '/propriedades/{id}', ['App\controllers\propriedades\PropriedadesController', 'delete']);

    // Servicos
    $r->addRoute('GET', '/servicos', ['App\controllers\servicos\ServicosController', 'index']);
    $r->addRoute('GET', '/servicos/{id}', ['App\controllers\servicos\ServicosController', 'show']);
    $r->addRoute('POST', '/servicos', ['App\controllers\servicos\ServicosController', 'create']);
    $r->addRoute('PUT', '/servicos/{id}', ['App\controllers\servicos\ServicosController', 'update']);
    $r->addRoute('DELETE', '/servicos/{id}', ['App\controllers\servicos\ServicosController', 'delete']);

    // Usuarios
    $r->addRoute('GET', '/usuarios', ['App\controllers\usuarios\UsuariosController', 'index']);
    $r->addRoute('GET', '/usuarios/{id}', ['App\controllers\usuarios\UsuariosController', 'show']);
    $r->addRoute('POST', '/usuarios', ['App\controllers\usuarios\UsuariosController', 'create']);
    $r->addRoute('PUT', '/usuarios/{id}', ['App\controllers\usuarios\UsuariosController', 'update']);
    $r->addRoute('DELETE', '/usuarios/{id}', ['App\controllers\usuarios\UsuariosController', 'delete']);
};
