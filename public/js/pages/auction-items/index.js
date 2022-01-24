/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************************!*\
  !*** ./resources/js/pages/auction-items/index.js ***!
  \***************************************************/
var remainingSecondsElement = document.querySelector('#auction-item__remaining-time');
var remainingSeconds = parseInt(remainingSecondsElement.dataset.remainingSeconds);
var remainingTimeHoursElement = document.querySelector('#auction-item__remaining-time__hours');
var remainingTimeMinutesElement = document.querySelector('#auction-item__remaining-time__minutes');
var remainingTimeSecondsElement = document.querySelector('#auction-item__remaining-time__seconds'); // set the remaining time in separated format

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
/******/ })()
;