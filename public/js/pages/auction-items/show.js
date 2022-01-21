/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************************!*\
  !*** ./resources/js/pages/auction-items/show.js ***!
  \**************************************************/
var integer = 0;
Echo.channel("auction-item").listen('PriceSubmitted', function (e) {
  var write = document.createElement('span');
  write.textContent = ++integer;
  document.querySelector('#test-button').appendChild(write);
});
var button = document.querySelector('#test-button');
button.addEventListener('click', function (el) {
  axios({
    url: '/auction-items/2eca7424-fe2c-4762-bced-a83da30564c9/bids',
    method: 'post'
  }).then(function () {});
});
/******/ })()
;