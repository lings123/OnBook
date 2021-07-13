@extends('layout.master')
@section('content')
<?php $bill=Session::get('bill');
        $Detail=Session::get('Detail');
        $user=Session::get('user');
?>
<div class="ht__bradcaump__area bg-image--6" style="background-image: url(../../public/uploaded/slider/_anh609639bb6c63f4.05873655.jpg) !important">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="bradcaump__inner text-center">
					<h2 class="bradcaump-title">Đơn hàng {{$bill->idBill}}</h2>
					<nav class="bradcaump-content">
					  <a class="breadcrumb_item" href="{{URL::to('/')}}">Home</a>
					  <span class="brd-separetor">/</span>
					  <span class="breadcrumb_item active">Chi tiết đơn hàng</span>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="my_account_area pt--80 pb--55 bg--white">
	<div class="container">
		<div class="row">
            <div class="col-lg-9 col-12 order-1 order-lg-2">
                
                    <table class="table__info-customer">
                        <tr>
                            <td class='td-left'>Họ và tên:</td>
                            <td>{{$bill->nameKH}}</td>
                        </tr>
                        <tr>
                            <td>Số điện thoại:</td>
                            <td>{{$bill->phone}}</td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>{{$bill->email}}</td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td>{{$bill->address}}</td>
                        </tr>
                        <tr>
                            <td>Hình thức thanh toán</td>
                            <?php $thanhtoan=DB::table('thanhtoan')->where('idCheck',$bill->idCheck)->first(); ?>
                            <td>{{$thanhtoan->nameCheck}}: <br> {!!$thanhtoan->noidung!!}</td>
                        </tr>
                        <tr>
                            <td>Mã khuyến mãi</td>
                            <?php $sale=DB::table('sale')->where('idSale',$bill->idSale)->first(); ?>
                            
                            <td>@if($sale!=null) {{$sale->nameSale}} - Giảm {{$sale->phantram*100}} % @else Không có @endif</td>
                        </tr>
                        <tr>
                            <td>Phí vận chuyển</td>
                            <?php $ship=30000; 
                                $total=$bill->totalPrice-$ship;
                                if($total>200000){
                                    $ship=0;
                                } ;?>
                            <td>@if($ship!=0) {{number_format($ship)}} VND @else FREE @endif</td>
                        </tr>
                        <tr>
                            <td>Tổng tiền</td>
                            <td>{{number_format($bill->totalPrice)}} vnđ</td>
                        </tr>
                    </table>
                
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>#</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Đánh giá</th>
                        </tr>
                    </thead>
                    <tbody class="table__list_item">
                        @foreach($Detail as $item)
                        <tr class="odd gradeX" align="center">
                            <?php
                                $book=DB::table('books')->where('idBook',$item->idBook)->first();
                            ?>
                            <td> <img src="{{URL::to('public/uploaded/books/'.$book->hinh_dai_dien)}}" style="width: 150px;height: 200px;"></td>
                            <td class="text-left product-title">
                               
                                <p>
                                    {{$book->NameBook}}
                                </p>
                            </td>
                            <td>
                                {{$item->quantity}}
                            </td>
                            <td>
                                {{$item->unit_price}}
                            </td>
                           <td> @if($bill->trangthai==3)
                                    <?php $danhgia=DB::table('danhgia')->where('idBook',$item->idBook)->where('idKH',$user->id)->first(); ?>
                                    @if($danhgia)
                                        <span class="btn btn-default">BẠN ĐÁNH GIÁ SẢN PHẨM NÀY.</span>
                                    @else
                                        <a class="btn btn-primary" href="{{URL::to('chi-tiet/'.$book->slug_name)}}">ĐÁNH GIÁ.</a>
                                    @endif
                                @endif
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            
                <br/><hr/>
                <div class="col-lg-9 col-12 order-1 order-lg-2">
                    @if($bill->trangthai==0) 
                    <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link btn btn-danger" href="#bill-des">HỦY ĐƠN HÀNG</a>
                   
                    @endif

                </div>
                <div id="quickview-wrapper">
                    <div class="modal fade" id="bill-des" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal__container" role="document">
                            <div class="modal-content">
                                <div class="modal-header modal__header">
                                    <h3>Xác nhận hủy đơn hàng</h3><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{URL::to('/don-hang/chi-tiet/huy/'.$bill->idBill)}}" method="POST">
                                        @csrf
                                        <span>Lý do hủy : </span><input type="text" style="width: 500px;height: 250px;" name="txtnote" required/>
                                        <br/><br/><button type="submit" class="btn btn-danger" style="float: right">Hủy</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                @include('layout.sider_kh');
            </div>
        </div>
    </div>
</section>

@endsection
