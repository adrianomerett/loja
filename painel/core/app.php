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

    // Setar Session
    public static function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    // Getar Session
    public static function getSession($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return null;
        }
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

    //Validar email
    public static function validarEmail($email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    // Verifica se o usuario está logado
    public static function checkUserLogged(): bool
    {
        if (isset($_SESSION['app-painel-is-logged']) && $_SESSION['app-painel-is-logged'] == KEY_SESSION) {
            return true;
        } else {
            return false;
        }
    }

    // Redireciona para a página
    public static function redirect($url)
    {
        header("Location: " . BASE_URL . $url);
        exit;
    }
}
