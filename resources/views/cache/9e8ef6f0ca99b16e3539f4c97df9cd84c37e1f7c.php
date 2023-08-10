

<?php $__env->startSection('content'); ?>

    <?php echo e(getData('users')); ?> <br><br>
    <?php echo e(findData('users', 1)['name']); ?> <br><br>
    <?php echo e($name); ?>

    <form action="/login" method="post">
        <input type="text" name="email" placeholder="Enter Email ..."><br><br>
        <input type="text" name="password" placeholder="Enter Password ..."><br><br>
        <input type="submit">
    </form>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\testLaravelPackages\resources\views/index.blade.php ENDPATH**/ ?>