<?php

namespace App\Http\Controllers;

use Auth;
use App\Wallet;
use Illuminate\Http\Request;
use App\Http\Requests\WalletControllerAddRequest;

class WalletController extends Controller
{
    //
    public function index(Request $request)
    {
        $limit = $request->get('limit', 10);
        $wallets = Wallet::orderBy('id', 'desc')
            ->paginate($limit);
        return $this->responseSuccess($wallets);
    }

    public function add(WalletControllerAddRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $wallets = Wallet::create($data);
        return $this->responseSuccess($wallets);
    }

    public function detail($id)
    {
        $wallet = Wallet::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$wallet) {
            return $this->responseError('Không tìm thấy ví');
        }

        return $this->responseSuccess($wallet);
    }

    public function delete($id)
    {
        $wallet = Wallet::where('id', $id)
        ->where('user_id', auth()->id())
        ->first();

        if (!$wallet) {
            return $this->responseError('Không tìm thấy ví');
        }

        return $this->responseSuccess($wallet);
    }

}
