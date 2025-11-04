<div class="container-pages">
    <div class="title-pages">
        <a href="<?php echo BASE_URL . "/home/"; ?>">Início</a> &raquo;
        <span class="title-pages-current">Editar Configurações da Loja</span>
    </div>
    <div class="ct-box-btns">
        <ul>
            <li>
                <a href="#salvar" class="lnk-btns" id="save-config">
                    <i class="fa-solid fa-floppy-disk"></i> Salvar
                </a>
            </li>
        </ul>
    </div>
    <div class="ct-box-cadastros">
        <form id="form-save-products" class="myforms">
            <fieldset>
                <legend>Informações principais da loja</legend>
                <div class="rows">
                    <div class="col col-sm-12 col-md-12 col-lg-5 forms">
                        <label for="nameloja" class="label-cadastros">Nome da fantasia: <span class="required">(*)</span></label>
                        <input type="text" name="nameloja" id="nameloja" placeholder="Informe o nome da fantasia">
                    </div>
                    <div class="col col-sm-12 col-md-12 col-lg-5 forms">
                        <label for="slogan" class="label-cadastros">Slogan:</label>
                        <input type="text" name="slogan" id="slogan" placeholder="Informe o slogan da empresa">
                    </div>
                    <div class="col col-sm-12 col-md-12 col-lg-2 forms">
                        <label for="version" class="label-cadastros">Versão:</label>
                        <input type="text" name="version" id="version" placeholder="Versão da loja">
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Meios de comunicação</legend>
                <div class="rows">
                    <div class="col col-sm-12 col-md-12 col-lg-4 forms">
                        <label for="email" class="label-cadastros">E-mail: <span class="required">(*)</span></label>
                        <input type="text" name="email" id="email" placeholder="Informe o email da empresa">
                    </div>
                    <div class="col col-sm-12 col-md-12 col-lg-4 forms">
                        <label for="fone" class="label-cadastros">Fone comercial:</label>
                        <input type="text" name="fone" id="fone" placeholder="Informe o telefone comercial da empresa">
                    </div>
                    <div class="col col-sm-12 col-md-12 col-lg-4 forms">
                        <label for="celular" class="label-cadastros">Celular:</label>
                        <input type="text" name="celular" id="celular" placeholder="Informe o telefone celular da empresa">
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>