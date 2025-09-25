<div class="container-pages">
    <div class="title-pages">
        <a href="<?php echo BASE_URL . "/home"; ?>">Início</a> &raquo;
        <a href="<?php echo BASE_URL . "/usuarios/listar"; ?>">Usuários</a> &raquo;
        <span class="title-pages-current">Cadastrar Usuários</span>
    </div>
    <div class="ct-box-btns">
        <ul>
            <li>
                <a href="#salvar" class="lnk-btns" id="save-user"><i class="fa-solid fa-floppy-disk"></i> Salvar</a>
            </li>
            <li>
                <a href="<?php echo BASE_URL . "/usuarios/listar"; ?>" class="lnk-btns">
                    <i class="fa-solid fa-list"></i> Listar
                </a>
            </li>
        </ul>
    </div>
    <div class="ct-box-cadastros">
        <form id="form-save-user" class="myforms">
            <fieldset>
                <legend>Informe os dados do formulário e clique em salvar</legend>
                <div class="col col-12 titlecadastros">Nome / Email</div>
                <div class="rows">
                    <div class="col col-sm-6 col-md-4 col-lg-4 forms">
                        <label for="nome" class="label-cadastros">Nome: <span class="required">(*)</span></label>
                        <input type="text" name="nome" id="nome" placeholder="Nome do usuário">
                    </div>
                    <div class="col col-sm-6 col-md-4 col-lg-4 forms">
                        <label for="sobrenome" class="label-cadastros">Sobrenome: <span class="required">(*)</span></label>
                        <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome do usuário">
                    </div>
                    <div class="col col-sm-6 col-md-4 col-lg-4 forms">
                        <label for="email" class="label-cadastros">Email: <span class="required">(*)</span></label>
                        <input type="text" name="email" id="email" placeholder="Email do usuário">
                    </div>
                </div>
                <div class="col col-12 titlecadastros">Senha / Status / Level</div>
                <div class="rows">
                    <div class="col col-sm-6 col-md-4 col-lg-4 forms">
                        <label for="password" class="label-cadastros">Senha: <span class="required">(*)</span></label>
                        <input type="password" name="password" id="password" placeholder="Informe uma senha">
                    </div>
                    <div class="col col-sm-6 col-md-4 col-lg-4 forms">
                        <label for="cpassword" class="label-cadastros">Confirmar Senha: <span class="required">(*)</span></label>
                        <input type="password" name="cpassword" id="cpassword" placeholder="Repita a senha novamente">
                    </div>
                    <div class="col col-sm-6 col-md-4 col-lg-2 forms">
                        <label for="status" class="label-cadastros">Status: <span class="required">(*)</span></label>
                        <select name="status" id="status">
                            <option value="0" selected="selected">Selecione um status...</option>
                            <option value="A">Ativo</option>
                            <option value="I">Inativo</option>
                        </select>
                    </div>
                    <div class="col col-sm-6 col-md-4 col-lg-2 forms">
                        <label for="level" class="label-cadastros">Nível de acesso: <span class="required">(*)</span></label>
                        <select name="level" id="level">
                            <option value="0">Selecione um level...</option>
                            <option value="M">Master</option>
                            <option value="A">Admin</option>
                            <option value="S">Supervisor</option>
                        </select>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>