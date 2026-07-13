const track = document.querySelector('.gallery-track');
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');
const totalSlides = slides.length;

let current = 0;

function updateSlider() {
    track.style.transform = `translateX(${current * -100}%)`;  // ✅ negative

    dots.forEach(dot => dot.classList.remove('active'));

    if (dots[current]) {
        dots[current].classList.add('active');
    }
}

document.querySelector('.prev').addEventListener('click', () => {
    current--;                              // ✅ prev goes back
    if (current < 0) {
        current = slides.length - 1;
    }
    updateSlider();
});

document.querySelector('.next').addEventListener('click', () => {
    current++;                              // ✅ next goes forward
    if (current >= slides.length) {
        current = 0;
    }
    updateSlider();
});

dots.forEach(dot => {
    dot.addEventListener('click', () => {
        current = Number(dot.dataset.index); // keep this
        updateSlider();
    });
});





/* ===== SWIPE SUPPORT (MOBILE) ===== */

const wrapper = document.querySelector('.gallery-wrapper');

let startX = 0;
let isDragging = false;

wrapper.addEventListener('touchstart', (e) => {
    startX = e.touches[0].clientX;
    isDragging = true;
}, { passive: true });

wrapper.addEventListener('touchmove', (e) => {
    if (!isDragging) return;
    // مش لازم نعمل أي حاجة هنا، بس سايبينه لو حبينا نضيف drag-preview بعدين
}, { passive: true });

wrapper.addEventListener('touchend', (e) => {

    if (!isDragging) return;

    const endX = e.changedTouches[0].clientX;
    const diff = startX - endX;

    const threshold = 50; // أقل مسافة سحب عشان يتحرك

    if (diff > threshold) {
        // سحب لليسار → يروح للصورة الجاية
        current++;
        if (current >= slides.length) {
            current = 0;
        }
        updateSlider();

    } else if (diff < -threshold) {
        // سحب لليمين → يرجع للصورة اللي قبلها
        current--;
        if (current < 0) {
            current = slides.length - 1;
        }
        updateSlider();
    }

    isDragging = false;

});
