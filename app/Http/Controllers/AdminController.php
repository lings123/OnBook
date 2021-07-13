<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    public function getloginAdmin(){
        return view('admin.login');
    }

    public function dashbroad(Request $request){
        $email=$request->email;
        $password = md5($request->password);

        $result= DB::table('admin')
        ->where('email',$email)->where('password',$password)
        ->first();

        
        if($result){
            Session::put('NameAd', $result->NameAd);
            Session::put('idAd', $result->idAd);
            Session::put('level', $result->level);
            return redirect::to('admin/dashbroad');
        }else{
            return redirect::to('admin')
            ->with('errors',"Email hoặc Password không đúng! Vui lòng kiểm tra lại!");
        }
    }

    public function show_dashbroad(){
        if(Session::get('idAd')==null){
            return redirect::to('admin')
            ->with('errors',"Vui lòng đăng nhập!");
        }
        else{
            $range = \Carbon\Carbon::now()->subMonth(5);
            $billData=DB::table('bills')->select(DB::raw('Month(create_date) as getMonth'), DB::raw('COUNT(*) as value'))
                    ->where('create_date', '>=', $range)
                    ->where('trangthai',3)
                    ->groupBy('getMonth')
                    ->orderBy('getMonth', 'ASC')
                    ->get();
            $billData1=DB::table('bills')->select(DB::raw('Month(create_date) as getMonth'), DB::raw('COUNT(*) as value'))
                    ->where('create_date', '>=', $range)
                    ->where('trangthai',0)
                    ->groupBy('getMonth')
                    ->orderBy('getMonth', 'ASC')
                    ->get();
            $billData2=DB::table('bills')->select(DB::raw('Month(create_date) as getMonth'), DB::raw('COUNT(*) as value'))
                    ->where('create_date', '>=', $range)
                    ->where('trangthai',1)
                    ->groupBy('getMonth')
                    ->orderBy('getMonth', 'ASC')
                    ->get();
            $billData3=DB::table('bills')->select(DB::raw('Month(create_date) as getMonth'), DB::raw('COUNT(*) as value'))
                    ->where('create_date', '>=', $range)
                    ->where('trangthai',2)
                    ->groupBy('getMonth')
                    ->orderBy('getMonth', 'ASC')
                    ->get();
             $billData4=DB::table('bills')->select(DB::raw('Month(create_date) as getMonth'), DB::raw('COUNT(*) as value'))
                    ->where('create_date', '>=', $range)
                    ->where('trangthai',4)
                    ->groupBy('getMonth')
                    ->orderBy('getMonth', 'ASC')
                    ->get();
            $tong=DB::table('bills')->select(DB::raw('Month(create_date) as getMonth'), DB::raw('SUM(totalPrice) as value'))
                    ->where('create_date', '>=', $range)
                    ->where('trangthai',3)
                    ->groupBy('getMonth')
                    ->orderBy('getMonth', 'ASC')
                    ->get()->toArray();
                    $tong = array_column($tong, 'value');
            $tong=json_encode($tong,JSON_NUMERIC_CHECK);
            Session::put('billData',$billData);
            Session::put('billData1',$billData1);
            Session::put('billData2',$billData2);
            Session::put('billData3',$billData3);
            Session::put('billData4',$billData4);
            Session::put('tong',$tong);
            return view('admin.index');
        }
        
    }

    public function AdminLogout(){
        Session::put('NameAd',null);
        Session::put('idAd',null);
        Session::put('level', null);
        return Redirect::to('admin');
    }
}
session_destroy();