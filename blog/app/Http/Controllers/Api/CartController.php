<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\MatHang;
use App\Model\HinhAnh;
use App\Model\Cart;
use App\User;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index($id){
		$return = [];
		$cart = [];
		$carts = Cart::where([['idNguoiDung','=',$id]])->get();
		foreach ($carts as $cart){
			$matHang = MatHang::where('id','=',$cart->idMatHang)->first();	
			$cart['TenMatHang']=$matHang->TenMatHang;
			$cart['DonGia']=$matHang->Gia;
		}
		
		
		for($i=0; $i< count($carts)-1; $i++ ){
			$SoLuong=1;
		
			for ($u=$i+1; $u< count($carts);$u++){
				if($carts[$i]->idMatHang==$carts[$u]->idMatHang){
					$SoLuong ++;
					unset($carts[$u]);
				}
			}
		
			
			$carts[$i]['SoLuong']=$SoLuong;
			$carts[$i]['ThanhTien']=$SoLuong *$cart['DonGia'];
		}		
		$return['carts'] = $carts;
		
		return response($return, 200);
	}
}
