<div class="container-main">
    <div class="ct-path">
        <nav class="container-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Início</a></li>
                <li class="breadcrumb-item itemraquo">&raquo;</li>
                <li class="breadcrumb-item active">Contato</li>
            </ol>
        </nav>
    </div>
    <div class="container container-list-products">
        <div class="rows">
            <div class="col col-sm-12 col-md-12 col-lg-12">
                <p class="description-contato">Dúvidas, críticas ou sugestões? Entre em contato conosco, preenchendo o formulário abaixo</p>
            </div>
        </div>
        <div class="rows">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="ct-retur-msg" id="ct-retur-msg">
                    <span class="msg info">Informe os campos abaixo para enviar sua mensagem...</span>
                </div>
            </div>
        </div>
        <form name="frm-contact" id="frm-contact">
            <div class="rows">
                <div class="col col-sm-12 col-md-4 col-lg-3 forms">
                    <label for="nome">Nome: <span class="required">(*)</span></label>
                    <input type="text" name="nome" id="nome" />
                </div>
                <div class="col col-sm-12 col-md-4 col-lg-3 forms">
                    <label for="email">Email: <span class="required">(*)</span></label>
                    <input type="text" name="email" id="email" />
                </div>
            </div>
            <div class="rows">
                <div class="col col-sm-12 col-md-4 col-lg-3 forms">
                    <label for="fone">Telefone: <span class="required">(*)</span></label>
                    <input type="text" name="fone" id="fone" />
                </div>
                <div class="col col-sm-12 col-md-4 col-lg-3 forms">
                    <label for="assunto">Assunto: <span class="required">(*)</span></label>
                    <input type="text" name="assunto" id="assunto" />
                </div>
            </div>
            <div class="rows">
                <div class="col col-sm-12 col-md-12 col-lg-8 forms">
                    <label for="mensagem">Mensagem: <span class="required">(*)</span></label>
                    <textarea name="mensagem" id="mensagem" rows="7"></textarea>
                </div>
            </div>
            <div class="rows">
                <div class="col col-sm-12 col-md-12 col-lg-12">
                    <span class="btn-send-msg"><i class="fa-solid fa-paper-plane"></i> Enviar</span>
                </div>
            </div>
        </form>
    </div>
</div>