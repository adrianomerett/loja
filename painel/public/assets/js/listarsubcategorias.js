// paginação
var PAGINA_ATUAL = 1;
var POR_PAGINA = 3;
var TOTAL_PAGINA = 0;

document.addEventListener('DOMContentLoaded', async function () {
    await listarSubCategorias();
    // Paginação
    document.getElementById('pagination').addEventListener('click', async function (e) {
        var a = e.target.closest('a[data-pagina]');
        if (!a) return;
        e.preventDefault();
        var page = parseInt(a.dataset.pagina, 10);
        if (isNaN(page)) return;
        if (page === PAGINA_ATUAL) return;
        PAGINA_ATUAL = page;
        await listarSubCategorias();
    });

    // Editar
    document.getElementById('tbody-list-subcategorias').addEventListener('click', function (e) {
        let a = e.target;
        if (!a.classList.contains('lnk-edit-cate')) return;
        e.preventDefault();
        let id = a.id.split('-').pop();
        // Seta o tipo de operação
        document.getElementById('id-operation').value = 'update';
        let namecate = document.getElementById(`name-cate-${id}`).textContent;
        let namesubcate = document.getElementById(`name-subcate-${id}`).textContent;
        let elementselect = document.getElementById('nscategoria');
        let elementsubcate = document.getElementById('ncsubcategoria');
        elementselect.innerHTML = `<option value="0">${namecate}</option>`;
        elementsubcate.value = namesubcate;
        document.getElementById('name-operation').innerHTML = `Editar Subcategoria`;
        document.getElementsByClassName('btn-save-cates')[1].innerHTML = `<i class="fa-solid fa-floppy-disk"></i> Salvar`
        showAddSubCates('modal-subcategorias');
    });

    // Update subcategoria
    document.getElementById('save-subcategoria').addEventListener('click', async function () {
        if(document.getElementById('id-operation').value == 'update') {
            
        }
    });
});

// Mostar o modal de adicionar categoria
function showAddSubCates(idmodal) {
    document.getElementById(`${idmodal}`).classList.toggle('show-cates');
}


// Listar subcategorias
async function listarSubCategorias() {
    try {
        showLoaderList();
        let req = await api.get('/subcategorias/get-list-subcategorias/', {
            params: {
                pagina_atual: PAGINA_ATUAL,
                por_pagina: POR_PAGINA
            }
        });
        showLoaderList();
        console.log(req.data);
        let { status, msg, subcategorias, paginacao } = req.data;
        if (!status) {
            showAlert(msg, 'error');
        }
        if (Object.keys(subcategorias).length === 0) {
            return false;
        }
        let htmlsbcategorias = '';
        for (let i of subcategorias) {
            htmlsbcategorias += `
                <tr class="tr-list" id="tr-${i.subcategoriaid}">
                    <td class="tdcenter tdcode">${String(i.subcategoriaid).padStart(6, '0')}</td>
                    <td class="tdleft" id="name-cate-${i.subcategoriaid}" data-cateid="${i.idcategoria}">${i.namecategoria}</td>
                    <td class="tdleft" id="name-subcate-${i.subcategoriaid}">${i.namesubcategoria}</td>
                    <td class="tdcenter"><span class="lnk-edit-cate" id="edit-subcate-${i.subcategoriaid}"><i class="fa-solid fa-pen-to-square"></i> Editar</span></td>
                    <td class="tdcenter"><span class="lnk-trash-cate" id="delete-subcate-${i.subcategoriaid}"><i class="fa-solid fa-trash-can"></i> Excluir</span></td>
                </tr>`
        }
        document.getElementById('tbody-list-subcategorias').innerHTML = htmlsbcategorias;

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