<?php
require_once MODELS . '/mproducts.php';
$mp = new Produtos();
?>
<div class="container-main">
    <div class="container-recentes">
        <div class="title-recentes">Produtos recém chegados</div>
        <div class="bory-recents">
            <div class="rows rows-product">
                <?php
                $recentes = $mp->getProductsRecentes();
                foreach ($recentes as $product) {
                ?>
                    <div class="col-lg-3 ct-box-product">
                        <a href="#" class="link-product">
                            <div class="img-produto">
                                <img src="<?php echo URL_PAINEL; ?>/public/upload/produtos/thamb/147noa.webp" alt="" />
                            </div>
                            <div class="name-product">Carregador Baseus 10.5w 2x Usb Com Cabo Llghtning 1m 2x Usb</div>
                            <div class="ct-price">
                                <div class="valor-venda">
                                    <span class="valor-on">De: RS 1.598,32</span>
                                </div>
                                <div class="valor-oferta">
                                    <span class="valor-off">Por:</span>
                                    <span class="price-off">RS 1.632,32</span>
                                </div>
                            </div>
                        </a>
                        <div class="ct-off">-22% Desc.</div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>