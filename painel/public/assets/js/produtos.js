// Upload de fotos
var filesfotos = {};
var statusupload = false;

document.addEventListener('DOMContentLoaded', function () {

    // Descrição
    const quill = new Quill('#descricao', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'script': 'sub' }],
                [{ 'size': ['small', false, 'large', 'huge'] }],
                [{ 'color': [] }, { 'background': [] }],
                ['clean'],
            ],
        },
    });

    // Informações técnicas
    const informacoes = new Quill('#informacao', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'script': 'sub' }],
                [{ 'size': ['small', false, 'large', 'huge'] }],
                [{ 'color': [] }, { 'background': [] }],
                ['clean'],
            ],
        },
    });

    // Abre o input de fotos
    document.getElementById('lnk-select-fotos').addEventListener('click', function () {
        document.getElementById('fotos').click();
    });
    // Verifica quando o input de fotos é selecionad
    document.getElementById('fotos').addEventListener('change', async function () {
        if (Object.keys(filesfotos).length == 0) {
            document.getElementById('rowsfotos').innerHTML = '';
        }
        let selectedFiles = Array.from(this.files);
        let htmlfoto = '';
        selectedFiles.forEach((file, index) => {
            let ext = file.name.split('.').pop();
            let id = gerarId();
            filesfotos[`${id}`] = { 'file': file, 'id': id, 'ext': ext, 'status': false };
            htmlfoto += `
                <div class="col co-sm-12 col-md-2 col-lg-2 col-cad-fotos" id="col-${id}">
                    <span class="lnk-remove-foto" id="span-${id}"><i class="fa-solid fa-trash-can"></i> Remover</span>
                    <div class="ct-foto-upload">
                        <img src="${URL.createObjectURL(file)}" class="pre-upload" alt="Foto" id="foto-${id}">
                    </div>
                    <div class="ct-progress">
                        <div class="progress-img" id="progress-${id}"></div>
                    </div>
                </div>
                `;
        });
        // Adiciona o html das fotos 
        document.getElementById('rowsfotos').insertAdjacentHTML('afterbegin', htmlfoto);
    });

    // Remove as fotos selecionadas
    document.getElementById('rowsfotos').addEventListener('click', async function (e) {
        if (e.target.classList.contains('lnk-remove-foto')) {
            let id = e.target.id.replace('span-', '');
            if (filesfotos.hasOwnProperty(`${id}`)) {
                if (filesfotos[`${id}`].status == true) {
                    try {
                        showLoader();
                        let req = await api.post('produtos/delete-tmp-foto', { id: id, ext: filesfotos[`${id}`].ext });
                        showLoader();
                    } catch (e) {
                        console.log(e);
                    }
                }
            }
            delete filesfotos[`${id}`];
            document.getElementById(`col-${id}`).remove();
        }
    });

    // Chama a função de upload de fotos
    document.getElementById('lnk-upload-fotos').addEventListener('click', async function () {
        await uploadFotos(filesfotos);
    });

    // Mostra o modal de adicionar categoria
    document.getElementById('lnk-add-cate').addEventListener('click', function () {
        showAddCates('modal-cates');
    });

    // Mostra o modal de adicionar subcategoria
    document.getElementById('lnk-add-subcate').addEventListener('click', function () {
        showAddCates('modal-subcategorias');
    });

    // Salva uma nova categoria 
    document.getElementById('save-cates').addEventListener('click', async function () {
        await saveCategoria();
    });

    // Buscar sub categorias pela categoria pai
    document.getElementById('categoria').addEventListener('change', async function () {
        await pupulateSubcategorias('categoria', 'subcategoria');
    });

    // Salvar sub categria 
    document.getElementById('save-subcategoria').addEventListener('click', async function () {
        await saveSubcategoria();
    });

});

// Salva uma nova subcategoria
async function saveCategoria() {
    try {
        let elemntncategoria = document.getElementById('ncategoria');
        let ncategoria = elemntncategoria.value;
        if (ncategoria == 0) {
            setValidation('ncategoria', 'is-invalid');
            showAlert('Informe o nome da categoria!', 'error');
            return false;
        } else {
            setValidation('ncategoria', 'is-valid');
        }
        showLoader();
        let req = await api.post('categorias/save-categoria', { namecategoria: ncategoria });
        showLoader();
        let { status, msg, categorias } = req.data;
        if (status == false) {
            showAlert(msg, 'error');
            return false;
        }
        if (status == true) {
            elemntncategoria.classList.remove('is-invalid', 'is-valid');
            showAddCates('modal-cates');
            document.getElementById('categoria').innerHTML = `
            <option value="0">Selecione uma categoria...</option>
            ${categorias}
            `;
            document.getElementById(`nscategoria`).innerHTML = `
                <option value="0">Selecione uma categoria...</option>
            ${categorias}
            `;
            setTimeout(function () {
                showAlert(msg, 'success');
            }, 100);
        }
        elemntncategoria.value = '';


    } catch (e) {
        showLoader();
        console.log(e);
    }
}

