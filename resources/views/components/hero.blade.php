<section class="hero">


    <div class="hero-slider">

        <!-- BUTTON LEFT -->

        <button class="hero-btn prev">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <!-- HERO LIST -->

        <div class="hero-wrapper">

            <div class="hero-item">
                <img src="https://www.tierra.vn/wp-content/uploads/2025/05/vang-trang-suc-la-vang-gi-hinh-anh-trang-suc-vang-dep.jpg">
            </div>

            <div class="hero-item">
                <img src="https://photo.znews.vn/w660/Uploaded/wyhktpu/2016_07_26/10.png">
            </div>

            <div class="hero-item active">
                <img src="https://www.tierra.vn/wp-content/uploads/2025/05/vang-trang-suc-la-vang-gi-hinh-anh-trang-suc-vang-dep.jpg">
            </div>

            <div class="hero-item">
                <img src="https://photo.znews.vn/w660/Uploaded/wyhktpu/2016_07_26/10.png">
            </div>

            <div class="hero-item">
                <img src="https://photo.znews.vn/w660/Uploaded/wyhktpu/2016_07_26/10.png">
            </div>

        </div>

        <!-- BUTTON RIGHT -->

        <button class="hero-btn next">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

    </div>

</section>

<script>

    const wrapper =
        document.querySelector('.hero-wrapper');

    const nextBtn =
        document.querySelector('.next');

    const prevBtn =
        document.querySelector('.prev');

    const itemWidth = 240;

    let isAnimating = false;

    function updateActive() {

        const items =
            document.querySelectorAll('.hero-item');

        items.forEach(item => {
            item.classList.remove('active');
        });

        const middle =
            Math.floor(items.length / 2);

        items[middle]
            .classList.add('active');
    }

    /* NEXT */

    nextBtn.addEventListener('click', () => {

        if (isAnimating) return;

        isAnimating = true;

        wrapper.style.transition =
            'transform .35s ease';

        wrapper.style.transform =
            `translateX(-${itemWidth}px)`;

        setTimeout(() => {

            const first =
                wrapper.firstElementChild;

            wrapper.appendChild(first);

            wrapper.style.transition =
                'none';

            wrapper.style.transform =
                'translateX(0)';

            updateActive();

            isAnimating = false;

        }, 350);
    });

    /* PREV */

    prevBtn.addEventListener('click', () => {

        if (isAnimating) return;

        isAnimating = true;

        wrapper.style.transition =
            'transform .35s ease';

        wrapper.style.transform =
            `translateX(${itemWidth}px)`;

        setTimeout(() => {

            const items =
                document.querySelectorAll('.hero-item');

            const last =
                items[items.length - 1];

            wrapper.prepend(last);

            wrapper.style.transition =
                'none';

            wrapper.style.transform =
                'translateX(0)';

            updateActive();

            isAnimating = false;

        }, 350);
    });

    /* CLICK ITEM */

document.querySelectorAll('.hero-item')
    .forEach(item => {

        item.addEventListener('click', () => {

            if (isAnimating) return;

            const items =
                Array.from(wrapper.children);

            const currentMiddle =
                Math.floor(items.length / 2);

            const clickedIndex =
                items.indexOf(item);

            /* CLICK RIGHT */

            if (clickedIndex > currentMiddle) {

                nextBtn.click();
            }

            /* CLICK LEFT */

            else if (clickedIndex < currentMiddle) {

                prevBtn.click();
            }
        });
    });


</script>

