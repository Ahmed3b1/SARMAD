const navbar = document.getElementById("navbar");

if(navbar.classList.contains("navbar-home")){

    window.addEventListener("scroll",function(){

        if(window.scrollY > 10){
            navbar.classList.add("scrolled");
        }else{
            navbar.classList.remove("scrolled");
        }

    });

}

document.querySelectorAll('.slider-wrapper').forEach(wrapper => {

    const slider = wrapper.querySelector('.products-slider');
    const nextBtn = wrapper.querySelector('.next');
    const prevBtn = wrapper.querySelector('.prev');

    if(nextBtn){
        nextBtn.addEventListener('click', () => {
            slider.scrollBy({
                left:350,
                behavior:'smooth'
            });
        });
    }

    if(prevBtn){
        prevBtn.addEventListener('click', () => {
            slider.scrollBy({
                left:-350,
                behavior:'smooth'
            });
        });
    }

});

function changeImage(element)
{
    document
        .getElementById('mainImage')
        .src = element.src;
}

// navbar hamburger

document.addEventListener('DOMContentLoaded', function () {
    const menuBtn = document.getElementById('mobileMenuBtn');
    const navLinks = document.getElementById('navLinks');

    if(menuBtn && navLinks){

        menuBtn.addEventListener('click', function () {
            navLinks.classList.toggle('mobile-active');
            menuBtn.classList.toggle('active');
        });

        document.addEventListener('click', function (e) {
            if (!navLinks.contains(e.target) && !menuBtn.contains(e.target)) {
                navLinks.classList.remove('mobile-active');
                menuBtn.classList.remove('active');
            }
        });

    }

});