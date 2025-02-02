<?php

namespace App\Http\Controllers;
use App\Models\Item; // ここでItemモデルをインポート

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Itemモデルを使って製品情報を取得
        $items = Item::all();

        // ビューに渡す
        return view('home', compact('items'));
        }
}
