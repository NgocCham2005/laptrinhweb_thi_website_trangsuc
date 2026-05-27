@props([
    'paginator'
])

@if($paginator->hasPages())

<div class="pagination-wrapper">

<nav>

<ul class="pagination">

{{-- Previous --}}
@if ($paginator->onFirstPage())

<li class="page-item disabled">

<span class="page-link">
‹
</span>

</li>

@else

<li class="page-item">

<a
class="page-link"
href="{{ $paginator->previousPageUrl() }}"
>

‹

</a>

</li>

@endif


{{-- Numbers --}}
@foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)

<li class="page-item
{{ $page == $paginator->currentPage()
? 'active'
: '' }}">

<a
class="page-link"
href="{{ $url }}"
>

{{ $page }}

</a>

</li>

@endforeach


{{-- Next --}}
@if ($paginator->hasMorePages())

<li class="page-item">

<a
class="page-link"
href="{{ $paginator->nextPageUrl() }}"
>

›

</a>

</li>

@else

<li class="page-item disabled">

<span class="page-link">
›
</span>

</li>

@endif

</ul>

</nav>

</div>

@endif