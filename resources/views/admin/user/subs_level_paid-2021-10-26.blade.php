@extends('layouts.backend.default')
<style>
    .myTable>tbody>.myTableRow>td {
        padding: 0px;
    }

    .myTable>tbody>.myTableRow>th {
        padding: 0px;
    }
</style>

@section('page_title')
{{ trans('app.tree') }}
@endsection

@section('content')
<br>
<?php $count = 0 ?>
<?php
$authUser = $user;
$countNewRegistrations = -2;

//echo '<pre>';print_r($test);die(); 
function ifRegisteredThisMonth($created_at)
{
    $todayDateee = date("m");
    $registerDate = date("m", strtotime($created_at));
    $diff = ($todayDateee == $registerDate ? "true" : "false");
    return $diff;
}
?>

<form method="POST" action="{{ url('admin/user/pay_commission') }}" accept-charset="UTF-8">
    <style>
        .datepicker table tr td span.disabled,
        .datepicker table tr td span.disabled:hover {
            opacity: 0.4;
        }
    </style>
    <ul class="form-validate-errors"></ul>
    <input name="_token" type="hidden" value="tMbnk4MfFSYMG732qG0w1i9V4cxPZOOnBEKscTwi">
    <div class="col-md-4">
        <input name="daterange" type="text" placeholder="select Month" autocomplete="off">&nbsp;&nbsp;<input class="btn btn-primary text-white" type="submit" id="btn_submit" value="Apply" disabled="disabled">&nbsp;&nbsp;<a href="{{ url('admin/user/pay_commission') }}" class="btn btn-primary text-white">Reset</a>
    </div>
</form>

<div class="col-md-4">
    @if($month ==1)
    <center>
        <h3>Month: {{(isset($currentMonth))? $currentMonth: '' }}</h3>
    </center>
    @elseif($month ==2)
    <center>
        <h3>Month: {{(isset($currentMonth))? $currentMonth: '' }} </h3>
    </center>
    @else
    <h2></h2>
    @endif
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
        //$('#commission_table').DataTable();
    });
</script>
<?php // echo"<pre>";print_r($user->username);echo"</pre>";die;
        ?>
@foreach($users as $user )
<?php $count++ ?>
@endforeach
<?php if ($count) : ?>
    <a href="/group/send/<?php echo $authUser->username ; ?>" class="btn btn-primary text-white" type="button" style="float: right">
        Message All</a>
