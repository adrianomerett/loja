<?php
require_once MODELS . 'mcategorias.php';
require_once MODELS . 'msubcategorias.php';
$mcame = new Categorias();
$mscme = new Subcategorias();
$categoriasmenu = $mcame->getCategorias();
?>
<aside class="container-menuv" id="menuv">
    <div class="title-menuv">Departamentos</div>
    <nav>
        <ul class="ul-cate">
            <?php
            $classcategoria = '';
            foreach ($categoriasmenu as $catemenu) {
                // Verifica a categoria atual
                if ($pagina == 'categorias') {
                    if ($itemid == intval($catemenu->categoriaid)) {
                        $classcategoria = 'active-cate';
                    } else {
                        $classcategoria = '';
                    }
                }
                if ($pagina == 'subcategorias') {
                    if ($idtwo == intval($catemenu->categoriaid)) {
                        $classcategoria = 'active-cate';
                    } else {
                        $classcategoria = '';
                    }
                }
                if ($pagina == 'produtos' && $acao == 'detalhes') {
                    if ($idtwo == intval($catemenu->categoriaid)) {
                        $classcategoria = 'active-cate';
                    } else {
                        $classcategoria = '';
                    }
                }
            ?>
                <li><a href="<?php echo BASE_URL; ?>/categorias/listar/<?php echo $catemenu->categoriaid; ?>" class="<?php echo $classcategoria; ?>"><?php echo $catemenu->namecategoria; ?></a>
                    <ul class="ul-subcate">
                        <?php
                        $subcategoriasmenu = $mscme->getSubcategoriasByIdCategoria(intval($catemenu->categoriaid));
                        foreach ($subcategoriasmenu as $subcatemenu) {
                            $classsubcategoria = '';
                            if ($pagina == 'subcategorias') {
                                if ($itemid == intval($subcatemenu->subcategoriaid)) {
                                    $classsubcategoria = 'active-subcate';
                                } else {
                                    $classsubcategoria = '';
                                }
                            }
                            if ($pagina == 'produtos' && $acao == 'detalhes') {
                                if ($idthree == intval($subcatemenu->subcategoriaid)) {
                                    $classsubcategoria = 'active-subcate';
                                } else {
                                    $classsubcategoria = '';
                                }
                            }
                            echo '<li><a href="' . BASE_URL . '/subcategorias/listar/' . $subcatemenu->subcategoriaid . '/' . $catemenu->categoriaid . '" class="' . $classsubcategoria . '">' . $subcatemenu->namesubcategoria . '</a></li>';
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