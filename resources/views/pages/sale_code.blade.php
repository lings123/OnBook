@extends('layout.master')
@section('content')
    <!--banner-->
 <!-- Start Bradcaump area -->
 <div class="ht__bradcaump__area bg-image--6" style="background-image: url(public/uploaded/slider/_anh609639bb6c63f4.05873655.jpg) !important">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="bradcaump__inner text-center">
					<h2 class="bradcaump-title">Khuyến mãi</h2>
					<nav class="bradcaump-content">
					  <a class="breadcrumb_item" href="{{URL::to('/')}}">Home</a>
					  <span class="brd-separetor">/</span>
					  <span class="breadcrumb_item active">Sale Code</span>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Bradcaump area -->
<!-- Start My Account Area -->
<section class="my_account_area pt--80 pb--55 bg--white">
	<div class="container">
		<div class="row">
            <div class="col-lg-12">
				<div class="my__account__wrapper">

                    <?php 
					$sale_code=Session::get('khuyenmai') ;
					 $user=Session::get('user');
					?> 
                    @if($sale_code)
					<div class="alert alert-default">
						<h3>Danh sách mã khuyến mãi</h3><br><hr/>
                        <?php $i=0;?>
                        @foreach($sale_code as $sale)
						<?php  $sl=0; ?>
						<?php 
							
							$bills=DB::table('bills')->select('idBill')->where('idKH',$user->id)->where('idSale',$sale->idSale)->get();

							foreach($bills as $bill){
								++$sl;
							}
							
							
						?>
						{{++$i}} ) <strong>{{$sale->nameSale}}</strong>
						<p>{!!$sale->mota!!} </p>
						<?php $solan=$sale->solan-$sl; ?>
                        <p> Giảm {{$sale->phantram*100}} % giá trị đơn hàng x {{$sale->solan}} áp dụng ( Còn sử dụng được {{$solan}} lần)</p><br><hr/>
                        @endforeach
					</div>
					@endif
                    
					
				</div>
            </div>
		</div>
	</div>
</section>
<!-- End My Account Area -->
@endsection
@section('title')
	OnBook | Danh sách khuyến mãi
@endsection