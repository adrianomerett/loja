<?php
require_once MODELS . 'mcategorias.php';
require_once MODELS . 'msubcategorias.php';
$mca = new Categorias();
$msc = new Subcategorias();
$categorias = $mca->getCategorias();

?>
<aside class="container-menuv" id="menuv">
    <div class="title-menuv">Categorias</div>
    <nav>
        <ul class="ul-cate">
            <?php
            foreach ($categorias as $cate) {
            ?>
                <li><a href="<?php echo BASE_URL; ?>/categorias/listar/<?php echo $cate->categoriaid; ?>"><?php echo $cate->namecategoria; ?></a>
                    <ul class="ul-subcate">
                        <?php
                        $subcategorias = $msc->getSubcategoriasByIdCategoria(intval($cate->categoriaid));
                        foreach ($subcategorias as $subcate) {
                            echo "<li><a href='#'>" . $subcate->namesubcategoria . "</a></li>";
                        }
                        ?>
                    </ul>
                </li>
            <?php
            }
            ?>
        </ul>
        </li>
        </ul>
    </nav>
</aside>