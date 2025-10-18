var heigh = null;
const heighttopo = 68;
const heightmenuh = 40;
const heightfooter = 164;
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
        let heighcontainerlistproducts = (heigh - (heightfooter + heighttopo + heightmenuh + 70));
        document.documentElement.style.setProperty("--heightcontainer", `${heigthcontainer}px`);
        document.documentElement.style.setProperty("--heighcontainerlistproducts", `${heighcontainerlistproducts}px`);
    } catch (e) {
        console.log(e);
    }
}

// set config axios
const api = axios.create({
    baseURL: URL_API,
    headers: {
        "Content-Type": "multipart/form-data"
    }
});

// Gerar html para produtos em listagem
function generateHtmlListProducts(i) {
    try {
        let vdiff = i.valorvenda - i.valoroferta;
        let percent = vdiff / i.valoroferta * 100;
        let valorpercent = percent.toFixed(2)
        let valoroferta = Number(i.valoroferta).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        let valorvenda = Number(i.valorvenda).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        let classesgotado = '';
        let txtestoque = `<div class="ct-estoque disponivel">Estoque disponível ${i.estoque} unidades.</div>`;
        if (i.estoque <= 0) {
            classesgotado = ' esgotado';
            txtestoque = `<div class="ct-estoque txt-esgotado">Produto sem estoque.</div>`;
        }
        let html = `
                    <div class="col col-sm-6 col-md-4 col-lg-3 ct-box-product box-product-home">
                        <a href="${BASE_URL}/produtos/detalhes/${i.produtoid}/${i.idcategoria}/${i.idsubcategoria}/${slug(i.nome)}" class="link-product ${classesgotado}">
                            <div class="img-produto">
                                <img src="${URL_PAINEL}/public/upload/produtos/thamb/${i.img}" alt="${i.nome}" />
                            </div>
                            <div class="name-product">${i.nome}</div>
                            <div class="ct-price">
                                <div class="valor-venda">
                                    <span class="valor-on">De: ${valorvenda}</span>
                                </div>
                                <div class="valor-oferta">
                                    <span class="valor-off">Por:</span>
                                    <span class="price-off">${valoroferta}</span>
                                </div>
                            </div>
                            <div class="ct-off">
                                -${valorpercent}%
                            </div>
                            ${txtestoque}
                        </a>
                    </div>`;
        return html;
    } catch (e) {
        console.log(e);
    }
}

// cria o html da paginação
function createPagination(pagina_atual, total_pagina) {
    try {
        if (total_pagina <= 1) {
            return '';
        }
        let html = '<ul class="paginacao">';
        if (pagina_atual > 1) {
            html += `<li><a href="#" data-pagina="${pagina_atual - 1}">&laquo;</a></li>`;
        } else {
            html += `<li class="disabled" id="before"><span>&laquo;</span></li>`;
        }
        if (pagina_atual > 3) {
            html += `<li><a href="#" data-pagina="1">1</a></li>`;
            if (pagina_atual > 2) {
                html += `<li class="disabled"><span>...</span></li>`;
            }
        }
        let inicio = Math.max(1, pagina_atual - 2);
        let fim = Math.min(total_pagina, pagina_atual + 2);

        for (let i = inicio; i <= fim; i++) {
            if (i === pagina_atual) {
                html += `<li class="ativo"><span>${i}</span></li>`;
            } else {
                html += `<li><a href="#" data-pagina="${i}">${i}</a></li>`;
            }
        }
        if (pagina_atual < total_pagina - 2) {
            if (pagina_atual < total_pagina - 3) {
                html += `<li class="disabled"><span>...</span></li>`;
            }
            html += `<li><a href="#" data-pagina="${total_pagina}">${total_pagina}</a></li>`;
        }
        if (pagina_atual < total_pagina) {
            html += `<li><a href="#" data-pagina="${pagina_atual + 1}" id="proximo">&raquo;</a></li>`;
        } else {
            html += `<li class="disabled"><span>&raquo;</span></li>`;
        }
        html += '</ul>';
        return html;
    } catch (e) {
        console.log(e);
    }
}

// Loader
function showLoader() {
    try {
        document.getElementById("show-loader").classList.toggle("showloader");
    } catch (e) {
        console.log(e);
    }
}

// html not results
function htmlNotResults(msg) {
    return `
        <div class="col col-sm-12 col-md-12 col-lg-12 not-products">
            <i class="fa-regular fa-face-sad-tear"></i> ${msg}
        </div>
    `;
}


function slug(texto) {
    if (!texto) {
        return '';
    }
    let slug = texto.toLowerCase().trim();
    slug = slug.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
    slug = slug.replace(/[^a-z0-9\s-]/g, ' ');
    slug = slug.replace(/[\s-]+/g, '-');
    slug = slug.replace(/^-+|-+$/g, '');
    return slug;
}