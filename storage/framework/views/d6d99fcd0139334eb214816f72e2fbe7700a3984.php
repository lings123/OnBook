
<?php $__env->startSection('content'); ?>
    <!--banner-->
  <!-- Start Bradcaump area -->
  <?php 
	$recent=Session::get('recent');
	$keyword=Session::get('keyword');
	$result=Session::get('result');
  ?>
  <div class="ht__bradcaump__area bg-image--6" style="background-image: url(../public/uploaded/slider/_anh609639bb6c63f4.05873655.jpg) !important">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="bradcaump__inner text-center">
					<h2 class="bradcaump-title">Keyword : <?php echo e($keyword); ?></h2>
					<nav class="bradcaump-content">
					  <a class="breadcrumb_item" href="<?php echo e(URL::to('/')); ?>">Home</a>
					  <span class="brd-separetor">/</span>
					  <span class="breadcrumb_item active">Tìm kiếm</span>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Bradcaump area -->
<!-- Start Blog Area -->
<div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 ">
				<div class="blog-page">
					<div class="page__header">
						<h2>Blogs</h2>
					</div>
					<!-- Start Single Post -->
					<?php if($result): ?>
					<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<article class="blog__post d-flex flex-wrap">
						<div class="thumb">
							<a href="<?php echo e(URL('/blog/chi-tiet/'.$blog->slug_name)); ?>">
								<img src="<?php echo e(URL('public/uploaded/blog/'.$blog->hinh_dai_dien)); ?>" alt="blog images">
							</a>
						</div>
						<div class="content">
							<h4><a href="<?php echo e(URL('/blog/chi-tiet/'.$blog->slug_name)); ?>"><?php echo e($blog->tieude); ?></a></h4>
							<ul class="post__meta">
								<?php $admin=DB::table('admin')->where('idAd',$blog->idAd)->first() ?>
								<li>Posts by : <a href="#"><?php echo e($admin->NameAd); ?></a></li>
								<li class="post_separator">/</li>
								<li><?php echo e(\Carbon\Carbon::parse($blog->create_date)->format('d/m/Y H:i:s')); ?></li>
							</ul>
							<p><?php echo $blog->gioithieu; ?></p>
							<div class="blog__btn">
								<a class="shopbtn" href="<?php echo e(URL('/blog/chi-tiet/'.$blog->slug_name)); ?>">read more</a>
							</div>
						</div>
					</article>
					<!-- End Single Post -->
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
					<?php endif; ?>
				</div>
				<ul class="wn__pagination">
					<li ><?php echo e($result->links('vendor.pagination.semantic-ui')); ?></li>
				</ul>
			</div>
			<div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
				<?php echo $__env->make('layout.sider_blog', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
			</div>
		</div>
	</div>
</div>
<!-- End Blog Area -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
	OnBook | Kết quả tìm kiếm bài viết
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\OnBook\resources\views/pages/blog_search.blade.php ENDPATH**/ ?>