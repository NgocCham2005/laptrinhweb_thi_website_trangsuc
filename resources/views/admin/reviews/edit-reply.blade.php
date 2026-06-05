@extends('layouts.admin')

@section('title','Sửa phản hồi')

@section('page-title')

Quản lý đánh giá

@endsection

@section('content')

    <div class="page-header">
        <h3>Sửa phản hồi</h3>
    </div>

    <div class="form-grid">
        <form action="{{ route('admin.updateReply', $review->MaDanhGia) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <x-input type="text" label="Sản phẩm" value="{{ $review->product->TenSanPham }}" disabled />
                <x-input type="text" label="Tên đăng nhập" value="{{ $review->user->TenDangNhap }}" disabled />
                <x-input type="text" label="Số sao" value="{{ $review->XepHang }} ⭐" disabled />
                <x-input type="text" label="Ngày đánh giá" value="{{ date('d/m/Y H:i', strtotime($review->NgayTao)) }}" disabled/>
                <x-input type="text" label="Nội dung đánh giá" value="{{ $review->BinhLuan }}" disabled />
                <x-input type="text" label="Nội dung phản hồi hiện tại" value="{{ $review->replies->first()->NoiDungPhanHoi ?? 'Chưa có phản hồi' }}" disabled />
                <x-input type="textarea" name="reply" label="Nội dung phản hồi mới" placeholder="Nhập nội dung phản hồi mới..." />
            </div>

            <div class="action-buttons">
                <x-button type="submit" variant="primary">
                    Cập nhật
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