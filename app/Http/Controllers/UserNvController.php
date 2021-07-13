<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Validation\Validator;
session_start();

class UserNvController extends Controller
{
    public function getAddUserNv(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            return view('admin.userNV.add_nv');
        }
       
    }

    public function postAddUserNv(Request $request){
        $this->validate($request,[
    		'txtEmail' => 'unique:admin,email',
            'txtName'       =>'regex:/^[\p{L}\s-]+$/u',
            /*
                Should have At least one Uppercase letter.
                At least one Lower case letter.
                Also,At least one numeric value.
                And, At least one special character.
                Must be more than 6 characters long.
            */
            'txtPass'        => "min:6",
            'txtPhone'       => "phone:AUTO,VN|unique:admin,phone",
    	],[
    		"txtEmail.unique"          => "Email đã tồn tại",
            "txtPhone.unique"          => "Phone đã tồn tại",
            'txtName.regex'            => "Tên không có số",
            "txtPass.min"              =>"Password phải có phải nhiều hơn 6 ký tự",
            "txtPhone.phone"          =>"Không đúng định dạng điện thoại"
    	]);

        $data=array();
        $data['NameAd']=$request->txtName;
        $data['email']=$request->txtEmail;
        $data['password']=md5($request->txtPass);
        $data['gioitinh']=$request->gioitinh;
        $data['level']=$request->chucvu;
        $data['phone']=preg_replace('[^0-9]', '',phone($request->txtPhone ,'VN')->formatNational());

        $mailData = [
            'title' => 'Welcome '.$request->txtName.' gia nhập đội ngũ của OnBook. ',
            'content' => 'Chúng tôi đã cấp cho bạn một tài khoản để phục vụ công việc.',
            'email' => 'Email : ' .$request->txtEmail,
            'password' => 'Password : ' .$request->txtPass,
        ];
        \Mail::to($request->txtEmail)->send(new \App\Mail\welcomeNhanVien($mailData));
        DB::table('admin')->insert($data);
        Session::put('message',"Thêm nhân viên thành công!");

        return redirect::to('admin/nhan-vien/them');
    }

    public function getListUserNv(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $listNV = DB::table('admin')->where('level',1)->get();
            $listNVGH = DB::table('admin')->where('level',3)->get();
            Session::put('giaohang',$listNVGH);
        $manager_userNV=view('admin.userNV.list_nv')
        ->with('listNV',$listNV);
        return view('admin.layout.master')
        ->with('admin.userNV.list_nv',$manager_userNV);
        }
       
    }

    public function getEditUserNv($id_nv){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $nv=DB::table('admin')->where('idAd',$id_nv)->first();
            Session::put('nv',$nv);
    
            return view('admin.userNV.edit_nv');
        }
       
    }

    public function postEditUserNv($id_nv, Request $request){
        $this->validate($request,[
    		'txtEmail' => 'unique:admin,email,'.$id_nv.',idAd',
            'txtName'       =>'regex:/^[\p{L}\s-]+$/u',
            'txtPhone'       => 'phone:AUTO,VN|unique:admin,phone,'.$id_nv.',idAd',
    	],[
    		"txtEmail.unique"         => "Email đã tồn tại",
            "txtPhone.unique"          => "Phone đã tồn tại",
            'txtName.regex'         => "Tên không có số",
            "txtPhone.phone"          =>"Không đúng định dạng điện thoại"
    	]);
       
        $data=array();
        $data['NameAd']=$request->txtName;
        $data['email']=$request->txtEmail;
        $data['gioitinh']=$request->gioitinh;
        $data['level']=$request->chucvu;
        $data['phone']=preg_replace('[^0-9]', '',phone($request->txtPhone ,'VN')->formatNational());

        DB::table('admin')->where('idAd',$id_nv)->update($data);
        DB::table('admin')->where('idAd',$id_nv)->update(['update_date'=>NOW()]);
        Session::put('message',"Sửa thông tin nhân viên thành công!");
        return redirect::to('admin/nhan-vien/sua/'.$id_nv);
    }

    public function getDelUserNv($id_nv){
        DB::table('admin')->where('idAd',$id_nv)->delete();

        return redirect('admin/nhan-vien/danh-sach');
    }

    public function postMkUserNv($id_nv){
        $nv=DB::table('admin')->where('idAd',$id_nv)->first();
        
        $pass=Rand(1,123456);
        
        $mailData = [
            'title' => 'Yêu cầu thay đổi mật khẩu thành công',
            'content' => 'Mật khẩu mới của bạn là '.$pass,
            'email' => 'Bạn vui lòng đăng nhập là đổi lại mật khẩu',
            'password' => '',
        ];
        \Mail::to($nv->email)->send(new \App\Mail\welcomeNhanVien($mailData));
        DB::table('admin')->where('idAd',$id_nv)->update(['password'=>md5($pass),'update_date'=>NOW()]);
        return redirect('admin/nhan-vien/danh-sach');
    }
}
session_destroy();