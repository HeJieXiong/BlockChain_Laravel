<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Auth;
use App\Model\LoaiMatHang;
use App\Model\MatHang;
use App\Model\HinhAnh;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
	public function index(){
		$return = [];
		
		$loaimathangs = LoaiMatHang::take(6)->get();
					$_mathangs = [];
			$hinhanhs =[];
		foreach($loaimathangs as $index => $loaimathang){
			$_mathang = [];
			$hinhanh =[];
			$_mathang = MatHang::where('idLoaiMatHang',$loaimathang->id)->first();
			$hinhanh = HinhAnh::where([['idContainer',$_mathang['id']],['type','mathang']])->first();
			$hinhanhs[] = $hinhanh;
			$loaimathangs[$index]['hinhAnh']  = $hinhanh['URL'];
			
		}
		$return['loaiMatHangs'] = $loaimathangs;
		
		$mathangs = MatHang::take(10)->get();
		foreach($mathangs as $index=>$mathang){
			$hinhanh =[];
			$hinhanh = HinhAnh::where([['idContainer',$mathang['id']],['type','mathang']])->first();
			$mathangs[$index]['HinhAnh'] = $hinhanh['URL'];
		}
		
		$return['mathangs'] = $mathangs;
		
		return response($return, 200);
	}
}
