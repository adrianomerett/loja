document.addEventListener('DOMContentLoaded', function () {

    // Upload de fotos
    var filesfotos = {};
    var statusupload = false;
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
        document.getElementById('rowsfotos').insertAdjacentHTML('beforeend', htmlfoto);

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

});

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