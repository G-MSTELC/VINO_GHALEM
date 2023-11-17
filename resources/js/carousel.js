let slideIndex = 0;

const slides = document.querySelectorAll(".carousel-slide");
const prevButton = document.querySelector(".btn-prev");
const nextButton = document.querySelector(".btn-next");

function showSlide(n) {
  if (n >= slides.length) {
    slideIndex = 0;
  }
  if (n < 0) {
    slideIndex = slides.length - 1;
  }

  slides.forEach((slide) => {
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
