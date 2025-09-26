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
});