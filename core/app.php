<?php
class App
{
    // Verifica se tem a pasta da pagina
    public static function checkDirectoryPage($namePage): bool
    {
        $page = mb_strtolower($namePage, 'UTF-8');
        if (is_dir(ROOT_PAGES . $page)) {
            return true;
        } else {
            return false;
        }
    }

    // Verifica se tem o arquivo da pagina 
    public static function checkFilePage($namePage, $nameAcao): bool
    {
        $page = mb_strtolower($namePage, 'UTF-8');
        $acao = mb_strtolower($nameAcao, 'UTF-8');
        if (is_file(ROOT_PAGES . $page . DS . $page . "_" . $acao . ".php")) {
            return true;
        } else {
            return false;
        }
    }

    // Função para setar JSON
    public static function setJson($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }

    // Pega um post
    public static function getPost($key)
    {
        if (isset($_POST[$key])) {
            return $_POST[$key];
        } else {
            return null;
        }
    }

    // Pega um get
    public static function getGet($key)
    {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        } else {
            return null;
        }
    }
}
