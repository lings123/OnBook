<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
session_start();

class CategoryController extends Controller
{
    public function getAddCate(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            return view('admin.Category.add_cate');
        }
       
    }

    public function postAddCate(Request $request){
        $data = array();
        $data['nameCate'] = $request->txtCateName;
        $data['status'] = $request->status;

        DB::table('category')->insert($data);
        Session::put('message',"Thêm danh mục thành công!");
        return redirect::to('admin/danh-muc/them');
    }

    public function getListCate(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $listCate = DB::table('category')->get();
        $manager_category=view('admin.Category.list_cate')
        ->with('listCate',$listCate);
        return view('admin.layout.master')
        ->with('admin.Category.list_cate',$manager_category);
        }
       
    }
      
    public function getEditCate($id_Cate){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $item = DB::table('category')->where('idCate',$id_Cate)->first();
    
        Session::put('item',$item);
        return view('admin.category.edit_cate');
        }
        
    }

    public function postEditCate($id_Cate,Request $request){
        $data = array();
        $data['nameCate'] = $request->txtCateName;
        $data['status'] = $request->status;

        DB::table('category')->where('idCate',$id_Cate)->update($data);
        DB::table('category')->where('idCate',$id_Cate)->update(['update_date'=>NOW()]);
        Session::put('message',"Sửa danh mục thành công!");
        return redirect::to('admin/danh-muc/sua/'.$id_Cate);
    }

    public function getDelCate($id_Cate){
        $type=DB::table('type')->where('idCate',$id_Cate)->get();
        if( $type->count()>0){
            return redirect('admin/danh-muc/danh-sach');
        }
        else{
            DB::table('category')->where('idCate',$id_Cate)->delete();
            return redirect('admin/danh-muc/danh-sach');
        }
        
        
    }

    public function postTTCate($id_Cate,Request $request){
        DB::table('category')->where('idCate',$id_Cate)->update(['status'=>$request->trangthai,'update_date'=>NOW()]);

        return redirect('admin/danh-muc/danh-sach');
    }
}
session_destroy();