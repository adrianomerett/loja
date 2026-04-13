<?php
require_once MODELS . 'mfavoritos.php';
require_once MODELS . 'mproducts.php';

if ($pagina == 'favoritos' && $acao == 'change') {
    $retorno = array("status" => false, "msg" => "", "newfavoritos" => array());
    try {
        $mf = new Favoritos();
        $dados = App::getPostJson('dados');
        $clienteid = intval($dados['clienteid']);
        $productid = intval($dados['produtoid']);
        $status = $dados['status'];
        $updateproduct = $dados['updateproduct'];
        $email = $dados['email'];
        $senha = $dados['senha'];
        if (!App::checkLogin($email, $senha)) {
            throw new Exception('Acesso não autorizado');
        }
        if ($status) {
            $check = $mf->isFavorite($clienteid, $productid);
            if (count($check) <= 0) {
                $retorno['status'] = true;
                $retorno['msg'] = 'Produto removidos dos favoritos';
                return App::setJson($retorno);
            }
            $delete = $mf->removeFavorite($clienteid, $productid);
            if ($delete !== true) {
                throw new Exception($delete);
            }
            if($updateproduct){
                $mp = new Produtos();
                $favoritos = $mp->getFavoritos($clienteid);
                $retorno['newfavoritos'] = $favoritos;
            }
            $retorno['status'] = true;
            $retorno['msg'] = 'Produto removidos dos favoritos';
            return App::setJson($retorno);
        }
        $check = $mf->isFavorite($clienteid, $productid);
        if (count($check) > 0) {
            $retorno['status'] = true;
            $retorno['msg'] = 'Produto já está no favoritos';
            return App::setJson($retorno);
        }
        $add = $mf->addFavorite($clienteid, $productid);
        if ($add !== true) {
            throw new Exception($add);
        }
        $retorno['status'] = true;
        $retorno['msg'] = 'Produto adicionado aos favoritos';
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