// Salva uma nova subcategoria
async function saveSubcategoria() {
    try {
        // Validação
        let elementcate = document.getElementById('nscategoria');
        let elementsbcate = document.getElementById('ncsubcategoria');
        let categoria = elementcate.value;
        let subcategoria = elementsbcate.value;
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
        let { status, msg, campo, subactegorias } = req.data;
        if (status == false) {
            showAlert(msg, 'error');
            setValidation(campo, 'is-invalid');
        }
        if (status == true) {
            showAlert(msg, 'success');
            document.getElementById('subcategoria').innerHTML = `
                <option value="0">Selecione uma subcategoria...</option>
            ${subactegorias}
            `;
            elementcate.value = '';
            elementsbcate.value = '';
            elementcate.classList.remove('is-invalid', 'is-valid');
            elementsbcate.classList.remove('is-invalid', 'is-valid');
            showAddCates('modal-subcategorias');

        }
    } catch (e) {
        showLoader();
        console.log(e);
    }
}

// Função para gerar id de foto
function gerarId() {
    const id = Math.random().toString(36).substring(2, 8);
    return id;
}

// Função de upload de fotos
async function uploadFotos(filesfotos) {
    if (Object.keys(filesfotos).length <= 0) {
        showAlert('Você precisa selecionar pelo menos uma foto para enviar!');
        return false;
    }
    for (let i of Object.keys(filesfotos)) {
        let file = filesfotos[i];
        var formData = new FormData();
        if (file.status === true) {
            continue;
        }
        formData.append('id', i);
        formData.append('ext', file.ext);
        formData.append('file', file.file);
        let elementProgress = document.getElementById(`progress-${i}`);
        try {
            const req = await api.post('produtos/uploadfotos', formData, {
                onUploadProgress: function (progressEvent) {
                    let percent = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    elementProgress.style.width = `${percent}%`;
                }
            });
            if (req.data.status == true) {
                filesfotos[`${i}`].status = true;
                document.getElementById(`foto-${i}`).classList.remove('pre-upload');
            }
            if (req.data.status == false) {
                showAlert(req.data.msg);
            }
        } catch (e) {
            console.log(e);
        }
    }
}

// Popular html default das imagens 
function popularHtmlFotos() {
    let htmlfoto = ``;
    for (let i = 0; i <= 3; i++) {
        htmlfoto += `
        <div class="col co-sm-12 col-md-2 col-lg-2 col-cad-fotos">
            <div class="ct-foto-upload">
                <img src="${BASE_URL}/public/imagens/default.png" class="pre-upload" alt="Foto">
            </div>
        </div>`
    }
    document.getElementById('rowsfotos').innerHTML = htmlfoto
}

// Mascara de moeda 
function mascaraMoeda(elemento) {
    let valor = elemento.value.replace(/\D/g, '');
    if (!valor) {
        elemento.value = '';
        return;
    }
    valor = (parseInt(valor, 10) / 100).toFixed(2);
    let [inteiro, decimal] = valor.split('.');
    inteiro = inteiro.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    elemento.value = `R$ ${inteiro},${decimal}`;
}

// Buscar Subcategorias
async function pupulateSubcategorias(idfather, idchild) {
    try {
        let pai = document.getElementById(idfather);
        let filho = document.getElementById(idchild);
        let valorpai = pai.value;
        if (valorpai == 0) {
            return false;
        }
        filho.innerHTML = '<option value="0">Buscando subcategorias...</option>';
        let req = await api.post('subcategorias/get-subcategorias', { idcategoria: valorpai });
        let { status, msg, subcategorias } = req.data;
        if (status == false) {
            showAlert(msg, 'error');
            return false;
        }
        if (status == true) {
            filho.innerHTML = `
            <option value="0">Selecione uma subcategoria...</option>
            ${subcategorias}
            `;
        }
    } catch (e) {
        console.log(e);
    }
}

// Mostar o modal de adicionar categoria
function showAddCates(idmodal) {
    document.getElementById(`${idmodal}`).classList.toggle('show-cates');
}