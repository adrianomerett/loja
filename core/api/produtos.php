<?php
require_once MODELS . 'mproducts.php';
require_once MODELS . 'mimg.php';
$mp = new Produtos();

// Listar todos os produtos
if ($pagina == 'produtos' && $acao == 'listar') {
    $retorno = array("status" => false, "msg" => "", "dados" => array());
    try {
        // Paginação
        $pagina_atual = intval(App::getGet('pagina_atual'));
        $pagina_atual = $pagina_atual < 1 ? 1 : $pagina_atual;
        $por_pagina = intval(App::getGet('por_pagina'));
        $total = $mp->countProductsAll();
        $offset = ($pagina_atual - 1) * $por_pagina;
        $total_paginas = ceil($total / $por_pagina);
        // Dados
        $dados = $mp->getAllProducts($por_pagina, $offset);
        $retorno['paginacao'] = array('pagina_atual' => $pagina_atual, 'total_paginas' => $total_paginas);
        $retorno['dados'] = $dados;
        $retorno['status'] = true;
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}

// Buscar os produtos
if ($pagina == 'produtos' && $acao == 'search') {
    $retorno = array("status" => false, "msg" => "", "dados" => array());
    try {
        $busca = App::getGet('busca');
        // Paginação
        $pagina_atual = intval(App::getGet('pagina_atual'));
        $pagina_atual = $pagina_atual < 1 ? 1 : $pagina_atual;
        $por_pagina = intval(App::getGet('por_pagina'));
        $total = $mp->countProductsSearch($busca);
        $offset = ($pagina_atual - 1) * $por_pagina;
        $total_paginas = ceil($total / $por_pagina);
        // Dados
        $dados = $mp->getProductsBySearch($busca, $por_pagina, $offset);
        $retorno['dados'] = $dados;
        $retorno['paginacao'] = array('pagina_atual' => $pagina_atual, 'total_paginas' => $total_paginas);
        $retorno['dados'] = $dados;
        $retorno['status'] = true;
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}

// Pega os dados do produto pelo id para detalhes
if ($pagina == 'produtos' && $acao == 'detalhes') {
    $retorno = array(
        "status" => false,
        "msg" => "",
        "dados" => array(),
        "rel" => array(),
        "images" => array()
    );
    try {
        $productid = intval(App::getGet('productid'));
        $categoriaid = intval(App::getGet('categoriaid'));
        $mi = new Imagens();
        $mp = new Produtos();
        $dados = $mp->getProductById($productid);
        $images = $mi->getImgByIdProduct($productid);
        $relacionados = $mp->getProductsRellByCategory($productid, $categoriaid, 12, 0);
        $retorno['dados'] = $dados;
        $retorno['images'] = $images;
        $retorno['rel'] = $relacionados;
        $retorno['status'] = true;
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
