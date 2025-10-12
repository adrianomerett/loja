<?php
// Inclui o header
require_once(ROOT_PAGES . "template" . DS . "header.php");
// Inclui o menu horizontal
require_once(ROOT_PAGES . "template" . DS . "menuh.php");
// Inclui o menu vertical
require_once(ROOT_PAGES . "template" . DS . "menuv.php");
// Inclui o conteudo
if ($pagina == '404' || !$acao) {
    require_once(ROOT_PAGES . "404" . DS . "404.php");
} else {
    require_once(ROOT_PAGES . $pagina . DS . $pagina . "_" .  $acao . ".php");
}
// Inclui o footer
require_once(ROOT_PAGES . "template" . DS . "footer.php");
