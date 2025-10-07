const sleep = (ms) => new Promise((resolve) => setTimeout(resolve, ms));

document.addEventListener('DOMContentLoaded', async function () {
    //contarAteValorFinal(150);

    animateReal("12456.65", 50, true);
});

// function contarAteValorFinal(valorFinal, tempo = 50) {
//     // Calcula 5% abaixo do valor final
//     const inicio = valorFinal * 0.95;
//     let atual = Math.floor(inicio);

//     const intervalo = setInterval(() => {
//         console.log(atual); // Aqui você pode trocar por ex: elemento.innerText = atual;
//         atual++;

//         if (atual > valorFinal) {
//             clearInterval(intervalo);
//         }
//     }, tempo);
// }

async function animateReal(valorFinal, tempo = 30, mostrarSimbolo = false) {
    if (isNaN(valorFinal)) {
        console.error("Valor inválido:", valorFinal);
        return;
    }

    const inicio = valorFinal * 0.95;
    const passos = 50; // número de atualizações até o valor final
    const incremento = (valorFinal - inicio) / passos;
    const elemento = document.getElementById("vcusto");

    let atual = inicio;

    for (let i = 0; i <= passos; i++) {
        // Garante que o valor nunca passe do final
        if (atual > valorFinal) {
            let nome = valorFinal;
            const teste = nome.toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            console.log("Valor final atingido:", teste);
            elemento.innerText = mostrarSimbolo ? `R$ ${teste}` : teste;
            return false;
        }
        console.log("Atualizando valor:", atual);

        // Formata o número no padrão brasileiro
        const valorFormatado = atual.toLocaleString('pt-BR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

        elemento.innerText = mostrarSimbolo ? `R$ ${valorFormatado}` : valorFormatado;

        // Aguarda o tempo definido antes de continuar
        await sleep(tempo);

        atual += incremento;
    }
}