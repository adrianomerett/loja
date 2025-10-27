<?php
require_once MODELS . 'mcontatos.php';

// Busca os contatos
if ($pagina == 'contatos' && $acao == 'get-contatos') {
    $retorno = array('status' => false, 'msg' => '', 'dados' => array());
    try {
        $mco = new Mcontatos();
        // Paginação
        $pagina_atal = intval(App::getGet('pagina_atual'));
        $pagina_atal = $pagina_atal < 1 ? 1 : $pagina_atal;
        $por_pagina = intval(App::getGet('por_pagina'));
        $total = $mco->countAllContacts();
        $offset = ($pagina_atal - 1) * $por_pagina;
        $total_paginas = ceil($total / $por_pagina);
        // Busca os dados
        $dados = $mco->getContacts($por_pagina, $offset);
        $retorno['paginacao'] = array('pagina_atual' => $pagina_atal, 'total_paginas' => $total_paginas);
        $retorno['dados'] = $dados;
        $retorno['status'] = true;
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
