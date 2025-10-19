// paginação
var PAGINA_ATUAL = 1;
var POR_PAGINA = 12;
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
        document.getElementById('id-cate-editar').value = id;
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
        if (document.getElementById('id-operation').value == 'update') {
            let idsubcate = document.getElementById('id-cate-editar').value;
            let elementsubcate = document.getElementById('ncsubcategoria');
            let namesubcate = elementsubcate.value;
            // Validar
            showLoader();
            let req = await api.post('/subcategorias/update-subcategoria', { id: idsubcate, name: namesubcate });
            showLoader();
            let { status, msg, campo } = req.data;
            if (!status) {
                showAlert(msg, 'error');
                if (campo != '') {
                    setValidation(campo, 'is-invalid');
                }
                return false;
            }
            if (status) {
                showAddSubCates('modal-subcategorias');
                showAlert(msg, 'success');
                document.getElementById(`name-subcate-${idsubcate}`).innerText = namesubcate;
                document.getElementById(`ncsubcategoria`).classList.remove('is-invalid', 'is-valid');
            }
            return true;
        }
    });

    // Mostrar modal de adicionar subcategoria
    document.getElementById('lnk-add-cate').addEventListener('click', function () {
        document.getElementById('id-operation').value = 'cadastrar';
        let elementname = document.getElementById('ncsubcategoria');
        let elementselect = document.getElementById('nscategoria');
        elementselect.innerHTML = `
        <option value="0" selected="selected">Selecione uma categoria...</option>
        ${CATEGORIAS_EXISTENTES}
        `;
        elementname.value = '';
        document.getElementById('name-operation').innerHTML = `Cadastrar Subcategoria`;
        showAddSubCates('modal-subcategorias');
    });

    // Salvar subcategoria
    document.getElementById('save-subcategoria').addEventListener('click', async function () {
        try {
            if (document.getElementById('id-operation').value == 'cadastrar') {
                let elementcate = document.getElementById('nscategoria');
                let elementsubcate = document.getElementById('ncsubcategoria');
                // Validar
                let categoria = elementcate.value;
                let subcategoria = elementsubcate.value;
                if (categoria == 0) {
                    setValidation('nscategoria', 'is-invalid');
                    showAlert('Informe a categoria!', 'error');
                    return false;
                } else {
                    setValidation('nscategoria', 'is-valid');
                }
                if (subcategoria == '') {
                    setValidation('ncsubcategoria', 'is-invalid');
                    showAlert('Informe o nomde da subcategoria!', 'error');
                    return false;
                } else {
                    setValidation('ncsubcategoria', 'is-valid');
                }
                // Salvar
                showLoader();
                let req = await api.post('subcategorias/save-subcategoria', { idcategoria: categoria, ncsubcategoria: subcategoria });
                showLoader();
                let { status, msg, campo } = req.data;
                if (status == false) {
                    showAlert(msg, 'error');
                    setValidation(campo, 'is-invalid');
                }
                if (status == true) {
                    showAddSubCates('modal-subcategorias');
                    showAlert(msg, 'success');
                    elementcate.value = '0';
                    elementsubcate.value = '';
                    elementcate.classList.remove('is-invalid', 'is-valid');
                    elementsubcate.classList.remove('is-invalid', 'is-valid');
                    PAGINA_ATUAL = 1;
                    listarSubCategorias();
                }
                return true;
            }
        } catch (e) {
            showLoader();
            console.log(e);
        }
    });

    // Excluir subcategoria
    document.getElementById('tbody-list-subcategorias').addEventListener('click', function (e) {
        let a = e.target;
        if (!a.classList.contains('lnk-trash-cate')) return;
        let id = a.id.split('-').pop();
        deleteSubCategorias(id);
    });

    // Atualiza os resultados da página
    document.getElementById('refresh-result').addEventListener('click', async function () {
        PAGINA_ATUAL = 1;
        await listarSubCategorias();
    });
});

// Mostar o modal de adicionar subcategoria
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

// Delete Categorias
const deleteSubCategorias = function (id) {
    try {
        let deleteSubCate = async () => {
            try {
                showLoader();
                let req = await api.post('/subcategorias/delete-subcategorias/', { id: id });
                showLoader();
                let { status, msg } = req.data;
                if (status === false) {
                    showAlert(msg, "error");
                    return false;
                }
                if (status === true) {
                    showAlert("Subcategoria excluída com sucesso.", "success");
                    PAGINA_ATUAL = 1;
                    listarSubCategorias();
                }
            } catch (e) {
                showLoader();
                console.log(e);
            }
        }
        showConfirm("Deseja realmente excluir esta subcategoria?", deleteSubCate);
    } catch (e) {
        console.log(e);
    }
}