let codeInput = document.querySelector('#code')
let loginButton = document.querySelector('#login-button')

const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});

console.log(params.source)

loginButton.addEventListener('click', function(el) {
    axios({
        method: 'post',
        url: '/login',
        data: {
            code: codeInput.value,
            source: params.source ? params.source : null
        }
    }).then(response => {
        Swal.fire({
            // title: error.response.data.message.title,
            heightAuto: false,
            text: response.data.message.text,
            imageWidth: "7rem",
            imageUrl: '/images/icons/icon-success.svg',
            confirmButtonColor: '#F87BDF',
            confirmButtonText: 'Autentikasi Berhasil'
        }).then(() => {
            window.location.reload()
        })
    }).catch(error => {

        Swal.fire({
            // title: error.response.data.message.title,
            heightAuto: false,
            text: error.response.data.message.text,
            imageWidth: "5rem",
            imageUrl: '/images/icons/icon-fail.png',
            confirmButtonColor: '#F87BDF',
            confirmButtonText: 'Coba Kembali'
        })
    })
})
