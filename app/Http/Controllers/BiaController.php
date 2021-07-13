<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
session_start();


class BiaController extends Controller
{
    public function getAddBia(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            return view('admin.bia.add_bia');
        }
       
    }

    public function postAddBia(Request $request){
        $data=array();
        $data['nameBia']=$request->txtBiaName;
        $data['mota_bia']=$request->txtDescription;

        DB::table('bia')->insert($data);
        Session::put('message',"Thêm bìa thành công!");
        return redirect::to('admin/bia/them');
    }

    public function getListBia(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $listBia = DB::table('bia')->get();
            $manager_bia=view('admin.bia.list_bia')
            ->with('listBia',$listBia);
            return view('admin.layout.master')
            ->with('admin.bia.list_bia',$manager_bia);
        }
       
    }

    public function geteditBia($id_Bia){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $bia=DB::table('bia')->where('idBia',$id_Bia)->first();
            Session::put('bia',$bia);
    
            return view('admin.bia.edit_bia');
        }
       
    }

    public function posteditBia($id_Bia, Request $request){
        $data=array();
        $data['nameBia']=$request->txtBiaName;
        $data['mota_bia']=$request->txtDescription;

        DB::table('bia')->where('idBia',$id_Bia)->update($data);
        DB::table('bia')->where('idBia',$id_Bia)->update(['update_date'=>NOW()]);
        Session::put('message',"Sửa thông tin bìa thành công!");
        return redirect::to('admin/bia/sua/'.$id_Bia);
    }

    public function getDelBia($id_Bia){
        $books=DB::table('books')->where('idBia',$id_Bia)->get();
        if($books->count()>0){
           
            return redirect('admin/bia/danh-sach');
        }
        else{
            DB::table('bia')->where('idBia',$id_Bia)->delete();
            return redirect('admin/bia/danh-sach');
        }
    }
}
session_destroy();