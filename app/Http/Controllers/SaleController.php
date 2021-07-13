<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
session_start();

class SaleController extends Controller
{
    public function getAddSales(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            return view('admin.sale.add_sale');
        }
       
    }

    public function postAddSales(Request $request){
        $data=array();
        $data['nameSale']=$request->txtSaleName;
        $data['phantram']=$request->Phantram;
        $data['active']=$request->status;
        $data['mota'] = $request->txtDescription;
        $data['solan'] = $request->txtSolan;

        DB::table('sale')->insert($data);
        Session::put('message',"Thêm khuyến mãi thành công!");
        return redirect::to('admin/khuyen-mai/them');

    }

    public function getListSales(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $listSale = DB::table('sale')->get();
        $manager_sale=view('admin.sale.list_sale')
        ->with('listSale',$listSale);
        return view('admin.layout.master')
        ->with('admin.sale.list_sale',$manager_sale);
        }
        
    }

    public function getEditSales($id_Sale){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $sale=DB::table('sale')->where('idSale',$id_Sale)->first();
            Session::put('sale',$sale);
    
            return view('admin.sale.edit_sale');
        }
       
    }

    public function postEditSales($id_Sale,Request $request){
        $data=array();
        $data['nameSale']=$request->txtSaleName;
        $data['phantram']=$request->Phantram;
        $data['active']=$request->status;
        $data['mota'] = $request->txtDescription;
        $data['solan'] = $request->txtSolan;
        
        DB::table('sale')->where('idSale',$id_Sale)->update($data);
        DB::table('sale')->where('idSale',$id_Sale)->update(['update_date'=>NOW()]);
        Session::put('message',"Sửa khuyến mãi thành công!");
        return redirect::to('admin/khuyen-mai/sua/'.$id_Sale);
    }

    public function getDelSales($id_Sale){
        DB::table('sale')->where('idSale',$id_Sale)->delete();
        return redirect('admin/khuyen-mai/danh-sach');
    }

    public function postTTSale($id_Sale,Request $request){
        DB::table('sale')->where('idSale',$id_Sale)->update(['active'=>$request->trangthai,'update_date'=>NOW()]);

        return redirect('admin/khuyen-mai/danh-sach');
    }
}
session_destroy();