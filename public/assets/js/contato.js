const sleep = (ms) => new Promise((resolve) => setTimeout(resolve, ms));
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('btn-send-msg').addEventListener('click', async function () {
        // Validar os campos obrigatórios
        let elementnome = document.getElementById('nome');
        let elementfone = document.getElementById('fone');
        let elementassunto = document.getElementById('assunto');
        let elementemail = document.getElementById('email');
        let elementmensagem = document.getElementById('mensagem');
        // Validar os campos obrigatórios
        if (elementnome.value === '') {
            elementnome.classList.remove('is-valid');
            elementnome.classList.add('is-invalid');
            showMsg('Preencha o campo nome.', 'alert-error');
            elementnome.focus();
            return false;
        } else {
            elementnome.classList.remove('is-invalid');
            elementnome.classList.add('is-valid');
        }

        if (elementemail.value == '') {
            showMsg('Preencha o campo email.', 'alert-error');
            elementemail.classList.remove('is-valid');
            elementemail.classList.add('is-invalid');
            elementemail.focus();
            return false;
        } else {
            if (!validateEmail(String(elementemail.value).trim())) {
                showMsg('informe um email válido.', 'alert-error');
                elementemail.classList.remove('is-valid');
                elementemail.classList.add('is-invalid');
                elementemail.focus();
                return false;
            } else {
                elementemail.classList.remove('is-invalid');
                elementemail.classList.add('is-valid');
            }
        }

        if (elementfone.value == '') {
            showMsg('Preencha o campo telefone.', 'alert-error');
            elementfone.classList.remove('is-valid');
            elementfone.classList.add('is-invalid');
            elementfone.focus();
            return false;
        } else {
            if (elementfone.value.length < 14) {
                showMsg('Informe um telefone válido.', 'alert-error');
                elementfone.classList.remove('is-valid');
                elementfone.classList.add('is-invalid');
                elementfone.focus();
                return false;
            } else {
                elementfone.classList.remove('is-invalid');
                elementfone.classList.add('is-valid');
            }
        }

        if (elementassunto.value == '') {
            showMsg('Preencha o campo assunto.', 'alert-error');
            elementassunto.classList.remove('is-valid');
            elementassunto.classList.add('is-invalid');
            elementassunto.focus();
            return false;
        } else {
            elementassunto.classList.remove('is-invalid');
            elementassunto.classList.add('is-valid');
        }

        if (elementmensagem.value == '') {
            showMsg('Preencha o campo mensagem.', 'alert-error');
            elementmensagem.classList.remove('is-valid');
            elementmensagem.classList.add('is-invalid');
            elementmensagem.focus();
            return false;
        } else {
            elementmensagem.classList.remove('is-invalid');
            elementmensagem.classList.add('is-valid');
        }
        // Dados
        let dados = {
            nome: elementnome.value,
            email: elementemail.value,
            fone: elementfone.value,
            assunto: elementassunto.value,
            mensagem: elementmensagem.value
        }
        showMsg('Enviando mensagem...', 'alert-send');
        await sleep(1000);
        let req = await api.post('contato/enviarmsg', { dados: dados });
        console.log(req.data);
        let { status, msg, campo } = req.data;
        if (status == false) {
            if (campo != '') {
                document.getElementById(campo).classList.remove('is-valid');
                document.getElementById(campo).classList.add('is-invalid');
                document.getElementById(campo).focus();
            }
            showMsg(msg, 'alert-error');
            return false;
        }
        let nome = elementnome.value.split(' ')[0];
        showMsg(`Olá ${nome}, recebemos a sua mensagem, retornaremos seu contato em breve!`, 'alert-success');
        // Limpar os campos
        elementnome.value = '';
        elementemail.value = '';
        elementfone.value = '';
        elementassunto.value = '';
        elementmensagem.value = '';
        // remover as classes
        document.getElementById('nome').classList.remove('is-valid', 'is-invalid');
        document.getElementById('email').classList.remove('is-valid', 'is-invalid');
        document.getElementById('fone').classList.remove('is-valid', 'is-invalid');
        document.getElementById('assunto').classList.remove('is-valid', 'is-invalid');
        document.getElementById('mensagem').classList.remove('is-valid', 'is-invalid');
    });
    // Mascara
    let campoFone = document.getElementById('fone');
    attachPhoneMask(campoFone);
});

// Validar email
function validateEmail(email) {
    try {
        let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    } catch (e) {
        console.log(e);
    }
}

function showMsg(msg, type) {
    document.getElementById('ct-retur-msg').innerHTML = `<span class="msg ${type}">${msg}</span>`;
}

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