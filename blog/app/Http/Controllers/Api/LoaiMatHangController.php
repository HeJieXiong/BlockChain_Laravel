<?php

namespace App\Http\Controllers\Api;
use App\User;
use Auth;
use Validator;
use Illuminate\Http\Request;

use App\Model\LoaiMatHang;
use App\Model\MatHang;
use App\Model\HinhAnh;
use App\Http\Controllers\Controller;

class LoaiMatHangController extends Controller
{
    //
	// public function get_all (Request $request) {
		// $response = $request->user();
		// return response($response, 200);
	// }
	public function index() {
		$return = [];
		$loaimathangs = LoaiMatHang::all();
		foreach($loaimathangs as $index => $loaimathang){
			$_mathang = [];
			$hinhanh =[];
			$_mathang = MatHang::where('idLoaiMatHang',$loaimathang->id)->first();
			$hinhanh = HinhAnh::where([['idContainer',$_mathang['id']],['type','mathang']])->first();
			$loaimathangs[$index]['hinhAnh']  = $hinhanh['URL'];
		}
		$return = $loaimathangs;
		return response($return, 200);
	}
}
