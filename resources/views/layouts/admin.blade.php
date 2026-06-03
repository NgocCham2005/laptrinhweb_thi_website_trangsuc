<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width">

<title>

@yield('title')

</title>

<link rel="stylesheet"
href="{{ asset('css/admin.css') }}">

<link rel="stylesheet"
href="{{ asset('css/form.css') }}">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="admin-layout">

@include('partials.sidebar')

<div class="admin-main">

@include('partials.admin-header')

<div class="admin-content">

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@yield('content')

</div>

</div>

</div>

</body>

</html>