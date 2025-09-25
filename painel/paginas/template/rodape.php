    <div class="container-rodape">
        <span class="copyright"> &copy; <?php echo $cfg->nameloja; ?> - Versão 1.0.0</span>
    </div>
    <!-- Modal fechar menu -->
    <div class="" id="active-close-menu"></div>
    <!-- Modal loader geral -->
    <div class="full-loader" id="full-loader">
        <div class="loader"></div>
    </div>
    <!-- Modal de alerts -->
    <div class="alert-modal" id="alert-modal">
        <div class="alert-modal-content">
            <div class="title-alert"><i class="fa-solid fa-circle-exclamation"></i> <?php echo $cfg->nameloja; ?></div>
            <div class="body-alert">
                <div class="msg-alert alert-error" id="msg-alert">Informe o motivo da alerta.</div>
            </div>
            <div class="footer-alert">
                <span class="yes-alert" id="yes-alert" onclick="hideAlert();">OK</span>
            </div>
        </div>
    </div>
    <!-- Modal de confirmação -->
    <div class="modal-confirm" id="modal-confirm">
        <div class="container-confirm" id="container-confirm">
            <div class="title-confirm"><i class="fa-solid fa-circle-question"></i> Confirmação</div>
            <div class="body-confirm">
                <div class="msg-confirm" id="msg-confirm"></div>
            </div>
            <div class="footer-confirm">
                <span class="lnk-confirm" id="btn-confirm-no">Não</span>
                <span class="lnk-confirm" id="btn-yes-confirm">Sim</span>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script type="text/javascript">
        const BASE_URL = "<?php echo BASE_URL; ?>";
        const URL_API = "<?php echo URL_API; ?>";
    </script>
    <script src="<?php echo BASE_URL . "/public/assets/js/axios.min.js" ?>"></script>
    <script src="<?php echo BASE_URL . "/public/assets/js/painel.js?version=" . VERSION; ?>"></script>
<?php
if (isset($assets['js']) && count($assets['js']) > 0) {
foreach ($assets['js'] as $key => $value) {
if($key != $pagina){
continue;
}
if (isset($assets['js'][$pagina][$acao]) && count($assets['js'][$pagina][$acao]) > 0) {
foreach ($assets['js'][$pagina][$acao] as $key => $value) {
?>
    <script src="<?php echo BASE_URL . "/public/assets/js/" . $value; ?>.js?version=<?php echo VERSION; ?>"></script>
<?php
}
}
}
}
?>