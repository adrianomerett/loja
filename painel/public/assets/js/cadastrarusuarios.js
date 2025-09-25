document.addEventListener("DOMContentLoaded", function () {
    let elementsaveuser = document.getElementById("save-user");


    // Cadastrar usuário
    elementsaveuser.addEventListener("click", async function () {
        await saveUser();
    });
});

// Salvar usuário
async function saveUser() {
    try {
        // ELEMENTOS DO FORMULARIO
        let nome = document.getElementById("nome").value;
        let sobrenome = document.getElementById("sobrenome").value;
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        let cpassword = document.getElementById("cpassword").value;
        let cstatus = document.getElementById("status").value;
        let level = document.getElementById("level").value;
        let elemetform = document.getElementById('form-save-user');
        // Nome
        if (nome == "") {
            setValidation("nome", "is-invalid");
            showAlert("Preencha o campo de nome.", "error");
            return;
        } else {
            setValidation("nome", "is-valid");
        }
        // Sobrenome
        if (sobrenome == "") {
            setValidation("sobrenome", "is-invalid");
            showAlert("Preencha o campo de sobrenome.", "error");
            return;
        } else {
            setValidation("sobrenome", "is-valid");
        }
        // Email
        if (email == "") {
            setValidation("email", "is-invalid");
            showAlert("Informe o email do usuário.", "error");
            return;
        }
        if (!validateEmail(email)) {
            setValidation("email", "is-invalid");
            showAlert("O email informado não é inválido.", "error");
            return;
        } else {
            setValidation("email", "is-valid");
        }
        // Senha
        if (password == "") {
            setValidation("password", "is-invalid");
            showAlert("Informe a senha do usuário.", "error");
            return;
        } else {
            if (password.length < 8) {
                setValidation("password", "is-invalid");
                showAlert("A senha deve ter no mínimo 8 caracteres.", "error");
                return;
            } else {
                setValidation("password", "is-valid");
            }
        }
        // Confirmar senha
        if (cpassword == "") {
            setValidation("cpassword", "is-invalid");
            showAlert("Preencha a confirmação da senha.", "error");
            return;
        } else {
            if (cpassword != password) {
                setValidation("cpassword", "is-invalid");
                showAlert("As senhas informadas não são iguais.", "error");
                return;
            } else {
                setValidation("cpassword", "is-valid");
            }
        }
        // Status
        if (cstatus == "0") {
            setValidation("status", "is-invalid");
            showAlert("Selecione o status do usuário.", "error");
            return;
        } else {
            setValidation("status", "is-valid");
        }
        // Level
        if (level == "0") {
            setValidation("level", "is-invalid");
            showAlert("Selecione o nível do usuário.", "error");
            return;
        } else {
            setValidation("level", "is-valid");
        }

        // Realiza o cadastro
        let dados = {
            name: nome,
            sobrenome: sobrenome,
            email: email,
            password: password,
            cpassword: cpassword,
            status: cstatus,
            level: level
        }
        showLoader();
        let req = await api.post("/usuarios/salvar", { dados: dados });
        showLoader();
        let { status, msg, campo } = req.data;
        if (status === false) {
            showAlert(msg, "error");
            if (campo != '') {
                setValidation(campo, "is-invalid");
            }
            return false;
        }
        if (status === true) {
            showAlert(msg, "success");
            elemetform.reset();
            elemetform.querySelectorAll(['input', 'select']).forEach(function (item) {
                item.classList.remove("is-invalid");
                item.classList.remove("is-valid");
            });
            return true;
        }
    } catch (e) {
        showLoader();
        console.log(e);
    }
}