<?php endif; ?>
<br><br>
<table id='table_id' class="table table-condensed table-striped table-hover">
    <thead class="thead-dark">
        <?php if ($count) : ?>
            <tr>
                <th scope='col'>#</th>
                <th scope='col'>ID</th>
                <th scope="col">Subscribers</th>
                <th scope="col">Status</th>
                <th scope="col">Total fees</th>
                <th scope="col">Total commissions</th>
                <th scope="col">Paid At</th>
                <th scope="col"></th>
            </tr>
    </thead>
    <tbody>
        <?php //echo"<pre>";print_r($users);echo"</pre>";die;
        ?>
        {{-- 8888888888888888888888888888888888888   Level one    88888888888888888888888888888888888888888888888888888888--}}
        <?php
            $count = 1;
            $total1 = 0;
            $totalUsersPaid = 0;
            $totalUsers = 0;
        ?>
        <?php foreach ($users as $list) : ?>
            <tr class="myTableRow">
                <?php  
                $totalUsers++;
                $totalPayDate = $list->paid_at ?? '';
                $history_saved_at = $list->history_saved_at ?? '';
				?>
                <td>{{$count}}</td>
                <td>{{$list->id}}</td>
                <td>{{$list->first_name." ". $list->last_name}}</td>
                <td> <?php
                        if ($list->is_active == 'YES') {
                            /*if (ifRegisteredThisMonth($list->created_at) == "true") {
                                $countNewRegistrations += 1;
                                echo '&#x274C';
                            } else {
                                echo '&#9989'; //&#9989
                                $total1++;
                            }*/
                            
                            if (ifRegisteredThisMonth($list->created_at) == "true") {
                                $countNewRegistrations += 1;
                                if($list->subscriber_commision >= 50):
                                    echo '&#9989'; //right
                                    $total1++;
                                else:
                                    echo '&#x274C';//wrong
                                endif;
                            } else {
                                echo '&#9989'; //&#9989
                                $total1++;
                            }
                        } else {
                            echo '&#x274C'; //&#x274C
                        }
                        
                        ?></td>
                <td><?php
                    /*if ($list->is_active == 'YES' && ifRegisteredThisMonth($list->created_at) != "true") {
                        echo $amount;
                    } else {
                        echo 'Not paid';
                    }*/
                    if ($list->is_active == 'YES') {
                        if($list->subscriber_commision >= 50 && ifRegisteredThisMonth($list->created_at) == "true"):
                            echo $amount; //right
                        elseif(ifRegisteredThisMonth($list->created_at) != "true"):
                            echo $amount; //right
                        else:
                            echo 'Not paid';//wrong
                        endif;
                    } else {
                        echo 'Not paid';
                    }
                    ?></td>
                <td> 
                    <?php
                        /*if ($list->is_active == 'YES' && ifRegisteredThisMonth($list->created_at) != "true") {
                            echo $comm;
                        } else {
                            echo '0';
                        }*/
                        if ($list->is_active == 'YES') {
                            if($list->subscriber_commision >= 50 && ifRegisteredThisMonth($list->created_at) == "true"):
                                echo $comm; //right
                            elseif(ifRegisteredThisMonth($list->created_at) != "true"):
                                echo $comm; //right
                            else:
                                echo '0';//wrong
                            endif;
                        } else {
                            echo '0';
                        }
                    ?>
                </td>
                        
                @if(!array_key_exists('paid_at', $list) || $list->paid_at == null)
                <td id="{{$list->id}}">
                    @if($isAdmin)
                    @if($isHistory)
                    <button class="btn btn-warning btn-xs pay_amount" data-id="{{$list->id}}" data-history_saved_at="{{$list->history_saved_at}}" type="button" style="color: white">Paid</button>
                    @else
                    <button class="btn btn-warning btn-xs pay_amount" data-id="{{$list->id}}" data-history_saved_at="" type="button" style="color: white" disabled>Paid</button>
                    @endif
                    @else
                    {{'___'}}
                    @endif
                </td>
                @else
                <?php $totalUsersPaid++ ; ?>
                <td id="{{$list->id}}">{{(new \DateTime($list->paid_at))->format('d-M-Y')}}</td>
                @endif
                <td>
                    <a href="/message/<?php echo $authUser->username ; ?>" class="btn btn-primary btn-xs" type="button" style="color: white">Message</a>

                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{route('admin.user.details',array('id'=>$list->id))}}" class="btn btn-info btn-xs edit">Commission</a>
                        </div>
                    </div>
                </td>
            </tr>
            <?php
                $count++;

            ?>
        <?php endforeach; ?>
    <?php else : ?>
        <h1>Users don't have any subscriber</h1>
    <?php endif; ?>
    </tbody>
