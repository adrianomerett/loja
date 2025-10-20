document.addEventListener("DOMContentLoaded", async function () {

    // Chama a função buscaProdutos
    await buscaProdutos();
});


// Busca produtos
async function buscaProdutos() {
    try {
        const busca = document.getElementById("cpbusca").value;
        showLoader();
        let req = await api.get('/produtos/search/', {
            params: {
                busca: busca,
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
        if (Object.keys(dados).length <= 0) {
            document.getElementById("list-products").innerHTML = htmlNotResults(`Sua busca por "<b>${busca}</b>" não retornou nenhum resultado...`);
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
        console.log(e);
    }
}