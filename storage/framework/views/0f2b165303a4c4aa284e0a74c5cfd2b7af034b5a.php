<style>
    .myTable>tbody>.myTableRow>td {
        padding: 0px;
    }

    .myTable>tbody>.myTableRow>th {
        padding: 0px;
    }
</style>

<?php $__env->startSection('page_title'); ?>
<?php echo e(trans('app.tree')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<br>
<?php $count = 0 ?>
<?php

$comm = '$7.5';
$parentUser = $parent->toArray();
$parentUser = $parentUser[0];

$authUser = $user;
$countNewRegistrations = -2;



function ifRegisteredThisMonth($created_at) {
    $todayDateee = date("m-Y");
    $registerDate = date("m-Y", strtotime($created_at));
    $diff = ($todayDateee == $registerDate ? "true" : "false");
    return $diff;
}

?>
<form method="POST" action="<?php echo e(route('admin.user.details',['id' => $id])); ?>" accept-charset="UTF-8">
    <style>
        .datepicker table tr td span.disabled,
        .datepicker table tr td span.disabled:hover {
            opacity: 0.4;
        }
    </style>
    <ul class="form-validate-errors"></ul>
    <input name="_token" type="hidden" value="tMbnk4MfFSYMG732qG0w1i9V4cxPZOOnBEKscTwi">
    <input name="commission" type="hidden" value="<?php echo e($user_comission ==true?'true':'false'); ?>">
    <input name="commission_user_id" type="hidden" value="<?php echo e(isset($id)? $id :null); ?>">
    <div class="col-md-4">
        <input name="daterange" type="text" placeholder="select Month" autocomplete="off">&nbsp;&nbsp;<input class="btn btn-primary text-white" type="submit" id="btn_submit" value="Apply" disabled="disabled">&nbsp;&nbsp;<a href="<?php echo e(route('admin.user.details',['id' => $id])); ?>" class="btn btn-primary text-white">Reset</a>
    </div>
</form>

<div class="col-md-4">
    <?php if($month ==1): ?>
    <center>
        <h3>Month: <?php echo e((isset($currentMonth))? $currentMonth: ''); ?></h3>
    </center>
    <?php elseif($month ==2): ?>
    <center>
        <h3>Month: <?php echo e((isset($currentMonth))? $currentMonth: ''); ?> </h3>
    </center>
    <?php else: ?>
    <h2></h2>
    <?php endif; ?>
</div>

<script>
    $(function() {
        var enableDisableSubmitBtn = function(selectedMonth) {
            //var monthValue = $('input[name="daterange"]').val().trim();
            //alert(monthValue);
            var disableBtn = (selectedMonth.length == 0);
            $('#btn_submit').attr('disabled', disableBtn);
        }

        var tdate = new Date();
        var MM = tdate.getMonth(); //yields month
        var yyyy = tdate.getFullYear(); //yields year
        var currentDate = (MM) + " " + yyyy;

        $('input[name="daterange"]').datepicker({
            autoclose: true,
            format: "MM , yyyy",
            viewMode: "months",
            minViewMode: "months",
            startDate: "Sep 2020",
            endDate: currentDate,
            clearBtn: true,
        }).on('changeMonth', function(e) {
            var currMonth = new Date(e.date).getMonth() + 1;
            var currYear = String(e.date).split(" ")[3];
            var selectedMonth = (currMonth + "-" + currYear);
            enableDisableSubmitBtn(selectedMonth);
        });
    });
</script>
<?php //echo"<pre>";print_r($parent['0']->subscriber_commision);echo"</pre>";die(); 
?>
<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php $count++ ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if ($count) : ?>
    <a href="/group/send/<?php echo e($user->username); ?>" class="btn btn-primary text-white" type="button" style="float: right">
        Message All</a>
<?php endif; ?>
<?php if($user_comission == true): ?>
<a href="<?php echo e(url('admin/user/pay_commission')); ?>" class="btn btn-primary text-white" value="Back" style="margin-right: 5px; float: right;">Back</a>
<?php endif; ?>
<br>
<table class="table myTable">
    <thead class="thead-dark">
        <?php if ($count) : ?>
            <tr>
                <th scope="col">Level</th>
                <th scope='col'>SN</th>
                <th scope="col">Subscribers</th>
                <th scope="col">Status</th>
                <th scope="col">Total fees</th>
                <th scope="col">Total commissions</th>
                <th scope="col">Paid At</th>
                <th scope="col"></th>
            </tr>
    </thead>
    <tbody>
        <!--?php echo"<pre>";print_r($users);echo"</pre>";?-->
        
        <?php
            $count = 1;
            $level = 1;
            $one = 0;
        ?>
        <?php foreach ($users as $list) : ?>
            <?php if(!$final_filter): ?>
                <tr class="myTableRow">
                    <th><?php echo e($level); ?></th>
                    <td><?php echo e($count); ?></td>
                    <td><?php echo e($list->first_name." ". $list->last_name); ?></td>
                    <td><?php echo e(!$list->created_at? '__':$list->created_at); ?></td>
                    <td> <?php
                        if ($list->is_active == 'YES' && $list->isActiveByComission == 'NO') {
                            if(ifRegisteredThisMonth($list->created_at) == "true"){
                                $countNewRegistrations += 1;
                                //echo '&#x274C';                                   
                                if($list->subscriber_commision >= 50):
                                    echo '&#9989'; //right
                                    $one++;
                                else:
                                    echo '&#x274C';//wrong
                                endif;
                            }
                            else{
                                echo '&#9989'; //right 
                                $one++;
                            }
                        } else if ($list->is_active == 'YES' && $list->isActiveByComission == 'YES' && $list->subscriber_commision >= 50) {
                            $countNewRegistrations += 1;
                            echo '&#9989'; //right
                            $one++;
                        } else {
                            echo '&#x274C';//wrong
                        }                        
                        ?></td>
                    <td>
                        <?php
                        if ($list->is_active == 'YES' && $list->isActiveByComission == 'NO') {
                            if (ifRegisteredThisMonth($list->created_at) == "true") {
                                if($list->subscriber_commision >= 50):
                                    echo $amount;                                       
                                else:
                                    echo 'Not paid';
                                endif;
                            } else {
                                echo $amount;
                            }
                        } else if ($list->is_active == 'YES' && $list->isActiveByComission == 'YES' && $list->subscriber_commision >= 50) {    
                            echo $amount;                                       
                        } else {
                            echo 'Not paid';
                        }
                        ?>
                    </td>
                    <td> 
                        <?php
                        if ($list->is_active == 'YES' && $list->isActiveByComission == 'NO') {
                            if (ifRegisteredThisMonth($list->created_at) == "true") {
                                if($list->subscriber_commision >= 50):
                                    echo $comm;                                      
                                else:
                                    echo '0';
                                endif;
                            } else {
                                echo $comm;
                            }
                        } else if ($list->is_active == 'YES' && $list->isActiveByComission == 'YES' && $list->subscriber_commision >= 50) {
                            echo $comm;
                        } else {
                            echo '0';
                        }
                        ?>
                    </td>
                    <?php if($list->paid_at == null): ?>
                    <td id="<?php echo e($list->id); ?>">
                        <!-- <?php if($isAdmin): ?>
                        <?php if($isHistory): ?>
                        <button class="btn btn-warning btn-xs pay_amount" data-id="<?php echo e($list->id); ?>" data-history_saved_at="<?php echo e($list->history_saved_at); ?>" type="button" style="color: white">Paid</button>
                        <?php else: ?>
                        <button class="btn btn-warning btn-xs pay_amount" data-id="<?php echo e($list->id); ?>" data-history_saved_at="<?php echo e($list->history_saved_at); ?>" type="button" style="color: white" disabled>Paid</button>
                        <?php endif; ?>
                        <?php else: ?>
                        <?php echo e('___'); ?>

                        <?php endif; ?> -->
                        <button class="btn btn-warning btn-xs"  type="button" style="color: white" disabled>Paid</button>
                    </td>
                    <?php else: ?>
                    <td id="<?php echo e($list->id); ?>"><?php echo e((new \DateTime($list->paid_at))->format('d-M-Y')); ?></td>
                    <?php endif; ?>
                    <td>
                        <a href="/message/<?php echo e($user->username); ?>" class="btn btn-primary btn-xs" type="button" style="color: white">Message</a>
                    </td>
                </tr>
                <?php
                $count++;
                $level = "";
                ?>
                <?php elseif( date('Y-m', strtotime($list->created_at)) == date('Y-m', strtotime($final_filter)) ): ?>
                    <tr class="myTableRow">
                        <th><?php echo e($level); ?></th>
                        <td><?php echo e($count); ?></td>
                        <td><?php echo e($list->first_name." ". $list->last_name); ?></td>
                        <td><?php echo e(!$list->created_at? '__':$list->created_at); ?></td>
                        <td> <?php
                            if ($list->is_active == 'YES') {

                                if(ifRegisteredThisMonth($list->created_at) == "true"){
                                    $countNewRegistrations += 1;
                                    //echo '&#x274C';                                   
                                    if($list->subscriber_commision >= 50):
                                        echo '&#9989'; //right
                                        $one++;
                                    else:
                                        echo '&#x274C';//wrong
                                    endif;
                                }
                                else{
                                    echo '&#9989'; //right 
                                    $one++;
                                }

                            } else {
                                echo '&#x274C';//&#x274C
                            }

                            ?></td>
                        <td>
                            <?php
                            if ($list->is_active == 'YES') {                            
                                if (ifRegisteredThisMonth($list->created_at) == "true") {
                                    if($list->subscriber_commision >= 50):
                                        echo $amount;                                       
                                    else:
                                        echo 'Not paid';
                                    endif;
                                } else {
                                    echo $amount;
                                }
                            } else {
                                echo 'Not paid';
                            }
                            ?>
                        </td>
                        <td> 
                            <?php
                            if ($list->is_active == 'YES') {                            
                                if (ifRegisteredThisMonth($list->created_at) == "true") {
                                    if($list->subscriber_commision >= 50):
                                        echo $comm;                                      
                                    else:
                                        echo '0';
                                    endif;
                                } else {
                                    echo $comm;
                                }
                            } else {
                                echo '0';
                            }
                            ?>
                        </td>
                        <?php if($list->paid_at == null): ?>
                        <td id="<?php echo e($list->id); ?>">
                            <!-- <?php if($isAdmin): ?>
                            <?php if($isHistory): ?>
                            <button class="btn btn-warning btn-xs pay_amount" data-id="<?php echo e($list->id); ?>" data-history_saved_at="<?php echo e($list->history_saved_at); ?>" type="button" style="color: white">Paid</button>
                            <?php else: ?>
                            <button class="btn btn-warning btn-xs pay_amount" data-id="<?php echo e($list->id); ?>" data-history_saved_at="<?php echo e($list->history_saved_at); ?>" type="button" style="color: white" disabled>Paid</button>
                            <?php endif; ?>
                            <?php else: ?>
                            <?php echo e('___'); ?>

                            <?php endif; ?> -->
                            <button class="btn btn-warning btn-xs"  type="button" style="color: white" disabled>Paid</button>
                        </td>
                        <?php else: ?>
                        <td id="<?php echo e($list->id); ?>"><?php echo e((new \DateTime($list->paid_at))->format('d-M-Y')); ?></td>
                        <?php endif; ?>
                        <td>
                            <a href="/message/<?php echo e($user->username); ?>" class="btn btn-primary btn-xs" type="button" style="color: white">Message</a>
                        </td>
                    </tr>
                    <?php
                    $count++;
                    $level = "";
                    ?>
                <?php endif; ?>
        <?php endforeach; ?>



        
        <tr>
            <td colspan="7"></td>
        </tr>
        <?php
            $count1 = 1;
            $secondLevel = 2;
            $two = 0;
        ?>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $second_level = $user->children ?>
                <?php $__currentLoopData = $second_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!$final_filter): ?>
                    <tr class="myTableRow">
                        <th><?php echo e($secondLevel); ?></th>
                        <td><?php echo $count1 ?></td>
                        <td><?php echo e($second->first_name." ".$second->last_name); ?></td>
                        <td><?php echo e(!$second->created_at? '__':$second->created_at); ?></td>
                        <td> 
                            <?php
                            if ($second->is_active == 'YES' && $second->isActiveByComission == 'NO') {                            
                                if (ifRegisteredThisMonth($second->created_at) == "true") {
                                    if($second->subscriber_commision >= 50):
                                        echo '&#9989'; //right
                                        $two++;
                                    else:
                                        echo '&#x274C';//wrong
                                    endif;
                                } else {
                                    echo '&#9989'; //right 
                                    $two++;
                                }
                            } else if ($second->is_active == 'YES' && $second->isActiveByComission == 'YES' && $second->subscriber_commision >= 50) {
                                echo '&#9989'; //right 
                                $two++;
                            } else {
                                echo '&#x274C'; //wrong
                            }                                
                            ?>
                        </td>
                        <td> 
                            <?php
                            if ($second->is_active == 'YES' && $second->isActiveByComission == 'NO') {                            
                                if (ifRegisteredThisMonth($second->created_at) == "true") {
                                    if($second->subscriber_commision >= 50):
                                        echo $amount;                                       
                                    else:
                                        echo 'Not paid';
                                    endif;
                                } else {
                                    echo $amount;
                                }
                            } else if ($second->is_active == 'YES' && $second->isActiveByComission == 'YES' && $second->subscriber_commision >= 50) {
                                    echo $amount;
                            } else {
                                echo 'Not paid';
                            }
                            ?>
                        </td>
                        <td> 
                            <?php
                            if ($second->is_active == 'YES' && $second->isActiveByComission == 'NO') {                            
                                if (ifRegisteredThisMonth($second->created_at) == "true") {
                                    if($second->subscriber_commision >= 50):
                                        echo $comm;                                      
                                    else:
                                        echo '0';
                                    endif;
                                } else {
                                    echo $comm;
                                }
                            } else if ($second->is_active == 'YES' && $second->isActiveByComission == 'YES' && $second->subscriber_commision >= 50) {
                                echo $comm;
                            } else {
                                echo '0';
                            }
                            ?>
                        </td>
                        <?php if($second->paid_at == null): ?>
                        <td id="<?php echo e($second->id); ?>">
                            <button class="btn btn-warning btn-xs"  type="button" style="color: white" disabled>Paid</button>
                        </td>
                        <?php else: ?>
                        <td id="<?php echo e($second->id); ?>"><?php echo e((new \DateTime($second->paid_at))->format('d-M-Y')); ?></td>
                        <?php endif; ?>
                        <td>
                            <a href="/message/<?php echo e($second->username); ?>" class="btn btn-primary btn-xs" type="button" style="color: white">Message</a>
                        </td>
                    </tr>
                    <?php
                    $count1++;
                    $secondLevel = "";
                    ?>
                <?php elseif( date('Y-m', strtotime($second->created_at)) == date('Y-m', strtotime($final_filter)) ): ?>    
                    <tr class="myTableRow">
                        <th><?php echo e($secondLevel); ?></th>
                        <td><?php echo $count1 ?></td>
                        <td><?php echo e($second->first_name." ".$second->last_name); ?></td>
                        <td><?php echo e(!$second->created_at? '__':$second->created_at); ?></td>
                        <td> 
                            <?php
                            if ($second->is_active == 'YES') {                            
                                if (ifRegisteredThisMonth($second->created_at) == "true") {
                                    if($second->subscriber_commision >= 50):
                                        echo '&#9989'; //right
                                        $two++;
                                    else:
                                        echo '&#x274C';//wrong
                                    endif;
                                } else {
                                    echo '&#9989'; //right 
                                    $two++;
                                }
                            } else {
                                echo '&#x274C'; //wrong
                            }                                
                            ?>
                        </td>
                        <td> 
                            <?php
                            if ($second->is_active == 'YES') {                            
                                if (ifRegisteredThisMonth($second->created_at) == "true") {
                                    if($second->subscriber_commision >= 50):
                                        echo $amount;                                       
                                    else:
                                        echo 'Not paid';
                                    endif;
                                } else {
                                    echo $amount;
                                }
                            } else {
                                echo 'Not paid';
                            }
                            ?>
                        </td>
                        <td> 
                            <?php
                            if ($second->is_active == 'YES') {                            
                                if (ifRegisteredThisMonth($second->created_at) == "true") {
                                    if($second->subscriber_commision >= 50):
                                        echo $comm;                                      
                                    else:
                                        echo '0';
                                    endif;
                                } else {
                                    echo $comm;
                                }
                            } else {
                                echo '0';
                            }
                            ?>
                        </td>
                        <?php if($second->paid_at == null): ?>
                        <td id="<?php echo e($second->id); ?>">
                            <button class="btn btn-warning btn-xs"  type="button" style="color: white" disabled>Paid</button>
                        </td>
                        <?php else: ?>
                        <td id="<?php echo e($second->id); ?>"><?php echo e((new \DateTime($second->paid_at))->format('d-M-Y')); ?></td>
                        <?php endif; ?>
                        <td>
                            <a href="/message/<?php echo e($second->username); ?>" class="btn btn-primary btn-xs" type="button" style="color: white">Message</a>
                        </td>
                    </tr>
                    <?php
                    $count1++;
                    $secondLevel = "";
                    ?>
                <?php endif; ?>    
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



        
        <tr>
            <td colspan="7"></td>
        </tr>
        <?php
            $levelThree = 3;
            $count2 = 0;
            $three = 0;
        ?>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $second_level = $user->children; ?>
                <?php $__currentLoopData = $second_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $third_level = $second->children ?>
                    <?php $__currentLoopData = $third_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $third): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!$final_filter): ?>
                            <tr class="myTableRow">
                                <th><?php echo e($levelThree); ?></th>
                                <td><?php echo e(++$count2); ?></td>
                                <td><?php echo e($third->first_name." ".$third->last_name); ?></td>
                                <td><?php echo e(!$third->created_at? '__':$third->created_at); ?></td>
                                <td> 
                                    <?php
                                    if ($third->is_active == 'YES' && $third->isActiveByComission == 'NO') {
                                        if (ifRegisteredThisMonth($third->created_at) == "true") {
                                            if($third->subscriber_commision >= 50):
                                                echo '&#9989'; //right
                                                $three++;
                                            else:
                                                echo '&#x274C';//wrong
                                            endif;
                                        } else {
                                            echo '&#9989'; //right 
                                            $three++;
                                        }
                                    } else if ($third->is_active == 'YES' && $third->isActiveByComission == 'YES' && $third->subscriber_commision >= 50) {
                                        echo '&#9989'; //right 
                                        $three++;
                                    } else {
                                        echo '&#x274C'; //wrong
                                    }
                                    ?>
                                </td>
                                <td> 
                                    <?php
                                    if ($third->is_active == 'YES' && $third->isActiveByComission == 'NO') {
                                        if (ifRegisteredThisMonth($third->created_at) == "true") {
                                            if($third->subscriber_commision >= 50):
                                                echo $amount;                                       
                                            else:
                                                echo 'Not paid';
                                            endif;
                                        } else {
                                            echo $amount;
                                        }
                                    } else if ($third->is_active == 'YES' && $third->isActiveByComission == 'YES' && $third->subscriber_commision >= 50) {    
                                        echo $amount;
                                    } else {
                                        echo 'Not paid';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($third->is_active == 'YES' && $third->isActiveByComission == 'NO') {
                                        if (ifRegisteredThisMonth($third->created_at) == "true") {
                                            if($third->subscriber_commision >= 50):
                                                echo $comm;                                      
                                            else:
                                                echo '0';
                                            endif;
                                        } else {
                                            echo $comm;
                                        }
                                    } else if ($third->is_active == 'YES' && $third->isActiveByComission == 'YES' && $third->subscriber_commision >= 50) {
                                        echo $comm;
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </td>
                                <?php if($third->paid_at == null): ?>
                                <td id="<?php echo e($third->id); ?>">
                                    <button class="btn btn-warning btn-xs"  type="button" style="color: white" disabled>Paid</button>
                                </td>
                                <?php else: ?>
                                <td id="<?php echo e($third->id); ?>"><?php echo e((new \DateTime($third->paid_at))->format('d-M-Y')); ?></td>
                                <?php endif; ?>
                                <td>
                                    <a href="/message/<?php echo e($third->username); ?>" class="btn btn-primary btn-xs" type="button" style="color: white">Message</a>
                                </td>
                            </tr>     
                            <?php $levelThree = "" ?>
                        <?php elseif( date('Y-m', strtotime($third->created_at)) == date('Y-m', strtotime($final_filter)) ): ?>
                            <tr class="myTableRow">
                                <th><?php echo e($levelThree); ?></th>
                                <td><?php echo e(++$count2); ?></td>
                                <td><?php echo e($third->first_name." ".$third->last_name); ?></td>
                                <td><?php echo e(!$third->created_at? '__':$third->created_at); ?></td>
                                <td> 
                                    <?php
                                    if ($third->is_active == 'YES') {                            
                                        if (ifRegisteredThisMonth($third->created_at) == "true") {
                                            if($third->subscriber_commision >= 50):
                                                echo '&#9989'; //right
                                                $three++;
                                            else:
                                                echo '&#x274C';//wrong
                                            endif;
                                        } else {
                                            echo '&#9989'; //right 
                                            $three++;
                                        }
                                    } else {
                                        echo '&#x274C'; //wrong
                                    }
                                    ?>
                                </td>
                                <td> 
                                    <?php
                                    if ($third->is_active == 'YES') {
                                        if (ifRegisteredThisMonth($third->created_at) == "true") {
                                            if($third->subscriber_commision >= 50):
                                                echo $amount;                                       
                                            else:
                                                echo 'Not paid';
                                            endif;
                                        } else {
                                            echo $amount;
                                        }
                                    } else {
                                        echo 'Not paid';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($third->is_active == 'YES') {
                                        if (ifRegisteredThisMonth($third->created_at) == "true") {
                                            if($third->subscriber_commision >= 50):
                                                echo $comm;                                      
                                            else:
                                                echo '0';
                                            endif;
                                        } else {
                                            echo $comm;
                                        }
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </td>
                                <?php if($third->paid_at == null): ?>
                                <td id="<?php echo e($third->id); ?>">
                                    <button class="btn btn-warning btn-xs"  type="button" style="color: white" disabled>Paid</button>
                                </td>
                                <?php else: ?>
                                <td id="<?php echo e($third->id); ?>"><?php echo e((new \DateTime($third->paid_at))->format('d-M-Y')); ?></td>
                                <?php endif; ?>
                                <td>
                                    <a href="/message/<?php echo e($third->username); ?>" class="btn btn-primary btn-xs" type="button" style="color: white">Message</a>
                                </td>
                            </tr>
                            <?php $levelThree = "" ?>    
                        <?php endif; ?>                                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



        
        <tr>
            <td colspan="7"></td>
        </tr>
        <?php
            $levelFour = 4;
            $count3 = 0;
            $four = 0
        ?>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $second_level = $user->children ?>
            <?php $__currentLoopData = $second_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $second): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $third_level = $second->children ?>
                <?php $__currentLoopData = $third_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $third): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $forth_level = $third->children ?>
                    <?php $__currentLoopData = $forth_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $forth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!$final_filter): ?>
                            <tr class="myTableRow">
                                <th><?php echo e($levelFour); ?></th>
                                <td><?php echo e(++$count3); ?></td>
                                <td><?php echo e($forth->first_name." ".$forth->last_name); ?></td>
                                <td><?php echo e(!$forth->created_at? '__':$forth->created_at); ?></td>
                                <td>
                                    <?php
                                    if ($forth->is_active == 'YES' && $forth->isActiveByComission == 'NO') {
                                        if (ifRegisteredThisMonth($forth->created_at) == "true") {
                                            if($forth->subscriber_commision >= 50):
                                                echo '&#9989'; //right
                                                $four++;
                                            else:
                                                echo '&#x274C';//wrong
                                            endif;
                                        } else {
                                            echo '&#9989'; //right 
                                            $four++;
                                        }
                                    } else if ($forth->is_active == 'YES' && $forth->isActiveByComission == 'YES' && $forth->subscriber_commision >= 50) {    
                                        echo '&#9989'; //right 
                                        $four++;
                                    } else {
                                        echo '&#x274C'; //wrong
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($forth->is_active == 'YES' && $forth->isActiveByComission == 'NO') {
                                        if (ifRegisteredThisMonth($forth->created_at) == "true") {
                                            if($forth->subscriber_commision >= 50):
                                                echo $amount;                                       
                                            else:
                                                echo 'Not paid';
                                            endif;
                                        } else {
                                            echo $amount;
                                        }
                                    } else if ($forth->is_active == 'YES' && $forth->isActiveByComission == 'YES' && $forth->subscriber_commision >= 50) {
                                        echo $amount;
                                    } else {
                                        echo 'Not paid';
                                    }    
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($forth->is_active == 'YES' && $forth->isActiveByComission == 'NO') {
                                        if (ifRegisteredThisMonth($forth->created_at) == "true") {
                                            if($forth->subscriber_commision >= 50):
                                                echo $comm;                                      
                                            else:
                                                echo '0';
                                            endif;
                                        } else {
                                            echo $comm;
                                        }
                                    } else if ($forth->is_active == 'YES' && $forth->isActiveByComission == 'YES' && $forth->subscriber_commision >= 50) {
                                        echo $comm;
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </td>
                                <?php if($forth->paid_at == null): ?>
                                <td id="<?php echo e($forth->id); ?>">
                                    <button class="btn btn-warning btn-xs"  type="button" style="color: white" disabled>Paid</button>
                                </td>
                                <?php else: ?>
                                <td id="<?php echo e($forth->id); ?>"><?php echo e((new \DateTime($forth->paid_at))->format('d-M-Y')); ?></td>
                                <?php endif; ?>
                                <td><a href="/message/<?php echo e($forth->username); ?>" class="btn btn-primary btn-xs" type="button" style="color: white">Message</a>
                                </td>
                            </tr>
                            <?php $levelFour = "";?>
                        <?php elseif( date('Y-m', strtotime($forth->created_at)) == date('Y-m', strtotime($final_filter)) ): ?>
                           <tr class="myTableRow">
                                <th><?php echo e($levelFour); ?></th>
                                <td><?php echo e(++$count3); ?></td>
                                <td><?php echo e($forth->first_name." ".$forth->last_name); ?></td>
                                <td><?php echo e(!$forth->created_at? '__':$forth->created_at); ?></td>
                                <td>
                                    <?php
                                    if ($forth->is_active == 'YES') {                            
                                        if (ifRegisteredThisMonth($forth->created_at) == "true") {
                                            if($forth->subscriber_commision >= 50):
                                                echo '&#9989'; //right
                                                $four++;
                                            else:
                                                echo '&#x274C';//wrong
                                            endif;
                                        } else {
                                            echo '&#9989'; //right 
                                            $four++;
                                        }
                                    } else {
                                        echo '&#x274C'; //wrong
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($forth->is_active == 'YES') {                            
                                        if (ifRegisteredThisMonth($forth->created_at) == "true") {
                                            if($forth->subscriber_commision >= 50):
                                                echo $amount;                                       
                                            else:
                                                echo 'Not paid';
                                            endif;
                                        } else {
                                            echo $amount;
                                        }
                                    } else {
                                        echo 'Not paid';
                                    }    
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($forth->is_active == 'YES') {                            
                                        if (ifRegisteredThisMonth($forth->created_at) == "true") {
                                            if($forth->subscriber_commision >= 50):
                                                echo $comm;                                      
                                            else:
                                                echo '0';
                                            endif;
                                        } else {
                                            echo $comm;
                                        }
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </td>
                                <?php if($forth->paid_at == null): ?>
                                <td id="<?php echo e($forth->id); ?>">
                                    <button class="btn btn-warning btn-xs"  type="button" style="color: white" disabled>Paid</button>
                                </td>
                                <?php else: ?>
                                <td id="<?php echo e($forth->id); ?>"><?php echo e((new \DateTime($forth->paid_at))->format('d-M-Y')); ?></td>
                                <?php endif; ?>
                                <td><a href="/message/<?php echo e($forth->username); ?>" class="btn btn-primary btn-xs" type="button" style="color: white">Message</a>
                                </td>
                            </tr>
                           <?php $levelFour = ""; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                            
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        
        <?php $total = $one + $two + $three + $four; ?>
        <?php if(ifRegisteredThisMonth($parent['0']->created_at) == "true"): //if user registered for this month?>     
            <tr>
                <th colspan="3" style="text-align: center;font-size: 2rem">Monthly Fees Through Subscriptions</th>
                <!-- Right/wrong arrow -->
                <td style="font-size: 2rem">
                    <?php
                    if ($countNewRegistrations >= 0 || $parentUser['is_active'] == 'YES') {
                        echo '&#9989';                        
                    } else {
                        echo '&#x274C';
                    }
                    ?>
                </td>
                <!-- Total fees -->
                <td style="font-size: 2rem">$0</td>
                <!-- Total commissions -->
                <td style="font-size: 2rem">
                    <?php
                    if ($countNewRegistrations >= 0 && $parentUser['is_active'] == 'YES' ) {
                            echo $amount;                        
                    } else {
                        echo 'Not Paid';
                    }
                    ?>                
                </td>
                <td style="font-size: 2rem">
                    <?php
                        if ($countNewRegistrations > 0) {
                            $canWithDrawn = (($countNewRegistrations) * 25);
                            if($canWithDrawn > 0):
                                echo '$'.((int)$canWithDrawn);
                            endif;
                        }
                    ?>                    
                </td>
            </tr>
        <?php else:  //if user not registered for this month?>
            <tr>
                <th colspan="3" style="text-align: center;font-size: 2rem">Monthly Fees Through Subscriptions</th>
                <!-- Right/wrong arrow -->
                <td style="font-size: 2rem">
                    <?php     
                    if ($countNewRegistrations >= 0 || $parentUser['is_active'] == 'YES') {
                        echo '&#9989';                        
                    } else {
                        echo '&#x274C';
                    }                    
                    ?>
                </td>
                <!-- Total fees -->
                <td style="font-size: 2rem">
                    <?php                    
                    if ($countNewRegistrations >= 0 || $parentUser['is_active'] == 'YES') {
                        echo $amount;                        
                    } else {
                        echo 'Not Paid';
                    }
                    ?>                
                </td>
                <!-- Total commissions -->
                <td style="font-size: 2rem">
                    <?php   
                        if ($countNewRegistrations >= 0 && $parentUser['subscriber_commision'] >= 50 ) {
                            if($parentUser['subscriber_commision'] >= 50){
                                echo '$50';
                            }else {
                                $totaComission = ( ($countNewRegistrations) * 25);
                                echo '$'.$totaComission;
                            }
                        } else if($countNewRegistrations >= 0 && $parentUser['is_active'] == 'YES' && $parentUser['isActiveByComission'] == 'NO' ){
                            echo '$50';
                        } else {
                            echo '$0';
                        }
                    ?>                
                </td>
                <!-- User can with drawn -->
                <td style="font-size: 2rem">
                    <?php
                        if ($parentUser['subscriber_commision'] > 50) :
                            $canWithDrawn = ($parentUser['subscriber_commision'] - 50);
                            echo '$'.((int)$canWithDrawn);
                        endif;
                        /*if ($countNewRegistrations > 2) {
                            $canWithDrawn = (($countNewRegistrations - 2) * 25);
                            if($canWithDrawn > 0):
                                echo '$'.((int)$canWithDrawn);
                            endif;
                        }*/
                    ?>                    
                </td>
            </tr>
        <?php endif; ?>                
        <tr>
            <th colspan="3" style="text-align: center;font-size: 2rem">Total Fees Paid by Subscribers(4 Levels)</th>
            <td colspan="3" style="text-align: center;font-size: 2rem">
                <?php if(env('SITE') == 'ENG'): ?>
                $<?php echo e($total*50); ?>

                <?php else: ?>
                <?php echo e($total*1000); ?>F
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th colspan="3" style="text-align: center;font-size: 2rem">Total Commission at 4 levels(15% at each level)</th>
            <td colspan="3" style="text-align: center;font-size: 2rem">
                <?php if(env('SITE') == 'ENG'): ?>
                <?php $commission_perc = (50*15)/100; ?>
                $<?php echo e($total*$commission_perc); ?>

                <?php else: ?>
                <?php $commission_perc = (1000*15)/100; ?>
                <?php echo e($total*$commission_perc); ?>

                <?php endif; ?>
            </td>
        </tr>
        <?php 
        /*For those user who pays fees */
        elseif($countNewRegistrations == -2 && $parentUser['is_active'] == 'YES' && $parentUser['isActiveByComission'] == 'NO' && empty($final_filter)): ?>        
            <tr>
                <th scope="col">Level</th>
                <th scope='col'>SN</th>
                <th scope="col">Subscribers</th>
                <th scope="col">Status</th>
                <th scope="col">Total fees</th>
                <th scope="col">Total commissions</th>
                <th scope="col">Paid At</th>
                <th scope="col"></th>
            </tr>
            <?php if(ifRegisteredThisMonth($parent['0']->created_at) == "true"): //if user registered for this month?>
                <tr>
                    <th colspan="3" style="text-align: center;font-size: 2rem">Monthly Fees Through Subscriptions</th>
                    <!-- Right/wrong arrow -->
                    <td style="font-size: 2rem">
                        <?php echo '&#9989'; ?>
                    </td>
                    <!-- Total fees -->
                    <td style="font-size: 2rem">$0</td>
                    <!-- Total commissions -->
                    <td style="font-size: 2rem"></td>
                    <!-- User can with drawn -->
                    <td style="font-size: 2rem"></td>
                </tr>
            <?php else:  //if user not registered for this month ?>     
                <tr>
                    <th colspan="3" style="text-align: center;font-size: 2rem">Monthly Fees Through Subscriptions</th>
                    <!-- Right/wrong arrow -->
                    <td style="font-size: 2rem">
                        <?php echo '&#9989'; ?>
                    </td>
                    <!-- Total fees -->
                    <td style="font-size: 2rem">
                        <?php echo '$50'; ?>
                    </td>
                    <!-- Total commissions -->
                    <td style="font-size: 2rem">
                        <?php echo '$0'; ?>
                    </td>
                    <!-- User can with drawn -->
                    <td style="font-size: 2rem"></td>
                </tr>
            <?php endif; ?>
                <tr>
                    <th colspan="3" style="text-align: center;font-size: 2rem">Total Fees Paid by Subscribers(4 Levels)</th>
                    <td colspan="3" style="text-align: center;font-size: 2rem">$0</td>
                </tr>
                <tr>
                    <th colspan="3" style="text-align: center;font-size: 2rem">Total Commission at 4 levels(15% at each level)</th>
                    <td colspan="3" style="text-align: center;font-size: 2rem">$0.0</td>
                </tr>
    <?php else: ?>
        <h1>Users don't have any subscriber</h1>
    <?php endif; ?>
    </tbody>
</table>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>