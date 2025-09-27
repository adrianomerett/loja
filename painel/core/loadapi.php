<?php
try {
    //sleep(1);
    if (empty($pagina) || empty($acao)) {
        throw new Exception('Não foi possível encontrar a página ou a ação.');
    }
    if ($pagina != 'login') {
        // if (!App::checkUserLogged()) {
        //     return App::setJson(array('status' => false, 'msg' => 'unauthorized'));
        // }
    }
    require_once(ROOT_CORE . "api" . DS . $pagina . ".php");
} catch (Exception $e) {
    return App::setJson(array('status' => false, 'msg' => $e->getMessage()));
}
