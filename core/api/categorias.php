<?php
require_once MODELS . 'mcategorias.php';
require_once MODELS . 'msubcategorias.php';
require_once MODELS . 'mfavoritos.php';

// Listar produtos por categorias 
if ($pagina == 'categorias' && $acao == 'listar') {
    $retorno = array("status" => false, "msg" => "", "dados" => array(), "dafavoritos" => array());
    try {
        $mca = new Categorias();
        $categoriaid = intval(App::getGet('categoriaid'));
        // Paginação
        $pagina_atal = intval(App::getGet('pagina_atual'));
        $pagina_atal = $pagina_atal < 1 ? 1 : $pagina_atal;
        $por_pagina = intval(App::getGet('por_pagina'));
        $clienteid = intval(App::getGet('clienteid'));
        $total = $mca->countProductsGetByCategoria($categoriaid);
        $offset = ($pagina_atal - 1) * $por_pagina;
        $total_paginas = ceil($total / $por_pagina);
        $dados = $mca->getProductsByCategoria($categoriaid, $por_pagina, $offset);
        $retorno['paginacao'] = array('pagina_atual' => $pagina_atal, 'total_paginas' => $total_paginas);
        $retorno['dados'] = $dados;
        // buscar os favoritos
        $mf = new Favoritos();
        $favoritos = $mf->getFavoritosByClient($clienteid);
        $retorno['dafavoritos'] = $favoritos;
        $retorno['status'] = true;
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}

// Buscar as categorias e suas subcategorias para o App
if ($pagina == 'categorias' && $acao == 'getcategorias') {
    $retorno = array("status" => false, "msg" => "", "dados" => array());
    try {
        $mca = new Categorias();
        $msca = new SubCategorias();
        $getcate = $mca->getCategorias();
        $categorias = array();
        foreach ($getcate as $keyc => $valuec) {
            $subcategorias = $msca->getSubcategoriasByIdCategoria($valuec->categoriaid);
            $categorias[$valuec->categoriaid]['id'] = array(
                'categoriaid' => $valuec->categoriaid,
                'iconcategoria' => $valuec->iconcategoria,
                'namecategoria' => $valuec->namecategoria,
                'subcategorias' => $subcategorias
            );
        }
        $retorno['status'] = true;
        $retorno['dados'] = $categorias;
        return  App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
