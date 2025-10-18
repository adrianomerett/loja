document.addEventListener("DOMContentLoaded", async function () {
    // Chama a função de listar categorias
    await listarSubCategorias();
    // Paginação
    document.getElementById('ct-pagination').addEventListener('click', async function (e) {
        var a = e.target.closest('a[data-pagina]');
        if (!a) return;
        e.preventDefault();
        var page = parseInt(a.dataset.pagina, 10);
        if (isNaN(page)) return;
        if (page === PAGINA_ATUAL) return;
        PAGINA_ATUAL = page;
        document.body.scrollTop = 0;
        document.documentElement.scrollTo({
            top: 0, behavior: 'smooth'
        });
        await listarSubCategorias();
    });
});

// listar categorias
async function listarSubCategorias() {
    try {
        showLoader();
        let req = await api.get('/subcategorias/listar/', {
            params: {
                subcategoriaid: ITEM_ID,
                pagina_atual: PAGINA_ATUAL,
                por_pagina: POR_PAGINA
            }
        });
        showLoader();
        let { status, dados, paginacao } = req.data;
        if (!status) {
            console.log(req.data);
            return;
        }
        if(Object.keys(dados).length <= 0){
            document.getElementById("list-products").innerHTML = htmlNotResults('Não há produtos para exibir nesta subcategoria...');
            return false;
        }
        let html = '';
        for (let i of dados) {
            html += generateHtmlListProducts(i);
        }
        document.getElementById("list-products").innerHTML = html;
        // HTML DA PAGINAÇÃO
        PAGINA_ATUAL = paginacao.pagina_atual;
        TOTAL_PAGINA = paginacao.total_paginas;
        let htmlpagination = createPagination(PAGINA_ATUAL, TOTAL_PAGINA);
        document.getElementById('ct-pagination').innerHTML = htmlpagination;
    } catch (e) {
        showLoader();
        console.log(e);
    }
}