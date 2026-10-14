this is blase file
<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <p><?php echo e($post->name); ?></p>
    <p><?php echo e($post->email); ?></p>
    <hr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php /**PATH /var/www/laravel/resources/views/posts/index.blade.php ENDPATH**/ ?>