<div class="container-toto">
    <div class="show-menu-mobile" id="show-menu-mobile">
        <i class="fa-solid fa-bars"></i>
    </div>
    <div class="logo-painel"><a href="<?php echo BASE_URL . "/home/"; ?>"><?php echo $cfg->nameloja; ?></a></div>
    <div class="info-painel">
        <div class="name-painel">Painel Administrativo</div>
        <div class="name-usuario-painel">Usuário: <?php echo App::getSession('name'); ?> <?php echo App::getSession('lastname'); ?></div>
    </div>
    <div class="icons-painel">
        <div class="ct-logout">
            <div class="iconlogout"><i class="fa-solid fa-right-from-bracket"></i></div>
            <div class="txt-logout">Sair</div>
        </div>
    </div>
</div>