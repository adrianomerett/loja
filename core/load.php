<?php
require_once "config" . DIRECTORY_SEPARATOR . "config.php";
require_once "core" . DIRECTORY_SEPARATOR . "app.php";
$pagina = false;
$acao = false;
$itemid = false;
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
    // api
    if (!empty($page) && $page == 'api') {
    } else {
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
