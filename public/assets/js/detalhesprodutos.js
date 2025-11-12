document.addEventListener("DOMContentLoaded", async function () {

    // Mostra os detalhes do produto
    document.getElementById('ct-thambs').addEventListener('click', async function (e) {
        var a = e.target.closest('div[id]');
        if (!a) return;
        e.preventDefault();
        let id = a.id;
        document.getElementById('img-extra').src = URL_PAINEL + '/public/upload/produtos/extra/' + id;;
    });

    // Mostrar modal de compra
    let elementbuttoaddcart = document.getElementById('btn-add-to-cart');
    if (elementbuttoaddcart) {
        document.getElementById('btn-add-to-cart').addEventListener('click', async function (e) {
            e.preventDefault();
            showModalInfoCompra();
        });
    }
});

// Show Modal Info Compra
function showModalInfoCompra() {
    document.getElementById('modal-compra').classList.toggle('show-modal-compra');
}