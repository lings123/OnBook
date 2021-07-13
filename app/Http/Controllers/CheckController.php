<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
session_start();

class CheckController extends Controller
{
   public function getAddCheck(){
    if(Session::get('idAd')==null){
        return redirect::to('admin')
        ->with('errors',"Vui lòng đăng nhập!");
    }
    else{
        return view('admin.thanhtoan.add_check');
    }
      
   }

   public function postAddCheck(Request $request){
       $data=array();
       $data['nameCheck']=$request->txtCheckName;
       $data['noidung']=$request->txtDescription;

       DB::table('thanhtoan')->insert($data);
        Session::put('message',"Thêm hình thức thanh tóa thành công!");
        return redirect::to('admin/thanh-toan/them');
   }

   public function getListCheck(){
    if(Session::get('idAd')==null){
        return redirect::to('admin')
        ->with('errors',"Vui lòng đăng nhập!");
    }
    else{
        $listCheck = DB::table('thanhtoan')->get();
    $manager_thanhtoan=view('admin.thanhtoan.list_check')
    ->with('listCheck',$listCheck);
    return view('admin.layout.master')
    ->with('admin.thanhtoan.list_check',$manager_thanhtoan);
    }
    
   }

   public function geteditCheck($id_check){
    if(Session::get('idAd')==null){
        return redirect::to('admin')
        ->with('errors',"Vui lòng đăng nhập!");
    }
    else{
        $Check=DB::table('thanhtoan')->where('idCheck',$id_check)->first();
        Session::put('Check',$Check);
        return view('admin.thanhtoan.edit_check');
    }
        
   }

   public function posteditCheck($id_check,Request $request){
    $data=array();
    $data['nameCheck']=$request->txtCheckName;
    $data['noidung']=$request->txtDescription;

    DB::table('thanhtoan')->where('idCheck',$id_check)->update($data);
    DB::table('thanhtoan')->where('idCheck',$id_check)->update(['update_date'=>NOW()]);
    Session::put('message',"Sửa hình thức thanh toán thành công!");
    return redirect::to('admin/thanh-toan/sua/'.$id_check);
   }

   public function getDelCheck($id_check){
       $bills=DB::table('bills')->where('idCheck',$id_check)->get();
       if($bills->count()>0){
        return redirect('admin/thanh-toan/danh-sach');
       }
       else{
            DB::table('thanhtoan')->where('idCheck',$id_check)->delete();
            return redirect('admin/thanh-toan/danh-sach');
       }
     
     
   }
}
session_destroy();