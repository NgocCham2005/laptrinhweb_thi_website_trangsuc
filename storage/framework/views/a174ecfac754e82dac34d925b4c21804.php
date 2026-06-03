<?php $__env->startSection('content'); ?>

<section class="product-detail">

    <!-- BREADCRUMB -->
    <div class="breadcrumb">
        <a href="<?php echo e(route('products.index')); ?>">Sản phẩm</a>
        <span>/</span>
        <a href="<?php echo e(route('products.index', ['category' => $product->MaDanhMuc])); ?>">
            <?php echo e($product->category->TenDanhMuc); ?></a>
        <span>/</span>
        <p><?php echo e($product->TenSanPham); ?></p>
    </div>

    <!-- Thông tin chung -->
    <div class="product-top">
        <div class="product-gallery">
            <div class="main-image">
                <img id="mainProductImage" src="<?php echo e(asset('images/products/' .$product->images[0]->DuongDan)); ?>">
            </div>
            <div class="thumbnail-list">
                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="thumbnail
                        <?php echo e($index === 0 ? 'active' : ''); ?>">
                        <img src="<?php echo e(asset('images/products/' .$image->DuongDan)); ?>">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="product-info-wrapper">
            <?php if (isset($component)) { $__componentOriginal29b95272c5ad89a7d1391f326b8c01b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal29b95272c5ad89a7d1391f326b8c01b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-info','data' => ['product' => $product]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-info'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal29b95272c5ad89a7d1391f326b8c01b1)): ?>
<?php $attributes = $__attributesOriginal29b95272c5ad89a7d1391f326b8c01b1; ?>
<?php unset($__attributesOriginal29b95272c5ad89a7d1391f326b8c01b1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal29b95272c5ad89a7d1391f326b8c01b1)): ?>
<?php $component = $__componentOriginal29b95272c5ad89a7d1391f326b8c01b1; ?>
<?php unset($__componentOriginal29b95272c5ad89a7d1391f326b8c01b1); ?>
<?php endif; ?>
            <div class="banner-con">
                <img src="<?php echo e(asset('images/banner-con.jpg')); ?>">
            </div>
        </div>
    </div>

    <!-- Mô tả sản phẩm -->
    <div class="product-description">
        <div class="section-title">
            <h2>MÔ TẢ SẢN PHẨM</h2>
        </div>
        <div class="description-content">
            <p><?php echo e($product->MoTa); ?></p>
        </div>
    </div>

    <div class="section-title">
        <h2>ĐÁNH GIÁ SẢN PHẨM</h2>
    </div>
    <div class="review-box">
        <?php if($product->reviews->count() >0): ?>
            <?php $__currentLoopData = $product->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="review-item">
                    <div class="review-avatar">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="review-content">
                    <h4>
                        <?php echo e($review->MaTaiKhoan); ?>

                    </h4>
                    <!-- STAR -->
                    <div class="review-stars">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                            <?php if($i <= $review->XepHang): ?>
                                ★
                            <?php else: ?>
                                ☆
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <p>
                        <?php echo e($review->BinhLuan); ?>

                    </p>
                    <!-- REPLY -->
                    <?php $__currentLoopData = $review->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="admin-reply">
                            <strong>Shop phản hồi:</strong>
                            <p>
                                <?php echo e($reply->NoiDungPhanHoi); ?>

                            </p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <div class="review-line"></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="empty-review">
                <i class="fa-regular fa-comment-dots"></i>
                <p>Chưa có đánh giá nào cho sản phẩm này.</p>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- <form action="<?php echo e(route('review.store')); ?>" method="POST" class="review-form">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="product_id" value="<?php echo e($product->MaSanPham); ?>">
        <select name="rating">
            <option value="5">5 sao</option>
            <option value="4">4 sao</option>
            <option value="3">3 sao</option>
            <option value="2">2 sao</option>
            <option value="1">1 sao</option>
        </select>

        <input type="text" name="comment" placeholder="Viết đánh giá...">
            <button type="submit">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
    </form> -->

    <!-- Sản phẩm tương tự -->
    <div class="related-products">
        <div class="related-header">
            <h2>SẢN PHẨM TƯƠNG TỰ</h2>
            <a href="<?php echo e(route('products.index', ['category' => $product->MaDanhMuc])); ?>">
                Xem thêm    
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        <div class="related-grid">
            <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-card','data' => ['product' => $item]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a)): ?>
<?php $attributes = $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a; ?>
<?php unset($__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a)): ?>
<?php $component = $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a; ?>
<?php unset($__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <script>
        const thumbnails =document.querySelectorAll('.thumbnail img');
        const mainImage =document.getElementById('mainProductImage');
        thumbnails.forEach(item => {
            item.addEventListener('click', function(){
                mainImage.src = this.src;
            });
        });
    </script>

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\website_trangsuc\laptrinhweb_thi_website_trangsuc\resources\views/products/detail.blade.php ENDPATH**/ ?>