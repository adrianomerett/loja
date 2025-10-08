// paginação
var PAGINA_ATUAL = 1;
var POR_PAGINA = 8;
var TOTAL_PAGINA = 0;

document.addEventListener('DOMContentLoaded', async function () {
    await listarCategorias();

    // Paginação
    document.getElementById('pagination').addEventListener('click', async function (e) {
        var a = e.target.closest('a[data-pagina]');
        if (!a) return;
        e.preventDefault();
        var page = parseInt(a.dataset.pagina, 10);
        if (isNaN(page)) return;
        if (page === PAGINA_ATUAL) return;
        PAGINA_ATUAL = page;
        await listarCategorias();
    });

    // Editar
    document.getElementById('tbody-list-categorias').addEventListener('click', function (e) {
        let a = e.target;
        if (!a.classList.contains('lnk-edit-cate')) return;
        e.preventDefault();
        let id = a.id.split('-').pop();
        document.getElementById('id-cate-editar').value = id;
        let name = document.getElementById(`name-cate-${id}`).innerHTML;
        document.getElementById('ncategoria').value = name;
        document.getElementById('name-operation').innerHTML = `Editar Categoria`;
        document.getElementsByClassName('btn-save-cates')[1].innerHTML = `<i class="fa-solid fa-floppy-disk"></i> Salvar`
        showAddCates('modal-cates');
    });

    // Excluir categoria
    document.getElementById('tbody-list-categorias').addEventListener('click', function (e) {
        let a = e.target;
        if (!a.classList.contains('lnk-trash-cate')) return;
        let id = a.id.split('-').pop();
        deleteCategorias(id);
    });

    // Editar a categoria
    document.getElementById('save-cates').addEventListener('click', async function () {
        let id = document.getElementById('id-cate-editar').value;
        if (id != 'cadastrar') {
            let elementname = document.getElementById('ncategoria');
            let name = elementname.value;
            if (name == '') {
                showAlert('Informe o nome da categoria!', 'error');
                setValidation('ncategoria', 'is-invalid');
                return false;
            }
            try {
                // Atualizar
                showLoader();
                let req = await api.post('/categorias/update-categoria', { idcategoria: id, namecategoria: name });
                showLoader();
                let { status, msg, campo } = req.data;
                console.log(req.data);
                if (status == false) {
                    showAlert(msg, 'error');
                    if (campo != '') {
                        setValidation(campo, 'is-invalid');
                    }
                    return false;
                }
                if (status) {
                    showAddCates('modal-cates');
                    showAlert(msg, 'success');
                    elementname.value = '';
                    elementname.classList.remove('is-invalid', 'is-valid');
                    document.getElementById(`name-cate-${id}`).innerText = name;
                }
            } catch (e) {
                console.log(e);
            }
        }
    });

    // Show Adicionar categoria
    document.getElementById('lnk-add-cate').addEventListener('click', function () {
        document.getElementById('id-cate-editar').value = 'cadastrar';
        let elementname = document.getElementById('ncategoria');
        elementname.value = '';
        document.getElementById('name-operation').innerHTML = `Cadastrar Categoria`;
        showAddCates('modal-cates');
    });

    // Cadastrar categoria
    document.getElementById('save-cates').addEventListener('click', async function () {
        try {
            let operacaco = document.getElementById('id-cate-editar').value = 'cadastrar';
            let elementname = document.getElementById('ncategoria');
            let namecategoria = elementname.value;
            if (operacaco == 'cadastrar') {
                if (namecategoria == '') {
                    showAlert('Informe o nome da categoria!', 'error');
                    setValidation('ncategoria', 'is-invalid');
                    return false;
                }
                showLoader();
                let req = await api.post('/categorias/save-categoria', { namecategoria: namecategoria });
                showLoader();
                let { status, msg, campo } = req.data;
                if (status == false) {
                    showAlert(msg, 'error');
                    if (campo != '') {
                        setValidation(campo, 'is-invalid');
                    }
                    return false;
                }
                if (status) {
                    PAGINA_ATUAL = 1;
                    showAddCates('modal-cates');
                    showAlert(msg, 'success');
                    elementname.value = '';
                    elementname.classList.remove('is-invalid', 'is-valid');
                    listarCategorias();
                }
            }
        } catch (e) {
            console.log(e);
        }
    });

    // Atualiza os resultados da página
    document.getElementById('refresh-result').addEventListener('click', async function () {
        PAGINA_ATUAL = 1;
        await listarCategorias();
    });
});

// Listar categorias
async function listarCategorias() {
    try {
        showLoaderList();
        let req = await api.get('/categorias/get-categorias/', {
            params: {
                pagina_atual: PAGINA_ATUAL,
                por_pagina: POR_PAGINA
            }
        });
        showLoaderList();
        let { status, msg, categorias, paginacao } = req.data;
        if (!status) {
            showAlert(msg, 'error');
        }
        if (Object.keys(req.data).length === 0) {
            return false;
        }
        let htmlcategorias = '';
        for (let i of categorias) {
            htmlcategorias += `
                <tr class="tr-list" id="tr-${i.categoriaid}">
                    <td class="tdcenter tdcode">${String(i.categoriaid).padStart(6, '0')}</td>
                    <td class="tdleft" id="name-cate-${i.categoriaid}">${i.namecategoria}</td>
                    <td class="tdcenter"><span class="lnk-edit-cate" id="edit-cate-${i.categoriaid}"><i class="fa-solid fa-pen-to-square"></i> Editar</span></td>
                    <td class="tdcenter"><span class="lnk-trash-cate" id="delete-cate-${i.categoriaid}"><i class="fa-solid fa-trash-can"></i> Excluir</span></td>
                </tr>`
        }
        document.getElementById('tbody-list-categorias').innerHTML = htmlcategorias;
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

// Mostar o modal de adicionar categoria
function showAddCates(idmodal) {
    document.getElementById(`${idmodal}`).classList.toggle('show-cates');
}

// Delete Categorias
const deleteCategorias = function (id) {
    try {
        let deleteCate = async () => {
            try {
                showLoader();
                let req = await api.post('/categorias/delete-categorias', { id: id });
                showLoader();
                let { status, msg } = req.data;
                if (status === false) {
                    showAlert(msg, "error");
                    return false;
                }
                if (status === true) {
                    showAlert("Categoria excluída com sucesso.", "success");
                    PAGINA_ATUAL = 1;
                    listarCategorias();
                }
            } catch (e) {
                showLoader();
                console.log(e);
            }
        }
        showConfirm("Deseja realmente excluir esta categoria?", deleteCate);
    } catch (e) {
        console.log(e);
    }
}