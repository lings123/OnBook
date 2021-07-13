<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use File;
use Illuminate\Support\Str;
session_start();

class BlogController extends Controller
{
    public function getAddBlog(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            return view('admin.blog.add_blog');
        }
    }

    public function postAddBlog(Request $request){
        $this->validate($request,[
            "txtName"     => "unique:blog,tieude",
        ],[
            "txtName.unique"       => "Tiêu đề bị trùng",
        ]);

        $data=array();
        $data['tieude']=$request->txtName;
        $data['slug_name']=Str::slug($request->txtName,"-");
        $data['idAd']=Session::get('idAd');
        $data['gioithieu']=$request->txtGioithieu;
        $data['noidung']=$request->txtNoidung;
        $allowed = array('image/jpg','image/png','image/jpeg');
        if($request->hasFile('txtHinh')){
            $hinh      = $request->file('txtHinh');
            $ext_image = $hinh->getClientOriginalExtension();
            $renamed_h = uniqid('_anh',true). "." .$ext_image;
            if(in_array($hinh->getClientMimeType(),$allowed)){
                if($hinh->move('uploaded/blog',$renamed_h)){
                    $data['hinh_dai_dien']  = $renamed_h;
                }
            }
        }
        DB::table('blog')->insert($data);
        Session::put('message',"Thêm blog thành công!");
        return redirect('admin/blog/them');
    }

    public function getListBlog(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $listBlog = DB::table('blog')->get();
            $manager_blog=view('admin.blog.list_blog')
            ->with('listBlog',$listBlog);
            return view('admin.layout.master')
            ->with('admin.blog.list_blog',$manager_blog);
        }
    }

    public function getEditBlog($id_blog){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $blog = DB::table('blog')->where('idBlog',$id_blog)->first();
           
            Session::put('blog',$blog);
           
    
            return view('admin.blog.edit_blog');
        }
    }
    
    public function postEditBlog($id_blog,Request $request){
        $this->validate($request,[
            "txtName"     => 'unique:blog,tieude,'.$id_blog.',idBlog',
        ],[
            "txtName.unique"       => "Tiêu đề bị trùng",
        ]);

        $data=array();
        $data['tieude']=$request->txtName;
        $data['idAd']=Session::get('idAd');
        $data['slug_name']=Str::slug($request->txtName,"-");
        $data['gioithieu']=$request->txtGioithieu;
        $data['noidung']=$request->txtNoidung;
        $allowed = array('image/jpg','image/png','image/jpeg');
        if($request->hasFile('txtHinh')){
            $image =DB::table('blog')->where('idBlog',$id_blog)->first();
            $image_name= $image->hinh_dai_dien;
            $image_path = "uploaded/blog/".$image_name;
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $hinh      = $request->file('txtHinh');
            $ext_image = $hinh->getClientOriginalExtension();
            $renamed_h = uniqid('_anh',true). "." .$ext_image;
            if(in_array($hinh->getClientMimeType(),$allowed)){
                if($hinh->move('uploaded/blog',$renamed_h)){
                    $data['hinh_dai_dien']  = $renamed_h;
                }
            }
        }
        DB::table('blog')->where('idBlog',$id_blog)->update($data);
        DB::table('blog')->where('idBlog',$id_blog)->update(['update_date'=>NOW()]);
           
            Session::put('message',"Sửa thông tin blog thành công!");
        
        
        
        return redirect('admin/blog/sua/'.$id_blog);
    }

    public function getDelBlog($id_blog){
        $blog=DB::table('blog')->where('idBlog',$id_blog)->first();
      
            $image_path = "uploaded/blog/".$blog->hinh_dai_dien;
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            
        DB::table('blog')->where('idBlog',$id_blog)->delete();
        return redirect('admin/blog/danh-sach');
    }
}
session_destroy();