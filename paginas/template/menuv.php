<?php
require_once MODELS . 'mcategorias.php';
require_once MODELS . 'msubcategorias.php';
$mcame = new Categorias();
$mscme = new Subcategorias();
$categoriasmenu = $mcame->getCategorias();

?>
<aside class="container-menuv" id="menuv">
    <div class="title-menuv">Categorias</div>
    <nav>
        <ul class="ul-cate">
            <?php
            foreach ($categoriasmenu as $catemenu) {
            ?>
                <li><a href="<?php echo BASE_URL; ?>/categorias/listar/<?php echo $catemenu->categoriaid; ?>"><?php echo $catemenu->namecategoria; ?></a>
                    <ul class="ul-subcate">
                        <?php
                        $subcategoriasmenu = $mscme->getSubcategoriasByIdCategoria(intval($catemenu->categoriaid));
                        foreach ($subcategoriasmenu as $subcatemenu) {
                            echo '<li><a href="' . BASE_URL . '/subcategorias/listar/' . $subcatemenu->subcategoriaid . '/' . $catemenu->categoriaid . '">' . $subcatemenu->namesubcategoria . '</a></li>';
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