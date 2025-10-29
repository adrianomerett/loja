// paginação
var PAGINA_ATUAL = 1;
var POR_PAGINA = 10;
var TOTAL_PAGINA = 0;

document.addEventListener('DOMContentLoaded', async function () {

    // Chama a função que lista os contatos
    await listarContatos();

    // Paginação
    document.getElementById('pagination').addEventListener('click', async function (e) {
        var a = e.target.closest('a[data-pagina]');
        if (!a) return;
        e.preventDefault();
        var page = parseInt(a.dataset.pagina, 10);
        if (isNaN(page)) return;
        if (page === PAGINA_ATUAL) return;
        PAGINA_ATUAL = page;
        await listarContatos();
    });

    // Atualizar
    document.getElementById('refresh-result').addEventListener('click', async function () {
        PAGINA_ATUAL = 1;
        await listarContatos();
    });

    // Visualizar contato
    document.getElementById('visualizar-contato').addEventListener('click', async function () {
        let id = getId();
        if (id == false || id == undefined) {
            showAlert('Selecione um contato para visualizar...', 'error');
            return false;
        }
        window.location.href = `${BASE_URL}/contatos/detalhes/id/${id}`;
    });

});

// Listar contatos
async function listarContatos() {
    try {
        showLoaderList();
        let req = await api.get('/contatos/get-contatos/', {
            params: {
                pagina_atual: PAGINA_ATUAL,
                por_pagina: POR_PAGINA
            }
        });
        showLoaderList();
        let { status, msg, dados, paginacao } = req.data;
        if (!status) {
            showAlert(msg, 'error');
        }
        if (Object.keys(dados).length === 0) {
            htmlNotResul('Poxa... você não recebeu nenhum contato.', 7);
            return false;
        }
        let situation = {
            'P': '<span class="cpending"><i class="fa-solid fa-eye-slash"></i> Pendente</span>',
            'V': '<span class="cvisualizado"><i class="fa-solid fa-eye"></i> Visualizado</span>'
        }
        let htmlcontactos = '';
        for (let i of dados) {
            let datadb = new Date(i.data);
            let data = datadb.toLocaleDateString('pt-BR', {
                day: "2-digit",
                month: "2-digit",
                year: "numeric",
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit",
                hour12: false
            }).replace(',', '');
            htmlcontactos += `
            <tr class="tr-list" id="tr-${i.contatoid}">
                <td class="tdcenter"><i class="fa-regular fa-circle-check" id="code-${i.contatoid}"></i></td>
                <td class="tdleft">${i.nome}</td>
                <td class="tdleft">${i.assunto}</td>
                <td class="tdcenter">${i.email}</td>
                <td class="tdcenter">${i.telefone}</td>
                <td class="tdcenter tdmoney">${situation[i.status]}</td>
                <td class="tdcenter">${data}</td>
            </tr>
            `;
        }
        // HTML DOS CONTATOS
        document.getElementById('tbody-list').innerHTML = htmlcontactos;
        // HTML DA PAGINAÇÃO
        PAGINA_ATUAL = paginacao.pagina_atual;
        TOTAL_PAGINA = paginacao.total_paginas;
        let htmlpagination = createPagination(PAGINA_ATUAL, TOTAL_PAGINA);
        document.getElementById('pagination').innerHTML = htmlpagination;
    } catch (e) {
        showLoaderList();
        console.log(e);
    }
}

// Delete product

const deleteContact = function () {
    try {
        let contactid = getId();
        if (contactid == false) {
            showAlert("Selecione um contato para excluir.", "error");
            return false;
        }
        let deletarContato = async () => {
            try {
                showLoader();
                let req = await api.post('/contatos/delete-contact', { id: contactid });
                showLoader();
                let { status, msg } = req.data;
                if (status === false) {
                    showAlert(msg, "error");
                    return false;
                }
                if (status === true) {
                    showAlert("Contato excluído com sucesso.", "success");
                    document.getElementById(`tr-${contactid}`).remove();
                }
            } catch (e) {
                showLoader();
                console.log(e);
            }
        }
        showConfirm("Deseja realmente excluir o contato selecionado?", deletarContato);
    } catch (e) {
        console.log(e);
    }
}