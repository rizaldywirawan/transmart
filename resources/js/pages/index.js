let codeInput = document.querySelector('#code')
let loginButton = document.querySelector('#login-button')

loginButton.addEventListener('click', function(el) {
    axios({
        method: 'post',
        url: '/login',
        data: {
            code: codeInput.value
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
