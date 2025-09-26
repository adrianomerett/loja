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
    document.getElementById('lnk-upload').addEventListener('click', function () {
        document.getElementById('fotos').click();
    });

    // Upload de fotos
    let filesfotos = {};
    // Verifica quando o input de fotos é selecionad
    document.getElementById('fotos').addEventListener('change', async function () {
        let selectedFiles = Array.from(this.files);
        let htmlfoto = '';
        selectedFiles.forEach((file, index) => {
            let id = gerarId();
            filesfotos[`${id}`] = file;
            htmlfoto += `
                <div class="col co-sm-12 col-lg-2 col-cad-fotos" id="col-${id}">
                    <span class="lnk-remove-foto" id="span-${id}"><i class="fa-solid fa-trash-can"></i> Remover</span>
                    <div class="ct-foto-upload">
                        <img src="${URL.createObjectURL(file)}" alt="Foto" id="foto-${id}">
                    </div>
                    <div class="ct-progress"></div>
                </div>
                `;
        });
        console.log(filesfotos);

        // Adiciona o html das fotos 
        document.getElementById('rowsfotos').innerHTML = htmlfoto;

    });

    // Remove as fotos selecionadas
    document.getElementById('rowsfotos').addEventListener('click', function (e) {
        if (e.target.classList.contains('lnk-remove-foto')) {
            let id = e.target.id.replace('span-', '');
            delete filesfotos[`${id}`];
            document.getElementById(`col-${id}`).remove();
        }
    });
});

// Função para gerar id de foto
function gerarId() {
    const id = Math.random().toString(36).substring(2, 8);
    return id;
}