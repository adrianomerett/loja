<?php
// Vai para a página de login
if ($pagina == 'login') {
    require_once(ROOT_PAGES . $pagina . DS . $pagina . "_logar" . ".php");
    return;
}
// Verifica se o usuario está logado
if (!App::checkUserLogged()) {
    App::redirect('/login');
}
// Inclui o header
require_once(ROOT_PAGES . "template" . DS . "header.php");
// Inclui o menu
require_once(ROOT_PAGES . "template" . DS . "menu.php");
// Inclui o conteudo
if ($pagina == '404' || !$acao) {
    require_once(ROOT_PAGES . "404" . DS . "404.php");
} else {
    require_once(ROOT_PAGES . $pagina . DS . $pagina . "_" .  $acao . ".php");
}
// Inclui o footer
require_once(ROOT_PAGES . "template" . DS . "footer.php");
