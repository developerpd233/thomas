<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('app.tree')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Level</th>
            <th scope="col">Subscribers</th>
            <th scope="col">Status</th>
            <th scope="col">Total fees</th>
            <th scope="col">Total commissions</th>

        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="#"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></a>
                    <br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td>
                <?php $one = 0?>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    if ($user->is_active == 'YES') {
                        echo '&#9989';
                        $one++;
                    } else {
                        echo '&#x274C';
                    }?>
                    <br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    if ($user->is_active == 'YES') {
                        echo '$50';
                    } else {
                        echo 'Not paid';
                    }?>
                    <br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    if ($user->is_active == 'YES') {
                        echo '$5';
                    } else {
                        echo 'Null';
                    }?>
                    <br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td>

            </td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $second_level = $user->children?>
                    <?php $__currentLoopData = $second_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href=""><?php echo e($second->first_name); ?> <?php echo e($second->last_name); ?></a>
                        <br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td>
                <?php $two = 0 ?>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $second_level = $user->children?>
                    <?php $__currentLoopData = $second_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if ($second->is_active == 'YES') {
                            echo '&#9989';
                            $two++;
                        } else {
                            echo '&#x274C';
                        }?>
                        <br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $second_level = $user->children?>
                    <?php $__currentLoopData = $second_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if ($second->is_active == 'YES') {
                            echo '$50';
                        } else {
                            echo 'Not paid';
                        }?>
                        <br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $second_level = $user->children?>
                    <?php $__currentLoopData = $second_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if ($second->is_active == 'YES') {
                            echo '$5';
                        } else {
                            echo 'Null';
                        }?>
                        <br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td>

            </td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $second_level = $user->children?>
                    <?php $__currentLoopData = $second_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $third_level = $second->children?>
                        <?php $__currentLoopData = $third_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $third): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href=""><?php echo e($third->first_name); ?> <?php echo e($third->last_name); ?></a>
                            <br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td>
                <?php $three = 0?>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $second_level = $user->children?>
                    <?php $__currentLoopData = $second_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $third_level = $second->children?>
                        <?php $__currentLoopData = $third_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $third): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if ($third->is_active == 'YES') {
                                echo '&#9989';
                                $three++;
                            } else {
                                echo '&#x274C';
                            }?>
                            <br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $second_level = $user->children?>
                    <?php $__currentLoopData = $second_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $third_level = $second->children?>
                        <?php $__currentLoopData = $third_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $third): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if ($third->is_active == 'YES') {
                                echo '$50';
                            } else {
                                echo 'Not paid';
                            }?>
                            <br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $second_level = $user->children?>
                    <?php $__currentLoopData = $second_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $third_level = $second->children?>
                        <?php $__currentLoopData = $third_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $third): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if ($third->is_active == 'YES') {
                                echo '$5';
                            } else {
                                echo 'Null';
                            }?>
                            <br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td>

            </td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $second_level = $user->children?>
                    <?php $__currentLoopData = $second_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $third_level = $second->children?>
                        <?php $__currentLoopData = $third_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $third): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $forth_level = $third->children?>
                            <?php $__currentLoopData = $forth_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $forth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href=""><?php echo e($forth->first_name); ?> <?php echo e($forth->last_name); ?></a>
                                <br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td>
                <?php $four = 0?>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $second_level = $user->children?>
                    <?php $__currentLoopData = $second_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $third_level = $second->children?>
                        <?php $__currentLoopData = $third_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $third): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $forth_level = $third->children?>
                            <?php $__currentLoopData = $forth_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $forth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if ($forth->is_active == 'YES') {
                                    echo '&#9989';
                                    $four++;
                                } else {
                                    echo '&#x274C';
                                }?>
                                <br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $second_level = $user->children?>
                    <?php $__currentLoopData = $second_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $third_level = $second->children?>
                        <?php $__currentLoopData = $third_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $third): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $forth_level = $third->children?>
                            <?php $__currentLoopData = $forth_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $forth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if ($forth->is_active == 'YES') {
                                    echo '$50';
                                } else {
                                    echo 'Not paid';
                                }?>
                                <br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $second_level = $user->children?>
                    <?php $__currentLoopData = $second_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $third_level = $second->children?>
                        <?php $__currentLoopData = $third_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $third): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $forth_level = $third->children?>
                            <?php $__currentLoopData = $forth_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $forth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if ($forth->is_active == 'YES') {
                                    echo '$5';
                                } else {
                                    echo 'Null';
                                }?>
                                <br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td>

            </td>
        </tr>
        <?php $total = $one + $two + $three + $four;?>
        <tr>
            <th colspan="3" style="text-align: center;font-size: 2rem">Total</th>
            <td>
                $<?php echo e($total*50); ?>

            </td>
            <td>
                $<?php echo e($total*5); ?>

            </td>
            <td>
                <button type="button" class="btn btn-primary btn-xs">Payment</button>
            </td>
        </tr>
        </tbody>
    </table>
    <style>
        th {
            font-size: 1.8rem;
            color: black;
        }

        td {
            font-size: 1.7rem;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>