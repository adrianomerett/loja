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
