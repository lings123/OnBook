@extends('layout.master')
@section('content')
<div class="ht__bradcaump__area bg-image--6" style="background-image: url(public/uploaded/slider/_anh609639bb6c63f4.05873655.jpg) !important">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="bradcaump__inner text-center">
					<h2 class="bradcaump-title">Danh sách đơn hàng</h2>
					<nav class="bradcaump-content">
					  <a class="breadcrumb_item" href="{{URL::to('/')}}">Home</a>
					  <span class="brd-separetor">/</span>
					  <span class="breadcrumb_item active">Đơn hàng</span>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $listBill=Session::get('listBill'); ?>
<section class="my_account_area pt--80 pb--55 bg--white">
	<div class="container">
		<div class="row">
            <div class="col-lg-9 col-12 order-1 order-lg-2">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Địa chỉ</th>
                            <th>Ngày tạo</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th>Chi tiểt đơn hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listBill as $bill)
                        <tr>
                            <td>{{$bill->idBill}}</td>
                            <td>{{$bill->address}}</td>
                            <td> {{ \Carbon\Carbon::parse($bill->create_date)->format('d/m/Y H:i:s')}}</td>
                            <td>{{number_format($bill->totalPrice)}} VND</td>
                            <td>
                                @if($bill->trangthai==0)
                                Chưa xử lý
                                @endif
                                @if($bill->trangthai==1)
                                Đã xác nhận
                                @endif
                                @if($bill->trangthai==2)
                                Đang giao hàng
                                @endif
                                @if($bill->trangthai==3)
                                Giao thành công
                                @endif
                                @if($bill->trangthai==4)
                                Đã hủy đơn
                                @endif
                            </td>
                            <td><a href="{{URL::to('don-hang/chi-tiet/'.$bill->idBill)}}" class="fa fa-search fa-fw"></a></td>
                        </tr>
                        @endforeach
                </table>
            </div>
            <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                @include('layout.sider_kh');
            </div>
        </div>
    </div>
</section>
@endsection
@section('title')
	OnBook | Danh sách đơn hàng
@endsection