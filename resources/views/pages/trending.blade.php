@extends('layout.master')
@section('content')
 <!-- Start Bradcaump area -->
 <?php $listBook=Session::get('books');
 ?>
 <div class="ht__bradcaump__area bg-image--6" style="background-image: url(public/uploaded/slider/_anh609639bb6c63f4.05873655.jpg) !important">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="bradcaump__inner text-center">
					<h2 class="bradcaump-title">
						Xu hướng tham khảo
					<nav class="bradcaump-content">
					  <a class="breadcrumb_item" href="{{URL::to('/')}}">Home</a>
					  <span class="brd-separetor">/</span>
					  <span class="breadcrumb_item active">Trending</span>
					  
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Bradcaump area -->
<!-- Start Shop Page -->
<div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
				@include('layout.sider');
			</div>
			
			<div class="col-lg-9 col-12 order-1 order-lg-2">
				
				<div class="row">
					<div class="col-lg-12">
						<div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
							<p>Một số sản phẩm tham khảo thêm từ các cửa hàng khác. Mà cửa hàng chưa có.</p>
						</div>
						
					</div>
				</div>
				<div class="tab__container">
					<div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
						
						<div class="row">
							<!-- Start Single Product -->
							
							@foreach($listBook as $book)
							<div class="col-lg-4 col-md-4 col-sm-6 col-12">
								<div class="product product__style--3">
									<div class="product__thumb">
										<a class="first__img" href="{{$book->website}}"><img src="{{$book->img}}" width="270" height="340"  alt="product image"></a>
										
									</div>
									<div class="product__content content--center content--center">
										<h4><a >{{$book->name}}</a></h4>
										<ul class="prize d-flex">
											
											<li>{{$book->price}}</li>
											
										</ul>
										<div class="action">
											<div class="actions_inner">
												<ul class="add_to_links">
													<li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#product{{$book->id}}"><i class="bi bi-search"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- End Single Product -->
							<!-- Start Single Product -->
							@endforeach
							<!-- End Single Product -->
							
							
						
						</div>
						<ul class="wn__pagination">
                            <li >{{$listBook->links('vendor.pagination.semantic-ui')}}</li>
                        </ul>
					</div>
				</div>
				
				
			</div>
			
		</div>
	</div>
</div>
<!-- QUICKVIEW PRODUCT -->
<div id="quickview-wrapper">
	<!-- Modal -->
	<?php $books=DB::table('trending')->get(); ?>
	@foreach($books as $b)
	<div class="modal fade" id="product{{$b->id}}" tabindex="-1" role="dialog">
		<div class="modal-dialog modal__container" role="document">
			<div class="modal-content">
				<div class="modal-header modal__header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="modal-product">
						<!-- Start product images -->
						<div class="product-images">
							<div class="main-image images">
								<img alt="big images" src="{{$b->img}}" width="420" height="500">
							</div>
						</div>
						<!-- end product images -->
						<div class="product-info">
							<h1>{{$b->name}}</h1>
							
							<div class="price-box-3">
								<div class="s-price-box">
									
									<span class="new-price">{{$b->price}}</span>
									
								</div>
							</div>
							<br>
							<div class="select__color">
								<span>{{$b->pages}}</span>
							</div>
							<br>
							<div class="select__color">
								<span>{{$b->size}}</span>
							</div>
							<div class="select__color">
								<span>{{$b->pub_date}}</span>
							</div>
								
							

							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div>
<!-- END QUICKVIEW PRODUCT -->
<!-- End Shop Page -->
@endsection
@section('title')
	OnBook | Trending từ các cửa hàng
@endsection