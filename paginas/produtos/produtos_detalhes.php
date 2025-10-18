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
                <li class="breadcrumb-item itemraquo">&raquo;</li>
                <li class="breadcrumb-item active">Produto Detalhes</li>
            </ol>
        </nav>
    </div>
    <!-- Container Detalhes -->
    <div class="container">
        <div class="rows rows-detalhes">
            <div class="col col-md-12 col-lg-6 col-ct-img-detalhes">
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
            <div class="col col-lg-6 col-ct-pre-info">
                <div class="title-product-detalhes">
                    <?php echo $da->nome; ?>
                </div>
                <div class="ct-price-detallhes">
                    <div class="valor-venda-detalhes">De R$ <?php echo number_format($da->valorvenda, 2, ',', '.'); ?></div>
                    <div class="valor-off-detalhes"><span class="txt-valor-off">Por:</span> R$ <?php echo number_format($da->valoroferta, 2, ',', '.'); ?></div>
                    <div class="qtd-disponivel">Quantidade disponível: <?php echo $da->estoque; ?> unidades.</div>
                </div>
                <div class="btn-add-to-cart">
                    <i class="fa-solid fa-cart-shopping"></i> Quero comprar
                </div>
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