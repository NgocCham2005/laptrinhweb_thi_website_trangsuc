<section class="hero">

    <div class="hero-slider">

        <!-- BUTTON LEFT -->

        <button class="hero-btn prev">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <!-- HERO LIST -->

        <div class="hero-wrapper">

            @foreach($categories as $category)

                <div class="hero-item">

                        <a href="{{ route('products.index', ['danh_muc' => $category->MaDanhMuc]) }}">
                        <img
                            src="{{ asset('images/categories/' . $category->HinhAnh) }}"
                            alt="{{ $category->TenDanhMuc }}"
                        >

                    </a>

                </div>

            @endforeach

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

