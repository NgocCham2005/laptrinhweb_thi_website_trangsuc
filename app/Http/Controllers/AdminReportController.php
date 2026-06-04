<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\SanPham;
use App\Models\DanhMucSP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
{
    public function index(Request $request)
    {
        $from=$request->from;
        $to=$request->to;
        $product=$request->product;
        $category=$request->category;
        $status=$request->status;
        $type=$request->type??'day';

        $categories=DanhMucSP::all();

        // SP theo danh mục
        $products=SanPham::query();
        if($category){
            $products->where('MaDanhMuc',$category);
        }
        $products=$products->get();

        // Format group
        $groupFormat=match($type){
            'month'=>'%Y-%m',
            'year'=>'%Y',
            default=>'%Y-%m-%d'
        };

        // ================= DOANH THU =================
        $ordersSub=DonHang::join('chi_tiet_don_hang','don_hang.MaDonHang','=','chi_tiet_don_hang.MaDonHang')
            ->where('don_hang.TrangThai',3)
            ->select(
                'don_hang.MaDonHang',
                'don_hang.NgayDatHang',
                'don_hang.GiaTriApDung',
                DB::raw("SUM(chi_tiet_don_hang.SoLuong*chi_tiet_don_hang.DonGia) as subtotal")
            )
            ->groupBy('don_hang.MaDonHang','don_hang.NgayDatHang','don_hang.GiaTriApDung');

        $revenueReports=DB::table(DB::raw("({$ordersSub->toSql()}) as t"))
            ->mergeBindings($ordersSub->getQuery())
            ->select(
                DB::raw("DATE_FORMAT(NgayDatHang,'$groupFormat') as ngay"),
                DB::raw("SUM(GREATEST(subtotal-COALESCE(GiaTriApDung,0),0)) as doanh_thu"),
                DB::raw("COUNT(*) as so_don")
            )
            ->groupBy('ngay')
            ->orderBy('ngay')
            ->get();

        // ================= TỔNG DOANH THU =================
        $totalRevenueQuery=DonHang::join('chi_tiet_don_hang','don_hang.MaDonHang','=','chi_tiet_don_hang.MaDonHang')
            ->where('don_hang.TrangThai',3);

        if($from) $totalRevenueQuery->whereDate('don_hang.NgayDatHang','>=',$from);
        if($to) $totalRevenueQuery->whereDate('don_hang.NgayDatHang','<=',$to);
        if($product) $totalRevenueQuery->where('chi_tiet_don_hang.MaSanPham',$product);

        if($category){
            $totalRevenueQuery->join('san_pham','chi_tiet_don_hang.MaSanPham','=','san_pham.MaSanPham')
                ->where('san_pham.MaDanhMuc',$category);
        }

        $totalRevenue=DB::table(DB::raw("({$ordersSub->toSql()}) as t"))
            ->mergeBindings($ordersSub->getQuery())
            ->select(DB::raw("SUM(GREATEST(subtotal-COALESCE(GiaTriApDung,0),0)) as total"))
            ->value('total')??0;

        // ================= SỐ ĐƠN =================
        $totalRevenueOrdersQuery=DonHang::where('TrangThai',3);
        if($from) $totalRevenueOrdersQuery->whereDate('NgayDatHang','>=',$from);
        if($to) $totalRevenueOrdersQuery->whereDate('NgayDatHang','<=',$to);

        $totalRevenueOrders=$totalRevenueOrdersQuery->count();

        // ================= TRUNG BÌNH =================
        $averageRevenue=$revenueReports->count()>0
            ?$totalRevenue/$revenueReports->count()
            :0;

        $averageOrderValue=$totalRevenueOrders>0
            ?$totalRevenue/$totalRevenueOrders
            :0;

        // ================= TOP SẢN PHẨM =================
        $topProducts=DonHang::join('chi_tiet_don_hang','don_hang.MaDonHang','=','chi_tiet_don_hang.MaDonHang')
            ->join('san_pham','chi_tiet_don_hang.MaSanPham','=','san_pham.MaSanPham')
            ->join('danh_muc','san_pham.MaDanhMuc','=','danh_muc.MaDanhMuc')
            ->select(
                'san_pham.MaSanPham',
                'san_pham.TenSanPham',
                'danh_muc.TenDanhMuc',
                DB::raw('SUM(chi_tiet_don_hang.SoLuong) as tong_ban'),
                DB::raw('SUM(chi_tiet_don_hang.SoLuong*chi_tiet_don_hang.DonGia) as doanh_thu')
            )
            ->where('don_hang.TrangThai',3);

        if($from) $topProducts->whereDate('don_hang.NgayDatHang','>=',$from);
        if($to) $topProducts->whereDate('don_hang.NgayDatHang','<=',$to);
        if($product) $topProducts->where('chi_tiet_don_hang.MaSanPham',$product);
        if($category) $topProducts->where('san_pham.MaDanhMuc',$category);

        $topProducts=$topProducts
            ->groupBy('san_pham.MaSanPham','san_pham.TenSanPham','danh_muc.TenDanhMuc')
            ->orderByDesc('tong_ban')
            ->limit(5)
            ->get();

        return view('admin.reports.index',compact(
            'categories','products','revenueReports','totalRevenue',
            'totalRevenueOrders','averageRevenue','averageOrderValue','topProducts'
        ));
    }
}
        // ================= ORDER REPORTS =================
        $orderReports=DonHang::select(
            DB::raw("DATE_FORMAT(NgayDatHang,'$groupFormat') as ngay"),
            DB::raw('COUNT(*) as so_don'),
            DB::raw("SUM(CASE WHEN TrangThai=0 THEN 1 ELSE 0 END) as cho_xac_nhan"),
            DB::raw("SUM(CASE WHEN TrangThai=1 THEN 1 ELSE 0 END) as da_xac_nhan"),
            DB::raw("SUM(CASE WHEN TrangThai=2 THEN 1 ELSE 0 END) as dang_giao"),
            DB::raw("SUM(CASE WHEN TrangThai=3 THEN 1 ELSE 0 END) as hoan_thanh")
        );

        if($from) $orderReports->whereDate('NgayDatHang','>=',$from);
        if($to) $orderReports->whereDate('NgayDatHang','<=',$to);
        if($status!==null && $status!=='') $orderReports->where('TrangThai',$status);

        $orderReports=$orderReports
            ->groupBy(DB::raw("DATE_FORMAT(NgayDatHang,'$groupFormat')"))
            ->orderBy('ngay')
            ->get();

        // ================= TỔNG ĐƠN =================
        $totalOrdersQuery=DonHang::query();
        if($from) $totalOrdersQuery->whereDate('NgayDatHang','>=',$from);
        if($to) $totalOrdersQuery->whereDate('NgayDatHang','<=',$to);
        if($status!==null && $status!=='') $totalOrdersQuery->where('TrangThai',$status);

        $totalOrders=$totalOrdersQuery->count();


        // ================= ĐƠN HOÀN THÀNH =================
        $completedOrdersQuery=DonHang::where('TrangThai',3);
        if($from) $completedOrdersQuery->whereDate('NgayDatHang','>=',$from);
        if($to) $completedOrdersQuery->whereDate('NgayDatHang','<=',$to);

        $completedOrders=$completedOrdersQuery->count();


        // ================= ĐƠN ĐANG GIAO =================
        $shippingOrdersQuery=DonHang::where('TrangThai',2);
        if($from) $shippingOrdersQuery->whereDate('NgayDatHang','>=',$from);
        if($to) $shippingOrdersQuery->whereDate('NgayDatHang','<=',$to);

        $shippingOrders=$shippingOrdersQuery->count();


        // ================= TỶ LỆ HOÀN THÀNH =================
        $completionRate=$totalOrders>0
            ?round(($completedOrders/$totalOrders)*100,2)
            :0;

        // ================= TRẠNG THÁI ĐƠN =================
        $orderStatusStats=DonHang::select(
                'TrangThai',
                DB::raw('COUNT(*) as tong')
            );

        if($from) $orderStatusStats->whereDate('NgayDatHang','>=',$from);
        if($to) $orderStatusStats->whereDate('NgayDatHang','<=',$to);
        if($status!==null && $status!=='') $orderStatusStats->where('TrangThai',$status);

        $orderStatusStats=$orderStatusStats
            ->groupBy('TrangThai')
            ->get();


        // ================= RETURN VIEW =================
        return view('admin.reports.index',compact(
            'revenueReports',
            'orderReports',
            'products',
            'categories',
            'from','to','product','category','status','type',
            'totalRevenue','averageRevenue','totalRevenueOrders','averageOrderValue','topProducts',
            'totalOrders','completedOrders','shippingOrders','completionRate','orderStatusStats'
        ));