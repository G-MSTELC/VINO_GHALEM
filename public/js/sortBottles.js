/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/sortBottles.js ***!
  \*************************************/
document.getElementById('sortCellier').addEventListener('change', function () {
  var sortSelect = document.getElementById('sortCellier');
  console.log(sortSelect);
  var selectedSort = sortSelect.options[sortSelect.selectedIndex].value;
  var currentUrl = window.location.href;
  var newUrl = currentUrl.split('?')[0] + '?sort=' + selectedSort;
  window.location.href = newUrl;
});
/******/ })()
;