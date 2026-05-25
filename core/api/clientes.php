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
    $retorno = array("status" => false, "msg" => "", "data" => array());
    try {
        $mcli = new Clientes();
        $dados = App::getPostJson('dados');
        $email = $dados['email'];
        $senha = $dados['senha'];
        if (!App::validarEmail($email) || empty($email)) {
            throw new Exception('E-mail inválido');
        }
        $checkemail = $mcli->checkCliente($email);
        $passworddb = $mcli->getPassword($email);
        if (empty($senha)) {
            throw new Exception('Por favor, informe sua senha!');
        }
        if (is_null($checkemail) || $checkemail === false || is_null($passworddb) || $passworddb === false) {
            throw new Exception('E-mail ou senha inválidos');
        }
        // Verificar a senha do cliente
        if (!password_verify($senha, $passworddb['password'])) {
            throw new Exception('E-mail ou senha inválidos');
        }
        $retorno['data'] = $mcli->getDataClinet($email)[0];
        $retorno['status'] = true;
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
// Editar dados pessoais 
if ($pagina == 'clientes' && $acao == 'editarcliente') {
    $retorno = array("status" => false, "msg" => "");
    try {
        $mcli = new Clientes();
        $dados = App::getPostJson('dados');
        $clientid = intval($dados['clientid']);
        $nome = $dados['nome'];
        $email = $dados['email'];
        $senha = $dados['senha'];
        if (strlen($nome) < 3) {
            $retorno['msg'] = 'Nome inválido';
            return App::setJson($retorno);
        }
        if (!App::validarEmail($email)) {
            $retorno['msg'] = 'E-mail inválido';
            return App::setJson($retorno);
        }
        if (strlen($senha) < 8) {
            $retorno['msg'] = 'A senha deve ter no mínimo 8 caracteres';
            return App::setJson($retorno);
        }
        // Verifcar se o cliente já existe
        $checkid = $mcli->checkClienteById($clientid);
        if (is_null($checkid) || $checkid === false) {
            $retorno['msg'] = 'Cliente não encontrado';
            return App::setJson($retorno);
        }
        // Verificar a senha do cliente
        $senhadb = $checkid['password'];
        if (!password_verify($senha, $senhadb)) {
            throw new Exception('A sua senha de autenticação está incorreta');
        }
        $dadosupdate = array(
            'nome' => $nome,
            'email' => $email,
        );
        $update = $mcli->updateCliente($dadosupdate, $clientid);
        if (!is_bool($update)) {
            $retorno['msg'] = $update;
            return App::setJson($retorno);
        }
        $retorno['status'] = true;
        $retorno['msg'] = "Olá {$nome}, seu cadastro foi atualizado com sucesso!";
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
