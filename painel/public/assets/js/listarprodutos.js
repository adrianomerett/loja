// paginação
var PAGINA_ATUAL = 3;
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
        let pesquisa = document.getElementById('pesquisa').value;
        if (pesquisa == '') {
            showAlert('Informe o título do produto!', 'error');
            setValidation('pesquisa', 'is-invalid');
            return false;
        }
        document.getElementById('pesquisa').classList.remove('is-invalid', 'is-valid');
        showPesquisa();
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
        console.log(req.data);
        showLoaderList();
        let { status, msg, dados } = req.data;
        if (!status) {
            showAlert(msg, 'error');
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
        document.getElementById('tbody-list').innerHTML = htmlproducts;
    } catch (e) {
        showLoaderList();
        console.log(e);
    }
}

// Show modal de pesquisa
function showPesquisa() {
    document.getElementById(`modal-pesquisa`).classList.toggle('show-pesquisa');
}