<?php
require_once MODELS . '/mproducts.php';
require_once HELPERS . 'hloja.php';
$mp = new Produtos();
?>
<div class="container-main">
    <!-- Produtos Recentes -->
    <div class="container-recentes">
        <div class="title-recentes">Produtos recém-chegados</div>
        <div class="bory-recents">
            <div class="rows rows-product">
                <?php
                $recentes = $mp->getProductsRecentes();
                foreach ($recentes as $v) {
                    echo getHtmlProducts($v);
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Produtos com desconto acima de 10% -->
    <div class="rows rows-veja-mais">
        <div class="col col-lg-6 col-veja-mais">
            <div class="container-veja-mais card-one">
                <div class="title-recentes">Produtos com desconto acima de 10%</div>
                <div class="bory-recents">
                    <div class="rows rows-product">
                        <?php
                        $desconts = $mp->getProductsOffDescont();
                        foreach ($desconts as $v) {
                            $vdiff = $v->valorvenda - $v->valoroferta;
                            $vpercent = round(($vdiff / $v->valoroferta) * 100, 2);
                            $classesgotado = '';
                            $txtestoque = '<div class="ct-estoque disponivel">Estoque disponível ' . $v->estoque . ' unidades.</div>';
                            if ($v->estoque <= 0) {
                                $classesgotado = ' esgotado';
                                $txtestoque = '<div class="ct-estoque txt-esgotado">Produto sem estoque.</div>';
                            }
                            $txtprice = '
                            <div class="ct-price">
                                <div class="valor-venda">
                                    <span class="valor-on">De: RS ' . number_format($v->valorvenda, 2, ',', '.') . '</span>
                                </div>
                                <div class="valor-oferta">
                                    <span class="valor-off">Por:</span>
                                    <span class="price-off">RS ' . number_format($v->valoroferta, 2, ',', '.') . '</span>
                                </div>
                            </div>
                    ';
                            if ($v->exibirpreco == 'N') {
                                $txtprice = '';
                            }
                        ?>
                            <div class="col col-sm-6 col-md-4 col-lg-6 ct-box-product box-product-home">
                                <a href="<?php echo BASE_URL . "/produtos/detalhes/" . $v->produtoid . "/" . $v->idcategoria . "/" . $v->idsubcategoria . "/" . App::slugurl($v->nome); ?>" class="link-product<?php echo $classesgotado; ?>">
                                    <div class="img-produto">
                                        <img src="<?php echo URL_PAINEL; ?>/public/upload/produtos/thamb/<?php echo $v->img; ?>" alt="<?php echo $v->nome; ?>" />
                                    </div>
                                    <div class="name-product"><?php echo $v->nome; ?></div>
                                    <?php echo $txtprice; ?>
                                    <div class="ct-off">
                                        -<?php echo $vpercent; ?>%
                                    </div>
                                    <?php echo $txtestoque; ?>
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tem tudo a ver com você -->
        <div class="col col-lg-6 col-veja-mais">
            <div class="container-veja-mais card-two">
                <div class="title-recentes">Tem tudo a ver com você</div>
                <div class="bory-recents">
                    <div class="rows rows-product">
                        <?php
                        $youlike = $mp->getProductYouLike();
                        foreach ($youlike as $v) {
                            $vdiff = $v->valorvenda - $v->valoroferta;
                            $vpercent = round(($vdiff / $v->valoroferta) * 100, 2);
                            $classesgotado = '';
                            $txtestoque = '<div class="ct-estoque disponivel">Estoque disponível ' . $v->estoque . ' unidades.</div>';
                            if ($v->estoque <= 0) {
                                $classesgotado = ' esgotado';
                                $txtestoque = '<div class="ct-estoque txt-esgotado">Produto sem estoque.</div>';
                            }
                            $txtprice = '
                            <div class="ct-price">
                                <div class="valor-venda">
                                    <span class="valor-on">De: RS ' . number_format($v->valorvenda, 2, ',', '.') . '</span>
                                </div>
                                <div class="valor-oferta">
                                    <span class="valor-off">Por:</span>
                                    <span class="price-off">RS ' . number_format($v->valoroferta, 2, ',', '.') . '</span>
                                </div>
                            </div>
                    ';
                            if ($v->exibirpreco == 'N') {
                                $txtprice = '';
                            }
                        ?>
                            <div class="col col-sm-6 col-md-4 col-lg-6 ct-box-product box-product-home">
                                <a href="<?php echo BASE_URL . "/produtos/detalhes/" . $v->produtoid . "/" . $v->idcategoria . "/" . $v->idsubcategoria . "/" . App::slugurl($v->nome); ?>" class="link-product<?php echo $classesgotado; ?>">
                                    <div class="img-produto">
                                        <img src="<?php echo URL_PAINEL; ?>/public/upload/produtos/thamb/<?php echo $v->img; ?>" alt="<?php echo $v->nome; ?>" />
                                    </div>
                                    <div class="name-product"><?php echo $v->nome; ?></div>
                                    <?php echo $txtprice; ?>
                                    <div class="ct-off">
                                        -<?php echo $vpercent; ?>%
                                    </div>
                                    <?php echo $txtestoque; ?>
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>