<div class="container-pages">
    <div class="title-pages">
        <a href="<?php echo BASE_URL . "/home"; ?>">Início</a> &raquo;
        <span class="title-pages-current">Listando Categorias</span>
    </div>
    <div class="ct-box-btns">
        <ul>
            <li>
                <a href="#salvar" class="lnk-btns" id="lnk-add-cate"><i class="fa-solid fa-plus-minus"></i> Adicionar</a>
            </li>
            <li>
                <a href="#salvar" class="lnk-btns" id="refresh-result"><i class="fa-solid fa-arrows-rotate"></i> Atualizar</a>
            </li>
        </ul>
    </div>
    <div class="ct-box-listar list-conteudos">
        <table class="table-list">
            <thead>
                <tr class="thead-list">
                    <th>Código</th>
                    <th class="tdleft">Nome da categoria</th>
                    <th class="tdcenter">Editar</th>
                    <th class="tdcenter">Excluir</th>
                </tr>
            </thead>
            <tbody id="tbody-list-categorias">

            </tbody>
        </table>
        <div class="loader-list" id="loader-list">
            <div class="loader"></div>
        </div>
    </div>
    <div class="ct-pagination" id="pagination">

    </div>
</div>

<!-- Modal para cadastrar categorias -->
<div class="modal-cates" id="modal-cates">
    <div class="container-cates">
        <div class="title-cates"><?php echo $cfg->nameloja; ?> - <span id="name-operation">Cadastrar Categoria</span></div>
        <div class="body-cates">
            <div class="rows">
                <div class="col col-sm-12 forms">
                    <input type="hidden" value="" id="id-cate-editar">
                    <label for="ncategoria" class="label-cadastros">Nome da categoria: <span class="required">(*)</span></label>
                    <input type="text" name="ncategoria" id="ncategoria" placeholder="Informe o nome da categoria">
                </div>
            </div>
        </div>
        <div class="footer-cates">
            <span class="btn-save-cates" id="close-cate" onclick="showAddCates('modal-cates')"><i class="fa-solid fa-xmark"></i> Fechar</span>
            <span class="btn-save-cates" id="save-cates"><i class="fa-solid fa-floppy-disk"></i> Cadastrar</span>
        </div>
    </div>
</div>