<?php
if ($acao == 'uploadfotos') {
    $retorno = array("status" => true, "msg" => "");
    try {
        
    } catch (Exception $e) {
        $retorno = array("status" => false, "msg" => $e->getMessage());
        App::setJson($retorno);
    }
}
