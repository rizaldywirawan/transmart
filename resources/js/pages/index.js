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
            text: response.data.message.text,
            imageWidth: "7rem",
            imageUrl: '/images/icons/illustration-complete.svg',
            confirmButtonColor: '#E60013',
            confirmButtonText: 'Autentikasi Berhasil'
        }).then(() => {
            window.location.reload()
        })
    }).catch(error => {

        Swal.fire({
            // title: error.response.data.message.title,
            text: error.response.data.message.text,
            imageWidth: "5rem",
            imageUrl: '/images/icons/icon-fail.png',
            confirmButtonColor: '#E60013',
            confirmButtonText: 'Coba Kembali'
        })
    })
})
