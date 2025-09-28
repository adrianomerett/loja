<?php
require_once ROOT_CORE . "models/mcategorias.php";
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
