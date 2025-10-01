<?php
require_once ROOT_LIBRARY . 'image.php';
// Upload das fotos
if ($acao == 'uploadfotos') {
    try {
        // $retorno = array("status" => false, "msg" => "");
        $file = $_FILES['file']['tmp_name'];
        if (!App::checkExtension(App::getPost('ext'))) {
            throw new Exception("A extensão do arquivo não é permitida!");
        }
        $copyfile = copy($file, ROOT_UPLOAD . "temp" . DS . App::getPost('id') . "." . App::getPost('ext'));
        if (!$copyfile) {
            throw new Exception("Erro ao enviar a foto...");
        }
        $retorno['status'] = true;
        $retorno['msg'] = "Foto enviada com sucesso!";
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno = array("status" => false, "msg" => $e->getMessage());
    }
}

// remover foto temporaria
if ($acao == 'delete-tmp-foto') {
    try {
        $id = App::getPost('id');
        $file = ROOT_UPLOAD . "temp" . DS . $id  . "." . App::getPost('ext');
        if (file_exists($file)) {
            unlink($file);
        }
        $retorno = array("status" => true, "msg" => "Foto removida com sucesso!");
    } catch (Exception $e) {
        $retorno = array("status" => false, "msg" => $e->getMessage());
    }
}

if ($acao == 'save-products') {
    $retorno = array("status" => false, "msg" => "", "campo" => "");
    try {
        $dados = App::getPost('dados');
        $nome = $dados['nome'];
        $descricao = $dados['descricao'];
        $informacoes = $dados['informacoes'];
        $idcategoria = $dados['idcategoria'];
        $idsubcategoria = $dados['idsubcategoria'];
        $estoque = $dados['estoque'];
        $valorcusto = $dados['valorcusto'];
        $valoroferta = $dados['valoroferta'];
        $valorvenda = $dados['valorvenda'];
        $exibirpreco = $dados['exibirpreco'];
        $status = $dados['status'];
        $fotos = json_decode($dados['fotos'], true);
        // Validação
        // if (empty($nome)) {
        //     $retorno['campo'] = 'titulo';
        //     throw new Exception("Informe o título do produto!");
        // }
        // if ($idcategoria == '0') {
        //     $retorno['campo'] = 'categoria';
        //     throw new Exception("Informe a categoria!");
        // }
        // if ($idsubcategoria == '0') {
        //     $retorno['campo'] = 'subcategoria';
        //     throw new Exception("Informe a subcategoria!");
        // }
        // if ($estoque == '') {
        //     $retorno['campo'] = 'estoque';
        //     throw new Exception("Informe a quantidade em estoque!");
        // }
        // if ($valorcusto == '') {
        //     $retorno['campo'] = 'valorcusto';
        //     throw new Exception("Informe o valor do custo do produto!");
        // }
        // if ($valorvenda == '') {
        //     $retorno['campo'] = 'valorvenda';
        //     throw new Exception("Informe o valor do venda do produto!");
        // }
        // if ($valoroferta == '') {
        //     $retorno['campo'] = 'valoroferta';
        //     throw new Exception("Informe o valor de oferta do produto!");
        // }
        // if ($descricao == '<p><br></p>') {
        //     $retorno['campo'] = 'descricao';
        //     throw new Exception("Descreva a descrição do produto!");
        // }
        // if ($informacoes == '<p><br></p>') {
        //     $retorno['campo'] = 'informacao';
        //     throw new Exception("Descreva as informações técnicas do produto!");
        // }
        //$retorno['fotos'] = var_dump($fotos);
        if ($fotos == null || !is_array($fotos)) {
            throw new Exception("Selecione pelo menos uma foto para o produto!");
        }
        if(count($fotos) >  4){
            throw new Exception("Você só pode selecionar 4 fotos para cada produto!");
        }
        // Percorrer os arquivos
        foreach ($fotos as $key => $value) {
            $namefoto = $fotos[$key]['id'];
            $extfoto = $fotos[$key]['ext'];
            return App::setJson($retorno);
        }
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
