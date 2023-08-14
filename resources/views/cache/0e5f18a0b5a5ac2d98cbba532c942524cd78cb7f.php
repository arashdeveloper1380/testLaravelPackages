<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, th, td {
            border:1px solid black;
        }
    </style>
</head>
<body>

    <table>
        <tr>
            <th>#</th>
            <th>name</th>
            <th>mobile</th>
        </tr>
        <tbody>
            <?php $__currentLoopData = db()->table('users')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key +1); ?></td>
                    <td><?php echo e($value->name); ?></td>
                    <td><?php echo e($value->phone); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <!-- <?php if(hasSession('user_id')): ?>
        <?php echo e(getAuthUser()); ?>

    <?php endif; ?> -->

    <!-- <?php echo e(session()->get('user_id')); ?> -->

    <!-- <?php dd(db()->table('users')->where('id', 1)->first()->name); ?> -->
</body>
</html><?php /**PATH C:\xampp\htdocs\testLaravelPackages\resources\views/dashboard.blade.php ENDPATH**/ ?>