<div class="container-pages">
    <div class="title-pages">
        <a href="<?php echo BASE_URL . "/home/"; ?>">Início</a> &raquo;
        <a href="<?php echo BASE_URL . "/produtos/listar/"; ?>">Produtos</a> &raquo;
        <span class="title-pages-current">Cadastrar Produtos</span>
    </div>
    <div class="ct-box-btns">
        <ul>
            <li>
                <a href="#salvar" class="lnk-btns"><i class="fa-solid fa-floppy-disk"></i> Salvar</a>
            </li>
            <li>
                <a href="<?php echo BASE_URL . "/produtos/listar"; ?>" class="lnk-btns">
                    <i class="fa-solid fa-list"></i> Listar
                </a>
            </li>
        </ul>
    </div>
    <div class="ct-box-cadastros">
        <form id="form-save-products" class="myforms">
            <fieldset>
                <legend>Informações principais do produto</legend>
                <div class="col col-12 titlecadastros">Título / Categorias</div>
                <div class="rows">
                    <div class="col col-sm-12 col-md-12 col-lg-6 forms">
                        <label for="titulo" class="label-cadastros">Título: <span class="required">(*)</span></label>
                        <input type="text" name="titulo" id="titulo" placeholder="Informe o título do produto">
                    </div>
                    <div class="col col-sm-6 col-md-6 col-lg-3 forms">
                        <div class="ct-select-cate">
                            <div class="content-select">
                                <label for="categoria" class="label-cadastros">Categoria: <span class="required">(*)</span></label>
                                <select name="categoria" id="categoria">
                                    <option value="0">Selecione uma categoria...</option>
                                    <option value="1">Categoria 1</option>
                                    <option value="2">Categoria 2</option>
                                    <option value="3">Categoria 3</option>
                                    <option value="4">Categoria 4</option>
                                </select>
                            </div>
                            <div class="ct-buttons-add-cates">
                                <span class="lnk-add-cates"><i class="fa-solid fa-plus"></i> Adicionar</span>
                            </div>
                        </div>
                    </div>
                    <div class="col col-sm-6 col-md-6 col-lg-3 forms">
                        <div class="ct-select-cate">
                            <div class="content-select">
                                <label for="subcategoria" class="label-cadastros">Subcategoria: <span class="required">(*)</span></label>
                                <select name="subcategoria" id="subcategoria">
                                    <option value="0">Selecione uma subcategoria...</option>
                                    <option value="1">Categoria 1</option>
                                    <option value="2">Categoria 2</option>
                                    <option value="3">Categoria 3</option>
                                    <option value="4">Categoria 4</option>
                                </select>
                            </div>
                            <div class="ct-buttons-add-cates">
                                <span class="lnk-add-cates"><i class="fa-solid fa-plus"></i> Adicionar</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12 titlecadastros">Estoque / Preço / Status</div>
                <div class="rows">
                    <div class=" col col-sm-6 col-md-4 col-lg-2 forms">
                        <label for="estoque" class="label-cadastros">Estoque: <span class="required">(*)</span></label>
                        <input type="text" name="estoque" id="estoque" placeholder="Quantidade disponível">
                    </div>
                    <div class=" col col-sm-6 col-md-4 col-lg-2 forms">
                        <label for="valorcusto" class="label-cadastros">Valor de custo: <span class="required">(*)</span></label>
                        <input type="text" name="valorcusto" id="valorcusto" placeholder="R$ 0,00">
                    </div>
                    <div class=" col col-sm-6 col-md-4 col-lg-2 forms">
                        <label for="valorovenda" class="label-cadastros">Valor de venda: <span class="required">(*)</span></label>
                        <input type="text" name="valorovenda" id="valorovenda" placeholder="R$ 0,00">
                    </div>
                    <div class=" col col-sm-6 col-md-4 col-lg-2 forms">
                        <label for="valoroferta" class="label-cadastros">Valor de oferta: <span class="required">(*)</span></label>
                        <input type="text" name="valoroferta" id="valoroferta" placeholder="R$ 0,00">
                    </div>
                    <div class=" col col-sm-6 col-md-4 col-lg-2 forms">
                        <label for="exibirpreco" class="label-cadastros">Exibir preço: <span class="required">(*)</span></label>
                        <select name="exibirpreco" id="exibirpreco">
                            <option value="S" selected="selected">Sim</option>
                            <option value="N">Não</option>
                        </select>
                    </div>
                    <div class=" col col-sm-6 col-md-4 col-lg-2 forms">
                        <label for="status" class="label-cadastros">Status: <span class="required">(*)</span></label>
                        <select name="status" id="status">
                            <option value="A" selected="selected">Ativo</option>
                            <option value="I">Inativo</option>
                        </select>
                    </div>
                </div>
            </fieldset>
            <div class="rows rows-information">
                <div class="col col-sm-12 col-md-6 ct-description">
                    <fieldset>
                        <legend>Descrição do produto</legend>
                        <div class="desciption" id="descricao"></div>
                    </fieldset>
                </div>
                <div class="col col-sm-12 col-md-6 ct-information">
                    <fieldset>
                        <legend>Informações técnicas</legend>
                        <div class="" id="informacao"></div>
                    </fieldset>
                </div>
            </div>
            <div class="rows">
                <div class="col col-sm-12 col-fotos">
                    <fieldset>
                        <legend>Fotos para o produto</legend>
                        <div class="rows rows-ct-foto">
                            <div class="col col-sm-12 col-lg-2 ct-buttom-upload">
                                <input type="file" name="fotos[]" id="fotos" multiple>
                                <span class="lnk-upload" id="lnk-select-fotos"><i class="fa-regular fa-folder-closed"></i> Selecionar Fotos</span>
                                <span class="lnk-upload" id="lnk-upload-fotos"><i class="fa-solid fa-cloud-arrow-up"></i> Enviar Fotos</span>
                            </div>
                            <div class="col col-sm-12 col-lg-10">
                                <div class="rows rowsfotos" id="rowsfotos">
                                    
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal para cadastrar categorias -->
<div class="modal-cates" id="modal-cates">
    <div class="container-cates">
        <div class="title-cates"><?php echo $cfg->nameloja; ?> - Cadastrar Categoria</div>
        <div class="body-cates">
            <div class="rows">
                <div class="col col-sm-12 forms">
                    <label for="ncategoria" class="label-cadastros">Nome da categoria: <span class="required">(*)</span></label>
                    <input type="text" name="ncategoria" id="ncategoria" placeholder="Informe o nome da categoria">
                </div>
            </div>
        </div>
        <div class="footer-cates">
            <span class="btn-save-cates" id="close-cate"><i class="fa-solid fa-xmark"></i> Fechar</span>
            <span class="btn-save-cates" id="save-cates"><i class="fa-solid fa-floppy-disk"></i> Cadastrar</span>
        </div>
    </div>
    <!-- Modal para cadastrar subcategorias -->
    <div class="modal-cates" id="modal-subcategorias">
        <div class="container-cates">
            <div class="title-cates"><?php echo $cfg->nameloja; ?> - Cadastrar Subcategoria</div>
            <div class="body-cates">
                <div class="rows">
                    <div class="col col-sm-12 forms">
                        <label for="nscategoria" class="label-cadastros">Categoria: <span class="required">(*)</span></label>
                        <select name="nscategoria" id="nscategoria">
                            <option value="0">Selecione uma categoria...</option>
                            <option value="1">Categoria 1</option>
                            <option value="2">Categoria 2</option>
                            <option value="3">Categoria 3</option>
                        </select>
                    </div>
                    <div class="col col-sm-12 forms">
                        <label for="ncsubcategoria" class="label-cadastros">Subcategoria: <span class="required">(*)</span></label>
                        <input type="text" name="ncsubcategoria" id="ncsubcategoria" placeholder="Informe o nome da subcategoria">
                    </div>
                </div>
            </div>
            <div class="footer-cates">
                <span class="btn-save-cates" id="close-subcategoria"><i class="fa-solid fa-xmark"></i> Fechar</span>
                <span class="btn-save-cates" id="save-subcategoria"><i class="fa-solid fa-floppy-disk"></i> Cadastrar</span>
            </div>
        </div>
    </div>
</div>