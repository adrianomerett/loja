<?php
require_once MODELS . 'config.php';

// Editar configurações
if ($pagina == 'configuracoes' && $acao == 'update-config') {
    $retorno = array('status' => false, 'msg' => '');
    try {
        $dados = App::getPost('dados');
        $dados['id'] = 1;
        $mco = new Config();
        $update = $mco->updateConfig($dados);
        if (!$update) {
            throw new Exception('Erro ao salvar as configurações.');
        }
        $retorno['status'] = true;
        $retorno['msg'] = 'Configurações salvas com sucesso.';
        return App::setJson($retorno);
    } catch (Exception $e) {
        $retorno['msg'] = $e->getMessage();
        return App::setJson($retorno);
    }
}
