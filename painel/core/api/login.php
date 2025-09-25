<?php
require_once MODELS . 'musers.php';

// lolgin de usuários
if ($acao == 'logar') {
    try {
        $user = new Musers();
        $retorno = array('status' => false, 'msg' => '');
        $email = App::getPost('email');
        $password = App::getPost('password');
        if (empty($email)) {
            $retorno['campo'] = "email";
            throw new Exception("Por favor, informe seu email.");
        }
        if (empty($email)) {
            $retorno['campo'] = "email";
            throw new Exception("Por favor, informe seu email.");
        }
        if (!App::validarEmail($email)) {
            $retorno['campo'] = "email";
            throw new Exception("O email informado não é inválido.");
        }
        if (empty($password)) {
            $retorno['campo'] = "password";
            throw new Exception("Por favor, informe sua senha.");
        }
        $chekemail = $user->getUserLogin($email);
        if (!is_array($chekemail)) {
            $retorno['campo'] = "email";
            throw new Exception($chekemail);
        }
        if (count($chekemail) <= 0) {
            $retorno['campo'] = "email";
            throw new Exception("O email informado não está cadastrado.");
        }
        if ($chekemail[0]->status != 'A') {
            throw new Exception("sua conta de usuário está desativada.");
        }
        if (!password_verify($password, $chekemail[0]->password)) {
            $retorno['campo'] = "password";
            throw new Exception("A senha informada está incorreta.");
        }
        // Seta as sessoes
        $partsname = explode(" ", $chekemail[0]->sobrenome);
        $end = end($partsname);
        App::setSession("userid", $chekemail[0]->userid);
        App::setSession("email", $email);
        App::setSession("name", $chekemail[0]->name);
        App::setSession("sobrenome", $chekemail[0]->sobrenome);
        App::setSession("lastname", $end);
        App::setSession("level", $chekemail[0]->level);
        App::setSession("app-painel-is-logged", KEY_SESSION);
        $retorno['status'] = true;
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
