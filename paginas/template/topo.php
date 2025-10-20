<header class="content-header">
    <div class="ct-buttom-mobile" id="buttom-mobile">
        <i class="fa-solid fa-bars"></i>
    </div>
    <div class="container-logo">
        <a href="<?php echo BASE_URL; ?>" class="link-logo">
            <div class="name-loja"><?php echo $cfg->nameloja; ?></div>
            <div class="slogan-loja"><?php echo $cfg->slogan; ?></div>
        </a>
    </div>
    <div class="container-search">
        <div class="logo-mobile"><a href="<?php echo BASE_URL; ?>"><?php echo $cfg->nameloja; ?></a></div>
        <div class="buscas">
            <div class="container-cpbusca">
                <?php
                $busca = empty($_GET['busca']) ? '' : $_GET['busca'];
                ?>
                <input type="text" class="cpbusca" id="cpbusca" value="<?php echo $busca; ?>" placeholder="Pesquisar produtos...">
            </div>
            <div class="container-btn-search">
                <span class="btn-search" id="btn-search"><i class="fa-solid fa-magnifying-glass"></i> Buscar</span>
            </div>
        </div>
    </div>
    <div class="container-access-painel">
        <a href="<?php echo URL_PAINEL; ?>" target="new" class="accsses-panel">
            <div class="iconpainel"><i class="fa-solid fa-desktop"></i></div>
            <div class="txtpainel">Painel</div>
        </a>
    </div>
</header>