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
        :headers="['Sản phẩm', 'Khách hàng', 'Đánh giá', 'Số sao', 'Trạng thái', 'Thao tác']"
        striped
    >

        @foreach($reviews as $review)
            <tr>
                <td>{{ $review->product->TenSanPham }}</td>
                <td>{{ $review->MaTaiKhoan }} </td>
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
                <td> 
                    @if($review->TrangThai == 1) <x-badge variant="success">Hiển thị</x-badge>
                    @elseif($review->TrangThai == 0)<x-badge variant="warning">Đã ẩn</x-badge>
                    @endif
                </td>
                <td>
                    <div class="action-group">
                        <form action="{{ route( 'admin.hideReview', $review->MaDanhGia) }}"method="POST">
                            @csrf
                            @method('PUT')
                            <x-button variant="warning">Ẩn</x-button>
                        </form>
                        <form action="{{ route( 'admin.displayReview', $review->MaDanhGia) }}"method="POST">
                            @csrf
                            @method('PUT')
                            <x-button variant="primary" type="submit">Hiển thị</x-button>
                        </form>
                        <form action="{{ route('admin.deleteReview', $review->MaDanhGia) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-button variant="danger" type="button" onclick="openModal('deleteReview{{ $review->MaDanhGia }}')">
                                Xóa
                            </x-button>
                        </form>
                    </div>
                    <form
                        action="{{ route('admin.replyReview',$review->MaDanhGia) }}" method="POST" class="reply-form">
                        @csrf
                        <x-input type="text" name="reply" placeholder="Phản hồi đánh giá..." />
                        <x-button type="submit">Gửi</x-button>
                    </form>
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