<div class="container-pages">
    <div class="title-pages">
        <a href="<?php echo BASE_URL . "/home/"; ?>">Início</a> &raquo;
        <span class="title-pages-current">Editar Configurações da loja</span>
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
                    <div class="col col-sm-12 col-md-6 col-lg-5 forms">
                        <label for="nameloja" class="label-cadastros">Nome da fantasia: <span class="required">(*)</span></label>
                        <input type="text" name="nameloja" id="nameloja" value="<?php echo $cfg->nameloja; ?>" placeholder="Informe o nome da fantasia">
                    </div>
                    <div class="col col-sm-12 col-md-6 col-lg-5 forms">
                        <label for="slogan" class="label-cadastros">Slogan:</label>
                        <input type="text" name="slogan" id="slogan" value="<?php echo $cfg->slogan; ?>" placeholder="Informe o slogan da empresa">
                    </div>
                    <div class="col col-sm-12 col-md-6 col-lg-2 forms">
                        <label for="version" class="label-cadastros">Versão: <span class="required">(*)</span></label>
                        <input type="text" name="version" id="version" value="<?php echo $cfg->version; ?>" placeholder="Versão da loja">
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Meios de comunicação</legend>
                <div class="rows">
                    <div class="col col-sm-12 col-md-6 col-lg-4 forms">
                        <label for="email" class="label-cadastros">E-mail: <span class="required">(*)</span></label>
                        <input type="text" name="email" id="email" value="<?php echo $cfg->email; ?>" placeholder="Informe o email da empresa">
                    </div>
                    <div class="col col-sm-12 col-md-6 col-lg-4 forms">
                        <label for="fone" class="label-cadastros">Fone comercial: <span class="required">(*)</span></label>
                        <input type="text" name="fone" id="fone" value="<?php echo $cfg->fone; ?>" placeholder="Informe o telefone comercial da empresa">
                    </div>
                    <div class="col col-sm-12 col-md-6 col-lg-4 forms">
                        <label for="celular" class="label-cadastros">Celular: <span class="required">(*)</span></label>
                        <input type="text" name="celular" id="celular" value="<?php echo $cfg->celular; ?>" placeholder="Informe o telefone celular da empresa">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Endereço da loja</legend>
                <div class="rows">
                    <div class="col col-sm-12 col-md-6 col-lg-3 forms">
                        <label for="cidade" class="label-cadastros">Cidade: <span class="required">(*)</span></label>
                        <input type="text" name="cidade" id="cidade" value="<?php echo $cfg->cidade; ?>" placeholder="Informe a cidade aonde a loja está localizada">
                    </div>
                    <div class="col col-sm-12 col-md-6 col-lg-3 forms">
                        <label for="bairro" class="label-cadastros">Bairro: <span class="required">(*)</span></label>
                        <input type="text" name="bairro" id="bairro" value="<?php echo $cfg->bairro; ?>" placeholder="Informe o bairro aonde a loja está localizada">
                    </div>
                    <div class="col col-sm-12 col-md-6 col-lg-4 forms">
                        <label for="rua" class="label-cadastros">Rua: <span class="required">(*)</span></label>
                        <input type="text" name="rua" id="rua" value="<?php echo $cfg->rua; ?>" placeholder="Informe a rua aonde a loja está localizada">
                    </div>
                    <div class="col col-sm-12 col-md-6 col-lg-2 forms">
                        <label for="numero" class="label-cadastros">Número: <span class="required">(*)</span></label>
                        <input type="text" name="numero" id="numero" value="<?php echo $cfg->numero; ?>" oninput="onlyNumbers(this)" placeholder="Informe o número da loja">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Redes sociais da loja</legend>
                <div class="rows">
                    <div class="col col-sm-12 col-md-6 col-lg-4 forms">
                        <label for="instagram" class="label-cadastros">Instragram:</label>
                        <input type="text" name="instagram" id="instagram" value="<?php echo $cfg->instagran; ?>" placeholder="Informe a cidade aonde a loja está localizada">
                    </div>
                    <div class="col col-sm-12 col-md-6 col-lg-4 forms">
                        <label for="facebook" class="label-cadastros">Facebook:</label>
                        <input type="text" name="facebook" id="facebook" value="<?php echo $cfg->facebook; ?>" placeholder="Informe o bairro aonde a loja está localizada">
                    </div>
                    <div class="col col-sm-12 col-md-6 col-lg-4 forms">
                        <label for="x" class="label-cadastros">x:</label>
                        <input type="text" name="x" id="x" value="<?php echo $cfg->x; ?>" placeholder="Informe o número da loja">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Configurações de exibições de produtos</legend>
                <div class="rows">
                    <div class="col col-sm-12 col-md-6 col-lg-4 forms">
                        <label for="exibir_preco" class="label-cadastros">Exibir preços de produtos:</label>
                        <select name="exibir_preco" id="exibir_preco">
                            <?php
                            if ($cfg->exibir_preco == 'S') {
                                echo '<option value="S" selected>Sim</option>';
                                echo '<option value="N">Não</option>';
                            } else {
                                echo '<option value="N" selected>Não</option>';
                                echo '<option value="S">Sim</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col col-sm-12 col-md-6 col-lg-4 forms">
                        <label for="exibir_estoque" class="label-cadastros">Exibir quantidade em estoque:</label>
                        <select name="exibir_estoque" id="exibir_estoque">
                            <?php
                            if ($cfg->exibir_estoque == 'S') {
                                echo '<option value="S" selected>Sim</option>';
                                echo '<option value="N">Não</option>';
                            } else {
                                echo '<option value="N" selected>Não</option>';
                                echo '<option value="S">Sim</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col col-sm-12 col-md-6 col-lg-4 forms">
                        <label for="exibir_produto_sem_estoque" class="label-cadastros">Exibir produto sem estoque:</label>
                        <select name="exibir_produto_sem_estoque" id="exibir_produto_sem_estoque">
                            <?php
                            if ($cfg->exibir_produto_sem_estoque == 'S') {
                                echo '<option value="S" selected>Sim</option>';
                                echo '<option value="N">Não</option>';
                            } else {
                                echo '<option value="N" selected>Não</option>';
                                echo '<option value="S">Sim</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>