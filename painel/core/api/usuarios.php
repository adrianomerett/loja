<?php
require_once MODELS . 'musers.php';
// Cadastrar usuário
if ($acao == 'salvar') {
    $retorno = array('status' => false, 'msg' => '', 'campo' => '');

    try {
        // Verifica se recebeu os dados
        if (!App::getPost('dados')) {
            throw new Exception("Dados não informados.");
        }
        $dados = App::getPost('dados');
        if ($dados['name'] == '') {
            $retorno['campo'] = 'nome';
            throw new Exception("Preencha o campo de nome.");
        }
        if ($dados['sobrenome'] == '') {
            $retorno['campo'] = 'sobrenome';
            throw new Exception("Preencha o campo de sobrenome.");
        }
        if ($dados['email'] == '') {
            $retorno['campo'] = 'email';
            throw new Exception("Preencha o campo de email.");
        }
        if (!App::validarEmail($dados['email'])) {
            $retorno['campo'] = 'email';
            throw new Exception("O email informado não é inválido.");
        }
        // Verifica se o email já está cadastrado
        $user = new Musers();
        $chekemail = $user->getUserLogin($dados['email']);
        if (!is_array($chekemail)) {
            throw new Exception($chekemail);
        }
        if (count($chekemail) >= 1) {
            $retorno['campo'] = 'email';
            throw new Exception("O email informado <b>{$dados['email']}</b> já esta cadastrado.");
        }
        // Senha
        if ($dados['password'] == '') {
            $retorno['campo'] = 'password';
            throw new Exception("Preencha a senha.");
        }
        if (strlen($dados['password']) < 8) {
            $retorno['campo'] = 'password';
            throw new Exception("A senha deve ter no mínimo 8 caracteres.");
        }
        // Confirmar senha
        if ($dados['cpassword'] == '') {
            $retorno['campo'] = 'cpassword';
            throw new Exception("Preencha a confirmação da senha.");
        }
        if ($dados['cpassword'] != $dados['password']) {
            $retorno['campo'] = 'cpassword';
            throw new Exception("As senhas informadas não são iguais.");
        }
        // Status
        if ($dados['status'] == '0') {
            $retorno['campo'] = 'status';
            throw new Exception("Selecione o status do usuário.");
        }
        // Level
        if ($dados['level'] == '0') {
            $retorno['campo'] = 'level';
            throw new Exception("Selecione o nível do usuário.");
        }
        // Verifica se o usuário tem permissão para cadastrar
        if (App::getSession('level') == 'S') {
            throw new Exception("O usuário " . App::getSession('name') . " não tem permissão para cadastrar usuários.");
        }
        $dadosinsert = array(
            'name' => $dados['name'],
            'sobrenome' => $dados['sobrenome'],
            'email' => $dados['email'],
            'password' => password_hash($dados['password'], PASSWORD_DEFAULT),
            'status' => $dados['status'],
            'level' => $dados['level']
        );
        $user = new Musers();
        $save = $user->saveUser($dadosinsert);
        if ($save !== true) {
            throw new Exception($save);
        }
        $retorno['status'] = true;
        $retorno['msg'] = "O usuário {$dados['name']} foi cadastrado com sucesso.";
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}

// Listar usuários
if ($acao == 'listar') {
    $retorno = array('status' => false, 'msg' => '');
    try {
        $user = new Musers();
        $dados = $user->getAllUser();
        $retorno['status'] = true;
        $retorno['dados'] = $dados;
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
};

// Excluir usuário
if ($acao == 'delete-user') {
    sleep(1);

    try {
        $retorno = array('status' => false, 'msg' => '', 'dados' => array());
        if (!App::getPost('userid')) {
            throw new Exception("Usuário não informado.");
        }
        $muser = new Musers();
        $userid = App::getPost('userid');
        if (App::getSession('userid') == $userid) {
            throw new Exception("Você não pode excluir a sua própria conta de usuário.");
        }
        if (App::getSession('level') == 'S') {
            throw new Exception("O usuário " . App::getSession('name') . " não tem permissão para excluir usuários.");
        }
        // Deletar usuário
        $delete = $muser->deleteUser($userid);
        if (!is_bool($delete)) {
            throw new Exception($delete);
        }
        $retorno['status'] = true;
        $retorno['msg'] = "O usuário foi excluído com sucesso.";
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
