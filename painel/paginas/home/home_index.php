<?php
require_once MODELS . 'mprodutos.php';
require_once MODELS . 'mcategorias.php';
require_once MODELS . 'msubcategorias.php';
require_once MODELS . 'musers.php';
require_once MODELS . 'mcontatos.php';
$mp = new Mprodutos();
$mc = new Mcategorias();
$ms = new Msubcategorias();
$mu = new Musers();
$mco = new Mcontatos();
?>
<div class="container-pages">
    <div class="title-pages">
        <a href="<?php echo BASE_URL . "/home/"; ?>">Início</a> &raquo;
        <span class="title-pages-current">Seja bem-vindo ao Painel Administrativo</span>
    </div>
    <div class="home-conteudos">
        <div class="title-resumo-cadastros">Informações de Cadastros do Painel Administrativo</div>
        <div class="rows">
            <div class="col col-sm-6 col-lg-3">
                <div class="ct-cards">
                    <div class="title-card bg-card-green"><i class="fa-solid fa-money-bill-trend-up"></i> Valor de custo investido</div>
                    <div class="bory-card bg-color-green"><span id="vcusto">R$ 0,00</span></div>
                </div>
            </div>
            <div class="col col-sm-6 col-lg-3">
                <div class="ct-cards">
                    <div class="title-card bg-card-green"><i class="fa-solid fa-money-bill-trend-up"></i> Valor com % de lucro</div>
                    <div class="bory-card bg-color-green"><span id="vvenda">R$ 0,00</span></div>
                </div>
            </div>
            <div class="col col-sm-6 col-lg-3">
                <div class="ct-cards">
                    <div class="title-card bg-card-green"><i class="fa-brands fa-shopify"></i> Produtos cadastrados</div>
                    <div class="bory-card bg-color-green"><span id="tpcadastrados">Total: 0</span></div>
                </div>
            </div>
            <div class="col col-sm-6 col-lg-3">
                <div class="ct-cards">
                    <div class="title-card bg-card-goia"><i class="fa-brands fa-shopify"></i> Produtos sem estoque</div>
                    <div class="bory-card bg-color-goia"><span id="tpsemestoque">Total: 0</span></div>
                </div>
            </div>
        </div>
        <div class="rows">
            <div class="col col-sm-6 col-lg-3">
                <div class="ct-cards">
                    <div class="title-card bg-card-goia"><i class="fa-brands fa-shopify"></i> Produtos inativos</div>
                    <div class="bory-card bg-color-goia"><span id="tpinativos">Total: 0</span></div>
                </div>
            </div>
            <div class="col col-sm-6 col-lg-3">
                <div class="ct-cards">
                    <div class="title-card bg-card-goia"><i class="fa-brands fa-shopify"></i> Produtos sem exibir preço</div>
                    <div class="bory-card bg-color-goia"><span id="tpsemexibirpreco">Total: 0</span></div>
                </div>
            </div>
            <div class="col col-sm-6 col-lg-3">
                <div class="ct-cards">
                    <div class="title-card bg-card-purple"><i class="fa-solid fa-folder-open"></i> Categorias cadastradas</div>
                    <div class="bory-card bg-color-purple"><span id="tcategorias">Total: 0</span></div>
                </div>
            </div>
            <div class="col col-sm-6 col-lg-3">
                <div class="ct-cards">
                    <div class="title-card bg-card-purple"><i class="fa-solid fa-folder-tree"></i> Subcategorias cadastradas</div>
                    <div class="bory-card bg-color-purple"><span id="tsubcategorias">Total: 0</span></div>
                </div>
            </div>
            
        </div>
        <div class="rows">
            <div class="col col-sm-6 col-lg-3">
                <div class="ct-cards">
                    <div class="title-card bg-card-blue"><i class="fa-solid fa-users"></i> Usuários Cadastrados</div>
                    <div class="bory-card bg-color-blue"><span id="tusuarios">Total: 0</span></div>
                </div>
            </div>
            <div class="col col-sm-6 col-lg-3">
                <div class="ct-cards">
                    <div class="title-card bg-card-blue"><i class="fa-solid fa-users"></i> Usuários Inativos</div>
                    <div class="bory-card bg-color-blue"><span id="tusersinactives">Total: 0</span></div>
                </div>
            </div>
            <div class="col col-sm-6 col-lg-3">
                <div class="ct-cards">
                    <div class="title-card bg-card-orange"><i class="fa-solid fa-comments"></i> Contatos Recebidos</div>
                    <div class="bory-card bg-color-orange"><span id="tcontatos">Total: 0</span></div>
                </div>
            </div>
            <div class="col col-sm-6 col-lg-3">
                <div class="ct-cards">
                    <div class="title-card bg-card-orange"><i class="fa-solid fa-comment-slash"></i> Contatos não visualizados</div>
                    <div class="bory-card bg-color-orange"><span id="tcontatospending">Total: 0</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var V_CUSTO = <?php echo $mp->getSumValorCusto(); ?>;
    var V_VENDA = <?php echo $mp->getSumValorVenda(); ?>;
    var V_TOTAL_PRODUCTS = <?php echo $mp->countProductsCadastrados(); ?>;
    var V_TOTAL_SEM_ESTOQUE = <?php echo $mp->getProductsSemEstoque(); ?>;
    var V_TOTAL_INATIVOS = <?php echo $mp->getTotalProdutosInativos(); ?>;
    var V_EXIBIR_PRECO = <?php echo $mp->getProdutosSemExibirPreco(); ?>;
    var V_TOTAL_CATEGORIAS = <?php echo $mc->countCategories(); ?>;
    var V_TOTAL_SUBCATEGORIAS = <?php echo $ms->countSubCategories(); ?>;
    var V_TOTAL_USERS = <?php echo $mu->countUsers(); ?>;
    var V_TOTAL_INACTIVE_USERS = <?php echo $mu->countUsersInactive(); ?>;
    var V_TOTAL_CONTACTS = <?php echo $mco->countContacts(); ?>;
    var V_TOTAL_PENDING_CONTACTS = <?php echo $mco->countContactsPending(); ?>;
</script>
