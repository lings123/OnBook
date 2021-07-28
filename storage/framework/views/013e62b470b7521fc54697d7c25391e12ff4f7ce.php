
<?php $__env->startSection('content'); ?>
 <!-- Start Bradcaump area -->
 <?php $listBook=Session::get('books');
		$type_name=Session::get('typeName');
		$author_name=Session::get('AuthorName');
		$pub_name=Session::get('PubName');
		$all=Session::get('all');
		$new=Session::get('new');
		$sale=Session::get('sale_item');
		$mess_new=Session::get('mess_new');
		$mess_sale=Session::get('mess_sale');
		$mess_all=Session::get('mess_all');
		
		$sort= Session::get('sort');
		Session::put('sort',"md");
 ?>
 <div class="ht__bradcaump__area bg-image--6" style="background-image: url(../public/uploaded/slider/_anh609639bb6c63f4.05873655.jpg) !important">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="bradcaump__inner text-center">
					<h2 class="bradcaump-title">
						<?php if($type_name): ?>
						<?php echo e($type_name); ?>

						<?php echo e(Session::put('typeName',null)); ?>

						<?php endif; ?>
						<?php if($author_name): ?>
						<?php echo e($author_name); ?>

						<?php echo e(Session::put('AuthorName',null)); ?>

						<?php endif; ?>
						<?php if($pub_name): ?>
						<?php echo e($pub_name); ?>

						<?php echo e(Session::put('PubName',null)); ?>

						<?php endif; ?>
						<?php if($mess_all): ?>
							<?php echo e($mess_all); ?>

							 <?php echo e(Session::put('mess_all',null)); ?>

						<?php endif; ?>
						<?php if($mess_new): ?>
							<?php echo e($mess_new); ?>

							<?php echo e(Session::put('mess_new',null)); ?>

						<?php endif; ?>
						<?php if($mess_sale): ?>
							<?php echo e($mess_sale); ?>

							<?php echo e(Session::put('mess_sale',null)); ?>

						<?php endif; ?>
					</h2>
					<nav class="bradcaump-content">
					  <a class="breadcrumb_item" href="<?php echo e(URL::to('/')); ?>">Home</a>
					  <span class="brd-separetor">/</span>
					  <span class="breadcrumb_item active">Shop</span>
					  
					</nav>
					<?php if($listBook->count()==0): ?> <h2 class="bradcaump-title"> Không có sản phẩm </h2> <?php endif; ?>
					
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
			
			
			<div class="col-lg-9 col-12 order-1 order-lg-2">
				<div class="row">
					<div class="col-lg-12">
						<div class="shop__list__wrapper d-flex  flex-md-nowrap justify-content-between">
							<p>
								<?php if(count($listBook) > 0): ?>
									<?php if(count($listBook) > 0): ?> Hiển thị: <?php echo e($listBook->firstItem()); ?> - 
									<?php echo e($listBook->lastItem()); ?> trong <?php endif; ?> <?php echo e($listBook->total()); ?> sản phẩm
								<?php endif; ?>
							</p>
							<form id="form_sort" method="GET">
							<div class="orderby__wrapper">
								<span>Sắp xếp : </span>
								<select class="shot__byselect orderbyBook" name="orderbyBook">
									<option value="md" <?php if(isset($sort)&&$sort=="md"): ?> selected="selected" <?php endif; ?>>Mặc định</option>
									<option value="price_low" <?php if(isset($sort)&&$sort=="price_low"): ?> selected="selected" <?php endif; ?>>Giảm dần</option>
									<option value="price_high" <?php if(isset($sort)&&$sort=="price_high"): ?> selected="selected" <?php endif; ?>>Tăng dần</option>
								</select>
							</div>
							</form>
						</div>
						
					</div>
					
				</div>
				
				<div class="tab__container">
					<div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
						
						<div class="row">
							<!-- Start Single Product -->
							
							<?php $__currentLoopData = $listBook; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						
							<div class="col-lg-4 col-md-4 col-sm-6 col-12">
								
								<div class="product product__style--3">
									
									<div class="product__thumb">
										<a class="first__img" href="<?php echo e(URL::to('/chi-tiet/'.$book->slug_name)); ?>"><img src="<?php echo e(URL('public/uploaded/books/'.$book->hinh_dai_dien)); ?>" width="270" height="340"  alt="product image"></a>
										<div class="hot__box">
											<?php if($book->new!=0): ?><span class="hot-label">NEW</span><?php endif; ?>
										</div>
									</div>
									<div class="product__content content--center content--center">
										<h4><a href="<?php echo e(URL::to('/chi-tiet/'.$book->slug_name)); ?>"><?php echo e($book->NameBook); ?></a></h4>
										<ul class="prize d-flex">
											<?php if($book->sale_price!=0): ?>
											<li><?php echo e(number_format($book->sale_price)); ?> VND</li>
											<li class="old_prize"><?php echo e(number_format($book->unit_price)); ?> VND</li>
											<?php else: ?>
											<li><?php echo e(number_format($book->unit_price)); ?> VND</li>
											<?php endif; ?>
										</ul>
										<div class="action">
											<div class="actions_inner">
												<ul class="add_to_links">
													
													<li><a class="wishlist" href="<?php echo e(URL::to('/yeu-thich/them/'.$book->idBook)); ?>"><i class="bi bi-heart-beat"></i></a></li>
													<li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#product<?php echo e($book->idBook); ?>"><i class="bi bi-search"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
								
								</div>
								
							</div>
							<!-- End Single Product -->
							<!-- Start Single Product -->
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<!-- End Single Product -->
							
						
						</div>
						<ul class="wn__pagination">
							<li ><?php echo e($listBook->appends(['orderbyBook'=>$sort])->links('vendor.pagination.semantic-ui')); ?></li>
						</ul>
						
					</div>
				</div>
				
				
			</div>
			<div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
				<?php echo $__env->make('layout.sider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
			</div>
		</div>

	</div>
</div>
<!-- QUICKVIEW PRODUCT -->
<div id="quickview-wrapper">
	<!-- Modal -->
	<?php $books=DB::table('books')->get(); ?>
	<?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div class="modal fade" id="product<?php echo e($b->idBook); ?>" tabindex="-1" role="dialog">
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
								<img alt="big images" src="<?php echo e(URL('public/uploaded/books/'.$b->hinh_dai_dien)); ?>" width="420" height="500">
							</div>
						</div>
						<!-- end product images -->
						<div class="product-info">
							<h1><?php echo e($b->NameBook); ?></h1>
							<div class="select__color">
								<h2>Còn : </h2> 
								<p><?php if($b->quantity==0): ?><span>  In stock</span><?php else: ?> <?php echo e($b->quantity); ?> <?php endif; ?> </p>
							</div>
							<div class="rating__and__review">
								<div class="review">
									<a href="#">Điểm : <?php echo e($b->diem); ?></a>
								</div>
							</div>
							<div class="price-box-3">
								<div class="s-price-box">
									<?php if($b->sale_price!=0): ?>
									<span class="new-price"><?php echo e(number_format($b->sale_price)); ?> VND</span>
									<span class="old-price"><?php echo e(number_format($b->unit_price)); ?> VND</span>
									<?php else: ?>
									<span class="new-price"><?php echo e(number_format($b->unit_price)); ?> VND</span>
									<?php endif; ?>
								   
								</div>
							</div>
							<br>
							<div class="select__color">
								<h2>Tác giả : </h2> 
								<?php $author=DB::table('author')->where('idAuthor',$b->idAuthor)->first(); ?>
								<a href="<?php echo e(URL::to('/tac-gia/'.$author->idAuthor)); ?>"><?php echo e($author->nameAuthor); ?></a>
							</div>
							<br>
							<div class="select__color">
								<h2>Nhà xuất bản : </h2> 
								<?php $pub=DB::table('publisher')->where('idPub',$b->idPub)->first(); ?>
								<a href="<?php echo e(URL::to('/nha-xuat-ban/'.$pub->idPub)); ?>"><?php echo e($pub->namePub); ?></a>
							</div>
							
								<div class="product__info__main">
							<div class="box-tocart d-flex">
								<form action="<?php echo e(URL::to('/gio-hang/them/'.$b->idBook)); ?>" method="POST">
									
									<?php echo e(csrf_field()); ?>

									<?php if($b->quantity>0): ?>
									<span>Số lượng</span>
									<input id="qty" class="input-text qty" name="qty" min="1" value="1" title="Qty" type="number">
                                        <div class="addtocart__actions">
                                            <button class="tocart btn" type="submit" title="Add to Cart">Add to Cart</button>
                                        </div>
										<?php else: ?>
										<div class="addtocart__actions">
											<h3 style="color: darkred">Hết hàng</h3>
										</div>
										<?php endif; ?>
									</form>
							</div>
								</div>
							

							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<!-- END QUICKVIEW PRODUCT -->
<!-- End Shop Page -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
	OnBook | Danh sách sản phẩm
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">

	$('.orderbyBook').on('change', function() {
		$("#form_sort").submit();
		
	});

	

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\OnBook\resources\views/pages/category.blade.php ENDPATH**/ ?>