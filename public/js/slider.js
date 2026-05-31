document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.product-track').forEach(track => {

        const wrapper = track.querySelector('.home-product-wrapper');
        const prevBtn = track.querySelector('.product-prev');
        const nextBtn = track.querySelector('.product-next');

        let items = [...wrapper.children];

        if (items.length <= 3) return;

        const visibleCount = 3;

        // clone 3 card đầu và cuối
        const firstClones = items
            .slice(0, visibleCount)
            .map(item => item.cloneNode(true));

        const lastClones = items
            .slice(-visibleCount)
            .map(item => item.cloneNode(true));

        lastClones.forEach(clone => {
            wrapper.insertBefore(clone, wrapper.firstChild);
        });

        firstClones.forEach(clone => {
            wrapper.appendChild(clone);
        });

        items = [...wrapper.children];

        let currentIndex = visibleCount;

        function getStepWidth() {
            const itemWidth =
                items[0].getBoundingClientRect().width;

            const gap =
                parseFloat(getComputedStyle(wrapper).gap) || 20;

            return itemWidth + gap;
        }

        function move(animate = true) {

            wrapper.style.transition =
                animate ? 'transform .45s ease' : 'none';

            wrapper.style.transform =
                `translateX(-${currentIndex * getStepWidth()}px)`;
        }

        move(false);

        nextBtn.addEventListener('click', () => {
            currentIndex++;
            move();
        });

        prevBtn.addEventListener('click', () => {
            currentIndex--;
            move();
        });

        wrapper.addEventListener('transitionend', () => {

            const realCount = items.length - visibleCount * 2;

            // cuối -> đầu
            if (currentIndex >= realCount + visibleCount) {
                currentIndex = visibleCount;
                move(false);
            }

            // đầu -> cuối
            if (currentIndex < visibleCount) {
                currentIndex = realCount + visibleCount - 1;
                move(false);
            }

        });

        window.addEventListener('resize', () => {
            move(false);
        });

    });

});
/* =========================
   BANNER SLIDESHOW
========================= */

document.addEventListener('DOMContentLoaded', () => {

    const slides =
        document.querySelectorAll('.banner-slide');

    if (slides.length <= 1) return;

    let current = 0;

    setInterval(() => {

        slides[current]
            .classList.remove('active');

        current =
            (current + 1) % slides.length;

        slides[current]
            .classList.add('active');

    }, 5000);

});