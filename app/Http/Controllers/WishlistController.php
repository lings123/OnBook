<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;
session_start();

class WishlistController extends Controller
{
    public function getWishlist(){
        return view('pages.wishlist');
    }
    public function AddWishlist($idBook){
        $idUser=Session::get('user');
        
       if(!$idUser){
        return Redirect::back();
       }
       else{
        $user=DB::table('users')->where('id',$idUser->id)->first();
        $Book=DB::table('books')->where('idBook',$idBook)->first();
        if($Book->sale_price!=0){
            $price=$Book->sale_price;
        }
        else{
            $price=$Book->unit_price;
        }
        Cart::instance('wishlist')->add(['id' => $idBook, 
        'name' => $Book->NameBook, 
        'price' =>$price,
        'qty' =>$Book->quantity,
       'weight' =>$price,
        'options' => ['image' => $Book->hinh_dai_dien,  'id_user' =>$user->id,'slug_name' => $Book->slug_name]]);
        return Redirect::back();
       }
       
    }

    public function DelWishlist($rowId){
        Cart::instance('wishlist')->remove($rowId);
        return Redirect::back();
    }

    
}
session_destroy();