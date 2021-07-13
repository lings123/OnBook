<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;
session_start();

class CartController extends Controller
{
    public function getCart(){
        return view('pages.Cart');
    }
    public function AddCart(Request $request,$idBook){
        $qty=$request->qty;
        if(!$qty){
            $qty=1;
        }
        $book=DB::table('books')->where('idBook',$idBook)->first();
        if($book->sale_price!=0){
            $price=$book->sale_price;
        }
        else{
            $price=$book->unit_price;
        }
       
        if($qty > $book->quantity){
            Session::put('message','Sản phẩm đã hết hoặc bạn chọn vượt quá lượng hàng trong kho.');
            return redirect('/chi-tiet/'.$book->slug_name);
        }
        
        Cart::instance('shopping')->add(['id' => $idBook, 
            'name' => $book->NameBook, 
            'qty' => $qty, 
            'price' => $price, 
            'weight' => $price, 
            'options' => ['image' => $book->hinh_dai_dien, 'slug_name' => $book->slug_name]]);
            return Redirect::back();
    }
    public function DelCart($rowId){
        Cart::instance('shopping')->remove($rowId);
        return Redirect::back();
    }
    public function DelCartAll(){
        Cart::instance('shopping')->destroy();
        return Redirect::back();
    }
    public function UpdateCart($rowId,Request $request){
        $qty=$request->qty;
        if($qty==0){
            Cart::instance('shopping')->remove($rowId);
            return Redirect::back();
        }
        foreach(Cart::instance('shopping')->content() as $cart)
        {
            if($cart->rowId == $rowId)
            {
                $idBook = $cart->id;
            }
        }
        $book=DB::table('books')->where('idBook',$idBook)->first();
        if($qty > $book->quantity){
            Session::put('errors','Sản phẩm đã hết hoặc bạn chọn vượt quá lượng hàng trong kho.');
            return Redirect::back();
        }
        else{
            Cart::update($rowId, $qty);
            return Redirect::back();
        }


    }

}
session_destroy();