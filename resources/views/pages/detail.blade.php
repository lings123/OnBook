@extends('layout.master')
@section('content')
<?php $book=Session::get('book');
	$img_book=Session::get('img_book');
	$books_relate=Session::get('book_relate');
	$user=Session::get('user');
	$comment=Session::get('comment');
	
	$kq=false;
?>
 <!-- Start Bradcaump area -->
 <div class="ht__bradcaump__area bg-image--6" style="background-image: url(../public/uploaded/slider/_anh609639bb6c63f4.05873655.jpg) !important">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="bradcaump__inner text-center">
					<h2 class="bradcaump-title">{{$book->NameBook}}</h2>
					<nav class="bradcaump-content">
					  <a class="breadcrumb_item" href="index.html">Home</a>
					  <span class="brd-separetor">/</span>
					  <span class="breadcrumb_item active">Sách</span>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- End Bradcaump area -->
<!-- Start main Content -->
<div class="maincontent bg--white pt--80 pb--55">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-12">
				<div class="wn__single__product">
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="wn__fotorama__wrapper">
								<div class="fotorama wn__fotorama__action" data-nav="thumbs">
									
									<a href="#"><img src="{{URL('public/uploaded/books/'.$book->hinh_dai_dien)}}" width='450px' height='585px' alt=""></a>
									@foreach($img_book as $img)
									<a href="#"><img src="{{URL('public/uploaded/books/'.$img->NameImg)}}" width='450px' height='585px' alt=""></a>
									@endforeach
									
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="product__info__main">
								<h1>{{$book->NameBook}}</h1>
								<div class="product-info-stock-sku d-flex">
									<p>Còn: @if($book->quantity==0)<span>  In stock</span>@else {{$book->quantity}} @endif </p>
								</div>
								
								<div class="product-reviews-summary d-flex">
									<div class="reviews-actions d-flex">
										<a href="#">({{$comment->count()}} Reviews )</a>
										<a href="#">Điểm : {{$book->diem}}</a>
									</div>
									
								</div>
								@if($book->pages>0)
								<div class="product-info-stock-sku d-flex">
									<p>Số trang: {{$book->pages}} </p>
								</div>
								@endif
								<div class="product-info-stock-sku d-flex">
									<p>Kích thước: {{$book->chieu_dai}} x {{$book->chieu_rong}} </p>
								</div>
								
								<div class="price-box-3">
									<div class="s-price-box">
										@if($book->sale_price!=0)
										<span class="new-price">{{number_format($book->sale_price)}} VND</span>
										<span class="old-price">{{number_format($book->unit_price)}} VND</span>
										@else
										<span class="new-price">{{number_format($book->unit_price)}} VND</span>
										@endif
									   
									</div>
								</div>
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
								<div class="box-tocart d-flex">
									<form action="{{URL::to('/gio-hang/them/'.$book->idBook)}}" method="POST">
                                       
										{{ csrf_field() }}
										@if($book->quantity>0)
										<span>Số lượng</span>
                                        <input id="qty" class="input-text qty" name="qty" min="1" value="1" title="Qty" type="number">
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
								<div class="product-addto-links clearfix">
									<a class="wishlist" href="{{URL::to('/yeu-thich/them/'.$book->idBook)}}"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="product__info__detailed">
					<div class="pro_details_nav nav justify-content-start" role="tablist">
						<a class="nav-item nav-link active " data-toggle="tab" href="#nav-details" role="tab">Details</a>
						<a class="nav-item nav-link " data-toggle="tab" href="#nav-review" role="tab">Reviews</a>
					</div>
					<div class="tab__container">
						<!-- Start Single Tab Content -->
						<div class="pro__tab_label tab-pane fade show active" id="nav-details" role="tabpanel">
							<div class="description__attribute">
								{!!$book->description!!}
							</div>
						</div>
						<!-- End Single Tab Content -->
						<!-- Start Single Tab Content -->
						<div class="pro__tab_label tab-pane fade" id="nav-review" role="tabpanel">
							
							<br>
							<div class="review__attribute">
								<h1>ĐÁNH GIÁ</h1>
								
								@foreach($comment as $com)
								
								<h2>{{$com->tieude}}</h2> 
								

								<div class="review__ratings__type d-flex">
									<div class="review-ratings">
										<div class="rating-summary d-flex">
											<span>Điểm : </span>
											<ul class="rating d-flex">
												<li>{{number_format($com->diem,2,',','')}}</li>
											</ul>
											<br>
										</div>
										<div class="rating-summary d-flex">
											<span>Nội dung : </span>
										</div>
										<div class="rating-summary d-flex">
											<p>{!!$com->noidung!!}</p>
										</div>
									</div>
									<div class="review-content">
										
										<p>Review by {{$com->nameKH}}</p>
										<p>Posted on {{ \Carbon\Carbon::parse($com->create_date)->format('d/m/Y')}}</p>
									</div>
									
									
								</div>
								
								@endforeach
								<ul class="wn__pagination">
									<li >{{$comment->links('vendor.pagination.semantic-ui')}}</li>
								</ul>
							</div>
							
						</div>
						<!-- End Single Tab Content -->
					</div>
				</div>
				<div class="wn__related__product pt--80 pb--50">
					<div class="section__title text-center">
						<h2 class="title__be--2">Sách cùng thể loại</h2>
					</div>
					<div class="row mt--60">
						<div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">
							<!-- Start Single Product -->
							@foreach($books_relate as $book)
							<div class="col-lg-4 col-md-4 col-sm-6 col-12">
								<div class="product product__style--3">
									<div class="product__thumb">
										<a class="first__img" href="{{URL::to('/chi-tiet/'.$book->slug_name)}}"><img src="{{URL('public/uploaded/books/'.$book->hinh_dai_dien)}}" width="270" height="340"  alt="product image"></a>
											
											<div class="new__box">
												@if($book->new!=0)<span class="new-label">NEW</span>@endif
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
							@endforeach
							<!-- Start Single Product -->
							
						</div>
					</div>
				</div>
				
			</div>
			<div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
				@include('layout.sider');
			</div>
		</div>
	</div>
</div>
<!-- End main Content -->




<!-- QUICKVIEW PRODUCT -->
<div id="quickview-wrapper">
	<!-- Modal -->
	<?php $books=DB::table('books')->get(); $message=Session::get('message'); Session::put('message',null) ?>
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
							@if($message)
							<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>{{$message}}</strong>
							</div>
							@endif
							<h1>{{$b->NameBook}}</h1>
							<div class="select__color">
								<h2>Còn : </h2> 
								<p>@if($b->quantity==0)<span>  In stock</span>@else {{$b->quantity}} @endif </p>
							</div>
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
									
									{{ csrf_field() }}
									@if($b->quantity>0)
									<span>Số lượng</span>
									<input id="qty" class="input-text qty" name="qty" min="1" value="1" title="Qty" type="number">
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

</div>

@section('title')
	OnBook | Chi tiết sản phẩm
@endsection
