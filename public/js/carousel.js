/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/carousel.js ***!
  \**********************************/
var slideIndex = 0;
var slides = document.querySelectorAll(".carousel-slide");
var prevButton = document.querySelector(".btn-prev");
var nextButton = document.querySelector(".btn-next");
function showSlide(n) {
  if (n >= slides.length) {
    slideIndex = 0;
  }
  if (n < 0) {
    slideIndex = slides.length - 1;
  }
  slides.forEach(function (slide) {
    slide.style.display = "none";
  });
  slides[slideIndex].style.display = "block";
}
prevButton.addEventListener("click", function () {
  showSlide(--slideIndex);
});
nextButton.addEventListener("click", function () {
  showSlide(++slideIndex);
});

// Affiche le premier slide au chargement
showSlide(slideIndex);
/******/ })()
;