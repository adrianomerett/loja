<?php
require_once ROOT_CORE . "models/mcategorias.php";
require_once ROOT_CORE . "models/msubcategorias.php";
require_once ROOT_CORE . "models/mprodutos.php";
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

// Listar Subcategorias
if ($acao == 'get-list-subcategorias') {
    $retorno = array("status" => false, "msg" => "", "subcategorias" => array());
    try {
        $msca = new Msubcategorias();
        // Paginação
        $pagina_atal = intval(App::getGet('pagina_atual'));
        $pagina_atal = $pagina_atal < 1 ? 1 : $pagina_atal;
        $por_pagina = intval(App::getGet('por_pagina'));
        $total = $msca->countListSubCategories();
        $offset = ($pagina_atal - 1) * $por_pagina;
        $total_paginas = ceil($total / $por_pagina);
        // Busca os dados
        $subcategorias = $msca->getListSubCategorias($por_pagina, $offset);
        $retorno['subcategorias'] = $subcategorias;
        $retorno['paginacao'] = array('pagina_atual' => $pagina_atal, 'total_paginas' => $total_paginas);
        $retorno['status'] = true;
        $retorno['msg'] = "Subcategorias obtidas com sucesso!";
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}

// Update Subcategorias 
if ($acao == 'update-subcategoria') {
    $retorno = array("status" => false, "msg" => "", "campo" => "");
    try {
        $msca = new Msubcategorias();
        $id = intval(App::getPost('id'));
        $name = App::getPost('name');
        // Verifica se já não está cadastrada
        $mscb = new Msubcategorias();
        $subcategoriadb = $mscb->getSubCategoryByName($name);
        if (count($subcategoriadb) > 0) {
            $retorno['campo'] = 'ncsubcategoria';
            throw new Exception("Já existe uma subcategoria com o nome {$name}!");
        }
        // Validação
        if (empty($name)) {
            $retorno['campo'] = 'ncsubcategoria';
            throw new Exception("Informe o nome da subcategoria!");
        }
        $update = $msca->updateSubCategory($id, array('namesubcategoria' => $name));
        if (!is_int($update)) {
            throw new Exception($update);
        }
        $retorno['status'] = true;
        $retorno['msg'] = "Subcategoria atualizada com sucesso!";
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}

// Excluir subcategoria
if ($acao == 'delete-subcategorias') {
    $retorno = array("status" => false, "msg" => "");
    try {
        $id = intval(App::getPost('id'));
        // Verifica se tem produtos vinculados
        $mp = new Mprodutos();
        $produtos = $mp->getProductsBySubcategoryId($id);
        if (count($produtos) > 0) {
            throw new Exception("Você não pode exlcuir esta subcategoria, pois a mesma tem produtos cadastrados vinculados à ela!");
        }
        $msca = new Msubcategorias();
        $delete = $msca->deleteSubCategory($id);
        if (!is_int($delete)) {
            throw new Exception($delete);
        }
        $retorno['status'] = true;
        $retorno['msg'] = "Subcategoria excluída com sucesso!";
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
