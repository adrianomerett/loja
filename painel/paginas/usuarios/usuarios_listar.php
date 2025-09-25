<div class="container-pages">
    <div class="title-pages">
        <a href="<?php echo BASE_URL . "/home"; ?>">Início</a> &raquo;
        <span class="title-pages-current">Listar Usuários</span>
    </div>
    <div class="ct-box-btns">
        <ul>
            <li>
                <a href="<?php echo BASE_URL . "/usuarios/cadastrar"; ?>" class="lnk-btns">
                    <i class="fa-solid fa-user-plus"></i> Cadastrar
                </a>
            </li>
            <li>
                <a href="#salvar" class="lnk-btns" onclick="deleteUser();"><i class="fa-solid fa-trash"></i> Excluir</a>
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
                    <th><i class="fa-solid fa-list-check"></i></th>
                    <th>Código</th>
                    <th class="tdleft">Nome</th>
                    <th class="tdleft">Sobrenome</th>
                    <th class="tdleft">E-mail</th>
                    <th>Status</th>
                    <th>Nível</th>
                    <th>Cadastrado</th>
                </tr>
            </thead>
            <tbody id="tbody-list">

            </tbody>
        </table>
        <div class="loader-list" id="loader-list">
            <div class="loader"></div>
        </div>
    </div>
    <div class="ct-pagination">

    </div>
</div>