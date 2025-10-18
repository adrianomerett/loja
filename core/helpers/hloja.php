<?php
// Pega o nome da categoria pelo id
if (!function_exists('nameCategory')) {
    function nameCategory($idcategoria)
    {
        require_once MODELS . 'mcategorias.php';
        $mcate = new Categorias();
        return $mcate->getNameCategoryById($idcategoria);
    }
}
// Pega o nome da subcategoria pelo id
if (!function_exists('nameSubcategoria')) {
    function nameSubcategoria($idcategoria)
    {
        require_once MODELS . 'msubcategorias.php';
        $msc = new Subcategorias();
        return $msc->getNameCategoryById($idcategoria);
    }
}

// Pega os dados do produto pelo id
if (!function_exists('getProductById')) {
    function getProductById($id)
    {
        require_once MODELS . 'mproducts.php';
        $mp = new Produtos();
        return $mp->getProductById($id);
    }
}

// Pega as imgens pelo id produto
if (!function_exists('getImgByIdProduct')) {
    function getImgByIdProduct($id)
    {
        require_once MODELS . 'mimg.php';
        $mimg = new Imagens();
        return $mimg->getImgByIdProduct($id);
    }
}

// Gerar html de prdutos 
if (!function_exists('getHtmlProducts')) {
    function getHtmlProducts($v)
    {
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
        $htmlproduct  = '
        <div class="col col-sm-6 col-md-4 col-lg-3 ct-box-product box-product-home">
            <a href="' . BASE_URL . '/produtos/detalhes/' . $v->produtoid . '/' . $v->idcategoria . '/' . $v->idsubcategoria . '/' . App::slugurl($v->nome) . '" class="link-product' . $classesgotado . '">
                <div class="img-produto">
                    <img src="' . URL_PAINEL . '/public/upload/produtos/thamb/' . $v->img . '" alt="' . $v->nome . '" />
                </div>
                <div class="name-product">' . $v->nome . '</div>
                ' . $txtprice . '
                <div class="ct-off">
                    -' . $vpercent . '%
                </div>
                ' . $txtestoque . '
            </a>
        </div>
        ';
        return $htmlproduct;
    }
}

// Pega os produtos de uma determinada categoria
if (!function_exists('getProductsByCategory')) {
    function getProductsByCategory($idproduto, $idcategoria)
    {
        require_once MODELS . 'mproducts.php';
        $mcate = new Produtos();
        return $mcate->getProductsRellByCategory($idproduto, $idcategoria, 12, 0);
    }
}
