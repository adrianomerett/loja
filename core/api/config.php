<?php
require_once MODELS . 'mconfig.php';
require_once MODELS . 'mcategorias.php';
require_once MODELS . 'msubcategorias.php';

// Buscar as configurações do sistema
if ($pagina == 'config' && $acao == 'getconfig') {
    $retorno = array(
        "status" => false, 
        "msg" => "", 
        "dados" => array(),
        "categorias" => array()
        );
    try {
        // Busca os dados da empresa
        $mcfg = new Config();
        $dados = $mcfg->getConfig();
        // Busca as categorias
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
        $retorno['categorias'] = $categorias;
        $retorno['dados'] = $dados;
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
