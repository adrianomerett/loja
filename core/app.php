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
}
