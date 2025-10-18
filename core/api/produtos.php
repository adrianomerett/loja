<?php
require_once MODELS . 'mproducts.php';
$mp = new Produtos();

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