</table>
<table  class="table table-condensed table-striped table-hover">
    <tbody>
        {{-- ???????????????????????????????????  total ???????????????????????????????????????????????????????????????????????????????????????--}}
        
        <tr>
            <th colspan="3" style="text-align: center;font-size: 2rem">Monthly Fees Through Subscriptions</th>
            <td style="font-size: 2rem">
                <?php
                if ($countNewRegistrations >= 0) {
                    if (((int) $authUser->subscriber_commision) == ($countNewRegistrations * 25)) {
                        echo '&#9989';
                    } else {
                        echo '&#x274C';
                    }
                } else {
                    echo '&#x274C';
                }
                ?>
            </td>
            <td style="font-size: 2rem">
                @if(env('SITE') == 'ENG')
                <?php
                if ($countNewRegistrations >= 0) {
                    if (((int) $authUser->subscriber_commision) == ($countNewRegistrations * 25)) {
                        echo $amount;
                    } else {
                        echo 'Not Paid';
                    }
                } else {
                    echo 'Not Paid';
                }
                ?>
                @else
                <?php
                if ($countNewRegistrations >= 0) {
                    if (((int) $authUser->subscriber_commision) == ($countNewRegistrations * 25)) {
                        echo $amount;
                    } else {
                        echo 'Not Paid';
                    }
                } else {
                    echo 'Not Paid';
                }
                ?>
                @endif
            </td>
            <td style="font-size: 2rem">
                @if(env('SITE') == 'ENG')
                <?php
                if ($countNewRegistrations >= 1) {
                    echo '$' . ((int) $authUser->subscriber_commision);
                } else {
                    echo '0';
                }
                ?>
                @else
                <?php
                if ($countNewRegistrations >= 1) {
                    echo (((int) $authUser->subscriber_commision / 25) * 500) . 'F';
                } else {
                    echo '0';
                }
                ?>
                @endif
            </td>
            <td>
                {{--<button type="button" class="btn btn-primary btn-xs">Payment</button>--}}
            </td>
        </tr>
        <tr>
            <th colspan="3" style="text-align: center;font-size: 2rem">Total Fees Paid by Subscribers(4 Levels)</th>
            <td colspan="3" style="text-align: center;font-size: 2rem">
                @if(env('SITE') == 'ENG')
                ${{$total1*50}}
                @else
                {{$total1*1000}}F
                @endif
            </td>
        </tr>
        <tr>
            <th colspan="3" style="text-align: center;font-size: 2rem">Total Commission at 4 levels(50% at each level)</th>
            <td colspan="3" style="text-align: center;font-size: 2rem">
                @if(env('SITE') == 'ENG')
                <?php $commission_perc = (50*50)/100; ?>
                ${{$total1*$commission_perc}}
                @else
                <?php $commission_perc = (1000*50)/100; ?>
                {{$total1*$commission_perc}}
                @endif
        </tr>
        <?php /*?>
         <tr>
            <th colspan="3" style="text-align: center;font-size: 2rem">Total amount to be paid</th>
            <td colspan="3" style="text-align: center;font-size: 2rem">
              @if(env('SITE') == 'ENG')
                <?php
                $subscription_amount = ((int) $authUser->subscriber_commision);
                $commission_perc = (50*50)/100; 
                $total_comission_paid = $total1*$commission_perc;
                if ($countNewRegistrations >= 1) {
                    echo '$' . ($commission_perc + $total_comission_paid);
                } else {
                    echo '$' . ($total_comission_paid);
                }
                ?>
                @else
                <?php
                $subscription_amount = (((int) $authUser->subscriber_commision / 25) * 500);
                $commission_perc = (1000*50)/100;
                $total_comission_paid = $total1*$commission_perc;
                if ($countNewRegistrations >= 1) {
                    echo ($commission_perc + $total_comission_paid). 'F';
                } else {
                    echo ($total_comission_paid). 'F';
                }
                ?>
                @endif
                
               @if($totalUsersPaid != $totalUsers)
                <td id="totalAmountPaid">
                    @if($isAdmin)
                    @if($isHistory)
                    <button class="btn btn-warning btn-xs pay_total_amount" data-history_saved_at="{{$history_saved_at}}" type="button" style="color: white">Paid</button>
                    @else
                    <button class="btn btn-warning btn-xs pay_amount" data-history_saved_at="" type="button" style="color: white" disabled>Paid</button>
                    @endif
                    @else
                    {{'___'}}
                    @endif
                </td>
                @else
                <td id="totalAmountPaid">{{(new \DateTime($totalPayDate))->format('d-M-Y')}}</td>
                @endif 
                
        </tr>
        <?php */ ?> 
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('.pay_amount').click(function() {
            var user_id = $(this).attr("data-id");
            var history_saved_at = $(this).attr("data-history_saved_at");
            //alert(user_id + "----" + history_saved_at);
            // $.ajax({
            //     url: "{{route('admin.user.amountPaid')}}",
            //     type: 'post',
            //     dataType: "json",
            //     data: {user_id: user_id},
            //     success: function (response) {
            //         //location.reload();
            //     }

            // });

            $.ajax({
                method: "POST",
                headers: {
                    Accept: "application/json"
                },
                url: "{{ route('admin.user.amountPaid') }}",
                data: {
                    user_id: user_id,
                    history_saved_at: history_saved_at
                },
                success: (response) => {
                    if (!response) {
                        alert('Something went wrong, try Again!');
                    } else {
                        //alert("Success------" + response['id']);
                        $('#' + response['id']).html(response['data']);
                    }
                    //window.location.assign("{{ url('user/paid') }}")
                },
                error: (response) => {
                    alert("Error------" + response);
                }
            })
        });
    
    //pay all users using paid button
        $('.pay_total_amount').click(function() {
            var user_id = $(this).attr("data-id");
            var history_saved_at = $(this).attr("data-history_saved_at");
            
            $.ajax({
                method: "POST",
                headers: {
                    Accept: "application/json"
                },
                url: "{{ route('admin.user.totalamountPaid') }}",
                data: {
                    history_saved_at: history_saved_at
                },
                success: (response) => {
                    if (!response) {
                        alert('Something went wrong, try Again!');
                    } else {
                        //alert("Success------" + response['id']);
                        $('#totalAmountPaid').html(response['data']);
                    }
                    //window.location.assign("{{ url('user/paid') }}")
                },
                error: (response) => {
                    alert("Error------" + response);
                }
            })
        });
    });
    
    
    
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#table_id').dataTable({
            paging: true,
           "lengthMenu": [[10000, 5000, 1000, -1], [500, 1000, 5000, 10000]]
        });

    });
</script>


{{--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

@endsection