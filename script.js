/*------------------script Navigation Header ----------------------------0*/

let boutonBurger = document.getElementById('burger');
let liensNav = document.getElementById('ulNav');

boutonBurger.addEventListener('click', () => {
  liensNav.classList.toggle("openNav");

  if
    (liensNav.classList.contains("openNav")) {

    boutonBurger.src = "icones/x-solid.svg";


  } else {

    boutonBurger.src = "icones/bars-solid.svg";

  }
})

/*------------------script Carousel slides tourne manuellement----------------------------0*/


let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("custom-slider");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {
    slideIndex = 1
  }
  if (n < 1) {
    slideIndex = slides.length
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
}

/*------------------script automatisation Carousel ----------------------------0*/

const COOLDOWN_DURATION = 4000;
setInterval(function () {
  plusSlides(1);
}, COOLDOWN_DURATION)