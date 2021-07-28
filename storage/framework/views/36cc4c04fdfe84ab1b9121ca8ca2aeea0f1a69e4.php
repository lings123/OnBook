<?php  
$listtype=Session::get('type') ; 
$listAu=Session::get('author');
$listPub=Session::get('publisher');
$listTop=DB::table('books')->orderBy('diem','DESC')->limit(10)->get();

?>

<div class="shop__sidebar">
    <aside class="wedget__categories poroduct--cat">
        <h3 class="wedget__title">TOP 10 BOOKS BY REVIEW</h3>
        <ul><?php $stt=0; ?>
            <?php $__currentLoopData = $listTop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><span class="badge "> <?php echo e(++$stt); ?></span><a href="<?php echo e(URL::to('/chi-tiet/'.$top->slug_name)); ?>"><?php echo e($top->NameBook); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        </ul>
    </aside>
    <aside class="wedget__categories poroduct--cat">
        <h3 class="wedget__title">Tình trạng</h3>
        <ul>
            <li><a href="<?php echo e(URL::to('/tinh-trang/new')); ?>" >NEW<span></a></li>
            <li><a href="<?php echo e(URL::to('/tinh-trang/sale')); ?>">SALE<span></a></li>
        </ul>
    </aside>

    <aside class="wedget__categories poroduct--cat">
        <h3 class="wedget__title">Thể loại sách</h3>
        <ul>
            <?php $__currentLoopData = $listtype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><a href="<?php echo e(URL::to('/the-loai/'.$type->idType)); ?>"><?php echo e($type->nameType); ?><span>
                <?php $book=DB::table('books')->where('idType',$type->idType)->count(); ?>
                (<?php echo e($book); ?>)</span></a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        </ul>
    </aside>
    <aside class="wedget__categories poroduct--cat">
        <h3 class="wedget__title">Nhà xuất bản</h3>
        <ul>
            <?php $__currentLoopData = $listPub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Pub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><a href="<?php echo e(URL::to('/nha-xuat-ban/'.$Pub->idPub)); ?>"><?php echo e($Pub->namePub); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </aside>

</div><?php /**PATH D:\wamp64\www\OnBook\resources\views/layout/sider.blade.php ENDPATH**/ ?>