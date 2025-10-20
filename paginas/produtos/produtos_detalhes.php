<?php
require_once HELPERS . 'hloja.php';
$da = getProductById(intval($itemid));
if ($da == false) {
    require_once ROOT_PAGES . '404/404.php';
    return;
}
$img = getImgByIdProduct($da->produtoid);
?>
<div class="container-main">
    <div class="ct-path">
        <nav class="container-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Início</a></li>
                <li class="breadcrumb-item itemraquo">&raquo;</li>
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>/produtos/listar">Produtos</a></li>
                <li class="breadcrumb-item itemraquo">&raquo;</li>
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>/categorias/listar/<?php echo $idtwo; ?>"><?php echo $da->namecategoria; ?></a></li>
                <li class="breadcrumb-item itemraquo">&raquo;</li>
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>/subcategorias/listar/<?php echo $idthree; ?>/<?php echo $idtwo; ?>"><?php echo $da->namesubcategoria; ?></a></li>
            </ol>
        </nav>
    </div>
    <!-- Container Detalhes -->
    <div class="container">
        <div class="rows rows-detalhes">
            <?php
            $classesgotado = '';
            $txtestoque = '<div class="qtd-disponivel">Quantidade disponível: ' . $da->estoque . ' unidades.</div>';
            if ($da->estoque <= 0) {
                $classesgotado = ' esgotado';
                $txtestoque = '<div class="txt-esgotado-detalhes">Produto sem estoque.</div>';
            }
            ?>
            <div class="col col-sm-12 col-md-12 col-lg-6 col-ct-img-detalhes<?php echo $classesgotado; ?>">
                <div class="ct-thambs" id="ct-thambs">
                    <?php
                    foreach ($img as $i) {
                        echo '
                        <div class="thamb" id="' . $i->img . '">
                            <img src="' . URL_PAINEL . '/public/upload/produtos/thamb/' . $i->img . '" alt="" />
                        </div>
                        ';
                    }
                    ?>
                </div>
                <div class="ct-img-detalhes">
                    <img src="<?php echo URL_PAINEL; ?>/public/upload/produtos/extra/<?php echo $da->img; ?>" id="img-extra" alt="" />
                </div>
                <?php
                $vdiff = $da->valorvenda - $da->valoroferta;
                $vpercent = round(($vdiff / $da->valoroferta) * 100, 2);
                ?>
                <div class="ct-percent-desconto">-<?php echo $vpercent; ?>%</div>
            </div>
            <div class="col col-sm-12 col-md-12 col-lg-6 col-ct-pre-info">
                <div class="title-product-detalhes">
                    <?php echo $da->nome; ?>
                </div>
                <?php
                if ($da->exibirpreco == 'S') {
                ?>
                    <div class="ct-price-detallhes">
                        <div class="valor-venda-detalhes">De R$ <?php echo number_format($da->valorvenda, 2, ',', '.'); ?></div>
                        <div class="valor-off-detalhes"><span class="txt-valor-off">Por:</span> R$ <?php echo number_format($da->valoroferta, 2, ',', '.'); ?></div>
                    </div>
                <?php
                }
                ?>
                <?php echo $txtestoque; ?>
                <?php
                if ($da->estoque > 0) {
                ?>
                    <div class="btn-add-to-cart" id="btn-add-to-cart">
                        <i class="fa-solid fa-cart-shopping"></i> Quero comprar
                    </div>
                <?php
                }
                ?>
                <div class="ct-pre-info">
                    <div class="title-pre-info">Sobre este produto:</div>
                    <div class="txt-pre-info">
                        <?php echo $da->descricao; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="rows">
            <div class="col col-md-12 col-lg-12 col-ct-pre-info">
                <div class="title-intens">Informações do produto</div>
                <div class="txt-info-tec">
                    <?php echo $da->informacoes; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Produtos relacionados -->
    <div class="container-rell">
        <div class="title-products-rell">Você também poderá gostar de:</div>
        <div class="rows rows-product">
            <?php
            $produsctsrell = getProductsByCategory(intval($itemid), intval($idtwo));
            foreach ($produsctsrell as $v) {
                echo getHtmlProducts($v);
            }
            ?>
        </div>
    </div>
</div>
<!-- Loader de produtos -->
<div class="ct-loader" id="show-loader">
    <span class="loader"></span>
</div>

<!-- Modal de informações de compra -->
<div class="ct-modal-compra" id="modal-compra">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><?php echo $cfg->nameloja; ?> - Informações de compra</div>
            <div class="close-modal" onclick="showModalInfoCompra()"><i class="fa-solid fa-xmark"></i></div>
        </div>
        <div class="modal-bory">
            <div class="txt-info-location">Você pode comprar este produto em nossa loja fisíca, localizada no endereço descrito abaixo.</div>
            <div class="ct-box-modal-info">
                <div class="titles-infos">Informações de endereço.</div>
                <div class="lines-infos"><i class="fa-solid fa-city"></i> Cidade: <?php echo $cfg->cidade; ?></div>
                <div class="lines-infos"><i class="fa-solid fa-map-location"></i> Bairro: <?php echo $cfg->bairro; ?></div>
                <div class="lines-infos"><i class="fa-solid fa-location-dot"></i> Rua: <?php echo $cfg->rua; ?> Nº <?php echo $cfg->numero; ?></div>
            </div>
            <div class="ct-box-modal-info">
                <div class="titles-infos">Informações de contato.</div>
                <div class="lines-infos"><i class="fa-solid fa-phone-volume"></i> Fone: <?php echo $cfg->fone; ?></div>
                <div class="lines-infos"><i class="fa-brands fa-whatsapp"></i> WhatsApp: <?php echo $cfg->celular; ?></div>
                <div class="lines-infos"><i class="fa-regular fa-envelope"></i> E-mail: <?php echo $cfg->email; ?></div>
            </div>
        </div>
    </div>
</div>