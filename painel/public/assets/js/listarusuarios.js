document.addEventListener("DOMContentLoaded", async function () {
    await listarUsuarios();

    // Refresh user list
    document.getElementById("refresh-result").addEventListener("click", async function () {
        await listarUsuarios();
    });
});

const deleteUser = function () {
    try {
        let userid = getId();
        if (userid == false) {
            showAlert("Selecione um usuário para excluir.", "error");
            return false;
        }
        let deleteUsuarios = async () => {
            try {
                showLoader();
                let req = await api.post('/usuarios/delete-user', { userid: userid });
                showLoader();
                let { status, msg } = req.data;
                if (status === false) {
                    showAlert(msg, "error");
                    return false;
                }
                if (status === true) {
                    showAlert("Usuário excluído com sucesso.", "success");
                    document.getElementById(`tr-${userid}`).remove();
                }
            } catch (e) {
                console.log(e);
            }
        }
        showConfirm("Deseja realmente excluir o usuário?", deleteUsuarios);
    } catch (e) {
        console.log(e);
    }
}


// Listar usuários
async function listarUsuarios() {
    try {
        showLoaderList();
        let req = await api.get("/usuarios/listar");
        let { status, msg, dados } = req.data;
        showLoaderList();
        if (status === false) {
            showAlert(msg, "error");
            return false;
        }
        let total = Object.keys(dados).length;
        if (total === 0) {
            htmlNotResul("Não há usuários cadastrados.", 8);
            return false;
        }
        let htmlresult = '';
        let fontstatus = {
            'A': 'Ativo',
            'I': 'Inativo'
        }
        let fontlevel = {
            'M': 'Master',
            'A': 'Admin',
            'S': 'Supervisor'
        }
        for (i of dados) {
            let objDate = new Date(i.cadastrado);
            let date = objDate.toLocaleDateString('pt-BR', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
            htmlresult += `
                <tr class="tr-list" id="tr-${i.userid}">
                    <td class="tdcenter"><i class="fa-regular fa-circle-check" id="code-${i.userid}"></i></td>
                    <td class="tdcenter">${String(i.userid).padStart(6, '0')}</td>
                    <td class="tdleft">${i.name}</td>
                    <td class="tdleft">${i.sobrenome}</td>
                    <td class="tdleft">${i.email}</td>
                    <td class="tdcenter">${fontstatus[i.status]}</td>
                    <td class="tdcenter">${fontlevel[i.level]}</td>
                    <td class="tdcenter">${date}</td>
                </tr>
            `;
        }
        document.getElementById("tbody-list").innerHTML = htmlresult;
    } catch (e) {
        showLoaderList();
        console.log(e);
    }
}
