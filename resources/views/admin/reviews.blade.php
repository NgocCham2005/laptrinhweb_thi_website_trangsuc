@extends('layouts.admin')

@section('title','Đánh giá')

@section('page-title')

Quản lý đánh giá

@endsection


@section('content')

     <div class="page-header">
        <h3>Danh sách đánh giá</h3>
    </div>

    <x-table 
        :headers="['Sản phẩm', 'Tên đăng nhập', 'Đánh giá', 'Số sao', 'Ngày tạo', 'Trạng thái', 'Thao tác']"
        striped
    >

        @foreach($reviews as $review)
            <tr>
                <td>{{ $review->product->TenSanPham }}</td>
                <td>{{ $review->user->TenDangNhap }}</td>
                <td class="review-comment">{{ $review->BinhLuan }}
                    @foreach(
                        $review->replies
                        as $reply
                    )
                        <div class="reply-box">
                            <strong>Shop: </strong>{{ $reply->NoiDungPhanHoi }}
                        </div>
                    @endforeach
                </td>
                <td>{{ $review->XepHang }} ⭐</td>
                <td>{{ $review->NgayTao }}</td>
                <td> 
                    @if($review->TrangThai == 1) <x-badge variant="success">Hiển thị</x-badge>
                    @elseif($review->TrangThai == 0)<x-badge variant="warning">Đã ẩn</x-badge>
                    @endif
                </td>
                <td>
                    <div class="action-group">
                        @if($review->TrangThai == 0)
                            <form action="{{ route('admin.displayReview', $review->MaDanhGia) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <x-button variant="primary" type="submit">
                                    Hiển thị
                                </x-button>
                            </form>
                        @else
                            <form action="{{ route('admin.hideReview', $review->MaDanhGia) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <x-button variant="warning" type="submit">
                                    Ẩn
                                </x-button>
                            </form>
                        @endif
                        <form action="{{ route('admin.deleteReview', $review->MaDanhGia) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-button variant="danger" type="button" onclick="openModal('deleteReview{{ $review->MaDanhGia }}')">
                                Xóa
                            </x-button>
                        </form>
                    </div>
                    <!-- <form
                        action="{{ route('admin.replyReview',$review->MaDanhGia) }}" method="POST" class="reply-form">
                        @csrf
                        <x-input type="text" name="reply" placeholder="Phản hồi đánh giá..." />
                        <x-button type="submit">Phản hồi</x-button>
                    </form> -->
                    @if($review->replies->count() > 0)

    <x-button
        variant="warning"
        type="button"
        onclick="openModal('replyModal{{ $review->MaDanhGia }}')">
        Sửa phản hồi
    </x-button>

@else

    <x-button
        variant="primary"
        type="button"
        onclick="openModal('replyModal{{ $review->MaDanhGia }}')">
        Phản hồi
    </x-button>

@endif
<x-modal id="replyModal{{ $review->MaDanhGia }}"
         title="{{ $review->replies->count() > 0 ? 'Sửa phản hồi' : 'Phản hồi đánh giá' }}">

    <form id="replyForm{{ $review->MaDanhGia }}"
          action="{{ route('admin.replyReview',$review->MaDanhGia) }}"
          method="POST">

        @csrf

        <textarea
            name="reply"
            rows="5"
            style="width:100%;padding:10px;">{{ $review->replies->first()->NoiDungPhanHoi ?? '' }}</textarea>

    </form>

    <x-slot:footer>
        <x-button
            type="submit"
            form="replyForm{{ $review->MaDanhGia }}"
            variant="primary">
            Gửi phản hồi
        </x-button>

        <x-button
            type="button"
            variant="ghost"
            onclick="closeModal('replyModal{{ $review->MaDanhGia }}')">
            Hủy
        </x-button>
    </x-slot:footer>

</x-modal>
                </td>
            </tr>
            <x-modal id="deleteReview{{ $review->MaDanhGia }}" title="Xác nhận xóa đánh giá">
                Bạn có chắc chắn muốn xóa đánh giá này?
                <x-slot:footer>
                    <form action="{{ route('admin.deleteReview', $review->MaDanhGia) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-button variant="danger" type="submit">Xác nhận</x-button>
                        <x-button type="button" variant="ghost" onclick="closeModal('deleteReview{{ $review->MaDanhGia }}')">Hủy</x-button>
                    </form>
                </x-slot:footer>
            </x-modal>
        @endforeach
    </x-table>

    <x-pagination :paginator="$reviews"/>

@endsection