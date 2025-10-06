<div class="container-pages">
    <div class="title-pages">
        <a href="<?php echo BASE_URL . "/home/"; ?>">Início</a> &raquo;
        <a href="<?php echo BASE_URL . "/produtos/listar/"; ?>">Produtos</a> &raquo;
        <span class="title-pages-current">Listar Produtos</span>
    </div>
    <div class="ct-box-btns">
        <ul>
            <li>
                <a href="<?php echo BASE_URL . "/produtos/cadastrar"; ?>" class="lnk-btns">
                    <i class="fa-solid fa-user-plus"></i> Cadastrar
                </a>
            </li>
            <li>
                <a href="#salvar" class="lnk-btns" id="editi-product"><i class="fa-solid fa-pen-to-square"></i>Editar</a>
            </li>
            <li>
                <a href="#salvar" class="lnk-btns"><i class="fa-solid fa-trash"></i> Excluir</a>
            </li>
            <li>
                <a href="#salvar" class="lnk-btns" id="filter-product"><i class="fa-solid fa-filter"></i> Filtrar</a>
            </li>
        </ul>
    </div>
    <div class="ct-box-listar list-conteudos">
        <table class="table-list">
            <thead>
                <tr class="thead-list">
                    <th><i class="fa-solid fa-list-check"></i></th>
                    <th>Código</th>
                    <th class="tdcenter">Foto</th>
                    <th class="tdleft">Titulo</th>
                    <th class="tdleft">Categoria</th>
                    <th class="tdleft">Subcategoria</th>
                    <th>Estoque</th>
                    <th>Valor de Custo</th>
                    <th>Valor de Venda</th>
                    <th>Preço de Oferta</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="tbody-list">

            </tbody>
        </table>
        <div class="loader-list" id="loader-list">
            <div class="loader"></div>
        </div>
    </div>
    <div class="ct-pagination" id="pagination">

    </div>
</div>
<!-- Modal de pesquisa -->
<div class="modal-pesquisa" id="modal-pesquisa">
    <div class="container-pesquisa">
        <div class="title-pesquisa"><?php echo $cfg->nameloja; ?> - Pesquisa de Produtos</div>
        <div class="bory-pesquisa">
            <div class="row">
                <div class="col col-sm-12 forms">
                    <label for="pesquisa" class="label-cadastros">Titulo do produto: <span class="required">(*)</span></label>
                    <input type="text" name="pesquisa" id="pesquisa" placeholder="Pesquise por um título...">
                </div>
            </div>
        </div>
        <div class="footer-pesquisa">
            <span class="btn-save-pesquisa" id="close-pesquisa" onclick="showPesquisa('modal-pesquisa')"><i class="fa-solid fa-xmark"></i> Fechar</span>
            <span class="btn-save-pesquisa" id="go-pesquisa"><i class="fa-solid fa-search"></i> Pesquisar</span>
        </div>
    </div>
</div>