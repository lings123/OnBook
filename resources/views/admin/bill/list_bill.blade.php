@extends('admin.layout.master')
@section('content')
<style>

div.dt-searchPane div.dataTables_length{
        float: none;
        text-align: center;
    }
</style>
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Đơn hàng
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <?php $dangxuly=Session::get('dangxuly');
                          $daxuly=Session::get('daxuly');
                          $danggiaohang=Session::get('danggiaohang');
                          $thanhcong=Session::get('thanhcong');
                          $huy=Session::get('huy');
                          $sort= Session::get('sort');
		                    Session::put('sort',"0");
                    ?>
                    <h3>
                        
                            <small>Số đơn hàng đang xử lý : {{$dangxuly->count()}}</small><br/>
                            <small>Số đơn hàng đã xử lý : {{$daxuly->count()}}</small><br/>
                            <small>Số đơn hàng đang giao hàng : {{$danggiaohang->count()}}</small><br/>
                            <small>Số đơn hàng giao thành công : {{$thanhcong->count()}}</small><br/>
                            <small>Số đơn hàng đã hủy : {{$huy->count()}}</small>
                        
                    </h3>
                    <hr/>
                    <!-- /.col-lg-12 -->
                    <table border="0" class="display nowrap"  cellspacing="5" cellpadding="5">
                        <tbody><tr>
                            <td>Tổng đơn hàng từ :</td>
                            <td ><input style="width: 50px;" type="text" id="min" name="min" >,000 VND</td>
                        </tr>
                        <tr>
                            <td>Tổng đơn hàng đến:</td>
                            <td><input style="width: 50px;" type="text" id="max" name="max">,000 VND</td>
                        </tr>
                    </tbody></table><hr/>
                    <table border="0" class="display nowrap"  cellspacing="5" cellpadding="5">
                        <tbody><tr>
                            <td>Từ ngày :</td>
                            <td ><input type="date" id="start_date" name="start_date" max="NOW()" ></td>
                        </tr>
                        <tr>
                            <td>Đến ngày :</td>
                            <td><input type="date" id="end_date" name="end_date"  max="NOW()" ></td>
                        </tr>
                    </tbody></table><hr/>
                    <form id="form_sort" method="GET" style="float: right">
                        <div class="orderby__wrapper">
                            <span>Sắp xếp đơn hàng: </span>
                            <select class="shot__byselect orderbytt" name="orderbytt">
                                <option value="md" @if(isset($sort)&&$sort=="md") selected="selected" @endif>Mặc định</option>
                                <option value="1" @if(isset($sort)&&$sort=="1") selected="selected" @endif>Chưa xử lý</option>
                                <option value="2" @if(isset($sort)&&$sort=="2") selected="selected" @endif>Đã xử lý</option>
                                <option value="3" @if(isset($sort)&&$sort=="3") selected="selected" @endif>Đang giao hàng</option>
                                <option value="4" @if(isset($sort)&&$sort=="4") selected="selected" @endif>Giao hàng thành công</option>
                                <option value="5" @if(isset($sort)&&$sort=="5") selected="selected" @endif>Đã hủy</option>
                            </select>
                        </div>
                        </form>
                    <br/>
                <hr/>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Họ tên khách hàng</th>
                                <th>Email</th>
                                <th>Ngày mua</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Chi tiết</th>
                                @if(Session::get('level')==1)<th>Delete</th>@endif
                            </tr>
                        </thead>
                        <tbody>
                         
                            @foreach($listBill as $bill)
                            <tr class="odd gradeX" align="center">
                                <td>{{$bill->idBill}}</td>
                                
                                <td>{{$bill->nameKH}}</td>
                                <td>{{$bill->email}}</td>
                                <td>
                              
                                    {{ \Carbon\Carbon::parse($bill->create_date)->format('Y/m/d H:i:s')}}</td>
                                <td>
                                   {{number_format($bill->totalPrice)}}
                                </td>
                                
                                <form action="{{URL::to('admin/don-hang/sua/'.$bill->idBill)}}" method="POST">
                                <td>
                                    
                                        <div class="form-group">
                                            <select class="form-control" name="trangthai">
                                                <option value="0" @if($bill->trangthai==0) selected @endif>Chưa xử lý</option>
                                                <option value="1" @if($bill->trangthai==1) selected @endif>Đã xử lý</option>
                                                <option value="2" @if($bill->trangthai==2) selected @endif>Đang giao hàng</option>
                                                <option value="3" @if($bill->trangthai==3) selected @endif>Giao hàng thành công</option>
                                                <option value="4" @if($bill->trangthai==4) selected @endif>Hủy đơn hàng</option>
                                        </div>
                                        {{csrf_field()}}
                                        <br/>
                                        @if(Session::get('level')==1)<button type="submit" class="btn btn-default">Cập nhật</button>@endif
                                </form>
                                @if($bill->trangthai==1) 
                                <form action="{{URL::to('admin/don-hang/dieu-hang/'.$bill->idBill)}}" method="POST">
                                    <h5>Điều nhân viên giao hàng</h5>
                                    <div class="form-group">
                                        <select class="form-control" name="nv">
                                            <?php $nvgh=DB::table('admin')->where('level',3)->get(); ?>
                                            @foreach($nvgh as $nv)
                                                <option @if($bill->idAd) value="{{$bill->idAd}}" @else value="{{$nv->idAd}}" @endif>
                                                    @if($bill->idAd)
                                                    <?php $GH=DB::table('admin')->where('idAd',$bill->idAd)->first(); ?>
                                                    {{$GH->NameAd}}
                                                    @else
                                                    {{$nv->NameAd}}
                                                    @endif
                                                </option>
                                            @endforeach
                                    </div>
                                    {{csrf_field()}}
                                    <br/>
                                    @if(Session::get('level')==1 )<button type="submit" class="btn btn-default">Điều hàng</button>@endif
                            </form>
                            @endif
                            </td>
                            <td class="center"><i class="fa fa-search fa-fw"></i> <a href="{{URL::to('admin/don-hang/chi-tiet/'.$bill->idBill)}}">Chi Tiết</a></td>
                                @if(Session::get('level')==1)   
                                <td class="center">
                                    <i class="fa fa-trash-o fa-fw "></i>
                                    <a href="{{URL::to('admin/don-hang/xoa/'.$bill->idBill)}}" class='btn-del'> Xoá</a>
                                </td>
                                @endif
                            </tr>
                          
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection
@section('script')
<script type="text/javascript">


