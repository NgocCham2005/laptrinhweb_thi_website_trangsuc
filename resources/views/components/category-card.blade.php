@props(['category'])

<div class="category-card">
    <a href="{{ route('categories.show', $category->MaDanhMuc) }}" class="category-link">
        <div class="category-icon-box">
            <span>{{ mb_substr($category->TenDanhMuc, 0, 1) }}</span>
        </div>
        <h4 class="category-name">{{ $category->TenDanhMuc }}</h4>
    </a>
</div>