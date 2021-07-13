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

class SliderController extends Controller
{
    public function getAddSlider(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            return view('admin.silder.add_slider');
        }
       
    }  
    
    public function postAddSlider(Request $request){
        $this->validate($request,[
            "txtHinh"     => "required|image",
        ],[
            "txtName.unique"       => "Tên sản phẩm bị trùng",
            "txtHinh.image"        => "Bạn cần chọn hình ảnh",
        ]);
        $data=array();
        $data['mota']=$request->txtDescription;
        $allowed = array('image/jpg','image/png','image/jpeg');
        if($request->hasFile('txtHinh')){
            $hinh      = $request->file('txtHinh');
            $ext_image = $hinh->getClientOriginalExtension();
            $renamed_h = uniqid('_anh',true). "." .$ext_image;
            if(in_array($hinh->getClientMimeType(),$allowed)){
                if($hinh->move('uploaded/slider',$renamed_h)){
                    $data['nameSlider']  = $renamed_h;
                }
            }
        }

        DB::table('slider')->insert($data);
        Session::put('message',"Thêm slider thành công!");
        return redirect('admin/slider/them');
    }

    public function getListSlider(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $Sliders = DB::table('slider')->get();
        $manager_slider=view('admin.silder.list_slider')
        ->with('Sliders',$Sliders);
        return view('admin.layout.master')
        ->with('admin.silder.list_slider',$manager_slider);
        }
       
    }

    public function getEditSlider($id_slider){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $slider=DB::table('slider')->where('idSlider',$id_slider)->first();
        Session::put('slider',$slider);

        return view('admin.silder.edit_image');
        }
        
    }

    public function postEditSlider($id_slider,Request $request){
        $this->validate($request,[
            "txtHinh"     => "image",
         ],[
            "txtHinh.image"        => "Bạn cần chọn hình ảnh",
        ]);
       
        $allowed = array('image/jpg','image/png','image/jpeg');
        if($request->hasFile('txtHinh')){
            $image =DB::table('slider')->where('idSlider',$id_slider)->first();
            $image_name= $image->nameSlider;
                $image_path = "uploaded/slider/".$image_name;
                if(File::exists($image_path)){
                    File::delete($image_path);
            }
            $hinh      = $request->file('txtHinh');
            $ext_image = $hinh->getClientOriginalExtension();
            $renamed_h = uniqid('_anh',true). "." .$ext_image;
            if(in_array($hinh->getClientMimeType(),$allowed)){
                if($hinh->move('uploaded/slider',$renamed_h)){
                    $data  = $renamed_h;
                }
            }
        }

        DB::table('slider')->where('idSlider',$id_slider)->update(['nameSlider'=>$data,'update_date'=>NOW()]);
        Session::put('message',"Sửa slider thành công!");

        return redirect('admin/slider/sua/'.$id_slider);
    }

    public function getDelSlider($id_slider){
        $image =DB::table('slider')->where('idSlider',$id_slider)->first();
        $image_name= $image->nameSlider;
        $image_path = "uploaded/slider/".$image_name;
        if(File::exists($image_path)){
            File::delete($image_path);
        }
        DB::table('slider')->where('idSlider',$id_slider)->delete();

        return redirect('admin/slider/danh-sach');
    }
}
session_destroy();