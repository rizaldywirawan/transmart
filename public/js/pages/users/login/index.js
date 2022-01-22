/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./resources/js/pages/users/login/index.js ***!
  \*************************************************/
var authenticationStatus = document.querySelector('#authentication-form__status');
var authenticationIcon = document.querySelector('#authentication-form__icon');
var authenticationButton = document.querySelector('#authentication-form__button'); // get all query strings

var params = new Proxy(new URLSearchParams(window.location.search), {
  get: function get(searchParams, prop) {
    return searchParams.get(prop);
  }
}); // check the login code

if (!params.code) {
  authenticationStatus.textContent = "Mohon sertakan kode login Anda.";
  authenticationIcon.setAttribute('src', '/images/icons/icon-fail.png');
  authenticationIcon.classList.remove('animate-spin');
} else {
  // authenticate the login code
  axios({
    method: 'post',
    url: window.location.pathname,
    data: {
      code: params.code
    }
  }).then(function (response) {
    authenticationIcon.setAttribute('src', '/images/icons/illustration-complete.svg');
    authenticationStatus.textContent = response.data.message.text;
    var refreshPageCount = 5;
    setInterval(function () {
      if (refreshPageCount === 0) {
        window.location.reload();
      } else {
        refreshPageCount--;
        authenticationButton.textContent = "Masuk Sistem (".concat(refreshPageCount, ")");
      }
    }, 1000);
  })["catch"](function (error) {
    authenticationIcon.setAttribute('src', '/images/icons/icon-fail.png');

    if (error.hasOwnProperty('response')) {
      if (error.response.hasOwnProperty('message')) {
        authenticationStatus.textContent = error.response.data.message.text;
      } else {
        authenticationStatus.textContent = "Terjadi kesalahan, mohon muat ulang halaman.";
      }
    } else {
      authenticationStatus.textContent = "Terjadi kesalahan, mohon muat ulang halaman.";
    }
  })["finally"](function () {
    authenticationButton.classList.remove('hidden');
    authenticationIcon.classList.remove('animate-spin');
  });
}

authenticationButton.addEventListener('click', function (el) {
  window.location.reload();
});
/******/ })()
;