document.addEventListener("DOMContentLoaded", function () {

    function initCarousel(wrapperSelector, nextSelector, prevSelector, itemClass) {

        const wrapper = document.querySelector(wrapperSelector);
        const nextBtn = document.querySelector(nextSelector);
        const prevBtn = document.querySelector(prevSelector);

        if (!wrapper || !nextBtn || !prevBtn) return;

        const itemWidth = 240;
        let isAnimating = false;

        function updateActive() {
            const items = wrapper.querySelectorAll(itemClass);

            items.forEach(i => i.classList.remove("active"));

            const middle = Math.floor(items.length / 2);
            if (items[middle]) items[middle].classList.add("active");
        }

        nextBtn.addEventListener("click", () => {
            if (isAnimating) return;
            isAnimating = true;

            wrapper.style.transition = "transform .35s ease";
            wrapper.style.transform = `translateX(-${itemWidth}px)`;

            setTimeout(() => {
                wrapper.appendChild(wrapper.firstElementChild);

                wrapper.style.transition = "none";
                wrapper.style.transform = "translateX(0)";

                updateActive();
                isAnimating = false;
            }, 350);
        });

        prevBtn.addEventListener("click", () => {
            if (isAnimating) return;
            isAnimating = true;

            wrapper.style.transition = "transform .35s ease";
            wrapper.style.transform = `translateX(${itemWidth}px)`;

            setTimeout(() => {
                wrapper.prepend(wrapper.lastElementChild);

                wrapper.style.transition = "none";
                wrapper.style.transform = "translateX(0)";

                updateActive();
                isAnimating = false;
            }, 350);
        });
    }

    /* HERO */
    initCarousel(".hero-wrapper", ".hero .next", ".hero .prev", ".hero-item");

    /* PRODUCT FEATURED */
    initCarousel(".featured .product-wrapper", ".featured .product-next", ".featured .product-prev", ".product-item");

    /* PRODUCT NEW */
    initCarousel(".new .product-wrapper", ".new .product-next", ".new .product-prev", ".product-item");

    /* BEST SELLING */
    initCarousel(".best_selling .product-wrapper", ".best_selling .product-next", ".best_selling .product-prev", ".product-item");

});