<?php
require_once MODELS . 'mcontatos.php';
$mcd = new Mcontatos();
$dc = $mcd->getContactDetails(intval($ideditar));
if (count($dc) <= 0) {
    require_once(ROOT_PAGES . "404" . DS . "404.php");
    return;
}
$dc = $dc[0];
// Atualiza o status
$mcd->updateStatus(intval($ideditar), 'V');
?>
<div class="container-pages">
    <div class="title-pages">
        <a href="<?php echo BASE_URL . "/home"; ?>">Início</a> &raquo;
        <a href="<?php echo BASE_URL . "/contatos/listar/"; ?>">Contatos</a> &raquo;
        <span class="title-pages-current">Detalhes de Contato</span>
    </div>
    <div class="ct-box-btns">
        <ul>
            <li>
                <a href="<?php echo BASE_URL . "/contatos/listar"; ?>" class="lnk-btns">
                    <i class="fa-solid fa-list"></i> Listar
                </a>
            </li>
        </ul>
    </div>
    <div class="ct-box-cadastros">
        <div class="elements-contato">
            <div class="first-element">Remetente:</div>
            <div class="last-element"><?php echo $dc->nome; ?></div>
        </div>
        <div class="elements-contato">
            <div class="first-element">Assunto:</div>
            <div class="last-element"><?php echo $dc->assunto; ?></div>
        </div>
        <div class="elements-contato">
            <div class="first-element">E-mail:</div>
            <div class="last-element"><?php echo $dc->email; ?></div>
        </div>
        <div class="elements-contato">
            <div class="first-element">Telefone:</div>
            <div class="last-element"><?php echo $dc->telefone; ?></div>
        </div>
        <div class="elements-contato">
            <div class="first-element">Data:</div>
            <div class="last-element"><?php echo date_format(date_create($dc->data), 'd/m/Y H:i:s'); ?></div>
        </div>
        <form class="formlist">
            <fieldset>
                <legend>Mensagem recebida</legend>
                <p><?php echo $dc->msg; ?></p>
            </fieldset>
        </form>
    </div>
</div>