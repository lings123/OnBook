@extends('layout.master')
@section('content')
 <!-- Start Bradcaump area -->
 <?php  $result=Session::get('result');
		$keyword=Session::get('keyword');
		$nameType=Session::get('nameType');
 ?>
 <div class="ht__bradcaump__area bg-image--6" style="background-image: url(public/uploaded/slider/_anh609639bb6c63f4.05873655.jpg) !important">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="bradcaump__inner text-center">
					<h2 class="bradcaump-title">
						@if($keyword)
						Tìm kiếm<br>
						Keyword : {{$keyword}}
						@endif
						<br/>
						@if($nameType)
						theo thể loại {{$nameType}}
						@endif
						</h2>
						{{Session::put('keyword',null)}}
						{{Session::put('nameType',null)}}
					<nav class="bradcaump-content">
					  <a class="breadcrumb_item" href="{{URL::to('/')}}">Home</a>
					  <span class="brd-separetor">/</span>
					  <span class="breadcrumb_item active">Tìm  kiếm</span>
					  
					</nav>
					@if($result->count()==0) <h2 class="bradcaump-title"> Không có sản phẩm </h2> @endif
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
							<p>
								@if(count($result) > 0)
									@if(count($result) > 0) Hiển thị: {{$result->firstItem()}} - 
									{{ $result->lastItem() }} trong @endif {{ $result->total()}} sản phẩm
								@endif
							</p>
						</div>
						
					</div>
				</div>
				<div class="tab__container">
					<div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
						
						<div class="row">
							<!-- Start Single Product -->
							
							@foreach($result as $book)
							<div class="col-lg-4 col-md-4 col-sm-6 col-12">
								<div class="product product__style--3">
									<div class="product__thumb">
										<a class="first__img" href="{{URL::to('/chi-tiet/'.$book->slug_name)}}"><img src="{{URL('public/uploaded/books/'.$book->hinh_dai_dien)}}" width="270" height="340"  alt="product image"></a>
										<div class="hot__box">
											@if($book->new!=0)<span class="hot-label">NEW</span>@endif
										</div>
									</div>
									<div class="product__content content--center content--center">
										<h4><a href="{{URL::to('/chi-tiet/'.$book->slug_name)}}">{{$book->NameBook}}</a></h4>
										<ul class="prize d-flex">
											@if($book->sale_price!=0)
											<li>{{number_format($book->sale_price)}} VND</li>
											<li class="old_prize">{{number_format($book->unit_price)}} VND</li>
											@else
											<li>{{number_format($book->unit_price)}} VND</li>
											@endif
										</ul>
										<div class="action">
											<div class="actions_inner">
												<ul class="add_to_links">
													<li><a class="wishlist" href="{{URL::to('/yeu-thich/them/'.$book->idBook)}}"><i class="bi bi-heart-beat"></i></a></li>
													<li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#product{{$book->idBook}}"><i class="bi bi-search"></i></a></li>
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
						
					</div>
				</div>
				<ul class="wn__pagination">
					<li >{{$result->appends(['keyword'=>$keyword])->links('vendor.pagination.semantic-ui')}}</li>
				</ul>
				
			</div>
			
		</div>
		
	</div>
</div>
<!-- QUICKVIEW PRODUCT -->
<div id="quickview-wrapper">
	<!-- Modal -->
	<?php $books=DB::table('books')->get(); ?>
	@foreach($books as $b)
	<div class="modal fade" id="product{{$b->idBook}}" tabindex="-1" role="dialog">
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
								<img alt="big images" src="{{URL('public/uploaded/books/'.$b->hinh_dai_dien)}}" width="420" height="500">
							</div>
						</div>
						<!-- end product images -->
						<div class="product-info">
							<h1>{{$b->NameBook}}</h1>
							<div class="rating__and__review">
								<div class="review">
									<a href="#">Điểm : {{$b->diem}}</a>
								</div>
							</div>
							<div class="price-box-3">
								<div class="s-price-box">
									@if($b->sale_price!=0)
									<span class="new-price">{{number_format($b->sale_price)}} VND</span>
									<span class="old-price">{{number_format($b->unit_price)}} VND</span>
									@else
									<span class="new-price">{{number_format($b->unit_price)}} VND</span>
									@endif
								   
								</div>
							</div>
							<br>
							<div class="select__color">
								<h2>Tác giả : </h2> 
								<?php $author=DB::table('author')->where('idAuthor',$b->idAuthor)->first(); ?>
								<a href="{{URL::to('/tac-gia/'.$author->idAuthor)}}">{{$author->nameAuthor}}</a>
							</div>
							<br>
							<div class="select__color">
								<h2>Nhà xuất bản : </h2> 
								<?php $pub=DB::table('publisher')->where('idPub',$b->idPub)->first(); ?>
								<a href="{{URL::to('/nha-xuat-ban/'.$pub->idPub)}}">{{$pub->namePub}}</a>
							</div>
							
								<div class="product__info__main">
									<div class="box-tocart d-flex">
										<form action="{{URL::to('/gio-hang/them/'.$b->idBook)}}" method="POST">
											<span>Số lượng</span>
											<input id="qty" class="input-text qty" name="qty" min="1" value="1" title="Qty" type="number">
											
											{{ csrf_field() }}
											
											@if($b->quantity>0)
                                        <div class="addtocart__actions">
                                            <button class="tocart btn" type="submit" title="Add to Cart">Add to Cart</button>
                                        </div>
										@else
										<div class="addtocart__actions">
											<h3 style="color: darkred">Hết hàng</h3>
										</div>
										@endif
											</form>
									</div>
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
	OnBook | Kết quả tìm kiếm
@endsection