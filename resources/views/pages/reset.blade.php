@extends('layout.master')
@section('content')
    <!--banner-->
 <!-- Start Bradcaump area -->
 <div class="ht__bradcaump__area bg-image--6" style="background-image: url(public/uploaded/slider/_anh609639bb6c63f4.05873655.jpg) !important">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="bradcaump__inner text-center">
					<h2 class="bradcaump-title">Lấy lại mật khẩu</h2>
					<nav class="bradcaump-content">
					  <a class="breadcrumb_item" href="{{URL::to('/')}}">Home</a>
					  <span class="brd-separetor">/</span>
					  <span class="breadcrumb_item active">Reset Password</span>
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
					$mess=Session::get('message') ;
					 Session::put('message',null);   
					?> 
                    @if($mess)
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>{{$mess}}</strong>
					</div>
					@endif
                    
					<h3 class="account__title">Thông tin khôi phục</h3>
					<form action="{{URL::to('/reset')}}" method="POST">
						<div class="account__form">
							<div class="input__box">
								<label>Email <span>*</span></label>
								<input type="email" name="txtEmail" required>
							</div>
							{{ csrf_field() }}
							<div class="form__btn">
								<button type="submit">Xác nhận</button>
							</div>
						</div>
					</form>
				</div>
            </div>
		</div>
	</div>
</section>
<!-- End My Account Area -->
@endsection
@section('title')
	OnBook | Quên mật khẩu
@endsection