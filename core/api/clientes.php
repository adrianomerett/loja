<?php
require_once MODELS . 'mclientes.php';
// Cadastrar clientes
if ($pagina == 'clientes' && $acao == 'cadastrar') {
    $retorno = array("status" => false, "msg" => "", "clienteid" => 0);
    try {
        $mcli = new Clientes();
        $dados = App::getPostJson('dados');
        $nome = $dados['nome'];
        $email = $dados['email'];
        $senha = $dados['senha'];
        $rsenha = $dados['rsenha'];
        if (strlen($nome) < 3) {
            $retorno['msg'] = 'Nome inválido';
            return App::setJson($retorno);
        }
        if (!App::validarEmail($email)) {
            $retorno['msg'] = 'E-mail inválido';
            return App::setJson($retorno);
        }
        if (intval($mcli->checkCliente($email)) > 0) {
            $retorno['msg'] = 'Este e-mail já está cadastrado';
            return App::setJson($retorno);
        }
        if (strlen($senha) < 8) {
            $retorno['msg'] = 'A senha deve ter no mínimo 8 caracteres';
            return App::setJson($retorno);
        }
        if ($senha != $rsenha) {
            $retorno['msg'] = 'As senhas não coincidem';
            return App::setJson($retorno);
        }
        $dadosinsert = array(
            'nome' => $nome,
            'email' => $email,
            'password' => password_hash($senha, PASSWORD_DEFAULT),
            'status' => 'A'
        );
        $insert = $mcli->insertCliente($dadosinsert);
        if (!is_bool($insert)) {
            $retorno['msg'] = $insert;
            return App::setJson($retorno);
        }
        $clienteid = $mcli->getLastId();
        $retorno['clienteid'] = $clienteid;
        $retorno['status'] = true;
        $retorno['msg'] = "Olá {$nome}, seu cadastro foi realizado com sucesso!";
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}

// Editar login 
if ($pagina == 'clientes' && $acao == 'login') {
    $retorno = array("status" => false, "msg" => "", "clienteid" => 0);
    try {
        $mcli = new Clientes();
        $dados = App::getPostJson('dados');
        $email = $dados['email'];
        $senha = $dados['senha'];
        if (!App::validarEmail($email)) {
            throw new Exception('E-mail inválido');
        }
        
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
