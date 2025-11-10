document.addEventListener('DOMContentLoaded', function () {

    // Salvar as configurações
    document.getElementById('save-config').addEventListener('click', async function (e) {
        // elementos do formulário
        let elnameloja = document.getElementById('nameloja');
        let elslogan = document.getElementById('slogan');
        let elversion = document.getElementById('version');
        let elemail = document.getElementById('email');
        let elfone = document.getElementById('fone');
        let elcelular = document.getElementById('celular');
        let elcidade = document.getElementById('cidade');
        let elbairro = document.getElementById('bairro');
        let elrua = document.getElementById('rua');
        let elnumero = document.getElementById('numero');
        let elinstagram = document.getElementById('instagram');
        let elfacebook = document.getElementById('facebook');
        let elx = document.getElementById('x');
        let elexibir_preco = document.getElementById('exibir_preco');
        let elexibir_estoque = document.getElementById('exibir_estoque');
        let elexibir_produto_sem_estoque = document.getElementById('exibir_produto_sem_estoque');
        let elexibir_compartilhar = document.getElementById('exibir_compartilhar');

        // FAZ A VALIDAÇÃO
        // Nome da loja
        if (elnameloja.value == '') {
            elnameloja.classList.add('is-invalid');
            elnameloja.focus();
            showAlert('O nome da loja é obrigatório', 'error');
            return false;

        } else {
            elnameloja.classList.remove('is-invalid');
        }
        // Versão
        if (elversion.value == '') {
            elversion.classList.add('is-invalid');
            elversion.focus();
            showAlert('Informe a versão do sistema da loja', 'error');
            return false;

        } else {
            elversion.classList.remove('is-invalid');
        }
        // Email da loja
        if (!validateEmail(elemail.value)) {
            elemail.classList.add('is-invalid');
            elemail.focus();
            showAlert('Informe um email válido', 'error');
            return false;
        } else {
            elemail.classList.remove('is-invalid');
        }

        // Telefone da loja
        if (elfone.value == '') {
            showAlert('Preencha o campo telefone.', 'error');
            elfone.classList.add('is-invalid');
            elfone.focus();
            return false;
        } else {
            if (elfone.value.length < 14) {
                showAlert('Informe um telefone válido.', 'error');
                elfone.classList.add('is-invalid');
                elfone.focus();
                return false;
            } else {
                elfone.classList.remove('is-invalid');
            }
        }

        // Celular da loja
        if (elcelular.value == '') {
            showAlert('Preencha o campo telefone celular.', 'error');
            elcelular.classList.add('is-invalid');
            elcelular.focus();
            return false;
        } else {
            if (elcelular.value.length < 14) {
                showAlert('Informe um telefone de celular válido.', 'error');
                elcelular.classList.add('is-invalid');
                elcelular.focus();
                return false;
            } else {
                elcelular.classList.remove('is-invalid');
            }
        }
        // Cidade da loja
        if (elcidade.value == '') {
            showAlert('Preencha o campo cidade.', 'error');
            elcidade.classList.add('is-invalid');
            elcidade.focus();
            return false;
        } else {
            elcidade.classList.remove('is-invalid');
        }

        // Bairro da loja
        if (elbairro.value == '') {
            showAlert('Preencha o campo bairro.', 'error');
            elbairro.classList.add('is-invalid');
            elbairro.focus();
            return false;
        } else {
            elbairro.classList.remove('is-invalid');
        }
        // Rua da loja
        if (elrua.value == '') {
            showAlert('Preencha o campo rua.', 'error');
            elrua.classList.add('is-invalid');
            elrua.focus();
            return false;
        } else {
            elrua.classList.remove('is-invalid');
        }
        // Número da loja
        if (elnumero.value == '') {
            showAlert('Preencha o campo número.', 'error');
            elnumero.classList.add('is-invalid');
            elnumero.focus();
            return false;
        } else {
            elnumero.classList.remove('is-invalid');
        }

        let dados = {
            nameloja: elnameloja.value,
            slogan: elslogan.value,
            version: elversion.value,
            email: elemail.value,
            fone: elfone.value,
            celular: elcelular.value,
            cidade: elcidade.value,
            bairro: elbairro.value,
            rua: elrua.value,
            numero: elnumero.value,
            instagran: elinstagram.value,
            facebook: elfacebook.value,
            x: elx.value,
            exibir_estoque: elexibir_estoque.value,
            exibir_preco: elexibir_preco.value,
            exibir_produto_sem_estoque: elexibir_produto_sem_estoque.value,
            exibir_compartilhar: elexibir_compartilhar.value
        }
        try {
            showLoader();
            let req = await api.post('configuracoes/update-config/', { dados: dados });
            showLoader();
            let { status, msg } = req.data;
            if (status == false) {
                showAlert(msg, 'error');
                return false;
            }
            if (status == true) {
                showAlert(msg, 'success');
            }
            return true;
        } catch (e) {
            console.log(e);
            showAlert(e, 'error');
        }
    });

    // Mascaras para telefones 
    let campoFone = document.getElementById('fone');
    attachPhoneMask(campoFone);
    let campoCelular = document.getElementById('celular');
    attachPhoneMask(campoCelular);
});


// Formatar telefone
function formatPhoneDigits(digits) {

    digits = digits.slice(0, 11);

    if (digits.length <= 2) {
        return digits;
    }

    const ddd = digits.slice(0, 2);
    const rest = digits.slice(2);
    if (rest.length > 8) {
        const part1 = rest.slice(0, 5);
        const part2 = rest.slice(5);
        return `(${ddd}) ${part1}${part2 ? '-' + part2 : ''}`;
    }

    if (rest.length > 4) {
        const part1 = rest.slice(0, 4);
        const part2 = rest.slice(4);
        return `(${ddd}) ${part1}${part2 ? '-' + part2 : ''}`;
    }
    return `(${ddd}) ${rest}`;
}

// Adicionar máscara ao telefone
function attachPhoneMask(input) {
    input.addEventListener('keypress', (e) => {
        const char = String.fromCharCode(e.which || e.keyCode);
        if (!/[0-9]/.test(char)) {
            e.preventDefault();
        }
    });
    input.addEventListener('input', (e) => {
        const el = e.target;
        const pos = el.selectionStart;
        const digits = el.value.replace(/\D/g, '');
        const formatted = formatPhoneDigits(digits);

        el.value = formatted;

        el.setSelectionRange(el.value.length, el.value.length);
    });
    input.addEventListener('paste', (e) => {
        e.preventDefault();
        const text = (e.clipboardData || window.clipboardData).getData('text');
        const digits = text.replace(/\D/g, '').slice(0, 11);
        input.value = formatPhoneDigits(digits);
    });
}

// Permitir somente numeros 
function onlyNumbers(element) {
    let valor = element.value.replace(/\D/g, '');
    if (!valor) {
        element.value = '';
        return;
    }
    element.value = valor;
}