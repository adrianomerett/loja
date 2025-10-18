<?php
require_once "config" . DIRECTORY_SEPARATOR . "config.php";
require_once "core" . DIRECTORY_SEPARATOR . "app.php";
$pagina = false;
$acao = false;
$itemid = false;
$idtwo = false;
$idthree = false;
$acaoapi = false;

try {
    $protocolo = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];
    $url_completa = $protocolo . $host . $uri;
    $server_url = str_replace(BASE_URL, '', $url_completa);
    $parts = explode("/", $server_url);
    $page = $parts[1];
    if(count($parts) >= 3){
        $acao = $parts[2];
    }
    if (count($parts) >= 4) {
        $itemid = $parts[3];
    }
    if(count($parts) >= 5){
        $idtwo = $parts[4];
    }
    if(count($parts) >= 6){
        $idthree = $parts[5];
    }
    // api
    if (!empty($page) && $page == 'api') {
        $pagina = $parts[2];
        if (count($parts) >= 4) {
            if(!empty($parts[3])){
                $acao = $parts[3];
            }
        }
        require_once(ROOT_CORE . "loadapi.php");
    } else {
        // Inclui o array de assets
        require_once ROOT_CORE . "assets.php";
        if ($page == '' || $page == 'home') {
            $pagina = 'home';
            $acao = 'index';
        } else {
            if(!App::checkDirectoryPage($page)){
                $pagina = '404';;
            }else{
                $pagina = $page;
                if(empty($acao)){
                    $pagina = '404';
                }else{
                    if(!App::checkFilePage($page, $acao)){
                        $pagina = '404';
                    }else{
                        if($itemid){
                            if(!is_numeric($itemid)){
                                $pagina = '404';
                            }
                        }
                        if(!empty($idtwo) && $pagina != 'busca'){
                            if(!is_numeric($idtwo)){
                                $pagina = '404';
                            }
                        }
                        if(!empty($idthree) && $pagina != 'busca'){
                            if(!is_numeric($idthree)){
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
