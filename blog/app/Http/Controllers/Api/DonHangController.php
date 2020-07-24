<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use Illuminate\Support\MessageBag;
use App\User;
use App\DonHang;
use App\ChiTietDonHang;
use App\Model\MatHang;



class DonHangController extends Controller
{
	public function store2(Request $request)
    {
		$response['status'] = 1;
	
			$userInfo = $request->input('userInfo');
			$cart = $request->input('cart');
			$donhang = new DonHang;
			
				
			$TongTien = $request->input('tongTien');
			$VAT = 0;
			$PhiVanChuyen = 0;
			$TrangThai = "DANGXULY";
			
			$donhang->NgayDatHang = date("Y-m-d H:i:s");
			$donhang->NgayGiaoHang = date("Y-m-d H:i:s", strtotime('+ 2 days'));
			$donhang->idNguoiDung = -1;
			$donhang->HoVaTen = $userInfo["HoTen"];
			$donhang->Email = $userInfo["Email"];
			$donhang->DiaChi = $userInfo["DiaChi"];
			$donhang->SoDienThoai = $userInfo["SoDienThoai"];
			$donhang->TongTien = $TongTien;
			$donhang->VAT = $VAT;
			$donhang->PhiVanChuyen = $PhiVanChuyen;
			$donhang->TrangThai = $TrangThai;
			$donhang->save();
			
			
			foreach($cart as $matHang){
				$ChiTietDonHang = new ChiTietDonHang;
				$ChiTietDonHang->idDonHang = $donhang->id;
				$ChiTietDonHang->idMatHang = $matHang["id"];
				$ChiTietDonHang->SoLuong = 1;
				$ChiTietDonHang->save();
			}
		

		return response($response, 200);
    }
	
	public function store1(Request $request)
    {
		$response['status'] = 1;
	
			$userInfo = $request->user();
			$cart = $request->input('cart');
			$donhang = new DonHang;
			
				
			$TongTien = $request->input('tongTien');
			$VAT = 0;
			$PhiVanChuyen = 0;
			$TrangThai = "DANGXULY";
			
			$donhang->NgayDatHang = date("Y-m-d H:i:s");
			$donhang->NgayGiaoHang = date("Y-m-d H:i:s", strtotime('+ 2 days'));
			$donhang->idNguoiDung = $userInfo['id'];
			$donhang->HoVaTen = $userInfo['HoVaTen'];
			$donhang->Email = $userInfo['email'];
			$donhang->DiaChi = $userInfo['DiaChi'];
			$donhang->SoDienThoai = $userInfo['SoDienThoai'];
			$donhang->TongTien = $TongTien;
			$donhang->VAT = $VAT;
			$donhang->PhiVanChuyen = $PhiVanChuyen;
			$donhang->TrangThai = $TrangThai;
			$donhang->save();
			
			
			foreach($cart as $matHang){
				$ChiTietDonHang = new ChiTietDonHang;
				$ChiTietDonHang->idDonHang = $donhang->id;
				$ChiTietDonHang->idMatHang = $matHang["id"];
				$ChiTietDonHang->SoLuong = 1;
				$ChiTietDonHang->save();
			}
		return response($response, 200);
    }
	
	public function get(Request $request){
		$userInfo = $request->user();
		$donhangs = DonHang::where('idNguoiDung', $userInfo['id'])->get();
		return response($donhangs);
	}
}
