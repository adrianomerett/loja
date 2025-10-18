<?php
require_once MODELS . 'mcategorias.php';
$mca = new Categorias();

if ($pagina == 'categorias' && $acao == 'listar') {
    $retorno = array("status" => false, "msg" => "", "dados" => array());
    try {
        $categoriaid = intval(App::getGet('categoriaid'));
        // Paginação
        $pagina_atal = intval(App::getGet('pagina_atual'));
        $pagina_atal = $pagina_atal < 1 ? 1 : $pagina_atal;
        $por_pagina = intval(App::getGet('por_pagina'));
        $total = $mca->countProductsGetByCategoria($categoriaid);
        $offset = ($pagina_atal - 1) * $por_pagina;
        $total_paginas = ceil($total / $por_pagina);
        $dados = $mca->getProductsByCategoria($categoriaid, $por_pagina, $offset);
        $retorno['paginacao'] = array('pagina_atual' => $pagina_atal, 'total_paginas' => $total_paginas);
        $retorno['dados'] = $dados;
        $retorno['status'] = true;
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
