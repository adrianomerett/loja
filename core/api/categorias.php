<?php
require_once MODELS . 'mcategorias.php';
$mca = new Categorias();

if ($acao == 'listar') {
    $retorno = array("status" => true, "msg" => "", "dados" => array());
    try {
        $categoriaid = intval(App::getGet('categoriaid'));
        $retorno['categoriaid'] = $categoriaid;
        $dados = $mca->getProductsBtCategoria($categoriaid);
        $retorno['dados'] = $dados;
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
