<?php
require_once MODELS . 'mcontato.php';


if ($pagina == 'contato' && $acao == 'enviarmsg') {
    $mc = new Contato();
    $retorno = array("status" => false, "msg" => "", "campo" => "");
    try {
        $dados = App::getPost('dados');
        $nome = $dados['nome'];
        $email = $dados['email'];
        $telefone = $dados['fone'];
        $assunto = $dados['assunto'];
        $mensagem = $dados['mensagem'];
        if (empty($nome)) {
            $retorno['campo'] = 'nome';
            throw new Exception('Preencha o campo nome.');
        }
        if (empty($email)) {
            $retorno['campo'] = 'email';
            throw new Exception('Preencha o campo email.');
        }
        if (!App::validarEmail($email)) {
            $retorno['campo'] = 'email';
            throw new Exception('Informe um email válido.');
        }
        if (empty($telefone)) {
            $retorno['campo'] = 'fone';
            throw new Exception('Preencha o campo telefone.');
        }
        if (strlen($telefone) < 14) {
            $retorno['campo'] = 'fone';
            throw new Exception('Informe um telefone válido.');
        }
        if (empty($assunto)) {
            $retorno['campo'] = 'assunto';
            throw new Exception('Preencha o campo assunto.');
        }
        if (empty($mensagem)) {
            $retorno['campo'] = 'mensagem';
            throw new Exception('Preencha o campo mensagem.');
        }
        $dados = array(
            'nome' => $nome,
            'email' => $email,
            'fone' => $telefone,
            'assunto' => $assunto,
            'mensagem' => $mensagem,
            'status' => 'P'
        );
        $insert = $mc->insertContato($dados);
        if (!$insert) {
            throw new Exception('Erro ao enviar sua mensagem, tente mais tarde!');
        }
        $retorno['status'] = true;
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
