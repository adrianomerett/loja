// paginação
var PAGINA_ATUAL = 1;
var POR_PAGINA = 1;
var TOTAL_PAGINA = 0;

document.addEventListener('DOMContentLoaded', async function () {
    await listarProdutos();
    // Mostrar modal de pesquisa
    document.getElementById('filter-product').addEventListener('click', function () {
        showPesquisa();
    });

    // Pesquisar
    document.getElementById('go-pesquisa').addEventListener('click', async function () {
        PAGINA_ATUAL = 1;
        document.getElementById('pesquisa').classList.remove('is-invalid', 'is-valid');
        showPesquisa();
        await listarProdutos();
    });

    // Paginação
    document.getElementById('pagination').addEventListener('click', async function (e) {
        var a = e.target.closest('a[data-pagina]');
        if (!a) return;
        e.preventDefault();
        var page = parseInt(a.dataset.pagina, 10);
        if (isNaN(page)) return;
        if (page === PAGINA_ATUAL) return;
        PAGINA_ATUAL = page;
        await listarProdutos();
    });
});

async function listarProdutos() {
    try {
        showLoaderList();
        let pesquisa = document.getElementById('pesquisa').value;
        let req = await api.get('/produtos/listar-products/', {
            params: {
                pesquisa: pesquisa,
                pagina_atual: PAGINA_ATUAL,
                por_pagina: POR_PAGINA
            }
        });
        //console.log(req.data);
        showLoaderList();
        let { status, msg, dados, paginacao } = req.data;
        if (!status) {
            showAlert(msg, 'error');
        }
        // se não tem dados
        if (Object.keys(dados).length <= 0) {
            let pesquisa = document.getElementById('pesquisa').value;
            let msg = pesquisa != '' ? `Não foram encontrados resultados para a pesquisa "<b>${pesquisa}</b>..."` : `Não ha produtos cadastrados..."`;
            htmlNotResul(msg, 11);
            document.getElementById('pagination').innerHTML = '';
            return false;
        }
        let htmlproducts = '';
        for (let i of dados) {
            let valorcusto = Number(i.valorcusto).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            let valoroferta = Number(i.valoroferta).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            let valorvenda = Number(i.valorvenda).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            let status = {
                'A': 'Ativo',
                'I': 'Inativo'
            }
            let classemptyestoque = i.estoque == '0' ? ' emptyestaque' : '';
            htmlproducts += `
                <tr class="tr-list" id="tr-${i.produtoid}">
                    <td class="tdcenter"><i class="fa-regular fa-circle-check" id="code-${i.produtoid}"></i></td>
                    <td class="tdcenter tdcode">${String(i.produtoid).padStart(6, '0')}</td>
                    <td class="tdcenter tdimg">
                        <img src="${BASE_URL}/public/upload/produtos/thamb/${i.img}" alt="Foto" class="pre-upload">
                    </td>
                    <td class="tdleft">${i.nome}</td>
                    <td class="tdleft">${i.namecategoria}</td>
                    <td class="tdcenter">${i.namesubcategoria}</td>
                    <td class="tdcenter estoque${classemptyestoque}">${i.estoque}</td>
                    <td class="tdcenter tdmoney">${valorcusto}</td>
                    <td class="tdcenter tdmoney">${valorvenda}</td>
                    <td class="tdcenter tdmoney priceoferta">${valoroferta}</td>
                    <td class="tdcenter">${status[i.status]}</td>
                </tr>`
        }
        PAGINA_ATUAL = paginacao.pagina_atual;
        TOTAL_PAGINA = paginacao.total_paginas;
        // HTML DOS PRODUTOS
        document.getElementById('tbody-list').innerHTML = htmlproducts;
        // HTML DA PAGINAÇÃO
        let htmlpagination = createPagination(PAGINA_ATUAL, TOTAL_PAGINA);
        document.getElementById('pagination').innerHTML = htmlpagination;
    } catch (e) {
        showLoaderList();
        console.log(e);
    }
}

// Show modal de pesquisa
function showPesquisa() {
    document.getElementById(`modal-pesquisa`).classList.toggle('show-pesquisa');
}

// cria o html da paginação
function createPagination(pagina_atual, total_pagina) {
    try {
        let html = '<ul class="paginacao">';
        if (pagina_atual > 1) {
            html += `<li><a href="#" data-pagina="${pagina_atual - 1}">&laquo;</a></li>`;
        } else {
            html += `<li class="disabled" id="before"><span>&laquo;</span></li>`;
        }
        if (pagina_atual > 3) {
            html += `<li><a href="#" data-pagina="1">1</a></li>`;
            if (pagina_atual > 2) {
                html += `<li class="disabled"><span>...</span></li>`;
            }
        }
        let inicio = Math.max(1, pagina_atual - 2);
        let fim = Math.min(total_pagina, pagina_atual + 2);

        for (let i = inicio; i <= fim; i++) {
            if (i === pagina_atual) {
                html += `<li class="ativo"><span>${i}</span></li>`;
            } else {
                html += `<li><a href="#" data-pagina="${i}">${i}</a></li>`;
            }
        }
        if (pagina_atual < total_pagina - 2) {
            if (pagina_atual < total_pagina - 3) {
                html += `<li class="disabled"><span>...</span></li>`;
            }
            html += `<li><a href="#" data-pagina="${total_pagina}">${total_pagina}</a></li>`;
        }
        if (pagina_atual < total_pagina) {
            html += `<li><a href="#" data-pagina="${pagina_atual + 1}" id="proximo">&raquo;</a></li>`;
        } else {
            html += `<li class="disabled"><span>&raquo;</span></li>`;
        }
        html += '</ul>';
        return html;
    } catch (e) {
        console.log(e);
    }
}
