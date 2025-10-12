var heigh = null;
const heighttopo = 68;
const heightmenuh = 40;
const heightfooter = 40;
const sizemobile = 992;

document.addEventListener("DOMContentLoaded", function () {
    resizeLayout();

    // Evento de resize
    window.addEventListener("resize", resizeLayout);

    // Mostrar menu mobile
    document.getElementById('buttom-mobile').addEventListener("click", function () {
        document.getElementById("menuv").classList.toggle("show-menu");
        document.getElementById("close-menuv").classList.toggle("show-close-menuv");
    });

    // Fechar menu mobile
    document.getElementById("close-menuv").addEventListener("click", function () {
        document.getElementById("menuv").classList.toggle("show-menu");
        document.getElementById("close-menuv").classList.toggle("show-close-menuv");
    });
});

// Resize Layout
function resizeLayout() {
    try {
        // Seta as variáveis de tamanhos
        heigh = window.innerHeight;
        let heigthcontainer = (heigh - (heightfooter + heighttopo + heightmenuh));
        console.log(heigthcontainer);
        document.documentElement.style.setProperty("--heightcontainer", `${heigthcontainer}px`);
    } catch (e) {
        console.log(e);
    }
}