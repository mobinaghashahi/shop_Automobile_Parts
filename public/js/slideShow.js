let slideIndex = 1;
let intervalSlidShow;
intervalSlidShow = setInterval(nextSlide, 6000, slideIndex);
showSlides(slideIndex)

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function nextSlide(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex = slideIndex + 1;
    if (slides.length < slideIndex) {
        slideIndex = 1;
    }
    slides[slideIndex - 1].style.display = "block";
}

function showSlides(n) {
    clearInterval(intervalSlidShow);
    let i;
    let slides = document.getElementsByClassName("mySlides");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex - 1].style.display = "block";
    intervalSlidShow = setInterval(nextSlide, 6000, slideIndex);
}
