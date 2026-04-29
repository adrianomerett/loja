<?php
require_once MODELS . 'mproducts.php';
require_once MODELS . 'mimg.php';
require_once MODELS . 'mfavoritos.php';
require_once MODELS . 'mconfig.php';
require_once MODELS . 'mcategorias.php';

$mp = new Produtos();

// Listar todos os produtos
if ($pagina == 'produtos' && $acao == 'listar') {
    $retorno = array("status" => false, "msg" => "", "dados" => array(), "favoritos" => array());
    try {
        // Paginação
        $pagina_atual = intval(App::getGet('pagina_atual'));
        $pagina_atual = $pagina_atual < 1 ? 1 : $pagina_atual;
        $por_pagina = intval(App::getGet('por_pagina'));
        $clienteid = intval(App::getGet('clienteid'));
        $total = $mp->countProductsAll();
        $offset = ($pagina_atual - 1) * $por_pagina;
        $total_paginas = ceil($total / $por_pagina);
        // Dados
        $dados = $mp->getAllProducts($por_pagina, $offset);
        $retorno['paginacao'] = array('pagina_atual' => $pagina_atual, 'total_paginas' => $total_paginas);
        $retorno['dados'] = $dados;
        // buscar os favoritos
        $mf = new Favoritos();
        $favoritos = $mf->getFavoritosByClient($clienteid);
        $retorno['favoritos'] = $favoritos;
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
        "images" => array(),
        "dafavoritos" => array()
    );
    try {
        $productid = intval(App::getGet('productid'));
        $categoriaid = intval(App::getGet('categoriaid'));
        $clienteid = intval(App::getGet('clienteid'));
        $mi = new Imagens();
        $dados = $mp->getProductById($productid);
        $images = $mi->getImgByIdProduct($productid);
        $relacionados = $mp->getProductsRellByCategory($productid, $categoriaid, 12, 0);
        $retorno['dados'] = $dados;
        $retorno['images'] = $images;
        $retorno['rel'] = $relacionados;
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

// Buscar produtos favoritos
if ($pagina == 'produtos' && $acao == 'favoritos') {
    $retorno = array("status" => false, "msg" => "", "dados" => array(), "dafavoritos" => array());
    try {
        $clientid = intval(App::getGet('clientid'));
        $email = App::getGet('email');
        $senha = App::getGet('senha');
        if (!App::checkLogin($email, $senha)) {
            throw new Exception('Acesso não autorizado');
        }
        $favoritos = $mp->getFavoritos($clientid);
        $retorno['dados'] = $favoritos;
        // buscar os favoritos
        $mf = new Favoritos();
        $dafavoritos = $mf->getFavoritosByClient($clientid);
        $retorno['dafavoritos'] = $dafavoritos;
        $retorno['status'] = true;
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}


// Pegar os prdutos recem chegados
if ($pagina == 'produtos' && $acao == 'recentes') {
    $retorno = array(
        "status" => false,
        "msg" => "",
        "news" => array(),
        "desconto" => array(),
        "config" => array(),
        "categorias" => array(),
        "yourlike" => array()
    );
    try {
        $dados = $mp->getProductsRecentes(12);
        $desconto = $mp->getProductsOffDescont();
        $yourlike = $mp->getProductYouLike();
        $retorno['news'] = $dados;
        $retorno['desconto'] = $desconto;
        $retorno['yourlike'] = $yourlike;
        $retorno['status'] = true;
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
