<?php
require_once("config" . DIRECTORY_SEPARATOR . "config.php");
require_once("core" . DS . "app.php");
$tempo_expiracao = 30;
session_set_cookie_params(TIME_SESSION);
session_start();
$pagina = false;
$acao = false;
$acaoapi = false;
$ideditar = false;
try {
    $server_url = $_SERVER['REQUEST_URI'];
    $parts = explode(PAINEL, $server_url);
    $partsuri = explode('/', $parts[1]);
    $page = $partsuri[1];
    if (count($partsuri) >= 3) {
        $acao = $partsuri[2];
    }
    if (count($partsuri) >= 5) {
        $ideditar = $partsuri[4];
    }
    if (!empty($page) && $page == 'api') {
        $pagina = $partsuri[2];
        if (count($partsuri) >= 4) {
            if(!empty($partsuri[3])){
                $acao = $partsuri[3];
            }
        }
        require_once(ROOT_CORE . "loadapi.php");
    } else {
        // Inclui o array de assets
        require_once ROOT_CORE . "assets.php";
        // Se não passar nada a pagina é a home
        if ($page == '' || $page == 'home') {
            $pagina = 'home';
            $acao = 'index';
        } else {
            if (!App::checkDirectoryPage($page)) {
                $pagina = '404';
            } else {
                $pagina = $page;
                if ($acao) {
                    if (!App::checkFilePage($page, $acao)) {
                        $pagina = '404';
                    }
                    if ($ideditar) {
                        if (!is_numeric($ideditar)) {
                            $pagina = '404';
                        } else {
                            if ($partsuri[3] != 'id') {
                                $pagina = '404';
                            }
                        }
                    }
                }
            }
        }
        // Inclui o template
        require_once(ROOT_PAGES . "template" . DS . "main.php");
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
