
<?php $__env->startSection('content'); ?>
    <!--banner-->
 <!-- Start Bradcaump area -->
 <div class="ht__bradcaump__area bg-image--6" style="background-image: url(public/uploaded/slider/_anh609639bb6c63f4.05873655.jpg) !important">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="bradcaump__inner text-center">
					<h2 class="bradcaump-title">Khuyến mãi</h2>
					<nav class="bradcaump-content">
					  <a class="breadcrumb_item" href="<?php echo e(URL::to('/')); ?>">Home</a>
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
                    <?php if($sale_code): ?>
					<div class="alert alert-default">
						<h3>Danh sách mã khuyến mãi</h3><br><hr/>
                        <?php $i=0;?>
                        <?php $__currentLoopData = $sale_code; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php  $sl=0; ?>
						<?php 
							
							$bills=DB::table('bills')->select('idBill')->where('idKH',$user->id)->where('idSale',$sale->idSale)->get();

							foreach($bills as $bill){
								++$sl;
							}
							
							
						?>
						<?php echo e(++$i); ?> ) <strong><?php echo e($sale->nameSale); ?></strong>
						<p><?php echo $sale->mota; ?> </p>
						<?php $solan=$sale->solan-$sl; ?>
                        <p> Giảm <?php echo e($sale->phantram*100); ?> % giá trị đơn hàng x <?php echo e($sale->solan); ?> áp dụng ( Còn sử dụng được <?php echo e($solan); ?> lần)</p><br><hr/>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					<?php endif; ?>
                    
					
				</div>
            </div>
		</div>
	</div>
</section>
<!-- End My Account Area -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
	OnBook | Danh sách khuyến mãi
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\OnBook\resources\views/pages/sale_code.blade.php ENDPATH**/ ?>