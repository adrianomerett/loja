<?php
$m1 = $pagina;
$m2 = '';
if ($acao) {
    $m2 = $acao;
}
?>
<div class="container-menu" id="container-menu">
    <ul class="ul-father" id="ul-menu">
        <li class="li-father  <?= $m1 == 'home' ? 'active-father' : '' ?>">
            <a href="<?php echo BASE_URL . "/home"; ?>" class="link-father">
                <i class="fa-solid fa-house"></i> Início
            </a>
        </li>
        <li class="li-father haschild <?= $m1 == 'produtos' ? 'active-father' : '' ?>" id="produtos">
            <a href="#produtos" class="link-father">
                <i class="fa-brands fa-shopify"></i> Produtos
                <span class="arrow-indicator"><i class="fa-solid fa-chevron-right"></i></span>
            </a>
            <ul class="ul-child">
                <li class="li-child">
                    <a href="<?php echo BASE_URL . "/produtos/cadastrar"; ?>" class="link-child <?= $m2 == 'cadastrar' ? 'active-child' : '' ?>">
                        &raquo; Cadastrar Produtos
                    </a>
                </li>
                <li class="li-child">
                    <a href="<?php echo BASE_URL . "/produtos/listar"; ?>" class="link-child <?= $m2 == 'listar' ? 'active-child' : '' ?>">
                        &raquo; Listar Produtos
                    </a>
                </li>
            </ul>
        </li>
        <li class="li-father haschild <?= $m1 == 'usuarios' ? 'active-father' : '' ?>" id="usuarios">
            <a href="#usuarios" class="link-father">
                <i class="fa-solid fa-users"></i> Usuários
                <span class="arrow-indicator"><i class="fa-solid fa-chevron-right"></i></span>
            </a>
            <ul class="ul-child">
                <li class="li-child">
                    <a href="<?php echo BASE_URL . "/usuarios/cadastrar"; ?>" class="link-child <?= $m2 == 'cadastrar' ? 'active-child' : '' ?>">
                        &raquo; Cadastrar Usuários
                    </a>
                </li>
                <li class="li-child">
                    <a href="<?php echo BASE_URL . "/usuarios/listar"; ?>" class="link-child <?= $m2 == 'listar' ? 'active-child' : '' ?>">
                        &raquo; Listar Usuários
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
