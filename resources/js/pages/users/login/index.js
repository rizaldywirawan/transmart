let authenticationStatus = document.querySelector('#authentication-form__status')
let authenticationIcon = document.querySelector('#authentication-form__icon')
let authenticationButton = document.querySelector('#authentication-form__button')

// get all query strings
const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});

// check the login code
if (!params.code) {
    authenticationStatus.textContent = "Mohon sertakan kode login Anda."
    authenticationIcon.setAttribute('src', '/images/icons/icon-fail.png')
    authenticationIcon.classList.remove('animate-spin')

} else {

    // authenticate the login code
    axios({
        method: 'post',
        url: window.location.pathname,
        data: {
            code: params.code
        }
    }).then(response => {

        authenticationIcon.setAttribute('src', '/images/icons/illustration-complete.svg')
        authenticationStatus.textContent = response.data.message.text

        let refreshPageCount = 5;

        setInterval(function() {

            if (refreshPageCount === 0) {
                window.location.reload()
            } else {
                refreshPageCount--
                authenticationButton.textContent = `Masuk Sistem (${refreshPageCount})`
            }

        }, 1000)

    }).catch(error => {
        authenticationIcon.setAttribute('src', '/images/icons/icon-fail.png')

        if (error.hasOwnProperty('response')) {

            if (error.response.hasOwnProperty('message')) {
                authenticationStatus.textContent = error.response.data.message.text
            } else {
                authenticationStatus.textContent = "Terjadi kesalahan, mohon muat ulang halaman."
            }

        } else {
            authenticationStatus.textContent = "Terjadi kesalahan, mohon muat ulang halaman."
        }

    }).finally(() => {
        authenticationButton.classList.remove('hidden')
        authenticationIcon.classList.remove('animate-spin')
    })
}

