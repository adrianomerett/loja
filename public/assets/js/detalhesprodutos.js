document.addEventListener("DOMContentLoaded", async function () {

    // Mostra os detalhes do produto
    document.getElementById('ct-thambs').addEventListener('click', async function (e) {
        var a = e.target.closest('div[id]');
        if (!a) return;
        e.preventDefault();
        let id = a.id;
        document.getElementById('img-extra').src = URL_PAINEL + '/public/upload/produtos/extra/' + id;;
    });
});