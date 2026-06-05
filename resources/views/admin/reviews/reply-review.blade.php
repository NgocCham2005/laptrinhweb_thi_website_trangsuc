@extends('layouts.admin')

@section('title','Phản hồi đánh giá')

@section('page-title')

Quản lý đánh giá

@endsection

@section('content')

    <div class="page-header">
        <h3>Phản hồi đánh giá</h3>
    </div>

    <div class="form-grid">
        <form action="{{ route('admin.replyReview', $review->MaDanhGia) }}" method="POST">
            @csrf
            <div>
                <x-input type="text" label="Sản phẩm" value="{{ $review->product->TenSanPham ?? 'Không xác định' }}" disabled />
                <x-input type="text" label="Tên đăng nhập" value="{{ $review->user->TenDangNhap ?? 'Không xác định' }}" disabled />
                <x-input type="text" label="Số sao" value="{{ $review->XepHang }} ⭐" disabled/>
                <x-input type="text" label="Ngày tạo" value="{{ $review->NgayTao ? date('d/m/Y H:i', strtotime($review->NgayTao)) : '' }}" disabled />
                <x-input type="text" label="Nội dung đánh giá" value="{{ $review->BinhLuan }}" disabled />
                <x-input type="textarea" name="reply" label="Nội dung phản hồi" placeholder="Nhập nội dung phản hồi..." />
            </div>

            <div class="action-buttons">
                <x-button type="submit" variant="primary">
                    Gửi phản hồi
                </x-button>
                <a href="{{ route('admin.reviews') }}" style="text-decoration:none;">
                    <x-button type="button" variant="outline-navy">
                        Quay lại
                    </x-button>
                </a>
        </div>
    </form>
</div>

@endsection