@extends('admin.layout.master')
@section('content')
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Đơn hàng
                            <small>Chi tiết</small>
                        </h1>
                    </div>
                    <?php 
                        $bill=Session::get('bill');
                        $idAd=Session::get('idAd');
                        
                        $ad=DB::table('admin')->where('idAd',$idAd)->first();
                        
                    ?>
                     <a @if($ad->level==1||$ad->level==2)href="{{URL::to('admin/don-hang/danh-sach')}}" @else href="{{URL::to('admin/don-hang/danh-sach-giao-hang/'.$idAd)}}" @endif class="btn btn-default">Trở về</a>
                    <div class="col-lg-12">
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
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>#</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                            </tr>
                        </thead>
                        <tbody class="table__list_item">
                            @foreach($Detail as $item)
                            <tr class="odd gradeX" align="center">
                                <?php
                                    $book=DB::table('books')->where('idBook',$item->idBook)->first();
                                ?>
                                <td> <img src="{{URL::to('public/uploaded/books/'.$book->hinh_dai_dien)}}"></td>
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
