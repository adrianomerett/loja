// Variáveis de tamanhos
var height = null;
var heightmenu = null;
var heightcad = null;
const heighttopo = null;
const sizemobile = 992;
const titlepages = 40;
const heightbtns = 38;
const heightpagination = 38;
const heightfooter = 50;
const difcad = 78;
const diflist = 82;

document.addEventListener("DOMContentLoaded", function () {
    // Menu
    document.getElementById("ul-menu").addEventListener("click", function (e) {
        if (e.target && e.target.closest('.haschild')) {
            let idclicked = e.target.closest('.haschild').id;
            let elemetschild = document.getElementsByClassName('haschild');
            for (let i of elemetschild) {
                if (i.id == idclicked) {
                    if (i.classList.contains('active-father')) {
                        i.classList.remove('active-father');
                    } else {
                        i.classList.add('active-father');
                    }
                }
            }
        }
    });

    // Mostrar menu mobile
    document.getElementById("show-menu-mobile").addEventListener("click", function () {
        document.getElementById("container-menu").classList.toggle("show-menu");
        document.getElementById("active-close-menu").classList.toggle("active-close-menu");
    });
    document.getElementById("active-close-menu").addEventListener("click", function (e) {
        e.target.classList.toggle("active-close-menu");
        document.getElementById("container-menu").classList.toggle("show-menu");
    });
    // Chama a função de redimensionamento
    resizeLayout();
    window.addEventListener("resize", resizeLayout);

    // Função para selecionar registros
    let elementlist = document.getElementById("tbody-list");
    if (elementlist) {
        elementlist.addEventListener("click", function (e) {
            if (e.target && e.target.closest('tr')) {
                let elementclicked = e.target.closest('tr');
                // Remove class tr-selected de todos
                let elementsloop = document.getElementsByClassName('tr-list');
                let idclicked = elementclicked.id.split('-')[1];
                for (let i of elementsloop) {
                    let idloop = i.id.split('-')[1];
                    let elementcheck = document.getElementById(`code-${idloop}`);
                    if (idclicked == idloop) {
                        continue;
                    }
                    if (i.classList.contains('tr-selected')) {
                        i.classList.remove('tr-selected');
                        if (elementcheck.classList.contains('code-selected')) {
                            elementcheck.classList.remove('code-selected');
                        }
                    }
                }
                if (elementclicked.classList.contains('tr-selected')) {
                    elementclicked.classList.remove('tr-selected');
                    document.getElementById(`code-${idclicked}`).classList.remove('code-selected');
                } else {
                    elementclicked.classList.add('tr-selected');
                    document.getElementById(`code-${idclicked}`).classList.add('code-selected');
                }
            }
        });
    }

    // Fechar modal de confirmação
    let elemetcloseconfirm = document.getElementById("btn-confirm-no");
    if (elemetcloseconfirm) {
        elemetcloseconfirm.addEventListener("click", function (e) {
            e.preventDefault();
            hideConfirm();
        });
    }
});

// set config axios
const api = axios.create({
    baseURL: URL_API,
    headers: {
        "Content-Type": "multipart/form-data"
    }
});

// Caso o usuário não esteja logado redireciona
api.interceptors.response.use(function (response) {
    if (response.data.status === false && response.data.msg === 'unauthorized') {
        alert("Sua sessão expirou, por favor, faça o login novamente.");
        window.location.href = `${BASE_URL}/login/`;
    }
    return response;
})

// Resize Layout
function resizeLayout() {
    try {
        // Seta as variáveis de tamanhos
        height = window.innerHeight;
        heightmenu = (height - heighttopo);
        heightcad = (height - (heighttopo + titlepages + heightbtns + heightfooter + difcad));
        heightlist = (height - (heighttopo + titlepages + heightbtns + heightfooter + diflist + heightpagination));
        document.documentElement.style.setProperty("--heightmenu", `${heightmenu}px`);
        document.documentElement.style.setProperty("--heightcad", `${heightcad}px`);
        document.documentElement.style.setProperty("--heightlist", `${heightlist}px`);
    } catch (e) {
        console.log(e);
    }
}

// ALERT MODAL
function showAlert(msg, classalert) {
    try {
        let elemalert = document.getElementById("alert-modal");
        elemalert.classList.toggle("show-alert");
        let elementmsg = document.getElementById("msg-alert");
        elementmsg.classList.remove("alert-error");
        elementmsg.classList.add(`alert-${classalert}`);
        elementmsg.innerHTML = msg;
    } catch (e) {
        console.log(e);
    }
}

function hideAlert() {
    try {
        let elemalert = document.getElementById("alert-modal");
        elemalert.classList.toggle("show-alert");
    } catch (e) {
        console.log(e);
    }
}

// Setar validação de campos
function setValidation(elementid, classvalidation) {
    try {
        let elem = document.getElementById(`${elementid}`);
        elem.classList.remove("is-valid");
        elem.classList.remove("is-invalid");
        elem.classList.add(classvalidation);
        elem.focus();
    } catch (e) {
        console.log(e);
    }
}

// Validar email
function validateEmail(email) {
    try {
        let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    } catch (e) {
        console.log(e);
    }
}

// pega o id selecinado
function getId() {
    try {
        let code = document.getElementsByClassName('code-selected')[0];
        if (code == null) {
            return false;
        }
        return code.id.split('-')[1];
    } catch (e) {
        console.log(e);
    }
}

// Show loader list
function showLoaderList() {
    try {
        let elem = document.getElementById("loader-list");
        elem.classList.toggle("show-loader-list");
    } catch (e) {
        console.log(e);
    }
}

// html sem resultados
function htmlNotResul(msg, numcol) {
    try {
        let htmlnoteresult = `
                <tr class="tr-list">
                    <td class="tdcenter" colspan="${numcol}">
                        <i class="fa-solid fa-face-frown"></i> ${msg}
                    </td>
                </tr>
        `;
        document.getElementById("tbody-list").innerHTML = htmlnoteresult;
    } catch (e) {
        console.log(e);
    }
}


// FUNÇÕES DE CALLBACK PARA CONFIRMAÇÃO
let callbacTemporary = () => { };

function callbackExcluir() {
    callbacTemporary();
    hideConfirm();
}

// Modal de confirmação
function showConfirm(msg, callback) {
    try {
        document.getElementById('msg-confirm').innerText = msg;
        document.getElementById('modal-confirm').classList.toggle("show-confirm");
        let elementyes = document.getElementById('btn-yes-confirm');
        callbacTemporary = callback;
        elementyes.addEventListener("click", callbackExcluir);
    } catch (e) {
        console.log(e);
    }
}

// hide modal confirm
function hideConfirm() {
    try {
        document.getElementById('modal-confirm').classList.toggle("show-confirm");
    } catch (e) {
        console.log(e);
    }
}

// FULL LOADER
function showLoader() {
    try {
        let elemtnfullloader = document.getElementById("full-loader");
        elemtnfullloader.classList.toggle("show-full-loader");
    } catch (e) {
        console.log(e);
    }
}
