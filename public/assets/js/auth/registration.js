import {APP_API, APP_URL} from "../config.js";

/**
 * Регистрация для роута /registration и перенаправление на /users
 * @returns {Promise<void>}
 */
async function auth_registration() {
    let name = document.getElementById('name').value;
    let phone = document.getElementById('phone').value;
    let password = document.getElementById('password').value;
    let email = document.getElementById('password').value;
    let username = document.getElementById('username').value;

    let user = {
        "username": username,
        "email": email,
        "name": name,
        "phone": phone,
        "password": password,
    };

    fetch(`${APP_API}/registration`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(user)
    })
        .then(res => {
            if (res.status === 400) {
                alert('ошибка')
                return null;
            }
            return res.json();
        })
        .then(responce_data => {
            localStorage.setItem("accessToken", responce_data.tokens.accessToken);
            localStorage.setItem("refreshToken", responce_data.tokens.refreshToken);

            let userData = JSON.stringify(responce_data.user)
            localStorage.setItem("user", userData)

            // window.location.replace(`${APP_URL}/users?user_id=${responce_data.user.userId}`)
        })
        .catch(err => console.log(err));

};

window.addEventListener('load', function () {
    document.getElementById('reg-button').onclick = auth_registration;
})
