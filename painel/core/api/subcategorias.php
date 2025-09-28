<?php
require_once ROOT_CORE . "models/mcategorias.php";
require_once ROOT_CORE . "models/msubcategorias.php";
require_once ROOT_HELPERS . "hloja.php";

// Buscar Subcategorias
if ($acao == 'get-subcategorias') {
    $retorno = array("status" => true, "msg" => "");
    try {
        $idcategoria = App::getPost('idcategoria');
        $retorno['subcategorias'] = selectsubcategorias($idcategoria);
        $retorno['status'] = true;
        $retorno['msg'] = "Subcategorias cadastradas com sucesso!";
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno = array("status" => false, "msg" => $e->getMessage());
        return App::setJson($retorno);
    }
}

// Salvar Subcategorias
if ($acao == 'save-subcategoria') {
    $retorno = array("status" => true, "msg" => "");
    try {
        $msca = new Msubcategorias();
        $idcategoria = App::getPost('idcategoria');
        $namesubcategoria = App::getPost('ncsubcategoria');
        if (empty($namesubcategoria)) {
            throw new Exception("Informe o nome da subcategoria!");
        }
        $subcategoriadb = $msca->getSubCategoriesByName(App::getPost($namesubcategoria));
        $retorno['teste'] = count($subcategoriadb);
        if (count($subcategoriadb) > 0) {
            throw new Exception("Já existe uma subcategoria com o nome {$namesubcategoria}!");
        }
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno = array("status" => false, "msg" => $e->getMessage());
        return App::setJson($retorno);
    }
}
