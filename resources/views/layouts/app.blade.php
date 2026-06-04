<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Luminous Jewelry</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/component.css') }}">
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user-layout.css') }}">
   <link rel="stylesheet" href="{{ asset('css/app.css') }}">
   <link rel="stylesheet" href="{{ asset('css/component.css') }}">
   <link rel="stylesheet" href="{{ asset('css/product.css') }}">
   <link rel="stylesheet" href="{{ asset('css/product-detail.css') }}">
   <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/slider.js') }}"></script>
</head>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toast = document.getElementById('toast-success');

    if (toast) {
        setTimeout(() => {
            toast.classList.add('hide');
        }, 3000);

        setTimeout(() => {
            toast.remove();
        }, 3500);
    }
});
</script>
<body>

     @include('partials.header') 
        @if(session('success'))
        <div id="toast-success">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    <main>
       @yield('content') 
    </main>

   @include('partials.footer') 
   

</body>

</html>