$(function(){
	
	$('.orderbytt').on('change', function() {
		$("#form_sort").submit();
		
	});
	
});
	


   $.fn.dataTable.ext.search.push(
    function timgia( settings, data, dataIndex ) {
        var min = parseInt( $('#min').val());
        var max = parseInt( $('#max').val());
        var age = parseFloat( data[4]) || 0; // use data for the age column
 
        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && age <= max ) ||
             ( min <= age   && isNaN( max ) ) ||
             ( min <= age   && age <= max ) )
        {
            return true;
        }
        return false;
    }
   );
   format = function date2str(x, y) {
    var z = {
        M: x.getMonth() + 1,
        d: x.getDate(),
        h: x.getHours(),
        m: x.getMinutes(),
        s: x.getSeconds()
    };
    y = y.replace(/(M+|d+|h+|m+|s+)/g, function(v) {
        return ((v.length > 1 ? "0" : "") + z[v.slice(-1)]).slice(-2)
    });

    return y.replace(/(y+)/g, function(v) {
        return x.getFullYear().toString().slice(-v.length)
    });
}
   $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
        var startDate =Date.parse(format(new Date($('#start_date').val()),'yyyy-MM-dd'));
        var endDate =Date.parse(format(new Date($('#end_date').val()),'yyyy-MM-dd'));
        var columnDate =Date.parse(format(new Date(data[3]),'yyyy-MM-dd'));
        console.log(startDate);
        console.log(endDate);
        console.log(columnDate);
        if ((isNaN(startDate) && isNaN(endDate)) ||
            (isNaN(startDate) && columnDate <= endDate) ||
            (startDate <= columnDate && isNaN(endDate)) ||
            (startDate <= columnDate && columnDate <= endDate)) {
            return true;
        }
        return false;
    }
);
    
    
</script>
@endsection