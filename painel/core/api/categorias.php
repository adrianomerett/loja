<?php
require_once MODELS . 'mcategorias.php';
require_once MODELS . 'msubcategorias.php';
require_once MODELS . 'mprodutos.php';
require_once ROOT_HELPERS . "hloja.php";

if ($acao == 'save-categoria') {
    $retorno = array("status" => true, "msg" => "");
    try {
        $name = App::getPost('namecategoria');
        // Validação
        if (empty($name)) {
            throw new Exception("Informe o nome da categoria!");
        }
        // Verifica se já não está cadastrada
        $mca = new Mcategorias();
        $catedb = $mca->getCategoryByName($name);
        if (count($catedb) > 0) {
            throw new Exception("Já existe uma categoria com o nome {$name}!");
        }
        $dados = array('namecategoria' => $name);
        $insert = $mca->insertCategory($dados);
        if (!is_int($insert)) {
            throw new Exception($insert);
        }
        $retorno['categorias'] = selectcategorias();
        $retorno['status'] = true;
        $retorno['msg'] = "Categoria cadastrada com sucesso!";
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno = array("status" => false, "msg" => $e->getMessage());
        return App::setJson($retorno);
    }
}

// Editar a categoria
if ($acao == 'update-categoria') {
    $retorno = array("status" => false, "msg" => "", "campo" => "");
    try {
        $id = intval(App::getPost('idcategoria'));
        $name = App::getPost('namecategoria');
        // Validação
        if (empty($name)) {
            $retorno['campo'] = 'ncategoria';
            throw new Exception("Informe o nome da categoria!");
        }
        // Verifica se já não está cadastrada
        $mca = new Mcategorias();
        $catedb = $mca->getCategoryByName($name);
        if (count($catedb) > 0) {
            $retorno['campo'] = 'ncategoria';
            throw new Exception("Já existe uma categoria com o nome {$name}!");
        }
        $update = $mca->updateCategoria($id, array('namecategoria' => $name));
        if (!is_int($update)) {
            throw new Exception($update);
        }
        $retorno['status'] = true;
        $retorno['msg'] = "Categoria atualizada com sucesso!";
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
if ($acao == 'get-categorias') {
    $retorno = array("status" => true, "msg" => "", "categorias" => array());
    try {
        $mca = new Mcategorias();
        // Paginação
        $pagina_atal = intval(App::getGet('pagina_atual'));
        $pagina_atal = $pagina_atal < 1 ? 1 : $pagina_atal;
        $por_pagina = intval(App::getGet('por_pagina'));
        $total = $mca->countCategories();
        $offset = ($pagina_atal - 1) * $por_pagina;
        $total_paginas = ceil($total / $por_pagina);
        // Busca os dados
        $categorias = $mca->getCategories($por_pagina, $offset);
        $retorno['categorias'] = $categorias;
        $retorno['paginacao'] = array('pagina_atual' => $pagina_atal, 'total_paginas' => $total_paginas);
        $retorno['status'] = true;
        $retorno['msg'] = "Categorias obtidas com sucesso!";
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno = array("status" => false, "msg" => $e->getMessage());
        return App::setJson($retorno);
    }
}

// Excluir categoria
if ($acao == 'delete-categorias') {
    $retorno = array("status" => false, "msg" => "");
    try {
        $id = intval(App::getPost('id'));
        $mca = new Mcategorias();
        // Verifica se tem produtos vinculados
        $mp = new Mprodutos();
        $produtos = $mp->getProductsByCategory($id);
        if (count($produtos) > 0) {
            throw new Exception("Você não pode exlcuir esta categoria, pois a mesma tem produtos cadastrados vinculados à ela!");
        }
        // Verifica se tem subcategorias vinculadas
        $msbc = new Msubcategorias();
        $subcategorias = $msbc->getSubCategoryByCategoriaId($id);
        if (count($subcategorias) > 0) {
            throw new Exception("Você não pode exlcuir esta categoria, pois a mesma tem subcategorias cadastradas vinculadas à ela!");
        }
        $delete = $mca->deleteCategory($id);
        if (!is_int($delete)) {
            throw new Exception($delete);
        }
        $retorno['status'] = true;
        $retorno['msg'] = "Categoria excluída com sucesso!";
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
