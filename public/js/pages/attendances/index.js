/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./resources/js/pages/attendances/index.js ***!
  \*************************************************/
$(document).ready(function () {
  Echo.channel('attendance-log').listen('AttendanceSigned', function (e) {
    if ($('#attendance-empty-state').length) {
      $('#attendance-empty-state').remove();
    }

    var margin = "mb-0";

    if ($('.attendance-entry').length) {
      margin = "mb-3";
    }

    $('#attendance-container').prepend("\n            <div class=\"attendance-entry ".concat(margin, "\">\n                <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-5 w-5 inline-block stroke-current text-green-600\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">\n                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z\" />\n                </svg>\n                <span class=\"text-base font-normal\">").concat(e.user['profile']['name'], " <span class=\"text-danger font-bold\">attend</span> by ").concat(e.user['latest_attendance']['location_type']['name'], " <span class=\"text-xs font-light text-neutral-400\">").concat(e.user['latest_attendance']['formatted_created_at'], "</span></span>\n            </div>\n            "));
    $('#attendance-total').text("".concat(e.attendanceData['attendance-today'], "/").concat(e.attendanceData['total-participant']));
    $('#attendance-online').text("".concat(e.attendanceData['attendance-online']));
    $('#attendance-offline').text("".concat(e.attendanceData['attendance-offline']));
  });
  $('#menu-attendance').addClass('text-danger border rounded-md shadow-sm');
  $('#toggle_fullscreen').on('click', function (el) {
    // if already full screen; exit
    // else go fullscreen
    if (document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement) {
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
      } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
      } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
      }

      $(el.target).text('Full Screen');
    } else {
      element = $('#container').get(0);

      if (element.requestFullscreen) {
        element.requestFullscreen();
      } else if (element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
      } else if (element.webkitRequestFullscreen) {
        element.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
      } else if (element.msRequestFullscreen) {
        element.msRequestFullscreen();
      }

      $(el.target).text('Minimize');
    }
  });
});
/******/ })()
;