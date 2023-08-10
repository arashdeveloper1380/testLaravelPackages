<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <?php if(hasSession('user_id')): ?>
        <?php echo e(getAuthUser()); ?>

    <?php endif; ?> -->

    <?php echo e(session()->get('user_id')); ?>

</body>
</html><?php /**PATH C:\xampp\htdocs\testLaravelPackages\resources\views/dashboard.blade.php ENDPATH**/ ?>