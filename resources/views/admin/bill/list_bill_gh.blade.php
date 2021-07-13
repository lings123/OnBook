@extends('admin.layout.master')
@section('content')
<style>

div.dt-searchPane div.dataTables_length{
        float: none;
        text-align: center;
    }
</style>
<?php
$thanhcong=Session::get('thanhcong');
$huy=Session::get('huy');

?>
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Đơn hàng giao của {{Session::get('NameAd')}}
                            <small>Danh sách</small>
                        </h1>
                    </div>
                   
                    <hr/>
                   
                    <small>Số đơn hàng giao thành công : {{$thanhcong->count()}}</small><br/>
                    <small>Số đơn hàng đã hủy : {{$huy->count()}}</small>
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
                                                <option value="1" @if($bill->trangthai==1) selected @endif>Đã xử lý</option>
                                                <option value="2" @if($bill->trangthai==2) selected @endif>Đang giao hàng</option>
                                                <option value="3" @if($bill->trangthai==3) selected @endif>Giao hàng thành công</option>
                                                <option value="4" @if($bill->trangthai==4) selected @endif>Hủy đơn hàng</option>
                                        </div>
                                        {{csrf_field()}}
                                        <br/>
                                        <button type="submit" class="btn btn-default">Cập nhật</button>
                                </form>
                                
                            </td>
                            <td class="center"><i class="fa fa-search fa-fw"></i> <a href="{{URL::to('admin/don-hang/chi-tiet/'.$bill->idBill)}}">Chi Tiết</a></td>
                              
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