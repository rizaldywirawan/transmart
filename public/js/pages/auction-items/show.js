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
var remainingSeconds = parseInt(remainingSecondsElement.dataset.remainingSeconds);
var remainingTimeHoursElement = document.querySelector('#auction-item__remaining-time__hours');
var remainingTimeMinutesElement = document.querySelector('#auction-item__remaining-time__minutes');
var remainingTimeSecondsElement = document.querySelector('#auction-item__remaining-time__seconds');
var bidSubmissionButton = document.querySelector('#auction-item-bid-submission__button');
var emptyBidHistory = document.querySelector('#auction-item-no-bid-yet');
var bidEntryContainer = document.querySelector('#auction-item-bid-historical__entries'); // to be rewritten

var auctionItemLatestPrice = document.querySelector('#auction-item-latest-price');
var auctionBidderLatestPrice = document.querySelector('#auction-bidder-latest-bid-price');
var auctionBidderLatestName = document.querySelector('#auction-bidder-latest-bid-name');
var auctionBidPrice = document.querySelector('#auction-item-bid-submission__bid-price');
var auctionBidPricePlaceholder = document.querySelector('#auction-item-bid-submission__bid-price-placeholder'); // set the remaining time in separated format

if (remainingSeconds !== 0) {
  var remainingTimeIntervalId = setInterval(function () {
    if (remainingSeconds === 0) {
      clearInterval(remainingTimeIntervalId);
      window.location.reload();
    } else {
      var remainingTime = convertSecondsToRemainingTime(remainingSeconds);
      remainingTimeHoursElement.textContent = remainingTime.hours;
      remainingTimeMinutesElement.textContent = remainingTime.minutes;
      remainingTimeSecondsElement.textContent = remainingTime.seconds;
      remainingSeconds--;
    }
  }, 1000);
} // Echo Section


Echo.join("auction-item.".concat(auctionItemDetailId)).listen('AuctionBidderPriceSubmitted', function (e) {
  auctionItemLatestPrice.textContent = "Rp ".concat(e.auctionBidder.formatted_bid_price);
  auctionBidderLatestPrice.textContent = "Rp ".concat(e.auctionBidder.formatted_bid_price);
  auctionBidderLatestPrice.classList.remove('hidden');
  auctionBidderLatestName.textContent = "oleh ".concat(e.auctionBidder.user.profile.name);

  if (emptyBidHistory !== null) {
    emptyBidHistory.remove();
  }

  var bidEntry = document.createElement('div');
  bidEntry.innerHTML = "\n            <div class=\"general-box-shadow p-3 flex items-center rounded-xl mb-3\">\n                <span class=\"h-8 w-8 sm:h-5 sm:w-5 mr-3\">\n                    <img src=\"/images/icons/icon-money.svg\" alt=\"Auction Item Bid Record\"\n                        class=\"h-full\">\n                </span>\n                <h6 class=\"text-sm font-normal\">".concat(e.auctionBidder.user.profile.name, " melakukan penawaran sebesar <span\n                        class=\"text-primary-500 text-base font-bold\">Rp ").concat(e.auctionBidder.formatted_bid_price, "</span>\n                </h6>\n            </div>\n        ");
  bidEntryContainer.prepend(bidEntry);
}); // Event Listener

if (bidSubmissionButton !== null) {
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
        heightAuto: false,
        text: response.data.message.text,
        imageWidth: "7rem",
        imageUrl: '/images/icons/icon-success.svg',
        confirmButtonColor: '#F87BDF',
        confirmButtonText: 'Semoga Beruntung'
      });
    })["catch"](function (error) {
      Swal.fire({
        // title: error.response.data.message.title,
        heightAuto: false,
        text: error.response.data.message.text,
        imageWidth: "5rem",
        imageUrl: '/images/icons/icon-fail.png',
        confirmButtonColor: '#F87BDF',
        confirmButtonText: 'Coba Kembali'
      });
    });
  });
} // Functions Section


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

document.body.addEventListener('click', function (el) {
  if (el.target.classList.contains('bid-value')) {
    auctionBidPrice.value = parseInt(auctionBidPrice.value) + parseInt(el.target.dataset.value);
    auctionBidPricePlaceholder.textContent = new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR'
    }).format(auctionBidPrice.value);
  }
});
/******/ })()
;