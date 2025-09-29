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

    try {
        $retorno = array("status" => false, "msg" => "", "campo" => "");
        $msca = new Msubcategorias();
        $idcategoria = intval(App::getPost('idcategoria'));
        $namesubcategoria = trim(App::getPost('ncsubcategoria'));
        if ($idcategoria == 0) {
            $retorno['campo'] = 'nscategoria';
            throw new Exception("Informe a categoria pai!");
        }
        if (empty($namesubcategoria)) {
            $retorno['campo'] = 'ncsubcategoria';
            throw new Exception("Informe o nome da subcategoria!");
        }
        $subcategoriadb = $msca->getSubCategoriesByName($namesubcategoria);
        if (count($subcategoriadb) > 0) {
            $retorno['campo'] = 'ncsubcategoria';
            throw new Exception("Já existe uma subcategoria com o nome {$namesubcategoria}!");
        }
        // Cadastra a subcategoria
        $dados = array('idcategoria' => $idcategoria, 'namesubcategoria' => $namesubcategoria);
        $insert = $msca->insertSubCategory($dados);
        if ($insert > 0) {
            $retorno['subactegorias'] = selectsubcategorias($idcategoria);
            $retorno['status'] = true;
            $retorno['msg'] = "Subcategoria cadastrada com sucesso!";
        } else {
            throw new Exception("Erro ao cadastrar a subcategoria!");
        }
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
