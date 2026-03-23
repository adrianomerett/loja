<?php
require_once MODELS . 'mconfig.php';

// Buscar as configurações do sistema
if ($pagina == 'config' && $acao == 'getconfig') {
    $retorno = array("status" => false, "msg" => "", "dados" => array());
    try {
        $mcfg = new Config();
        $dados = $mcfg->getConfig();
        $retorno['status'] = true;
        $retorno['dados'] = $dados;
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
