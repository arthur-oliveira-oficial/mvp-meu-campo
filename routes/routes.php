<?php

use FastRoute\RouteCollector;

return function(RouteCollector $r) {
    // Auth
    $r->addRoute('POST', '/login', ['Src\Controllers\auth\AuthController', 'login']);
    $r->addRoute('POST', '/logout', ['Src\Controllers\auth\AuthController', 'logout']);

    // Avaliacao Consultoria
    $r->addRoute('GET', '/avaliacoes_consultoria', ['Src\Controllers\avaliacao_consultoria\AvaliacaoConsultoriaController', 'index']);
    $r->addRoute('GET', '/avaliacoes_consultoria/{id}', ['Src\Controllers\avaliacao_consultoria\AvaliacaoConsultoriaController', 'show']);
    $r->addRoute('POST', '/avaliacoes_consultoria', ['Src\Controllers\avaliacao_consultoria\AvaliacaoConsultoriaController', 'create']);
    $r->addRoute('PUT', '/avaliacoes_consultoria/{id}', ['Src\Controllers\avaliacao_consultoria\AvaliacaoConsultoriaController', 'update']);
    $r->addRoute('DELETE', '/avaliacoes_consultoria/{id}', ['Src\Controllers\avaliacao_consultoria\AvaliacaoConsultoriaController', 'delete']);

    // Consultor Especialidade
    $r->addRoute('GET', '/consultores_especialidades', ['Src\Controllers\consultor_especialidade\ConsultorEspecialidadeController', 'index']);
    $r->addRoute('GET', '/consultores_especialidades/{id}', ['Src\Controllers\consultor_especialidade\ConsultorEspecialidadeController', 'show']);
    $r->addRoute('POST', '/consultores_especialidades', ['Src\Controllers\consultor_especialidade\ConsultorEspecialidadeController', 'create']);
    $r->addRoute('PUT', '/consultores_especialidades/{id}', ['Src\Controllers\consultor_especialidade\ConsultorEspecialidadeController', 'update']);
    $r->addRoute('DELETE', '/consultores_especialidades/{id}', ['Src\Controllers\consultor_especialidade\ConsultorEspecialidadeController', 'delete']);

    // Consultoria
    $r->addRoute('GET', '/consultorias', ['Src\Controllers\consultoria\ConsultoriaController', 'index']);
    $r->addRoute('GET', '/consultorias/{id}', ['Src\Controllers\consultoria\ConsultoriaController', 'show']);
    $r->addRoute('POST', '/consultorias', ['Src\Controllers\consultoria\ConsultoriaController', 'create']);
    $r->addRoute('PUT', '/consultorias/{id}', ['Src\Controllers\consultoria\ConsultoriaController', 'update']);
    $r->addRoute('DELETE', '/consultorias/{id}', ['Src\Controllers\consultoria\ConsultoriaController', 'delete']);

    // Culturas
    $r->addRoute('GET', '/culturas', ['Src\Controllers\culturas\CulturasController', 'index']);
    $r->addRoute('GET', '/culturas/{id}', ['Src\Controllers\culturas\CulturasController', 'show']);
    $r->addRoute('POST', '/culturas', ['Src\Controllers\culturas\CulturasController', 'create']);
    $r->addRoute('PUT', '/culturas/{id}', ['Src\Controllers\culturas\CulturasController', 'update']);
    $r->addRoute('DELETE', '/culturas/{id}', ['Src\Controllers\culturas\CulturasController', 'delete']);

    // Especialidades
    $r->addRoute('GET', '/especialidades', ['Src\Controllers\especialidades\EspecialidadesController', 'index']);
    $r->addRoute('GET', '/especialidades/{id}', ['Src\Controllers\especialidades\EspecialidadesController', 'show']);
    $r->addRoute('POST', '/especialidades', ['Src\Controllers\especialidades\EspecialidadesController', 'create']);
    $r->addRoute('PUT', '/especialidades/{id}', ['Src\Controllers\especialidades\EspecialidadesController', 'update']);
    $r->addRoute('DELETE', '/especialidades/{id}', ['Src\Controllers\especialidades\EspecialidadesController', 'delete']);

    // Estudos Solo
    $r->addRoute('GET', '/estudos_solo/registrar', ['Src\Controllers\estudos_solo\EstudosSoloController', 'exibirFormularioRegistro']);
    $r->addRoute('POST', '/estudos_solo/registrar', ['Src\Controllers\estudos_solo\EstudosSoloController', 'registrarEstudo']);
    $r->addRoute('GET', '/estudos_solo', ['Src\Controllers\estudos_solo\EstudosSoloController', 'index']);
    $r->addRoute('GET', '/estudos_solo/{id}', ['Src\Controllers\estudos_solo\EstudosSoloController', 'show']);
    $r->addRoute('PUT', '/estudos_solo/{id}', ['Src\Controllers\estudos_solo\EstudosSoloController', 'update']);
    $r->addRoute('DELETE', '/estudos_solo/{id}', ['Src\Controllers\estudos_solo\EstudosSoloController', 'delete']);

    // Lavouras
    $r->addRoute('GET', '/lavouras', ['Src\Controllers\lavouras\LavourasController', 'index']);
    $r->addRoute('GET', '/lavouras/{id}', ['Src\Controllers\lavouras\LavourasController', 'show']);
    $r->addRoute('POST', '/lavouras', ['Src\Controllers\lavouras\LavourasController', 'create']);
    $r->addRoute('PUT', '/lavouras/{id}', ['Src\Controllers\lavouras\LavourasController', 'update']);
    $r->addRoute('DELETE', '/lavouras/{id}', ['Src\Controllers\lavouras\LavourasController', 'delete']);

    // Pagamentos
    $r->addRoute('GET', '/pagamentos', ['Src\Controllers\pagamentos\PagamentosController', 'index']);
    $r->addRoute('GET', '/pagamentos/{id}', ['Src\Controllers\pagamentos\PagamentosController', 'show']);
    $r->addRoute('POST', '/pagamentos', ['Src\Controllers\pagamentos\PagamentosController', 'create']);
    $r->addRoute('PUT', '/pagamentos/{id}', ['Src\Controllers\pagamentos\PagamentosController', 'update']);
    $r->addRoute('DELETE', '/pagamentos/{id}', ['Src\Controllers\pagamentos\PagamentosController', 'delete']);

    // Perfil Admin
    $r->addRoute('GET', '/perfil_admin', ['Src\Controllers\perfil_admin\PerfilAdminController', 'index']);
    $r->addRoute('GET', '/perfil_admin/{id}', ['Src\Controllers\perfil_admin\PerfilAdminController', 'show']);
    $r->addRoute('POST', '/perfil_admin', ['Src\Controllers\perfil_admin\PerfilAdminController', 'create']);
    $r->addRoute('PUT', '/perfil_admin/{id}', ['Src\Controllers\perfil_admin\PerfilAdminController', 'update']);
    $r->addRoute('DELETE', '/perfil_admin/{id}', ['Src\Controllers\perfil_admin\PerfilAdminController', 'delete']);

    // Perfil Agricultor
    $r->addRoute('GET', '/perfil_agricultor', ['Src\Controllers\perfil_agricultor\PerfilAgricultorController', 'index']);
    $r->addRoute('GET', '/perfil_agricultor/{id}', ['Src\Controllers\perfil_agricultor\PerfilAgricultorController', 'show']);
    $r->addRoute('POST', '/perfil_agricultor', ['Src\Controllers\perfil_agricultor\PerfilAgricultorController', 'create']);
    $r->addRoute('PUT', '/perfil_agricultor/{id}', ['Src\Controllers\perfil_agricultor\PerfilAgricultorController', 'update']);
    $r->addRoute('DELETE', '/perfil_agricultor/{id}', ['Src\Controllers\perfil_agricultor\PerfilAgricultorController', 'delete']);

    // Perfil Consultor
    $r->addRoute('GET', '/perfil_consultor', ['Src\Controllers\perfil_consultor\PerfilConsultorController', 'index']);
    $r->addRoute('GET', '/perfil_consultor/{id}', ['Src\Controllers\perfil_consultor\PerfilConsultorController', 'show']);
    $r->addRoute('POST', '/perfil_consultor', ['Src\Controllers\perfil_consultor\PerfilConsultorController', 'create']);
    $r->addRoute('PUT', '/perfil_consultor/{id}', ['Src\Controllers\perfil_consultor\PerfilConsultorController', 'update']);
    $r->addRoute('DELETE', '/perfil_consultor/{id}', ['Src\Controllers\perfil_consultor\PerfilConsultorController', 'delete']);

    // Propriedades
    $r->addRoute('GET', '/propriedades', ['Src\Controllers\propriedades\PropriedadesController', 'index']);
    $r->addRoute('GET', '/propriedades/{id}', ['Src\Controllers\propriedades\PropriedadesController', 'show']);
    $r->addRoute('POST', '/propriedades', ['Src\Controllers\propriedades\PropriedadesController', 'create']);
    $r->addRoute('PUT', '/propriedades/{id}', ['Src\Controllers\propriedades\PropriedadesController', 'update']);
    $r->addRoute('DELETE', '/propriedades/{id}', ['Src\Controllers\propriedades\PropriedadesController', 'delete']);

    // Servicos
    $r->addRoute('GET', '/servicos', ['Src\Controllers\servicos\ServicosController', 'index']);
    $r->addRoute('GET', '/servicos/{id}', ['Src\Controllers\servicos\ServicosController', 'show']);
    $r->addRoute('POST', '/servicos', ['Src\Controllers\servicos\ServicosController', 'create']);
    $r->addRoute('PUT', '/servicos/{id}', ['Src\Controllers\servicos\ServicosController', 'update']);
    $r->addRoute('DELETE', '/servicos/{id}', ['Src\Controllers\servicos\ServicosController', 'delete']);

    // Usuarios
    $r->addRoute('GET', '/usuarios', ['Src\Controllers\usuarios\UsuariosController', 'index']);
    $r->addRoute('GET', '/usuarios/{id}', ['Src\Controllers\usuarios\UsuariosController', 'show']);
    $r->addRoute('POST', '/usuarios', ['Src\Controllers\usuarios\UsuariosController', 'create']);
    $r->addRoute('PUT', '/usuarios/{id}', ['Src\Controllers\usuarios\UsuariosController', 'update']);
    $r->addRoute('DELETE', '/usuarios/{id}', ['Src\Controllers\usuarios\UsuariosController', 'delete']);
};