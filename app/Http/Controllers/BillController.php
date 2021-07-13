<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
session_start();

class BillController extends Controller
{
    public function getListBill(Request $request){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $dangxuly=DB::table('bills')->where('trangthai',0)->get();
            $daxuly=DB::table('bills')->where('trangthai',1)->get();
            $danggiaohang=DB::table('bills')->where('trangthai',2)->get();
            $thanhcong=DB::table('bills')->where('trangthai',3)->get();
            $huy=DB::table('bills')->where('trangthai',4)->get();
            Session::put('dangxuly',$dangxuly);
            Session::put('daxuly',$daxuly);
            Session::put('danggiaohang',$danggiaohang);
            Session::put('thanhcong',$thanhcong);
            
            Session::put('huy',$huy);
            
            if($request->orderbytt){
               
                $sort=$request->orderbytt;
                if($sort=="md"){
                    $listBill = DB::table('bills')->get();
                    Session::put('sort',$sort);
                }
                if($sort=="1"){
                    $listBill = DB::table('bills')->where('trangthai',0)->get();
                    Session::put('sort',$sort);
                }
                if($sort=="2"){
                    $listBill = DB::table('bills')->where('trangthai',1)->get();
                    Session::put('sort',$sort);
                }
                if($sort=="3"){
                    $listBill = DB::table('bills')->where('trangthai',2)->get();
                    Session::put('sort',$sort);
                }
                if($sort=="4"){
                    $listBill = DB::table('bills')->where('trangthai',3)->get();
                    Session::put('sort',$sort);
                }
                if($sort=="5"){
                    $listBill = DB::table('bills')->where('trangthai',4)->get();
                    Session::put('sort',$sort);
                }
            }
            else{
                $listBill = DB::table('bills')->get();
            }
            
          
        $manager_bill=view('admin.bill.list_bill')
        ->with('listBill',$listBill);
        return view('admin.layout.master')->with('admin.bill.list_bill',$manager_bill);
        }
        
    }

    public function getDetailBill($id_bill){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $Detail = DB::table('detailbill')->where('idBill',$id_bill)->get();
        $Bill=DB::table('bills')->where('idBill',$id_bill)->first();
        Session::put('bill',$Bill);
        
        $manager_detail=view('admin.bill.detail_bill')
        ->with('Detail',$Detail);
        return view('admin.layout.master')
        ->with('admin.bill.detail_bill',$manager_detail);
        }
        
    }

    public function postTTBill($id_bill,Request $request){
        $trangthai=$request->trangthai;
        
        DB::table('bills')->where('idBill',$id_bill)->update(['trangthai'=>$trangthai,'update_date'=>NOW()]);
        if($trangthai==4){
            $bills=DB::table('detailbill')->where('idBill',$id_bill)->get();
            foreach($bills as $bill){
                $book=DB::table('books')->where('idBook',$bill->idBook)->first();
                $qty=$bill->quantity+$book->quantity;
                DB::table('books')->where('idBook',$bill->idBook)->update(['quantity'=>$qty,'update_date'=>NOW()]);
            }
        }
        
        return redirect::back();
    }

    public function getDelBill($id_bill){
        DB::table('detailbill')->where('idBill',$id_bill)->delete();
        DB::table('bills')->where('idBill',$id_bill)->delete();

        return redirect::back();
    }

    public function postGHBill(Request $request, $id_bill){
        $idAd=$request->nv;
        DB::table('bills')->where('idBill', $id_bill)->update(['idAd'=>$idAd,'update_date'=>NOW()]);
       
        return redirect::back();
    }

    public function getListBillGH($idAd){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $thanhcong=DB::table('bills')->where('idAd',$idAd)->where('trangthai',3)->get();
            $huy=DB::table('bills')->where('idAd',$idAd)->where('trangthai',4)->get();

            Session::put('thanhcong',$thanhcong);
            Session::put('huy',$huy);
            
            
                $listBill = DB::table('bills')->where('idAd',$idAd)->get();
            
           
                $manager_detail=view('admin.bill.list_bill_gh')
                ->with('listBill',$listBill);
                return view('admin.layout.master')
                ->with('admin.bill.list_bill_gh',$manager_detail);
        }
    }
}

session_destroy();
