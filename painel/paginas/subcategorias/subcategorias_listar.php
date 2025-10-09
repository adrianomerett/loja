<?php
require ROOT_HELPERS . 'hloja.php';
?>
<div class="container-pages">
    <div class="title-pages">
        <a href="<?php echo BASE_URL . "/home"; ?>">Início</a> &raquo;
        <span class="title-pages-current">Listando Subcategorias</span>
    </div>
    <div class="ct-box-btns">
        <ul>
            <li>
                <a href="#adicionar" class="lnk-btns" id="lnk-add-cate"><i class="fa-solid fa-plus-minus"></i> Adicionar</a>
            </li>
            <li>
                <a href="#" class="lnk-btns" id="refresh-result"><i class="fa-solid fa-arrows-rotate"></i> Atualizar</a>
            </li>
        </ul>
    </div>
    <div class="ct-box-listar list-conteudos">
        <table class="table-list">
            <thead>
                <tr class="thead-list">
                    <th>Código</th>
                    <th class="tdleft">Nome da categoria</th>
                    <th class="tdleft">Nome da subcategoria</th>
                    <th class="tdcenter">Editar</th>
                    <th class="tdcenter">Excluir</th>
                </tr>
            </thead>
            <tbody id="tbody-list-subcategorias">

            </tbody>
        </table>
        <div class="loader-list" id="loader-list">
            <div class="loader"></div>
        </div>
    </div>
    <div class="ct-pagination" id="pagination">

    </div>
</div>

<!-- Modal para cadastrar subcategorias -->
<div class="modal-cates" id="modal-subcategorias">
    <div class="container-cates">
        <div class="title-cates"><?php echo $cfg->nameloja; ?> - <span id="name-operation">Cadastrar Subcategoria</span></div>
        <div class="body-cates">
            <div class="rows">
                <div class="col col-sm-12 forms">
                    <label for="nscategoria" class="label-cadastros">Categoria: <span class="required">(*)</span></label>
                    <input type="hidden" value="" id="id-operation" name="id-operation">
                    <select name="nscategoria" id="nscategoria">

                    </select>
                </div>
                <div class="col col-sm-12 forms">
                    <label for="ncsubcategoria" class="label-cadastros">Subcategoria: <span class="required">(*)</span></label>
                    <input type="text" name="ncsubcategoria" id="ncsubcategoria" placeholder="Informe o nome da subcategoria">
                </div>
            </div>
        </div>
        <div class="footer-cates">
            <span class="btn-save-cates" id="close-subcategoria" onclick="showAddSubCates('modal-subcategorias')"><i class="fa-solid fa-xmark"></i> Fechar</span>
            <span class="btn-save-cates" id="save-subcategoria"><i class="fa-solid fa-floppy-disk"></i> Cadastrar</span>
        </div>
    </div>
</div>
<script type="text/javascript">
    const CATEGORIAS_EXISTENTES = '<?php echo selectcategorias(); ?>';
</script>