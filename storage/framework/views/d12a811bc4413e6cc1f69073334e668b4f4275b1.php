
<div class="wn__sidebar">
    <!-- Start Single Widget -->
    <aside class="widget search_widget">
        <h3 class="widget-title">Search</h3>
        <form action="<?php echo e(URL::to('/blog/tim-kiem')); ?>" method="GET">
            <div class="form-input">
                <input type="text" name="keyword" placeholder="Search...">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </aside>
    <!-- End Single Widget -->
    <!-- Start Single Widget -->
    <aside class="widget recent_widget">
        <h3 class="widget-title">Recent</h3>
        <div class="recent-posts">
            <ul>
                <?php if($recent): ?>
                <?php $__currentLoopData = $recent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <div class="post-wrapper d-flex">
                        
                        <div class="content">
                            <h4><a href="<?php echo e(URL('/blog/chi-tiet/'.$post->slug_name)); ?>"><?php echo e($post->tieude); ?></a></h4>
                            <p><?php echo e(\Carbon\Carbon::parse($post->create_date)->format('d/m/Y H:i:s')); ?></p>
                        </div>
                    </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </ul>
        </div>
    </aside>
    <!-- End Single Widget -->
    
</div><?php /**PATH D:\wamp64\www\OnBook\resources\views/layout/sider_blog.blade.php ENDPATH**/ ?>