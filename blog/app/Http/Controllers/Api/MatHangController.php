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

class MatHangController extends Controller
{
    //
	// public function get_all (Request $request) {
		// $response = $request->user();
		// return response($response, 200);
	// }
	public function get_all_of_type($id) {
		$return = [];
		$mathangs = MatHang::where('idLoaiMatHang', $id)->get();
		foreach($mathangs as $index=>$mathang){
		
			$hinhanh = HinhAnh::where([['idContainer',$mathang['id']],['type','mathang']])->first();
			$mathangs[$index]['HinhAnh'] = $hinhanh['URL'];
		}
		$return['mathang'] = $mathangs;
		return response($return, 200);
	}
	
	public function get_item_data($id) {
		$return = [];
		$mathang = MatHang::where('id', $id)->first	();
		$hinhanhs = HinhAnh::select('url')->where([['idContainer',$mathang->id],['type','mathang']])->get();
		
		$return['data'] = $mathang;
		$return['images'] = $hinhanhs;
		return response($return, 200);
	}
	public function search($searchWord) {
		$return = [];
		$mathangs = MatHang::where('TenMatHang','like','%'.$searchWord.'%')->get();
		foreach($mathangs as $index=>$mathang){
			$hinhanh = HinhAnh::where([['idContainer','=',$mathang->id],['type','=','mathang']])->first();
			$mathangs[$index]['HinhAnh'] = $hinhanh['URL'];
		}
        $return['mathang'] = $mathangs;
		return response($return, 200);
	}
}
