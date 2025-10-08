const sleep = (ms) => new Promise((resolve) => setTimeout(resolve, ms));

document.addEventListener('DOMContentLoaded', async function () {
    //contarAteValorFinal(150);

    // Valores
    animateReal(V_CUSTO, 15, true, 'vcusto');
    animateReal(V_VENDA, 15, true, 'vvenda');
    // Totais de cadastros
    animateTotal(V_TOTAL_PRODUCTS, 50, 'tpcadastrados');
    animateTotal(V_TOTAL_SEM_ESTOQUE, 200, 'tpsemestoque');
    animateTotal(V_TOTAL_INATIVOS, 200, 'tpinativos');
    animateTotal(V_EXIBIR_PRECO, 200, 'tpsemexibirpreco');
    animateTotal(V_TOTAL_CATEGORIAS, 200, 'tcategorias');
    animateTotal(V_TOTAL_SUBCATEGORIAS, 200, 'tsubcategorias');
    animateTotal(V_TOTAL_USERS, 200, 'tusuarios');
    animateTotal(V_TOTAL_INACTIVE_USERS, 200, 'tusersinactives');
    animateTotal(V_TOTAL_CONTACTS, 200, 'tcontatos');
    animateTotal(V_TOTAL_PENDING_CONTACTS, 200, 'tcontatospending');
});

function animateTotal(valorFinal, tempo, elementid) {
    const inicio = valorFinal * 0.95;
    let atual = Math.floor(inicio);
    const intervalo = setInterval(() => {
        document.getElementById(`${elementid}`).innerText = `Total: ${atual}`;
        atual++;
        if (atual > valorFinal) {
            clearInterval(intervalo);
        }
    }, tempo);
}

async function animateReal(valorFinal, tempo = 30, mostrarSimbolo = false, elementid) {
    if (isNaN(valorFinal)) {
        console.error("Valor inválido:", valorFinal);
        return;
    }

    const inicio = valorFinal * 0.95;
    const passos = 50; // número de atualizações até o valor final
    const incremento = (valorFinal - inicio) / passos;
    const elemento = document.getElementById(`${elementid}`);
    let atual = inicio;
    // Loop para atualizar o valor
    for (let i = 0; i <= passos; i++) {
        if (atual > valorFinal) break;
        var valorFormatado = atual.toLocaleString('pt-BR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
        elemento.innerText = mostrarSimbolo ? `R$ ${valorFormatado}` : valorFormatado;

        await sleep(tempo);
        atual += incremento;
    }
    let vf = Number(valorFinal).toLocaleString('pt-BR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
    elemento.innerText = mostrarSimbolo ? `R$ ${vf}` : vf;
}