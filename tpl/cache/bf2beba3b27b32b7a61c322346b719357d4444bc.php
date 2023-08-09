<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo e(assets('css/style.css')); ?>">
</head>
<body>
    <?php echo e(getUsers([], 'id asc', '1')); ?> <br><br>
    <!-- <ul>
        <?php $__currentLoopData = getUsers(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($value->name); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
    </ul> -->
    
    <?php echo e($name); ?>

    <form action="/login" method="post">
        <input type="text" name="email" placeholder="Enter Email ..."><br><br>
        <input type="text" name="password" placeholder="Enter Password ..."><br><br>
        <input type="submit">
    </form>
    
</body>
</html><?php /**PATH C:\xampp\htdocs\testLaravelPackages\tpl/index.blade.php ENDPATH**/ ?>