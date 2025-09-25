document.addEventListener("DOMContentLoaded", function () {
    let showpassword = document.getElementById("show-password");
    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let remember = document.getElementById("remember");
    let buttonlogin = document.getElementById("button-login");
    let buttonclear = document.getElementById("button-clear");
    // Mostrar senha
    showpassword.addEventListener("click", function () {
        if (password.type === "password") {
            password.type = "text";
            showpassword.innerHTML = "<i class='fa-solid fa-eye'></i>";
        } else {
            password.type = "password";
            showpassword.innerHTML = "<i class='fa-solid fa-eye-slash'></i>";
        }
    });
    // Verifica se os dados estão setados para serem lembrados
    let satusremember = localStorage.getItem("statusremember");
    if (satusremember === null) {
        window.localStorage.setItem("statusremember", "false");
    } else {
        if (satusremember === "true") {
            remember.checked = true;
            email.value = localStorage.getItem("email");
            password.value = localStorage.getItem("password");
        } else {
            remember.checked = false;
            email.value = "";
            password.value = "";
        }
    }

    // Seta os dados para serem lembrados quando digitados
    email.addEventListener("keyup", function () {
        localStorage.setItem("email", email.value);
    });
    password.addEventListener("keyup", function () {
        localStorage.setItem("password", password.value);
    });
    remember.addEventListener("click", function () {
        if (remember.checked) {
            window.localStorage.setItem("statusremember", "true");
            window.localStorage.setItem("email", email.value);
            window.localStorage.setItem("password", password.value);
        } else {
            window.localStorage.setItem("statusremember", "false");
            window.localStorage.setItem("email", "");
            window.localStorage.setItem("password", "");
        }
    });

    // Limpar o formulário
    buttonclear.addEventListener("click", function () {
        email.value = "";
        password.value = "";
        window.localStorage.setItem("email", "");
        window.localStorage.setItem("password", "");
    });

    // Valida o email 
    email.addEventListener("focusout", function () {
        let validaemail = validarEmail(email.value);
        if (!validaemail) {
            email.classList.remove('valid');
            email.classList.add("invalid");
        } else {
            email.classList.remove("invalid");
            email.classList.add("valid");
        }
    });

    // Valida a senha
    password.addEventListener("keyup", function () {
        if (password.value.length < 8) {
            password.classList.remove('valid');
            password.classList.add("invalid");
        } else {
            password.classList.remove("invalid");
            password.classList.add("valid");
        }
    });
    // Logar usuário
    buttonlogin.addEventListener("click", async function () {
        //showLoader();
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        await login(email, password);
    });
});

// validar email 
function validarEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

// Mostrar loader
function showLoader() {
    let loader = document.getElementById("loader");
    loader.classList.toggle("showloader");
}

async function login(email, password) {
    try {
        showLoader();
        let returnologin = document.getElementById("return-login");
        returnologin.classList.remove("invalid-login");
        returnologin.classList.add("info-login");
        returnologin.innerHTML = `<span>Realizando login...</span>`;
        let response = await axios.post(URL_API + "/login/logar", {
            email: email,
            password: password
        }, {
            headers: {
                "Content-Type": "multipart/form-data"
            }
        });
        console.log(response.data);
        showLoader();
        let { status, msg, campo } = response.data;
        if (status === false) {
            if (campo == '') {
                returnologin.classList.remove("info-login");
                returnologin.classList.add("invalid-login");
                returnologin.innerHTML = `<span>${msg}.</span>`;
            }
            // Email
            if (campo === "email") {
                document.getElementById('email').classList.remove("valid");
                document.getElementById('email').classList.add("invalid");
                document.getElementById('email').focus();
                returnologin.classList.remove("info-login");
                returnologin.classList.add("invalid-login");
                returnologin.innerHTML = `<span>${msg}.</span>`;
            } else {
                document.getElementById('email').classList.remove("invalid");
                document.getElementById('email').classList.add("valid");
            }
            // Password
            if (campo === "password") {
                document.getElementById('password').classList.remove("valid");
                document.getElementById('password').classList.add("invalid");
                document.getElementById('password').focus();
                returnologin.classList.remove("info-login");
                returnologin.classList.add("invalid-login");
                returnologin.innerHTML = `<span>${msg}.</span>`;
            } else {
                document.getElementById('password').classList.remove("invalid");
                document.getElementById('password').classList.add("valid");
            }
        }
        // redirect
        if (status) {
            returnologin.classList.remove("info-login");
            returnologin.classList.remove("invalid-login");
            returnologin.classList.add("valid-login");
            returnologin.innerHTML = `<span>Acesso autorizado.</span>`;
            setTimeout(function () {
                window.location.href = `${BASE_URL}/home/`;
            }, 500);
        }
    } catch (e) {
        showLoader();
        console.log(e);
    }
}