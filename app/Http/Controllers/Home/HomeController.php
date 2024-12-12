<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $sliders = Banner::where('type','slider')->where('is_active',1)->orderBy('priority')->get();
        $indexTopBanners= Banner::where('type','index-top')->where('is_active',1)->orderBy('priority')->get();
        $indexButtBanners = Banner::where('type','index-button')->where('is_active',1)->orderBy('priority')->get();
        $products = Product::where('is_active',1)->get();

        // $product = Product::find(3);
        // dd($product->sale_check);
        return view('home.index', compact('sliders','indexTopBanners','indexButtBanners','products'));
    }
}
