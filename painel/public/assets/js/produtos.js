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
        if ((Object.keys(filesfotos).length + selectedFiles.length) > 4) {
            showAlert('Serão permitidos apenas 4 fotos para cada produto!', 'error');
            return false;
        }
        let htmlfoto = '';
        let extpermitidos = ['jpg', 'jpeg', 'png', 'webp'];

        for (let i = 0; i < selectedFiles.length; i++) {
            let file = selectedFiles[i];
            let ext = file.name.split('.').pop();
            if (!extpermitidos.includes(ext)) {
                showAlert(`A extensão do arquivo .${ext} não é permitida!`, 'error');
                return false;
            }
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
        }
        // Adiciona o html das fotos 
        document.getElementById('rowsfotos').insertAdjacentHTML('afterbegin', htmlfoto);
        setTimeout(function () {
            uploadFotos(filesfotos);
        }, 200);
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

    // Salvar produto
    document.getElementById('save-product').addEventListener('click', async function () {
        await saveProduct();
    });

});

// Salvar produto
async function saveProduct() {
    try {
        if (statusupload) {
            showAlert('Você precisa esperar que as imagens sejam carregadas antes de salvar o produto!', 'error');
            return false;
        }
        let title = document.getElementById('titulo');
        let categoria = document.getElementById('categoria');
        let subcategoria = document.getElementById('subcategoria');
        let estoque = document.getElementById('estoque');
        let valorcusto = document.getElementById('valorcusto');
        let valorovenda = document.getElementById('valorvenda');
        let valoroferta = document.getElementById('valoroferta');
        let exibirpreco = document.getElementById('exibirpreco');
        let gstatus = document.getElementById('status');
        let descricao = document.getElementsByClassName('ql-editor')[0];
        let infotec = document.getElementsByClassName('ql-editor')[1];
        let vtitle = title.value;
        let vcategoria = categoria.value;
        let vsubcategoria = subcategoria.value;
        let vestoque = estoque.value;
        let vvalorcousto = valorcusto.value.replace('R$', '').replace(',', '.');
        let vvalorovenda = valorovenda.value.replace('R$', '').replace(',', '.');
        let vvaloroferta = valoroferta.value.replace('R$', '').replace(',', '.');
        let vexibirpreco = exibirpreco.value;
        let vstatus = gstatus.value;
        vvalorcousto = vvalorcousto.replace(/\.(?=.*\.)/g, "");
        vvalorovenda = vvalorovenda.replace(/\.(?=.*\.)/g, "");
        vvaloroferta = vvaloroferta.replace(/\.(?=.*\.)/g, "");
        // Validação
        if (vtitle == '') {
            setValidation('titulo', 'is-invalid');
            showAlert('Informe o título do produto!', 'error');
            return false;
        } else {
            setValidation('titulo', 'is-valid');
        }
        if (vcategoria == '0') {
            setValidation('categoria', 'is-invalid');
            showAlert('Informe a categoria!', 'error');
            return false;
        } else {
            setValidation('categoria', 'is-valid');
        }
        if (vsubcategoria == '0') {
            setValidation('subcategoria', 'is-invalid');
            showAlert('Informe a subcategoria!', 'error');
            return false;
        } else {
            setValidation('subcategoria', 'is-valid');
        }
        if (vestoque == '') {
            setValidation('estoque', 'is-invalid');
            showAlert('Informe a quantidade em estoque!', 'error');
            return false;
        } else {
            setValidation('estoque', 'is-valid');
        }
        if (vvalorcousto == '') {
            setValidation('valorcusto', 'is-invalid');
            showAlert('Informe o valor do custo do produto!', 'error');
            return false;
        } else {
            setValidation('valorcusto', 'is-valid');
        }
        if (vvalorovenda == '') {
            setValidation('valorvenda', 'is-invalid');
            showAlert('Informe o valor do venda do produto!', 'error');
            return false;
        } else {
            setValidation('valorvenda', 'is-valid');
        }
        if (vvaloroferta == '') {
            setValidation('valoroferta', 'is-invalid');
            showAlert('Informe o valor de oferta do produto!', 'error');
            return false;
        } else {
            setValidation('valoroferta', 'is-valid');
        }
        if (descricao.textContent == '') {
            setValidation('descricao', 'is-invalid');
            showAlert('Informe o descrição do produto!', 'error');
            return false;
        } else {
            setValidation('descricao', 'is-valid');
        }
        if (infotec.textContent == '') {
            setValidation('informacao', 'is-invalid');
            showAlert('Informe as informações técnicas do produto!', 'error');
            return false;
        } else {
            setValidation('informacao', 'is-valid');
        }
        if (Object.keys(filesfotos).length == 0) {
            showAlert('Informe pelo menos uma foto!', 'error');
            return false;
        }
        let dados = {
            nome: vtitle,
            descricao: descricao.getHTML(),
            informacoes: infotec.getHTML(),
            idcategoria: vcategoria,
            idsubcategoria: vsubcategoria,
            estoque: vestoque,
            valorcusto: vvalorcousto,
            valoroferta: vvaloroferta,
            valorvenda: vvalorovenda,
            exibirpreco: vexibirpreco,
            status: vstatus,
            fotos: JSON.stringify(filesfotos)
        }
        showLoader();
        let req = await api.post('produtos/save-products', { dados: dados });
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
        if (status == true) {
            showAlert(msg, 'success');
            // Limpara os campos 
            title.value = '';
            title.classList.remove('is-invalid', 'is-valid');
            categoria.value = '0';
            categoria.classList.remove('is-invalid', 'is-valid');
            subcategoria.innerHTML = '<option value="0">Selecione uma subcategoria...</option>';
            subcategoria.classList.remove('is-invalid', 'is-valid');
            estoque.value = '';
            estoque.classList.remove('is-invalid', 'is-valid');
            valorcusto.value = '';
            valorcusto.classList.remove('is-invalid', 'is-valid');
            valorovenda.value = '';
            valorovenda.classList.remove('is-invalid', 'is-valid');
            valoroferta.value = '';
            valoroferta.classList.remove('is-invalid', 'is-valid');
            exibirpreco.value = 'S';
            gstatus.value = 'A';
            descricao.innerHTML = '<p><br></p>';
            document.getElementById('descricao').classList.remove('is-valid');
            infotec.innerHTML = '<p><br></p>';
            document.getElementById('informacao').classList.remove('is-valid');
            popularHtmlFotos();
        }
    } catch (e) {
        showLoader();
        console.log(e);
    }
};

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
    statusupload = true;
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
    statusupload = false;
    document.getElementById('fotos').value = "";
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

// Permitir somente numeros 
function onlyNumbers(element) {
    let valor = element.value.replace(/\D/g, '');
    if (!valor) {
        element.value = '';
        return;
    }
    element.value = valor;
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
