/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************************!*\
  !*** ./resources/js/pages/auction-items/show.js ***!
  \**************************************************/
// Initiation Section
// Build the remaining time
var auctionItemDetail = document.querySelector('#auction-item-detail');
var auctionItemDetailId = auctionItemDetail.dataset.id;
var remainingSecondsElement = document.querySelector('#auction-item__remaining-time');
var remainingSeconds = remainingSecondsElement.dataset.remainingSeconds;
var remainingTimeHoursElement = document.querySelector('#auction-item__remaining-time__hours');
var remainingTimeMinutesElement = document.querySelector('#auction-item__remaining-time__minutes');
var remainingTimeSecondsElement = document.querySelector('#auction-item__remaining-time__seconds');
var bidSubmissionButton = document.querySelector('#auction-item-bid-submission__button'); // to be rewritten

var auctionItemLatestPrice = document.querySelector('#auction-item-latest-price');
var auctionBidderLatestPrice = document.querySelector('#auction-bidder-latest-bid-price');
var auctionBidderLatestName = document.querySelector('#auction-bidder-latest-bid-name'); // set the remaining time in separated format

setInterval(function () {
  var remainingTime = convertSecondsToRemainingTime(remainingSeconds);
  remainingTimeHoursElement.textContent = remainingTime.hours;
  remainingTimeMinutesElement.textContent = remainingTime.minutes;
  remainingTimeSecondsElement.textContent = remainingTime.seconds;
  remainingSeconds--;

  if (remainingSeconds === 0) {
    alert();
    window.location.reload();
  }
}, 1000); // Echo Section

Echo.join("auction-item.".concat(auctionItemDetailId)).listen('AuctionBidderPriceSubmitted', function (e) {
  auctionItemLatestPrice.textContent = "Rp. ".concat(e.auctionBidder.formatted_bid_price);
  auctionBidderLatestPrice.textContent = "Rp. ".concat(e.auctionBidder.formatted_bid_price);
  auctionBidderLatestPrice.classList.remove('hidden');
  auctionBidderLatestName.textContent = "oleh ".concat(e.auctionBidder.user.profile.name);
}); // Event Listener

bidSubmissionButton.addEventListener('click', function (el) {
  var bidPrice = document.querySelector('#auction-item-bid-submission__bid-price');
  axios({
    method: 'post',
    url: "".concat(window.location.pathname, "/bids"),
    data: {
      "bid-price": bidPrice.value
    }
  }).then(function (response) {
    Swal.fire({
      // title: error.response.data.message.title,
      text: response.data.message.text,
      imageWidth: "7rem",
      imageUrl: '/images/icons/illustration-complete.svg',
      confirmButtonColor: '#E60013',
      confirmButtonText: 'Semoga Beruntung'
    });
  })["catch"](function (error) {
    Swal.fire({
      // title: error.response.data.message.title,
      text: error.response.data.message.text,
      imageWidth: "5rem",
      imageUrl: '/images/icons/icon-fail.png',
      confirmButtonColor: '#E60013',
      confirmButtonText: 'Coba Kembali'
    });
  });
}); // Functions Section

function convertSecondsToRemainingTime(value) {
  var sec = parseInt(value, 10); // convert value to number if it's string

  var hours = Math.floor(sec / 3600); // get hours

  var minutes = Math.floor((sec - hours * 3600) / 60); // get minutes

  var seconds = sec - hours * 3600 - minutes * 60; //  get seconds

  return {
    hours: hours,
    minutes: minutes,
    seconds: seconds
  };
}
/******/ })()
;