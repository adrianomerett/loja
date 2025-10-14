document.addEventListener("DOMContentLoaded", async function () {
    // Chama a função de listar categorias
    await listarCategorias();
});

// listar categorias
async function listarCategorias() {
    try {
        let req = await api.get('/categorias/listar/', {
            params: { categoriaid: ITEM_ID }
        });
        console.log(req.data);
    } catch (e) {
        console.log(e);
    }
}