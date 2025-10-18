<footer class="container-footer">
    <div class="rows">
        <div class="col col-sm-12 col-md-6 col-lg-4 col-cards-footer">
            <div class="ct-card-footer">
                <div class="title-card-footer">Venha até a nossa loja</div>
                <div class="bory-footer">
                    <div class="info-footer">
                        <div class="txt-info-footer"><i class="fa-solid fa-city"></i> Cidade: <?php echo $cfg->cidade; ?></div>
                        <div class="txt-info-footer"><i class="fa-solid fa-map-location"></i> Bairro: <?php echo $cfg->bairro; ?></div>
                        <div class="txt-info-footer"><i class="fa-solid fa-location-dot"></i> Rua: <?php echo $cfg->rua; ?> Nº <?php echo $cfg->numero; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-sm-12 col-md-6 col-lg-4 col-cards-footer">
            <div class="ct-card-footer">
                <div class="title-card-footer">Nossos meios de comunicação</div>
                <div class="bory-footer">
                    <div class="info-footer">
                        <div class="txt-info-footer"><i class="fa-solid fa-phone-volume"></i> Fone: <?php echo $cfg->fone; ?></div>
                        <div class="txt-info-footer"><i class="fa-brands fa-whatsapp"></i> WhatsApp: <?php echo $cfg->celular; ?></div>
                        <div class="txt-info-footer"><i class="fa-regular fa-envelope"></i> E-mail: <?php echo $cfg->email; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-sm-12 col-md-6 col-lg-4 col-cards-footer">
            <div class="ct-card-footer">
                <div class="title-card-footer">Nossas redes sociais</div>
                <div class="bory-footer">
                    <div class="info-footer">
                        <div class="txt-info-footer"><i class="fa-brands fa-square-facebook"></i> <?php echo $cfg->facebook; ?></div>
                        <div class="txt-info-footer"><i class="fa-brands fa-instagram"></i> <?php echo $cfg->instagran; ?></div>
                        <div class="txt-info-footer"><i class="fa-brands fa-x-twitter"></i> <?php echo $cfg->x; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rows">
        <div class="col col-sm-12 col-md-12 col-lg-12 byversion"><span>&copy; <?php echo $cfg->nameloja; ?> -  V 1.0.0</span></div>
    </div>
</footer>
<!-- Close Menu Vertical -->
<div class="active-close-menuv" id="close-menuv"></div>
<!-- Scripts -->
 <script type="text/javascript">
    const BASE_URL = "<?php echo BASE_URL; ?>";
    const URL_API = "<?php echo URL_API; ?>";
    const ITEM_ID = "<?php echo $itemid; ?>";
    const URL_PAINEL = "<?php echo URL_PAINEL; ?>";
    // paginação
    var PAGINA_ATUAL = 1;
    var POR_PAGINA = 5;
    var TOTAL_PAGINA = 0;
 </script>
<script src="<?php echo URL_PAINEL?>/public/assets/js/axios.min.js"></script>
<script src="<?php echo ASSETS . "/js/loja.js?version=" . VERSION . ""; ?>" type="text/javascript"></script>
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
