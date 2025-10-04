<?php
require_once ROOT_LIBRARY . 'image.php';
require_once ROOT_CORE . "models/mprodutos.php";
require_once ROOT_CORE . "models/mimg.php";
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

// Slavar foto de produtos
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
        if (empty($nome)) {
            $retorno['campo'] = 'titulo';
            throw new Exception("Informe o título do produto!");
        }
        if ($idcategoria == '0') {
            $retorno['campo'] = 'categoria';
            throw new Exception("Informe a categoria!");
        }
        if ($idsubcategoria == '0') {
            $retorno['campo'] = 'subcategoria';
            throw new Exception("Informe a subcategoria!");
        }
        if ($estoque == '') {
            $retorno['campo'] = 'estoque';
            throw new Exception("Informe a quantidade em estoque!");
        }
        if ($valorcusto == '') {
            $retorno['campo'] = 'valorcusto';
            throw new Exception("Informe o valor do custo do produto!");
        }
        if ($valorvenda == '') {
            $retorno['campo'] = 'valorvenda';
            throw new Exception("Informe o valor do venda do produto!");
        }
        if ($valoroferta == '') {
            $retorno['campo'] = 'valoroferta';
            throw new Exception("Informe o valor de oferta do produto!");
        }
        if ($descricao == '<p><br></p>') {
            $retorno['campo'] = 'descricao';
            throw new Exception("Descreva a descrição do produto!");
        }
        if ($informacoes == '<p><br></p>') {
            $retorno['campo'] = 'informacao';
            throw new Exception("Descreva as informações técnicas do produto!");
        }
        if ($fotos == null || !is_array($fotos)) {
            throw new Exception("Selecione pelo menos uma foto para o produto!");
        }
        if (count($fotos) >  4) {
            throw new Exception("Você só pode selecionar 4 fotos para cada produto!");
        }
        // Dados para salvar no banco de dados
        $dadossave = array(
            'nome' => $nome,
            'descricao' => $descricao,
            'informacoes' => $informacoes,
            'idcategoria' => $idcategoria,
            'idsubcategoria' => $idsubcategoria,
            'estoque' => $estoque,
            'valorcusto' => $valorcusto,
            'valoroferta' => $valoroferta,
            'valorvenda' => $valorvenda,
            'exibirpreco' => $exibirpreco,
            'status' => $status,
        );
        // Instacia a class de produtos
        $mp = new Mprodutos();
        $insert = $mp->insertProduct($dadossave);
        if (!is_int($insert)) {
            throw new Exception($insert);
        }
        $lastid = $mp->getLastId();
        // Instacia o moedel de imagens
        $mimg = new Mimg();
        // Instacia a classe de imagem
        $img = new Img();
        $patchextra = ROOT_PROCUCTS . "extra" . DS;
        $patchthamb = ROOT_PROCUCTS . "thamb" . DS;
        // Percorrer os arquivos
        foreach ($fotos as $key => $value) {
            $namefoto = $fotos[$key]['id'];
            $extfoto = $fotos[$key]['ext'];
            $pathtmp = ROOT_UPLOAD . "temp" . DS . $namefoto . "." . $extfoto;
            $name = $namefoto . "." . $extfoto;
            if (!file_exists($pathtmp)) {
                continue;
            }
            // Corta as imagens 
            $resizeextra = $img::resizeImage($pathtmp, $patchextra, $name, 800, 800);
            $resizeextra = $img::resizeImage($pathtmp, $patchthamb, $name, 120, 120);
            if ($resizeextra) {
                $insertimg = $mimg->insertImage(array('idproduto' => $lastid, 'img' => $name));
                if (!is_integer($insertimg)) {
                    // Deleta a imagem tmp 
                    unlink($pathtmp . $name);
                    continue;
                }
                unlink($pathtmp);
            }
        }
        $retorno['status'] = true;
        $retorno['msg'] = 'Produto cadastrado com sucesso!';
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}

// Listar produtos
if ($acao == 'listar-products') {
    $retorno = array("status" => false, "msg" => "", "dados" => array());
    try {
        $mp = new Mprodutos();

        // 


        $dados = $mp->getProducts();
        $retorno['dados'] = $dados;
        $retorno['status'] = true;
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
